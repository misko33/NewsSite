<?php

include('config.php'); 
include("mysql_driver.php");
include('funkcije.php'); 
include('clanak_class.php'); 
include('user_class.php');

session_start();

$db_host = $config['host']. ':' . $config['port'];
$db = new baza($db_host, $config['username'], $config['password'], $config['ime_baze']); 

$clanak = new Clanak($db); 
$korisnik = new User($db);
?>



