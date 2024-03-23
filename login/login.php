<?php
	
	include("connect.php");
	include("functions.php");
	
	if(logged_in() == true)
	{
		header("location:profile.php");
		exit();
	}

	$error ="";

	if(isset($_POST['submit']))
	{
		
		$email = ($_POST['email']);
		$senha = ($_POST['senha']);
		$checkBox = isset ($_POST['keep']);

		if(email_exists($email, $con))
		{
			$result = mysqli_query($con, "SELECT senha FROM usuarios WHERE email='$email'");
			$retrievepassword = mysqli_fetch_assoc($result);


			if($senha !== $retrievepassword['senha'])
			{
				$error = "Password is incorrect";
			}
			else
			{
				$_SESSION['email'] = $email;

				if($checkbox == "on")
				{
					setcookie("email",$email, time()+3600);
				}

				header("location: profile.php");
			}

			
		}	
		else
		{
			$error = "Email Dose not exists";
		}


	}

?>


<!doctype html>

<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>	

	<body>
		<div id="wrapper">
			<div id ="error"><?php echo $error ?></div>
			<div id ="menu">
				<a href="index.php">Sign Up</a>
				<a href="login.php">Login</a>	
			</div>
			<div id="formDiv">
				<form method="POST" action="login.php">

					<lable>Email:</label></br>
					<input type="text" name="email" required/><br/><br/>
					
					<lable>Password:</label></br>
					<input type="password" name="senha" required/><br/><br/>
					

					<input type="checkbox" name="keep" />
					<lable>Remember Me</label></br></br>
					

					<input type="submit" name="submit" value="login"/>

				</form>

			</div>

		</div>	
	</body>	
</html>