<?php
	
	$g_bIsApp = true;
	require_once "../common.php";




	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "jobs_list")
		{
			$arrayJobsList = [];
			
			$results = DoFindAllQuery($g_dbFindATradie, "jobs", "member_id", $_POST["member_id"], "accepted_member_id = '0' OR accepted_by_member_id = " . $_POST["member_id"]);
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
								IsMatchMaxSize(DoGetSizeIndex($_POST["maximum_size"]), DoGetSizeIndex($row["size"])) && 
								IsDistanceMatch($_POST["postcode"], DoGetColumnValue("members", "id", $row["member_id"], "postcode"), $_POST["maximum_distance"]) &&
								IsTradeMatch($_POST["trade_id"], $_POST["additional_trades"], $row["trade_id"]))
							{
								$objectJobDetails = (object)[];
								$objectJobDetails->job_id = $row["id"];
								$objectJobDetails->member_id = $row["member_id"];
								
								$rowMember = DoGetMember($row["member_id"]);
								$objectJobDetails->name = $rowMember["first_name"] . " " . $rowMember["surname"];
								
								$objectJobDetails->trade_id = $row["trade_id"];
								$objectJobDetails->date_added = $row["date_added"];
								
								$objectJobDetails->date_completed = "";
								if ($row["date_completed"] != NULL)
									$objectJobDetails->date_completed = $row["date_completed"];
									
								$objectJobDetails->accepted_by_member_id = $row["accepted_by_member_id"];
								$objectJobDetails->accepted = $row["accepted_by_member_id"] != "0";

								$objectJobDetails->date_accepted = "";
								if ($row["date_accepted"] != NULL)
									$objectJobDetails->date_accepted = $row["date_accepted"];
									
								$objectJobDetails->description = $row["description"];
								$objectJobDetails->maximum_budget = $row["maximum_budget"];
								$objectJobDetails->size = $row["size"];
								$objectJobDetails->urgent = $row["urgent"];
								$objectJobDetails->completed = $row["completed"] == "1";
								$arrayJobsList[] = $objectJobDetails;
							}
						}
					}
				}
			}
			echo "OK" . json_encode($arrayJobsList);
		}
		else if ($_POST["button"] == "edit_job")
		{
		/*
			$_POST["job_id"]
			$_POST["trade_id"]
			$_POST["description"]
			$_POST["maximum_budget"]
			$_POST["size"]
			$_POST["urgent"]
		*/
		}
		else if ($_POST["button"] == "send_job_email")
		{
		/*
			$_POST["to_email"]
			$_POST["from_email"]
			$_POST["subject"]
			$_POST["message"]
		*/
		}
		else if ($_POST["button"] == "new_job")
		{
			//$_POST["trade_id"]
			//$_POST["description"]
			//$_POST["maximum_budget"]
			//$_POST["size"]
			//$_POST["urgent"]
		}
		else if ($_POST["button"] == "edit_job")
		{
			//$_POST["id"]
			//$_POST["trade_id"]
			//$_POST["description"]
			//$_POST["maximum_budget"]
			//$_POST["size"]
			//$_POST["urgent"]
		}
		else if ($_POST["button"] == "accept_job")
		{
			//$_POST["id"]
		}
		else if ($_POST["button"] == "unaccept_job")
		{
			//$_POST["id"]
		}
		else if ($_POST["button"] == "complete_job")
		{
			//$_POST["id"]
		}
		else if ($_POST["button"] == "uncomplete_job")
		{
			//$_POST["id"]
		}
		else if ($_POST["button"] == "delere_job")
		{
			//$_POST["id"]
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