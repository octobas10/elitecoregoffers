<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Description: GENERAL MODEL FOR ALL 
 */
class General_model extends CI_Model{
   
    public function __construct()
    {
      	parent::__construct();      	
    }
    
    /*
     * Insert data function
     */
    public function insert_data($table,$data)
    {
    	$query = $this->db->insert($table,$data);
    	$last_insert_id = $this->db->insert_id();
    	return (!empty($last_insert_id)) ? $last_insert_id : 0; 
    }
    
    /*
     * Update data function
     * var $table - TABLE NAME
     * var $data  - DATA TO UPDATE
     * var $where - ASSOCIATIVE ARRAY OF DATA WHERE NEED UPDATE
     * return true or false
     */
    public function update_data($table,$data,$where)
    {
    	if($where)
    	{
    		foreach($where as $key=>$value)
    		{
    			$this->db->where($key,$value);
    		}    		
    	}
    	$query = $this->db->update($table,$data);
    	return ($query) ? true : false ;    	
    }
    
    /*
     * Make custom query
     */
    public function custom_query($query)
    {
    	$query = $this->db->query($query);
    	$db_result = $query->result(); 
    	return ($db_result);
    }
    
    /*
     * SELECT RECORDS
     * $table  = Table name
     * $order_by = pass key and value(ASC or DESC)
     * $fields = Name of fields you want, pass array
     * $where  = conditions for query, Provide associative array
     * $count  = need row count or result
     * $single_row = If you need single row then set it to 1 else 0
     * rerurn result Standard array
     */
    public function get_records($table,$order_by,$fields=null,$where=null,$count=null,$single_row=0)
    {
    	$this->db->from($table);
    	
    	if(!empty($order_by))
    	{
    		$key = array_keys($order_by);
    		$value = array_values($order_by);
    		$this->db->order_by($key[0],$value[0]);	
    	}
    	
    	if(!empty($fields))
    	{
    		$this->db->select(implode(',',$fields));
    	}
    	if(!empty($where))
    	{
    		foreach ($where as $field=>$value)
    		{
    			$this->db->where($field,$value);
    		}
    	}
    	
    	if($count)
    	{
    		$query = $this->db->count_all_results();
    		return $query;
    	}
    	else
    	{
    		$query = $this->db->get();
    		$query = ($single_row==1) ? $query->row() : $query->result();
    		return $query;    		
    	}    	
    }
    

	/*
	 * GET ACTIVE VENDORS
	 * This function return active vendors of system
	 * return array
	 */
    public function get_active_vendors()
    {
    	$this->db->select("`t2`.`uid`, `t2`.`first_name`, `t2`.`last_name`, `t2`.`username`, `t2`.`email`, `t2`.`password`, `t2`.`phone_number`, `t2`.`company_name`, `t2`.`city`, `t2`.`state`, `t2`.`zipcode`, `t2`.`is_admin, `t2`.`is_deleted` as is_usermaster_deleted, `t1`.`vid`, `t1`.`vendor_campaign`, `t1`.`is_unique_by`, `t1`.`unique_by_email`, `t1`.`unique_by_phone`, `t1`.`unique_check_intarval`, `t1`.`volume`, `t1`.`submission_count`, `t1`.`submission_count_date`, `t1`.`vendor_status`, `t1`.`payment_term`, `t1`.`revenue_share_percentage`, `t1`.`block_url`, `t1`.`block_subid`, `t1`.`allow_url`, `t1`.`allow_subid`, `t1`.`dnc`, `t1`.`check_phone_type`, `t1`.`is_deleted` as is_vendor_deleted");
    	$this->db->from(DATA_VENDOR_TABLE." as t1");
    	$this->db->join(USER_MASTER_TABLE." as t2 ","t1.uid=t2.uid",'LEFT');
    	$this->db->where("t1.vendor_status",'1');
    	$this->db->where("t1.is_deleted",'0');
    	$result = $this->db->get();
    	$result = $result->result_array();
    	
    	//echo"<pre>";print_r($this->db->last_query());echo"</pre>";
    	//echo"<pre>";print_r($result);echo"</pre>";exit('111');
    	return $result;
    }
	 public function __destruct() {  
		$this->db->close();  
	}
}
?>