<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
		check_login();
	}
	public function index(){
	}
	/*
	 * Function for list offer data
	 */
	public function list_offer_data(){
		$data['page_title'] ='Offer Data';
		$where = array();
		/****HANDLE POST DATA*******/
		if(isset($_POST) && !empty($_POST)){
			//echo"<pre>";print_r($_POST);echo"</pre>";exit;
			$data['daterange'] = $_POST['daterange'];
			$daterange = explode("TO",$_POST['daterange']);
			$startdate = trim($daterange[0]);
			$enddate   = trim($daterange[1]);
			if(!empty($_POST['search_offer_data'])){
				$search_term = $_POST['search_offer_data'];
				$data['search_offer_data'] = $_POST['search_offer_data'];
				$or_where  = "( so_first_name LIKE '%".$search_term."%' OR ";
				$or_where .= " so_last_name LIKE '%".$search_term."%' OR ";
				$or_where .=" so_email LIKE '%".$search_term."%' OR ";
				$or_where .=" so_homephone LIKE '%".$search_term."%' OR ";
				$or_where .=" so_zipcode LIKE '%".$search_term."%' )";
				$where[] = $or_where;
			}
			if($startdate==$enddate){
				$where[] = " date_created>='".$startdate." 00:00:00' AND date_created <='".$startdate." 23:59:59' ";
			}else{
				$where[] = " date_created>='".$startdate." 00:00:00' AND date_created <='".$enddate." 23:59:59' ";
			}
		}else{
			$startdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-30,date('Y')));
			$enddate = date('Y-m-d',mktime(23,59,59,date('m'),date('d'),date('Y')));
			$data['daterange'] = $startdate.' TO '.$enddate;
			if($startdate==$enddate){
				$where[] = " date_created>='".$startdate." 00:00:00' AND date_created <='".$startdate." 23:59:59' ";
			}else{
				$where[] = " date_created>='".$startdate." 00:00:00' AND date_created <='".$enddate." 23:59:59' ";
			}
		}
		if(!empty($where)){
			$where = " WHERE ".implode(" AND ", $where);
		}
		/**************************/
		/********pagination*********/
		$this->load->library('pagination');		
		$config['base_url'] = base_url().'reports/list_offer_data';
		$config['per_page'] = 20;
		$get_pagenum = $this->uri->segment(3);
		$page_num = (!empty($get_pagenum)) ? $get_pagenum : 0;
		/***************************/
		/***** DATABASE OPERATION *********/
		$limit = " LIMIT ".$page_num.",".$config['per_page'];
		$sql = "SELECT ODT.* FROM ".OFFER_DATA_TABLE." AS ODT".$where.$limit;
		//echo $sql;//exit;
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result();
		$total_count = $this->db->query("SELECT count(id) as total FROM ".OFFER_DATA_TABLE.$where);
		/*********************************/
		/********pagination*********/
		$config['total_rows'] = $total_count->row()->total;
		$this->pagination->initialize($config);
		$page_links = $this->pagination->create_links();
		/**************************/
		$data['page_link'] =$page_links;
		//echo"<pre>";print_r($data);echo"</pre>";
		$data['total_rows'] = $config['total_rows'];
		$data['showing_rows'] = count($data['result']);		
		$this->template->load('template_default','reports/list_offer_data',$data);
	}
	/*
	 * Function for list offer data
	 */
	public function list_client_trans(){
		$data['page_title'] ='Client Transactions';
		$where = array();
		/*Get offer list*/
		$this->db->select('id,offer_name');
		$get_offerlist = $this->db->get('offers');
		$get_offerlist = $get_offerlist->result();
		$offerlist = array();
		if(count($get_offerlist)>0){
			foreach ($get_offerlist as $off){
				$offerlist[$off->id] = $off->offer_name;
			}
		}
		$data['list_offer'] = $offerlist;
		/****************/
		/****HANDLE POST DATA*******/
		if(isset($_REQUEST) && !empty($_REQUEST)){
			$daterange = $_REQUEST['daterange'];
			$date_range_array = explode("TO",$daterange);
			//print_r($date_range_array);exit;
			$startdate = trim($date_range_array[0]);
			$enddate   = trim($date_range_array[1]);
			$offer_id = $_REQUEST['offer_id'];
			$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
		}else{
			$startdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-30,date('Y')));
			$enddate = date('Y-m-d',mktime(23,59,59,date('m'),date('d'),date('Y')));
			$daterange = $startdate.' TO '.$enddate;
			$data['status'] = '';
		}
		if(!empty($offer_id)){
			$data['offer_id'] = $offer_id;
			$where[] = " offer_id='".$offer_id."'";
		}
		if(isset($status) && $status !=''){
			$data['status'] = $status;
			$where[] = " status='".$status."'";
		}
		$data['daterange'] = $daterange;
		if($startdate==$enddate){
			$where[] = " date_created>='".$startdate." 00:00:00' AND date_created<='".$startdate." 23:59:59' ";
		}else{
			$where[] = " date_created>='".$startdate." 00:00:00' AND date_created<='".$enddate." 23:59:59' ";
		}
		
		if(!empty($where)){
			$where = " WHERE ".implode(" AND ", $where);
		}
		/**************************/
		/********pagination*********/
		$this->load->library('pagination');
		$config['base_url'] = base_url().'reports/list_client_trans';
		$config['per_page'] = 20;
		$get_pagenum = $this->uri->segment(3);
		$page_num = (!empty($get_pagenum)) ? $get_pagenum : 0;
		/***************************/
		/***** DATABASE OPERATION *********/
		$limit = " LIMIT ".$page_num.",".$config['per_page'];
		$order_by = " ORDER BY id DESC ";
		$sql = "SELECT * FROM ".OFFER_TRANS_TABLE.$where.$order_by.$limit;
		//echo $sql;exit;
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result();	
		$total_count = $this->db->query("SELECT count(id) as total FROM ".OFFER_TRANS_TABLE.$where);
		/*********************************/
		/********pagination*********/
		$config['total_rows'] = $total_count->row()->total;
		$this->pagination->initialize($config);
		$page_links = $this->pagination->create_links();
		/**************************/
		$data['page_link'] =$page_links;
		//echo"<pre>";print_r($data);echo"</pre>";exit;
		$data['total_rows'] = $config['total_rows'];
		$data['showing_rows'] = count($data['result']);
		$this->template->load('template_default','reports/list_client_trans',$data);
	}

	/*
	 * Affiliate Report
	 */
	public function affiliate_report(){
		$data['page_title'] ='Affiliate Report';
		$where = array();
		/* ****Get offer list************/
		$this->db->select('id,offer_name');
		$get_offerlist = $this->db->get('offers');
		$get_offerlist = $get_offerlist->result();
		$offerlist = array();
		if(count($get_offerlist)>0){
			foreach ($get_offerlist as $off){
				$offerlist[$off->id] = $off->offer_name;
			}
		}
		$data['list_offer'] = $offerlist;
		/* ****Get client list************/
		$this->db->select('id,client_name');
		$get_clientlist = $this->db->get('clients');
		$get_clientlist  = $get_clientlist->result();
		$clientlist = array();
		if(count($get_clientlist)>0){
			foreach ($get_clientlist as $cli){
				$clientlist[$cli->id] = $cli->client_name;
			}
		}
		$data['list_client'] = $clientlist;
		/* ****Get site list************/
		$this->db->select('id,site_name');
		$get_sitelist = $this->db->get('mysites');
		$get_sitelist  = $get_sitelist->result();
		$sitelist = array();
		if(count($get_sitelist)>0){
			foreach ($get_sitelist as $site){
				$sitelist[$site->id] = $site->site_name;
			}
		}
		$data['list_site'] = $sitelist;
		//echo '<pre>';print_r($data);exit;
		/****HANDLE POST DATA*******/
		if(isset($_POST) && !empty($_POST)){
			//echo"<pre>";print_r($_POST);echo"</pre>";exit;
			$data['daterange'] = $_POST['daterange'];
			$daterange = explode("TO",$_POST['daterange']);
			$startdate = trim($daterange[0]);
			$enddate   = trim($daterange[1]);
			if($startdate==$enddate){
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$startdate." 23:59:59' ";
			}else{
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$enddate." 23:59:59' ";
			}
			if(!empty($_POST['client_id'])){
				$client_id         = $_POST['client_id'];
				$data['client_id'] = $client_id;
				$where[] = " t2.client_id='".$client_id."'";
			}
			if(!empty($_POST['site_id'])){
				$data['site_id'] = $_POST['site_id'];
				$where[] = " t1.site_id='".$_POST['site_id']."'";
			}
			if(!empty($_POST['offer_id'])){
				$data['offer_id'] = $_POST['offer_id'];
				$where[] = " t1.offer_id='".$_POST['offer_id']."'";
			}
		}else{
			$startdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-30,date('Y')));
			$enddate = date('Y-m-d',mktime(23,59,59,date('m'),date('d'),date('Y')));
			$data['daterange'] = $startdate.' TO '.$enddate;
			if($startdate==$enddate){
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$startdate." 23:59:59' ";
			}else{
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$enddate." 23:59:59' ";
			}
		}
		if(!empty($where)){
			$where = " WHERE ".implode(" AND ", $where);
		}		
		/********pagination*********/
		$this->load->library('pagination');
		$config['base_url'] = base_url().'reports/affiliate_report';
		$config['per_page'] = 20;
		$get_pagenum = $this->uri->segment(3);
		$page_num = (!empty($get_pagenum)) ? $get_pagenum : 0;
		/***** DATABASE OPERATION *********/
		$order_by = " ORDER BY id DESC ";
		$limit = " LIMIT ".$page_num.",".$config['per_page'];
		/****** WORKING CODE *******/
		/* $sql = "SELECT t1.*,t2.client_id FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where.$order_by.$limit;
		//echo $sql;exit;
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result(); */
		/****** NEW CODE *******/
		$sql1 = "SELECT t1.*,t2.client_id FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where.$order_by.$limit;
		$sql  = "SELECT a.*,b.client_id,so_payout,so_ear,IFNULL(SUM(c.status=1)	, 0) accepted FROM (".$sql1.") AS a LEFT JOIN offers as b ON a.offer_id=b.id LEFT JOIN ".OFFER_TRANS_TABLE." as c ON a.id=c.site_offers_trans_id GROUP BY a.id";
		//echo $sql;exit;
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result();
		/***************************/
		//$total_count = $this->db->query("SELECT count(id) as total FROM ".SITE_OFFERS_TRANS_TABLE." as t1 ".$where);
		$total_count = $this->db->query("SELECT count(t1.id) as total FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where);
		/********pagination*********/
		$config['total_rows'] = $total_count->row()->total;
		$this->pagination->initialize($config);
		$page_links = $this->pagination->create_links();
		/**************************/
		$data['page_link'] =$page_links;
		//echo"<pre>";print_r($data);echo"</pre>";
		$data['total_rows'] = $config['total_rows'];
		$data['showing_rows'] = count($data['result']);
		$this->template->load('template_default','reports/affiliate_report',$data);		
	}
	/*
	 * Offer Report
	 */
	public function offer_report(){
		$data['page_title'] ='Offer Report';
		$where = array();$where2 = array();
		/* ****Get offer list************/
		$this->db->select('id,offer_name');
		$get_offerlist = $this->db->get('offers');
		$get_offerlist = $get_offerlist->result();
		$offerlist = array();
		if(count($get_offerlist)>0){
			foreach ($get_offerlist as $off){
				$offerlist[$off->id] = $off->offer_name;
			}
		}
		$data['list_offer'] = $offerlist;
		/* ****Get client list************/
		$this->db->select('id,client_name');
		$get_clientlist = $this->db->get('clients');
		$get_clientlist  = $get_clientlist->result();
		$clientlist = array();
		if(count($get_clientlist)>0){
			foreach ($get_clientlist as $cli){
				$clientlist[$cli->id] = $cli->client_name;
			}
		}
		$data['list_client'] = $clientlist;
		/* ****Get site list************/
		$this->db->select('id,site_name');
		$get_sitelist = $this->db->get('mysites');
		$get_sitelist  = $get_sitelist->result();
		$sitelist = array();
		if(count($get_sitelist)>0){
			foreach ($get_sitelist as $site){
				$sitelist[$site->id] = $site->site_name;
			}
		}
		$data['list_site'] = $sitelist;
		/****HANDLE POST DATA*******/
		
		if(isset($_POST) && !empty($_POST)){
			//echo"<pre>";print_r($_POST);echo"</pre>";exit;
			$data['daterange'] = $_POST['daterange'];
			$daterange = explode("TO",$_POST['daterange']);
			$startdate = trim($daterange[0]);
			$enddate   = trim($daterange[1]);
			if($startdate==$enddate){
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$startdate." 23:59:59' ";$where2[] = " C.date_created>='".$startdate." 00:00:00' AND B.date_created<='".$startdate." 23:59:59' ";
			}else{
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$enddate." 23:59:59' ";
				$where2[] = " C.date_created>='".$startdate." 00:00:00' AND B.date_created<='".$enddate." 23:59:59' ";
			}
			if(!empty($_POST['client_id'])){
				$client_id         = $_POST['client_id'];
				$data['client_id'] = $client_id;
				$where2[] = " B.client_id='".$client_id."'";
			}
			if(!empty($_POST['site_id'])){
				$data['site_id'] = $_POST['site_id'];
				$where[] = " t1.site_id='".$_POST['site_id']."'";
			}
			if(!empty($_POST['offer_id'])){
				$data['offer_id'] = $_POST['offer_id'];
				$where[] = " t1.offer_id='".$_POST['offer_id']."'";
			}
		}else{
			$startdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-30,date('Y')));
			$enddate = date('Y-m-d',mktime(23,59,59,date('m'),date('d'),date('Y')));
			$data['daterange'] = $startdate.' TO '.$enddate;
			if($startdate==$enddate){
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$startdate." 23:59:59' ";$where2[] = " C.date_created>='".$startdate." 00:00:00' AND B.date_created<='".$startdate." 23:59:59' ";
			}else{
				$where[] = " t1.date_created>='".$startdate." 00:00:00' AND t1.date_created<='".$enddate." 23:59:59' ";
				$where2[] = " C.date_created>='".$startdate." 00:00:00' AND B.date_created<='".$enddate." 23:59:59' ";
			}
		}
		if(!empty($where)){
			$where = " WHERE ".implode(" AND ", $where);
		}
		if(!empty($where2)){
			$where2 = " WHERE ".implode(" AND ", $where2);
		}		
		/********pagination*********/
		$this->load->library('pagination');
		$config['base_url'] = base_url().'reports/offer_report';
		$config['per_page'] = 20;
		$get_pagenum = $this->uri->segment(3);
		$page_num = (!empty($get_pagenum)) ? $get_pagenum : 0;
		/***** DATABASE OPERATION *********/
		$order_by = " ORDER BY t1.id DESC ";
		$limit = " LIMIT ".$page_num.",".$config['per_page'];
		/****** WORKING CODE *******/
		/* $sql = "SELECT t1.*,t2.client_id FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where.$order_by.$limit;
		//echo $sql;exit;
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result(); */
		/****** NEW CODE *******/
		$group_by = " GROUP BY offer_id ";
		//$group_by = "  ";
		
		$sql1 = "SELECT site_id,offer_id,SUM(`displayed`) AS displayed,SUM(`submitted`) AS submitted FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 ".$where.$group_by;
		
		$sql  = "SELECT A.*,D.so_payout,D.so_ear,IFNULL(SUM(C.status=1),0) accepted,B.client_id FROM (".$sql1.") AS A LEFT JOIN ".OFFER_TRANS_TABLE." AS C ON A.offer_id=C.offer_id 
		LEFT JOIN offers as B ON A.offer_id=B.id LEFT JOIN offer_io_management AS D ON A.offer_id=D.offer_id $where2
		GROUP BY B.id";	
		
		//echo $sql;
		
		$sql_query   = $this->db->query($sql);
		$data['result'] = $sql_query->result();
		/***************************/
		//$total_count = $this->db->query("SELECT count(id) as total FROM ".SITE_OFFERS_TRANS_TABLE." as t1 ".$where);
		$total_count = $this->db->query("SELECT count(t1.id) as total FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where." GROUP BY t1.offer_id ");
		
		//echo "SELECT count(t1.id) as total FROM `".SITE_OFFERS_TRANS_TABLE."` as t1 LEFT join offers as t2 on t1.offer_id=t2.id".$where." GROUP BY t1.offer_id ";
		
		
		//print_r($total_count);exit;
		/********pagination*********/
		if($total_count->row()){
			$config['total_rows'] = $total_count->row()->total;
		}else{
			$config['total_rows'] = 0;
		}
		//$this->pagination->initialize($config);
		//$page_links = $this->pagination->create_links();
		/**************************/
		//$data['page_link'] =$page_links;
		//echo"<pre>";print_r($data);echo"</pre>";
		$data['total_rows'] = $config['total_rows'];
		$data['showing_rows'] = count($data['result']);
		$this->template->load('template_default','reports/offer_report',$data);		
	}
}
