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
			//echo "Successfully connected to '". $strNameDB . "'!";
		}
		return $dbFindATradie;
	}
	$g_dbFindATradie = ConnectToDatabase();
	
	function DoFindOneQuery($strQuery, $strColumnNane, $strValue)
	{
		global $g_dbFindATradie;
		
		$result = $g_dbFindATradie->query($strQuery);
		if ($result->num_rows > 1)
		{
			echo "<h1>ERROR: more than one row found for '" . $strColumnNane. "==" . $strValue . "'!";
			$result == null;
		}
		return $result;
	}
	
	function DoInsertQuery($strQuery, $strTableName, $strKeyCol, $strKeyColVal)
	{
		global $g_dbFindATradie;
		$result = null;
		$strFindQuery = "SELECT " . $strKeyCol . " FROM " . $strTableName . " WHERE " . $strKeyCol . "='" . $strKeyColVal . "'";
		
		$result = $g_dbFindATradie->query($strFindQuery);
		if ($result->num_rows > 0)
		{
		}
		else
		{
			$result = $g_dbFindATradie->query($strQuery);
			if (!$result)
			{
				echo "<h1>ERROR: new row '" . $strID . "' was not added successfully!";
				$result = null;
			}
		}
		return $result;
	}

	function PrintSpaces($nNum)
	{
		for ($nI = 0; $nI < $nNum; $nI++)
			echo "\t";
	}
	
?>



