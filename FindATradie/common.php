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

	function DoFindQuery1($dbConnection, $strTableName, $strColumnName, $strColumnValue, $strCondition = "")
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName . "='" . EscapeSingleQuote($strColumnValue) . "'";
		
		if (strlen($strCondition) > 0)
			$strQuery = $strQuery . " AND " . $strCondition;

		return DoQuery($dbConnection, $strQuery);
	}	
	
	function DoFindQuery2($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strCondition = "")
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "'";
	
		if (strlen($strCondition) > 0)
			$strQuery = $strQuery . " AND " . $strCondition;

		return DoQuery($dbConnection, $strQuery);
	}
	
	function DoFindQuery3($dbConnection, $strTableName, $strColumnName1, $strColumnValue1, $strColumnName2, $strColumnValue2, $strColumnName3, $strColumnValue3, $strCondition = "")
	{	
		$strQuery = "SELECT * FROM " . $strTableName . " WHERE " . $strColumnName1 . "='" . EscapeSingleQuote($strColumnValue1) . "' AND " . $strColumnName2 . "='" . EscapeSingleQuote($strColumnValue2) . "' AND " . $strColumnName3 . "='" . EscapeSingleQuote($strColumnValue3) . "'";		
	
		if (strlen($strCondition) > 0)
			$strQuery = $strQuery . " AND " . $strCondition;

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
	
	function DoInsertAdvert($strSpaceName, $nImageHeight)
	{
		global $g_dbFindATradie;
		$dateNow = new DateTime();
			
		$result = DoFindQuery1($g_dbFindATradie, "adverts", "space_name", $strSpaceName , "expiry_date > '" . ($dateNow->format("Y-m-d")) . "'");
		if ($result->num_rows > 0)
		{
			echo "<a class=\"advert_image\" href=\"images/" . $row["image_name"] . "\"><img src=\"images/" . $row["image_name"] . "\" alt=\"" . $row["image_name"] . "\" /></a>\n";
			echo $row["text"];
			echo "<div class=\"advert_text\">" . "</div>\n";
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

?>



