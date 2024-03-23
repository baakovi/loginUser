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
		$nome = ($_POST['nome']);
		$email = ($_POST['email']);
		$senha = ($_POST['senha']);
		$senhaConfirm = ($_POST['senhaConfirm']);

		$conditions = isset($_POST['conditions']);

		$date = date("F, d Y");

		if(strlen($nome) < 3)
		{
			$error = "Name is too short";
		}

		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = "please enter valid email address.";
		}
		else if(email_exists($email, $con))
		{
			$error = "This email has already been registered.";
		}
		else if(strlen($senha) < 8)
		{
			$error= "Password must be greater than 8 charcters.";
		}
		else if($senha !== $senhaConfirm)
		{
			$error = "Password dose not match.";
		}	

		else if(!$conditions)
		{
			$error = "You must agree to the terms and conditions";
		}
		else
		{
			$senha = md5($senha);

			$insertQuery = "INSERT INTO usuarios(nome, email, senha) VALUES('$nome','$email','$senha')";
			if (mysqli_query($con, $insertQuery))
			{
				$error = "Your are successfully registered";
			}
			else
			{
				$error = "Doesn't work :(";
			}

		}	


	}

?>


<!doctype html>

<html>
	<head>
		<title>Registration Page</title>
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
				<form method="POST" action="index.php" enctype="multipart/form-data">

					<lable>Name:</label></br>
					<input type="text" name="nome" required/><br/><br/>
					<lable>Email:</label></br>
					<input type="text" name="email" required/><br/><br/>
					<lable>Password:</label></br>
					<input type="password" name="senha" required/><br/><br/>
					<lable>Confirm Password:</label></br>
					<input type="password" name="senhaConfirm" required/><br/><br/>
					<input type="checkbox" name="conditions" />
					<lable>I agree with terms and conditiosn</label></br></br>

					<input type="submit" name="submit" />

				</form>

			</div>

		</div>	
	</body>	
</html>