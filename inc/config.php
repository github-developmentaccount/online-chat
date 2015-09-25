<?php

session_start();
require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__).'/../libs/tmp.class.php';
require_once dirname(__FILE__).'/../libs/chat.class.php';




$url = explode('/', $_SERVER['PHP_SELF']);
$catalog = empty($url[1]) ? '/' : '/'.$url[1];


define('ROOT', dirname(__FILE__).'/../');
define('URL_ROOT', 'http://'.$_SERVER["HTTP_HOST"].$catalog);

