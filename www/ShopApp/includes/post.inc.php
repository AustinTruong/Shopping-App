<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

$error_msg = "";

sec_session_start();

$error_msg .= "HELP";

if (isset($_POST['title'], $_POST['text'], $_POST['address'], $_POST['fee'] )){
	//$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$title =  filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$text = htmlspecialchars($_POST['text']);
	$address = $_POST['address'];
	$fee = $_POST['fee'];
	
	//$title = $shopdb->real_escape_string($title);
	//$text = $shopdb->real_escape_string($text);
	//$address = $shopdb->real_escape_string($address);
	
	$user_id = $_SESSION['user_id'];
	echo $user_id;
	
	$curr_time = time();
	
	$stmt = $shopsv->prepare("INSERT INTO posted_lists 
	(header, text, drop_off, fee, itemtypes, user_id, submit_time) 
	VALUES (?, ?, ?, ?, ?, ?);
	(:title, :text, :address)");
	
	//header('Location: ../index.php');
	
}