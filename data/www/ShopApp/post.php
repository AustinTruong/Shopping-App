<?php
//include_once 'includes/post.inc.php';
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
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                Create a post!
            </p><!--includes/process_post.php-->
			<form action="includes/process_post.php" method="post" name="post_form">      
			
            Title: <br>
			<input type="text" name="title" value = "Put your title here..." /><br>
			
            Body: <br>
			<textarea id="text" name="text" cols="40" rows ="10">Type your request here...</textarea> <br>
			
			Pickup location: <br>
			<input type="text" name="address" value = "Where will you pick this up?" /><br>
			
			Offering fee:<br>
			<input type="number" name="fee" step="0.01" min="0" /><br>
			
			Type of items:<br>
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