<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MySite extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Mysites_model');
		check_login();
	}
	
	/*
	 * Add new site 
	 */
	public function index($id=null)
	{
		$data['page_title'] = "Add New Site";
		//GET OFFER NAMES
		$this->db->select('id,offer_name');
		$getoffers = $this->db->get('offers');
		$getoffers = $getoffers->result();
		$offer_list = array();
		foreach ($getoffers as $value)
		{
			$offer_list[$value->id] = $value->offer_name;
		}
		$data['offer_list'] = $offer_list;
		
		if($id)
		{
			//GET SITE DETAILS BY ID
			$this->db->where('id',$id);
			$sql = $this->db->get('mysites');
			$getrow = $sql->row();
			$data['result'] = $getrow;
			//echo"<pre>";print_r($offer_list);echo"</pre>";
		}
		$this->template->load('template_default','mysites/add_new_site',$data);
	}
	
	/*
	 * Save site data to database
	 */
	public function add_site($id=null){
		//echo "<pre>";print_r($_POST);exit;
		$_POST['prime_offers']   = (isset($_POST['prime_offers']) && !empty($_POST['prime_offers'])) ? implode(",", $_POST['prime_offers']) : "";
		$_POST['regular_offers']=(isset($_POST['regular_offers']) && !empty($_POST['regular_offers'])) ? implode(",", $_POST['regular_offers']) : "";
        if(isset($_POST['po_seq_random'])){
            $_POST['po_seq_random'] = '1';
        }else{
            $_POST['po_seq_random'] = '0';
        }
        if(isset($_POST['ro_seq_random'])){
            $_POST['ro_seq_random'] = '1';
        }else{
            $_POST['ro_seq_random'] = '0';
        }
		if($id){
			$this->db->where('id',$id);
			$sql = $this->db->update('mysites',$_POST);
		}else{
			$_POST['date_created'] = date('Y-m-d H:i:s');
			$sql = $this->db->insert('mysites',$_POST);
		}
		
		if($sql){	
			$this->session->set_flashdata('succ-msg',"Data saved successfully");	
		}else{	
			$this->session->set_flashdata('err-msg',"Some error occurs during database operation");	
		}
		
		redirect(base_url()."MySite/list_sites");		
	}
	
	/*
	 * List sites
	 */
	public function list_sites()
	{
		$data['page_title'] = "List Sites";
		
		//Get site list
		$list_sites = $this->General_model->get_records("mysites",array('id'=>'ASC'));
		$data['list_sites'] = $list_sites;
		//echo"<pre>";print_r($list_sites);echo"</pre>";exit;
		$this->template->load('template_default','mysites/list_sites',$data);
	}
	
	public function check_sitename()
	{
		//echo"<pre>";print_r($_GET);echo"</pre>";
		$this->db->where('site_name',$_GET['site_name']);
		if($_GET['data_id'])
		{	$this->db->where('id !=',$_GET['data_id']); }
		$this->db->from('mysites');
		$result = $this->db->count_all_results();
		if($result>0)
			echo"false";
		else
			echo"true";
		exit;
	}
	
	/**
	 * @Since :  19 November 2016 10:18 AM
	 * @Description : redirect to add mysite key words
	 */ 
	function addMysiteKey(){

        $data['page_title'] = "Add Keyword To Site";	
        /**
         * get site data
         */
		$list_sites = $this->General_model->get_records("mysites",array('id'=>'ASC'),array('id,site_name'));
		$data['list_sites'] = $list_sites;    
		$this->template->load('template_default','mysites/mysite_data_key',$data);
	}
	/**
	 * @Since : 18 November 2016 17:51 PM
	 * @Description :
	 */ 
	function addPostkey(){
		$i_flag = 2;
        if(isset($_GET['key']) && !empty($_GET['key']) && isset($_GET['key_value']) && !empty($_GET['key_value']) && isset($_GET['site_id']) && !empty($_GET['site_id'])){
               $_GET['date_created'] = date('Y-m-d H:i:s');
            $_GET['ip_address'] = REMOTE_IPADDR;
			$insert_sql = $this->db->insert('mysite_data_key',$_GET);			
             if(!empty($insert_sql)){
                 $i_flag = 1;
                 $i_mysite_data_key_id = $this->db->insert_id();
                 echo json_encode(array('flag'=>$i_flag,'mysite_data_key_id'=>$i_mysite_data_key_id));
                 exit;
             }
        }
        echo json_encode(array('flag'=>$i_flag));
	}
		/**
		 * @Since : 19 November 2016 12:04 PM
		 * @Description : list of keywords from mysite_data_key table.
		 */ 
		function getMysitekeyData(){
			$t_system_keyword = array();
			$t_site_keyword = array();
            if(isset($_GET['site_id']) ){
                $t_site_keyword = $this->General_model->get_records("mysite_data_key",array('id'=>'ASC'),array('id,site_id,key_text,key,key_value'),array('site_id'=>$_GET['site_id'],'delete_status'=>0));
                    if(count($GLOBALS['SYSTEM_FIELDS']) > 0){
						$t_system_keyword = $GLOBALS['SYSTEM_FIELDS']; 
					}
				echo json_encode(array('flag'=>1,'t_site_keyword'=>$t_site_keyword,'t_system_keyword'=>$t_system_keyword));
				exit;		
            }
            echo json_encode(array('flag'=>2));
		}
		/**
		 * @Since : 19 November 2016 13:23 PM
		 * @Description : delete keyword from mysite_data_key_table
		 */ 
		function deleteSitekey(){
            $i_flag = 2;
            if(isset($_GET['keyword_id']) && !empty($_GET['keyword_id'])){
                $this->db->where('id',$_GET['keyword_id']);                
                $i_flag = $this->db->update('mysite_data_key',array('delete_status'=>1));
                if(isset($_GET['site_id']) && !empty($_GET['site_id'])){
                	$t_site_keyword = $this->General_model->get_records("mysite_data_key",array('id'=>'ASC'),array('id,site_id,key_text,key,key_value'),array('site_id'=>$_GET['site_id'],'delete_status'=>0));
                    if(count($GLOBALS['SYSTEM_FIELDS']) > 0){
						$t_system_keyword = $GLOBALS['SYSTEM_FIELDS']; 
					}
				}
				echo json_encode(array('flag'=>1,'t_site_keyword'=>$t_site_keyword,'t_system_keyword'=>$t_system_keyword));
				exit;
            }
            echo json_encode(array('flag'=>1));
		}
}
