<?php

	$con = mysqli_connect("127.0.0.1","root","","cse");
	if(mysqli_connect_errno())
	{
		echo "Error occure while connecting with database".mysqli_connect_errno();	
	}
	else
	{
		echo "connected";
	}


session_start();
?>