<?php 
$controller_name = $this->uri->segment(1);
?>

<h1>
<?php
$name = 'The Smart Offer System'; 
switch ($controller_name) {
	case "MySite":
	 $name = " My Sites Management";
	 break;
	
	case "offer":
		$name = "Offers Management";
		break;
	
	case "user":
		$name = "User Management";
		break;
	
	default:
		;
	break;
}
echo $name;
?>
<small>&nbsp;<?php echo $page_title;?></small>						
</h1>