<?php
	
	session_start();
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** CONSTANTS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_nCostPerMonth = 10;
	$g_strDivOpen = "<div style=\"background-color:white;\">";
	$g_strDivClose = "</div>";
	$g_nNumMonthsFree = 6;
	$g_nTradeIDCustomer = 59;
	$g_strAdminEmail = "find-a-tradie@outlook.com";
	$g_strFreeMembership = "6 months";
	$g_nYears = (int)date("Y") - 2003;	
	$g_strPriceLevel1 = "60";
	$g_strPriceLevel2 = "80";
	$g_strPriceLevel3 = "100";
	$g_strPriceLevel4 = "120";
	$g_strPaypalLive = "none";
	$g_strPaypalTest = "block";
	
	$g_strMailToNewLine = "%0E%0A";
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** BACKGROUND IMAGE FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************

	function DoGetRandomBackgroundImage()
	{
		$strImagfeFileName = "background";
		$nNum = rand(1, 9);
		$strImagfeFileName = $strImagfeFileName . $nNum;
		return $strImagfeFileName;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** ENCRYPTION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	require_once "CryptoJSAES.php";
	$g_strKey = "dPRBqi32EH7LgfxuhWXm";
	
	setcookie("find-a-tradie", "encryption_key=" . $g_strKey . ",SameSite=Strict", 0, "/");
	
	function DoAESEncrypt($strPlainText)
	{
		global $g_strKey;

		//$strResult = base64_encode($strPlainText);

		$strResult = CryptoJsAes::encrypt($strPlainText, $g_strKey);

		return $strResult;
	}
	
	function DoAESDecrypt($strEncryptedText)
	{
		global $g_strKey;

		//$strResult = base64_decode($strEncryptedText);
		$strResult = CryptoJsAes::decrypt($strEncryptedText, $g_strKey);

		return $strResult;
	}
	


	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetStateSelectionIndex($strState)
	{
		$nI = 0;
		
		if (strcmp($strState, "ACT") == 0)
		{
			$nI = 0;
		}
		else if (strcmp($strState, "NSW") == 0)
		{
			$nI = 1;
		}
		else if (strcmp($strState, "NT") == 0)
		{
			$nI = 2;
		}
		else if (strcmp($strState, "QLD") == 0)
		{
			$nI = 3;
		}
		else if (strcmp($strState, "SA") == 0)
		{
			$nI = 4;
		}
		else if (strcmp($strState, "TAS") == 0)
		{
			$nI = 5;
		}
		else if (strcmp($strState, "VIC") == 0)
		{
			$nI = 6;
		}
		else if (strcmp($strState, "WA") == 0)
		{
			$nI = 7;
		}
		return $nI;
	}
	
	function DoGetJobSizeSelectionIndex($strJobSize)
	{
		$nI = 0;
		
		if (strcmp($strJobSize, "Not applicable") == 0)
		{
			$nI = 0;
		}
		else if (strcmp($strJobSize, "Up to 50") == 0)
		{
			$nI = 1;
		}
		else if (strcmp($strJobSize, "50 - 100") == 0)
		{
			$nI = 2;
		}
		else if (strcmp($strJobSize, "100 - 250") == 0)
		{
			$nI = 3;
		}
		else if (strcmp($strJobSize, "250 - 500") == 0)
		{
			$nI = 4;
		}
		else if (strcmp($strJobSize, "More than 500") == 0)
		{
			$nI = 5;
		}
		return $nI;
	}
	
	function DoGetDateNow()
	{
		$dateNow = new DateTime();
		return $dateNow->format("Y-m-d");
	}
	
	function RelaceCRLF($strText)
	{
		while (strpos($strText, "\r\n"))
			$strText = str_replace("\r\n", "<br/>", $strText);
		
		while (strpos($strText, "\n\r"))
			$strText = str_replace("\n\r", "<br/>", $strText);
		
		while (strpos($strText, "\n"))
			$strText = str_replace("\n", "<br/>", $strText);
		
		while (strpos($strText, "\r"))
			$strText = str_replace("\r", "<br/>", $strText);
		
		return $strText;
	}
	
	function PrintIndents($nNum)
	{
		for ($nI = 0; $nI < $nNum; $nI++)
			echo "\t";
	}
	
	function DoLeftPad($strText, $nLength, $strPad)
	{
		$nNum = $nLength - strlen($strText);
		
		for ($nI = 0; $nI < $nNum; $nI++)
			$strText = $strPad . $strText;
			
		return $strText;
	}
	
	function DoRightPad($strText, $nLength, $strPad)
	{
		$nNum = $nLength - strlen($strText);
		
		for ($nI = 0; $nI < $nNum; $nI++)
			$strText = $strText . $strPad;
			
		return $strText;
	}
	
	function DebugPrintMsg($strMsg, $nHeadingLevel, $strBGColor = "white")
	{
		$strOpening = "<div style=\"background-color:\"" . $strBGColor . "\">";
		$strClosing = "</div>";

		switch ($nHeadingLevel)
		{
			case 1: $strOpening = $strOpening . "<h1>"; $strClosing = "</h1>" . $strClosing ;break;
			case 2: $strOpening = $strOpening . "<h2>"; $strClosing = "</h2>" . $strClosing ;break;
			case 3: $strOpening = $strOpening . "<h3>"; $strClosing = "</h3>" . $strClosing ;break;
			case 4: $strOpening = $strOpening . "<h4>"; $strClosing = "</h4>" . $strClosing ;break;
			case 5: $strOpening = $strOpening . "<h5>"; $strClosing = "</h5>" . $strClosing ;break;
			case 6: $strOpening = $strOpening . "<h6>"; $strClosing = "</h6>" . $strClosing ;break;
			default: $strOpening = $strOpening . "<p>"; $strClosing = "</p>" . $strClosing ;break;
		}
		echo $strOpening . $strMsg . $strClosing . "<br>";
	}
	
	function DebugPrint($strVarName, $strVarValue, $nHeadingLevel, $strBGColor = "white")
	{
		$strOpening = "<div style=\"background-color:" . $strBGColor . "\">";
		$strClosing = "</div>";
		
		switch ($nHeadingLevel)
		{
			case 1: $strOpening = $strOpening . "<h1>"; $strClosing = "</h1>" . $strClosing ;break;
			case 2: $strOpening = $strOpening . "<h2>"; $strClosing = "</h2>" . $strClosing ;break;
			case 3: $strOpening = $strOpening . "<h3>"; $strClosing = "</h3>" . $strClosing ;break;
			case 4: $strOpening = $strOpening . "<h4>"; $strClosing = "</h4>" . $strClosing ;break;
			case 5: $strOpening = $strOpening . "<h5>"; $strClosing = "</h5>" . $strClosing ;break;
			case 6: $strOpening = $strOpening . "<h6>"; $strClosing = "</h6>" . $strClosing ;break;
			default: $strOpening = $strOpening . "<p>"; $strClosing = "</p>" . $strClosing ;break;
		}
		echo $strOpening . $strVarName . " = " . $strVarValue . $strClosing . "<br>";
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

	function PrintJSAlertSuccess($strMsg, $nNumIndents)
	{
		PrintJavascriptLine("AlertSuccess(\"" . $strMsg . "\");", $nNumIndents, true);
	}
	
	function PrintJSAlertWarning($strMsg, $nNumIndents)
	{
		PrintJavascriptLine("AlertWarning(\"" . $strMsg . "\");", $nNumIndents, true);
	}
	
	function PrintJSAlertError($strMsg, $nNumIndents)
	{
		global $g_strQuery;
		PrintJavascriptLine("AlertError(\"" . $strMsg . "\n\ng_strQuery = ". $g_strQuery . "\");", $nNumIndents, true);
	}
	
	function PrintJavascriptLines($arrayStrCode, $nNumIndents, $bScriptTags)
	{
		if ($bScriptTags)
		{
			echo "<script type=\"text/javascript\">\n";
			for ($nI = 0; $nI < count($arrayStrCode); $nI++)
			{
				PrintIndents($nNumIndents + 1);
				echo $arrayStrCode[$nI] . "\n";
			}
			echo "</script>\n";
		}
		else
		{
			for ($nI = 0; $nI < count($arrayStrCode); $nI++)
			{
				PrintIndents($nNumIndents);
				echo $arrayStrCode[$nI] . "\n";
			}
		}
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
	
	function ReplaceQuote($strText)
	{
		return str_replace("\"", "", str_replace("'", "", $strText));
	}
	
	function ReplaceSpaces($strText)
	{
		return str_replace(" ", "_", $strText);
	}
	
	function AppendSQLInsertValues(...$param) 
	{
		$strQuery = "";

		foreach ($param as $strDataItem)
		{
			$strQuery = $strQuery . "'" . EscapeSingleQuote($strDataItem) . "', ";
		}
		$strQuery = substr_replace($strQuery, "", -2);
		
		return $strQuery;
	}

	function AppendSQLUpdateValues(...$param) 
	{
		$strQuery = "";
		$nI = 0;

		foreach ($param as $strItem)
		{
			if (($nI % 2) == 0)
			{
				$strQuery = $strQuery . $strItem . "='";
			}
			else
			{
				$strQuery = $strQuery . EscapeSingleQuote($strItem) . "', ";
			}
			$nI++;
		}
		$strQuery = substr_replace($strQuery, "", -2);
		
		return $strQuery;
	}
	
	
	
	

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
		global $g_strEmailAdmin;
		
		try
		{		
			$dbFindATradie = new mysqli("127.0.0.1", "gregaryb", "Pulsar112358#", "find-a-tradie");
		}
		catch(Exception $e)
		{
			PrintJavascriptLine("AlertError(\"'" . $e->getMessage() . "'\");", 2, true);
			//echo "ERROR: '". $e->getMessage() . "'<br/><br/>Trying to connect to database 'find_a_tradie'.<br/><br/>" . $g_strEmailAdmin;
		}
		return $dbFindATradie;
	}
	$g_dbFindATradie = ConnectToDatabase();
	$g_strQuery = "";
	
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
			PrintJavascriptLine("AlertError(\"'" . $e->getMessage() . "' with query '" . $strQuery . "'\");", 2, true);
  			//echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
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
		global $g_dbFindATradie;
		global $g_strQuery;
		
		//$g_strQuery = "SELECT LAST from " . $strTable . " WHERE " . $strColumn . " = '" . $strValue . "'";
		$g_strQuery = "SELECT * FROM " . $strTable . " WHERE (id = @last_id) AND (" . $strColumn . " = '" . $strValue . "')";
		$results = DoQuery($g_dbFindATradie, $g_strQuery);
		
		return $results;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** SPECIFIC QUERY FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoFindMaxValueQuery1($dbConnection, $strTableName, $strColumnName)
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "=(SELECT MAX(" . $strColumnName . ") FROM " . $strTableName . ")";
		$result = DoQuery($dbConnection, $g_strQuery);
		return $result;
	}
	
	function DoGetMemberFullName($strMemberID)
	{
		global $g_dbFindATradie;
		$strName = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strName = $row["first_name"] . " " . $row["surname"];
			}
		}
		return $strName;
	}
	
	function DoGetCustomerTradeID()
	{
		global $g_dbFindATradie;
		$strCustomerTradeID = "";
		
		$results = DoFindAllQuery($g_dbFindATradie, "trades", "name = 'Customer' OR name = 'customer' OR name = 'CUSTOMER'");
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strCustomerTradeID = $row["id"];
			}
		}
		return $strCustomerTradeID;
	}
	
	function DoGetBusinessName($strMemberID)
	{
		global $g_dbFindATradie;
		$strBusinessName = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strBusinessName = $row["business_name"];
			}
		}
		return $strBusinessName;
}
	
	function DoGetMemberContactDetails($strMemberID, &$strPhone, &$strMobile, &$strEmail)
	{
		global $g_dbFindATradie;

		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strPhone = $row["phone"];
				$strMobile = $row["mobile"];
				$strEmail = $row["email"];
			}
		}
	}
	
	function DoGetMemberEmail($strMemberID)
	{
		$strPhone = "";
		$strMobile = ""; 
		$strEmail = "";
		
		DoGetMemberContactDetails($strMemberID, $strPhone, $strMobile, $strEmail);
		
		return $strEmail;
	}
		
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** STANARD IMAGE FILENAMES
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetLogoImageFilename($strMemberID, $bIsApp = true)
	{
		global $g_dbFindATradie;
		$strFilename = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strFilename = "images/" . ReplaceSpaces(ReplaceQuote($row["business_name"])) . ".jpg";
				if ($bIsApp)
					echo "OK";
			}
			else if ($bIsApp)
				echo "Failed to fetch row for member with ID '" . $strMemberID, "'!";
		}
		else if ($bIsApp)
		{
			echo "Member with ID '" . $strMemberID . "' was not found!";
		}
		return $strFilename;
	}
	
	function DoGetProfileImageFilename($strMemberID, $bIsApp = true)
	{
		global $g_dbFindATradie;
		$strFilename = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strFilename ="images/" . $row["first_name"] . "_" . $row["surname"] . ".jpg";
				if ($bIsApp)
					echo "OK";
			}
			else if ($bIsApp)
				echo "Failed to fetch row for member with ID '" . $strMemberID, "'!";
		}
		else if ($bIsApp)
		{
			echo "Member with ID '" . $strMemberID . "' was not found!";
		}
		return $strFilename;
	}




	//******************************************************************************
	//******************************************************************************
	//** 
	//** CONFIG TEABLE / FILE UPLOAD QUERIES
	//** 
	//******************************************************************************
	//******************************************************************************
	
	$g_strPROFILE = "PROFILE";
	$g_strLOGO = "LOGO";
		
	function DoSetConfigProfileImage($strMemberID)
	{
		global $g_dbFindATradie;
		
		$result = DoFindQuery1($g_dbFindATradie, "member_id", $strMemberID);
		if ($result && ($result->num_rows > 0))
		{
			if ($row = $result->fecth_assoc())
			{
				$results = DoUpdateQuery1($g_dbFindATradie, "config", "purpose", $g_strPROFILE, "member_id", $strMemberID);
			}
		}
		else
		{
			$results = DoUpdateInsert3($g_dbFindATradie, "config", "member_id", $strMemberID, "purpose", $g_strPROFILE, "advert_id", "");
		}
		return $results;
	}
	
	function IsProfileImageUpload(&$strMemberID)
	{
		global $g_dbFindATradie;
		$bResult = false;
		
		$result = DoQuery($g_dbFindATradie, "SELECT FIRST FROM config");
		if ($result && ($result->num_rows > 0))
		{
			if ($row = $result->fecth_assoc())
			{
				$bResult = strcmp($row["purpose"], $g_strPROFILE) == 0;
				$strMemberID = $row["member_id"];
			}
		}
		return $bResult;
	}
	
	function DoSetConfigLogoImage($strAdvertID, $strMemberID)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		
		$result = DoFindQuery1($g_dbFindATradie, "config", "member_id", $strMemberID);
		if ($result && ($result->num_rows > 0))
		{
			if ($row = $result->fecth_assoc())
			{
				$results = DoUpdateQuery2($g_dbFindATradie, "config", "advert_id", $strAdvertID, "purpose", $g_strLOGO, "member_id", $strMemberID);
			}
		}
		else
		{
			$result = DoInsertQuery3($g_dbFindATradie, "config", "advert_id", $strAdvertID, "purpose", $g_strLOGO, "member_id", $strMemberID);
		}
		return $results;
	}
	
	function IsLogoImageUpload()
	{
		global $g_dbFindATradie;
		$bResult = false;
		
		$result = DoQuery($g_dbFindATradie, "SELECT FIRST FROM config");
		if ($result && ($result->num_rows > 0))
		{
			if ($row = $result->fecth_assoc())
			{
				$bResult = strcmp($row["purpose"], $g_strLOGO) == 0;
			}
		}
		return $bResult;
	}	
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** CHECK FOR TABLE COLUMN VALUES
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoesColumnExist($strTableName, $strColumnName, $strColumnValue)
	{
		global $g_dbFindATradie;
		$bResult = false;
		
		$results = DoFindQuery1($g_dbFindATradie, $strTableName, $strColumnName, $strColumnValue);
		if ($results && ($results->num_rows > 0))
			$bResult = true;
			
		return $bResult;
	}
	
	function DoesUsernameExist($strUsername)
	{
		return DoesColumnExist("members", "username", $strUsername);
	}
	
	function DoesEmailExist($strEmail)
	{
		return DoesColumnExist("members", "email", $strEmail);
	}
	
	function DoGetRow1($strTableName, $strFindColumnName, $strFindColumnValue)
	{
		global $g_dbFindATradie;
		$row = "";
		$results = DoFindQuery1($g_dbFindATradie, $strTableName, $strFindColumnName, $strFindColumnValue);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;	
	}
	
	function DoGetRow2($strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2)
	{
		global $g_dbFindATradie;
		$row = "";
		$results = DoFindQuery2($g_dbFindATradie, $strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;	
	}
	
	function DoGetRow3($strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2, $strFindColumnName3, $strFindColumnValue3)
	{
		global $g_dbFindATradie;
		$row = "";
		$results = DoFindQuery3($g_dbFindATradie, $strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2, $strFindColumnName3, $strFindColumnValue3);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;	
	}
	
	function DoGetRow4($strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2, $strFindColumnName3, $strFindColumnValue3, $strFindColumnName4, $strFindColumnValue4)
	{
		global $g_dbFindATradie;
		$row = "";
		$results = DoFindQuery4($g_dbFindATradie, $strTableName, $strFindColumnName1, $strFindColumnValue1, $strFindColumnName2, $strFindColumnValue2, $strFindColumnName3, $strFindColumnValue3, $strFindColumnName4, $strFindColumnValue4);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;	
	}
	
	function DoGetColumnValue($strTableName, $strFindColumnName, $strFindColumnValue, $strReturnColumnName)
	{
		global $g_dbFindATradie;
		$strReturnValue = "";
		$results = DoFindQuery1($g_dbFindATradie, $strTableName, $strFindColumnName, $strFindColumnValue);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strReturnValue = $row[$strReturnColumnName];
			}
		}
		return $strReturnValue;	
	}
	
	
	
		
	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADE OPTIONS FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGenerateJobSizeOptions($strJobSize)
	{
		$arrayJobSize = ["Not applicable", "Up to 50", "50 - 100", "100 - 250", "250 - 500", "More than 500"];
		if (strlen($strJobSize) == 0)
			$strSelected = " selected";
					
		for ($nI = 0; $nI < count($arrayJobSize); $nI++)
		{
			if (strcmp($arrayJobSize[$nI], $strJobSize) == 0)
				$strSelected = " selected";
				
			echo "<option" . $strSelected . ">" . $arrayJobSize[$nI] . "</option>\n";
			$strSelected = "";
		}
	}
	
	// Generate options for a primary trade 'select' input, with one selection.
	function DoGeneratePrimaryTradeOptions($strTradeID)
	{
		global $g_dbFindATradie;
		$strSelected = "";
		
		if (strlen($strTradeID) == 0)
			$strSelected = " selected";
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
			
		while ($row = $queryResult->fetch_assoc())
	    {			
			if (strcmp($strTradeID, $row["id"]) == 0)
				echo " selected";
	    	PrintIndents(8);
			echo "<option value=\"" . $row["id"] . "\"" . $strSelected . ">" . $row["name"] . "</option>\n";
			$strSelected = "";
	    }
	    $queryResult->free_result();
	}
	
	// Check is a trade is among the list of additional trades for a tradie.
	function FindAdditionalTrade($arrayAdditionalTrades, $strTradeID)
	{
		$bFound = false;
		
		if ($arrayAdditionalTrades)
		{
			for ($nI = 0; $nI < count($arrayAdditionalTrades); $nI++)
			{
				$bFound = $arrayAdditionalTrades[$nI] == $strTradeID;
				if ($bFound)
					break;
			}
		}
		return $bFound;
	}
	
	// Generate options for an additional trade 'select' input, with multiple selections.
	function DoGenerateAdditionalTradeOptions($arrayAdditionalTrades)
	{
		global $g_dbFindATradie;
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	PrintIndents(8);
			echo "<option value=\"" . $row["id"] . "\"";
			
			if (FindAdditionalTrade($arrayAdditionalTrades, $row["id"]))
				echo " selected";
			
			echo ">";
			echo $row["name"];
			echo "</option>\n";
			$strSelected = "";
	    }
	    $queryResult->free_result();
	}
	
	
	
	
	// Generate a javascript map of trade name and description.
	function DoGenerateJavascriptTradeArray()
	{
		global $g_dbFindATradie;
		$arrayTrades = [];
		$strComma = ",";
		$nI = 0;
				
		// EXAMPLE Javascript map: const map = {"a": 1, "b": 2, "c": 3};
		$arrayTrades[] = "const g_mapTrades = {";
		
		$queryResult = $g_dbFindATradie->query("SELECT * FROM trades ORDER BY name");
		while ($row = $queryResult->fetch_assoc())
		{

		
			if ($nI == ($queryResult->num_rows - 1))
				$strComma = "";
			$arrayTrades[] = "\"" . $row["name"] . "\":\"" . $row["description"] . "\"" . $strComma;
			$nI++;
		}
		$arrayTrades[] = "};";
		PrintJavascriptLines($arrayTrades, 2, true);
	}
	if (!isset($g_bIsApp))
		DoGenerateJavascriptTradeArray();



	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** DEFAULT INPUT VALUES
	//** 
	//******************************************************************************
	//******************************************************************************

	function DoGetDefaultUsername()
	{
		$strUsername = "";
		
		if (isset($_POST["text_username"]))
			$strUsername = $_POST["text_username"];
		else if (isset($_SESSION['account_username'])) 
			$strUsername = $_SESSION['account_username'];
			
		return $strUsername;
	}
	
	function DoGetDefaultPassword()
	{
		$strPassword = "";
		
		if (isset($_POST["text_password"]))
			$strPassword = DoAESDecrypt($_POST["text_password"]);
		else if (isset($_SESSION['account_password'])) 
			$strPassword = $_SESSION['account_password'];

		return $strPassword;
	}
	
	function DoGetDefaultTrade()
	{
		$strTrade = "";
		
		if (isset($_POST["select_trade"]))
			$strTrade = $_POST["select_trade"];
		else if (isset($_SESSION["account_trade"]))
			$strTrade = $_SESSION["account_trade"];
			
		return $strTrade;	
	}

	function DoGetDefaultAdditionalTrades()
	{
		$strTrades = "";
		
		if (isset($_POST["select_additional_trades"]))
			$strTrades = $_POST["select_additional_trades"];
		else if (isset($_SESSION["account_additional_trades"]))
			$strTrades = $_SESSION["account_additional_trades"];
			
		return $strTrades;	
	}
	
	function DoGetDefaultBusinessName()
	{
		$strBusinessName = "";
		
		if (isset($_POST["text_business_name"]))
			$strBusinessName = $_POST["text_business_name"];
		else if (isset($_SESSION["account_business_name"]))
			$strBusinessName = $_SESSION["account_business_name"];

		return $strBusinessName ;
	}
	
	function DoGetDefaultABN()
	{
		$strABN = "";
		
		if (isset($_POST["text_abn"]))
			$strABN = $_POST["text_abn"];
		else if (isset($_SESSION["account_abn"]))
			$strABN = $_SESSION["account_abn"];

		return $strABN;
	}
	
	function DoGetDefaultStructure()
	{
		$strStructure = "";
		
		if (isset($_POST["select_structure"]))
			$strStructure = $_POST["select_structure"];
		else if (isset($_SESSION["account_structure"]))
			$strStructure = $_SESSION["account_structure"];

		return $strStructure;
	}

	function DoGetDefaultLicense()
	{
		$strLicense = "";
		
		if (isset($_POST["text_license"]))
			$strLicense = $_POST["text_license"];
		else if (isset($_SESSION["account_license"]))
			$strLicense = $_SESSION["account_license"];

		return $strLicense;
	}

	function DoGetDefaultJobDescription()
	{
		$strDescription = "";
		
		if (isset($_POST["text_job_description"]))
			$strDescription = $_POST["text_job_description"];

		return $strDescription;
	}

	function DoGetDefaultDescription()
	{
		$strDescription = "";
		
		if (isset($_POST["description"]))
			$strDescription = $_POST["description"];
		else if (isset($_SESSION["account_description"]))
			$strDescription = $_SESSION["account_description"];

		return $strDescription;
	}

	function DoGetDefaultMinimumCharge()
	{
		$strMinimumCharge = "";
		
		if (isset($_POST["text_minimum_charge"]))
			$strMinimumCharge = sprintf("%.2f", $_POST["text_minimum_charge"]);
		else if (isset($_SESSION["account_minimum_charge"]))
			$strMinimumCharge = sprintf("%.2f", $_SESSION["account_minimum_charge"]);

		return $strMinimumCharge;
	}

	function DoGetDefaultMinimumBudget()
	{
		$strMinimumBudget = "";
		
		if (isset($_POST["text_minimum_budget"]))
			$strMinimumBudget = sprintf("%.2f", $_POST["text_minimum_budget"]);
		else if (isset($_SESSION["account_minimum_budget"]))
			$strMinimumBudget = sprintf("%.2f", $_SESSION["account_minimum_budget"]);

		return $strMinimumBudget;
	}

	function DoGetDefaultMaximumSize()
	{
		$strMaximumSize = "";
		
		if (isset($_POST["select_maximum_size"]))
			$strMaximumSize = $_POST["select_maximum_size"];
		else if (isset($_SESSION["account_maximum_size"]))
			$strMaximumSize = $_SESSION["account_maximum_size"];
			
		return $strMaximumSize;
	}

	function DoGetDefaultMaximumDistance()
	{
		$strMaximumDistance = "";
		
		if (isset($_POST["text_maximum_distance"]))
			$strMaximumDistance = sprintf("%d", $_POST["text_maximum_distance"]);
		else if (isset($_SESSION["account_maximum_distance"]))
			$strMaximumDistance = sprintf("%d", $_SESSION["account_maximum_distance"]);

		return $strMaximumDistance;
	}

	function DoGetDefaultFirstName()
	{
		$strFirstName = "";
		
		if (isset($_POST["text_first_name"]))
			$strFirstName = $_POST["text_first_name"];
		else if (isset($_SESSION["account_first_name"]))
			$strFirstName = $_SESSION["account_first_name"];

		return $strFirstName;
	}

	function DoGetDefaultSurname()
	{
		$strSurname = "";
		
		if (isset($_POST["text_surname"]))
			$strSurname = $_POST["text_surname"];
		else if (isset($_SESSION["account_surname"]))
			$strSurname = $_SESSION["account_surname"];

		return $strSurname;
	}

	function DoGetDefaultUnit()
	{
		$strUnit = "";
		
		if (isset($_POST["text_unit"]))
			$strUnit = $_POST["text_unit"];
		else if (isset($_SESSION["account_unit"]))
			$strUnit = $_SESSION["account_unit"];

		return $strUnit;
	}

	function DoGetDefaultStreet()
	{
		$strStreet = "";
		
		if (isset($_POST["text_street"]))
			$strStreet = $_POST["text_street"];
		else if (isset($_SESSION["account_street"]))
			$strStreet = $_SESSION["account_street"];

		return $strStreet;
	}

	function DoGetDefaultSuburb()
	{
		$strSuburb = "";
		
		if (isset($_POST["text_suburb"]))
			$strSuburb = $_POST["text_suburb"];
		else if (isset($_SESSION["account_suburb"]))
			$strSuburb = $_SESSION["account_suburb"];

		return $strSuburb;
	}

	function DoGetDefaultState()
	{
		$strState = "";
		
		if (isset($_POST["select_state"]))
			$strState = $_POST["select_state"];
		else if (isset($_SESSION["account_state"]))
			$strState = $_SESSION["account_state"];

		return $strState;
	}

	function DoGetDefaultPostcode()
	{
		$strPostcode = "";
		
		if (isset($_POST["text_postcode"]))
			$strPostcode = $_POST["text_postcode"];
		else if (isset($_SESSION["account_postcode"]))
			$strPostcode = $_SESSION["account_postcode"];

		return $strPostcode;
	}

	function DoGetDefaultPhone()
	{
		$strPhone = "";
		
		if (isset($_POST["text_phone"]))
			$strPhone = $_POST["text_phone"];
		else if (isset($_SESSION["account_phone"]))
			$strPhone = $_SESSION["account_phone"];

		return $strPhone;
	}

	function DoGetDefaultMobile()
	{
		$strMobile = "";
		
		if (isset($_POST["text_mobile"]))
			$strMobile = $_POST["text_mobile"];
		else if (isset($_SESSION["account_mobile"]))
			$strMobile = $_SESSION["account_mobile"];

		return $strMobile;
	}

	function DoGetDefaultEmail()
	{
		$strEmail = "";
		
		if (isset($_POST["text_email"]))
			$strEmail = $_POST["text_email"];
		else if (isset($_SESSION["account_email"]))
			$strEmail = $_SESSION["account_email"];

		return $strEmail;
	}



	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL MEMBER LOOKUP FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetMember($strMemberID)
	{
		global $g_dbFindATradie;
		$row = NULL;
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
			$row = $results->fetch_assoc();
			
		return $row;
	}
	
	function IsTradie()
	{
		global $g_dbFindATradie;
		$bResult = false;
		
		if (isset($_SESSION["account_trade"]))
		{
			$result = DoFindQuery1($g_dbFindATradie, "trades", "id", $_SESSION["account_trade"]);
			if ($result && ($result->num_rows > 0))
			{
				$row = $result->fetch_assoc();
				$bResult = $row["name"] != "Customer";
			}
		}
		return $bResult;
	}
	
	function DoSaveMemberImage($strMemberID, $strColumnName, $strFilePath, $file)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$bResult = false;

		if (isset($file) && (strlen($file["tmp_name"]) > 0))
		{
			if (move_uploaded_file($file["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/" . $strFilePath))
			{
				$_SESSION["account_" . $strColumnName] = $strFilePath;
				$results = DoUpdateQuery1($g_dbFindATradie, "members", $strColumnName, $_SESSION["account_" . $strColumnName], "id", $strMemberID);

				if ($results)
				{
					//PrintJavascriptLine("AlertSuccess(\"Logo image file '" . $_FILES["logo_filename"]["name"] . "' was saved!\");", 3, true);
					$bResult = true;
				}
				else
				{
					PrintJavascriptLine("AlertError(\"Logo image column could not be updated!\");", 3, true);
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Could not save file '" . $_SESSION["account_" . $strColumnName] . "\");", 3, true);
			}
		}
		else
		{
			$bResult = true;
		}
		return $bResult;
	}
	
	function DoSaveProfileImage($strMemberID, $file)
	{
		$_SESSION["profile_filename"] = DoGetProfileImageFilename($strMemberID, false);
		if (!DoSaveMemberImage($strMemberID, "profile_filename", $_SESSION["profile_filename"], $file))
		{
			PrintJavascriptLine("AlertError('Could not save profile image file!')", 5, true);
		}
	}
	
	function DoSaveLogoImage($strMemberID, $file)
	{
		$_SESSION["logo_filename"] = DoGetLogoImageFilename($strMemberID, false);
		if (DoSaveMemberImage($strMemberID, "logo_filename", $_SESSION["logo_filename"], $file))
		{
			PrintJavascriptLine("AlertError('Could not save logo image file!')", 5, true);
		}
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADIE SEARCH FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function GetTradeName($strTradeID)
	{
		global $g_dbFindATradie;
		$strTradeName = "";

		$results = DoFindQuery1($g_dbFindATradie, "trades", "id", $strTradeID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strTradeName = $row["name"];
			}
		}
		return $strTradeName;
	}
	
	function GetAdditionalTradeNames($strMemberID)
	{
		global $g_dbFindATradie;
		$strTradeNames = "";

		$results1 = DoFindQuery1($g_dbFindATradie, "additional_trades", "member_id", $strMemberID);
		if ($results1 && ($results1->num_rows > 0))
		{
			while ($row1 = $results1->fetch_assoc())
			{
				$results2 = DoFindQuery1($g_dbFindATradie, "trades", "id", $row1["trade_id"]);
				if ($row2 = $results2->fetch_assoc())
				{
					$strTradeNames = $strTradeNames . $row2["name"] . ", ";
				}
			}
			$strTradeNames = substr($strTradeNames, 0, strlen($strTradeNames) - 2);
		}
		return $strTradeNames;
	}
	
	function IsTradeMatch($strPrimaryTradeID, $arrayAdditionalTradeIDs, $strTargetTradeID)
	{
		$bMatch = false;
		
		if ($strPrimaryTradeID == $strTargetTradeID)
			$bMatch = true;
		else
		{
			for ($nI = 0; $nI < count($arrayAdditionalTradeIDs); $nI++)
			{
				if ($arrayAdditionalTradeIDs[$nI] == $strTargetTradeID)
				{
					$bMatch = true;
					break;
				}
			}
		}
		return $bMatch;
	}
	
	function DoGetJobSizeIndex($strJobSize)
	{
		$nTradieMaxSizeIndex = 0;
		
		if ($strJobSize == "Up to 50")
			$nTradieMaxSizeIndex = 1;
		else if ($strJobSize == ">50 - 100")
			$nTradieMaxSizeIndex = 2;
		else if ($strJobSize == "100 - 250")
			$nTradieMaxSizeIndex = 3;
		else if ($strJobSize == "250 - 500")
			$nTradieMaxSizeIndex = 4;
		else if (($strJobSize == "More than 500") || ($strJobSize == "500 plus"))
			$nTradieMaxSizeIndex = 5;
		else if ($strJobSize == "Up to 50")
			$nTradieMaxSizeIndex = 6;
			
		return $nTradieMaxSizeIndex;
	}
	
	function IsMatchMaxSize($strTradieMaxSize, $strJobSizeIndex)
	{
		$nJobSize = (int)$strJobSizeIndex;
		$nTradieMaxSizeIndex = DoGetJobSizeIndex($strTradieMaxSize);
					
		return $nJobSize <= $nTradieMaxSizeIndex;
	}
	
	function DoCalculateDistance($fLat1, $fLong1, $fLat2, $fLong2) 
	{
		$nDistance = 0;
		
  		if (($fLat1 != $fLat2) || ($fLong1 != $fLong2))
  		{
			$fTheta = $fLong1 - $fLong2;
			$nDistance = sin(deg2rad($fLat1)) * sin(deg2rad($fLat2)) +  cos(deg2rad($fLat1)) * cos(deg2rad($fLat2)) * cos(deg2rad($fTheta));
			$nDistance = acos($nDistance);
			$nDistance = rad2deg($nDistance);
			$nDistance = $nDistance * 60 * 1.1515 * 1.609344/*km conversion*/;
  		}
  		return $nDistance;
	}
	
	function IsDistanceMatch($strPostcode1, $strPostcode2, $strTradieMaxDistance)
	{
		global $g_dbFindATradie;
		$bResult = false;
	
		$results = DoFindQuery1($g_dbFindATradie, "postcodes_geolocation", "postcode", (int)$strPostcode1);
		if ($results && ($results->num_rows > 0))
		{	
			$row = $results->fetch_assoc();
			if ($row)
			{		
				$fLat1 = $row["latitude"];
				$fLong1 = $row["longitude"];
				
				$results = DoFindQuery1($g_dbFindATradie, "postcodes_geolocation", "postcode", (int)$strPostcode2);
				if ($results && ($results->num_rows > 0))
				{	
					$row = $results->fetch_assoc();
					if ($row)
					{		
						$fLat2 = $row["latitude"];
						$fLong2 = $row["longitude"];
						$fDistance = DoCalculateDistance($fLat1, $fLong1, $fLat2, $fLong2);
						$bResult = round($fDistance) <= ((int)$strTradieMaxDistance + 5);
					}
					else
					{
						PrintJavascriptLine("AlertError(\"Function 'IsDistanceMatch(...)' - could not get row for second postcode '" . $strPostcode1 . "'\")", 3, true);
					}
				}
				else
				{
					PrintJavascriptLine("AlertError(\"Function 'IsDistanceMatch(...)' - could not find second postcode '" . $strPostcode2 . "'\")", 3, true);
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Function 'IsDistanceMatch(...)' - could not get row for first postcode '" . $strPostcode1 . "'\")", 3, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Function 'IsDistanceMatch(...)' - could not find first postcode '" . $strPostcode1 . "'\")", 3, true);
		}
		return $bResult;
	}
	
	function DoGetSizeIndex($strJobSize)
	{
		$nIndex = 0;
		
		if ($strJobSize == "Up to 50")
			$index = 0;
		else if ($strJobSize == "50 - 100")
			$index = 1;
		else if ($strJobSize == "100 - 250")
			$index = 2;
		else if ($strJobSize == "250 - 500")
			$index = 3;
		else if ($strJobSize == "More than 500")
			$index = 4;
		
		return $nIndex;
	}
	
	function DoSearchTradies($strTrade, $strJobSize, $strMaxBudget, $strPostcode)
	{
		global $g_dbFindATradie;
		global $g_strDivOpen;
		global $g_strDivClose;
		
		$arrayResults = [];
		$mapMemberIDs = [];
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "trade_id", $strTrade);
		if ($results->num_rows > 0)
		{
			while ($row = $results->fetch_assoc())
			{
				if (IsMatchMaxSize($row["maximum_size"], $strJobSize) && 
					((int)$strMaxBudget >= $row["minimum_budget"]) &&
					IsDistanceMatch($row["postcode"], $strPostcode, $row["maximum_distance"]))
				{
						$arrayResults[] = [
											$row["business_name"] . ", " . $row["suburb"] . ", " . $row["postcode"] . ", " . sprintf("minimum charge: $%d", $row["minimum_charge"]),
											$row["id"]
									  	  ];
						$mapMemberIDs[$row["id"]] = $row["id"];
				}
			}
			$results = DoFindQuery1($g_dbFindATradie, "additional_trades", "trade_id", $strTrade);
			if ($results->num_rows > 0)
			{
				$row = $results->fetch_assoc();
				$results = DoFindQuery1($g_dbFindATradie, "members", "id", $row["member_id"]);
				if ($results->num_rows > 0)
				{
					while ($row = $results->fetch_assoc())
					{
						if (IsMatchMaxSize($row["maximum_size"], $strJobSize) && 
							((int)$strMaxBudget >= $row["minimum_budget"]) &&
							IsDistanceMatch($row["postcode"], $strPostcode, $row["maximum_distance"]))
						{
							if (!isset($mapMemberIDs[$row["id"]]))
								$arrayResults[] = [$row["business_name"] . ", " . $row["suburb"] . ", " . $row["postcode"] . sprintf("minimum charge: $%d",  $row["minimum_charge"]), $row["id"]];
							$strResultsDisplay = "block";
						}
					}
				}
			}
			if (count($arrayResults) == 0)
			{
				PrintJavascriptLine("AlertError(\"No tradies matching these criteria were found!\");", 2, true);
			}
		}
		return $arrayResults;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** WEB ADVERT RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetSpaceID($strSpaceCode)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$strSpaceID = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "space_code", $strSpaceCode);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strSpaceID = $row["id"];
			}
		}
		return $strSpaceID;
	}
	
	function DoGetPageName()
	{
		$strURL = $_SERVER["REQUEST_URI"];

		$nPos1 = strpos($strURL, "/") + 1;
		$nPos2 = strpos($strURL, ".php");
		$strPageName = substr($strURL, $nPos1, $nPos2 - 1);
		return $strPageName;
	}
	
	
	
	
	function DoFindActiveAdvert($strSpaceID, $strPageName)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$dateNow = new DateTime();
		$row = NULL;
		
		$results = DoFindQuery2($g_dbFindATradie, "adverts", "space_id", $strSpaceID, "page_name", $strPageName, "expiry_date > '" . $dateNow->format("Y-m-d") . "'");

		if ($results && ($results->num_rows > 0))
			$row = $results->fetch_assoc();
			
		return $row;
	}
	
	
	
	function DoGenerateJSAdvertArray()
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$strPageName = DoGetPageName();
		$strSpaceCode = "";
		$strLogoURL = "";
		$strAdvertText = "";
		$strAdvertID = "";
		$strMemberID = "";
		$dateExpiry = new DateTime;
		$strExpiryDate = "";
		
		$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces", "(INSTR(`space_code`, '{$strPageName}') > 0) AND (`app_or_web` = 'web')");
		if ($results && ($results->num_rows > 0))
		{
			$nCount = 0;
			while ($rowSpace = $results->fetch_assoc())
			{
				// {space_code:"advert_1", image_url:"", text:"", member_id:""}
				$nCount++;
				$strSpaceCode = $strPageName . "_" . $nCount;
				
				$rowAdvert = DoFindActiveAdvert($rowSpace["id"], $strPageName);
				if ($rowAdvert)
				{
					$rowMember = DoGetMember($rowAdvert["member_id"]);
					if ($rowMember)
					{
						$strLogoURL = $rowMember["logo_filename"];
						$strAdvertText = $rowAdvert["text"];
						$strAdvertID = $rowAdvert["id"];
						$strMemberID = $rowMember["id"];
						$dateExpiry = new DateTime($rowAdvert["expiry_date"]);
						$strExpiryDate = $dateExpiry->format("d/m/Y");
					}
				}
				else
				{
					$strLogoURL = "";
					$strAdvertText = "";
					$strAdvertID = "";
					$strMemberID = "";
					$strExpiryDate = "";
				}
				echo "{space_id:\"" . $rowSpace["id"] . "\", space_code:\"" . $strSpaceCode . 
						"\", cost_per_year:\"" . sprintf("%.2f", $rowSpace["cost_per_year"]) . 
						"\", image_url:\"". $strLogoURL . "\", text:\"" . $strAdvertText . "\", advert_id:\"" . $strAdvertID . 
						"\", expiry_date:\"" . $strExpiryDate . "\", member_id:\"" . $strMemberID . "\"}";
				if ($nCount < $results->num_rows)
					echo ",";
				echo "\n";
			}
		}
	}
	
	function DoGenerateAdvertSlotHTML()
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$strPageName = DoGetPageName();
		$strDisplay = "block";
		
		$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces", "(INSTR(`space_code`, '{$strPageName}') > 0) AND (app_or_web = 'web')");			
		if ($results && ($results->num_rows > 0))
		{
			$nCount = 0;
			while ($row = $results->fetch_assoc())
			{
				$nCount++;
				echo "					<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"advert_" . $nCount . "\" style=\"display: " . $strDisplay . ";\">\n";
				echo "						<tr class=\"advert_row\">\n";
				echo "							<td>\n";
				echo "								<button type=\"button\" onclick=\"DoClickAdvert(" . $nCount . ")\" class=\"advert_button\" width=\"80px;\">\n";
				echo "									<img class=\"advert_logo\" id=\"advert_image_" .  $nCount . "\" src=\"images/AdvertiseHere.png\" alt=\"AdvertiseHere.png\" />\n";
				echo "								</button>\n";
				echo "							</td>\n";
				echo "							<td class=\"advert_text\" id=\"advert_text_" . $nCount . "\">ADVERT " . $nCount . " HTML</td>\n";
				echo "						</tr>";
				echo "						<tr><td class=\"advert_expires\" id=\"advert_expires_" . $nCount . "\" colspan=\"2\">Advert expires on 0/0/0000</td></tr>\n";
				echo "					</table>\n";
				$strDisplay = "none";
			}
		}
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** APP ADVERT RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGenerateAdvertSpaceOptions($strSpaceCode)
	{
		global $g_dbFindATradie;
		$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");

		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				echo "<option ";
				if ($strSpaceCode == $row["space_code"])
					echo "selected ";
				echo "value=\"" . $row["space_code"] . "\">" . $row["space_description"] . "</option>\n";
			}
		}
	}
	
	function GetAdvert($strID)
	{
		global $g_dbFindATradie;
		$row = NULL;
		
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $strID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;
	}
	
	function GetAdvertSpace($strSpaceID)
	{
		global $g_dbFindATradie;
		$row = NULL;
		
		$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "id", $strSpaceID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
			}
		}
		return $row;
	}
	
	function GetSpaceID($strSpaceCode)
	{
		global $g_dbFindATradie;
		$strSpaceID = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "space_code", $strSpaceCode);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strSpaceID = $row["id"];
			}
		}
		return $strSpaceID;
	}
		
	function DoGetCostPerYear($strSpaceID)
	{
		$strCost = "0";
		$row = GetAdvertSpace($strSpaceID);
		if ($row)
		{
			$strCost = sprintf("%d", $row["cost_per_year"]);
		}
		return $strCost;
	}
	
	function DoInsertAdvert($strSpaceCode, $nImageHeight, $strIDAdvertDiv)
	{
		global $g_dbFindATradie;
		$dateNow = new DateTime();
		
		$strSpaceID = GetSpaceID($strSpaceCode);
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "space_id", $strSpaceID, "expiry_date > '" . $dateNow->format("Y-m-d") . "'");		
		if ($results && ($results->num_rows > 0))
		{
			$row = $results->fetch_assoc(); 
			$dateExpiry = new DateTime($row["expiry_date"]);
			echo "<a href=\"tradie.php?member_id=" . $row["member_id"] . "&advert_id=" . $row["id"] . "\"><img src=\"images/" . $_SESSION["account_logo_filename"] . 
					"\" alt=\"" . $_SESSION["account_logo_filename"] . "\" class=\"advert_image\" height=\"" .  $nImageHeight . "\" />\n";
			echo "<div class=\"advert_text\" style=\"height:" . $nImageHeight . "px;line-height:" . $nImageHeight . "px\";\">" . $row["text"] . "</div></a>\n";
			echo "<div class=\"advert_expires\">Advert expires on " . $dateExpiry->format("D d M Y") . "</div>\n";
		}
		else
		{
			echo "<button class=\"advert_button\" type=\"button\"><img src=\"images/AdvertiseHere.png\" alt=\"images/AdvertiseHere.png\" height=\"" . $nImageHeight . "\" onclick=\"";
			
			if (!isset($_SESSION["account_id"]))
				echo "AlertError('Please login first...')";
			else
				echo "OpenAdvertEditor('index1')";
				
			echo "\"><br/>$" . DoGetCostPerYear($strSpaceID) . " per year</button>\n";
		}
	}

	function DoDisplayAdverts($strMemberID, $strSpaceID, $dateStart, $dateEnd, $bHideExpired)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$strSortBy = "";
		$result = NULL;
		$nGrandTotal = 0;
						
		if ($strSpaceID == "")
			$result = DoFindQuery1($g_dbFindATradie, "adverts", "member_id", $strMemberID, "(expiry_date>='" . 
												$dateStart->format("Y-m-d") . "') AND (expiry_date <='" . $dateEnd->format("Y-m-d") . "')", 
												"expiry_date", !$bHideExpired);
		else
			$result = DoFindQuery2($g_dbFindATradie, "adverts", "member_id", $strMemberID, "space_id", $strSpaceID, "(expiry_date>='" . 
												$dateStart->format("Y-m-d") . "') AND (expiry_date <='" . $dateEnd->format("Y-m-d") . "')", 
												"expiry_date", !$bHideExpired);			

		if ($result && ($result->num_rows > 0))
		{
			while ($row = $result->fetch_assoc())
			{
				$rowAdvertSpace = GetAdvertSpace($row["space_id"]);
				
				echo "	<tr>\n";
				echo "		<td>";
				$dateAdded = new DateTime($row["date_added"]);
				echo $dateAdded->format("d/m/Y");
				echo "</td>\n";
				
				echo "		<td>";
				echo $rowAdvertSpace["space_description"];
				echo "</td>\n";
				
				echo "		<td>";
				echo "$" . sprintf("%d", $rowAdvertSpace["cost_per_year"]);
				echo "</td>\n";

				echo "		<td>";
				$dateExpires = new DateTime($row["expiry_date"]);
				echo $dateExpires->format("d/m/Y");
				echo "</td>\n";
			
				echo "		<td>";
				echo sprintf("%d", $row["clicks"]);
				echo "</td>\n";
				
				echo "		<td>";
				$dateNow = new DateTime();
				if ($dateExpires > $dateNow)
					echo "<button id=\"button_edit_advert\" title=\"Edit your advert\" onclick=\"document.location = 'edit_advert.php?advert_id=" . $row["id"] . "&current_page=" . $_SERVER['REQUEST_URI'] . "'\"><img src=\"images/edit.png\" alt=\"images/edit.png\" width=\"20\" /></button>";
				echo "</td>\n";
				echo "</tr>\n";
			}
		}
	}
	
	function DoGetAppAdverts($strScreenName)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$arrayAdverts = [];
		
		$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces", "(INSTR(`space_code`, '{$strScreenName}') > 0) AND (`app_or_web` = 'app')");
		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				$objectAdvertDetails = (object)[];
				$objectAdvertDetails->strBusinessName = "";
				$objectAdvertDetails->strBusinessLogo = "";
				$objectAdvertDetails->strID = "";
				$objectAdvertDetails->strMemberID = "";
				$objectAdvertDetails->strPrice = sprintf("$%.2f", $row["cost_per_year"]);
				$arrayAdverts[] = $objectAdvertDetails;
			}
		}
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "page_name", $strScreenName);

		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{				
				$dateExpiry = new DateTime($row["expiry_date"]);
				$dateNow = new DateTime();
				if ($dateExpiry >= $dateNow)
				{
					$objectAdvertDetails = (object)[];
					$rowMember = DoGetMember($row["member_id"]);
					$objectAdvertDetails->strBusinessName = $rowMember["business_name"];
					$objectAdvertDetails->strBusinessLogo = $rowMember["logo_filename"];
					$objectAdvertDetails->strID = $row["id"];
					$objectAdvertDetails->strMemberID = $row["member_id"];
					$rowAdvertSpace = GetAdvertSpace($row["space_id"]);
	
					if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_1") == 0)
					{
						$arrayAdverts[0] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_2") == 0)
					{
						$arrayAdverts[1] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_3") == 0)
					{
						$arrayAdverts[2] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_4") == 0)
					{
						$arrayAdverts[3] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_5") == 0)
					{
						$arrayAdverts[4] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_6") == 0)
					{
						$arrayAdverts[5] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_7") == 0)
					{
						$arrayAdverts[6] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_8") == 0)
					{
						$arrayAdverts[7] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_9") == 0)
					{
						$arrayAdverts[8] = $objectAdvertDetails;
					}
					else if (strcmp($rowAdvertSpace["space_code"], $strScreenName . "_10") == 0)
					{
						$arrayAdverts[9] = $objectAdvertDetails;
					}
				}
			}
		}
		echo "ADVERT_LIST=" . json_encode($arrayAdverts);
	}
	
	function DoNewAppAdvert($strSpaceCode, $strMemberID, $strScreen)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$dateNow = new DateTime();
		$results = DoInsertQuery4($g_dbFindATradie, "adverts", "space_id", GetSpaceID($strSpaceCode), "member_id", $strMemberID, "page_name", $strScreen, "expiry_date", $dateNow->format("Y-m-d"));
		if ($results)
		{
			$results = DoFindQuery4($g_dbFindATradie, "adverts", "space_id", GetSpaceID($strSpaceCode), "member_id", $strMemberID, "page_name", $strScreen, "expiry_date", $dateNow->format("Y-m-d"));
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					echo "NEW_ADVERT_ID," . $row["id"] . "," . DoGetCostPerYear($row["space_id"]);
				}
				else
				{
					echo "ERROR: $results->fetch_assoc()";
				}
			}
			else
			{
				echo "ERROR: " . $g_strQuery;
			}
		}
		else
		{
			echo "ERROR: " . $g_strQuery;
		}
	}
	
	function DoClickAdvert($strAdvertID)
	{
		global $g_dbFindATradie;
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $strAdvertID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$nClicks = intval($row["clicks"]) + 1;
				$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "clicks", $nClicks, "id", $strAdvertID);
				if ($results)
				{
					echo "advert_click=" . $strAdvertID;
				}
			}
		}
		else
		{
			echo "advert_id = " . $strAdvertID;
		}
	}
	
	function DoActivateAdvert($strAdvertID, $strPaymentAmount)
	{
		global $g_dbFindATradie;
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $strAdvertID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$dateExpiry = new DateTime($row["expiry_date"]);
				$dateExpiry->modify("+12 months");
				$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "id", "expiry_date", $dateExpiry->format("Y-m-d"), $strAdvertID);
			}
		}
	}
	
	function DoDeleteAdvert($strAdvertID)
	{
		global $g_dbFindATradie;
		$results = DoDeleteQuery($g_dbFindATradie, "adverts", "id", $strAdvertID);
		if ($results)
			echo "advert_deleted,Advert cancelled!";
	}
	
	function ProcessAdvertFunction()
	{
		$bResult = true;
		
		if ($_POST["button"] == "get_adverts")
		{
			DoGetAppAdverts($_POST["screen"]);
		}
		else if ($_POST["button"] == "new_advert")
		{
			DoNewAppAdvert($_POST["space_code"], $_POST["member_id"], $_POST["screen"]);
		}
		else if ($_POST["button"] == "advert_click")
		{
			DoClickAdvert($_POST["advert_id"]);
		}
		else if ($_POST["button"] == "activate_advert")
		{
			DoActivateAdvert($_POST["advert_id"], $_POST["payment_amount"]);
		}
		else if ($_POST["button"] == "delete_advert")
		{
			DoDeleteAdvert($_POST["advert_id"]);
		}
		else
		{
			$bResult = false;
		}
		return $bResult;
	}




	//******************************************************************************
	//******************************************************************************
	//** 
	//** FEEDBACK RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetFeedback($strFeedbackID, &$strFeedbackDesc, &$nPositive)
	{
		global $g_dbFindATradie;
		
		$results = DoFindQuery1($g_dbFindATradie, "feedback", "id", $strFeedbackID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strFeedbackDesc = $row["description"];
				$nPositive = $row["positive"];
			}
		}
	}
	
	function DoDisplayFeedbackPercentages($strRecipientID, $strProviderID, $strAs = "")
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$queryResult = NULL;
		$nPercentagePositive = 0;
		$nPercentageNegative = 0;
		$nCustomerTradeID = DoGetCustomerTradeID();		
					
		if ($strRecipientID != "")
		{
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $strRecipientID);
		}
		else if ($strProviderID != "")
		{
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $strProviderID);
		}
		if ($queryResult && ($queryResult->num_rows > 0))
		{
			$nTotal = 0;
			$nPositive = 0;
			$nNegative = 0;
			$arrayFeedback = [];
			
			while ($rowFeedback = $queryResult->fetch_assoc())
			{
				$rowJob = DoGetRow1("jobs", "id", $rowFeedback["job_id"]);
				$rowMember = DoGetMember($rowFeedback["provider_id"]);
				$bInclude = (strlen($strAs) == 0) || 
							((strcmp($strAs, "customer") == 0) && ($rowMember["trade_id"] != $nCustomerTradeID)) ||
							((strcmp($strAs, "tradie") == 0) && ($rowMember["trade_id"] == $nCustomerTradeID));
				if ($bInclude)
				{
					if ($rowFeedback["positive"])
						$nPositive++;
					else
						$nNegative++;
	
					$nTotal++;
				}
			}
			$nPercentagePositive = ($nPositive * 100) / $nTotal;
			$nPercentageNegative = ($nNegative * 100) / $nTotal;
		}
		echo "<br/><br/><hr/>\n";
		echo "<table class=\"search_table\" cellspacing=\"0\" cellpadding=\"10\" style=\"width:30em;margin-left:0.5em;\">\n";
		echo "	<tr>\n";
		echo "		<td>\n";
		echo "			<img class=\"function_button_image\" src=\"images/thumbs_up.png\" alt=\"images/thumbs_up.png\" />\n";
		echo "		</td>\n";
		echo "		<td>\n";
		printf("%d%%", $nPercentagePositive);
		echo "		</td>\n";
		echo "		<td>\n";
		echo "			<img class=\"function_button_image\" src=\"images/thumbs_down.png\" alt=\"images/thumbs_down.png\" />\n";
		echo "		</td>\n";
		echo "		<td>\n";
		printf("%d%%", $nPercentageNegative);
		echo "		</td>\n";
		echo "	</tr>\n";
		echo "</table>\n";
		echo "<hr/><br/><br/>";
	}
	
	function DoCreateFeedbackRow($rowFeedback, $rowMember)
	{
		echo "<tr>\n";
		echo "<td class=\"feedback_row\">";
		DoDisplayBoolean($rowFeedback["positive"], "function_button_image", "images/thumbs_up.png", "images/thumbs_down.png");
		echo "</td>\n";
		echo "<td class=\"feedback_row\">" . $rowFeedback["description"] . "</td>\n";
		echo "<td class=\"feedback_row\">" . sprintf("%d", $rowFeedback["job_id"]) . "</td>\n";
		echo "<td class=\"feedback_row\">";
		$dateAdded = new DateTime($rowFeedback["date_added"]);
		echo $dateAdded->format("d/m/Y");
		echo "</td>\n";

		echo "<td class=\"feedback_row\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "<br/>"; 
		if ($rowMember["business_name"] && (strlen($rowMember["business_name"]) > 0))
			echo $rowMember["business_name"] . "<br/>";
		echo $rowMember["suburb"] . ", " . $rowMember["state"] . ", " . $rowMember["postcode"] . "</td>\n";
	}

	function DoDisplayFeedbackAs($strRecipientID, $strAs/* "customer" or "tradie" */)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$results  = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $strRecipientID);
		$nCustomerTradeID = DoGetCustomerTradeID();
		
		if ($results && ($results->num_rows > 0))
		{
			while ($rowFeedback = $results->fetch_assoc())
			{
				$rowJob = DoGetRow1("jobs", "id", $rowFeedback["job_id"]);
				$rowMember = DoGetMember($rowFeedback["provider_id"]);
				$bInclude = ((strcmp($strAs, "customer") == 0) && ($rowMember["trade_id"] != $nCustomerTradeID)) ||
							((strcmp($strAs, "tradie") == 0) && ($rowMember["trade_id"] == $nCustomerTradeID));

				if ($bInclude)
				{
					DoCreateFeedbackRow($rowFeedback, $rowMember);			
				}
			}
		}
	}
	
	function DoDisplayFeedback($strRecipientID, $strProviderID)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		global $g_strMailToNewLine;
		$queryResult = NULL;
		$bReceived = strlen($strRecipientID) > 0;
		$rowMember = NULL;
		
		if (!$bReceived)
			$strFormID = "given";
		else
			$strFormID = "received";
		
		if (strcmp($strRecipientID, "") != 0)
		{
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $strRecipientID);
		}
		else if (strcmp($strProviderID, "") != 0)
		{
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $strProviderID);
		}
		if ($queryResult && ($queryResult->num_rows > 0))
		{
			while ($rowFeedback = $queryResult->fetch_assoc())
			{
				if ($bReceived)
					$rowMember = DoGetMember($rowFeedback["provider_id"]);
				else
					$rowMember = DoGetMember($rowFeedback["recipient_id"]);
				
				DoCreateFeedbackRow($rowFeedback, $rowMember);
				
				echo "<td class=\"feedback_row\">";
				echo "<form id=\"form_feedback_given\" method=\"post\" class=\"function_form\">\n";
				$rowJob = DoGetRow1("jobs", "id", $rowFeedback["job_id"]);
				echo "<button type=\"button\" class=\"function_button\" title=\"View the job description\" onclick=\"AlertInformation('JOB DESCRIPTION', '" . $rowJob["description"] . "');return false;\"><img src=\"images/view.png\" alt=\"images/view.png\" class=\"function_button_image\" /></button>";
				if ($bReceived && !$rowFeedback["positive"])
				{
					$rowJob = DoGetRow1("jobs", "id", $rowFeedback["job_id"]);
					$rowClient = DoGetRow1("members", "id", $rowJob["member_id"]);
					$rowTradie = DoGetRow1("members", "id", $rowJob["accepted_by_member_id"]);
					$dateAdded = new DateTime($rowJob["date_added"]);
					echo "&nbsp;<a href=\"mailto://" . $rowTradie["email"] . "?subject=RE: Negative feedback left on 'Find a Tradie'&body=JOB ID: " . 
							sprintf("%d", $rowFeedback["job_id"]) . $g_strMailToNewLine . "DATE: " . $dateAdded->format("d/m/Y") . $g_strMailToNewLine . 
							"LOCATION: " . $rowTradie["suburb"] . ", " . $rowTradie["state"] . ", " . $rowTradie["postcode"] . $g_strMailToNewLine . $g_strMailToNewLine . 
							"JOB DESCRIPTION" . $g_strMailToNewLine . "----------------" . $g_strMailToNewLine . $rowJob["description"] . "&from=" .  $rowClient["email"] . 
							"\")\"><button title=\"'Email " . $rowTradie["first_name"] . " " . $rowTradie["surname"] . " about this negative feedback'\" class=\"function_button_hidden\"><img class=\"function_button_image\" src=\"images/email.png\" alt=\"images/email.png\"/></button></a>\n";
				}
				else if (!$bReceived)
				{
					echo "<br/>";
					DoCreateFeedbackTextArea(false, $rowFeedback["id"], $rowFeedback["recipient_id"], $rowFeedback["provider_id"], $rowFeedback["job_id"], true);
				}
				echo "</form>\n";
				echo "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";
		}
		else
		{
			echo "<td colspan=\"6\" class=\"cell_no_borders search_cell\">No feedback yet...</td>\n";
		}
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** POSTED JOBS FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoDisplayBoolean($nFlag, $strImageClass = "", $strPositiveImageName = "images/accept.png", $strNegativeImageName = "images/unaccept.png")
	{
		$strImageFile = "";
		if ($nFlag == 1)
			$strImageFile = $strPositiveImageName;
		else
			$strImageFile = $strNegativeImageName;
		echo "<img src=\"" . $strImageFile . "\" alt=\" . $strImageFile . \" class=\"" . $strImageClass . "\" />\n";
	}
	
	function DoGetWebJobsPosted()
	{
		global $g_dbFindATradie;
		global $g_strMailToNewLine;
		global $g_strQuery;
		$row = null;
		
		$results = DoFindQuery1($g_dbFindATradie, "jobs", "member_id", $_SESSION["account_id"]);
		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				echo "<tr>\n";
				echo "<td class=\"search_cell\">\n";
				$dateAdded = new DateTime($row["date_added"]);
				echo $dateAdded->format("d/m/Y");
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo $row["size"];
				echo "</td>\n";
				echo "<td class=\"search_cell\">$";
				echo sprintf("%.2f", $row["maximum_budget"]);
				echo "</td>\n";
				echo "<td class=\"search_cell\" style=\"text-align:center;\">\n";
				DoDisplayBoolean($row["urgent"], "function_button_image");
				echo "</td>\n";
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				if ($row["accepted_by_member_id"] > 0)
				{
					$rowMember = DoGetMember($row["accepted_by_member_id"]);
					echo "<a href=\"tradie.php?member_id=" . $row["accepted_by_member_id"] . "\">" . 
							$rowMember["first_name"] . " " . $rowMember["surname"] . ", " . 
							$rowMember["business_name"] . "</a><br/>\n";
					if (strlen($row["unit"]) > 0)
						echo $row["unit"] . ", ";
					echo $row["street"] . "<br/>" . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"];
				}
				else
				{
					echo "";
				}
				echo "</td>\n";
				echo "<td class=\"search_cell\" style=\"text-align:center;\">\n";
				DoDisplayBoolean($row["completed"], "function_button_image");
				echo "</td>\n";
				echo "<td class=\"search_cell\" style=\"text-align:center;\">\n";
				DoDisplayBoolean($row["paid"], "function_button_image");
				echo "</td>\n";
				echo "<td class=\"search_cell\" style=\"text-align:center;\">\n";					
				$rowFeedback = DoGetRow1("feedback", "job_id", $row["id"]);
				if ($rowFeedback)
					DoDisplayBoolean(DoGetColumnValue("feedback", "id", $rowFeedback["id"], "positive"), "function_button_image");
				else
					DoDisplayBoolean(false, "function_button_image");
;
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo "	<form method=\"post\" action=\"\" class=\"function_form\">\n";	
				echo "    <button type=\"button\" class=\"function_button\" title=\"View the job description\" onclick=\"AlertInformation('JOB DESCRIPTION', '" . $row["description"] . "');return false;\"><img src=\"images/view.png\" alt=\"images/view.png\" class=\"function_button_image\" /></button>&nbsp;\n";
				if ($row["accepted_by_member_id"] == 0)
				{
					echo "    <button type=\"button\" class=\"function_button\" title=\"Edit this job\" value=\"EDIT\" onclick=\"OnClickEditJobButton('" . $row["id"] . "', '" . $row["member_id"] . "', '" . $row["trade_id"] . "', '" . $row["maximum_budget"] . "', '" . $row["size"] . "', '" . $row["urgent"] . "', '" . $row["description"] . "', '" . $row["unit"] . "', '" . $row["street"] . "', '" . $row["suburb"] . "', '" . $row["state"] . "', '" . $row["postcode"] . "')\" /><img src=\"images/edit.png\" alt=\"images/edit.png\" class=\"function_button_image\" /></button>\n";
				}
				echo "	  <button type=\"submit\ id=\"submit_job_delete\" name=\"submit_job_delete\" class=\"function_button\" title=\"Delete your feedback\" value=\"DELETE\" /><img src=\"images/delete.png\" alt=\"images/delete.png\" class=\"function_button_image\" /></button>&nbsp;\n";
				if ($row["completed"] == 1)
				{
					$dateCompleted = new DateTime($row["date_completed"]);
					$strHREF = "mailto://" . $rowMember["email"] . "?subject=RE: job in " . $_SESSION["account_suburb"] . "(" .
								$_SESSION["account_postcode"] . ") with ID '" . $row["id"] . 
								"'&body=Job Completed: " . $dateCompleted->format("d/m/Y") . $g_strMailToNewLine . $g_strMailToNewLine . 
								"Client name: " . $_SESSION["account_first_name"] . " " . $_SESSION["account_surname"] . 
								$g_strMailToNewLine . $g_strMailToNewLine . "Please send me an invoice.";
					echo "	  <a href=\"" . $strHREF . "\"><img src=\"images/paypal.png\" alt=\"images/paypal.png\" class=\"function_button_image\" /></a>&nbsp;\n";				
					echo "<br/>\n";
					if ($rowFeedback)
						DoCreateFeedbackTextArea(true, $rowFeedback["id"], $row["accepted_by_member_id"], $row["member_id"], $row["id"]);
					else
						DoCreateFeedbackTextArea(false, "", $row["accepted_by_member_id"], $row["member_id"], $row["id"]);
				}
				echo "	  <input type=\"hidden\" name=\"text_job_edit_id\" value=\"" . $row["id"] . "\">\n";
				echo "	</form>\n";
				echo "</td>\n"; 
				echo "</tr>\n";
			}
		}
	}
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** JOBS SEARCH FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetMaxDistance()
	{
		$strResult = "";
		
		if (isset($_POST["text_maximum_distance"]))
			$strResult = $_POST["text_maximum_distance"];
		else if (isset($_SESSION["account_maximum_distance"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_maximum_distance"]);
		
		return $strResult;
	}
	
	function DoGetMinBudget()
	{
		$strResult = "";

		if (isset($_POST["text_minimum_budget"]))
			$strResult = $_POST["text_minimum_budget"];
		else if (isset($_SESSION["account_minimum_budget"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_minimum_budget"]);

		return $strResult;
	}
	
	function DoGetMaxSize()
	{
		$strResult = "";

		if (isset($_POST["select_maximum_size"]))
			$strResult = $_POST["select_maximum_size"];
		else if (isset($_SESSION["account_maximum_size"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_maximum_size"]);

		return $strResult;
	}
	
	function GetDateSince()
	{
		$strResult = "";

		if (isset($_POST["date_since"]))
			$strResult = $_POST["date_since"];
		else
			$strResult = "";

		return $strResult;
	}
	
	function DoGetDate($strDate)
	{
		$date = new DateTime($strDate);
		return $date->format("d/m/Y");
	}
	
	function DoCreateFeedbackTextArea($bDisplayCurrentFeedback, $strFeedbackID, $strRecipientID, $strProviderID, $strJobID, $bRequired = false)
	{
		$strPrompt = "";
		$strRequired = "";
		if ($bRequired)
			$strRequired = " required";
			
		$rowMember = DoGetMember($strRecipientID);
		if (($strFeedbackID == NULL) || (strcmp($strFeedbackID, "") == 0))
		{
			echo "<textarea name=\"text_feedback\" placeholder=\"Type your feedback...\"" . $strRequired . "cols=\"32\" rows=\"1\"></textarea>\n";
			$strPrompt = "You can add your feedback for " . $rowMember["first_name"] . " " . $rowMember["surname"] . " here...";
		}
		else
		{
			$strFeedbackDesc = "";
			$nPositive = 0;
			$strFilename = "";
			DoGetFeedback($strFeedbackID, $strFeedbackDesc, $nPositive);
			if ($bDisplayCurrentFeedback)
			{
				if ($nPositive == 1)
					$strFilename = "thumbs_up.png";
				else if ($nPositive == 0)
					$strFilename = "thumbs_down.png";
				echo "<img src=\"images/" . $strFilename . "\" alt=\"images/" . $strFilename . "\" class=\"function_button_image\" />&nbsp;\n";
			}
			echo "<textarea name=\"text_feedback\" placeholder=\"Type your feedback...\" " . $strRequired . " cols=\"32\" rows=\"1\">\n" . $strFeedbackDesc . "</textarea>\n";
			$strPrompt = "You can edit your feedback for " . $rowMember["first_name"] . " " . $rowMember["surname"] . " here...";
		}
		echo "<button type=\"submit\" name=\"submit_positive_feedback\" class=\"function_button\" title=\"Provide positive feedback\" value=\"POSITIVE FEEDBACK\" /><img src=\"images/thumbs_up.png\" alt=\"images/thumbs_up.png\" class=\"function_button_image\" /></button>&nbsp;\n";
		echo "<button type=\"submit\" name=\"submit_negative_feedback\" class=\"function_button\" title=\"Provide negative feedback\" value=\"NEGATIVE FEEDBACK\" /><img src=\"images/thumbs_down.png\" alt=\"images/thumbs_down.png\" class=\"function_button_image\" /></button>\n";
		echo "<br><span style=\"font-size:x-small;\">" . $strPrompt . "</span>\n";
		echo "<input type=\"hidden\" name=\"text_feedback_id\" value=\"" . $strFeedbackID . "\" />\n";
		echo "<input type=\"hidden\" name=\"text_recipient_id\" value=\"" . $strRecipientID . "\" />\n";
		echo "<input type=\"hidden\" name=\"text_provider_id\" value=\"" . $strProviderID . "\" />\n";
		echo "<input type=\"hidden\" name=\"text_job_id\" value=\"" . $strJobID . "\" />\n";
	}
	
	function DoGetWebJobs($strTradeID, &$mapAddedJobIDs)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$row = null;
		
		if (isset($_POST["submit_job_search"]))
		{
			/*
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH )
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => 2023-11-01 [checkbox_urgent] => on [submit_job_search] => SEARCH ) 
				Array ( [text_maximum_distance] => [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH ) 
			*/	
			$strQuery = "SELECT * FROM jobs WHERE trade_id=" . $strTradeID;
			if (isset($_POST["text_minimum_budget"]) && ($_POST["text_minimum_budget"] != ""))
			{
				$strQuery = $strQuery . " AND maximum_budget>='" . $_POST["text_minimum_budget"] . "'";
			}
			if (isset($_POST["date_since"]) && ($_POST["date_since"] != ""))
			{
				$strQuery = $strQuery . " AND date_added>='" . $_POST["date_since"] . "'";
			}
			if (isset($_POST["radio_urgency"]))
			{
				if (strcmp($_POST["radio_urgency"], "all") == 0)
				{
				}
				else if (strcmp($_POST["radio_urgency"], "urgent") == 0)
				{
					$strQuery = $strQuery . " AND urgent=1";
				}
				else if (strcmp($_POST["radio_urgency"], "normal") == 0)
				{
					$strQuery = $strQuery . " AND urgent!=1";
				}				
			}
			if (isset($_POST["radio_acceptance"]))
			{
				if (strcmp($_POST["radio_acceptance"], "all") == 0)
				{
				}
				else if (strcmp($_POST["radio_acceptance"], "accepted") == 0)
				{
					$strQuery = $strQuery . " AND accepted_by_member_id!=0";
				}
				else if (strcmp($_POST["radio_acceptance"], "unaccepted") == 0)
				{
					$strQuery = $strQuery . " AND accepted_by_member_id=0";
				}				
			}
			if (isset($_POST["radio_completeness"]))
			{
				if (strcmp($_POST["radio_completeness"], "all") == 0)
				{
				}
				else if (strcmp($_POST["radio_completeness"], "complete") == 0)
				{
					$strQuery = $strQuery . " AND completed=1";
				}
				else if (strcmp($_POST["radio_completeness"], "incomplete") == 0)
				{
					$strQuery = $strQuery . " AND completed!=1";
				}				
			}
			if (isset($_POST["radio_payment"]))
			{
				if (strcmp($_POST["radio_payment"], "all") == 0)
				{
				}
				else if (strcmp($_POST["radio_payment"], "paid") == 0)
				{
					$strQuery = $strQuery . " AND paid=1";
				}
				else if (strcmp($_POST["radio_payment"], "unpaid") == 0)
				{
					$strQuery = $strQuery . " AND paid!=1";
				}				
			}
		}
		else
		{
			$strQuery = "SELECT * FROM jobs WHERE maximum_budget>='" . $_SESSION["account_minimum_budget"] . "'";
		}
		$results = DoQuery($g_dbFindATradie, $strQuery);
		if ($results && ($results->num_rows > 0))
		{
			while ($rowJob = $results->fetch_assoc())
			{
				$rowMember = DoGetMember($rowJob["member_id"]);

				if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_SESSION["account_maximum_distance"]))
				{
					if (DoGetSizeIndex($rowJob["size"]) <= DoGetSizeIndex($_SESSION["account_maximum_size"]))
					{
						if (($rowJob["accepted_by_member_id"] == 0) || ($rowJob["accepted_by_member_id"] == $_SESSION["account_id"]))
						{
							if (!array_key_exists($rowJob["id"], $mapAddedJobIDs))
							{
								$rowFeedback = DoGetRow2("feedback", "job_id", $rowJob["id"], "provider_id", $rowJob["member_id"]);
								$strFeedbackID = 0;
								if ($rowFeedback)
									$strFeedbackID = $rowFeedback["id"];
								$mapAddedJobIDs[$rowJob["id"]] = true;
								echo "<tr>\n";
								$date = new DateTime($rowJob["date_added"]);
								echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["id"] . "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\">" . $date->format("d/m/Y") . "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\"><a href=\"view_member.php?member_id=" . $rowMember["id"] . "\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</a><br/>\n";
								if (strlen($rowJob["unit"]) > 0)
									echo $rowJob["unit"] . ", ";
								echo $rowJob["street"] . "<br/" . $rowJob["suburb"] . ", " . $rowJob["postcode"] . "<br/>\n";
								echo "<a href=\"mailto://" . $rowMember["email"] . "?subject=RE: job id: " . $rowJob["id"] . ", posted on date: " . $date->format("d/m/Y") . " on 'Find a Tradie'\">" . $rowMember["email"] . "</a></td>\n";
								echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["size"] . " m<sup>2</sup><br/>" . sprintf("$%d", $rowJob["maximum_budget"]) . "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\" style=\"text-align:center;\">\n";
								DoDisplayBoolean($rowJob["urgent"] == 1, "function_button_image");
								echo "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\" style=\"text-align:center;\">\n";
								DoDisplayBoolean($rowJob["accepted_by_member_id"] > 0, "function_button_image");
								echo "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\" style=\"text-align:center;\">\n";
								DoDisplayBoolean($rowJob["completed"] == 1, "function_button_image");
								echo "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\" style=\"text-align:center;\">\n";
								DoDisplayBoolean($rowJob["paid"] == 1, "function_button_image");
								echo "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\" style=\"text-align:center;\">\n";
								DoDisplayBoolean($strFeedbackID != 0, "function_button_image");
								echo "</td>\n";
								echo "<td class=\"cell_no_borders search_cell\">\n";
								echo "	<form method=\"post\" action=\"\" class=\"function_form\">\n";
								echo "     <input type=\"hidden\" name=\"text_job_id\" value=\"" . $rowJob["id"] . "\" />\n";
								echo "     <input type=\"hidden\" name=\"text_member_id\" value=\"" . $rowJob["member_id"] . "\" />\n";
								echo "     <input type=\"hidden\" name=\"text_feedback_id\" value=\"" . $strFeedbackID . "\" />\n";
								echo "     <input type=\"hidden\" name=\"text_accepted_by_member_id\" value=\"" . $rowJob["accepted_by_member_id"] . "\" />\n";
								
								echo "<button type=\"button\" class=\"function_button\" title=\"View the job description\" onclick=\"AlertInformation('JOB DESCRIPTION', '" . $rowJob["description"] . "');return false;\"><img src=\"images/view.png\" alt=\"images/view.png\" class=\"function_button_image\" /></button>&nbsp;\n";

								if ($rowJob["accepted_by_member_id"] == 0)
								{
									echo "<button type=\"submit\" class=\"function_button\" title=\"Accept this job\" id=\"submit_accept_job\" name=\"submit_accept_job\" value=\"ACCEPT\" /><img src=\"images/accept.png\" alt=\"images/accept.png\" class=\"function_button_image\" /></button><br/>\n";
								}
								else if ($rowJob["paid"] == 1)
								{
									echo "<button type=\"submit\" class=\"function_button\" title=\"Mark as unpaid\" name=\"submit_unpaid_job\" value=\"UNPAID\" /><img src=\"images/unpaid.png\" alt=\"images/unpaid.png\" class=\"function_button_image\" /></button><br/>\n";
									DoCreateFeedbackTextArea(true, $strFeedbackID, $row["member_id"], $row["accepted_by_member_id"], $row["job_id"], $rowJob["completed"] == 1);
								}
								else if ($rowJob["completed"] == 1)
								{
									echo "<button type=\"submit\" class=\"function_button\" title=\"Mark as incomplete\" name=\"submit_uncomplete_job\" value=\"UNCOMPLETE\" /><img src=\"images/uncomplete.png\" alt=\"images/uncomplete.png\" class=\"function_button_image\" /></button>&nbsp;\n";
									echo "<button type=\"button\" class=\"function_button\" title=\"Raise PayPal invoice\" value=\"PAYPAL\" onclick=\"window.location.href = 'https://www.paypal.com'\" /><img src=\"images/paypal.png\" alt=\"images/paypal.png\" class=\"function_button_image\" /></button>&nbsp;\n";
									echo "<button type=\"submit\" class=\"function_button\" title=\"Mark as paid\" name=\"submit_paid_job\" value=\"PAID\" /><img src=\"images/paid.png\" alt=\"images/paid.png\" class=\"function_button_image\" /></button><br/>\n";
									DoCreateFeedbackTextArea(true, $strFeedbackID, $rowJob["member_id"], $rowJob["accepted_by_member_id"], $rowJob["id"], $rowJob["completed"] == 1);
								}
								else if (strcmp($rowJob["accepted_by_member_id"], $_SESSION["account_id"]) == 0)
								{
									echo "<button type=\"submit\" class=\"function_button\" title=\"Unaccept this job\" name=\"submit_unaccept_job\" value=\"UNACCEPT\" /><img src=\"images/unaccept.png\" alt=\"images/unaccept.png\" class=\"function_button_image\" /></button>&nbsp;\n";
									echo "<button type=\"submit\" class=\"function_button\" title=\"Mark as complete\" name=\"submit_complete_job\" value=\"COMPLETE\" /><img src=\"images/complete.png\" alt=\"images/complete.png\" class=\"function_button_image\" /></button><br/>\n";
								}
								else
								{
									echo "ERROR\n";
								}
								echo "</form>\n";
								echo "</td>\n";
								echo "</tr>\n";

							}
						}
					}
				}
			}
		}
		return $results->num_rows;
	}
	



	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADIE SEARCH FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoCreateTradieRow($rowMember)
	{
		echo "<tr>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["id"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\"><button class=\"function_button_hidden\" title=\"Email " . $rowMember["first_name"] . " " . $rowMember["surname"] . "\"><a href=\"mailto://" . $rowMember["email"] . "?subject=RE: 'Find a Tradie'\"><img src=\"images/email.png\" alt=\"email.png\" class=\"function_button_image\" /></a></button></td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["phone"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["mobile"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["suburb"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["state"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["postcode"] . "</td>\n";
		echo "<td class=\"cell_no_borders search_cell\"><button class=\"function_button_hidden\" title=\"View feedback for " . $rowMember["first_name"] . " " . $rowMember["surname"] . "\"><a href=\"view_member.php?member_id=" . $rowMember["id"] . "\"><img src=\"images/view.png\" alt=\"view.png\" class=\"function_button_image\" /></a></button></td>\n";
		echo "</tr>\n";
	}

	function DoGetWebTradies($strTradeID, $strPostcode, $strSuburb, $strMaxDistance)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		$rowMember = null;
		$strPostcode = $_SESSION["account_postcode"];
		
		if (isset($_POST["text_postcode"]))
			$strPostcode = $_POST["text_postcode"];

		if (strlen($strTradeID) > 0)
			$results = DoFindQuery1($g_dbFindATradie, "members", "trade_id", $strTradeID);
		else
			$results = DoFindAllQuery($g_dbFindATradie, "members", "trade_id != '59'");

		if ($results && ($results->num_rows > 0))
		{
			while ($rowMember = $results->fetch_assoc())
			{
				if (IsDistanceMatch($strPostcode, $rowMember["postcode"], $strMaxDistance) || 
					(strlen($strMaxDistance) == 0))
				{
					if (((strcmp($strPostcode, $rowMember["postcode"]) == 0) || (strlen($strPostcode) == 0)) ||
						((strcmp($strSuburb, $rowMember["suburb"]) == 0) || (strlen($strSuburb) == 0)))
					{
						DoCreateTradieRow($rowMember);
					}
				}
			}
		}
	}
	
?>
