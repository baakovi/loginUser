<?php

	$con = mysqli_connect("localhost","root","","étiquette");

	if(mysqli_connect_errno())
	{
		echo"Error!!!".mysqli_connect_errno();
	}

	session_start();

?>