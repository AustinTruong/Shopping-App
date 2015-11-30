<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>A Simple PHP File</title>
</head>
<body>
    <h1><?php 
	define("HELLO","Hello, world!");
	echo HELLO; ?></h1>
<?php
// Open a file for reading
//$handle = fopen("note.txt", "r");
//var_dump($handle);
echo "<br>";
 
// Connect to MySQL database server with default setting
$link = mysqli_connect("localhost", "root", "password");
var_dump($link); ?>
</body>

</html>