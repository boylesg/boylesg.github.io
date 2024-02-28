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
			$g_strQuery = "UPDATE members SET first_name = '" . $_POST["first_name"] . "', " .
											  "surname = '" . $_POST["surname"] . "', " .
											  "unit = '" . $_POST["unit"] . "', " .
											  "street = '" . $_POST["street"] . "', " .
											  "suburb = '" . $_POST["suburb"] . "', " .
											  "state = '" . $_POST["state"] . "', " .
											  "postcode = '" . $_POST["postcode"] . "', " .
											  "phone = '" . $_POST["phone"] . "', " .
											  "mobile = '" . $_POST["mobile"] . "', " .
											  "email = '" . $_POST["email"] . "', " .
											  "username = '" . $_POST["username"] .  "', " .
											  "password = '" . $_POST["password"] .
											  " WHERE id = '" . $_POST["member_id"] . "'";
											  
			$results = DoQuery($g_dbFindATradie, $g_strQuery);
			if ($results)
			{
				DoSetConfigProfileImage($_POST["member_id"]);
				echo "OK";
			}
		}
		// Updating details of an existing member
		else if ($_POST["button"] == "save_business_details")
		{
			$g_strQuery = "UPDATE members SET business_name = '" . $_POST["business_name"] . "', " . 
											  "abn = '" . $_POST["abn"] . "', " .
											  "license = '" . $_POST["minimum_charge"] . "', " .
											  "minimum_budget = '" . $_POST["minimum_budget"] . "', " .
											  "maximum_size = '" . $_POST["maximum_size"] . "', " .
											  "maximumm_distance = '" .  $_POST["license"] . "', " .
											  "description = '" . $_POST["description"] . "', " .
											  "minimum_charge = '" . $_POST["maximumm_distance"] . "', " .
											  "trade_id = '" . $_POST["trade_id"] . "'" . 
											  " WHERE id = '" . $_POST["member_id"] . "'";
											  
			$results = DoQuery($g_dbFindATradie, $g_strQuery);
			if ($results)
			{
				if (DoSaveAdditionalTrades($_POST["additional_trade_ids"], $_POST["member_id"]))
					echo "OK";
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
			
				$g_strQuery = "INSERT INTO members (first_name , surname, unit, street, suburb, state, postcode, phone, mobile, " . 
													"email, username, password, business_name, abn, license, description, " .
													"minimum_charge, minimum_budget, maximum_size, maximumm_distance, trade_id, " . 
													"expiry_date) VALUES (" . 
													"'" . $_POST["first_name"] . "', " . 
											  		"'" . $_POST["surname"] .  "', " . 
													"'" . $_POST["unit"] .  "', " . 
													"'" . $_POST["street"] .  "', " . 
													"'" . $_POST["suburb"] .  "', " . 
													"'" . $_POST["state"] .  "', " . 
													"'" . $_POST["postcode"] .  "', " . 
													"'" . $_POST["phone"] .  "', " . 
													"'" . $_POST["mobile"]	.  "', " . 
													"'" . $_POST["email"] .  "'" . 
													"'" . $_POST["username"] .  "', " . 
													"'" . $_POST["password"] .  "', " . 
												  	"'" . $dateExpiry->format("Y-m-d") . "'" . 
													
													"'" . $_POST["business_name"] . "', " .
													"'" . $_POST["abn"] . "', " .
													"'" . $_POST["license"] . "', " .
													"'" . $_POST["description"] . "', " .
													"'" . $_POST["minimum_charge"] . "', " .
													"'" . $_POST["minimum_budget"] . "', " .
													"'" . $_POST["maximum_size"] . "', " .
													"'" . $_POST["maximumm_distance"] . "', " .
													"'" . $_POST["trade_id"] . "')";
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
	// File upload?
	else if (!empty($_POST))
	{
		$strMemberID = "";
		
		if (IsLogoImageUpload($strMemberID))
		{
			if (strlen($strMemberID) > 0)
			{
				$strProfileFilename = DoGetProfileImageFilename($strMemberID);
				$results = DoUpdateQuery1($g_dbFindATradie, "members", "profile_filename", $strProfileFilename);
				if ($results)
				{
					$data = file_get_contents('php://input');
					$nBytes = file_put_contents($strProfileFilename, $data);
					
					if ($nBytes > 0)
						echo "OK";
					else
						echo "File '" . $strProfileFilename . "' could not be saved!";
				}
				else
				{
					echo "Could not update 'profile_filename' column for member '" . $strMemberID . "'!";
				}
			}
			else
			{
				echo "PROFILE image file name member ID is blank!";
			}		
		}
		else
		{
			//print_r($_POST);
		}
	}

?>
