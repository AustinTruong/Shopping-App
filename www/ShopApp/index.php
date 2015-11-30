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
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
	<?php if (login_check($mysqli) == false) { ?>
        <form action="includes/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
    <?php
			echo '<p>Currently logged ' . $logged . '.</p>';
			echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
		} else {
			if (isset($_GET['welcome'])) {
				echo '<p class="error">Welcome!</p>';
			}
            echo '<p>Currently logged ' . $logged . ' as <b>' . htmlentities($_SESSION['username']) . '</b>.</p>';
            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
			echo "<p><a href='post.php'>Click here to create a listing.</a></p>";
        } 
	?>    
	<?php
		if($stmt = $shopsv->prepare("SELECT * 
        FROM posted_lists")) {
				
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc()) {
				// Get matching name from secure_login
				$usern = find_name($row["user_id"],$mysqli);
				
				echo '<table border="1" style="width:100%"><tr><td>' . $usern. " says...  </td></tr><tr><td>" . 
				nl2br(htmlspecialchars($row["text"])). "</td></tr></table>";
			}
		}
	?>
	
    </body>
</html>