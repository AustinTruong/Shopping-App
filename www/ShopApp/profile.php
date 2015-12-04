<!--
	profile.php
	
	Shows all posts created by a user. Lets them edit
	their own posts.
-->

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}


?>
<!DOCTYPE html>
<html>
<?php
		$id;
		if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
			echo "Welcome to ".find_name($id,$mysqli)."'s posts! You can view all of them from here.";
        }
		else
		{
			$id = $_SESSION['user_id'];
			echo "Welcome to your posts, <b>".find_name($id,$mysqli)."</b>! You can edit any post you created.";
		}
		//echo $id."<br>";
		
		
	
	if($stmt = $shopsv->prepare("SELECT * 
	FROM posted_lists WHERE user_id = ?")) {
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc()) {
			// Get matching name from secure_login
			$usern = find_name($row["user_id"],$mysqli);
			
			echo '<table border="1" style="width:100%">';
			if($id == $_SESSION['user_id'])
				echo '<tr><td colspan="2"><a href="edit.php?post_id='.$row['post_id'].'">'.'Edit'.'</a></td></tr>';
			else echo '<tr><th scope="col" colspan="2">' . $usern. ' says...  </th></tr>';
			echo '<tr><td colspan="2">' . nl2br(htmlspecialchars($row["header"])). '</td></tr>';
			echo '<tr><td colspan="2">' . nl2br(htmlspecialchars($row["text"])). '</td></tr>';
			echo '<tr><td>Drop off: '.htmlspecialchars($row['drop_off']).'</td><td>Fee: $'.$row['fee'].'</td><tr>';
			echo "</table><br>";
		}
	}
?>
</html>