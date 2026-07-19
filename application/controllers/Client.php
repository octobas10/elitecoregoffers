<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Mysites_model');
		check_login();
	}
	/*
	 * Add new site 
	 */
	public function index($id=null){
		//GET OFFER NAMES
		/*$this->db->select('id,offer_name');
		$getoffers = $this->db->get('offers');
		$getoffers = $getoffers->result();
		$offer_list = array();
		foreach ($getoffers as $value){
			$offer_list[$value->id] = $value->offer_name;
		}
		$data['offer_list'] = $offer_list;*/
		if($id){
			$data['page_title'] = "Add New Client";
			//GET SITE DETAILS BY ID
			$this->db->where('id',$id);
			$sql = $this->db->get('clients');
			$getrow = $sql->row();
			$data['result'] = $getrow;
			//echo"<pre>";print_r($getoffers);echo"</pre>";
		}else{
			$data['page_title'] = "Update Client";
		}
		$this->template->load('template_default','clients/add_new_client',$data);
	}
	
	/*
	 * Save site data to database
	 */
	public function add_client($id=null)
	{
		if($id){
			$this->db->where('id',$id);
			$sql = $this->db->update('clients',$_POST);
		}else{
			$_POST['date_created'] = date('Y-m-d H:i:s');
			$sql = $this->db->insert('clients',$_POST);
		}
		if($sql){	$this->session->set_flashdata('succ-msg',"Data saved successfully");	}
		else {	$this->session->set_flashdata('err-msg',"Some error occurs during database operation");	}
		
		redirect(base_url()."client/list_clients");	exit;	
	}
	/*
	 * List sites
	 */
	public function list_clients()
	{
		$data['page_title'] = "List Clients";
		//Get site list
		$list_clients = $this->General_model->get_records("clients",array('id'=>'ASC'));
		$data['list_clients'] = $list_clients;
		//echo"<pre>";print_r($list_sites);echo"</pre>";exit;
		$this->template->load('template_default','clients/list_clients',$data);
	}
	/*
	 * List offers by client
	 */
	public function list_offers_by_client($id=null){
		//Get site list
		//$list_clients = $this->General_model->get_records("offers",array('id'=>'ASC'),array('id'),array('id'=>$id));
		$this->db->select('offers.id, offers.offer_name')
         ->from('clients')
         ->join('offers', 'clients.id = offers.client_id ')
		 ->where('offers.client_id',$id);
		$query = $this->db->get();
		$result = $query->result();
		$json['success'] = 'accepted';
		$json['count'] = sizeof($result);
		$json['result'] = $result;
		$header = array('Content-Type: application/xml');
		print_r(json_encode($json));
		exit;
		//echo $this->db->last_query();exit;
	}
	public function check_clientname()
	{
		$this->db->where('client_name',$_GET['client_name']);
		if($_GET['data_id']){	
		$this->db->where('id !=',$_GET['data_id']); }
		$this->db->from('clients');
		$result = $this->db->count_all_results();
		if($result>0)
			echo"false";
		else
			echo"true";
		exit;
	}
	/*
	 * Delete client
	 */
	public function delete_client($id)
	{
		$this->db->where('id',$id);
		$sql = $this->db->delete('clients');
		if($sql){
			//update site offer list
			$this->Mysites_model->update_mysites_offers();
			$this->session->set_flashdata('succ-msg',"Client deleted successfully");
		}else{
			$this->session->set_flashdata('err-msg',"Error while deleting client");
		}
		redirect(base_url().'client/list_clients');
	}
}
