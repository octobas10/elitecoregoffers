<?php 
/**
 * this page is used for email confirmation when email ( in double opt ) is send.
 * this mail contain the image pixel which is added by the client.
 */
 ?>
<style>
#offer_form table {  border-collapse: separate !important;
  border-spacing: 5px;
}
#smart_offer .offer-row{border: 2px solid #444D58;}
#smart_offer td{padding:2px;}
.so_submit{  color: #FFFFFF;
  background-color: #3598dc;
  border-width: 0;
  padding: 7px 14px;
  font-size: 14px;
  outline: none !important;
  background-image: none !important;
  filter: none;
  box-shadow: none;
  text-shadow: none;
  border: 1px solid transparent;
  border-radius: 4px;
  margin:1% 35%;
}
#smart_offer .offer_wraper {
  border: 5px solid #444D58 !important;
  border-radius: 8px;
}
</style>
<?php 

/*print_r($getOfferData);
if(($this->session->flashdata('getOfferData')!=null) && !empty($this->session->flashdata('getOfferData'))){
   $t_offer_data = $this->session->flashdata('getOfferData');
   $s_pixel_link = $t_offer_data->image_pixel_link ;
}*/
?>
<div style="width:100%;max-width:768px;margin:10px auto;"><div style="background:rgb(234, 234, 234);border:1px solid #ddd;-webkit-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);-moz-box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);
box-shadow: 7px 7px 57px -4px rgba(0,0,0,0.31);border-top-left-radius:10px;border-top-right-radius:10px;">
        <div style="height:20px;border-top-left-radius:10px;border-top-right-radius:10px;"></div><div style="padding:0px 20px;"><div style="text-align:left;position:relative;top:0px;line-height:40px;"></div><div style="padding-bottom:20px;">
		<div style="margin-top:10px;clear:both;"><p style="line-height: 22px;margin:30px 0 0;color:#000;font-size:14px;font-weight:bold;">Hi,</p>
		<p style="line-height: 22px;margin:30px 0 0;color:#000;font-size:14px;"><img style="display:none;font-size:17px;color:#9A3E3E; text-decoration: none; font-weight:bold;">Thank You For Registration.</p>
		</div></div></div></div></div>
<?php 
  /**
   * unset the session-
   */
   //$this->session->unset_userdata('getOfferData'); 
?>    