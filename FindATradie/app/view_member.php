<?php

	$g_bIsApp = true;
	require_once "../common.php";
	
	
	
	
	
	function DoGetFeedbackList($strMemberID, &$arrayFeedback, &$nPercentPostive, &$nPercentNegative)
	{
		global $g_dbFindATradie;
		global $g_strQuery;
		
		$results = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $strMemberID);

		if ($results && ($results->num_rows > 0))
		{
			$nTotal = 0;
			$nPositive = 0;
			$nNegative = 0;
			
			while ($row = $results->fetch_assoc())
			{
				$objectFeedbackDetails = (object)[];
				$objectFeedbackDetails->recipient_id = $row["recipient_id"];
				$objectFeedbackDetails->provider_id = $row["provider_id"];
				$objectFeedbackDetails->name = "";
				
				if (strlen($row["provider_id"]) > 0)
					$objectFeedbackDetails->name = DoGetMemberFullName($row["provider_id"]);
				else if (strlen($row["name"]) > 0)
					$objectFeedbackDetails->name = $row["name"];
				else
					$objectFeedbackDetails->name = "NO NAME";
					
				$objectFeedbackDetails->positive = $row["positive"];
				$objectFeedbackDetails->description = $row["description"];
				$objectFeedbackDetails->date_added = $row["date_added"];
				$objectFeedbackDetails->date_modified = $row["date_modified"];
				if ($row["positive"] == "1")
					$nPositive++;
				else if ($row["positive"] == "0")
					$nNegative++;
				$nTotal++;
				$arrayFeedback[] = $objectFeedbackDetails;
			}
			$nPercentPostive = ($nPositive * 100) / $nTotal;
			$nPercentNegative = ($nNegative * 100) / $nTotal;
		}
	}



	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "get_member_details")
		{
			$objectMemberCollection = (object)[];
			$objectMemberDetails = (object)[];
			$results = DoFindQuery1($g_dbFindATradie, "members", "id", $_POST["member_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{						
					$objectMemberDetails->member_id = $row["id"];
					$objectMemberDetails->business_name = $row["business_name"];
					$objectMemberDetails->name = $row["first_name"] . " " . $row["surname"];
					$objectMemberDetails->suburb = $row["suburb"];
					$objectMemberDetails->postcode = $row["postcode"];
					$objectMemberDetails->state = $row["state"];
					$objectMemberDetails->profile_filename = $row["profile_filename"];
					$objectMemberDetails->logo_filename = $row["logo_filename"];
					$dateJoined = new DateTime($row["date_joined"]);
					$objectMemberDetails->date_joined = $dateJoined->format("d/m/Y");
					$objectMemberDetails->primary_trade = GetTradeName($row["trade_id"]);
					$objectMemberDetails->license = $row["license"];
					$objectMemberDetails->description = $row["description"];
					$objectMemberDetails->structure = $row["structure"];
					$objectMemberDetails->abn = $row["abn"];
					
					$objectMemberCollection->member_details = $objectMemberDetails;
					
					$objectMemberCollection->feedback_list = [];
					$objectMemberCollection->positive = 0;
					$objectMemberCollection->negative = 0;
					DoGetFeedbackList($_POST["member_id"], $objectMemberCollection->feedback_list, $objectMemberCollection->positive, $objectMemberCollection->negative);
				}
				
			}
			echo "OK" . json_encode($objectMemberCollection);
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	else
	{
		print_r($_POST);
	}

?>