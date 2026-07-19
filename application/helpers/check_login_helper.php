<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('check_login'))
{
    function check_login()
    {
    	$ci =get_instance();
    	$sessiondata = $ci->session->userdata;
    	//echo count($sessiondata);
    	//echo"<pre>";print_r($sessiondata);exit('123');
    	if(!isset($sessiondata['user_detail']->id))
    	{
    		$ci->session->set_flashdata('err-msg', 'Make a login first.');
    		redirect('/');exit('check login redirect');
    	}
    }   
}