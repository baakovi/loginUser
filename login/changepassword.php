<?php
	
	include("connect.php");
	include("functions.php");

	$error = "";
	if(isset($_POST['savepass']))
	{
		$senha = $_POST['senha'];
		$confirmSenha = $_POST['senhaConfirm'];

		if(strlen($senha) < 8)
		{
			$error = "Password must be greater than 8 characters";
		}
		else if($senha !== $confirmSenha)
		{
			$error = "Password dose not match";
		}
		else
		{
			$senha = md5($senha);

			$email = $_SESSION['email'];
			if(mysqli_query($con, "UPDATE usuarios SET senha='$senha' WHERE email='$email'"))
			{
				$error = "Password change successfully, <a href='profile.php'>click here</a> to got to the profile";
			}
		}
	}


	if(logged_in())
	{


	
	?>
	<?php echo $error;  ?>
		<form method="POST" action="changepassword.php">
			<lable>Password:</label></br>
			<input type="password" name="senha" /><br/><br/>
		
			<lable>Confirm Password:</label></br>
			<input type="password" name="senhaConfirm" /><br/><br/>

			<input type="submit" name="savepass" value="save"/><br/><br/>
		</form>	

	<?php
	}
	else
	{
		header("location: profile.php");
	}


?>