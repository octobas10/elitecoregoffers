<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Offer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Mysites_model');
		if($this->router->fetch_method() != 'offer_data_submit'){
			check_login();
		}
	}
	public function index(){
		redirect(base_url().'offer/list_offers');
	}
	public function add_offer($id=null){
		$data['page_title'] = "Offer Page";
		if($id){
			$this->db->where('id',$id);
			$sql = $this->db->get('offers');
			$result = $sql->row();
			$data['result'] = $result;
            $t_offer_io_management_data = $this->db->query("select id,so_start_date,so_end_date,so_payout,so_ear,so_daily,so_weekly,so_monthly,date_created,so_total from offer_io_management where offer_id = ".$id)->result();
            $data['io_management'] = $t_offer_io_management_data;
		}
		//get clients
		$get_clients = $this->General_model->get_records('clients',array('id'=>'ASC'));
		$clients = array();
		if(count($get_clients)>0){
			foreach ($get_clients as $cl){
				$clients[$cl->id]=$cl->client_name;
			}
		}
		$data['list_clients'] = $clients;
		if(!empty($_POST)){
			/* $targ_w = $targ_h = 150;
			$jpeg_quality = 90;
			$src = base_url()."uploads/".$_POST['offer_image'];
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$jpeg_quality);
			exit;
			*/
			//echo"<pre>";print_r($_POST);exit;
			$dbdata['offer_name']      = $_POST['offer_name'];
			$dbdata['client_id']       = $_POST['client_id'];
			$dbdata['offer_name']      = $_POST['offer_name'];
			$dbdata['client_id']       = $_POST['client_id'];
			if(!empty($_POST['notes'])){ 
				$dbdata['notes']           = $_POST['notes'] ; 
			}
			if(!empty($_POST['question'])){
				$dbdata['question']        = $_POST['question']; 
			}
			$dbdata['http_post_url']     = $_POST['http_post_url'];
			$dbdata['http_get_url']      = $_POST['http_get_url'];
			/**
			 * @since : 7 july 2016 2:50 pm
			 * @modification : image_pixel_link variable added to $dbdata for insert in data base.
			 */
			$dbdata['image_pixel_link'] = $_POST['image_pixel_link'];
			if($_POST['transfer_method']=="transfer_method_post"){ //POST METHOD
				$dbdata['response_type']  = $_POST['response_type'][0];
				$dbdata['accepted_response_tag']   = $_POST['accepted_response_tag'][0];
				$dbdata['accepted_response_value'] = $_POST['accepted_response_value'][0];
			}else{ //GET METHOD
				$dbdata['response_type']  = $_POST['response_type'][1];
				$dbdata['accepted_response_tag']   = $_POST['accepted_response_tag'][1];
				$dbdata['accepted_response_value'] = $_POST['accepted_response_value'][1];				
			}
			if(!empty($_POST['offer_options'])){ 
				$dbdata['offer_options']   = $_POST['offer_options']; 
			}
			if(!empty($_POST['rated_offers'])){ 
				$dbdata['rated_offers']   = $_POST['rated_offers']; 
			}
			if(!empty($_POST['transfer_method'])){ 
				$dbdata['transfer_method'] = $_POST['transfer_method']; 
			}
			if(!empty($_POST['offer_content'])){ 
				$dbdata['offer_content']      = $_POST['offer_content']; 
			}
			if(!empty($_POST['script'])){ 
				$dbdata['script'] = $_POST['script']; 
			}
			/*if(!empty($_POST['offer_image'])){
				$remove[] = "'";
				$remove[] = '"';
				$remove[] = "-"; // just as another example
				$remove[] = " ";
				$dbdata['offer_image'] = str_replace( $remove, "_", $_POST['offer_image']); 
			}*/
			if(isset($_FILES['offer_image']) && !empty($_FILES['offer_image']) && isset($_FILES['offer_image']['name']) && !empty($_FILES['offer_image']['name'])){
				$remove[] = "'";
				$remove[] = '"';
				$remove[] = "-"; // just as another example
				$remove[] = " ";
				$dbdata['offer_image'] = str_replace( $remove, "_", $_FILES['offer_image']['name']); 
			}
			if(isset($_POST['userform'])){
				$dbdata['offer_form']      = json_encode($_POST['userform']);
			}
			$dbdata['transfer_email']     = $_POST['transfer_email'];
			$dbdata['email_file_name']    = $_POST['email_file_name'];
			$dbdata['email_delimeter']    = $_POST['email_delimeter'];
			$dbdata['ftp_host_name']      = $_POST['ftp_host_name'];
			$dbdata['ftp_port']      = $_POST['ftp_port'];
			$dbdata['ftp_login_name']     = $_POST['ftp_login_name'];
			$dbdata['ftp_login_password'] = $_POST['ftp_login_password'];
			$dbdata['ftp_file_name']      = $_POST['ftp_file_name'];
			$dbdata['ftp_delimeter']      = $_POST['ftp_delimeter'];
			$dbdata['ftp_protocol']      = $_POST['ftp_protocol'] ? $_POST['ftp_protocol'] : 0;
			$dbdata['date_created']       = date('Y-m-d H:i:s');
            $insert_id = '';
			if($id){//update data
				$this->db->where('id',$id);
				$sql = $this->db->update("offers",$dbdata);
                $insert_id = $id;
			}else{//insert data
				$sql = $this->db->insert("offers",$dbdata);
                $insert_id = $this->db->insert_id();
			}		
			if($sql){	
                $t_io_data = array();
                // Remove IO management block those are removed 
                if(isset($_POST['removed_io_management']) && !empty($_POST['removed_io_management'])){
                    $t_io_ids = explode(',',$_POST['removed_io_management']);
                    if(!empty($t_io_ids)){
                        foreach($t_io_ids as $i_io_id){
                            $this->db->where('id', $i_io_id);
                            $this->db->delete('offer_io_management');
                        }
                    }
                }
                if(isset($_POST['io_data']) && !empty($insert_id)){
                    foreach($_POST['io_data'] as $i_key => $i_data){
                        $t_io_data = array(
                            'offer_id'=>$insert_id,
                            'so_start_date'=>(isset($_POST['t_so_start_date_'.($i_key+1)]) ? $_POST['t_so_start_date_'.($i_key+1)] : "" ),
                            'so_end_date'=>(isset($_POST['t_so_end_date_'.($i_key+1)]) ? $_POST['t_so_end_date_'.($i_key+1)] : "" ),
                            'so_payout'=>(isset($_POST['t_so_payout_'.($i_key+1)]) ? $_POST['t_so_payout_'.($i_key+1)] : "" ),
                            'so_daily'=>(isset($_POST['t_so_daily_'.($i_key+1)]) ? $_POST['t_so_daily_'.($i_key+1)] : "" ),
                            'so_monthly'=>(isset($_POST['t_so_monthly_'.($i_key+1)]) ? $_POST['t_so_monthly_'.($i_key+1)] : "" ),
                            'so_weekly'=>(isset($_POST['t_so_weekly_'.($i_key+1)]) ? $_POST['t_so_weekly_'.($i_key+1)] : "" ),
                            'so_ear'=>(isset($_POST['t_so_ear_'.($i_key+1)]) ? $_POST['t_so_ear_'.($i_key+1)] : "" ),
                            'so_total'=>(isset($_POST['t_so_total_'.($i_key+1)]) ? $_POST['t_so_total_'.($i_key+1)] : "" ),
                        );
                        if(empty($i_data)){
                            $this-> db->insert('offer_io_management', $t_io_data);
                        }else{
                            $this->db->where('id', $i_data);  
                            $this->db->update('offer_io_management', $t_io_data); 
                        }
                    }                    
                }	
                $this->session->set_flashdata('succ-msg',"Data saved successfully");
            }
			else{	
				$this->session->set_flashdata('err-msg',"Some error occurs during database operation");	
			}
			redirect(base_url()."offer/list_offers");
		}
		$this->template->load('template_default','offer/add_offer',$data);
	}
	
	/*
	 * Delete offer
	 */
	public function delete_offer($id){
		$this->db->where('id',$id);
		$sql = $this->db->delete('offers');
		if($sql){
			//update site offer list
			$this->Mysites_model->update_mysites_offers();
			$this->session->set_flashdata('succ-msg',"Data deleted successfully");
		}else{
			$this->session->set_flashdata('err-msg',"Error while deleting data");
		}
		redirect(base_url().'offer/list_offers');
	}
	/*
	 * Pause offer
	 */
	public function pause_offer($id){
		$data['status_pause'] = '1';
		$this->db->where('id',$id);
		$sql = $this->db->update('offers',$data);
		//echo $this->db->last_query();exit;
		if($sql){
			//update site offer list
			$this->Mysites_model->update_mysites_offers();
			$this->session->set_flashdata('succ-msg',"Offer Paused Successfully");
		}else{
			$this->session->set_flashdata('err-msg',"Error while deleting data");
		}
		redirect(base_url().'offer/list_offers');
	}
	/*
	 * Unpause offer
	 */
	public function unpause_offer($id){
		$data['status_pause'] = '0';
		$this->db->where('id',$id);
		$sql = $this->db->update('offers',$data);
		//echo $this->db->last_query();exit;
		if($sql){
			$this->session->set_flashdata('succ-msg',"Offer Unpaused Successfully");
		}else{
			$this->session->set_flashdata('err-msg',"Error while deleting data");
		}
		redirect(base_url().'offer/list_offers');
	}
	/*
	 * List offers
	 */
	public function list_offers(){
		//echo"<pre>";print_r($this->session->userdata);echo"</pre>";exit('123');
		$data['page_title'] = "List Offers";
		//get clients
		$get_clients = $this->General_model->get_records('clients',array('id'=>'DESC'));
		$clients = array();
		if(count($get_clients)>0){
			foreach ($get_clients as $cl){
				$clients[$cl->id]=$cl->client_name;
			}
		}
		$data['list_clients'] = $clients;
		
		//Get site list
		$list_offers = $this->General_model->get_records("offers",array('id'=>'DESC'));
		$data['list_offers'] = $list_offers;
		//echo"<pre>";print_r($list_sites);echo"</pre>";exit;
		$this->template->load('template_default','offer/list_offers',$data);
	}
	public function upload_ajax_image(){
			if(isset($_REQUEST)){
			extract($_POST);
			$error = false;
			$files = array();
			$todir = 'uploads/';
			$allow = array('png','jpeg','jpg','gif');
			$file_name='';
			foreach($_FILES as $file){
				$tmp_name = $file['tmp_name'];
				$file_name = basename($file['name']);
			}
			
			$remove[] = "'";
			$remove[] = '"';
			$remove[] = "-"; // just as another example
			$remove[] = " ";
			$file_name = str_replace( $remove, "_", $file_name );
			//echo $file_name;exit('111');
			
			$file_to_upload = $todir.$file_name;
		
			if ($tmp_name){
				$info = explode('.', strtolower($file_name));
				if (in_array(end($info), $allow) ){
					if(!move_uploaded_file($tmp_name,$file_to_upload)){
						echo 'Problem in file uploading';
					}					
				}else{
					echo 'File extension is not allowed';
				}
				return $file_name;
			}
			
		}
	}
	public function example_save(){
		print_r(json_encode($_REQUEST));	
	}
	
	public function getofferform($offer_id){
		$this->db->select("offer_form");
		$this->db->where('id',$offer_id);
		$sql = $this->db->get('offers');
		$result = $sql->row();
		echo $result->offer_form;exit;	
	}
	
	public function check_offername(){
		//echo"<pre>";print_r($_GET);echo"</pre>";
		$this->db->where('offer_name',$_GET['offer_name']);
		if($_GET['data_id'])
		{	$this->db->where('id !=',$_GET['data_id']); }
		$this->db->from('offers');
		$result = $this->db->count_all_results();
		if($result>0)
			echo"false";
		else
			echo"true";
		exit;
	}
	/*
	 * Get offers by page type
	 * [FULL PAGE OFFER , VERTICAL OFFER , HORIZONTAL OFFER , POP OFFER]
	 */
	public function ajax_getoffers($page_type){
		//echo"<pre>";print_r($_POST);echo"</pre>";exit;
		$selected_offers = '';
		if(count($_POST['prime'])>0){ $selected_offers .= $_POST['prime'];}
		if(count($_POST['regular'])>0){ 
			$selected_offers .= (strlen($selected_offers)>0)? ",".$_POST['regular'] : $_POST['regular']; }
		
		if(strlen($selected_offers)>0){
			$this->db->where_not_in('id',explode(',',$selected_offers));
		}
		//echo"<pre>";print_r($selected_offers);echo"</pre>";exit;
		$result="";
		if($page_type=="pop_display"){
			$this->db->select("id,offer_name");
			$this->db->where("offer_options","opt_popout");
			$this->db->from("offers");
			$sql = $this->db->get();
			$sql = $sql->result();
			//echo"<pre>";print_r($sql);echo"</pre>";
			
			if(count($sql)>0)
			{
				foreach($sql as $value)
				{
					$result.="<option value='".$value->id."'>".$value->offer_name."</option>";
				}
			}
		}else{
			$this->db->select("id,offer_name");
			$this->db->from("offers");
			$sql = $this->db->get();
			$sql = $sql->result();
			//echo"<pre>";print_r($sql);echo"</pre>";
				
			if(count($sql)>0){
				foreach($sql as $value){
					$result.="<option value='".$value->id."'>".$value->offer_name."</option>";
				}
			}
		}
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";exit;
		echo $result;
	}
	/*
	 * Funciton for save submited offer data
	 */
	public function offer_data_submit(){
		//echo"<pre>";print_r($_POST);echo"</pre>";
		//system fields
		$system_fields = array_keys($GLOBALS['SYSTEM_FIELDS']);
		
		$offer_shown='';
		if(isset($_REQUEST['so_current_offer_shown'])){
			$offer_shown   = explode(',',$_POST['so_current_offer_shown']);
		}
		$batch_data    = array();
		//mail('octobas@gmail.com','submitted offers',base64_decode($_POST['site_id'])."=>".$_REQUEST['so_current_offer_shown']." @ ". date('Y-m-d H:i:s'));
		foreach ($offer_shown as $offer){
			if(isset($_POST['smart_offer_status_'.$offer]) && $_POST['smart_offer_status_'.$offer]=="yes"){
				/**** GET site_offer_trans_id ***/
				$sql = $this->db->query("SELECT id FROM ".SITE_OFFERS_TRANS_TABLE."  WHERE site_id='".base64_decode($_POST['site_id'])."' AND offer_id='".$offer."' AND date_created='".date('Y-m-d')."'");
				$site_offer_trans = $sql->row();
				$site_offer_trans_id = intval($site_offer_trans->id);
				//echo"<pre>";print_r($site_offer_trans_id);echo"</pre>";exit;
				/*******************************/
				/*** Post data to client ****/
				$this->db->select('offer_options,response_type,accepted_response_tag,accepted_response_value,offer_form,transfer_method,http_post_url,http_get_url,transfer_email,email_file_name,email_delimeter,ftp_host_name,ftp_login_name,ftp_login_password,ftp_file_name,ftp_delimeter,ftp_protocol,image_pixel_link,client_id');
				$this->db->where('id',$offer);
				$getOfferData = $this->db->get('offers');
				$getOfferData = $getOfferData->row();
				$client_response = "";
				$pattern = '';
				//echo"<pre>";print_r($_POST);echo"</pre>";
				//echo"<pre>";print_r($getOfferData);echo"</pre>";exit;
				//IF offer of popout then skip it
				if($getOfferData->offer_options=="opt_popout"){	continue; 	}
				/*****Check cleint response*****/
				switch ($getOfferData->response_type) {                    
					case "xml":
                        $value = (!empty($getOfferData->accepted_response_value) ? $getOfferData->accepted_response_value : "([\s\S]*)" );
						$pattern = "/<".$getOfferData->accepted_response_tag.">".$value."<\/".$getOfferData->accepted_response_tag.">/";
					break;
					case "json":
						$pattern = "/\"".$getOfferData->accepted_response_tag."\":[\s\S]\"".$getOfferData->accepted_response_value."\"/";
					break;
					default:
						$pattern = "/\b".$getOfferData->accepted_response_value."\b/";
					break;
				}
				/********* Prepare database array******/
					$tmp_offer_form = json_decode($getOfferData->offer_form);
					$total_fields_in_offer = count((array)$tmp_offer_form);
					$systemDbFields = array();$postFields = array();$otherDbField = array();$fixedDbField =array();
					//ECHO '<PRE>';PRINT_R($tmp_offer_form);print_r($_POST); //....last change 11/23/2017
					if($total_fields_in_offer>0){
						foreach ($tmp_offer_form as $tfield){
							if($tfield->system_field=="fixed"){
								$value = (isset($_POST['offer_'.$offer][$tfield->title]) ? $_POST['offer_'.$offer][$tfield->title] : "");
                                if($tfield -> fieldtype == "date-selector" && is_array($_POST['offer_'.$offer][$tfield->system_field])){                   
                                    $value = date($_POST['offer_'.$offer][$tfield->system_field]['format'],strtotime($_POST['offer_'.$offer][$tfield->system_field]['date'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['month'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['year']));
                                }else{
                                    if($tfield -> fieldtype == "checkbox"){
                                        if(!empty($tfield)){
                                            $value = implode(',',$_POST['offer_'.$offer][$tfield->title]);
                                        }
                                    }
                                }
								$fixedDbField[$tfield->title] = $value;
								$postFields[$tfield->title] = $value;
							}else if($tfield->system_field=="other"){
                                $value = (isset($_POST['offer_'.$offer][$tfield->title]) ? $_POST['offer_'.$offer][$tfield->title] : "");  //....last change 11/23/2017 (lable to title)
                                if($tfield -> fieldtype == "date-selector" && is_array($_POST['offer_'.$offer][$tfield->system_field]) && array_key_exists('day',$_POST['offer_'.$offer][$tfield->system_field]) && array_key_exists('month',$_POST['offer_'.$offer][$tfield->system_field]) && array_key_exists('year',$_POST['offer_'.$offer][$tfield->system_field]) && array_key_exists('format',$_POST['offer_'.$offer][$tfield->system_field])){                               
                                    $value = date($_POST['offer_'.$offer][$tfield->system_field]['format'],strtotime($_POST['offer_'.$offer][$tfield->system_field]['day'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['month'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['year']));
                                }else{
                                    if($tfield -> fieldtype == "checkbox"){
                                        if(!empty($tfield)){
                                            $value = implode(',',$_POST['offer_'.$offer][$tfield->label]);
                                        }
                                    }
                                }
								$otherDbField[$tfield->label] = $value;
								$postFields[$tfield->label] = $value;
							}else {
								if(is_array($_POST['offer_'.$offer][$tfield->system_field])){
                                    $value = '';
                                }else{
									$value = (isset($_POST['offer_'.$offer][$tfield->system_field]) ? $_POST['offer_'.$offer][$tfield->system_field] : "");
								}
								// WHEN DATE SELECTIONR
                                if($tfield->fieldtype == "date-selector" && is_array($_POST['offer_'.$offer][$tfield->system_field]) ){
									if(!empty($_POST['offer_'.$offer][$tfield->system_field]['format']) && !empty($_POST['offer_'.$offer][$tfield->system_field]['date']) && !empty($_POST['offer_'.$offer][$tfield->system_field]['month']) && !empty($_POST['offer_'.$offer][$tfield->system_field]['year'])){			
                                        $value = date($_POST['offer_'.$offer][$tfield->system_field]['format'],strtotime($_POST['offer_'.$offer][$tfield->system_field]['date'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['month'].'-'.$_POST['offer_'.$offer][$tfield->system_field]['year']));
                                    }
                                }else{                          
                                    if($tfield->fieldtype == "checkbox"){
                                        if(!empty($_POST['offer_'.$offer][$tfield->system_field])){
                                            $value = implode(',',$_POST['offer_'.$offer][$tfield->system_field]);
                                        }
                                    }
                                }
								$systemDbFields[$tfield->system_field] = $value;
								$postFields[$tfield->title] = $value;
							}
						}
					}
					//ECHO '<PRE>';PRINT_R($fixedDbField);print_r($otherDbField);print_r($postFields);EXIT; //....last change 11/23/2017
				/*************************************/
				$tmp_data = array();
				$tmp_data['site_offers_trans_id'] = $site_offer_trans_id;
				$tmp_data['offer_id']             = $offer;
				$tmp_data['client_id']            = $getOfferData->client_id;
				$tmp_data['date_created']         = date('Y-m-d H:i:s');
				switch ($getOfferData->transfer_method) {
					case "transfer_method_post":	
							$url = $getOfferData->http_post_url;							
							if(empty($url)) { continue;}
							
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							$client_response = $this->doPut($url,$req_data,"POST");
							$status  = 0;
							if($getOfferData->response_type == 'json'){
                                if($this -> checkJsonResponse($client_response,$getOfferData->accepted_response_tag,$getOfferData->accepted_response_value) == 1){
                                    $status  = 1;
                                }
                            }else{
                                if ($this->check_response(htmlentities($client_response),htmlentities($pattern))==1) 
                                {	$status  = 1; }	
                            }					
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $url."?".$req_data;
							$tmp_data['response_data']        = htmlentities($client_response);
							$tmp_data['status']               = $status;													
						break;
					case "transfer_method_get":
							$url = $getOfferData->http_get_url;
							if(empty($url)) { continue;}
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							$client_response = $this->doPut($url,$req_data,"GET");
							$status  = 0;
							if($getOfferData->response_type == 'json'){
                                if($this -> checkJsonResponse($client_response,$getOfferData->accepted_response_tag,$getOfferData->accepted_response_value) == 1){
                                    $status  = 1;
                                }
                            }else{
                                if ($this->check_response(htmlentities($client_response),htmlentities($pattern))==1) 
                                {	$status  = 1; }	
                            }
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $url."?".$req_data;
							$tmp_data['response_data']        = htmlentities($client_response);
							$tmp_data['status']               = $status;
						break;
					case "transfer_method_email":
							//echo"<pre>";print_r($_POST);echo"</pre>";exit('email');
							//if(empty($getOfferData->transfer_email)) { continue;}	
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $req_data;
							$tmp_data['response_data']        = '';
							$tmp_data['status']               = 1;
							//save data to ftp_data table
							$ftpdata = array();
							$ftpdata['offer_id'] = $offer;
							$ftpdata['request_data'] = $req_data;
							$ftpdata['date_created'] = date('Y-m-d H:i:s');
							$this->db->insert(FTP_DATA_TABLE,$ftpdata);
						break;
					case "transfer_method_ftp":
						//if(empty($getOfferData->ftp_host_name) || empty($getOfferData->ftp_login_name) || empty($getOfferData->ftp_login_password)){ continue;}
						$req_data = http_build_query($postFields);
						$req_data = str_replace('%5B0%5D=','=',$req_data);
						//Prepare Offer Trans Data
						$tmp_data['request_data']         = $req_data;
						$tmp_data['response_data']        = '';
						$tmp_data['status']               = 1;
						//save data to ftp_data table
						$ftpdata = array();
						$ftpdata['offer_id'] = $offer;
						$ftpdata['request_data'] = $req_data;
						$ftpdata['date_created'] = date('Y-m-d H:i:s');
						$this->db->insert(FTP_DATA_TABLE,$ftpdata);
						//echo"<pre>====>";print_r($_POST);echo"</pre>";exit('email');
						break;
					default:
						//echo"<pre>";print_r($_POST);echo"</pre>";exit('default');
						break;
				}				
				//echo"<pre>";print_r($tmp_data);echo"</pre>";
				$this->db->insert(OFFER_TRANS_TABLE,$tmp_data);				
				/***************************/
				/**** UPDATE SUBMIT COUNT IN SITE TRANS TABLE****/
				$this->db->query("UPDATE ".SITE_OFFERS_TRANS_TABLE." SET `submitted`=submitted+1 WHERE id='".$site_offer_trans_id."'");
				/*************************************************/
			 	/*echo"<pre>";print_r($systemDbFields);echo"</pre>";
				echo"<pre>";print_r($postFields);echo"</pre>";
				echo"<pre>";print_r($otherDbField);echo"</pre>";
				echo"<pre>";print_r($tmp_offer_form);echo"</pre>";exit;*/ 
				$dbfields                         = $systemDbFields;
				$dbfields['other']                = json_encode($otherDbField);
				$dbfields['fixed']                = json_encode($fixedDbField);
				$dbfields['site_offers_trans_id'] = $site_offer_trans_id;
				$dbfields['offer_id'] = $offer;
				$dbfields['date_created']         = date('Y-m-d H:i:s');
				$batch_data[] =$dbfields;
				$this->db->insert(OFFER_DATA_TABLE,$dbfields);
				//echo"<pre>";print_r($dbfields);echo"</pre>";exit;
                $i_id = $this->db->insert_id();
                /**
				 * @since : 11 july 5:40 pm
				 * if double_opt than send confirmation mail to the customer and id offer data inserted then pass id to change flag in offer_data table
				 */
				if($getOfferData->offer_options=="double_opt" && $i_id && isset($tmp_data['status']) && ($tmp_data['status'] == '1')) {
				    /**
					 * @since : 12 july 2016 11:20 PM
					 * @modification :* send email to the user.
					 ** this mail contain confirmation link.
					 ** confirmation link is open the page which confirm the user registration and it contain image pixel.
					 *
					/**
					 * @since : 13 july 2016 
					 * @modification :  isset() and !empty() condition added
                     */
					  $s_string='';$s_user_name='';
                      if(isset($_POST['offer_'.$offer]['so_email']) && !empty($_POST['offer_'.$offer]['so_email'])){
					     $s_string = 'so_';
					  }					 
					  if(isset($_POST['offer_'.$offer][$s_string.'email']) && !empty($_POST['offer_'.$offer][$s_string.'email'])){
				         $this->email_to_client($_POST['offer_'.$offer][$s_string.'email'],$getOfferData->http_post_url,$offer,$i_id,$s_user_name,$getOfferData->image_pixel_link);
                      }
				}
			}
		}
		//EXIT;
		//echo"<pre>";print_r($batch_data);echo"</pre>";exit;
		//BATCH INSERT START
		//$this->db->insert_batch(OFFER_DATA_TABLE,$batch_data);		
		$b_flag = 0;
		$so_stage_exit=0;
		if(isset($_REQUEST['so_stage_exit'])){
			$so_stage_exit = $_REQUEST['so_stage_exit']+1;
		}
		//$so_stage_exit ='';
		if(isset($_REQUEST['so_offer_shown'])){
			$offer_shown = $_REQUEST['so_offer_shown'];
		}
		$firstformelementsvalue = !empty($_POST['firstformelementsvalue']) ? '?'.$_POST['firstformelementsvalue'] : '';
		$site_id =0;
		$site_id = $_REQUEST['site_id'] ? $_REQUEST['site_id'] : 0;
        $t_result = $this->db->query('SELECT CONCAT(prime_offers,",",regular_offers) as offers,so_stage_exit FROM mysites WHERE id = '.base64_decode($site_id));
        $t_result = $t_result->result_array();  
        if(!empty($t_result)){
			if($t_result[0]['so_stage_exit'] > $so_stage_exit){ // IF STAGE IS LESS THAN SO_STAGE_EXIT (DB) THEN CONTINUE..OTHER WISE SEND IT TO REDIRECT URL.
				$prime_offers = array_diff(explode(',',ltrim(rtrim($t_result[0]['offers'],","),",")),explode(',',$offer_shown));
				if(!empty($prime_offers)){
					$b_flag = 1;
				}
			}
        }
		
        if($b_flag == 1){
            $redirect_url = explode('?',$_SERVER['HTTP_REFERER']);
            if(!empty($redirect_url)){
                $redirect_url = $redirect_url[0];
            }
			/**
			 * @Since : 12/01/2017 (14:25)
			 * @Description : get the parameters of '$_GET' for pass to the return value.
			 */ 
			$s_return_parameters = '?so_offer_shown='.$offer_shown.'&so_stage_exit='.$so_stage_exit .'&'.http_build_query($_GET);
        }else{
			$s_return_parameters =  $firstformelementsvalue;
            $redirect_url = str_replace("~", "/", $_POST['so_redirect_url']);
        }
		redirect($redirect_url.$s_return_parameters);exit;
	}
	/*
	 * thank you page
	 */
	public function thank_you(){
		$data['page_title'] = "Thank you page";
		$this->template->load('template_thankyou','offer/thank_you',$data);		
	}
	public function thank_you1(){
		$data['page_title'] = "Thank you page 1";
		$this->template->load('template_thankyou','offer/thank_you',$data);
	}
	/*
	 * PASS SYSTEM FIELDS TO JS
	 */
	public function get_system_fields($count){
		$sel = "<select name='userform[field_".$count."][system_field]' required>";
		//echo"<pre>";print_r($GLOBALS['SYSTEM_FIELDS']);echo"</pre>";
		$sel .= "<option value='other'>Select System Field</option>";
		foreach ($GLOBALS['SYSTEM_FIELDS'] as $key=>$value)
		{
			$sel .= "<option value='".$key."'>".$value."</option>";		
		}
		$sel .= "</select>";
		echo $sel;
	} 
	/**
	 * @since : 12 july 2016
	 * @modification : this page is redirect to the confirmation page which is call by the confirmation link of the email content.
	 */
	 function showConfirmation($i_offer_id=''){
	    if(!empty($i_offer_id)){
            if(isset($_GET['od']) && !empty($_GET['od'])){
                $dbdata['double_opt_in_checked'] = '1';
                $this->db->where('id',$_GET['od']);
				$sql = $this->db->update("offer_data",$dbdata);
            }
			$this->db->select('image_pixel_link,http_post_url,http_get_url,transfer_email,email_file_name,email_delimeter,ftp_host_name,ftp_login_name,ftp_login_password,ftp_file_name,ftp_delimeter');
			$this->db->where('id',$i_offer_id);
			$getOfferData = $this->db->get('offers');
			$getOfferData = $getOfferData->row();
			//$this->session->set_flashdata('getOfferData',$getOfferData);
			$this->load->view('offer/confirmation',$getOfferData);		
	    }
	}
	/*
	 * Send data through cURL
	 * $url = string
	 * $data = string  Like "x=10&y=20";
	 * $method "GET" or "POST"
	 */
	public function doPut($url,$data,$method){
		$qry_str = $data;
		$ch = curl_init();
		if($method=="POST"){
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, '3');
			// Set request method to POST
			curl_setopt($ch, CURLOPT_POST, 1);
			// Set query data here with CURLOPT_POSTFIELDS
			curl_setopt($ch, CURLOPT_POSTFIELDS, $qry_str);
		}else{
			// Set query data here with the URL
			curl_setopt($ch, CURLOPT_URL, $url."?".$qry_str);			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, '3');
		}
		$content = trim(curl_exec($ch));
		curl_close($ch);
		//echo"<pre>";print_r($data);echo"</pre>";
		//echo"<pre>";print_r($content);echo"</pre>";exit;
		return $content;
	}
	/*
	 * Pregmatch client response
	 */
	public function check_response($source,$substring){
		if (preg_match($substring,$source,$array)){
			return 1;
		}else{ 
			return 0;
		}
		exit('123');	
	}
    function search($array, $key, $value){
        $results = array();
        if (is_array($array)) {
            if (isset($array[$key]) && ((!empty($value) && $array[$key] == $value) || (empty($value)))) {
                $results[] = $array;
            }
            foreach ($array as $subarray) {
                $results = array_merge($results, $this -> search($subarray, $key, $value));
            }
        }
        return $results;
    }
    function checkJsonResponse($response,$key,$value=''){
        $arr = json_decode($response,true);
        $return_array = $this -> search($arr,$key,$value);                
        if(!empty($return_array)){
            return 1;
        }else{
            return 0;
        }
        exit;
    }
    /* Test Offer Working And Response */
    public function testOffer($i_id=null){        
		$data = [];
        if(isset($_POST) && !empty($_POST)){
				$offer = $i_id;
				/*** Post data to client ****/
				$this->db->select('id,offer_name,offer_options,response_type,accepted_response_tag,accepted_response_value,offer_form,transfer_method,http_post_url,http_get_url,transfer_email,email_file_name,email_delimeter,ftp_host_name,ftp_login_name,ftp_login_password,ftp_file_name,ftp_delimeter,image_pixel_link');
				$this->db->where('id',$offer);
				$getOfferData = $this->db->get('offers');
				$getOfferData = $getOfferData->row();
				$client_response = "";
				$pattern = '';
				//echo '<pre>';print_r($_POST);
				/*****Check cleint response*****/
				switch ($getOfferData->response_type) {
					case "xml":
						$pattern = "/<".$getOfferData->accepted_response_tag.">".$getOfferData->accepted_response_value."<\/".$getOfferData->accepted_response_tag.">/";
					break;
					
					case "json":
						$pattern = "/\"".$getOfferData->accepted_response_tag."\":[\s\S]\"".$getOfferData->accepted_response_value."\"/";
					break;
						
					default:
						$pattern = "/\b".$getOfferData->accepted_response_value."\b/";
					break;
				}
                /********* Prepare database array******/
                $tmp_offer_form = json_decode($getOfferData->offer_form);
				//echo '<pre>';print_r($tmp_offer_form);
                $systemDbFields = array();
                $postFields = array();
                $otherDbField ='';
                if(count($_POST)>0) {
                    foreach ($_POST as $s_key => $sfield){
						//echo '<pre>';print_r($sfield);
                        if($s_key!="other"){
							if(is_array($_POST[$s_key]) && array_key_exists('date',$_POST[$s_key]) && array_key_exists('month',$_POST[$s_key]) && array_key_exists('year',$_POST[$s_key]) && array_key_exists('format',$_POST[$s_key])){    
								if(!empty($_POST[$s_key]['format']) && !empty($_POST[$s_key]['date']) && !empty($_POST[$s_key]['month']) && !empty($_POST[$s_key]['year'])){
                                    $postFields[str_replace('so_','',$s_key)] = date($_POST[$s_key]['format'],strtotime($_POST[$s_key]['date'].'-'.$_POST[$s_key]['month'].'-'.$_POST[$s_key]['year']));
                                }else{
                                    $postFields[str_replace('so_','',$s_key)] = '';
                                }
                            }else{
                                $postFields[str_replace('so_','',$s_key)] = $sfield;
                            }
                        }
                    }
                }
				$req_data = http_build_query($postFields);
				$req_data = str_replace('%5B0%5D=','=',$req_data);
				//echo '<pre>';print_r($postFields);print_r($req_data);exit;
				/*************************************/
				$tmp_data = array();
				$tmp_data['offer_id']             = $offer;
				//$tmp_data['offer_name']         = $getOfferData->offer_name;
				$tmp_data['date_created']         = date('Y-m-d H:i:s');
				$tmp_data['site_offers_trans_id']         = 1;
				$tmp_data['client_id']         = 1;
				switch ($getOfferData->transfer_method) {
					case "transfer_method_post":
							//echo 'test123';exit;
							//$tmp_data['send_url'] = $getOfferData->http_post_url;
							$url = $getOfferData->http_post_url;							
							if(empty($url)) { continue;}
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							//$tmp_data['send_url'] = $tmp_data['send_url'].'?'.$req_data;
							$client_response = $this->doPut($url,$req_data,"POST");
							$status  = 0;
							if($getOfferData->response_type == 'json'){
                                if($this -> checkJsonResponse($client_response,$getOfferData->accepted_response_tag,$getOfferData->accepted_response_value) == 1){
                                    $status  = 1;
                                }
                            }else{
                                if ($this->check_response(htmlentities($client_response),htmlentities($pattern))==1) 
                                {	$status  = 1; }	
                            }
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $url."?".$req_data;
							$tmp_data['response_data']        = utf8_encode($client_response);
							//$tmp_data['response_data']        = '';
							$tmp_data['status']               = $status;													
						break;
					
					case "transfer_method_get":			
							//$tmp_data['send_url'] = $getOfferData->http_get_url;
							$url = $getOfferData->http_get_url;
							if(empty($url)) { continue;}
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							//$tmp_data['send_url'] = $tmp_data['send_url'].'?'.$req_data;
							$client_response = $this->doPut($url,$req_data,"GET");
							$status  = 0;
                            if($getOfferData->response_type == 'json'){
                                if($this -> checkJsonResponse($client_response,$getOfferData->accepted_response_tag,$getOfferData->accepted_response_value) == 1){
                                    $status  = 1;
                                }
                            }else{
                                if ($this->check_response(htmlentities($client_response),htmlentities($pattern))==1) 
                                {	$status  = 1; }	
                            }                        
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $url."?".$req_data;
							$tmp_data['response_data']        = utf8_encode($client_response);
							$tmp_data['status']               = $status;
						break;
					case "transfer_method_email":
							if(empty($getOfferData->transfer_email)) { continue;}	
							$req_data = http_build_query($postFields);
							$req_data = str_replace('%5B0%5D=','=',$req_data);
							//Prepare Offer Trans Data
							$tmp_data['request_data']         = $req_data;
							$tmp_data['response_data']        = '';
							$tmp_data['status']               = 1;
							//save data to ftp_data table
							$ftpdata = array();
							$ftpdata['offer_id'] = $offer;
							$ftpdata['request_data'] = $req_data;
							$ftpdata['date_created'] = date('Y-m-d H:i:s');
							$this->db->insert(FTP_DATA_TABLE,$ftpdata);						
						break;
					case "transfer_method_ftp":
						//echo"<pre>";print_r($_POST);echo"</pre>";exit('email');
						if(empty($getOfferData->ftp_host_name) || empty($getOfferData->ftp_login_name) || empty($getOfferData->ftp_login_password) ) { continue;}
						$req_data = http_build_query($postFields);
						$req_data = str_replace('%5B0%5D=','=',$req_data);
						//Prepare Offer Trans Data
						$tmp_data['request_data']         = $req_data;
						$tmp_data['response_data']        = '';
						$tmp_data['status']               = 1;
						//save data to ftp_data table
						$ftpdata = array();
						$ftpdata['offer_id'] = $offer;
						$ftpdata['request_data'] = $req_data;
						$ftpdata['date_created'] = date('Y-m-d H:i:s');
						$this->db->insert(FTP_DATA_TABLE,$ftpdata);
						break;
					default:
						break;
				}
				/**
				 * @since : 09-11-2016 10:25 AM
				 * if double_opt than send confirmation mail to the customer and id offer data inserted then pass id to change flag in offer_data table
				 */
				 $s_user_name = '';
				if($getOfferData->offer_options=="double_opt" && $i_id && isset($tmp_data['status']) && ($tmp_data['status'] == '1')){				 
                  if(isset($_POST['email']) && !empty($_POST['email'])){
                     $this -> email_to_client($_POST['email'],$getOfferData->http_post_url,$offer,$i_id,$s_user_name,$getOfferData->image_pixel_link,1);
                  }
				}  				
                $data['result'] = $tmp_data;
				//echo '<pre>';print_r($tmp_data);
				$this->db->insert(OFFER_TRANS_TABLE,$tmp_data);
                $this->load->view('offer/testOfferResult',$data);
        }else{
            if($i_id){
                $this->db->select('id,offer_name,offer_image,offer_options,response_type,accepted_response_tag,accepted_response_value,offer_form,transfer_method,http_post_url,http_get_url,transfer_email,email_file_name,email_delimeter,ftp_host_name,ftp_login_name,ftp_login_password,ftp_file_name,ftp_delimeter,offer_content');
				$this->db->where('id',$i_id);
				$getOfferData = $this->db->get('offers');
				$data['result'] = $getOfferData->row();
            }
            $this->load->view('offer/testOffer',$data);
        }
    }
	/**
	 * @since : 7 july 2016 
	 * @functionality : function for send confirmation mail 
	 *
     * Global send email function
     * $to  var [For ex. to@mail.com | you can also pass array of email address]
     * $from  var [For ex. from@mail.com]
     * $fromname  var [For ex. fromname]
     * $subject
     * $message
     * $message_type int [For ex. 1-HTML MAIL, 2- SIMPLE MAIL]
     * $header var
     * $attachment var [path to file]
     * $cc var of cc email address [ you can also pass array of email address]
     * $bcc var of bcc email address [ you can also pass array of email address]
     * $emailType  Set Email Type [For ex 1-SIMPLE ,2-SMTP]
     */
	private function email_to_client($s_email,$s_post_url,$i_offer_id,$i_offer_data_id,$s_user_name='',$s_image_pixel_link='',$i_test_flag = 0){
		$s_confirmation_link = base_url().'user/showConfirmation/'.$i_offer_id.'?od='.$i_offer_data_id.'&tf='.$i_test_flag;
	     $s_email_template = '</br><div><div style="background:rgb(234, 234, 234);border:1px solid #ddd;-webkit-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);-moz-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);border-top-left-radius:10px;
border-top-right-radius:10px;">';
        $s_email_template .= '<div style="height:20px;border-top-left-radius:10px;border-top-right-radius:10px;"></div><div style="padding:0px 20px;"><div style="text-align:left;position:relative;top:0px;line-height:40px;"></div><div style="padding-bottom:20px;">';
		$s_email_template .='<div style=3D"padding:10px;margin-top:10px;clear:both;"><p>Hello, Thank You For Registration.</p>';
		$s_email_template .='<p style="line-height: 22px;margin:30px 0 0;color:#000;font-size:14px;"><a href="'.$s_confirmation_link.'" style="font-size:17px;color:#9A3E3E; text-decoration: underline; font-weight:bold;" target="_blank"><u>click on Confirmation link</u></a></p>';
		$s_email_template .= '</div><p style="color:#666;font-size:16px;margin-top:40px;">Best Regards,</p></div></div></div></div>';
		$email_data['to'] = $s_email;
		$email_data['emailType'] = 2;
		$email_data['message_type'] = 1;
		$email_data['subject'] = SITE_TITLE." Confirmation Mail";
		$email_data['message'] = $s_email_template;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		mail($s_email,SITE_TITLE." Confirmation Mail",$s_email_template,$headers);
		//global_send_email($email_data);
        return;		
	}
}