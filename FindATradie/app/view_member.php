<?php

	$g_bIsApp = true;
	require_once "../common.php";



	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "get_tradie_details")
		{
			$objectMemberDetails = (object)[];
			$results = DoFindQuery1($g_dbFindATradie, "members", "member_id", $_POST["member_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{						
					$objectTradieDetails->member_id = $row["id"];
					$objectTradieDetails->business_name = $row["business_name"];
					$objectTradieDetails->name = $row["first_name"] . " " . $row["surname"];
					$objectTradieDetails->suburb = $row["suburb"];
					$objectTradieDetails->postcode = $row["postcode"];
					$objectTradieDetails->state = $row["state"];
					$objectTradieDetails->profile_filename = $row["profile_filename"];
					
					
					
					
					
					
					
				}
				echo "OK" . json_encode($objectMemberDetails);
			}
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