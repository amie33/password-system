<!doctype html> 
<html lang = "en">
<head>
	<title>Insecure Home Page</title>
	<link rel ="stylesheet" href="css/style2.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=VT323&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">

</head>
	<body>
<?php
	echo '<div class="pagewrap">';
		//if the submit button HAS NOT been pressed then show the form the user must fill out 
			if(empty($_POST['loginAccess']))
			{
				echo '<div class = "wrapper" >';
					echo'<h1 class= "heading">Insecure Password System</h1>';
					echo'<h2 class= "heading2">Please Enter in ALL Fields!</h2>';
					echo'<form method ="post" action="index.php">'; 
					echo'<input type = "text" name= "userN" placeholder = "UserName">'; 
					echo'<input type = "text" name="passW" placeholder = "Password">'; 
					echo'<input type = "submit" name="loginAccess">'; 
					echo'<input type = "reset">';
					echo'</form>';
				echo '</div>'; 
				
				echo '<div class ="controls">';
					echo '<audio controls src = "sounds/xfilestheme.wav"></audio>';
				echo '</div>';
			}
			else
			{
				//get the values from the database, if it exists then get the username and password
					if(isset($_POST["userN"]) && isset($_POST["passW"]))
					{
						$username = $_POST["userN"]; 
						$password = $_POST["passW"];
					}
				
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
						
					//write a database command select all the records from the lessinsecure userinput table 
						$sql = ("SELECT * FROM USERINPUT WHERE username = '$username' and password = '$password' ");
					
					//run command
						$results = mysqli_query($connection, $sql) or die("Cannot Connect :("); 
						
					//print out resutls and set a flag to error trap 
						$rows = mysqli_fetch_array($results, MYSQLI_ASSOC);
						$flag = false; 
					echo '<div class = "wrap2">';	 
						if($rows['username'] == $username && $rows['password'] == $password)
						{
							echo '<a class ="success" href="index.php">Access Granted Earthling!</a>';
							echo '<p class ="print">User Name: '. $rows['username']. '</p>';
							echo '<br>';
							echo '<p class ="print2">Password: '. $rows['password'], '</p>';
							echo '<img class ="right" src="img/mulder.gif"/>';
							echo '<audio autoplay loop src="sounds/peace.mp3"></audo>'; 
							$flag = true;
						}else
						{
							echo '<a class ="fail" id="fail" href ="index.php">Access Denied!</a>';
							echo '<img class ="wrong" src="img/mars1.gif"/>';
							echo '<audio autoplay loop id="evillaugh" src="sounds/evillaugh.wav"></audio>';
						}
						
					echo '</div>';
				}	
	echo '</div>';
		?>
	<script src="js/script.js"></script> 
	</body> 
</html>




















