<?php
	
	$g_bIsApp = true;
	require_once "../common.php";
	
	
	
	
	function DoGetJobDetails($row)
	{
		$objectJobDetails = (object)[];
		$objectJobDetails->job_id = $row["id"];
		$objectJobDetails->member_id = $row["member_id"];
		
		$objectJobDetails->accepted_by_name = "";
		$objectJobDetails->accepted_by_mobile = "";
		$objectJobDetails->accepted_by_email = "";
		$objectJobDetails->name = "";
		$objectJobDetails->mobile = "";
		$objectJobDetails->email = "";
		if (!empty($row["accepted_by_member_id"]))
		{
			//if ($_POST["which"] == "my_jobs")
			{
				$rowMember = DoGetMember($row["accepted_by_member_id"]);
				$objectJobDetails->accepted_by_name = $rowMember["first_name"] . " " . $rowMember["surname"];
				$objectJobDetails->accepted_by_mobile = $rowMember["mobile"];
				$objectJobDetails->accepted_by_email = $rowMember["email"];
			}
			//else if ($_POST["which"] == "other_jobs")
			{
				$rowMember = DoGetMember($row["member_id"]);
				$objectJobDetails->name = $rowMember["first_name"] . " " . $rowMember["surname"];
				$objectJobDetails->mobile = $rowMember["mobile"];
				$objectJobDetails->email = $rowMember["email"];
			}
		}
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
		$objectJobDetails->urgent = $row["urgent"] == "1";
		$objectJobDetails->completed = $row["completed"] == "1";
		
		return $objectJobDetails;
	}




	if (isset($_POST["button"]))
	{
		$dateNow = new DateTime();
		$strDateNow = $dateNow->format("Y-m-d");
		
		if ($_POST["button"] == "jobs_list")
		{
			$arrayJobsList = [];
			$results = false;
			
			if ($_POST["which"] == "my_jobs")
			{
				$results = DoFindQuery1($g_dbFindATradie, "jobs", "member_id", $_POST["member_id"]);
				if ($results && ($results->num_rows > 0))
				{			
					$dateMinimum = new DateTime($_POST["minimum_date"]);
					
					while ($row = $results->fetch_assoc())
					{
						$dateAdded = new DateTime($row["date_added"]);
						
						if (($_POST["show_selected_jobs"] == "false") ||
							(($_POST["show_selected_jobs"] == "true") || 
							(($_POST["show_urgent_jobs_only"] == "false") || (($_POST["show_urgent_jobs_only"] == "true") && ($row["urgent"] == "1"))) ||
							(($_POST["show_accepted_jobs_only"] == "false") || (($_POST["show_accepted_jobs_only"] == "true") && ($row["accepted_by_member_id"] != "0")))))
						{
							if ($dateAdded >= $dateMinimum)
							{
								$objectJobDetails = DoGetJobDetails($row);
								$arrayJobsList[] = $objectJobDetails;
							}
						}							
					}
				}
			}
			else if ($_POST["which"] == "other_jobs")
			{
				$results = DoFindAllQuery($g_dbFindATradie, "jobs", "accepted_by_member_id = '0' OR accepted_by_member_id = " . $_POST["member_id"]);
			}
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					$dateAdded = new DateTime($row["date_added"]);
					$dateMinimum = new DateTime($_POST["minimum_date"]);
					
					if (($_POST["show_urgent_jobs_only"] == "false") || 
						(($_POST["show_urgent_jobs_only"] == "true") && ($row["urgent"] == '1')))
					{
						if ((($_POST["show_accepted_jobs_only"] == "false") || (($_POST["show_accepted_jobs_only"] == "true") && ($row["accepted_by_member_id"] != "0"))) ||
							(($_POST["show_paid_jobs_only"] == "false") || (($_POST["show_paid_jobs_only"] == "true") && ($row["completed"] == "1"))))
						{
							if ((($row["maximum_budget"] >= $_POST["minimum_budget"]) && ($dateAdded >= $dateMinimum) && 
								IsMatchMaxSize(DoGetSizeIndex($_POST["maximum_size"]), DoGetSizeIndex($row["size"])) && 
								IsDistanceMatch($_POST["postcode"], DoGetColumnValue("members", "id", $row["member_id"], "postcode"), $_POST["maximum_distance"]) &&
								IsTradeMatch($_POST["trade_id"], $_POST["additional_trades"], $row["trade_id"])) ||
								($_POST["which"] == "my_jobs"))
							{
								$objectJobDetails = DoGetJobDetails($row);
								$arrayJobsList[] = $objectJobDetails;
							}
						}
					}
				}
			}
			echo "OK" . json_encode($arrayJobsList);
		}
		else if ($_POST["button"] == "send_job_email")
		{
			if (mail($_POST["to_email"], $_POST["subject"], $_POST["message"], "" . "From: " . $_POST["from_email"], parameters) !== FALSE)
				echo "JOB_EMAIL_SENT";
		}
		else if ($_POST["button"] == "new_job")
		{
			$results = DoInsertQuery6($g_dbFindATradie, "jobs", "trade_id", $_POST["trade_id"], "description", $_POST["description"], 
										"maximum_budget", $_POST["maximum_budget"], "size", $_POST["size"], "urgent", $_POST["urgent"],
										"member_id", $_POST["member_id"]);
			if ($results)
				echo "JOB_ADDED";
		}
		else if ($_POST["button"] == "edit_job")
		{
			$results = DoUpdateQuery5($g_dbFindATradie, "jobs", "trade_id", $_POST["trade_id"], "description", $_POST["description"], 
										"maximum_budget", $_POST["maximum_budget"], "size", $_POST["size"], "urgent", $_POST["urgent"], 
										"id", $_POST["id"]);
			echo $g_strQuery;
			if ($results)
				echo "JOB_EDITED";
		}
		else if ($_POST["button"] == "accept_job")
		{
			$results = DoUpdateQuery2($g_dbFindATradie, "jobs", "accepted_by_member_id", $_POST["accepted_by_member_id"], "date_accepted", $strDateNow, "id", $_POST["id"]);
			if ($results)
				echo "JOB_ACCEPTED";
		}
		else if ($_POST["button"] == "unaccept_job")
		{
			$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "accepted_by_member_id", "0", "id", $_POST["id"]);
			if ($results)
				echo "JOB_UNACCEPTED";
		}
		else if ($_POST["button"] == "complete_job")
		{
			$results = DoUpdateQuery2($g_dbFindATradie, "jobs", "completed", "1", "date_completed", $strDateNow, "id", $_POST["id"]);
			if ($results)
				echo "JOB_COMPLETED";
		}
		else if ($_POST["button"] == "uncomplete_job")
		{
			$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "completed", "0", "id", $_POST["id"]);
			if ($results)
				echo "JOB_UNCOMPLETED";
		}
		else if ($_POST["button"] == "delete_job")
		{
			$results = DoDeleteQuery($g_dbFindATradie, "jobs", "id", $_POST["id"]);
			if ($results)
				echo "JOB_DELETED";
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