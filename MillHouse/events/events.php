<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<!-- #BeginTemplate "events_master.dwt" -->

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<?php require "../common.php"; ?>
		<!-- #BeginEditable "doctitle" -->
		<title>Events</title>
		<!-- #EndEditable -->
		
		<link href="../styles/style4PC.css" rel="stylesheet" type="text/css" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@100..900&family=Permanent+Marker&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J:ital,wght@0,100..400;1,100..400&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />

		<!-- #BeginEditable CustomStyles -->
		
		<style>
		</style>
			
		<!-- #EndEditable -->
	</head>
	<body>

		<!-- Begin Container -->
		<div id="container">
			<!-- Begin Masthead -->
			<div class="masthead">
				<div class="masthead_image" style="float:left;">
					<a href="..images/MillHouse.jpg"><img src="../images/MillHouse.jpg" alt="" height="110"/></a>
				</div>
				<div class="masthead_text">
					<h1 class="gluten">MillHouse</h1>
					<h3 class="gluten">Neighbourhood House</h3>
				</div>
				<div class="masthead_image" style="float:right;">
					<a href="..images/OldKnittingMill.jpg"><img src="../images/OldKnittingMill.jpg" alt="" height="110"/></a>
				</div>
				<div class="masthead_image" style="float:right;">
					<a href="..images/KnittingMill1961.jpg"><img src="../images/KnittingMill1961.jpg" alt="" height="110"/></a>
				</div>
			<!-- End Masthead --></div>

			<form method="post" target="_self" id="form_current_div" style="visibility:hidden;">
				<input type="hidden" name="text_current_div" id="text_current_div" value="div_groups" />
			</form>
			
			<!-- Begin Below_masthead -->
			<div class="below_masthead">
				
				<?php 
						
						function DoGenerateHyperlinks()
						{
							global $g_dbMillhouse;
							global $g_strQuery;
							$strHTML = "";
					
							if ($result = DoFindAllQuery($g_dbMillhouse, "millhouse_db.groups", "", "description", true))
							{
								if ($result->num_rows > 0)
								{
									while ($row = $result->fetch_assoc())
									{
										if ((int)$row["display"] == 1)
										{
											$strHTML .= "<li class=\"submenu_item\"><a href=\"#" . $row["name"] ."\" onclick=\"DoClickEventHyperlink('div_" . $row["name"] . "')\"><b>";
											$strHTML .= $row["description"] . "</b></a></li>\n								";
										}
									}
								}
							}
							return $strHTML;
						}
						require "../common.js";
				?>
				<script type="text/javascript">
			
					function DoClickEventHyperlink(strEventDivToShow)
					{
						document.getElementById("text_current_div").value = strEventDivToShow;
						document.getElementById("form_current_div").submit();
					}
					
				</script>			
				
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="vertical-align:top;">
							<!-- Begin Navigation -->
							<div class="navigation">
								<ul>
									<li><a href="../index.html">Home</a></li>
									<li><a href="../site_history/site_history.html">Site History</a></li>
									<li><a href="../people/people.html">Millhouse People</a></li>
									<li><a href="../Calendar/Calendar.html">Calendar</a></li>
									<li><a href="../photos/photos.html">Photos</a></li>
									<li><a href="../information/information.html">Information</a></li>
									<li><a href="../coder_dojo/CoderDojo.html">CoderDojo</a></li>
									<li>
										<a href="events.php#div_groups" onclick="DoClickEventHyperlink('div_groups')">Events</a>
										<ul>
											<?php echo DoGenerateHyperlinks(); ?>
										</ul>
									</li>
									<li><a href="../contact/Contact.php">Contact</a></li>
								</ul>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							<!-- End Navigation --></div>
						</td>
						<td style="vertical-align:top;">
							<!-- Begin Content -->
							<div class="content">
								<h1 class="page_heading gluten"><u><script type="text/javascript">document.write(document.title);</script></u></h1>
								<!-- #BeginEditable "content" --> 
								
								
					<?php
						
						//******************************************************************************
						//******************************************************************************
						//** 
						//** FORM DISPLAY/HIDE CONTROLS
						//** 
						//******************************************************************************
						//******************************************************************************						
						//unset($_SESSION["display_group_form"]);
						//unset($_SESSION["display_group_login_form"]);
						
						if (!isset($_SESSION["display_group_login_form"]))
							$_SESSION["display_group_login_form"] = "block";
						if (!isset($_SESSION["display_group_form"]))
							$_SESSION["display_group_form"] = "none";

						//******************************************************************************
						//******************************************************************************
						//** 
						//** FORM INPUT DATA PERSISTENCE
						//** 
						//******************************************************************************
						//******************************************************************************
						function ResetSessionVars($bFormDisplayVarsToo = false)
						{
							$_SESSION["group_shortkey"] = 0;
							$_SESSION["event_shortkey"] = 0;
							$_SESSION["date"] = "";
							$_SESSION["name"] = "";
							$_SESSION["description"] = "";
							$_SESSION["photo"] = "";
							$_SESSION["contact"] = "";
							$_SESSION["email"] = "";
							$_SESSION["phone"] = "";
							$_SESSION["dow1"] = 0;
							$_SESSION["dow2"] = 0;
							$_SESSION["wom"] = 0;
							$_SESSION["time1"] = "08:00";
							$_SESSION["time2"] = "22:00";
							$_SESSION["duration"] = 0;
							$_SESSION["cost"] = 0;
							$_SESSION["donation"] = false;
							$_SESSION["purpose"] = "";
							$_SESSION["facebook"] = "";
							$_SESSION["display"] = false;
							$_SESSION["password_group"] = "";
							if ($bFormDisplayVarsToo)
							{
								$_SESSION["display"] = false;
								$_SESSION["display_group_login_form"] = "none";
								$_SESSION["display_group_form"] = "block";
							}
						}
						$g_strImageWidth = 400;
						ResetSessionVars();
						
						if (!isset($_SESSION["current_div"]))
							$_SESSION["current_div"] = "div_groups";
						//$_SESSION["current_div"] = "div_groups";
						
						//******************************************************************************
						//******************************************************************************
						//** 
						//** EVENT PHOTO PROCESSING FUNCTIONS
						//** 
						//******************************************************************************
						//******************************************************************************
						
						function DoSaveNewPhoto($nShortkey)
						{
							global $g_dbMillhouse;
							$strDestPath = "";
							$strGroupName = "";
							$result = DoFindQuery1($g_dbMillhouse, "millhouse_db.events", "shortkey", $nShortkey);
					
							if ($result->num_rows > 0)
							{
								if ($row = $result->fetch_assoc())
								{
									$result = DoFindQuery1($g_dbMillhouse, "millhouse_db.groups", "shortkey", $row["group_shortkey"]);
									if ($result->num_rows > 0)
									{
										if ($row = $result->fetch_assoc())
										{
											$strGroupName = $row["name"];
											
											if (!is_dir("images/" . $strGroupName))
												mkdir("images/" . $strGroupName);
												
											$strDestPath = "images/" . $strGroupName . "/";

    										if (isset($_FILES['photo']["name"]) && (strlen($_FILES['photo']["name"]) > 0) && 
    											($_FILES['photo']['error'] === UPLOAD_ERR_OK))
    										{
    											move_uploaded_file($_FILES['photo']['tmp_name'], $strDestPath);
    										}
										}
									}
								}
							}
						}
						
						function DoDeleteOldPhoto($nShortkey)
						{
							global $g_dbMillhouse;
							$strFilename = "";
							$strGroupName = "";
							$result = DoFindQuery1($g_dbMillhouse, "millhouse_db.events", "shortkey", $nShortkey);
					
							if ($result->num_rows > 0)
							{
								if ($row = $result->fetch_assoc())
								{
									$strFilename = $row["photo"];
									$result = DoFindQuery1($g_dbMillhouse, "millhouse_db.groups", "shortkey", $row["group_shortkey"]);
									if ($result->num_rows > 0)
									{
										if ($row = $result->fetch_assoc())
										{
											$strGroupName = $row["name"];
											$strFilePath = "images/" . $strGroupName . "/" . $strFilename;
											if (file_exists($strFilePath)) 
					    						unlink($strFilePath);
					    				}
					    			}
								}
							}
						}
						
						//******************************************************************************
						//******************************************************************************
						//** 
						//** GROUP & EVENT FORM PROCESSING FUNCTIONS
						//** 
						//******************************************************************************
						//******************************************************************************
						
						function DoGetGroupShortkey($strGroupName)
						{
							global $g_dbMillhouse;
							$nGroupShortkey = 0;
					
							if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.groups", "name", $strGroupName))
							{
								if ($result->num_rows > 0)
								{
									if ($row = $result->fetch_assoc())
									{
										$nGroupShortkey = $row["shortkey"];
									}
								}
							}
							return $nGroupShortkey;
						}
						
						function DoGetGroupEmailFromEventShortkey($nEventShortkey)
						{
							global $g_dbMillhouse;
							$strEmail = "";
					
							if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.events", $nEventShortkey))
							{
								if ($result->num_rows > 0)
								{
									if ($row = $result->fetch_assoc())
									{
										if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.groups", $row["group_shortkey"]))
										{
											if ($row = $result->fetch_assoc())
											{
												$strEmail = $row["email"];
											}
										}
									}
								}
							}
							return $strEmail;
						}
						
						function DoProcessGroupForm()
						{
							global $g_dbMillhouse;
							global $g_strQuery;

							if (isset($_POST["load_group"]))
							{
								$result = DoLoadGroup($_POST["group_list"]);
							}
							else if (isset($_POST["upload_group"]))
							{
								if ($_POST["group_shortkey"] == 0)
								{
									if ($result = DoInsertQuery16($g_dbMillhouse, "millhouse_db.groups", "name", $_POST["name"], "description", $_POST["description"], "password", $_POST["password_group"], "contact", $_POST["contact"], "email", $_POST["email"], "phone", $_POST["phone"], "dow1", $_POST["dow1"], "dow2", $_POST["dow2"], "wom", $_POST["wom"], "time1", $_POST["time1"], "time2", $_POST["time2"], "hours", $_POST["duration"], "cost", $_POST["cost"], "donation", $_POST["donation"], "purpose", $_POST["purpose"], "facebook", $_POST["facebook"]))
									{
									}
								}
								else
								{
									if ($result = DoUpdateQuery16($g_dbMillhouse, "millhouse_db.groups", "name", $_POST["name"], "description", $_POST["description"], "password", $_POST["password_group"], "contact", $_POST["contact"], "email", $_POST["email"], "phone", $_POST["phone"], "dow1", $_POST["dow1"], "dow2", $_POST["dow2"], "wom", $_POST["wom"], "time1", $_POST["time1"], "time2", $_POST["time2"], "hours", $_POST["duration"], "cost", $_POST["cost"], "donation", $_POST["donation"], "purpose", $_POST["purpose"], "facebook", $_POST["facebook"], "shortkey", $_POST["group_shortkey"]))
									{
									}
								}
								ResetSessionVars();
							}
							else if (isset($_POST["delete_group"]))
							{
								if ($result = DoDeleteQuery($g_dbMillhouse, "millhouse_db.groups", "shortkey", $_POST["group_shortkey"]))
								{
									rmdir("images/" . $_POST["name"]);
								}
								ResetSessionVars();
							}
						}
					
						function DoProcessEventForm($strGroupName)
						{
							global $g_dbMillhouse;
					
							if (isset($_POST["load_event_" . $strGroupName]))
							{
								if ($result = DoFindQuery1($g_dbMillhousem, "events", "shortkey", $_POST["event_list_" . $strGroupName]))
								{
									if ($result->num_rows > 0)
									{
										if ($row = $results->fetch_assoc())
										{
											$_SESSION["shortkey_" . $strGroupName] = $row("shortkey");
											$_SESSION["date_" . $strGroupName] = $row["date"];
											$_SESSION["description_" . $strGroupName] = $row["description"];
											$_SESSION["photo_" . $strGroupName] = $row["photo"];
										}
									}
								}
							}
							else if (isset($_POST["upload_event_" . $strGroupName]))
							{
								if ($_SESSION["shortkey_" . $strGroupName] == 0)
								{
									if ($result = DoInsertQuery3($g_dbMillhousem, "millhouse_db.events", "date", $_POST["date_" . $strGroupName], "description", $_POST["description_" . $strGroupName], "photo", $_POST["photo_" . $strGroupName]))
									{
									}
								}
								else
								{
									if ($result = DoUpdateQuery3($g_dbMillhousem, "millhouse_db.ievents", "date", $_POST["date_" . $strGroupName], "description", $_POST["description_" . $strGroupName], "photo", $_POST["photo_" . $strGroupName], "shortkey", $_POST["shortkey_" . $strGroupName]))
									{
										DoDeleteOldPhoto($_POST["shortkey_" . $strGroupName]);
									}
								}
								DoSaveNewPhoto($_POST["event_shortkey"]);
								
								$_SESSION["shortkey_" . $strGroupName] = 0;
								$_SESSION["date_" . $strGroupName] = "";
								$_SESSION["description_" . $strGroupName] = "";
								$_SESSION["photo_" . $strGroupName] = "";
							}
							else if (isset($_POST["delete_event_" . $strGroupName]))
							{
								if ($result = DoDeleteQuery($g_dbMillhouse, "millhouse_db.events", "shortkey", $_POST["shortkey_" . $strGroupName]))
								{
								}
								$_SESSION["shortkey_" . $strGroupName] = 0;
								$_SESSION["date_" . $strGroupName] = "";
								$_SESSION["description_" . $strGroupName] = "";
								$_SESSION["photo_" . $strGroupName] = "";								
							}
						}

						//******************************************************************************
						//******************************************************************************
						//** 
						//** GROUP DIV FUNCTIONS
						//** 
						//******************************************************************************
						//******************************************************************************
						
						function DoGetEvents($strGroupName)
						{
							global $g_dbMillhouse;
							global $g_strImageWidth;
							$nGroupShortkey = DoGetGroupShortkey($strGroupName);
							$strHTML = "";
					
							if ($nGroupShortkey > 0)
							{
								if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.events", "group_shortkey", $nGroupShortkey, "", "date", false))
								{
									if ($result->num_rows > 0)
									{
										while ($row = $results->fetch_assoc())
										{
											$timestamp = strtotime($row["date"]);
											$strHTML .= "<h3>" . date("l, F j, Y", $timestamp) . "</h3>\n";
											$strHTML .= "<p>" . $row["description"] . "</p>\n";
											if (strlen($row["photo"]) > 0)
											{
												$strPhotoFilePath = "images/" . $strGroupName . "/" . $row["photo"];
												$strHTML .= "<a href=\"" . $strPhotoFilePath . "\" alt=\"\"><img src=\"" . $strPhotoFilePath . "\" alt=\"\" width=\"" . $g_strImageWidth . "\" /></a>\n";
											}
										}							
									}
									else
									{
										$strHTML .= "<h3>" . date("l, F j, Y") . "</h3>\n";
										$strHTML .= "<p>NO EVENTS AVAILABLE YET</p>";
										$strHTML .= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut " . 
										"labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris " . 
										"nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit " . 
										"esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt " . 
										"in culpa qui officia deserunt mollit anim id est laborum.</p>\n";
										$strHTML.= "<img src=\"../../images/underconstruction.jpg\" alt=\"\" width=\"" . $g_strImageWidth . "\" />\n";
									}
								}
							}
							return $strHTML;
						}
						
						function DoGetDayName($nDOW)
						{
							$strDayName = "";
							
							switch ($nDOW)
							{
								case 1: $strDayName = "Sunday"; break;
								case 2: $strDayName = "Monday"; break;
								case 3: $strDayName = "Tuesday"; break;
								case 4: $strDayName = "Wednesday"; break;
								case 5: $strDayName = "Thursday"; break;
								case 6: $strDayName = "Friday"; break;
								case 7: $strDayName = "Saturday"; break;
							}
							return $strDayName;
						}
												
						function DoDisplayGroupDivs($strCurrentVisibleDiv)
						{
							global $g_dbMillhouse;
							global $g_strQuery;
														
							if ($result = DoFindAllQuery($g_dbMillhouse, "millhouse_db.groups"))
							{
								if ($result->num_rows > 0)
								{
									while ($row = $result->fetch_assoc())
									{
										if (((int)$row["display"]) == 1)
										{
											// Login form display control
											if (!isset($_SESSION["display_event_login_form_" . $row["name"]]))
												$_SESSION["display_event_login_form_" . $row["name"]] = "block";
											
											// Event form display control
											if (!isset($_SESSION["display_event_form_" . $row["name"]]))
												$_SESSION["display_event_form_" . $row["name"]] = "none";
												
											// Event form data persistance
											if (!isset($_SESSION["date_" . $row["name"]]))
											{
												$_SESSION["date_" . $row["name"]] = "";
												$_SESSION["shortkey_" . $row["name"]] = "";
												$_SESSION["description_" . $row["name"]] = "";
												$_SESSION["photo_" . $row["name"]] = "none";
											}
											$strDisplay = "none";
											if (strcmp($strCurrentVisibleDiv, "div_" . $row["name"]) == 0)
												$strDisplay = "block";
											
											echo "<div id=\"div_" . $row["name"] . "\" style=\"display:" . $strDisplay . ";\">\n";
											echo "<h2>" . $row["description"] . "</h2>\n";
											
											echo "<form class=\"form\" target=\"_self\" method=\"post\" id=\"login_form_" . $row["name"] . "\" style=\"display:" . $_SESSION["display_event_login_form_" . $row["name"]] . ";\" >\n";
											echo "    <table cellpadding=\"0\" cellspacing=\"5\" border=\"0\">\n";
											echo "        <tr>\n";
											echo "            <td style=\"text-align:center;\" colspan=\"2\"><label><h3>Login to '" . $row["description"] . "' add or edit events</h3></label><br/><br/></td>\n";
											echo "        </tr>\n";
											echo "        <tr>\n";
											echo "            <td style=\"text-align: right;\"><label for=\"password_event_" . $row["name"] . "\">Password: </label></td>\n";
											echo "            <td>\n";
											echo "                <input name=\"password_event_" . $row["name"] . "\" id=\"password_event_" . $row["name"] . "\" type=\"password\" autocomplete=\"on\" placeholder=\"The group's password...\" onkeydown=\"OnKeyPressPassword(event)\" />\n";
											echo "                <br/>\n";
											echo "                <input type=\"checkbox\" id=\"toggle_password_" . $row["name"] . "\" onclick=\"OnClickTogglePassword('toggle_password_" . $row["name"] . "', 'password_event_" . $row["name"] . "')\" />\n";
											echo "                <label for=\"toggle_password_" . $row["name"] . "\">Show password</label>\n";
											echo "           </td>\n";
											echo "        </tr>\n";
											echo "        <tr>\n";
											echo "            <td colspan=\"2\" style=\"text-align:right;\">\n";
											echo "                <input type=\"submit\" name=\"forgot_password_event_" . $row["name"] . " id=\"forgot_password_event_" . $row["name"] . "\" value=\"I FORGET THE PASSWORD\" style=\"width:200px;\" />&nbsp;\n";
											echo "                <input type=\"submit\" name=\"login_event_" . $row["name"] . "\" id=\"login_event_" . $row["name"] . "\" value=\"LOGIN\"/>\n";
											echo "            </td>\n";
											echo "        </tr>\n";
											echo "    </table>\n";
											echo "</form>\n";
											
											echo "<form class=\"form\" target=\"_self\" method=\"post\" style=\"display:" . $_SESSION["display_event_form_" . $row["name"]] . ";\" id=\"event_form_" . $row["name"] . "\">\n";
											echo "	<table cellpadding=\"0\" cellspacing=\"5\" border=\"0\">\n";
											echo "		<tr>\n";
											echo "			<td style=\"text-align:center;\" colspan=\"2\"><label><h3>Add or edit events for '" . $row["description"] . "'</h3></label><br/><br/></td>\n";
											echo "		</tr>\n";
											echo "		<tr>\n";
											echo "			<td style=\"text-align: right;\"><label for=\"date_" . $row["name"] . "\">Event Date: </label></td>\n";
											echo "			<td><input name=\"date_" . $row["name"] . "\" id=\"date_" . $row["name"] . "\" type=\"date\" value=\"" . $_SESSION["date_" . $row["name"]] ."\" autocomplete=\"on\" placeholder=\"A future ot past date...\" /></td>\n";
											echo "		</tr>\n";
											echo "		<tr>\n";
											echo "			<td style=\"text-align: right;\"><label for=\"description_" . $row["name"] . "\">Event Description: </label></td>\n";
											echo "			<td><textarea name=\"description_" . $row["name"] . "\" id=\"description_" . $row["name"] . "\" cols=\"40\" rows=\"20\" autocomplete=\"on\" minlength=\"160\" maxlength=\"8192\" placeholder=\"A detailed description of the event...\">" . $_SESSION["description_" . $row["name"]] . "</textarea></td>\n";
											echo "		</tr>\n";
											echo "		<tr>\n";
											echo "			<td style=\"text-align: right;\"><label for=\"photo_" . $row["name"] . "\">Photo: </label></td>\n";
											echo "			<td><input name=\"photo_" . $row["name"] . "\" id=\"photo_" . $row["name"] . "\" type=\"file\" accept=\"image/*\" value=\"" . $_SESSION["photo_" . $row["name"]] . "\" placeholder=\"An optional photo for the event...\" onchange=\"OnChangeCheckFileSize(this.files[0].size)\" /></td>\n";
											echo "		</tr>\n";
											echo "		<tr>\n";
											echo "			<td style=\"text-align: right;\"><label for=\"event_list_" . $row["name"] . "\">Current events:</label></td>\n";
											echo "			<td>\n";
											echo "				<select id=\"event_list_" . $row["name"] . "\" name=\"event_list_" . $row["name"] . "\" autocomplete=\"on\" >\n";
											echo DoGetEventOptions($row["name"]);
											echo "				</select>\n";
											echo "				<br/><br/>\n";
											echo "				<input type=\"submit\" name=\"load_event_" . $row["name"] . "\" id=\"load_event_" . $row["name"] . "\" value=\"LOAD\"/>\n";
											echo "				&nbsp;\n";
											echo "				<input type=\"button\" name=\"reset_event_" . $row["name"] . "\" id=\"reset_event_" . $row["name"] . "\" value=\"RESET\" onclick=\"OnClickResetEventForm('" . $row["name"] . "')\" />\n";
											echo "			</td>\n";
											echo "		</tr>\n";
											echo "		<tr>\n";
											echo "			<td colspan=\"2\" style=\"text-align:right;\">\n";
											echo "				<input type=\"hidden\" id=\"shortkey_" . $row["name"] . "\" name=\"shortkey_" . $row["name"] . "\" value=\"" . $_SESSION["shortkey_" . $row["name"]] . "\" />\n";
											echo "				<input type=\"button\" name=\"upload_event_" . $row["name"] . "\" id=\"upload_event_" . $row["name"] . "\" value=\"UPLOAD\" onclick=\"DoValidateEvent('" . $row["name"] . "')\"/>\n";
											echo "				&nbsp;\n";
											echo "				<input type=\"button\" name=\"delete_event_" . $row["name"] . "\" id=\"delete_event_" . $row["name"] . "\" value=\"DELETE\" ";
											if ($_SESSION["event_shortkey"] == 0) 
												echo "disabled ";
											echo "onclick=\"OnClickDeleteEvent()\" />\n";
											echo "				&nbsp;\n";
											echo "				<input type=\"submit\" value=\"LOGOUT\" id=\"logout_event_" . $row["name"] . "\" name=\"logout_event_" . $row["name"] . "\" />\n";
											echo "			</td>\n";
											echo "		</tr>\n";
											echo "	</table>\n";
											echo "</form>\n";
											
											echo "<p><b>CONTACT PERSON: </b>" . $row["contact"] . "<br/>\n";
											echo "<b>EMAIL: </b><a href=\"maileto:" . $row["email"] . "\">" . $row["email"] . "</a><br/>\n";
										
											if (strlen($row["phone"]) > 0)
												echo "<b>PHONE: </b>" . $row["phone"] . "<br/>\n";

											$strFrequency = "NOT SET";
											if (($row["dow1"] !== NULL) && ($row["dow1"] !== 0))
											{
												$strFrequency = DoGetDayName($row["dow1"]);
												if (($row["dow2"] !== NULL) && ($row["dow2"] !== 0))
												{
													$strFrequency .= " and " . DoGetDayName($row["dow2"]);
												}
											}
											if (($row["wom"] === NULL) || ($row["wom"] == 0))
											{
												$strFrequency = "Weekly on " . $strFrequency;
											}
											else
											{
												switch ($row["wom"])
												{
													case 1: $strFrequency .= "First " . $strFrequency . " of the month"; break;
													case 2: $strFrequency .= "Second " . $strFrequency . " of the month"; break;
													case 3: $strFrequency .= "Third " . $strFrequency . " of the month"; break;
													case 4: $strFrequency .= "Fourth " . $strFrequency . " of the month"; break;
												}
											}
											echo "<b>WHEN: </b>" . $strFrequency . "<br/>\n";
											
											$strTime = "NOT SET";
											if ($row["time1"] !== NULL)
											{
												$time = new DateTime($row["time1"]);
												$strTime = $time->format("H:i");
												if ($row["time2"] !== NULL)
												{
													$time = new DateTime($row["time2"]);
													$strTime .= " and " . $time->format("H:i");
												}
											}
											echo "<b>TIME(S): </b>" . $strTime . "<br/>\n";
											
											$strHours = "NOT SET";
											if (($row["duration"] !== NULL) && ($row["duration"] != 0))
												$strHours = (string)$row["duration"] . " hours";
											echo "<b>DURATION(s): </b>" . $strHours . "<br/>\n";
											
											$strCost = "FREE";
											if (($row["cost"] !== NULL) && ($row["cost"] != 0))
											{
												$strCost = "$" . number_format($row["cost"], 2);
												if ($row["donation"] > 0)
													$strCost .= "(donation)";
											}
											echo "<b>COST: </b>" . $strCost . "<br/>\n";
											
											if (($row["facebook"] != NULL) && (strlen($row["facebook"]) > 0))
												echo "<b>SOCIAL MEDIA: </b><a href=\"" . $row["facebook"] . "\">" . $row["facebook"] . "</a><br/>\n";
											
											echo "<b><u>PURPOSE</u></b><br/>\n";
											echo "<p>" . $row["purpose"] . "</p>\n";
	
											echo DoGetEvents($row["name"]);
											echo "</div>\n";
										}
									}
								}
							}
						}
												
						//******************************************************************************
						//******************************************************************************
						//** 
						//** SELECT OPTION GENERATION FUNCTIONS
						//** 
						//******************************************************************************
						//******************************************************************************
						
						function DoGetGroupOptions()
						{
							global $g_dbMillhouse;
							global $g_strQuery;
							$strEventOptionsHTML = "";
					
							if ($result = DoFindAllQuery($g_dbMillhouse, "millhouse_db.groups"))
							{
								if ($result->num_rows > 0)
								{
									$nCount = 0;
									while ($row = $result->fetch_assoc())
									{
										if ((isset($_POST["group_list"]) && ($_POST["group_list"] == $row["shortkey"])) || ($nCount == 0))
											$strEventOptionsHTML .= "<option selected ";
										else
											$strEventOptionsHTML .= "<option ";
										$strEventOptionsHTML .= "value=\"" . $row["shortkey"] . "\">" . $row["description"] . "</option>\n";
										$nCount++;
									}
								}
								else
								{
									$strEventOptionsHTML .= "<option value=\"\" selected disabled>No groups available to edit...</option>\n";
								}
							}
							return $strEventOptionsHTML;
						}

						function DoGetEventOptions($strGroupName)
						{
							global $g_dbMillhouse;
							$strEventOptionsHTML = "";
							$nGroupShortkey = DoGetGroupShortkey($strGroupName);
							
							if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.events", "group_shortkey", $nGroupShortkey))
							{
								if ($result->num_rows > 0)
								{
									$nCount = 0;
									while ($row = $result->fetch_assoc())
									{
										$timestamp = strtotime($row["date"]);
										if ((isset($_POST["event_list"]) && ($_POST["event_list"] == $row["shortkey"])) || ($nCount == 0))
											$strEventOptionsHTML .= "<option selected ";
										else
											$strEventOptionsHTML .= "<option ";
										$strEventOptionsHTML .= "value=\"" . $row["shortkey"] . "\">" . date("l, F j, Y", $timestamp) . "</option>\n";
										$nCount++;
									}
								}
								else
								{
									$strEventOptionsHTML .= "<option value=\"\" selected disabled>No events available to edit...</option>\n";
								}
							}
							return $strEventOptionsHTML;
						}
						
						function DoLoadGroup($nShortkey)
						{
							global $g_dbMillhouse;
							global $g_strQuery;
							$result = "";

							if ($result = DoFindQuery1($g_dbMillhouse, "millhouse_db.groups", "shortkey", $nShortkey))
							{
								if ($result->num_rows > 0)
								{
									if ($row = $result->fetch_assoc())
									{
										ResetSessionVars(true);
										$_SESSION["group_shortkey"] = $nShortkey;
										$_SESSION["name"] = $row["name"];
										$_SESSION["description"] = $row["description"];
										$_SESSION["contact"] = $row["contact"];
										$_SESSION["email"] = $row["email"];
										$_SESSION["phone"] = $row["phone"];
										$_SESSION["dow1"] = $row["dow1"];
										$_SESSION["dow2"] = $row["dow2"];
										$_SESSION["wom"] = $row["wom"];
										
										$dateTime = new DateTime($row["time1"]);
										$_SESSION["time1"] = $dateTime->format("H:i:s");
										
										$dateTime = new DateTime($row["time2"]);
										$_SESSION["time2"] = $dateTime->format("H:i:s");
										
										$_SESSION["duration"] = $row["duration"];
										$_SESSION["cost"] = $row["cost"];
										$_SESSION["donation"] = $row["donation"];
										$_SESSION["purpose"] = $row["purpose"];
										$_SESSION["facebook"] = $row["facebook"];
										$_SESSION["display"] = $row["display"];
										$_SESSION["password_group"] = $row["password"];
									}
								}
							}
							return $result;
						}
						
						//******************************************************************************
						//******************************************************************************
						//** 
						//** LOGIN FUNCTIONS
						//** 
						//******************************************************************************
						//******************************************************************************

						function DoEventLogin($strGroupName)
						{
							global $g_dbMillhouse;
							$bResult = true;

							if ($result = DoFindQuery2($g_dbMillhouse, "millhouse_db.groups", "name", $strGroupName, "password", $_POST["password_event_" . $strGroupName]))
							{
								if ($result->num_rows > 0)
								{
									$_SESSION["display_event_login_form_" . $strGroupName] = "none";
									$_SESSION["display_event_form_" . $strGroupName] = "block";
									$bResult = true;
								}
							}
							return $bResult;
						}
						
					
						function DoGroupLogin()
						{
							global $g_dbMillhouse;
							$bResult = false;
					
							if ($result = DoFindQuery2($g_dbMillhouse, "millhouse_db.groups", "name", $_POST["username"], "password", $_POST["password_group_login"]))
							{
								if ($result->num_rows > 0)
								{
									$_SESSION["display_group_login_form"] = "none";
									$_SESSION["display_group_form"] = "block";
									$bResult = true;
								}
							}
							return $bResult;
						}
						
						//******************************************************************************
						//******************************************************************************
						//** 
						//** POST DATA PROCESSING
						//** 
						//******************************************************************************
						//******************************************************************************							
						
						function DoPrintJSAlertError($strError)
						{
							echo "<script type=\"text/javascript\">alert(\"" . $strError . "\");</script>";
						}
						
						function DoPrintJSAlertPasswordError($strPassword)
						{
							$strError = "The password '" . $strPassword . "' is incorrect!";
							DoPrintJSAlertError($strError);
						}
				
						if (isset($_POST["login_group"]) && !DoGroupLogin())
						{
							DoPrintJSAlertPasswordError($_POST["password_group_login"]);
						}
						else if (isset($_POST["upload_group"]) || isset($_POST["load_group"]))
						{
							DoProcessGroupForm();
						}
						else if (isset($_POST["logout_group"]))
						{
							$_SESSION["display_group_login_form"] = "block";
							$_SESSION["display_group_form"] = "none";
						}
						else if (isset($_POST["forgot_password_group"]))
						{
							$bResult = mail($g_strEmailManager . "," . $g_strEmailPresident, "", "From: Millhouse Website");	
							
							if ($bResult == FALSE)
							{
 								$ErrorInfo = error_get_last();
    							if ($ErrorInfo)
    							{
        							echo "<script type=\"text/javascript\">alert(\"An error occurred while sending the password (" . $ErrorInfo["message"] . ").\");</script>\n";
        						}
   							}
							else
							{
								echo "<script type=\"text/javascript\">alert(\"The password was sent to " . $g_strEmailManager . " and " . $g_strEmailPresident . "\");</script>\n";
;	 			 			}
						}
						else if (isset($_POST["reset_session"]))
						{
							$_SESSION["display_group_login_form"] = "block";
							$_SESSION["display_group_form"] = "none";
							foreach ($_SESSION as $strKey => $strValue)
							{
								if (strpos($strKey, "display_event_login_form") !== false)
								{
									$_SESSION[$strKey] = "block";
								}
								else if (strpos($strKey, "display_event_form") !== false)
								{
									$_SESSION[$strKey] = "none";
								}
								else if (strpos($strKey, "forgot_password") !== false)
								{
									foreach ($_POST as $strKey => $strValue)
									{
										if (strpos($strKey, "shortkey") !== false)
										{
											$strEmail = DoGetGroupEmailFromEventShortkey($_POST[$strKey]);
											$bResult = mail($strEmail, "", "From: Millhouse Website");	
									
											if ($bResult == FALSE)
											{
		 										$ErrorInfo = error_get_last();
		    									if ($ErrorInfo)
		    									{
		        									echo "<script type=\"text/javascript\">alert(\"An error occurred while sending the password (" . $ErrorInfo["message"] . ").\");</script>\n";
		        								}
		   									}
											else
											{
												echo "<script type=\"text/javascript\">alert(\"The password was sent to " . $strEmail . "\");</script>\n";
			 			 					}
										}
									}
								}
							}
						}
						else if (isset($_POST["text_current_div"]))
						{
							$_SESSION["current_div"] = $_POST["text_current_div"];
						}
						else
						{
							foreach ($_POST as $strKey => $strValue)
							{
								if (strpos($strKey, "login_event") !== false)
								{
									$strGroupName = substr($strKey, 12);
									if (!DoEventLogin($strGroupName))
									{
										DoPrintJSAlertPasswordError($_POST["password_event_" . $strGroupName]);
									}
									break;
								}
								else if (strpos($strKey, "upload_event") !== false)
								{
									$strGroupName = substr($strKey, 13);
									DoProcessEventForm($strGroupName);
									break;
								}
								else if (strpos($strKey, "load_event") !== false)
								{
									$strGroupName = substr($strKey, 11);
									DoProcessEventForm($strGroupName);
									break;
								}
								else if (strpos($strKey, "logout_event") !== false)
								{
									$strGroupName = substr($strKey, 13);
									$_SESSION["display_event_login_form_" . $strGroupName] = "block";
									$_SESSION["display_event_form_" . $strGroupName] = "none";
									break;
								}
							}
						}

					?>
					<script type="text/javascript">
					
						function OnClickTogglePassword(strTogglePasswordID, strPasswordID)
						{
							var checkboxTogglePassword = document.getElementById(strTogglePasswordID),
								textPassword = document.getElementById(strPasswordID);

							if (checkboxTogglePassword && textPassword)
							{
								if (checkboxTogglePassword.checked)
									textPassword.type = "text";
								else
									textPassword.type = "password";
							}
						}
						
						function DoValidateGroup()
						{
							var textDescription = document.getElementById("description"),
								textContact = document.getElementById("contact"),
								textEmail = document.getElementById("email"),
								textPhone = document.getElementById("phone"),
								textPassword = document.getElementById("password_group");
							
							if (textDescription && textContact && textEmail && textPhone && textPassword)
							{
								if (textDescription.reportValidity() && 
									textContact.reportValidity() && 
									textEmail.reportValidity() && 
									textPhone.reportValidity() && 
									textPassword.reportValidity())
								/*
								if (textDescription.value === "")
									alert("Group description cannot be blank!");
								else if (textContact.value === "")
									alert("Group contact cannot be blank!");
								else if (textPassword.value === "")
									alert("Group password cannot be blank!");
								else if ((textEmail.value === "") && (textPhone === ""))
									alert("Group contact email address and phone numner cannot both be blank!");
								else
								*/
								{
									document.getElementById("upload_group").type = "submit";
									document.getElementById("details_form_group").submit();
								}
								
							}
						}
						
						function OnClickResetGroupForm()
						{
							var textDescription = document.getElementById("description"),
								textName = document.getElementById("name"),
								textContact = document.getElementById("contact"),
								textEmail = document.getElementById("email"),
								textPhone = document.getElementById("phone"),
								textPassword = document.getElementById("password_group"),
								hiddenShortkey = document.getElementById("group_shortkey");
							
							if (textName && textDescription && textContact && textEmail && textPhone && textPassword && hiddenShortkey)
							{
								textName.value = "";
								textDescription.value = "";
								textContact.value = "";
								textEmail.value = "";
								textPhone.value = "";
								textPassword.value = "";
								hiddenShortkey = 0;
							}
						}
						
						function OnClickResetEventForm(strGroupName)
						{
							var dateEvent = document.getElementById("date_" + strGroupName),
								textDescription = document.getElementById("description_" + strGroupName),
								filePhoto = document.getElementById("photo_" + strGroupName);
							
							if (textDescription && textContact && textEmail && textPhone && textPassword)
							{
								dateEvent .value = "";
								textDescription .value = "";
								filePhoto .value = "";
							}
						}
						
						function DoValidateEvent(strGroupName)
						{
							var dateEvent = document.getElementById("date_" + strGroupName),
								textDescription = document.getElementById("description_" + strGroupName),
								filePhoto = document.getElementById("photo_" + strGroupName);
							
							if (dateEvent && textDescription && filePhoto)
							{
								if (dateEvent.reportValidity() && 
									textDescription.reportValidity() && 
									filePhoto.reportValidity())
								/*
								if (dateEvent.value === "")
									alert("Date cannot be blank!");
								else if (textDescription.value === "")
									alert("Event description cannot be blank!");
								else
								*/
									document.submit();
							}
						}
						
						function OnClickLoadGroup()
						{
							document.getElementById("delete_group").disabled = false;
						}
						
						function OnClickDeleteEvent()
						{
							if (confirm("Are you ABSOLUTELY sure you want to delete this event? It will be unrecoverable!"))
							{
								document.getElementById("delete_event").type = "submit";
								document.getElementById("details_form_event").submit();
							}
							else
							{
								alert("Event was not deleted!");
							}
						}
						
						function OnClickDeleteGroup()
						{
							if (confirm("Are you ABSOLUTELY sure you want to delete this group? It will be unrecoverable!"))
							{
								document.getElementById("delete_group").type = "submit";
								document.getElementById("details_form_group").submit();
							}
							else
							{
								alert("Group was not deleted!");
							}
						}
						
						function OnChangeCheckFileSize(nFileSize)
						{
							if (nFileSize > 500000)
								alert("The size (in bytes) of the photo image file must be less than 500,000 KBytes");
						}

					</script>
					<div id="div_groups" style="display:<?php if (strcmp($_SESSION["current_div"], "div_groups") == 0) echo "block"; else echo "none"; ?>;">
											
						<p>Web site administration staff can use the forms below to add new groups and edit the details 
						of existing groups. Any new groups or group name changes will automatically appear in the 
						navigation submenu and in the page contents. If new groups are added, or if existing groups 
						undergo a name change, then the navigation submenu to the left will be automatically updated.</p>
						
						<p>On their specific group pages, group leaders can similarly login and add new events or edit 
						existing events. They can set a date for a future or previous event, and edit a description for 
						the event. An event description is a requirement. Uploading a single photo of the event is 
						optional, and photos must be no larger than 500kB in size. They can replace the photo for an 
						existing event, when they edit it, if they wish. Any changes will be immediately visible.</p>

						<p>Vistors can keep track of all the ongoing events of the various groups from here. Just click 
						on the group links on the navigation submenu to the left. The group leaders' names and contact 
						details are displayed for each group.</p>
						
						<form method="post" target="_self">
							<input type="submit" name="reset_session" value="DEBUG - reset $_SESSION" style="width:200px;"/>
						</form><br/><br/>

						<form class="form" target="_self" method="post" id="login_form_group" style="display:<?php echo $_SESSION["display_group_login_form"]; ?>">
							<table cellpadding="0" cellspacing="5" border="0">
								<tr>
									<td style="text-align:center;" colspan="2"><label><h3>Login to add or edit groups</h3></label><br/><br/></td>
								</tr>
								<tr>
									<td style="text-align: right;">
									<label for="password_group_login">Password: </label></td>
									<td>
										<input name="password_group_login" id="password_group_login" type="password" required autocomplete="on" onkeydown="OnKeyPressPassword(event)" placeholder="The admin password..." />
										<br/>
										<input type="checkbox" id="toggle_password_group_login" onclick="OnClickTogglePassword('toggle_password_group_login', 'password_group_login')" />
										<label for="toggle_password_group_login">Show password</label>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:right;">
										<input type="hidden" name="username" id="username" value="admin" />
										<input type="submit" name="forgot_password_group" id="forgot_password_group" value="I FORGET THE PASSWORD" style="width:200px;"/>&nbsp;
										<input type="submit" name="login_group" id="login_group" value="LOGIN"/>
									</td>
								</tr>
							</table>
						</form>					
						<form class="form" target="_self" method="post" style="display:<?php echo $_SESSION["display_group_form"]; ?>;" id="details_form_group">
							<table cellpadding="0" cellspacing="5" border="0">
								<tr>
									<td style="text-align:center;" colspan="2"><label><h3>Add a group or edit group details</h3></label><br/><br/></td>
								</tr>
								<tr>
									<td colspan="2">Please note if you hit a key and nothing happens then it is because certain 
									keys have been disabled in order to ensure valid text input. For example, in the 
									'Group Name' field you cannot type a space character - you must use the underscore 
									character (_) in place of a space character.</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="text-align: right;"><label for="name">Group Name (short): </label></td>
									<td><input name="name" id="name" type="text" autocomplete="on" value="<?php echo $_SESSION["name"]; ?>" minlength="5" maxlength="30" placeholder="A short name for internal use (_ instead of space)..." onkeydown="OnKeyPressUsername(event)" /></td>
								</tr>
								<tr>
									<td style="text-align: right;"><label for="description">Group Description (for display): </label></td>
									<td><input name="description" id="description" type="text" autocomplete="on" minlength="5" maxlength="30" value="<?php echo $_SESSION["description"]; ?>" placeholder="Display name for the group..." /></td>
								</tr>
								<tr>
									<td style="text-align: right;"><label for="contact">Group leader: </label></td>
									<td><input name="contact" id="contact" type="text" autocomplete="on" value="<?php echo $_SESSION["contact"]; ?>" placeholder="Group leader's name..."onkeydown="OnKeyPressName(event)"/></td>
								</tr>
								<tr>
									<td style="text-align: right;vertical-align:top;">
										<label for="email">Group leader's email address: </label><br/>
									</td>
									<td>
										<input name="email" id="email" type="text" autocomplete="on" value="<?php echo $_SESSION["email"]; ?>" placeholder="Email address..." onkeydown="OnKeyPressEmailAddress(event) "/><br/>
										<label>Also used for password recovery...</label>
									</td>
								</tr>
								<tr>
									<td style="text-align: right;"><label for="phone">Group Phone: </label></td>
									<td><input name="phone" id="phone" type="text" autocomplete="on" value="<?php echo $_SESSION["phone"]; ?>" placeholder="Phone or mobile number..." minlength="8" maxlength="10" onkeydown="OnKeyPressPhone(event)" /></td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="password_group">Group Password: </label></td>
									<td>
										<input name="password_group" id="password_group" type="password_group" autocomplete="on" value="<?php echo $_SESSION["password_group"]; ?>" minlength="8" maxlength="30" placeholder="The group's password..." onkeydown="OnKeyDownPassword(event)" />
										<br/>
										<input type="checkbox" id="toggle_password_group" onclick="OnClickTogglePassword('toggle_password_group', 'password_group')" />
										<label for="toggle_password_group">Show password</label>
									</td>
								</tr>
								<tr><td colspan="2"><h4>Meeting day(s) of week &amp; frequency</h4></td></tr>
								<tr>
									<td style="text-align: right;">
										<label for="dow1">Day</label><br/><br/>
										<label for="dow2">Additional day (optional)</label>										
									</td>
									<td>
										<select id="dow1" name="dow1" autocomplete="on">
											<option <?php if ($_SESSION["dow1"] == 1) echo "selected"; ?> value="1">Sunday</option>
											<option <?php if (($_SESSION["dow1"] == 2) || ($_SESSION["dow1"] == NULL) || ($_SESSION["dow1"] == 0)) echo "selected"; ?> value="2">Monday</option>
											<option <?php if ($_SESSION["dow1"] == 3) echo "selected"; ?> value="3">Tuesday</option>
											<option <?php if ($_SESSION["dow1"] == 4) echo "selected"; ?> value="4">Wednesday</option>
											<option <?php if ($_SESSION["dow1"] == 5) echo "selected"; ?> value="5">Thursday</option>
											<option <?php if ($_SESSION["dow1"] == 6) echo "selected"; ?> value="6">Friday</option>
											<option <?php if ($_SESSION["dow1"] == 7) echo "selected"; ?> value="7">Saturday</option>
										</select><br/><br/>
										<select id="dow2" name="dow2" autocomplete="on">
											<option value="0">Not set</option>
											<option <?php if ($_SESSION["dow1"] == 1) echo "selected"; ?> value="1">Sunday</option>
											<option <?php if ($_SESSION["dow1"] == 2) echo "selected"; ?> value="2">Monday</option>
											<option <?php if ($_SESSION["dow1"] == 3) echo "selected"; ?> value="3">Tuesday</option>
											<option <?php if ($_SESSION["dow1"] == 4) echo "selected"; ?> value="4">Wednesday</option>
											<option <?php if ($_SESSION["dow1"] == 5) echo "selected"; ?> value="5">Thursday</option>
											<option <?php if ($_SESSION["dow1"] == 6) echo "selected"; ?> value="6">Friday</option>
											<option <?php if ($_SESSION["dow1"] == 7) echo "selected"; ?> value="7">Saturday</option>
										</select>
									</td>
								</tr>									
								<tr>
									<td style="text-align: right;">
										<label for="wom">Week of month</label>										
									</td>
									<td>
										<select id="wom" name="wom" autocomplete="on">
											<option <?php if ($_SESSION["wom"] == 1) echo "selected"; ?> value="1">First</option>
											<option <?php if ($_SESSION["wom"] == 2) echo "selected"; ?> value="2">Second</option>
											<option <?php if ($_SESSION["wom"] == 3) echo "selected"; ?> value="3">Third</option>
											<option <?php if ($_SESSION["wom"] == 4) echo "selected"; ?> value="4">Fourth</option>
										</select><br/><br/>
									</td>									
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="time1">Time</label><br/><label>08:00am to 10:00pm</label><br/><br/>
										<label for="time2">Additional time (optional)</label><br/><label>08:00am to 10:00pm</label>
									</td>
									<td>
										<input type="time" id="time1" name="time1" autocomplete="on" min="08:00" max="22:00" value="<?php echo $_SESSION["time1"]; ?>" /><br/><br/>
										<input type="time" id="time2" name="time2" autocomplete="on" min="08:00" max="22:00" value="<?php echo $_SESSION["time2"]; ?>" />
									</td>
								</tr>									
								<tr>
									<td style="text-align: right;">
										<label for="duration">Duration</label><br/>
										
									</td>
									<td>
										<input type="number" id="duration" name="duration" autocomplete="on" min="0" max="8" value="<?php echo $_SESSION["duration"]; ?>" />&nbsp;<label>hrs</label>
									</td>
								</tr>									
								<tr>
									<td style="text-align: right;">
										<label for="cost">Cost $</label><br/>
										
									</td>
									<td>
										<input type="number" id="cost" name="cost" autocomplete="on" min="0" value="<?php echo $_SESSION["cost"]; ?>" />
									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="cost">Is a donation:</label><br/>
										
									</td>
									<td>
										<input type="checkbox" id="donation" name="donation" autocomplete="on" <?php if ($_SESSION["donation"]) echo "checked"; ?> />
									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="cost">The group's purpose:</label><br/>
									</td>
									<td>
										<textarea name="purpose" id="purpose" cols="40" rows="10" autocomplete="on" minlength="128" maxlength="256" placeholder="A description of group's purpose and what it offers participants..."><?php echo $_SESSION["purpose"]; ?></textarea>
									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="facebook">Social Media:</label><br/>
									</td>
									<td>
										<input type="text" name="facebook" id="facebook" value="<?php echo $_SESSION["facebook"]; ?>" autocomplete="on" maxlength="256" placeholder="URL of any Facebook group..." />
									</td>
								</tr>
								<tr>
									<td style="text-align: right;">
										<label for="cost">Display this group as a link?</label><br/>
									</td>
									<td>
										<input type="checkbox" id="display" name="display" autocomplete="on" <?php if ($_SESSION["display"] == 1) echo "checked"; ?> />
									</td>
								</tr>
								<tr>
									<td colspan="2"><h4>Load the details of a group for editing</h4></td>
								</tr>								
								<tr>
									<td style="text-align: right;"><label for="group_list">Current groups:</label></td>
									<td>
										<select id="group_list" name="group_list" autocomplete="on">
										<?php echo DoGetGroupOptions(); ?>
										</select>
										<br/><br/>
										<input type="submit" name="load_group" id="load_group" value="LOAD" onclick="OnClickLoadGroup()" />
										&nbsp;
										<input type="button" value="RESET" onclick="OnClickResetGroupForm()" />
									</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:right;">
										<input type="hidden" id="group_shortkey" name="group_shortkey" value="<?php echo $_SESSION["group_shortkey"]; ?>" />
										<input type="button" name="upload_group" id="upload_group" value="SAVE" onclick="DoValidateGroup()" />
										&nbsp;
										<input type="button" name="delete_group" id="delete_group" value="DELETE" <?php if ($_SESSION["group_shortkey"] == 0) echo "disabled"; ?> onclick="OnClickDeleteGroup()" />
										&nbsp;
										<input type="submit" value="LOGOUT" id="logout_group" name="logout_group" />
									</td>
								</tr>
							</table>
						</form>	
					</div>
					<?php 
						DoDisplayGroupDivs($_SESSION["current_div"]);
					?>					
					

				
								<!-- #EndEditable "content" -->
							<!-- End Content --></div>
					</td>
				</tr>
			</table>
			<!-- End Below_masthead--></div>
			<!-- Begin Footer -->
			<div class="footer" >
				<div class="footer_navigation">
					<a href="../index.html">Home</a> | 
					<a href="../site_history/site_history.html">Site History</a> | 
					<a href="../Calendar/Calendar.html">Calendar</a> | 
					<a href="../photos/photos.html">Photos</a> |
					<a href="../information/information.html">Information</a> |
					<a href="events.php">Events</a> |
					<a href="../coder_dojo/CoderDojo.html">CoderDojo</a> | 
					<a href="../contact/Contact.php">Contact</a>
				</div>
				<div class="footer_attribution">
					<b>Web site by: </b> Gregary Boyles 2025<br/>
					<b>Email: </b><script type="text/javascript">document.write("gregplants" + "@" + "bigpond" + "." + "com");</script>
				</div>
			<!-- End Footer --></div>
		<!-- End Container --></div>
		
	</body>

<!-- #EndTemplate -->

</html>
