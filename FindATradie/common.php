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
	$g_strDivOpen = "<div style=\"background-color:white;\">";
	$g_strDivClose = "</div>";
	$g_strPaypalLive = "none";
	$g_strPaypalTest = "block";


	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
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
			PrintJavascriptLine("AlertError(\"" . $e->getMessage() . "<br/><br/>" . $g_strEmailAdmin . "\");", 2, true);
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

	function DoUpdateQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strFindColumnName, $strFindColumnValue)
	{
		global $g_strQuery;
		$g_strQuery = "UPDATE " . $strTableName . " SET " . $strColumnName1 . "='" . $strColumnValue1 . "'," . 
			$strColumnName2 . "='" .  $strColumnValue2 . "'," . $strColumnName3 . "='" .  $strColumnValue3 . "' WHERE " . 
			$strFindColumnName . "='" . $strFindColumnValue . "'";

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
			
			if (isset($strTradeID) && ($strTradeID == $row["id"]))
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
	
	function GetMember($strMemberID)
	{
		global $g_dbFindATradie;
		$row = null;
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
			$row = $results->fetch_assoc();
			
		return $row;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADIE SEARCH FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
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
	
	function IsDistanceMatch($strTradiePostcode, $strJobPostcode, $strTradieMaxDistance)
	{
		return true;
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
	//** ADVERT RELATED FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoDisplayFeedback($strRecipientID, $strProviderID)
	{
		global $g_dbFindATradie;
		$bDisplayNames = $strRecipientID != "";
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
			if (!$bDisplayNames)
				include "feedback_form.html";
			echo "<table cellspacing=\"0\" cellpadding=\"10\" style=\"width:100%;layout:fixed;\">\n";
			$queryResult->data_seek(0);
			while ($rowFeedback = $queryResult->fetch_assoc())
			{
				$rowMember = GetMember($rowFeedback["provider_id"]);
				
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
				if ($bDisplayNames)
				{
					echo "<td class=\"feedback_row\" style=\"width:250px;\">\n";
					echo "<a href=\"member.php?" . $rowMember["first_name"] . "\">" . $rowMember["surname"] . "</a>\n";
					echo "</td>\n";
				}
				else if ($bDisplayEdit)
				{
					echo "<td class=\"feedback_row\" style=\"width:30px;\">\n";
					echo "<button type=\"button\" id=\"button_edit\" onclick=\"OnClickEditFeedback(this, '" . $rowFeedback["id"] . 
						"', '" . $rowFeedback["positive"] . "', '" . $rowFeedback["description"] . 
						"') \"><img src=\"images/edit.png\" alt=\"images/edit.png\" width=\"20\" /></button>\n";
					echo "</td>\n";
				}
				echo "</tr>\n";
			}
			echo "</table>\n";
		}
	}
	
?>



