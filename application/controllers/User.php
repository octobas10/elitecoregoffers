<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	/*
	 * Login Page
	 */
	public function login()
	{
		$data['page_title'] = "Login Page";
		if($this->input->post())
		{
			$this->load->library('form_validation');
			// Check validation for user input in SignUp form
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$this->session->set_flashdata('err-msg',"Invalid username or password");
				redirect(site_url('user/login'));
			} 
			else 
			{
				$check = $this->user_model->login($_POST['username'],$_POST['password']);
				//echo"<pre>";print_r($check);echo"</pre>";exit('123');
				if(!empty($check))
				{
					$this->session->set_userdata('user_detail',$check);
					//echo"<pre>";print_r($this->session->userdata);echo"</pre>";exit('123');
					$this->session->set_flashdata('succ-msg',"Login successfull");
					redirect(site_url('offer/list_offers'));exit;
				}
				else
				{
					$this->session->set_flashdata('err-msg',"Invalid username or password");
					redirect(site_url('user/login'));
				}
			}			
		}
		//echo '<pre>';print_r($data);exit;
		$this->template->load('template_login','user/login',$data);		
	}
	
	// Show Confirmation and make changes in offer data double_opt_in_checked flag
	function showConfirmation($i_offer_id=''){
		$data['page_title'] = "Login Page";
	    if(!empty($i_offer_id)){
			$this->db->select('offer_name,image_pixel_link,http_post_url,http_get_url,transfer_email,email_file_name,email_delimeter,ftp_host_name,ftp_login_name,ftp_login_password,ftp_file_name,ftp_delimeter');
            $this->db->where('id',$i_offer_id);
            $getOfferData = $this->db->get('offers');
            $getOfferData = $getOfferData->row();
            if(isset($_GET['od']) && !empty($_GET['od']) &&  isset($_GET['tf']) && ($_GET['tf'] == 0)){
				
				$this->db->select('so_email,double_opt_in_checked');
				$this->db->where('id',$_GET['od']);
				$registeredOfferData = $this->db->get("offer_data");
				$registeredOfferData = $registeredOfferData->row();
				if(!empty($registeredOfferData) && $registeredOfferData -> double_opt_in_checked == '1'){
					redirect(site_url('user/login'));
					exit;
				}
				
                $dbdata['double_opt_in_checked'] = '1';
                $this->db->where('id',$_GET['od']);
				$sql = $this->db->update("offer_data",$dbdata);
				if($sql == false){
					redirect(site_url('user/login'));
					exit;
				}
            }
            $email = ((!empty($registeredOfferData) && !empty($registeredOfferData -> so_email)) ? $registeredOfferData -> so_email : ' Test Offer' );
			if(!empty($getOfferData) && !empty($getOfferData->image_pixel_link)){
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$getOfferData->image_pixel_link);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);
                curl_close($ch);
				//mail($getOfferData->image_pixel_link,SITE_TITLE." Offer Registration Successful Mail",'Customer Registered in '.$getOfferData->offer_name.' with email <b>'.$email.'</b> ',$headers);
				//$this->session->set_flashdata('getOfferData',$getOfferData);
				$this->load->view('offer/confirmation',$getOfferData);	
			}else{
				redirect(site_url('user/login'));
			}			
	    }else{
			redirect(site_url('user/login'));
		}
	}
	
	
	/*
	 * User signup Page
	 */
	public function signup()
	{
		$data['page_title'] = "User Signup Page";
		$this->template->load('template_default','user/signup',$data);
	}
	
	public function dashboard()
	{
		check_login();	
		$data['page_title'] = "Dashboard";
		//get chart data
		$get_data = $this->db->query("SELECT date_created,SUM(displayed) as displayed,SUM(submitted)as submitted FROM `".SITE_OFFERS_TRANS_TABLE."` WHERE date_created > DATE_SUB(NOW(), INTERVAL 15 DAY) GROUP BY date_created");
		$get_data = $get_data->result();
		$data['SmartChart1'] = json_encode($get_data);
		//echo"<pre>";print_r($get_data);echo"</pre>";
		//echo"<pre>";print_r(json_encode($get_data));echo"</pre>";
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";exit;
		$this->template->load('template_chart','user/dashboard',$data);
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect(base_url());
	}
	
	public function instructions()
	{
		$data['page_title'] = "Instructions Page";
		$this->template->load('template_default','user/instructions',$data);
	}
	
	/*
	 * USER PROFILE
	 */
	public function profile()
	{
		check_login();
		$data['page_title'] = "User Profile";
		
		$get_session = $this->session->userdata;
		//echo"<pre>";print_r($get_session);echo"</pre>";exit;
		//check user logged in or not 
		if(!isset($get_session['user_detail']->id) && empty($get_session['user_detail']->id))
		{
			$this->session->set_flashdata('err-msg',"Invalid user. Make login first.");
			redirect(site_url('user/login'));
		}
		
		//Set user ID
		$UID = $get_session['user_detail']->id;
		$this->db->where('id',$UID);
		$get_detials = $this->db->get('user_master');
		$get_detials = $get_detials->row();
		$data['result'] = $get_detials;
		//echo"<pre>";print_r($get_detials);echo"</pre>";exit;		
		
		if($this->input->post())
		{
			$_POST = array_filter($_POST);
			$dbdata = '';
			if($_POST['password'] && !empty($_POST['password']) && $_POST['password']!= $_POST['conf_password'])
			{
				$this->session->set_flashdata('err-msg',"New password and confirm password fields must be same.");
				redirect(base_url()."user/profile");
			} 
			else if($_POST['password'] && !empty($_POST['password']) && $_POST['password']== $_POST['conf_password']) 
			{
				$pass = $_POST['password'];
				$dbdata['password'] = md5($pass);
				unset($_POST['password']);unset($_POST['conf_password']);
			}
			
			foreach ($_POST as $key=>$value)
			{	$dbdata[$key] = $value; }
			
			if(!empty($dbdata))
			{
				//echo"<pre>";print_r($dbdata);echo"</pre>";exit;
				$dbdata['date_created'] = date('Y-m-d H:i:s');
			
				$this->db->where('id',$UID);
				$this->db->update("user_master",$dbdata);
				
				if($this->db->affected_rows() > 0)
					$this->session->set_flashdata('succ-msg',"Your profile updated successfully");
				else
					$this->session->set_flashdata('err-msg',"Error while updating your profile.");
			}
			redirect(base_url()."user/profile");	
		}
		$this->template->load('template_default','user/profile',$data);
	}
}
