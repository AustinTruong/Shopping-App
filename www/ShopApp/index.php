<!--
	index.php
	
	login code from tutorial at 
	http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
	
	other code by: Austin Truong
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
			echo '<p><a href="profile.php">Click here to see and edit your posts.</a><p>';
			echo "<p><a href='post.php'>Click here to create a listing.</a></p>";
        } 
		if(isset($_POST['sort_type']))
			$sort_type = filter_var($_POST['sort_type'], FILTER_SANITIZE_STRING);
	?>    
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		Select an option to sort the list below:<br>
		<input type="radio" name="sort_type" 
			<?php if (isset($sort_type) && $sort_type=="food") echo "checked";?>  value="food">
			Food items<br>
		<input type="radio" name="sort_type" 
			<?php if (isset($sort_type) && $sort_type=="clothes") echo "checked";?>  value="clothes">
			Clothing and accessories<br>
		<input type="radio" name="sort_type" 
			<?php if (isset($sort_type) && $sort_type=="electronics") echo "checked";?>  value="electronics">
			Electronics<br>
		<input type="radio" name="sort_type" 
			<?php if (isset($sort_type) && $sort_type=="supplies") echo "checked";?>  value="supplies">
			Office and other supplies<br>
		<input type="radio" name="sort_type" 
			<?php if (isset($sort_type) && $sort_type=="misc") echo "checked";?>  value="misc">
			Miscellaneous items<br>
		<input type="radio" name="sort_type" 
			<?php if (!isset($sort_type) || (isset($sort_type) && $sort_type=="none")) echo "checked";?>  value="none">
			No preference<br>
		<br>
		<input type="submit" name="submit" value="Submit"> 
	</form>
	
	<?php
		$prep_stmt = "SELECT * 
        FROM posted_lists";
		if (isset($sort_type) && $sort_type != 'none')
		{
			$prep_stmt .= ' WHERE item_types = "' . $sort_type .'"';
		}
		if($stmt = $shopsv->prepare($prep_stmt)) {
				
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc()) {
				// Get matching name from secure_login
				$usern = find_name($row["user_id"],$mysqli);
				
				echo '<table border="1" style="width:100%"><tr><th scope="col" colspan="2">' . $usern. ' says...  </th></tr>';
				echo '<tr><td colspan="2">' . nl2br(htmlspecialchars($row["header"])). '</td></tr>';
				echo '<tr><td colspan="2">' . nl2br(htmlspecialchars($row["text"])). '</td></tr>';
				echo '<tr><td>Drop off: '.htmlspecialchars($row['drop_off']).'</td><td>Fee: $'.$row['fee'].'</td><tr>';
				echo "</table><br>";
			}
		}
	?>
	
    </body>
</html>