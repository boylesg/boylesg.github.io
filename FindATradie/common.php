<?php
	
	session_start();
	
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
	
	function PrintIndents($nNum)
	{
		for ($nI = 0; $nI < $nNum; $nI++)
			echo "\t";
	}
	
	function DebugPrint($strField, $strValue)
	{
		echo "<h1><b>" . $strField . " = </b>" . $strValue . "</h1><br>";
	}
	
	function PrintJavascriptLine($strCode, $nNumIndents)
	{
		PrintIndents($nNumIndents);
		echo "<script type=\"text/javascript\">\n";
		PrintIndents($nNumIndents + 1);
		echo $strCode . "\n";
		PrintIndents($nNumIndents);
		echo "</script>\n";
	}

	function PrintJavascriptLines($arrayStrCode, $nNumIndents)
	{
		echo "<script type=\"text/javascript\">\n";
		for ($nI = 0; $nI < count($arrayStrCode); $nI++)
		{
			PrintIndents($nNumIndents + 1);
			echo $arrayStrCode[$nI] . "\n";
		}
		echo "</script>\n";
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
		$dbFindATradie = null;
		global $g_strEmailAdmin;
		
		try
		{		
			$dbFindATradie = new mysqli("127.0.0.1", "debian-sys-maint", "wCN5zhYx5R6004zg", "find_a_tradie");
			//$dbFindATradie = new mysqli("127.0.0.1", "greg", "Pulsar112358#", "find_a_tradie");
		}
		catch(Exception $e)
		{
			echo "ERROR: '". $e->getMessage() . "'<br><br>" . $g_strEmailAdmin;
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
	
	
	
	
	function DoFindQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{	
		global $g_strEmailAdmin;
		try
		{
			$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "'";		
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




	function DoInsertQuery3($dbConnection, $strQuery, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{
		global $g_strEmailAdmin;
		$result = "";
		
		try
		{
			$result = DoFindQuery($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3);
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



