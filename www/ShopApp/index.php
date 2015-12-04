<!--
	index.php
	
	login code from tutorial at 
	http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
	
	other code by: Austin Truong
	CSS styling by: Jennifer Franco
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
        
		
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/style.css"> <!-- Gem style -->
		<script src="js/modernizr.js"></script> <!-- Modernizr -->
	
		<link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
		<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
		<link rel="stylesheet" href="main.css">
		
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
		
		<title>Log In &amp; Sign Up Form</title>
    </head>
	<header role="banner">
		<div id="cd-logo"><a href="index.html"><img src="logo.png" width="100" height="45" alt="Logo"></a></div>

		<nav class="main-nav">
			<ul>
				<!-- insert more links here -->
				<?php if (login_check($mysqli) == true) { ?>		<!-- User is logged in -->
				<li><a class="cd-signup" href="includes/logout.php">Log out</a></li>
				<li><a class="cd-signup" href="profile.php">Your posts</a></li>
				<li><a class="cd-signup" href="post.php">Create a post</a></li>
				<?php } else {?>									<!-- User is log out -->
				<li><a class="cd-signup" href="register.php">Sign up</a></li>
				<?php } ?>
				<li><a class="cd-signup" href="#0">Help</a></li> <!--Help link currently does not work, add-on for future dev-->
				
			</ul>
		</nav>
	</header>
	
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
	<!--<?php if (login_check($mysqli) == false) { ?>
        <form action="includes/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
    <?php } ?>-->
	<?php
		/*
		
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
        } */?>
	<?php
		// Get sort_type from post
		if(isset($_POST['sort_type']))
			$sort_type = filter_var($_POST['sort_type'], FILTER_SANITIZE_STRING);
		if(isset($_POST['sort_by']))
			$sort_by = filter_var($_POST['sort_by'], FILTER_SANITIZE_STRING);
	?>    
	
	<div class="jumbotron">
      <div class="container">
		<?php if (login_check($mysqli) == true) { ?>
		<h1> Welcome, <?php echo htmlspecialchars($_SESSION['username']);?>! </h1>
		<?php } else {?> <!-- User is logged out -->
        <h1>Sign In!</h1>
        <form action="includes/process_login.php" method="post" name="login_form">                      
            <p>Email: <br></p><input type="text" name="email" />
            <p>Password: <br></p><input type="password" 
                             name="password" 
                             id="password"/>
            <p><input type="button" style="color:black" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /></p>
        </form>
        <?php } ?>
		<p>Open the possibility to have your groceries delivered right to your door step.</p>
        <!--<a href="learnmore.html">Learn More Grouper</a> Uncomment if we actually implement this--> 
		
      </div>
    </div> 
    
	<div class="container">
		<p><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			Select a filter for the list below:<br>
			<select name = "sort_type">
				<option value="none" selected="selected"
				<?php if (!isset($sort_type) || $sort_type=="none") echo 'selected="selected"';?>>
					No preference</option>
				<option value="food"
					<?php if (isset($sort_type) && $sort_type=="food") echo 'selected="selected"';?>>
					Food and groceries</option>
				<option value="clothes"
					<?php if (isset($sort_type) && $sort_type=="clothes") echo 'selected="selected"';?>>
					Clothing and accessories</option>
				<option value="electronics"
					<?php if (isset($sort_type) && $sort_type=="electronics") echo 'selected="selected"';?>>
					Electronics</option>
				<option value="supplies"
					<?php if (isset($sort_type) && $sort_type=="supplies") echo 'selected="selected"';?>>
					Office and other supplies</option>
				<option value="misc"
					<?php if (isset($sort_type) && $sort_type=="misc") echo 'selected="selected"';?>>
					Miscellaneous items</option>
			</select>
			<br>
			Select a sort method for the list below:<br>
			<select name = "sort_by">
				<option value="none" 
					<?php if (isset($sort_by) && $sort_by=="none") echo 'selected="selected"';?>>No preference</option>
				<option value="submit_time" 
					<?php if (isset($sort_by) && $sort_by=="submit_time") echo 'selected="selected"';?>>Time submitted</option>
				<option value="fee" 
					<?php if (isset($sort_by) && $sort_by=="fee") echo 'selected="selected"';?>>Service fee</option>
				<option value="header" 
					<?php if (isset($sort_by) && $sort_by=="header") echo 'selected="selected"';?>>Header</option>
			</select>
			<input type="submit" name="submit" value="Submit"> 
		</form>
		</p><p>
		<style>
		table {
			border-collapse: collapse;
		}

		table, td, th {
			border: 1px solid black;
		}
		</style>
		<div class=container>
		<?php
			$prep_stmt = "SELECT * 
			FROM posted_lists";
			if (isset($sort_type) && $sort_type != 'none')
			{
				$prep_stmt .= ' WHERE item_types = "' . $sort_type .'"';
			}
			if (isset($sort_by) && $sort_by != 'none')
			{
				$prep_stmt .= ' ORDER BY ' . $sort_by .'';
			}
			//echo $prep_stmt;
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
		?></div></p>
	</div>
    </body>
</html>