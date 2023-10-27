<?php

	function ConnectToDatabase()
	{
		$strNameDB = "find_a_tradie";
		$dbFindATradie = new mysqli("localhost", "root", "Pulsar112358#", $strNameDB);
	
		// Check connection
		if ($dbFindATradie->connect_errno) 
		{
		  echo "<h1>Failed to connect to MySQL: " . $dbFindATradie->connect_errno . "!</h1>";
		  exit();
		}
		else if ($dbFindATradie)
		{
			echo "Successfully connected to '". $strNameDB . "'!";
		}
		return $dbFindATradie;
	}
	$g_dbFindATradie = ConnectToDatabase();

?>



