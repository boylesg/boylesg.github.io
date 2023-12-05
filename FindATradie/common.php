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
	$g_strPaypalLive = "none";
	$g_strPaypalTest = "block";
	$g_dateJoinFree = new DateTime("2024-04-30");
	$g_nDaysToGo = $g_dateJoinFree->diff( new DateTime())->days;
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** ENCRYPTION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	include "CryptoJSAES.php";
	$g_strKey = "dPRBqi32EH7LgfxuhWXm";
		
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
		PrintJavascriptLine("AlertError(\"" . $strMsg . "\");", $nNumIndents, true);
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
		}
		catch(Exception $e)
		{
			PrintJavascriptLine("AlertError(\"" . $e->getMessage() . "\");", 2, true);
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
  			echo "ERROR: '". $e->getMessage() . "'<br><br>With query '" . $strQuery . "'.<br><br>" . $g_strEmailAdmin;
		}		
		return $result;
	}

	function DoFindAllQuery($dbConnection, $strTableName, $strCondition = "")
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName;
		
		if ($strCondition != "")
			$g_strQuery = $g_strQuery . " WHERE " . $strCondition;
			
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery0($dbConnection, $strTableName, $strCondition = "")
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName;

		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " WHERE " . $strCondition;

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue, $strCondition = "")
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";

		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;

		return DoQuery($dbConnection, $g_strQuery);
	}	
	
	function DoFindQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strCondition = "")
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "'";
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strCondition = "")
	{	
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "'";		
	
		if (strlen($strCondition) > 0)
			$g_strQuery = $g_strQuery . " AND " . $strCondition;

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
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName . "='" . $strColumnValue . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnValue . "'";
	
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoUpdateQuery4($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "'," . $strColumnName3 . "='" .  $strColumnValue3 . 
			$strColumnName4 . "='" .  $strColumnValue4 . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoUpdateQuery5($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "'," . $strColumnName3 . "='" .  $strColumnValue3 . 
			$strColumnName4 . "='" .  $strColumnValue4 . $strColumnName5 . "='" .  $strColumnValue5 . 
			"' WHERE " . $strFindColumnName . "='" . $strFindColumnValue . "'";

		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoDeleteQuery($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "DELETE FROM " . $strTableName . " WHERE " . $strColumnName . "='" . $strColumnValue . "'";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName . ") VALUES(" . $strColumnValue . ")";
		
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoInsertQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . ")";
		
		return DoQuery($dbConnection, $g_strQuery);
	}

	function DoInsertQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . "," . $strColumnValue3 . ")";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery4($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . "," . $strColumnValue3 . $strColumnValue4 . ")";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoInsertQuery5($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strColumnName4, $strColumnValue4, $strColumnName5, $strColumnValue5)
	{
		global $g_strQuery;
		$g_strQuery = "INSERT INTO " . $strTableName . "(" . $strColumnName1 . "," . $strColumnName2 . "," . $strColumnName3 . "," . $strColumnName4 . "," . $strColumnName5 . ") VALUES(" . $strColumnValue1 . "," . $strColumnValue2 . "," . $strColumnValue3 . $strColumnValue4 . "," . $strColumnValue5 . ")";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoDeleteQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "DELETE FROM " . $strTableName . " WHERE " . $strColumnName . "='" . $strColumnValue . "'";
		
		return DoQuery($dbConnection, $g_strQuery);
	}
	
	function DoFindMaxValueQuery1($dbConnection, $strTableName, $strColumnName)
	{
		global $g_strQuery;
		$g_strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "=(SELECT MAX(" . $strColumnName . ") FROM " . $strTableName . ")";
		$result = DoQuery($dbConnection, $g_strQuery);
		return $result;
	}	
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADE OPTIONS FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	// Generate options for a primary trade 'select' input, with one selection.
	function DoGeneratePrimaryTradeOptions($strTradeID)
	{
		global $g_dbFindATradie;
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	PrintIndents(8);
			echo "<option value=\"" . $row["id"] . "\"";
			
			if (isset($strTradeID) && ($strTradeID != "") && ($strTradeID == $row["id"]))
				echo " selected";
			
			echo ">";
			echo $row["name"];
			echo "</option>\n";
			$strSelected = "";
	    }
	    $queryResult->free_result();
	}
	
	// Check is a trade is among the list of additional trades for a tradie.
	function FindAdditionalTrade($arrayAdditionalTrades, $strTradeID)
	{
		$bFound = false;
		
		for ($nI = 0; $nI < count($arrayAdditionalTrades); $nI++)
		{
			$bFound = $arrayAdditionalTrades[$nI] == $strTradeID;
			if ($bFound)
				break;
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
	DoGenerateJavascriptTradeArray();



	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL MEMBER LOKUP FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetMember($strMemberID)
	{
		global $g_dbFindATradie;
		$row = null;
		
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
	
	function IsMatchMaxSize($strTradieMaxSize, $strJobSizeIndex)
	{
		$nJobSize = (int)$strJobSizeIndex;
		$nTradieMaxSizeIndex = 0;
		
		if ($strTradieMaxSize == "Up to 50")
			$nTradieMaxSizeIndex = 1;
		else if ($strTradieMaxSize == ">50 - 100")
			$nTradieMaxSizeIndex = 2;
		else if ($strTradieMaxSize == "100 - 250")
			$nTradieMaxSizeIndex = 3;
		else if ($strTradieMaxSize == "250 - 500")
			$nTradieMaxSizeIndex = 4;
		else if ($strTradieMaxSize == "More than 500")
			$nTradieMaxSizeIndex = 5;
		else if ($strTradieMaxSize == "Up to 50")
			$nTradieMaxSizeIndex = 6;
			
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
	//** ADVERT RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
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
	
	function DoInsertAdvert($strSpaceCode, $nImageHeight, $strIDAdvertDiv)
	{
		global $g_dbFindATradie;
		$dateNow = new DateTime();
		
		$results = DoFindQuery1($g_dbFindATradie, "adverts", "space_id", GetSpaceID($strSpaceCode) , "expiry_date > '" . $dateNow->format("Y-m-d") . "'");		
		if ($results && ($results->num_rows > 0))
		{
			$row = $results->fetch_assoc(); 
			$dateExpiry = new DateTime($row["expiry_date"]);
			echo "<a href=\"tradie.php?member_id=" . $row["member_id"] . "\"><img src=\"images/" . $row["image_name"] . 
					"\" alt=\"" . $row["image_name"] . "\" class=\"advert_image\" height=\"" .  $nImageHeight . "\" />\n";
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
				
			echo "\"></button>\n";
		}
	}

	function DoCleanupAdvertImages()
	{
		global $g_dbFindATradie;
		$dateStart = new DateTime();
		$dateEnd = new DateTime();
		$interval = DateInterval::createFromDateString("-6 month");
		$dateStart = $dateStart->add($interval);

		$results = DoFindQuery0($g_dbFindATradie, "adverts", "expiry_date>'" . $dateStart->format("Y-m-d") . "' AND expiry_date<='" . $dateEnd->format("Y-m-d") . "'");
		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				$strImageFileName = "images/" . $row["image_name"];
				if (file_exists($strImageFileName))
				{
					unlink($strImageFileName);
					//DebugPrint("deleting image file", $strImageFileName, 6);
				}
			}
		}
	}
	



	//******************************************************************************
	//******************************************************************************
	//** 
	//** FEEDBACK RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoDisplayFeedback($strRecipientID, $strProviderID, $bDisplayNames)
	{
		global $g_dbFindATradie;
		$bDisplayEdit = $strProviderID != "";
		$queryResult = NULL;

		if (($strProviderID != "") && ($strRecipientID != ""))
			$queryResult = DoFindQuery2($g_dbFindATradie, "feedback", "recipient_id", $strRecipientID, "provider_id", $strProviderID);
		else if ($strRecipientID != "")
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $strRecipientID);
		else if ($strProviderID != "")
			$queryResult = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $strProviderID);

		if ($queryResult && ($queryResult->num_rows > 0))
		{
			$arrayFeedback = [];
			$nTotal = 0;
			$nPositive = 0;
			$nNegative = 0;
			
			while ($rowFeedback = $queryResult->fetch_assoc())
			{
				if ($rowFeedback["positive"])
					$nPositive++;
				else
					$nNegative++;

				$nTotal++;
			}
			$nThumbsWidth = 20;
			echo "<br/><br/><hr>\n";
			echo "<table cellspacing=\"0\" cellpadding=\"10\">\n";
			echo "<tr>\n";
			echo "<td>\n";
			echo "<img src=\"images/thumbs_up.png\" alt=\"images/thumbs_up.png\" width=\"" . $nThumbsWidth . "\" />\n";
			echo "</td>\n";
			echo "<td>\n";
			printf("%d%%", ($nPositive * 100) / $nTotal);
			echo "</td>\n";
			echo "<td>\n";
			echo "<img src=\"images/thumbs_down.png\" alt=\"images/thumbs_down.png\" width=\"" . $nThumbsWidth . "\" />\n";
			echo "</td>\n";
			echo "<td>\n";
			printf("%d%%", ($nNegative * 100) / $nTotal);
			echo "</td>\n";
			echo "</tr>\n";
			echo "</table>\n";
			echo "<hr><br/><br/>";
			if ($bDisplayEdit)
			{
				$bFeedbackEdit = true;
				include "feedback_form.html";
			}
			echo "<table cellspacing=\"0\" cellpadding=\"10\" class=\"table_no_borders search_table\" style=\"width:99%;layout:fixed;\">\n";
			$queryResult->data_seek(0);
			while ($rowFeedback = $queryResult->fetch_assoc())
			{
				$rowMember = DoGetMember($rowFeedback["provider_id"]);
				
				echo "<tr>\n";
				echo "<td class=\"feedback_row\" style=\"width:30px;\">\n";
				if ($rowFeedback["positive"])
					echo "<img src=\"images/thumbs_up.png\" alt=\"images/thumbs_up.png\" width=\"" . $nThumbsWidth . "\" />\n";
				else
					echo "<img src=\"images/thumbs_down.png\" alt=\"images/thumbs_down.png\" width=\"" . $nThumbsWidth . "\" />\n";								
				echo "</td>\n";
				echo "<td class=\"feedback_row\">\n";
				$dateAdded = new DateTime($rowFeedback["date_added"]);
				echo $dateAdded->format("d/m/Y");
				echo "</td>\n";
				echo "<td class=\"feedback_row\">\n";
				echo $rowFeedback["description"];
				echo "</td>\n";
					echo "<td class=\"feedback_row\" style=\"width:150px;\">\n";
					echo $rowMember["first_name"] . " " . $rowMember["surname"];
					echo "</td>\n";
				if ($bDisplayNames && !$bDisplayEdit && !$rowFeedback["positive"])
				{
					echo "<td class=\"feedback_row\" style=\"width:20px;\">\n";
					echo "<a href=\"mailto://" . $rowMember["email"] . "?subject=RE: Negative feedback left on 'Find a Tradie'\"><img src=\"images/email.png\" alt=\"images/email.png\" width=\"25\"/></a>\n";
					echo "</td>\n";
				}
				else
				{
					echo "<td class=\"feedback_row\" style=\"width:20px;\">\n";
					echo "&nbsp;\n";
					echo "</td>\n";
				}
				if ($bDisplayEdit)
				{
					echo "<td class=\"feedback_row\" style=\"width:30px;\">\n";
					echo "<button type=\"button\" id=\"button_edit\" title=\"Edit your feedback\" onclick=\"OnClickEditFeedback(this, '" . $rowFeedback["id"] . 
						"', '" . $rowFeedback["positive"] . "', '" . $rowFeedback["description"] . 
						"') \"><img src=\"images/edit.png\" alt=\"images/edit.png\" width=\"20\" /></button>\n";
					echo "</td>\n";
				}
				echo "</tr>\n";
			}
			echo "</table>\n";
		}
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** POSTED JOBS FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoGetJobsPosted()
	{
		global $g_dbFindATradie;
		$row = null;
		
		$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_SESSION["account_id"]);
		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				echo "<tr>\n";
				echo "<td class=\"search_cell\">\n";
				echo $row["date_added"];
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo $row["size"];
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo $row["maximum_budget"];
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				if ($row["urgent"] == "1")
					echo "YES\n";
				else
					echo "NO\n";
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				if ($row["accepted_by_member_id"] > -1)
				{
					$rowMember = DoGetMember($row["accepted_by_member_id"]);
					echo "<a href=\"tradie.php?member_id=" . $row["accepted_by_member_id"] . "\">" . $rowMember["business_name"] . "</a>\n";
				}
				else
				{
					echo "";
				}
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo $row["description"];
				echo "</td>\n";
				echo "<td class=\"search_cell\">\n";
				echo "	<form method=\"post\" action=\"\">\n";
				echo "		<button type=\"submit\ id=\"submit_job_edit\" name=\"submit_job_edit\" title=\"Edit your job\" value=\"EDIT\" /><img src=\"images/edit.png\" alt=\"images/edit.png\" width=\"20px\" /></button>&nbsp;\n";
				echo "		<button type=\"submit\ id=\"submit_job_delete\" name=\"submit_job_delete\" title=\"Delete your feedback\" value=\"DELETE\" /><img src=\"images/delete.png\" alt=\"images/delete.png\" width=\"20px\" /></button>\n";
				echo "		<button type=\"button\ id=\"button_job_complete\" name=\"button_job_complete\" title=\"Flag your job as complete and provide feedback for your client\" value=\"COMPLETE\" onclick=\"return OnClickComplete(\"" . $row["id"] . "\");\" /><img src=\"images/complete.png\" alt=\"images/complete.png\" width=\"20px\" /></button>\n";
				echo "		<input type=\"hidden\" name=\"hidden_job_edit_id\" value=\"" . $row["id"] . "\">\n";
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
	
	function DoGetJobs($strTradeID, $mapAddedJobIDs)
	{
		global $g_dbFindATradie;
		$row = null;
		
		if (isset($_POST["submit_job_search"]))
		{
			/*
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH )
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => 2023-11-01 [checkbox_urgent] => on [submit_job_search] => SEARCH ) 
				Array ( [text_maximum_distance] => [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH ) 
			*/	
			$strQuery = "SELECT * FROM jobs WHERE trade-id=" . $strTradeID;
			if (isset($_POST["text_minimum_budget"]) && ($_POST["text_minimum_budget"] != ""))
			{
				$strQuery = $strQuery . " AND maximum_budget>='" . $_POST["text_minimum_budget"] . "'";
			}
			if (isset($_POST["date_since"]) && ($_POST["date_since"] != ""))
			{
				$strQuery = $strQuery . " AND date_added>='" . $_POST["date_since"] . "'";
			}
			if (isset($_POST["checkbox_urgent"]) && ($_POST["checkbox_urgent"] == "on"))
			{
				$strQuery = $strQuery . " AND urgent=1";
			}
			$strQuery = $strQuery . " ORDER BY accepted_by_member_id ";
			if (isset($_POST["checkbox_hide_accepted"]) && ($_POST["checkbox_hide_accepted"] == "on"))
				$strQuery = $strQuery . "ASC";
			else
				$strQuery = $strQuery . "DESC";
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

				if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_SESSION["account_maximum_distance"]) && 
					(DoGetSizeIndex($rowJob["size"]) <= DoGetSizeIndex($_SESSION["account_maximum_size"])) &&
					(($rowJob["accepted_by_member_id"] == -1) || ($rowJob["accepted_by_member_id"] == $_SESSION["account_id"])))
				{
					if (!array_key_exists($rowJob["id"], $mapAddedJobIDs))
					{
						$mapAddedJobIDs[$rowJob["id"]] = true;
						echo "<tr>\n";
						$date = new DateTime($rowJob["date_added"]);
						echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["id"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\">" . $date->format("d/m/Y") . "</td>\n";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\"><a href=\"mailto://" . $rowMember["email"] . "?subject=RE: job id: " . $rowJob["id"] . ", posted on date: " . $date->format("d/m/Y") . " on 'Find a Tradie'\">" . $rowMember["email"] . "</a></td>\n";
						echo "<td class=\"cell_no_borders search_cell\">" . sprintf("$%d", $rowJob["maximum_budget"]) . "</td>";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["size"] . "</td>";
						if ($rowJob["urgent"])
							echo "<td class=\"cell_no_borders search_cell\">YES</td>";
						else
							echo "<td class=\"cell_no_borders search_cell\">NO</td>";
						echo "<td class=\"cell_no_borders search_cell\">";
						echo "<button type=\"button\" title=\"View the job description\" onclick=\"AlertInformation('JOB DESCRIPTION', '" . $rowJob["description"] . "');return false;\"><img src=\"images/view.png\" alt=\"images/view.png\" width=\"20px;\" /></button>&nbsp;";
						if ($rowJob["accepted_by_member_id"] == -1)
							echo "<button type=\"button\" title=\"Accept this job\" onclick=\"document.location = 'account.php?text_job_id=" . $rowJob["id"] . "&text_member_id=" . $_SESSION["account_id"] . "&submit_accept_job=ACCEPT';\" \"><img src=\"images/accept.png\" alt=\"images/accept.png\" width=\"20px;\" /></button>&nbsp;";
						else if ($rowJob["accepted_by_member_id"] == $_SESSION["account_id"])
							echo "<button type=\"button\" title=\"Unaccept this job\" onclick=\"document.location = 'account.php?text_job_id=" . $rowJob["id"] . "&submit_unaccept_job=UNACCEPT';\" \"><img src=\"images/unaccept.png\" alt=\"images/unaccept.png\" width=\"20px;\" /></button>&nbsp;";
						else
							echo "ERROR";
						echo "</td>\n";
						echo "</tr>\n";
					}
				}
			}
		}
		else
		{
			echo "<tr><td style=\"height:30px;\">No jobs found based on your account job preferences. Try searching with different job preferences.</td></tr>\n";
		}
		return $mapAddedJobIDs;
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
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["id"] . "</td>";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</td>";
		echo "<td class=\"cell_no_borders search_cell\"><a href=\"mailto://" . $rowMember["email"] . "?subject=RE: job id: " . $rowJob["id"] . ", posted on date: " . $date->format("d/m/Y") . " on 'Find a Tradie'\">Email member</a></td>\n";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["phone"] . "</td>";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["mobile"] . "</td>";
		echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["postcode"] . "</td>";
		echo "<td class=\"cell_no_borders search_cell\"><a href=\"tradie.php?member_id=" . $rowMember["id"] . "\">VIEW</a></td>";
		echo "</tr>\n";
	}
	
	function DoGetTradies($strTradeID)
	{
		global $g_dbFindATradie;
		$rowMember = null;

		$results = DoFindQuery1($g_dbFindATradie, "trade_id", $strTradeID);
		if ($results && ($results->num_rows > 0))
		{
			while ($rowMember = $results->fetch_assoc())
			{
				if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_POST["text_maximum_distance"]))
				{
					DoCreateTradieRow($rowMember);
				}
			}
		}
		$strQuery = "SELECT * FROM members WHERE trade_id!='59'"; 
		$results = DoQuery($g_dbFindATradie, $strQuery);
		if ($results && ($results->num_rows > 0))
		{
			while ($rowMember = $results->fetch_assoc())
			{
				$results = DoFindQuery2($g_dbFindATradie, "additional_trades", "member_id", $rowMember["id"], "trade_id", $strTradeID);
				if ($results && ($result->num_rows > 0))
				{
					if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_POST["text_maximum_distance"]))
					{
						DoCreateTradieRow($rowMember);
					}
				}
			}
		}
	}
	
?>







_