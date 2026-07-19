<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Description: GENERAL MODEL FOR ALL 
 */
class Mysites_model extends CI_Model{
   
    public function __construct()
    {
      	parent::__construct();      	
    }
    
    /*
     * Function for update mysites regular and prime offers after delete offer or site
     */
    public function update_mysites_offers(){
    	$this->db->select('id');
		$this->db->where('status_pause','0');
    	$sql = $this->db->get('offers');
    	$getid_offers = $sql ->result_array();
    	$offer_ids = array();
    	if(!empty($getid_offers)){
    		foreach($getid_offers as $value)
    		{	$offer_ids[] = $value['id']; }
    	}
    	//GET SITE DETAILS
    	$this->db->select('id,prime_offers,regular_offers');
    	$sql = $this->db->get('mysites');
    	$get_sites = $sql->result_array();
    	if(count($get_sites)>0){
    		foreach ($get_sites as $site){
    			$prime_offers = explode(',',$site['prime_offers']);    			
    			$prime_offers = array_intersect($offer_ids,$prime_offers);
    			$prime_offers = (!empty($prime_offers)) ? implode(',',$prime_offers) : "";
    			$regular_offers = explode(',',$site['regular_offers']);
    			$regular_offers = array_intersect($offer_ids,$regular_offers);
    			$regular_offers = (!empty($regular_offers)) ? implode(',',$regular_offers) : "";
    			$dbdata = array();
    			$dbdata['prime_offers']   = $prime_offers;
    			$dbdata['regular_offers'] = $regular_offers;    
				//echo"<pre>";print_r($dbdata);echo"</pre>";
    			//update data
    			$this->db->where('id',$site['id']);
    			$this->db->update('mysites',$dbdata);
    		}
    	}
    }
}
?>