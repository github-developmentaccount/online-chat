<?php 


	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$db_name = 'chat';
	$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);


try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name", $user, $password, $opt);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$dbh->exec("set names utf8");
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}


?>