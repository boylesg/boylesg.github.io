<?php

	include "../common.php";
	
	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "spinner_lists")
		{
			"trades_list";
			"structure_list";
			"job_size_list";
			$results = DoFindAllQuery($g_dbFindATradie, "trades");
			if ($results->num_rows > 0)
			{
				$objectLists = (object)[];
				$arrayList = [];
				
				while ($row = $results->fetch_assoc())
				{
					$objectListItem = (object)[];
					$objectListItem->id = $row["id"];
					$objectListItem->name = $row["name"];
					$objectListItem->description = $row["description"];
					$arrayList[] = $objectListItem;
				}
				$objectLists->trades_list = $arrayList;
				
				$arrayList = [];
				$arrayList[] = "Sole trader";
				$arrayList[] = "Company";
				$arrayList[] = "Cooperative";
				$arrayList[] = "Partnership";
				$arrayList[] = "Indigenous corporation";
				$objectLists->structure_list = $arrayList;
				
				$arrayList = [];
				$arrayList[] = "Up to 50";
				$arrayList[] = "50 - 100";
				$arrayList[] = "100 - 250";
				$arrayList[] = "250 - 500";
				$arrayList[] = "More than 500";
				$objectLists->job_size_list = $arrayList;
				
				$objectLists->customer_trade_id = DoGetCustomerTradeID();
				
				echo "OK" . json_encode($objectLists);
			}
			else if ($_POST["button"] == "email_admin")
			{
				if (!mail($g_strAdminEmail, "From member of Find a Tradie...", 
							"NAME: " . $_POST["member_name"] . "\r\n" . 
							"ID: " . $_POST["member_id"] . "\r\n" . 
							"ABOUT: " . $_POST["about"] . "\r\n" . 
							"SUBJECT: " . $_POST["subject"] . "\r\n" .
							"MESSAGE:\r\n--------\r\n" . $_POST["message"] . "\r\n", 
							"From: <" . $_POST["email"] . ">"))
				{
					echo "Email could not be sent!";
				}
				else
				{
					echo "EMAIL_SENT";
				}
			}
		}
	}

?>