<?php
/**
 * coregoffers side
 */
$headers = 'From: do-not-reply@elitecashwire.com';
$buyerid= $_GET['buyerid'];
$body = 'The pixel fired. buyer id is '.$buyerid;
mail('octobas@gmail.com', 'PIXEL FIRED FROM '.$buyerid, $body, $headers);
exit;
?>