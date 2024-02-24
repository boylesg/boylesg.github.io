<?php

	$g_bIsApp = true;
	require_once "../common.php";
	
	
	
	$g_nAll = 0;
	$g_nPositive = 1;
	$g_nNegative = 2;
	
	function DoFeedbackStuff($results, $bFeedbackReceived, $strStartDate = "", $strEndDate = "", $nType = 0)
	{
		global $g_nAll;
		global $g_nPositive;
		global $g_nNegative;
		$arrayFeedback = [];
		
		if ($results && ($results->num_rows > 0))
		{
			$dateStart = new DateTime("2023-1-1");
			$dateEnd = new DateTime("2100-1-1");
			if (strlen($strStartDate) > 0)
				$dateStart = new DateTime($strStartDate);
			if (strlen($strEndDate) > 0)
				$dateEnd = new DateTime($strEndDate);
						
			while ($row = $results->fetch_assoc())
			{
				$dateRow = new DateTime($row["date_added"]);
				
				if (($dateRow >= $dateStart) && ($dateRow <= $dateEnd))
				{
					if (($nType = $g_nAll) || (($nType = $g_nPositive) && ($row["positive"] == "1")) || 
						(($nType = $g_nNegative) && ($row["positive"] == "0")))
					{
						$objectFeedback = (object)[];
						
						$objectFeedback->recipient_id = $row["recipient_id"];
						$objectFeedback->provider_id = $row["provider_id"];
						
						if ($bFeedbackReceived)
						{
							if (strlen($row["provider_id"]) > 0)
								$objectFeedback->name = DoGetMemberFullName($row["provider_id"]);
							else
								$objectFeedback->name = $row["name"];
						}
						else
						{
							$objectFeedback->name = DoGetMemberFullName($row["recipient_id"]);
						}
							
						$objectFeedback->positive = $row["positive"];
						$objectFeedback->description = $row["description"];
						$objectFeedback->date_added = $row["date_added"];
						$objectFeedback->date_modified = $row["date_modified"];
						$objectFeedback->email_recipient = "";
						$objectFeedback->email_provider = "";
						$objectFeedback->mobile_provider = "";
						if ($bFeedbackReceived)
						{
							$strPhone = "";
							$strMobile = "";
							DoGetMemberContactDetails($row["provider_id"], $strPhone, $objectFeedback->mobile_provider, $objectFeedback->email_provider);
							DoGetMemberContactDetails($row["recipient_id"], $strPhone, $strMobile, $objectFeedback->email_recipient);
						}
						$arrayFeedback[] = $objectFeedback;
					}
				}
			}
		}
		echo "OKL" . json_encode($arrayFeedback);
	}
	
	
	
	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "feedback_received")
		{
			$results = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $_POST["member_id"]);
			DoFeedbackStuff($results, true);
		}
		else if ($_POST["button"] == "feedback_given")
		{
			$results = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $_POST["member_id"]);
			DoFeedbackStuff($results, false);
		}
		else if ($_POST["button"] == "search_given")
		{
			$nTypeFeedBack = 0;
			
			if ($_POST["all_selected"])
				$nTypeFeedBack = $g_nAll;
			else if ($_POST["pos_neg"])
				$nTypeFeedBack = $g_nPositive;
			else
				$nTypeFeedBack = $g_nNegative;
						
			$results = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $_POST["member_id"], $_POST["start_date"], $_POST["end_date"], $nTypeFeedBack);
			DoFeedbackStuff($results, false);
		}
		else if ($_POST["button"] == "search_received")
		{
			$nTypeFeedBack = 0;
			
			if ($_POST["all_selected"])
				$nTypeFeedBack = $g_nAll;
			else if ($_POST["pos_neg"])
				$nTypeFeedBack = $g_nPositive;
			else
				$nTypeFeedBack = $g_nNegative;

			$results = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $_POST["member_id"], $_POST["start_date"], $_POST["end_date"], $nTypeFeedBack);
			DoFeedbackStuff($results, true);
		}
		else if ($_POST["button"] == "send_email")
		{
			$dateAdded = new DateTime($_POST["date_added"]);
			
			if (!mail($_POST["email_provider"], "RE: negative feedback you left on Find a Tradie...", 
						"RECIPIENT NAME: " . $_POST["recipient_name"] . "\r\n" . 
						"DATE: " . $dateAdded->format("d/m/Y") . "\r\n" .
						"JOB DESCIPTION:\r\n-----------------\r\n" . $_POST["description"] . "\r\n" . 
						"MESSAGE:\r\n---------\r\n" . $_POST["message"] . "\r\n", 
						"From: <" . $_POST["email_recipient"] . ">"))
			{
				echo "Email could not be sent!";
			}
			else
			{
				echo "OKEEMAILEmail was sent successfully!";
			}
		}
		else if ($_POST["button"] == "edit_feedback")
		{
			$results = DoUpdateQuery2($g_dbFindATradie, "feedback", "description", $_POST["description"], "positive", $_POST["feedback"], "id", $_POST["id"]);
			if ($results)
				echo "OKUFeedback was updated successfully!";
			else
				echo "Feedback could not be updated!";
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