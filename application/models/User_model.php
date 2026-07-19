<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
   
    public function __construct()
    {
      	parent::__construct();      	
    }
		
	// Read data using username and password
	public function login($username,$password) 
	{
		
		$password = md5($password);
		
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		$this->db->limit(1);
		$query = $this->db->get();
		$num = $query->num_rows();

		//echo"<pre>";print_r($query->row());echo"</pre>";exit;
		if($num == 1)
		{
			$res = $query->row();
			//echo"<pre>";print_r($res);echo"</pre>";exit;
			return $res;
		}
		else
		{
			return false;
		}
	}
    public function __destruct() {  
		$this->db->close();  
	}
    
}
?>