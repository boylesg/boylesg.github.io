<?php

	$g_bIsApp = true;
	require_once "../common.php";
	
	if (isset($_POST["button"]))
	{
		if (ProcessAdvertFunction())
		{
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	
?>