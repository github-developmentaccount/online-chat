<?php
require_once 'config.php';

if(isset($_POST['message']) && !empty($_POST['message']))
{
	$message = strip_tags(trim($_POST['message']));

}

    $obj = new Chat();
    if(!$obj->newMessage($message)) {
        echo 0;
    
    }
    else {
        echo 1;  
     }
        unset($st);