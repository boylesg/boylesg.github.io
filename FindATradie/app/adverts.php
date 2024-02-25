<?php

	$g_bIsApp = true;
	require_once "../common.php";

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
					if (!$_POST["all_or_selected"] || 
						($_POST["all_or_selected"] && !$_POST["web_or_app"] && (DoGetWebOrApp($row["space_id"]) == "web")) || 
						($_POST["all_or_selected"] && $_POST["web_or_app"] && (DoGetWebOrApp($row["space_id"]) == "app")))
					{
						$dateNow = new DateTime();
						$dateExpiry = new DateTime($row["expiry_date"]);
						if (!$_POST["all_or_status"] ||
							($_POST["all_or_status"] && !$_POST["active_or_expired"] && ($dateExpiry > $dateNow)) ||
							($_POST["all_or_status"] && $_POST["active_or_expired"] && ($dateExpiry <= $dateNow)))
						{
							$dateAdded = new DateTime($row["date_added"]);
							$dateStart = new DateTime($_POST["start_date"]);
							$dateEnd = new DateTime($_POST["end_date"]);

							if (($dateAdded >= $dateStart) && ($dateAdded <= $dateEnd))
							{
								if (($_POST["space_id"] == $row["space_id"]) || empty($_POST["space_id"]))
								{
									$objectAdvertSpace = (object)[];
									$objectAdvertSpace->id = $row["id"];
									$objectAdvertSpace->member_id = $row["member_id"];
									$objectAdvertSpace->space_id = $row["space_id"];
									$objectAdvertSpace->text = $row["text"];
									$objectAdvertSpace->image_name = $row["image_name"];
									$objectAdvertSpace->expiry_date = $row["expiry_date"];
									$objectAdvertSpace->date_added = $row["date_added"];
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
		}
		else if ($_POST["button"] == "new_advert")
		{
		}
		else
		{
			echo "Unexpected button name '" . $_POST["button"] . "'!";
		}
	}
	
?>
