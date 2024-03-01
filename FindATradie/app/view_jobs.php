<?php

	require_once "../common.php";




	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "jobs_list")
		{
			;
			;
			
			$arrayJobsList = [];
			
			$results = DoFindAllQuery($g_dbFindATradie, "jobs", "member_id", $strMemberID, "accepted_member_id = '0' OR accepted_by_member_id = " . $_POST["member_id"]);
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					$dateAdded = new DateTime($row["date_added"]);
					$dateMinimum = new DateTime($_POST["minimum_date"]);
					
					if (($_POST["show_urgent_jobs_only"] == "false") || (($_POST["show_urgent_jobs_only"] == "true") && ($row["urgent"] == '1')))
					{
						if (($_POST["hide_accepted_jobs"] == "false") || (($_POST["hide_accepted_jobs"] == "true") && ($row["accepted_by_member_id"] == "0")))
						{
							if (($row["maximum_budget"] >= $_POST["minimum_budget"]) && ($dateAdded >= $dateMinimum) && 
								IsMatchMaxSize(DoGetSizeIndex($_POST["maximum_size"]), DoGetSizeIndex($row["size"]) && 
								IsDistanceMatch($_POST["postcode"], DoGetColumnValue("members", "id", $row["member_id"], "postcode"), $_POST["maximum_distance"]) &&
								IsTradeMatch($_POST["trade_id"], $_POST["additional_trades"], $row["trade_id"]))
							{
								$objectJobDetails = (object)[];
								$objectJobDetails->job_id = $row["id"];
								$objectJobDetails->member_id = $row["member_id"];
								$objectJobDetails->trade_id = $row["trade_id"];
								$objectJobDetails->date_added = $row["date_added"];
								$objectJobDetails->accepted_by_member_id = $row["accepted_by_member_id"];
								$objectJobDetails->description = $row["description"];
								$objectJobDetails->maximum_budget = $row["maximum_budget"];
								$objectJobDetails->size = $row["size"];
								$objectJobDetails->urgent = $row["urgent"];
								$objectJobDetails->completed = $row["completed"];
								$arrayJobsList[] = $objectJobDetails;
							}
						}
					}
				}
			}
			echo "OK" . json_encode($arrayJobsList);
		}
		else if ($_POST["button"] == "XXXXXXXX")
		{
		}
		else if ($_POST["button"] == "XXXXXXXX")
		{
		}
		else if ($_POST["button"] == "XXXXXXXX")
		{
		}
		else if ($_POST["button"] == "XXXXXXXX")
		{
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