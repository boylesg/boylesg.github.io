<?php

	include "../common.php";

	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "")
		{
		}
		else if ($_POST["button"] == "")
		{
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	else
	{
		print_r($_POST);
	}

?>
