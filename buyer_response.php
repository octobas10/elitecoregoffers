<?php  
         /**
		  * buyer send mail to the consumer
		  */
         $s_confirmation_link = 'http://elitecoregoffers.com/buyer_pixel_fired.php';
	     $s_email_template = '<div><div style="background:rgb(234, 234, 234);border:1px solid #ddd;-webkit-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);-moz-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);border-top-left-radius:10px;
border-top-right-radius:10px;">';
        $s_email_template .= '<div style="height:20px;border-top-left-radius:10px;border-top-right-radius:10px;"></div><div style="padding:0px 20px;"><div style="text-align:left;position:relative;top:0px;line-height:40px;"></div><div style="padding-bottom:20px;">';
		$s_email_template .='<div style=3D"padding:10px;margin-top:10px;clear:both;"><p>Hello, Thank You For Registration.</p>';
		$s_email_template .='<p style="line-height: 22px;margin:30px 0 0;color:#000;font-size:14px;"><a href="'.$s_confirmation_link.'" style="font-size:17px;color:#9A3E3E; text-decoration: underline; font-weight:bold;" target="_blank"><u>click on Confirmation link</u></a></p>';
		$s_email_template .= '</div><p style="color:#666;font-size:16px;margin-top:40px;">Best Regards,</p></div></div></div></div>';
		$s_to = $_POST['so_email'];
		$s_subject =  "Buyer Confirmation Mail";
		$s_message = $s_email_template;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		if(mail($s_to,$s_subject,$s_message,$headers)){
		   echo 'Email Sent';
		}
?>