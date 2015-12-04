<!--
	db_connect.php
	
	by: Austin Truong
	Initializes databse connections.
-->

<?php
include_once 'psl-config.php'; // as functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE); 
$shopsv = new mysqli(HOST, SHOPUSER, SHOPPASS, SHOPDB);
?>