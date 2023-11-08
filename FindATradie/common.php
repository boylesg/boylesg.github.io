<?php
	
	session_start();
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** CONSTANTS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_strEmailAdmin = "Email admin at gregplants@bigpond.com with this error message.";
	$g_nCostPerMonth = 10;


	
	
	
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
	
	function DebugPrint($strVarName, $strVarValue, $nHeadingLevel)
	{
		$strOpening = "<p>";
		$strClosing = "</p>";
		
		switch ($nHeadingLevel)
		{
			case 1: $strOpening = "<h1>"; $strClosing = "</h1>";break;
			case 2: $strOpening = "<h2>"; $strClosing = "</h2>";break;
			case 3: $strOpening = "<h3>"; $strClosing = "</h3>";break;
			case 4: $strOpening = "<h4>"; $strClosing = "</h4>";break;
			case 5: $strOpening = "<h5>"; $strClosing = "</h5>";break;
			case 6: $strOpening = "<h6>"; $strClosing = "</h6>";break;
		}
		echo $strOpening . $strVarName . " = " . $strVarValue . $strClosing . "<br>";
	}


	function PrintJSAlertSuccess($strMsg, $nNumIndents)
	{
		PrintJavascriptLine("SUCCESS: " . $strMsg . ".", $nNumIndents);
	}
	
	function PrintJSAlertError($strMsg, $nNumIndents)
	{
		PrintJavascriptLine("ERROR: " . $strMsg . ".", $nNumIndents);
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
			echo "ERROR: '". $e->getMessage() . "'<br/><br/>Trying to connect to database 'find_a_tradie'.<br/><br/>" . $g_strEmailAdmin;
		}
		return $dbFindATradie;
	}
	$g_dbFindATradie = ConnectToDatabase();
	
	
	
	
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




	function DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";
		
		return DoQuery($dbConnection, $strQuery);
	}
	
	
	
	
	function DoFindQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "'";
	
		return DoQuery($dbConnection, $strQuery);
	}
	
	
	
	
	function DoFindQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "'";		
	
		return DoQuery($dbConnection, $strQuery);
	}
	
	
	
	
	function DoInsertFindQuery1($dbConnection, $strQuery, $strTableName, $strColumnName, $strColumnValue)
	{
		$result = DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue);
		if ($result->num_rows == 0)
			$result = $dbConnection->query($strQuery);	
		
		return $result;
	}




	function DoInsertFindQuery2($dbConnection, $strQuery, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{
		$result = DoFindQuery($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2);
		if ($result->num_rows == 0)
			$result = $dbConnection->query($strQuery);
		
		return $result;
	}




	function DoInsertFindQuery3($dbConnection, $strQuery, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{		
		$result = DoFindQuery($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3);
		if ($result->num_rows == 0)
			$result = $dbConnection->query($strQuery);
		
		return $result;
	}
	
	
	
	
	function DoUpdateQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue, $strFindColumnName, $strFindColumnValue)
	{
		$strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName . "='" . $strColumnValue . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnValue . "'";
	
		return DoQuery($dbConnection, $strQuery);
	}




	function DoUpdateQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strFindColumnName, $strFindColumnValue)
	{
		$strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnName . "'";

		return DoQuery($dbConnection, $strQuery);
	}




	function DoUpdateQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strFindColumnName, $strFindColumnValue)
	{
		$strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "'," . $strColumnName3 . "='" .  $strColumnValue3 . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnName . "'";

		return DoQuery($dbConnection, $strQuery);
	}
	
	
	
	
	function DoDeleteQuery($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		$strQuery = "DELETE FROM " . $strTableName . " WHERE " . $strColumnName . "='" . $strColumnValue . "'";
		
		return DoQuery($dbConnection, $strQuery);
	}
	
	
	
	function DoInsertQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		$strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName . ") VALUES(" . $strColumnValue . ")";
		
		return DoQuery($dbConnection, $strQuery);
	}




	function DoInsertQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{
		$strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . ")";
		
		return DoQuery($dbConnection, $strQuery);
	}




	function DoInsertQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{
		$strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . "," . $strColumnValue3 . ")";
		
		return DoQuery($dbConnection, $strQuery);
	}
	
?>



