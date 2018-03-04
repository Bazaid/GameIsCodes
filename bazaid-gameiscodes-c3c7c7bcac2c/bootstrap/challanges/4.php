<?php

	$user = $_POST['username'];
	$pass = $_POST['pass'];
	
	if($user != NULL and $pass != NULL)
	{
		if($user == "x9000hx" and $pass == "x9000hx")
		{
			Header('Location: http://localhost/gameiscodes/dashboard/WinChallange/4/mainchallanges/x9000hx/');
		} else 
		{
			Header('Location: http://localhost/gameiscodes/dashboard/');
		}
	}

?>