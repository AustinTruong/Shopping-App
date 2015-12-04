<!-- 
	edit.php
	Author: Austin Truong
	
	Page for editing listings before submitting them to the database.
	
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
if(isset($_GET['post_id'])) {
	if(login_check($mysqli) == true)
	{
		$post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);
		$stmt = $shopsv->prepare("SELECT * FROM posted_lists WHERE post_id = ? LIMIT 1");
		$stmt->bind_param('i',$post_id);
		
		$stmt->execute();
		$result = $stmt->get_result();
		
		
		
		if($row = $result->fetch_assoc())
		if($row['user_id'] == $_SESSION['user_id'])
		{
		?>
		<p>Currently logged in as <b> <?php echo htmlentities($_SESSION['username']); ?></b>.</p>
			
            <p>
                Edit your post!
            </p>
			<form action="includes/process_edit.php" method="post" name="post_form">      
			<input type="hidden" name="post_id" value="<?php echo $post_id;?>"> <!-- Hack to send post id-->
            <b>Title:</b> <br>
			Put the title of your post here. <br>
			<input type="text" name="title" value = "<?php echo $row['header'];?>" /><br>
			
           <b>Body:</b> <br>
			Type your request here. <br>
			<textarea id="text" name="text" cols="40" rows ="10"><?php echo $row['text'];?></textarea> <br>
			
			<b>Pickup location:</b> <br>
			<input type="text" name="address" value = "<?php echo $row['drop_off'];?>" /><br>
			
			<b>Offering fee:</b><br>
			This is the amount you are willing to pay in addition to the cost of the purchase.<br>
			<input type="number" name="fee" step="0.01" min="0" value="<?php echo $row['fee'];?>"/><br>
			
			<b>Type of items:</b><br>
			Select the types of items that are in your request.<br> <!--Don't want to bother with the checkboxes-->
			<input type="checkbox" name="item_type1" value="food">Food<br>
			<input type="checkbox" name="item_type2" value="clothes" checked="checked">Clothing<br>
			<input type="checkbox" name="item_type3" value="electronics" checked="checked">Electronics<br>
			<input type="checkbox" name="item_type4" value="supplies" checked="checked">Office and other supplies<br>
			<input type="checkbox" name="item_type5" value="misc" checked="checked">Misc<br>
			
			<input type="submit" name="submit" value="Submit" id="submit"/>

			</form>
            <p>Return to <a href="index.php">front page</a></p>
		<?php
		}
		else
			echo 'Invalid request. Post does not exist!';
	}
	else
		echo 'Invalid request. Not <a href="index.php">signed in</a>.';
}
else
	echo 'Invalid request. No post selected.';
	
?>
</html>