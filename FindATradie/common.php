<?php
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** Colors
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_strColorBannerBG = "#C5D5E5";
	$g_strColorBodyBG = "white";

	//******************************************************************************
	//******************************************************************************
	//** 
	//** ERROR STRINGS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_strEmailAdmin = "Email admin at gregplants@bigpond.com with this error message.";

	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function PrintSpaces($nNum)
	{
		for ($nI = 0; $nI < $nNum; $nI++)
			echo "\t";
	}

	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** QUERY STRING FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function EscapeSingleQuote($strText)
	{
		return str_replace("'", "''", $strText);
	}
	
	
	
	
	function AppendSQLValues(...$param) 
	{
		global $g_dbFindATradie;
		$strQuery = "";

		foreach ($param as $strDataItem)
		{
			$strQuery = $strQuery . "'" . EscapeSingleQuote($strDataItem) . "', ";
		}
		$strQuery = substr_replace($strQuery, "", -2);
		
		return $strQuery;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** QUERY FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
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
	
	
	
	
	function DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{	
		global $g_strEmailAdmin;
		try
		{
			$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";
			$result = $dbConnection->query($strQuery);
		}
		catch(Exception $e) 
		{
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}
	
	
	
	
	function DoFindQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{	
		global $g_strEmailAdmin;
		try
		{
			$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "'";
			$result = $dbConnection->query($strQuery);
		}
		catch(Exception $e) 
		{
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}
	
	
	
	
	function DoQuery($dbConnection, $strQuery)
	{
		global $g_strEmailAdmin;
		$result = "";
		
		try
		{
			$result = $dbConnection->query($strQuery);		
		}
		catch(Exception $e) 
		{
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}




	function DoInsertQuery1($dbConnection, $strQuery, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strEmailAdmin;
		$result = "";
		
		try
		{
			$result = DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue);
			if ($result->num_rows == 0)
			{
				try
				{
					$result = $dbConnection->query($strQuery);
				}
				catch(Exception $e) 
				{
		  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
				}		
			}	
		}
		catch(Exception $e) 
		{
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}




	function DoInsertQuery2($dbConnection, $strQuery, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{
		global $g_strEmailAdmin;
		$result = "";
		
		try
		{
			$result = DoFindQuery($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2);
			if ($result->num_rows == 0)
			{
				try
				{
					$result = $dbConnection->query($strQuery);
				}
				catch(Exception $e) 
				{
		  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
				}		
			}	
		}
		catch(Exception $e) 
		{
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}



?>



