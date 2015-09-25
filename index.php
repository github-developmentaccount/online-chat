<?php 

error_reporting(E_ALL);
require_once 'inc/config.php';
$object = new Chat();
if(isset($_GET['logout'])) {
	$object->LogOut();
	@header('Location:'. $_SERVER['PHP_SELF']);
	
}


$templater = new tmp();
$templater->display('body.tpl.php');



?>

