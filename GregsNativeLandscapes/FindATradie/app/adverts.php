<?php

	$g_bIsApp = true;
	require_once "../common.php";



	
	function DoGetAdvertSpaceName($strSpaceID)
	{
		global $g_dbFindATradie;
		$strSpaceName = "";
		
		$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "id", $strSpaceID);
		if ($results && ($results->num_rows > 0))
		{
			if ($row = $results->fetch_assoc())
			{
				$strSpaceName = $row["space_description"];
			}
		}
		return $strSpaceName;
	}




	if (isset($_POST["button"]))
	{
		if ($_POST["button"] == "get_advert_list")
		{
			$arrayList = [];
			
			$results = DoFindQuery1($g_dbFindATradie, "adverts", "member_id", $_POST["member_id"]);
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					if (($_POST["all_or_selected"] == "false") || 
						(($_POST["all_or_selected"] == "true") && ($_POST["web_or_app"] == DoGetWebOrApp($row["space_id"])))) 
					{
						$dateNow = new DateTime();
						$dateExpiry = new DateTime($row["expiry_date"]);
						$dateAdded = new DateTime($row["date_added"]);
						$dateStart = new DateTime($_POST["start_date"]);
						$dateEnd = new DateTime($_POST["end_date"]);


						if (($_POST["all_or_status"] == "false") ||
							(($_POST["all_or_status"] == "true") && ($_POST["active_or_expired"] == "false") && ($dateExpiry > $dateNow)) ||
							(($_POST["all_or_status"] == "true") && ($_POST["active_or_expired"] == "true") && ($dateExpiry <= $dateNow)))
						{
							if ((($dateAdded >= $dateStart) && ($dateAdded <= $dateEnd)) || ($dateStart == $dateEnd))
							{
								if (($_POST["space_id"] == $row["space_id"]) || empty($_POST["space_id"]))
								{
									$objectAdvertSpace = (object)[];
			
									$objectAdvertSpace->id = $row["id"];
									$objectAdvertSpace->member_id = $row["member_id"];
									$objectAdvertSpace->space_id = $row["space_id"];
									$objectAdvertSpace->text = $row["text"];
									$objectAdvertSpace->clicks = $row["clicks"];
									$objectAdvertSpace->space_name = DoGetAdvertSpaceName($row["space_id"]);
									
									$objectAdvertSpace->expiry_date = $dateExpiry->format("d/m/Y");
									$objectAdvertSpace->date_added = $dateAdded->format("d/m/Y");

									$interval = $dateExpiry->diff($dateNow);
									$objectAdvertSpace->number_months =  ($interval->y * 12) + $interval->m + 1;
									$objectAdvertSpace->cost_per_year = DoGetCostPerYear($row["space_id"]);
									$objectAdvertSpace->cost = (intval($objectAdvertSpace->number_months) / 12) * intval($objectAdvertSpace->cost_per_year);
									
									$objectAdvertSpace->expired = "";
									if ($dateNow > $dateExpiry)
										$objectAdvertSpace->expired = "1";
									else
										$objectAdvertSpace->expired = "0";
									$arrayList[] = $objectAdvertSpace;
								}
							}
						}
					}
				}
			}
			echo "OKA" . json_encode($arrayList);
		}
		else if ($_POST["button"] == "get_advert_spaces")
		{
			$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");
			$arrayList = [];
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					if ((($_POST["which"] == "app") && str_contains($row["space_code"], "app")) ||
						(($_POST["which"] == "web") && !str_contains($row["space_code"], "app")))
					{
						$objectAdvertSpace = (object)[];
						$objectAdvertSpace->space_id = $row["id"];
						$objectAdvertSpace->space_code = $row["space_code"];
						$objectAdvertSpace->space_description = $row["space_description"];
						$objectAdvertSpace->cost_per_year = $row["cost_per_year"];
						$objectAdvertSpace->app_or_web = $row["app_or_web"];
						$arrayList[] = $objectAdvertSpace;
					}
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
				 $_SESSION["member_id"] = $_POST["member_id"];
			}
		}
		else if ($_POST["button"] == "add_advert")
		{
			$bActiveAdvert = false;
			$dateNow = new DateTime();
			$results = DoFindQuery1($g_dbFindATradie, "adverts", "space_id", $_POST["space_id"]);
			if ($results && ($results->num_rows > 0))
			{
				while ($row = $results->fetch_assoc())
				{
					$dateExpiry = new DateTime($row["expiry_date"]);
					if ($dateExpiry > $dateNow)
					{
						echo "This advert space already has an active advert that expires on " . $dateExpiry->format("d/m/Y");
						$bActiveAdvert = true;
						break;
					}
				}
			}
			if (!$bActiveAdvert)
			{
				$results = DoInsertQuery4($g_dbFindATradie, "adverts", "member_id", $_POST["member_id"], "space_id", $_POST["space_id"], "expiry_date", $dateNow->format("Y-m-d"), "text", EscapeSingleQuote($_POST["text"]));
				if ($results)
				{
					$results = DoFindQuery1($g_dbFindATradie, "adverts", "member_id", $_POST["member_id"], "", "id", false);
					if ($results && ($results->num_rows > 0))
					{
						if ($row = $results->fetch_assoc())
						{
							if (isset($_POST["logo_filename"]))
							{
								 DoSetConfigLogoImage($row["id"], $row["member_id"]);
							}
							echo "OKN" . $row["id"] . "," . DoGetCostPerYear($row["space_id"]);
						}
					}
				}
			}		
		}
		else if ($_POST["button"] == "activate_advert")
		{
			$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_POST["advert_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$dateExpiry = new DateTime();
					$dateExpiry->modify("+12 month");
					$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "expiry_date", $dateExpiry->format("Y-m-d"), "id", $_POST["advert_id"]);
					if ($results)
						echo "advert_activated=true";
				}
			}
		}
		else if ($_POST["button"] == "delete_advert")
		{
			$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_POST["advert_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$results = DoDeleteQuery1($g_dbFindATradie, "adverts", "id", $_POST["advert_id"]);
					if ($results)
						echo "advert_activated=false";
				}
			}
		}
		else if (ProcessAdvertFunction())
		{
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	
?>
