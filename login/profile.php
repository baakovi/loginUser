<?php
	
	include("connect.php");
	include("functions.php");

	if (logged_in())
	{
		echo "You are logged in";
	?>
		<a href="changepassword.php">Change Password</a>
		<a href="logout.php" style="float:right; padding: 10px; margin-right:40px; background-color:#eee; color:#333; text-decoration: none;">Logout</a>

	<?php	


	}else
	{
		header("location:login.php");
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>Logged <?php echo $_SESSION['email'] ?></h1>
</body>
</html>