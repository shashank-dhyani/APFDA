<?php

	//continuing sessions from other pages
	session_start();

	//database connection
	include "dbconnect.php";

	//authenticating only if this page is redirected from the index.php
	if(isset($_POST['email'])) {
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password_hash = md5(mysqli_real_escape_string($conn,$_POST['password']));

		$qry = "SELECT * FROM `users`";
		$run = mysqli_query($conn, $qry);
		if($run){
			while($row = mysqli_fetch_array($run)) {
				if($email == $row['user_email']) {
					if($password_hash == $row['password_hash']) {
						$_SESSION['id'] = $row['id'];
						$_SESSION['user_email'] = $email;
						$_SESSION['type'] = $row['user_type'];
						header("Location: ./dashboard.php");
					}
				}
			}
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
			</head>
			<body>
				
				<script type="text/javascript">
					window.location = "./?m=1";
				</script>
			</body>
			</html>

			<?php
		}
	}
	else {
		header("Location: ./");
	}
?>