<!--This is my iffy sight-->
<!DOCTYPE html> 
<html lang = "en"> 
<head>
	<title>Check if usernanme already exists</title> 
</head>
<body> 
<div class= "form-wrapper">
	
		<h1 class="heading">Register Me</h1>
			<form method="post" action="create-account.php">
		<div>
			<input type="text" placeholder="User Name" name="userName" id="user" required>
		</div>
		<div>
			<input type="password" placeholder="Password" name="firstPassword" autocomplete="new-password" id="password_one" onkeyup="validate()" required>
		</div>
		<div>
			<input type="password" placeholder="Confirm Password" name="confirmPassword" onkeyup="validate()" id="password_two">
		</div>
		<div>
			<span id="message"></span>
		</div>
		<div>
			<input type="password" placeholder="Secret Code" name="secret" autocomplete="new-password">
		</div>
		<div>
			<input type="submit" name="submit" id = "subbutton" value="Create Account">
        </div>
		<div>
			<input type="reset">
		</div>
	</form>
</div> 
	<?php 
		//establish database connection
		//define constants
		//if we're on the local machine.  if the host is called local host 
			if($_SERVER['HTTP_HOST'] == "localhost")
			{
				define("HOST", "localhost");
				define("USER", "root"); 
				define("PASS", "sparky33"); 
				define("BASE", "lessinsecure");
			}
		//remote machine 
			else
			{
				define("HOST", "localhost");
				define("USER", "id10733680_less"); 
				define("PASS", "lessy"); 
				define("BASE", "id10733680_lessinsecure");
			}
			
		//connect to database
			$connection = mysqli_connect(HOST, USER, PASS, BASE);

		if(isset($_POST['submit']))
		{
			$user = $_POST['userName'];
			$firstP = $_POST['firstPassword'];
			$secondP = $_POST['confirmPassword'];
			$secret = $_POST['secret'];
			
			//hash
			$firstP = hash("SHA512", $firstP);
			
			$sql_u = "SELECT * FROM userinput WHERE username = '$user'";
			$sql_p = "SELECT * FROM userinput WHERE password ='$firstP'";
			$sql_s = "SELECT * FROM `secret code`";
			
			$results_u = mysqli_query($connection, $sql_u) or die("Sorry Cant Connect Boo");
			$results_p = mysqli_query($connection, $sql_p) or die("Sorry We can't do this");
			$results_s = mysqli_query($connection, $sql_s) or die("Sorry!"); 

		//print out resutls and set a flag to error trap 
			$rows = mysqli_fetch_array($results_s, MYSQLI_ASSOC);
			if($secret == $rows['secretCode'])
			{
				echo $rows['secretCode'];
				echo '<br>';
				$flag = true;
			}else{
				echo "sorry..the secret code doesn't work";
				echo '<br>';
			}

			if(mysqli_num_rows($results_u) > 0)
			{
				echo "Sorry that username is already taken!";

			}else{
				$query = "INSERT INTO userinput (username, password) VALUES('$user', '$firstP');";
				$results = mysqli_query($connection, $query) or die("Cant connect Miss");
				echo "Saved"; 
				exit();
			}
		}
?>
<script src="js/script.js"></script>
</body>
</html>