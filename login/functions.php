<?php

	function email_exists ($email, $con)
	{
		$result = mysqli_query($con,"SELECT id_usuario FROM usuarios WHERE email='$email'");

		if(mysqli_num_rows($result) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	function logged_in()
	{
		if(isset($_SESSION['email']) || isset($_COOKE['email']))
		{
			return true;

		}
		else
		{
			return false;
		}
	}