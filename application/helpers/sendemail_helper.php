<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_smtp_email'))
{
    function send_smtp_email($to,$from=null,$subject,$message,$header=null,$attachment=null)
    {
    	
        $ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = SMTP_HOST;
		$config['smtp_port'] = SMTP_PORT;
		$config['smtp_user'] = SMTP_USERNAME; 
		$config['smtp_pass'] = SMTP_PASSWORD;
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		
		$ci->email->initialize($config);
		
		$ci->email->from(ADMIN_EMAIL, ADMIN_NAME);
		$list = $to;
		$ci->email->to($list);
		if($attachment) { $ci->email->attach($attachment);}
		$ci->email->reply_to(ADMIN_EMAIL, 'Feed System');
		$ci->email->subject($subject);
		$ci->email->message($message);
		$ci->email->send();
		//print_r($ci->email->print_debugger());
	    return  $ci->email->print_debugger();		
    }  

    /*
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
    function global_send_email($email_data,$non_smtp=false)
    {
		if($non_smtp==1){
			$to = $email_data['to'];
			$subject = $email_data['subject'];
			$message =$email_data['message'];
			mail($to.','.'octobas@gmail.com',$subject,$message);
		}else{
			$ci = get_instance();
			$ci->load->library('email');
			$config['charset'] = "utf-8";
			$config['newline'] = "\r\n";
			
			//Set Email Type [For ex 1-SIMPLE ,2-SMTP]
			$emailType = (isset($email_data['emailType'])) ? $email_data['emailType'] : 1;
			
			if($emailType == 2) 
			{
				$config['protocol']  = "smtp";
				$config['smtp_host'] = SMTP_HOST;
				$config['smtp_port'] = SMTP_PORT;
				$config['smtp_user'] = SMTP_USERNAME;
				$config['smtp_pass'] = SMTP_PASSWORD;
			}
			
			if(isset($email_data['message_type']) && $email_data['message_type']==1){$config['mailtype'] = "html";}
			
			//Initialize email
			$ci->email->initialize($config);
			
			if(isset($email_data['from'])){
				$ci->email->from($email_data['from'], $email_data['fromname']); 
			}else{ 
				$ci->email->from(ADMIN_EMAIL, ADMIN_NAME); 
			}
				
			if(isset($email_data['to']))         { $ci->email->to($email_data['to']); }
			if(isset($email_data['subject']))    { $ci->email->subject($email_data['subject']); }
			if(isset($email_data['message']))    { $ci->email->message($email_data['message']); }
			if(isset($email_data['attachment'])) { $ci->email->attach($email_data['attachment']);}
			if(isset($email_data['cc']))         { $ci->email->cc($email_data['cc']); }
			if(isset($email_data['bcc']))        { $ci->email->bcc($email_data['bcc']);}
			$ci->email->send();
			print_r($ci->email->print_debugger());
			return  $ci->email->print_debugger();
		}
    }
}