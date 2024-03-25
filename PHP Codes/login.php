<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="loginBox">
		<img src="download.png" class="user" height="100" width="100">
		<h2>Log In Here</h2>
		<form method="post">
			<p>User Name</p>
			<input type="text" name="email" placeholder="Enter User Name">
			<p>Password</p>
			<input type="password" name="pass" placeholder=".....">
			<input type="submit" name="submit" value="Sign In">
			<a href="signup.php">Signup</a>
		</form>
	</div>

	<?php
	session_start();
	$con = mysqli_connect("localhost", "root", "@pes1234", "Airline");

	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		// Prevent SQL injection
		$email = mysqli_real_escape_string($con, $email);
		$pass = mysqli_real_escape_string($con, $pass);

		$sql = "SELECT * FROM Customer WHERE User_Name='$email' AND Pswd='$pass'";
		$query = mysqli_query($con, $sql);
		$numrows = mysqli_num_rows($query);

		if ($numrows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$dbename = $row['User_Name'];
				$dbpassword = $row['Pswd'];
			}

			if ($email == $dbename && $pass == $dbpassword) {
				$_SESSION['sess_user'] = $email;
				header("Location: page1.php");
				exit; // Ensure script stops execution after redirection
			}
		} else {
			echo "Invalid username or password!";
		}
	}
	?>
</body>

</html>