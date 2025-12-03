<?php
	session_start();
	$g_strEmailManager = "manager&millhouse.org.au";
	$g_strEmailPresident = "president&millhouse.org.au";

	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL QUERY FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function ConnectToDatabase()
	{
		$dbFindATradie = null;
		global $g_strEmailPresident;
		
		try
		{		
			$dbFindATradie = new mysqli("127.0.0.1", "root", "qDHt7vvFvsOvUPG5", "millhouse_db");
		}
		catch(Exception $e)
		{
			$strMsg = $e->getMessage();
			$strMsg = str_replace("\"", "'", $strMsg);
			PrintJavascriptLine("AlertError(\"'" . $strMsg . "'\");", 2, true);
			//echo "ERROR: '". $e->getMessage() . "'<br/><br/>Trying to connect to database 'find_a_tradie'.<br/><br/>" . $g_strEmailPresident;
		}
		return $dbFindATradie;
	}
	$g_dbMillhouse = ConnectToDatabase();
	$g_strQuery = "";
	
	function DoQuery($dbConnection, $strQuery)
	{
		global $g_strEmailPresident;
		$result = "";

		try
		{	
			$result = $dbConnection->query($strQuery);		
		}
		catch(Exception $e) 
		{
			PrintJavascriptLine("AlertError(\"'" . $e->getMessage() . "' with query '" . $strQuery . "'\");", 2, true);
  			//echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailPresident;
		}		
		return $result;
	}

	function DoFindAllQuery($dbConnection, $strTableName, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName;
		
		if (strcmp($strCondition, "") != 0)
			$g_strQuery = $g_strQuery . " WHERE " . $strCondition;
			
		if (strcmp($strOrderBy, "") != 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
				$g_strQuery = $g_strQuery . " ASC";
			else
				$g_strQuery = $g_strQuery . " DESC";
		}		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery0($dbConnection, $strTableName, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName;

		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " WHERE " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";

		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}	
	
	function DoFindQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "'";
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery4($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "' AND " . $strColumnName4 . "='" . EscapeSingleQuote($strColumnValue4) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery5($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "' AND " . $strColumnName4 . "='" . EscapeSingleQuote($strColumnValue4) . "' AND " . $strColumnName5 . "='" . EscapeSingleQuote($strColumnValue5) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery6($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "' AND " . $strColumnName4 . "='" . EscapeSingleQuote($strColumnValue4) . "' AND " . $strColumnName5 . "='" . EscapeSingleQuote($strColumnValue5) . "' AND " . $strColumnName6 . "='" . EscapeSingleQuote($strColumnValue6) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery7($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "' AND " . $strColumnName4 . "='" . EscapeSingleQuote($strColumnValue4) . "' AND " . $strColumnName5 . "='" . EscapeSingleQuote($strColumnValue5) . "' AND " . $strColumnName6 . "='" . EscapeSingleQuote($strColumnValue6) . "' AND " . $strColumnName7 . "='" . EscapeSingleQuote($strColumnValue7) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery8($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strCondition = "", $strOrderBy = "", $bAscending = true)
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "' AND " . $strColumnName4 . "='" . EscapeSingleQuote($strColumnValue4) . "' AND " . $strColumnName5 . "='" . EscapeSingleQuote($strColumnValue5) . "' AND " . $strColumnName6 . "='" . EscapeSingleQuote($strColumnValue6) . "' AND " . $strColumnName7 . "='" . EscapeSingleQuote($strColumnValue7) . "' AND " . $strColumnName8 . "='" . EscapeSingleQuote($strColumnValue8) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;
		if (strlen($strOrderBy) > 0)
		{
			$g_strQuery = $g_strQuery . " ORDER BY " . $strOrderBy;
			if ($bAscending)
			{
				$g_strQuery = $g_strQuery . " ASC";
			}
			else
			{
				$g_strQuery = $g_strQuery . " DESC";
			}
		}
		return DoQuery($dbConnection, $g_strQuery);
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
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnValue . "'";
	
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "' WHERE " . 
			$strFindColumnName . "='" . EscapeSingleQuote($strFindColumnValue) . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "'," . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "'," . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery4($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "'," . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "'," . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . 
			$strColumnName4 . "='" .  $strColumnValue4 . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery5($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery6($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . 
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) .
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery7($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . "', " .
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) . $strColumnName7 . "='" .  EscapeSingleQuote($strColumnValue7) .
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery8($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . "', " .
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) . "', " . $strColumnName7 . "='" .  EscapeSingleQuote($strColumnValue7) . 
			$strColumnName8 . "='" .  EscapeSingleQuote($strColumnValue8) . "', " .
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery9($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . "', " .
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) . "', " . $strColumnName7 . "='" .  EscapeSingleQuote($strColumnValue7) . "', " .
			$strColumnName8 . "='" .  EscapeSingleQuote($strColumnValue8) . "', " . $strColumnName9 . "='" .  EscapeSingleQuote($strColumnValue9) . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery10($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9, $strColumnName10, $strColumnValue10, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . "', " .
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) . "', " . $strColumnName7 . "='" .  EscapeSingleQuote($strColumnValue7) . "', " .
			$strColumnName8 . "='" .  EscapeSingleQuote($strColumnValue8) . "', " . $strColumnName9 . "='" .  EscapeSingleQuote($strColumnValue9) . "', " .
			$strColumnName10 . "='" .  EscapeSingleQuote($strColumnValue10) . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery11($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9, $strColumnName10, $strColumnValue10, $strColumnName11, $strColumnValue11, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "', " . 
			$strColumnName2 . "='" .  EscapeSingleQuote($strColumnValue2) . "', " . $strColumnName3 . "='" .  EscapeSingleQuote($strColumnValue3) . "', " .
			$strColumnName4 . "='" .  EscapeSingleQuote($strColumnValue4) . "', " . $strColumnName5 . "='" .  EscapeSingleQuote($strColumnValue5) . 
			$strColumnName6 . "='" .  EscapeSingleQuote($strColumnValue6) . "', " . $strColumnName7 . "='" .  EscapeSingleQuote($strColumnValue7) .
			$strColumnName8 . "='" .  EscapeSingleQuote($strColumnValue8) . "', " . $strColumnName9 . "='" .  EscapeSingleQuote($strColumnValue9) . 
			$strColumnName10 . "='" .  EscapeSingleQuote($strColumnValue10) . "', " . $strColumnName11 . "='" .  EscapeSingleQuote($strColumnValue11) .
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoDeleteQuery($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "DELETE FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName . ") VALUES('" . EscapeSingleQuote($strColumnValue) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoInsertQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoInsertQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery4($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery5($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery6($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery7($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . "," . $strColumnName7 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "','" . EscapeSingleQuote($strColumnValue7) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery8($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . "," . $strColumnName7 . "," . $strColumnName8 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "','" . EscapeSingleQuote($strColumnValue7) . "','" . EscapeSingleQuote($strColumnValue8) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery9($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . "," . $strColumnName7 . "," . $strColumnName8 . "," . $strColumnName9 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "','" . EscapeSingleQuote($strColumnValue7) . "','" . EscapeSingleQuote($strColumnValue8) . "','" . EscapeSingleQuote($strColumnValue9) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery10($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9, $strColumnName10, $strColumnValue10)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . "," . $strColumnName7 . "," . $strColumnName8 . "," . $strColumnName9 . "," . $strColumnName10 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "','" . EscapeSingleQuote($strColumnValue7) . "','" . EscapeSingleQuote($strColumnValue8) . "','" . EscapeSingleQuote($strColumnValue9)  . "','" . EscapeSingleQuote($strColumnValue10) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery11($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strColumnName6, $strColumnValue6, $strColumnName7, $strColumnValue7, $strColumnName8, $strColumnValue8, $strColumnName9, $strColumnValue9, $strColumnName10, $strColumnValue10, $strColumnName11, $strColumnValue11)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . "," . $strColumnName6 . "," . $strColumnName7 . "," . $strColumnName8 . "," . $strColumnName9 . "," . $strColumnName10 . "," . $strColumnName11 . ") VALUES('" . EscapeSingleQuote($strColumnValue1) . "','" . EscapeSingleQuote($strColumnValue2) . "','" . EscapeSingleQuote($strColumnValue3) . "','" . EscapeSingleQuote($strColumnValue4) . "','" . EscapeSingleQuote($strColumnValue5) . "','" . EscapeSingleQuote($strColumnValue6) . "','" . EscapeSingleQuote($strColumnValue7) . "','" . EscapeSingleQuote($strColumnValue8) . "','" . EscapeSingleQuote($strColumnValue9)  . "','" . EscapeSingleQuote($strColumnValue10) . "','" . EscapeSingleQuote($strColumnValue11) . "')";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoDeleteQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "DELETE FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoGetLastInserted($strTable, $strColumn, $strValue)
	{
		global $g_dbMillhouse;
		global $g_strQuery;
		
		//$g_strQuery = "SELECT LAST from " . $strTable . " WHERE " . $strColumn . " = '" . $strValue . "'";
		$g_strQuery = "SELECT * FROM " . $strTable . " WHERE (id = @last_id) AND (" . $strColumn . " = '" . $strValue . "')";
		$results = DoQuery($g_dbMillhouse, $g_strQuery);
		
		return $results;
	}
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** EVENT PAGE STUFF
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_strDisplayEventForm = "none";
	$g_strImageWidth = "300";
	$g_nEventShortkey = 0;
	
	function PrintIndents($nNum)
	{
		for ($nI = 0; $nI < $nNum; $nI++)
			echo "\t";
	}
	
	function PrintJavascriptLine($strCode, $nNumIndents, $bScriptTags)
	{
		if ($bScriptTags)
		{
			PrintIndents($nNumIndents);
			echo "<script type=\"text/javascript\">\n";
			PrintIndents($nNumIndents + 1);
			echo $strCode . "\n";
			PrintIndents($nNumIndents);
			echo "</script>\n";
		}
		else
		{
			PrintIndents($nNumIndents);
			echo $strCode . "\n";
		}
	}

	function EscapeSingleQuote($strText)
	{
		return str_replace("'", "''", $strText);
	}

	function DoDeleteOldPhoto($nShortkey)
	{
		global $g_dbMillhouse;
		$result = DoFindQuery1($g_dbMillhouse, "events", "shortkey", $nShortkey);

		if ($result->num_rows > 0)
		{
			if ($row = $results->fetch_assoc())
			{
				if (file_exists($row["event_photo"])) 
    				unlink("images/" . $row["event_photo"]);
			}
		}
	}
	
	function DoUploadEvent()
	{
		global $g_dbMillhouse;
		$nShortkey = (int)$_POST[""];
		
		if ($nShortkey == 0)
		{
			DoInsertQuery3($g_dbMillhouse, "events", "date", $_POST["date"], "event_description", $_POST["description"], "event_photo", $_FILES['photo']["name"]);
		}
		else
		{
			DoUpdateQuery3($g_dbMillhouse, "events", "date", $_POST["date"], "event_description", $_POST["description"], "event_photo", $_FILES['photo']["name"], "event_shortkey", $_POST["shortkey"]);
		}
		if (strlen($_FILES['photo']["name"]) > 0)
		{
			if ($nShortkey > 0)
			{
				DoDeleteOldPhoto($nShortkey);
			}
			if (isset($_FILES['photo']["name"]) && (strlen($_FILES['photo']["name"]) > 0))
			{
				if (!move_uploaded_file($_FILES['photo']["tmp_name"], "images/" . $_FILES['photo']["name"]))
				{
				}
			}
		}
	}
	
	function DoGetGroupShortkey($strGroupName)
	{
		global $g_dbMillhouse;
		$nGroupShortkey = 0;
		
		if (DoFindQuery1($g_dbMillhouse, "groups", "group_name", $strGroupName))
		{
			if ($result->num_rows > 0)
			{
				if ($row = $results->fetch_assoc())
				{
					$nGroupShortkey = $row["shortkey"];
				}
			}
		}
		return $nGroupShortkey;
	}
	
	function DoGetEventOptions($strGroupName)
	{
		global $g_dbMillhouse;
		$strEventOptionsHTML = "";
		$nGroupShortkey = DoGetGroupShortkey($strGroupName);
		
		if (DoFindQuery1($g_dbMillhouse, "events", "group_shortkey", $nGroupShortkey))
		{
			if ($result->num_rows > 0)
			{
				while ($row = $results->fetch_assoc())
				{
					$timestamp = strtotime($row["date"]);
					$strEventOptionsHTML .= "<option value=\"" . $row["shortkey"] . "\">" . date("l, F j, Y", $timestamp) . "</option>\n";
				}
			}
		}
		return $strEventOptionsHTML;
	}
	
	function DoEventLogin()
	{
		global $g_dbMillhouse;
		$bResult = false;
		
		if (DoFindQuery2($g_dbMillhouse, "groups", "group_name", $_POST["username"], "password", $_POST["password"]))
		{
			if ($result->num_rows > 0)
			{
				$bResult = true;
			}
		}
		return $bResult;
	}
	
	function DoGetEvents($strGroupName, &$strHTML)
	{
		global $g_dbMillhouse;
		$strGroupName = "";
		$nGroupShortkey = DoGetGroupShortkey($strGroupName);
echo "######" . $strGroupName . "#######<br>";
		if ($nGroupShortkey > 0)
		{
			if ($result = DoFindQuery1($g_dbMillhouse, "events", "group_shortkey", $nGroupShortkey, "", "date", false))
			{
				if ($result->num_rows > 0)
				{
					while ($row = $results->fetch_assoc())
					{
						$timestamp = strtotime($row["date"]);
						$strGroupName = "<h2>" . date("l, F j, Y", $timestamp) . "</h2>\n";
						$strGroupName .= "<p>" . $row["event_description"] . "</p>\n";
						if (strlen($row["event_photo"]) > 0)
							$strGroupName .= "<img src=\"images/" . $row["event_photo"] . "\" alt=\"\" width=\"" . $g_strImageWidth . "\" />\n";
						else
						{
							$strGroupName = "<h2>" . date("l, F j, Y") . "</h2>\n";
							$strGroupName .= "<p>NO EVENTS AVAILABLE YET</p>";
							$strGroupName .= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut " . 
							"labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris " . 
							"nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit " . 
							"esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt " . 
							"in culpa qui officia deserunt mollit anim id est laborum.</p>\n";
							$strGroupName .= "<img src=\"../../images/underconstruction.jpg\" alt=\"\" width=\"" . $g_strImageWidth . "\" />\n";
						}
					}							
				}
			}
		}
	}

?>
