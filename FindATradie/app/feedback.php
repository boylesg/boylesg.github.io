<?php

	include "../common.php";
	
	
	
	
	function DoFeedbackStuff($results, $bFeedbackReceived)
	{
		if ($results && ($results->num_rows > 0))
		{
			$arrayFeedback = [];
			
			while ($row = $results->fetch_assoc())
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
			}
		}
	}
	
	
	
	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "feedback_received")
		{
			$results = DoFindQuery1($g_dbFindATradie, "feedback", "recipient_id", $_POST["id"]);
			DoFeedbackStuff($results, true);
		}
		else if ($_POST["button"] == "feedback_given")
		{
			$results = DoFindQuery1($g_dbFindATradie, "feedback", "provider_id", $_POST["id"]);
			DoFeedbackStuff($results, false);
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
				echo "EMAIL_SENT";
			}
		}
		else if ($_POST["button"] == "edit_feedback")
		{
			$results = DoUpdateQuery2($g_dbFindATradie, "feedback", "description", $_POST["description"], "positive", $_POST["feedback"], "id", $_POST["id"]);
			if ($results)
				echo "EMAIL SENT";
			else
				echo "Email could not be sent!";
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