<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('General_model');
	}
	/*
	 * This function runs daily to send Email and FTP data to client
	 */
	public function daily(){
		$back_date = isset($_GET['backdate']) ? $_GET['backdate'] : 1;
		//$lead_date = date('Y-m-d');
		$lead_date = date('Y-m-d',strtotime("-".$back_date." days"));
		$uploads_path = "uploads/ftp/";
		//Prepare files for data
		$this->db->where('date_created>=',$lead_date." 00:00:00 ");
		$this->db->where('date_created<=',$lead_date." 23:59:00 ");
		$this->db->order_by('offer_id','ASC');
		$getDataSql = $this->db->get(FTP_DATA_TABLE);
		$getData    = $getDataSql->result();
		$offer_id = "";
		$fileCreate = "";
		$header = "";
		foreach ($getData as $odata){
			$output = "";
			if($odata->offer_id != $offer_id){
				//Close last opened file
				if(!empty($fileCreate))
				{ fclose($fileCreate);}
				//Create new file
				$offer_id   = $odata->offer_id;
				$fileName   = "offer".$offer_id.'_'.$lead_date.".csv";
				$fileCreate = fopen($uploads_path.$fileName,'w') or die('Cannot open file:  '.$fileName);
				chmod($uploads_path.$fileName, 0777);
				//Set header for file
				$responseData = parse_str(urldecode($odata->request_data),$tmpHeader);
				$tmpHeader = array_change_key_case($tmpHeader,CASE_UPPER);
				fputcsv($fileCreate, array_keys($tmpHeader));
				//echo"<pre>";print_r($tmpHeader);echo"</pre>";exit;				
			}
			parse_str(urldecode($odata->request_data),$tmpData);
			foreach ($tmpData as $value){	
				$output[] = $value; 
			}
			fputcsv($fileCreate, $output);
		}
				
		//Get offers and send EMAIL AND FTP data
		
		
		$getOfferSql = "select id,`transfer_method`,`transfer_email`,`email_file_name`,`email_delimeter`,`ftp_host_name`,`ftp_login_name`,`ftp_login_password`,`ftp_file_name`,`ftp_delimeter`,`ftp_protocol`,`ftp_port` from offers where id in (SELECT offer_id FROM `ftp_data` WHERE date_created >= '".$lead_date." 00:00:00' AND date_created <= '".$lead_date." 23:59:00' )";
		
		$getOffer    = $this->db->query($getOfferSql);
		foreach ($getOffer->result() as $offer){
			$local_filename  = $uploads_path."offer".$offer->id.'_'.$lead_date.".csv";
			if($offer->transfer_method=="transfer_method_email"){
				$email = $offer->transfer_email;				 
				$this->email_to_client($email,$local_filename,$lead_date);
			}else if($offer->transfer_method=="transfer_method_ftp"){
				$live_file = "offer".$offer->id."_".$lead_date.".csv";
				$this->ftp_to_client($offer,$local_filename,$live_file);
			}
		}			
	}
	/*
	 * Email to client FTP file
	 */
	public function email_to_client($mailto,$local_filename,$lead_date){
		// SEND EMAIL WITH ATTACHEMENT
		$content = file_get_contents($local_filename);
		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$name = basename($local_filename);

		$from_name ='MindBodySoulMedia.com';$from_mail='support@mindbodysoulmedia.com';$replyto='tony.elitecashwire@gmail.com';
		// header
		$header = "From: ".$from_name." <".$from_mail.">\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

		// message & attachment
		$filename = $lead_date.'_data.csv';
		$message = "Dear Receiver, Here are the email feed for today from ".SITE_TITLE.".";
		$subject = SITE_TITLE."(Daily Email Feed)";
		
		$nmessage = "--".$uid."\r\n";
		$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$nmessage .= $message."\r\n\r\n";
		$nmessage .= "--".$uid."\r\n";
		$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
		$nmessage .= "Content-Transfer-Encoding: base64\r\n";
		$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$nmessage .= $content."\r\n\r\n";
		$nmessage .= "--".$uid."--";

		/*if (mail($mailto, $subject, $nmessage, $header)) {
			return true;
		} else {
		  return false;
		}*/
		
		
		
	}
	
	/*
	 * Upload file to client FTP
	 */
	public function ftp_to_client($ftp_details,$local_filename,$remote_filename){
		// connect and login to FTP server
		if($ftp_details->ftp_protocol ==1){
			$ftp_server = $ftp_details->ftp_host_name;
			$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			$login = ftp_login($ftp_conn, $ftp_details->ftp_login_name, $ftp_details->ftp_login_password);
			// upload file
			if (ftp_put($ftp_conn, $remote_filename, $local_filename, FTP_ASCII)){
				echo "Successfully uploaded $local_filename.";
			}else{
				echo "Error uploading $local_filename.";
			}
			// close connection
			ftp_close($ftp_conn);
		}else{
			$server = $ftp_details->ftp_host_name;
			$port = $ftp_details->ftp_port;
			$username = $ftp_details->ftp_login_name;
			$passwd = $ftp_details->ftp_login_password;
			$connection = ssh2_connect($server, $port);
			if (ssh2_auth_password($connection, $username, $passwd)) {
				$sftp = ssh2_sftp($connection);
				$contents = file_get_contents($local_filename);
				//$remote_filename = date('Y-m-d_').'data.csv';
				file_put_contents("ssh2.sftp://{$sftp}/".$remote_filename,$contents);
				//unlink($local_filename);
			}else{
				echo "Unable to authenticate with server"."\n";
			}
		}
	}
}