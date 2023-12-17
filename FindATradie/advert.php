<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php include "common.php"; ?>
	
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Create an advertisement</title>
		<!-- #EndEditable -->
		<?php include "common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
		
			<style>
</style>
						
			<?php

				function DoGetAdvertSpaceDetails($strSpaceCode)
				{
					global $g_dbFindATradie;
					$nCost = 0;
					$strID = "";
					$strCode = "";
					$strDesc = "";
			
					if ($strSpaceCode != "")
					{
						$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "space_code", $strSpaceCode);
						if ($results->num_rows > 0)
						{							
							$row = $results->fetch_assoc();
							$nCost = (int)$row["cost_per_month"];
							$strID = $row["id"];
							$strCode = $row["space_code"];
							$strDesc = $row["space_description"];
						}
					}
					return [$strID, $strCode, $strDesc, $nCost];
				}
				
				function DoCleanupAdvert($dbConnection, $strImageFilename, $dateExpiry)
				{
					global $g_dbFindATradie;
					
					if (file_exists($strImageFilename))
					{
						echo unlink($strFilePath);
					}
					if (isset($_SESSION["space_code"]))
					{
						$results = DoFindQuery3($g_dbFindATradie, "adverts", "id", $_SESSION["account_id"], "space_id", (int)$_SESSION["space_id"], "expiry_date", $dateExpiry->format("Y-m-d"));
						if ($results && ($results->num_rows > 0))
						{
							$row = $results->fetch_assoc();
							DoDeleteQuery1($dbConnection, "adverts", "id", $row["id"]);
						}
					}
				}
				
				function DoCalculateTotalCost()
				{
					$nCost = 0;
					
					if (isset($_POST["text_months"]) && isset($_SESSION["cost_per_month"]))
						$nCost = ((int)$_POST["text_months"] * (int)$_SESSION["cost_per_month"]);
					else if (isset($_SESSION["total_cost"]))
						$nCost = $_SESSION["total_cost"];
					else
						$nCost = "0";
						
					return $nCost;
				}
				
				function DoGenerateAdvertCostMap()
				{
					global $g_dbFindATradie;
					$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");
			
					if ($results && ($results->num_rows > 0))
					{
						$nI = 0;
						while ($row = $results->fetch_assoc())
						{
							echo "[\"" . $row["space_code"] . "\", " . $row["cost_per_month"] . "]";
							if ($nI < ($results->num_rows - 1))
								echo ",";
							echo "\n";
						}
					}
				}
				
				function DoCheckForActiveAdvert($strSpaceCode)
				{
					global $g_dbFindATradie;
					$bResult = false;
					$dateNow = new DateTime();

					$results = DoFindQuery1($g_dbFindATradie, "adverts", "space_id", $strSpaceCode, "expiry_date>'" . $dateNow->format("Y-m-d") . "'");
					$bResult = $results->num_rows > 0;

					return $bResult;
				}
				
								
				
				
				$g_strPaypalRowDisplay = "none";
				if (!isset($_SESSION["edit_advert"]))
					$_SESSION["edit_advert"] = false;
				
				if (isset($_GET["location"]) && !isset($_POST["submit_advert"]) && !isset($_GET["advert_paid"]))
				{
					$results = DoGetAdvertSpaceDetails($_GET["location"]);				
					// [$strID, $strCode, $strDesc, $nCost]
					$_SESSION["space_id"] = $results[0];
					$_SESSION["space_code"] = $results[1];
					$_SESSION["space_description"] = $results[2];
					$_SESSION["cost_per_month"] = $results[3];
				}
				else if (isset($_POST["submit_advert"]))
				{
					$results = DoGetAdvertSpaceDetails($_POST["select_space"]);
					$_SESSION["space_id"] = $results[0];
					$_SESSION["space_code"] = $results[1];
					$_SESSION["space_description"] = $results[2];
					$_SESSION["cost_per_month"] = $results[3];
					$_SESSION["text_months"] = $_POST["text_months"];
					$_SESSION["total_cost"] = (int)$_SESSION["text_months"] * (int)$_SESSION["cost_per_month"];
					$_SESSION["text_desc"] = $_POST["text_desc"];
					$_SESSION["filename"] = $_FILES["file"]["name"];
					
					$strSpaceID = GetSpaceID($_POST["select_space"]);
					if ($strSpaceID != "")
					{
						if (DoCheckForActiveAdvert($strSpaceID))
							PrintJavascriptLine("AlertWarning(\"There is already an active advert in the space '" . $_SESSION["space_description"] . "'!\");", 3, true);
						else
						{
							$g_strPaypalRowDisplay = "block";
							$strTargetPath = "";
							
							if (isset($_FILES["file_name"]))
							{
								$strTargetPath = "images/" . basename($_FILES["file"]["name"]);
							}
							if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $strTargetPath))
							{
								$_SESSION["account_logo_filename"] = basename($_FILES["file"]["name"]);
							}
							else
							{
								PrintJavascriptLine("AlertError(\"Could not save file '" . $_FILES["file"]["name"] . "' to the server!\");", 3, true);
							}
						}
					}
					else
					{
						PrintJavascriptLine("AlertError(\"Unknown advert space ID '" . $strSpaceID . "'!\");", 3, true);
					}
				}
				else if (isset($_GET["advert_paid"]))
				{
					$dateExpiry = new DateTime();
					if (isset($_SESSION["text_months"]))
					{
						$interval = DateInterval::createFromDateString($_SESSION["text_months"] . " month");
						$dateExpiry = $dateExpiry->add($interval);
					}			
					if ($_GET["advert_paid"] == "true")
					{
						$_SESSION["text_months"] = $_POST["text_months"];
							
						if ($_SESSION["edit_advert"])
						{
							$result = DoUpdateQuery2($g_dbFindATradie, "adverts", "text", $_POST["text_desc"], "image_name", $_SESSION["image_file_name"], "id", $_SESSION["advert_id"]);
							unset($_SESSION["space_code"]);
							unset($_SESSION["advert_id"]);
							unset($_SESSION["edit_advert"]);
							unset($_SESSION["space_description"]);
							unset($_SESSION["text_desc"]);
							$_SESSION["filename"] = "";
						}
						else
						{
							$strQuery = "INSERT INTO adverts (member_id, space_id, text, image_name, expiry_date) VALUES (" . 
										AppendSQLInsertValues($_SESSION["account_id"], (int)$_SESSION["space_id"], $_POST["text_desc"], $_SESSION["image_file_name"], $dateExpiry->format("Y-m-d")) . 
											")";
	
							$results = DoQuery($g_dbFindATradie, $strQuery);
							if ($results)
							{
							
								PrintJavascriptLine("AlertSuccess(\"Your advert was saved to the database and wil expire on " . $dateExpiry->format("d-m-Y") . ".\");", 3, true);
								$results = DoUpdateQuery1($g_dbFindATradie, "members", "logo_file_name", $_SESSION["image_file_name"], "id", $_SESSION["account_id"]);
								if ($results && ($results->num_rows > 0))
								{
								}
								else
								{
									PrintJavascriptLine("AlertError(\"Could not update logo file name!\");", 3, true);
								}
							}
							else
							{
								PrintJavascriptLine("AlertError(\"Your advert could not be saved to the database!\");", 3, true);
								DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);
							}
						}
					}
					else
					{			
						PrintJavascriptLine("AlertWarning(\"Your advert has been cancelled!\");", 3, true);
						DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);			
					}
				}
				else if (isset($_GET["advert_id"]))
				{
					$result = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_GET["advert_id"]);
					if ($result && ($result->num_rows > 0))
					{
						if ($row = $result->fetch_assoc())
						{
							$rowAdvert = GetAdvert($_GET["advert_id"]);
							$rowAdvertSpace = GetAdvertSpace($rowAdvert["space_id"]);
							$_SESSION["space_code"] = $rowAdvertSpace["space_code"];
							$_SESSION["advert_id"] = $_GET["advert_id"];
							$_SESSION["edit_advert"] = true;
							$_SESSION["space_description"] = $rowAdvertSpace["space_description"];
							$_SESSION["text_desc"] = $rowAdvert["text"];
							$_SESSION["filename"] = $rowAdvert["image_name"];
						}
					}
				}
				
			?>
			<script type="text/javascript">
			
				function OnKeyUpMonths(inputMonths, eventKey)
				{
					let labelTotalCost = document.getElementById("label_cost_total");
					
					if (labelTotalCost)
					{
						let nCost = Number(inputMonths.value) * <?php if (isset($_SESSION["cost_per_month"])) echo $_SESSION["cost_per_month"]; else echo "0";; ?>;
						labelTotalCost.innerText = nCost.toString();
					}
				}
				
				let g_mapSpaceCosts = new Map([
												<?php DoGenerateAdvertCostMap(); ?>
											  ]);
											  
				function OnChangeSelectAdvertSpace()
				{
					let selectSpace = document.getElementById("select_space"),
						labelCostMonth = document.getElementById("label_cost_month"),
						labelTotalCost = document.getElementById("label_cost_total"),
						textMonths = document.getElementById("text_months");
							
					if (selectSpace && labelCostMonth && textMonths)
					{
						labelCostMonth.innerText = g_mapSpaceCosts.get(selectSpace.options[selectSpace.selectedIndex].value);
						labelTotalCost.innerText = Number(labelCostMonth.innerText) * Number(textMonths.value);
					}
				}
								
			</script>
			
		<!-- #EndEditable -->
		<script type="text/javascript">
			
			function DoChangeBackgroundImage()
			{
				let nImageNum = Math.ceil(Math.random() * 39),
					strFilename = "url('/images/background" + nImageNum + ".jpg')";
					
				document.body.style.backgroundImage = strFilename;
			}
			
		</script>
	</head>

	<body class="body" onload="DoChangeBackgroundImage()">
			
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<div class="logo"><img alt="" src="images/FATLogo.png" width="100" /></div>
			<div class="title_container">
				<div class="title text_outline" id="title">FIND A TRADIE</div>
				<div class="tag text_outline" id="tag">Created by an Australian tradie</div>
			</div>
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
				
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;">LOG IN</a>
			<a class="masthead_button" href="login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;">LOG OUT</a>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item"><a class="navigation_link" href="index.php">HOME</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="benefits.php">BENEFITS</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="about.php">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item"><a class="navigation_link" href="faq.php">FAQ</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="contact.php">CONTACT</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="forum.php">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage/?viewas=100000686899395" class="social_media" ><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
				<!-- #BeginEditable "content" -->








				<div class="note" style="flex-wrap:wrap;">
					<h6><b>LOCATION: </b><?php echo $_SESSION["space_description"]; ?></h6>
					<div style="width:500px;"></div>
					<form class="form" id="advert_form" method="post" action="advert.php" enctype="multipart/form-data" style="width: 748px;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Select the advertising space</b>
								</td>
								<td class="cell_no_borders">
									<select id="select_space" name="select_space" onchange="OnChangeSelectAdvertSpace()">
										<?php DoGenerateAdvertSpaceOptions($_SESSION["space_code"]); ?>
									</select>
								</td>
							</tr>

							<?php include "select_file.html"; ?>

							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Text to display beside image</b>
								</td>
								<td class="cell_no_borders">
									<textarea id="text_desc" name="text_desc" cols="60" rows="10" maxlength="620"><?php if (isset($_SESSION["text_desc"])) echo $_SESSION["text_desc"];?></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>How many months?</b>
								</td>
								<td class="cell_no_borders">
									<input type="text" required size="4" maxlength="3" id="text_months" name="text_months" value="<?php if (isset($_SESSION["text_months"])) echo $_SESSION["text_months"]; else echo "1"; ?>" onkeypress="OnKeyPressDigitsOnly(event)" onkeyup="OnKeyUpMonths(this, event)"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Cost per month:</b><br/>
									<b>Total cost:</b>
								</td>
								<td class="cell_no_borders">
									$<label id="label_cost_month"><?php if (isset($_SESSION["cost_per_month"])) echo $_SESSION["cost_per_month"]; else echo "0"; ?></label>
									<br/>
									$<label id="label_cost_total"><script type="text/javascript">DoCalculateTotalCost();</script></label>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders" colspan="2">
									<input type="submit" id="submit_advert"  name="submit_advert" value="SUBMIT" />
								</td>
							</tr>
							<tr  style="display:<?php echo $g_strPaypalRowDisplay; ?>;" id="row_paypal_button">
								<td class="cell_no_borders" colspan="2">
								
									<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:<?php echo $g_strPaypalTest; ?>;">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="W22A5JKGRMJXY" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" id="paypal_submit" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>	
																	
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:<?php echo $g_strPaypalLive; ?>;">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="78WNB6PA7CP4A" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" id="paypal_submit0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>
									
								</td>
							</tr>
						</table>
					</form>
				</div>








				<!-- #EndEditable -->
		<!-- End Page Content -->
		</div>
		<!-- Begin Footer -->
		<div class="footer" id="footer">
			<!--
			<span class="footer_copyright" id="footer_copyright" style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
			-->
		</div>
		<!-- End Footer -->
	
	</body>
	
	<footer>
		
		<!-- #BeginEditable "footer" -->



		<script type="text/javascript">
		
			OnChangeSelectAdvertSpace();
			
		</script>



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
