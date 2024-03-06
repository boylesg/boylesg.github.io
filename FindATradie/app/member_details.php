<?php

	$g_bIsApp = true;
	require_once "../common.php";




	function DoSaveAdditionalTrades($jsonAdditionalTrades, $strMemberID)
	{
		$results = DoDeleteQuery($g_dbFindATradie, "additional_trades", "id", $strMemberID);
		$arrayAdditiopnalTradesIDs = json_decode($jsonAdditionalTrades);
		
		for ($nI = 0; $nI < count($arrayAdditiopnalTradesIDs); $nI++)
		{
			$results = DoInsertQuery2($g_dbFindATradie, "additional_trades", "member_id", $strMemberID, 
																			"trade_id", $arrayAdditiopnalTradesIDs[$nI]);
			if (!$results)
				break;
		}
		return $results;
	}
	
	
	

	if (isset($_POST["button"]))
	{
		// Updating details of an existing member
		if ($_POST["button"] == "save_member_details")
		{
			$g_strQuery = "UPDATE members SET first_name = '" . EscapeSingleQuote($_POST["first_name"]) . "', " .
											  "surname = '" . EscapeSingleQuote($_POST["surname"]) . "', " .
											  "unit = '" . EscapeSingleQuote($_POST["unit"]) . "', " .
											  "street = '" . EscapeSingleQuote($_POST["street"]) . "', " .
											  "suburb = '" . EscapeSingleQuote($_POST["suburb"]) . "', " .
											  "state = '" . $_POST["state"] . "', " .
											  "postcode = '" . $_POST["postcode"] . "', " .
											  "phone = '" . $_POST["phone"] . "', " .
											  "mobile = '" . $_POST["mobile"] . "', " .
											  "email = '" . $_POST["email"] . "', " .
											  "username = '" . $_POST["username"] .  "', " .
											  "password = '" . DoAESEncrypt($_POST["password"]) . "'" .
											  " WHERE id = '" . $_POST["member_id"] . "'";
											  		
			$results = DoQuery($g_dbFindATradie, $g_strQuery);
			if ($results)
			{
	
				//DoSetConfigProfileImage($_POST["member_id"]);
				echo "OK";
			}
			else
			{
				echo "ERROR";
			}
		}
		// Updating details of an existing member
		else if ($_POST["button"] == "save_business_details")
		{
			$g_strQuery = "UPDATE members SET business_name = '" . EscapeSingleQuote($_POST["business_name"]) . "', " . 
											  "abn = '" . $_POST["abn"] . "', " .
											  "license = '" . EscapeSingleQuote($_POST["minimum_charge"]) . "', " .
											  "minimum_budget = '" . $_POST["minimum_budget"] . "', " .
											  "maximum_size = '" . $_POST["maximum_size"] . "', " .
											  "maximumm_distance = '" .  $_POST["license"] . "', " .
											  "description = '" . EscapeSingleQuote($_POST["description"]) . "', " .
											  "minimum_charge = '" . $_POST["maximumm_distance"] . "', " .
											  "trade_id = '" . $_POST["trade_id"] . "'" . 
											  " WHERE id = '" . $_POST["member_id"] . "'";
											  
			$results = DoQuery($g_dbFindATradie, $g_strQuery);
			if ($results)
			{
				if (DoSaveAdditionalTrades($_POST["additional_trade_ids"], $_POST["member_id"]))
					echo "OK";
			}
			else
			{
				echo "ERROR";
			}
		}
		// Adding details of a new member
		else if ($_POST["button"] == "save_all_details")
		{
			if (DoesUsernameExist($_POST["username"]))
			{
				echo "Another member is using the username '" . $_POST["username"] . "' - please choose another username.";
			}
			else if (DoesEmailExist($_POST["email"]))
			{
				echo "Another member is using the email address '" . $_POST["email"] . "' - please choose another email address.";
			}
			else
			{
				DoSetConfigProfileImage($_POST["member_id"]);
				
				$dateNow = new DateTime();
				$dateExpiry = new DateTime();
				if ($dateNow <= $g_dateJoinFree)
					$dateExpiry = $g_dateJoinFree;
				else
					$dateExpiry = $dateNow;
			
				if (strcmp($_POST["trade_id"], DoGetCustomerTradeID()) == 0)
				{
					$g_strQuery = "INSERT INTO members (first_name , surname, unit, street, suburb, state, postcode, phone, mobile, " . 
														"email, username, password, business_name, abn, license, description, " .
														"minimum_charge, minimum_budget, maximum_size, maximumm_distance, trade_id, " . 
														"expiry_date) VALUES (" . 
														"'" . EscapeSingleQuote($_POST["first_name"]) . "', " . 
												  		"'" . EscapeSingleQuote($_POST["surname"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["unit"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["street"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["suburb"]) .  "', " . 
														"'" . $_POST["state"] .  "', " . 
														"'" . $_POST["postcode"] .  "', " . 
														"'" . $_POST["phone"] .  "', " . 
														"'" . $_POST["mobile"]	.  "', " . 
														"'" . $_POST["email"] .  "'" . 
														"'" . $_POST["username"] .  "', " . 
														"'" . DoAESEncrypt($_POST["password"]) .  "', " . 
													  	"'2050-12-31'" . 
														"'" . $_POST["trade_id"] . "')";
				}
				else
				{
					$dateNow = new DateTime();
					$dateExpiry = new DateTime();
					if ($dateNow < $g_dateJoinFree)
						$dateExpiry->modify("+" . $g_nNumMonthsFree . "months");
					
					$g_strQuery = "INSERT INTO members (first_name , surname, unit, street, suburb, state, postcode, phone, mobile, " . 
														"email, username, password, business_name, abn, license, description, " .
														"minimum_charge, minimum_budget, maximum_size, maximumm_distance, trade_id, " . 
														"expiry_date) VALUES (" . 
														"'" . EscapeSingleQuote($_POST["first_name"]) . "', " . 
												  		"'" . EscapeSingleQuote($_POST["surname"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["unit"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["street"]) .  "', " . 
														"'" . EscapeSingleQuote($_POST["suburb"]) .  "', " . 
														"'" . $_POST["state"] .  "', " . 
														"'" . $_POST["postcode"] .  "', " . 
														"'" . $_POST["phone"] .  "', " . 
														"'" . $_POST["mobile"]	.  "', " . 
														"'" . $_POST["email"] .  "'" . 
														"'" . $_POST["username"] .  "', " . 
														"'" . DoAESEncrypt($_POST["password"]) .  "', " . 
													  	"'" . $dateExpiry->format("Y-m-d") . "'" . 
														
														"'" . EscapeSingleQuote($_POST["business_name"]) . "', " .
														"'" . $_POST["abn"] . "', " .
														"'" . $_POST["license"] . "', " .
														"'" . EscapeSingleQuote($_POST["description"]) . "', " .
														"'" . $_POST["minimum_charge"] . "', " .
														"'" . $_POST["minimum_budget"] . "', " .
														"'" . $_POST["maximum_size"] . "', " .
														"'" . $_POST["maximumm_distance"] . "', " .
														"'" . $_POST["trade_id"] . "', " .
														"'" . $dateExpiry->format("Y-m-d") . "')";
				}
				$results = DoQuery($g_dbFindATradie, $g_strQuery);
				if ($results)
					echo "OK";
			}
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	else
	{
		//print_r($_POST);
	}

?>
