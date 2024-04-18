<?php

	$g_bIsApp = true;
	require_once "../common.php";



	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "get_tradie_details")
		{
			$arrayTradies = [];
			$results = DoFindAllQuery($g_dbFindATradie, "members", "trade_id != '" . DoGetCustomerTradeID() . "'");
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					if ((($_POST["trade_id_on"] == "false") || (($_POST["trade_id_on"] == "true") && ($_POST["trade_id"] == $row["trade_id"]))) &&
						(($_POST["maximum_size_on"] == "false") || ($_POST["maximum_size_on"] && (DoGetJobSizeIndex($_POST["maximum_size"]) <= DoGetJobSizeIndex($row["maximum_size"])))) &&
						(($_POST["minimum_budget_on"] == "false") || (($_POST["minimum_budget_on"] == "true") && ($row["minimum_budget"] >= $_POST["minimum_budget"]))) &&
						(($_POST["maximum_distance_on"] == "false") || (($_POST["maximum_distance_on"] == "true") && ($_POST["maximum_distance"] <= $row["maximum_distance"]))))
					{		
						if ((($_POST["suburb_on"] == "false") || (($_POST["suburb_on"] == "true") && ($_POST["state"] == $row["state"]))) &&
							(($_POST["postcode_on"] == "false") ||  (($_POST["postcode_on"] == "true") && ($_POST["postcode"] == $row["postcode"]))) &&
							(($_POST["state_on"] == "false") || (($_POST["state_on"] == "true") && ($_POST["state"] == $row["state"]))) &&
							(($_POST["in_range_on"] == "false") || (($_POST["in_range_on"] == "true") && IsDistanceMatch($_POST["destination_postcode"], $row["postcode"], $row["maximum_distance"]))))
						{
							$objectTradieDetails = (object)[];
							
							$objectTradieDetails->member_id = $row["id"];
							$objectTradieDetails->business_name = $row["business_name"];
							$objectTradieDetails->name = $row["first_name"] . " " . $row["surname"];
							$objectTradieDetails->abn = $row["abn"];
							$objectTradieDetails->suburb = $row["suburb"];
							$objectTradieDetails->postcode = $row["postcode"];
							$objectTradieDetails->state = $row["state"];
							$objectTradieDetails->profile_filename = $row["profile_filename"];
							$objectTradieDetails->license = $row["license"];
							$objectTradieDetails->description = $row["description"];
					
							$arrayTradies[] = $objectTradieDetails;
						}
					}
				}
				echo "OK" . json_encode($arrayTradies);
			}
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	else if (ProcessAdvertFunction())
	{
	}
	else
	{
		print_r($_POST);
	}

?>