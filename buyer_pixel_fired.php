<?php 
 /**
  * buyer side
  * @functionality : send mail when pixel fired.
  * This side is buyer side where pixel is fired.
  */
	$pixel ='http://elitecoregoffers.com/doubleoptinemail.php?buyerid=10';
	$pixel_type = '';
	if($pixel_type == 'htmlpixel'){
	?>
		<body>
		  <p><div id="">
		  <?php echo html_entity_decode($pixel); ?>
		  <br />Processing, One Moment Please&hellip;</div></p>
		</body>
	<?php }else{ ?>
		<p><div style="font-size:20px;">
		  <br />Processing, One Moment Please&hellip;</div></p>
		<?php file_get_contents($pixel); ?>
	<?php } ?>
	<script type="text/javascript">
	  window.close();
	</script>
 