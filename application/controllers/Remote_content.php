<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Remote_content extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
	}
	public function index(){
		$site_id = $_GET['so_site_id'];
        $so_other_form = isset($_GET['so_other_form'])? $_GET['so_other_form'] : '';
        $t_posted_array = array();            
		$t_temp_array = array();
        if(isset($_GET['request_id']) && !empty($_GET['request_id'])){           
            $t_data = $this -> db -> query('SELECT id,request_data FROM offer_requests WHERE id = '.$_GET['request_id']);
            $t_data = $t_data->result_array();
            if(!empty($t_data)){
                foreach($t_data as $o_data){                    
                    $t_temp_array = ((array)json_decode($o_data['request_data']));
                    $this->db->where('id', $o_data['id']);
                    $this->db->delete('offer_requests'); 
                }
            }
            if(!empty($t_temp_array)){
                $t_site_keys = $this->db->query('SELECT msk.site_id,msk.key_text,msk.key,msk.key_value FROM mysite_data_key msk WHERE msk.site_id = '.$site_id.' AND msk.delete_status != 1');
                $t_site_keys = $t_site_keys->result_array();                
                if(!empty($t_site_keys)){
                    foreach($t_site_keys as $t_keys){
						if($t_keys['key'] == 'other'){ 
							if(isset($t_temp_array[$t_keys['key_value']])){
								$new_other_key = $t_keys['key'].'_'.$t_keys['key_value'];
                                $t_posted_array[$new_other_key] = $t_temp_array[$t_keys['key_value']];
                            }
                        }else if($t_keys['key'] == 'other_date_format'){
                            if(!empty($t_keys['key_value'])){
                                $t_date_details = explode('###',$t_keys['key_value']);
                                if(!empty($t_date_details) && count($t_date_details) == 3){
                                    if(isset($t_date_details[0]) && isset($t_temp_array[$t_date_details[0]])){
                                        //$t_posted_array['dob_day'] = $t_temp_array[$t_date_details[0]];
                                        $t_posted_array[$t_date_details[0]] = $t_temp_array[$t_date_details[0]];
                                    }
                                    if(isset($t_date_details[1]) && isset($t_temp_array[$t_date_details[1]])){
                                        //$t_posted_array['dob_month'] = $t_temp_array[$t_date_details[1]];
										$t_posted_array[$t_date_details[1]] = $t_temp_array[$t_date_details[1]];
                                    }
                                    if(isset($t_date_details[2]) && isset($t_temp_array[$t_date_details[2]])){
                                        //$t_posted_array['dob_year'] = $t_temp_array[$t_date_details[2]];
                                        $t_posted_array[$t_date_details[2]] = $t_temp_array[$t_date_details[2]];
                                    }
                                }
                            }
                        }else{
                            if(isset($t_temp_array[$t_keys['key_value']])){
                                $t_posted_array[$t_keys['key']] = $t_temp_array[$t_keys['key_value']];
                            }
                        }
                    }
                }
            }
        }
		//Get offers from Site ID
		$this->db->where('id',$site_id);
		$res = $this->db->get("mysites");
		$site_details = $res->row_array();
        //mail('octobas@gmail.com','regular offers',json_encode($site_details));
		$data['site_detail'] = $site_details;
		//prepare offer ids
		$so_offer_shown = (!empty($_GET['so_offer_shown'])) ? $_GET['so_offer_shown'] : 0;
		//$data['so_offer_shown'] = $so_offer_shown;
		$so_offer_shown = explode(',',$so_offer_shown);
		$prime_offers   = explode(',',$site_details['prime_offers']);
		$regular_offers = explode(',',$site_details['regular_offers']);
		$prime_offers   = array_diff($prime_offers,$so_offer_shown);
		$regular_offers = array_diff($regular_offers,$so_offer_shown);
        if($site_details['po_seq_random'] == '1'){
            shuffle($prime_offers);
        }
        if($site_details['ro_seq_random'] == '1'){
            shuffle($regular_offers);
        }
		$prime_offers   = array_slice($prime_offers,0,$site_details['prime_offer_show'],true);
		$regular_offers = array_slice($regular_offers,0,$site_details['regular_offer_show'],true);
		//GET OFFER DATA
		$data['list_offer'] = '';
		$prepare_offer_id = array_merge($prime_offers,$regular_offers);
		$prepare_offer_id = array_map('trim',$prepare_offer_id);
		$prepare_offer_id = array_filter($prepare_offer_id);
        //mail('octobas@gmail.com','regular offers',json_encode($prepare_offer_id));
		$prepare_offer_count = count($prepare_offer_id);
		$t_skipped_offer = [];
		if($prepare_offer_count > 0){
            //$s_condition = '(SELECT DISTINCT(offer_id) FROM offer_io_management WHERE offer_id in ('.implode(',',$prepare_offer_id).') AND so_start_date<= "'.date('Y-m-d').'" AND so_end_date>= "'.date('Y-m-d').'" )';
			$sql = "SELECT * FROM offers WHERE id IN (".implode(',',$prepare_offer_id).") ORDER BY FIELD(id,".implode(',',$prepare_offer_id).")";
			$result = $this->db->query($sql);
            //mail('octobas@gmail.com','query offers',$sql);
			$result = $result->result_array();
			if(count($result)>0){
                $t_available_offer_to_display = [];
				// Save data how many times offer displayed on page
				foreach ($result as $key => $offerdata){
                    // If offer will not displayed then continue to next offer after skipping current offer
                    if($this->checkForDisplay($offerdata) == false){
						$t_skipped_offer[] = $offerdata['id'];
                        continue;
                    }
                    $t_available_offer_to_display[] = $offerdata;
					$oid = $offerdata['id'];
					$sid = $data['site_detail']['id'];
					$sql = $this->db->query("INSERT INTO `".SITE_OFFERS_TRANS_TABLE."`(`site_id`, `offer_id`, `displayed`,`date_created`) VALUES ('".$sid."', '".$oid."','1','".date('Y-m-d')."') ON DUPLICATE KEY UPDATE displayed=displayed+1");
					//echo"<pre>";print_r($this->db->last_query());echo"</pre>";exit;
				}
                if(!empty($t_available_offer_to_display)){
                    $data['list_offer'] = $t_available_offer_to_display;
                }
                //mail('octobas@gmail.com','available offers',json_encode($t_available_offer_to_display));
			}
		}	
		$data['request_id'] = isset($_GET['request_id']) ? $_GET['request_id'] : '';
		$data['skipped_offer'] = $t_skipped_offer;
		$data['so_ip'] = $_SERVER['REMOTE_ADDR'];
		$data['t_posted_array'] = $t_posted_array;
        $data['t_temp_array'] = $t_temp_array;
		$data['so_other_form'] = $so_other_form;
		foreach ($_GET as $k=>$v){
			$data[$k] = $v;	
		}
		$this->load->view('remote/index',$data);
	}
	function getMysiteKey(){
        if(isset($_POST['request_data']) && !empty($_POST['request_data'])){
            $t_io_data = array(
                'request_data'=>$_POST['request_data'],
            );
            $this->db->insert('offer_requests',$t_io_data);
            echo $this->db->insert_id();exit;            
        }
        echo 0;
    }
    // Check for displaying offer
    private function checkForDisplay($t_offer){
        $b_return = false;
        if(!empty($t_offer)){
            $sql = 'SELECT so_start_date,so_end_date,so_daily,so_weekly,so_monthly,so_total FROM offer_io_management WHERE offer_id = '.$t_offer['id'].' and so_start_date<= "'.date('Y-m-d').'" AND so_end_date>= "'.date('Y-m-d').'"';
            //mail('octobas@gmail.com','qry offers',json_encode($sql));
            $t_result = $this->db->query($sql);
			$t_result = $t_result->result_array();
            $t_offer_displayed_result = $this->db->query('SELECT IFNULL(SUM(displayed),0) as displayed FROM site_offers_trans WHERE offer_id = '.$t_offer['id']);
			$t_offer_displayed_result = $t_offer_displayed_result->result_array();
            if(!empty($t_result)){
                foreach($t_result as $t_data){
                    // Check for total display counter
                    if($t_data['so_total'] == '-1'){
                        $b_return = true;
                        break;
                    }else{
                        if($t_data['so_total'] == 0){
                            // if daily any number of time offer will be displayed
                            $b_display = false;
                            if(intval($t_data['so_daily']) == -1){
                                $b_display = true;
                            }else{
                                if(intval($t_data['so_daily']) > 0){
                                    $t_daily_displayed_result = $this->db->query('SELECT IFNULL(SUM(displayed),0) as displayed FROM site_offers_trans WHERE offer_id = '.$t_offer['id'].' and date_created = "'.date('Y-m-d').'" ');
                                    $t_daily_displayed_result = $t_daily_displayed_result->result_array();
                                    if(!empty($t_daily_displayed_result)){
                                        if(intval($t_data['so_daily']) > $t_daily_displayed_result[0]['displayed']){
                                            $b_display = true;
                                        }else{
                                            // Continue to Check next io management detail
                                            continue;
                                        }
                                    }
                                }
                            }
                            // Check For Current Week Display if daily offer display available
                            if($b_display == true){                                
                                if(intval($t_data['so_weekly']) == -1){
                                    $b_display = true;
                                }else{                                    
                                    $week_start_date = date('Y-m-d', strtotime( 'monday this week' ));
                                    $week_end_date = date('Y-m-d', strtotime( 'sunday this week' ));
                                    $t_weekly_displayed_result = $this->db->query('SELECT IFNULL(SUM(displayed),0) as displayed FROM site_offers_trans WHERE offer_id = '.$t_offer['id'].' and date_created <= "'.$week_end_date.'" AND date_created >= "'.$week_start_date.'" ');
                                    $t_weekly_displayed_result = $t_weekly_displayed_result->result_array();
                                    if(!empty($t_weekly_displayed_result)){
                                        if(intval($t_data['so_weekly']) > $t_weekly_displayed_result[0]['displayed']){
                                            $b_display = true;
                                        }else{
                                            // Continue to Check next io management detail
                                            continue;
                                        }
                                    }
                                }
                            }
                            // Check For Current Month Display if daily and weekly offer display available
                            if($b_display == true){                                
                                if(intval($t_data['so_monthly']) == -1){
                                    $b_display = true;
                                }else{                                    
                                    $current_month_year = date('Y-m');
                                    $t_monthly_displayed_result = $this->db->query('select ifnull(sum(displayed),0) as displayed from site_offers_trans where offer_id = '.$t_offer['id'].' and date_format(date_created,"%Y-%m") = "'.$current_month_year.'" ');
                                    $t_monthly_displayed_result = $t_monthly_displayed_result->result_array();
                                    if(!empty($t_monthly_displayed_result)){
                                        if(intval($t_data['so_monthly']) > $t_monthly_displayed_result[0]['displayed']){
                                            $b_display = true;
                                        }else{
                                            // Continue to Check next io management detail
                                            continue;
                                        }
                                    }
                                }
                            }
                            // Return Offer Display After Checked For Daily,Monthly,Weekly
                            return $b_display;
                        }else if(intval($t_data['so_total']) >= 0){
                            if(!empty($t_offer_displayed_result)){
                                if(intval($t_data['so_total']) > $t_offer_displayed_result[0]['displayed']){
                                    // If displayed counter is smalled than total counter
                                    $b_return = true;
                                    break;
                                }
                            }else{
                                // If not displayed single time
                                $b_return = true;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $b_return;
    }
	/*
	 * Function for popout
	 */
	public function popout(){
		$oid = $_GET['oid'];
		$sid = $_GET['sid'];
		$url = $_GET['url'];
		//Make offer as submitted once it opened
		$this->db->where('site_id',$sid);
		$this->db->where('offer_id',$oid);
		$this->db->where('date_created',date('Y-m-d'));
		$this->db->set('submitted','submitted+1',false);
		$this->db->update(SITE_OFFERS_TRANS_TABLE);
		//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
		//echo"<pre>";print_r($_REQUEST);echo"</pre>";exit;
		if(!empty($url)){	
			redirect($url);
		}
	}
}
