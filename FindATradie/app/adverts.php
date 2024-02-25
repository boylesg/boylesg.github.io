<?php

	$g_bIsApp = true;
	require_once "../common.php";



	
	function DoGetLogoImageFilename($strMemberID)
	{
		global $g_dbFindATradie;
		$strFilename = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "members", "id", $strMemberID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strFilename = $row["logo_filename"];
				if (strlen($strFilename) == 0)
				{
					$strFilename = $row["business_name"] . ".jpg";
					$results = DoUpdateQuery1($g_dbFindATradie, "members", "logo_filename", $strFilename);
					if ($results)
						echo "OK";
					else
						echo "Could not update 'logo_filename' column for member with ID '" . $strMemberID, "'!";
				}
				else
					echo "OK";
			}
			else
				echo "Failed to fetch row for member with ID '" . $strMemberID, "'!";
		}
		else
		{
			echo "Member with ID '" . $strMemberID . "' was not found!";
		}
		return $strFilename;
	}




	if (isset($_POST["button"]))
	{
		$arrayList = [];
		
		if ($_POST["button"] == "get_adverts")
		{
			$results = DoFindQuery1($g_dbFindATradie, "adverts", "member_id", $_POST["member_id"]);
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					//if (!$_POST["all_or_selected"] || 
					//	($_POST["all_or_selected"] && !$_POST["web_or_app"] && (DoGetWebOrApp($row["space_id"]) == "web")) || 
					//	($_POST["all_or_selected"] && $_POST["web_or_app"] && (DoGetWebOrApp($row["space_id"]) == "app")))
					{
						$dateNow = new DateTime();
						$dateExpiry = new DateTime($row["expiry_date"]);
						//if (!$_POST["all_or_status"] ||
						//	($_POST["all_or_status"] && !$_POST["active_or_expired"] && ($dateExpiry > $dateNow)) ||
						//	($_POST["all_or_status"] && $_POST["active_or_expired"] && ($dateExpiry <= $dateNow)))
						{
							$dateAdded = new DateTime($row["date_added"]);
							$dateStart = new DateTime($_POST["start_date"]);
							$dateEnd = new DateTime($_POST["end_date"]);

							//if (($dateAdded >= $dateStart) && ($dateAdded <= $dateEnd))
							{
								//if (($_POST["space_id"] == $row["space_id"]) || empty($_POST["space_id"]))
								{
									$objectAdvertSpace = (object)[];
									$objectAdvertSpace->id = $row["id"];
									$objectAdvertSpace->member_id = $row["member_id"];
									$objectAdvertSpace->space_id = $row["space_id"];
									$objectAdvertSpace->text = $row["text"];
									$objectAdvertSpace->image_name = $row["image_name"];
									$objectAdvertSpace->clicks = $row["clicks"];
									$objectAdvertSpace->space_name = DoGetAdvertSpaceName($row["space_id"]);
									
									$dateExpiry = new DateTime($row["expiry_date"]);
									$objectAdvertSpace->expiry_date = $dateExpiry->format("d/m/Y");
									$dateNow = new DateTime();
									$interval = $dateExpiry->diff($dateNow);
									$objectAdvertSpace->number_months =  ($interval->y * 12) + $interval->m;
									$objectAdvertSpace->cost_per_month = DoGetCostPerMonth($row["space_id"]);
									$objectAdvertSpace->total_cost = (int)$objectAdvertSpace->cost_per_month * (int)$objectAdvertSpace->number_months;
									
									$dateAdded = new DateTime($row["date_added"]);
									$objectAdvertSpace->date_added = $dateAdded->format("d/m/Y");
									$objectAdvertSpace->expired = $dateNow > $dateExpiry;
									$arrayList[] = $objectAdvertSpace;
								}
							}
						}
					}
				}
			}
			echo "OKA" . json_encode($arrayList);
			/*
			echo "all_or_selected = " . $_POST["all_or_selected"] . "\n\nweb_or_app = " . $_POST["web_or_app"] . 
					"\n\nall_or_status = " . $_POST["all_or_status"] . "\n\nactive_or_expired = " . $_POST["active_or_expired"] . 
					"\n\nspace_id = " . $_POST["space_id"] . "\n\nstart_date = " . $_POST["start_date"] . 
					"\n\nend_date = " . $_POST["end_date"];
			*/
		}
		else if ($_POST["button"] == "get_advert_spaces")
		{
			$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					$objectAdvertSpace = (object)[];
					$objectAdvertSpace->space_code = $row["space_code"];
					$objectAdvertSpace->space_description = $row["space_description"];
					$objectAdvertSpace->cost_per_month = $row["cost_per_month"];
					$objectAdvertSpace->app_or_web = $row["app_or_web"];
					$arrayList[] = $objectAdvertSpace;
				}
			}
			echo "OKS" . json_encode($arrayList);
		}
		else if ($_POST["button"] == "edit_advert")
		{
			$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "text", $_POST["text"], "id", $_POST["advert_id"]);
			if ($results)
				echo "OKEThe changes to your advert were saved successfully!";
			
			if (isset($_POST["logo_filename"]))
			{
				 DoSetConfigLogoImage($_POST["advert_id"], $_POST["member_id"]);
			}
		}
		else if ($_POST["button"] == "add_advert")
		{
			$results = DoInsertQuery3($g_dbFindATradie, "adverts", "member_id", $_POST["member_id"], "space_id", $_POST["space_id"], "text", $_POST["text"]);
			if ($results)
			{
				$results = DoGetLastInserted("adverts", "member_id", $_POST["member_id"]);
				if ($results && ($results->num_rows > 0))
				{
					if ($row = $results->fetch_assoc())
					{
						echo "OKN" . $row["id"] . "," .  $row["space_id"];
						if (isset($_POST["logo_filename"]))
						{
							 DoSetConfigLogoImage($_POST["advert_id"], $_POST["member_id"]);
						}
					}
				}
			}
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	else if (!empty($_POST))
	{
		$strAdvertID = "";
		$strMemberID = "";
		
		if (IsLogoImageUpload($strAdvertID))
		{
			if (strlen($strMemberID) > 0)
			{
				$strLogoFilename = DoGetLogoImageFilename($strMemberID);
				$results = DoUpdateQuery1($g_dbFindATradie, "members", "logo_filename", $strLogoFilename);
				if ($results)
				{
					$data = file_get_contents('php://input');
					$nBytes = file_put_contents($strLogoFilename, $data);
					
					if ($nBytes > 0)
						echo "OK";
					else
						echo "File '" . $strLogoFilename . "' could not be saved!";
				}
				else
				{
					echo "Could not update 'logo_filename' column for member '" . $strMemberID . "'!";
				}
			}
			else
			{
				echo "LOGO image file name member ID is blank!";
			}
		}	
	}
	
?>
