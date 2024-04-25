<?php

	$g_bIsApp = true;
	require_once "../common.php";
	
	
	
	
	function DoGetAdditionalTrades($strMemberID)
	{
		global $g_dbFindATradie;
		$arrayAdditionalTradeIDs = [];
		
		$results = DoFindQuery1($g_dbFindATradie, "additional_trades", "member_id", $strMemberID);
		
		if ($results && ($results->num_rows > 0))
		{
			while ($row = $results->fetch_assoc())
			{
				$arrayAdditionalTradeIDs[] = GetTradeName($row["id"]);
			}
		}
		return $arrayAdditionalTradeIDs;
	}
	
	
	
	
	function DoLoginStuff($results, $strPassword)
	{
		if ($row = $results->fetch_assoc())
		{
			if (DoAESDecrypt($row["password"]) == $strPassword)
			{
				$objectMember = (object)[];
				
				$objectMember->member_id = $row["id"];
				$objectMember->trade_id = $row["trade_id"];
				$objectMember->trade_name = GetTradeName($row["trade_id"]);
				$objectMember->additional_trades = DoGetAdditionalTrades($row["id"]);
				$objectMember->business_name = $row["business_name"];
				$objectMember->first_name = $row["first_name"];
				$objectMember->surname = $row["surname"];
				$objectMember->gender = $row["gender"];
				$objectMember->profile_filename = $row["profile_filename"];
				$objectMember->logo_filename = $row["logo_filename"];
				$objectMember->abn = $row["abn"];
				$objectMember->structure = $row["structure"];
				$objectMember->license = $row["license"];
				$objectMember->description = $row["description"];
				$objectMember->minimum_charge = sprintf("%d", $row["minimum_charge"]);
				$objectMember->minimum_budget = sprintf("%d", $row["minimum_budget"]);
				$objectMember->maximum_size = $row["maximum_size"];
				$objectMember->maximum_distance = sprintf("%d", $row["maximum_distance"]);
				$objectMember->unit = $row["unit"];
				$objectMember->street = $row["street"];
				$objectMember->suburb = $row["suburb"];
				$objectMember->state = $row["state"];
				$objectMember->postcode = $row["postcode"];
				$objectMember->phone = $row["phone"];
				$objectMember->mobile = $row["mobile"];
				$objectMember->email = $row["email"];
				$objectMember->username = $row["username"];
				$objectMember->password = DoAESDecrypt($row["password"]);
				$objectMember->expiry_date = $row["expiry_date"];
				$objectMember->date_joined = $row["date_joined"];
				
				$dateNow = new DateTime();
				$dateExpiry = new DateTime($row["expiry_date"]);
				$objectMember->expired = $dateNow >= $dateExpiry;
				
				echo "OK" . json_encode($objectMember);
			}
			else
				echo "FAILEDPassword '" . $strPassword . "' is incorrect!";
		}
		else
			echo "FAILEDFailed to fetch the row!";
	}
	
	
	
	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "login")
		{
			$results = DoFindQuery1($g_dbFindATradie, "members", "username", $_POST["username"]);
			// Username found so check if an email address has been used.
	
			if ($results)
			{
				if ($results->num_rows > 1)
					echo "FAILEDMore than once member with username '" . $_POST["username"] . "'!";
				else if ($results->num_rows == 1)
				{
					DoLoginStuff($results, $_POST["password"]);
				}
			}
			// Username not found.
			else
			{
				// Check if an email address has been used.
				$results = DoFindQuery1($g_dbFindATradie, "members", "email", $_POST["username"]);
	
				// Email address found...
				if ($results)
				{
					if ($results->num_rows > 1)
					{
						echo "FAILEDMore than one member with email '" . $_POST["username"] . "'!";
					}
					else if ($results->num_rows == 1)
					{
						DoLoginStuff($results, $_POST["password"]);
					}
				}
				else
					echo "FAILEDMember with username or email '" . $_POST["username"] . "' was not found!";
			}
		}
		else if ($_POST["button"] == "update_expiry_date")
		{
			$dateExpiry = new DateTime();
			$dateExpiry->modify("+" . $_POST["number_months"] . " month");
			$results = DoUpdateQuery1($g_dbFindATradie, "members", "expiry_date", $dateExpiry->format("Y-m-d"), "id", $_POST["member_id"]);
			if ($results)
				echo "expiry_date_updated=true";
			else
				echo "expiry_date_updated=false";
		}
		else if (ProcessAdvertFunction())
		{
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}	
	
?>
