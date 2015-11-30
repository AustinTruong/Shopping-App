<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

sec_session_start();


if (isset($_POST['title'], $_POST['text'], $_POST['address'], $_POST['fee'] )){
	
	// Filter inputs
	$title =  filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$text = filter_var($_POST['text'],FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	$fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	$types = "";
	$numt = 0;
	if(isset($_POST['item_type1']))
	{
		if($numt > 0)
			$types.= ",";
		$types .= "food";
		$numt = $numt + 1;
	}
	if(isset($_POST['item_type2']))
	{
		if($numt > 0)
			$types.= ",";
		$types .= "clothes";
		$numt = $numt + 1;
	}
	if(isset($_POST['item_type3']))
	{
		if($numt > 0)
			$types.= ",";
		$types .= "electronics";
		$numt = $numt + 1;
	}
	if(isset($_POST['item_type4']))
	{
		if($numt > 0)
			$types.= ",";
		$types .= "supplies";
		$numt = $numt + 1;
	}
	if(isset($_POST['item_type5']))
	{
		if($numt > 0)
			$types.= ",";
		$types .= "misc";
		$numt = $numt + 1;
	}
	
	
	$title = $shopsv->real_escape_string($title);
	//$text = $shopsv->real_escape_string($text);
	$address = $shopsv->real_escape_string($address);
	$types = $shopsv->real_escape_string($types);
	
	$user_id = $_SESSION['user_id'];
	
	$curr_time = time();
	
	echo $title."<br>";
	echo $user_id."<br>";
	echo nl2br($text)."<br>";
	echo $fee."<br>";
	echo $types."<br>";
	echo $curr_time;
	
	if ( mysqli_connect_errno() ) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}
	if($stmt = $shopsv->prepare("INSERT INTO posted_lists (header, text, drop_off, fee, item_types, user_id, submit_time) VALUES (?, ?, ?, ?, ?, ?, ?)")){
		$stmt->bind_param('sssdsss', $title, $text, $address, $fee, $types, $user_id, $curr_time);
		/*if(!$stmt->execute())
		{
			echo "ERROR";
			header('Location: ../post.php?error_server=1');
		}else 
			header('Location: ../post.php?success=1');*/
	}
	else
		echo header('Location: ../post.php?error_server=1');
	
	
}
else
{
	// Somehow didn't get post values
	echo "Invalid request.";
}

?>