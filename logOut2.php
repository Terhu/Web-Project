<?php
	include("functions.php");

	$name=$_COOKIE['LastName'];

	// if we correctly deleted the username, go back to the home page
	if(user_delete($name)!=0)
	{
		header("location: index.php");
	};
?>

