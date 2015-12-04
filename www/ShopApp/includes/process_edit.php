<!--
	process_edit.php
	
	by: Austin Truong
	
	Back-end for editting
	
-->

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

sec_session_start();


if (isset($_POST['title'], $_POST['text'], $_POST['address'], $_POST['fee'], $_POST['post_id'] )){
	
	// Filter inputs
	$title =  filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
	$text = filter_var($_POST['text'],FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	$fee = filter_var($_POST['fee'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
	
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
	
	if ( mysqli_connect_errno() ) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}
	// Make sure user id matches with query
	if($stmt = $shopsv->prepare("UPDATE posted_lists SET header=?, text=?, drop_off=?, fee=?, item_types=?, last_edit=? WHERE post_id=?, user_id= ?")){
		$stmt->bind_param('sssdssii', $title, $text, $address, $fee, $types, $curr_time, $post_id, $user_id);
		if(!$stmt->execute())
		{
			echo "ERROR";
			echo header('Location: ../profile.php?error_server=2');
		}else 
			header('Location: ../profile.php');
	}
	else
		echo header('Location: ../profile.php?error_server=1');
	
	
}
else
{
	// Somehow didn't get post values
	echo "Invalid request.";
}

?>