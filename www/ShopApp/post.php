<!-- 
	post.php
	Author: Austin Truong
	
	Page for creating listings before submission to the database.
	
-->

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Post</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/forms.js"></script>
        
    </head>
    <body>
	
		<?php if (isset($_GET['success'])) {
            echo '<p class="important">Submitted!</p>';
        }?>
		<?php //echo esc_url($_SERVER['PHP_SELF']); ?>
        <?php if (login_check($mysqli) == true) : ?>
            <p>Currently logged in as <b> <?php echo htmlentities($_SESSION['username']); ?></b>.</p>
			
            <p>
                Create a post!
            </p><!--includes/process_post.php-->
			<form action="includes/process_post.php" method="post" name="post_form">      
			
            <b>Title:</b> <br>
			Put the title of your post here. <br>
			<input type="text" name="title" value = "Need stuff!" /><br>
			
           <b>Body:</b> <br>
			Type your request here. <br>
			<textarea id="text" name="text" cols="40" rows ="10"></textarea> <br>
			
			<b>Pickup location:</b> <br>
			<input type="text" name="address" value = "Unspecified" /><br>
			
			<b>Offering fee:</b><br>
			This is the amount you are willing to pay in addition to the cost of the purchase.<br>
			<input type="number" name="fee" step="0.01" min="0" /><br>
			
			<b>Type of items:</b><br>
			Select the types of items that are in your request.<br>
			<input type="checkbox" name="item_type1" value="food">Food<br>
			<input type="checkbox" name="item_type2" value="clothes" checked="checked">Clothing<br>
			<input type="checkbox" name="item_type3" value="electronics" checked="checked">Electronics<br>
			<input type="checkbox" name="item_type4" value="supplies" checked="checked">Office and other supplies<br>
			<input type="checkbox" name="item_type5" value="misc" checked="checked">Misc<br>
			
			<input type="submit" name="submit" value="Submit" id="submit"/>

			</form>
            <p>Return to <a href="index.php">front page</a></p>
        <?php else : ?>
            <p>
                <span class="error">You must be logged in to create a post.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>