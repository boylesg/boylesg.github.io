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
			<style>
			
				body 
				{
					color: #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: small;
					font-style: normal;
					background-image: url('images/background.jpg');
					background-position: center;
					background-repeat: no-repeat;
					background-size: 100%;
				}
				
			</style>
			
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
				
				function DoGenerateAdvertSpaceOptions($strSpaceCode)
				{
					global $g_dbFindATradie;
					$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");
			
					if ($results && ($results->num_rows > 0))
					{
						while ($row = $results->fetch_assoc())
						{
							echo "<option ";
							if ($strSpaceCode == $row["space_code"])
								echo "selected ";
							echo "value=\"" . $row["space_code"] . "\">" . $row["space_description"] . "</option>\n";
						}
					}
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
				
				
				
				
				//********************************************************
				//********************************************************
				//**
				//** START DEBUGGING & TESTING
				//**
				//********************************************************
				//********************************************************
				//$_GET["location"] = "login1";
				//$_SESSION["account_id"] = "1";
				//$_SESSION["cost_per_month"] = "10";
				//$_GET["advert_paid"] = true;
				//$_SESSION["space_code"]  = "index1";
				
				//unset($_SESSION["account_id"]);
				//unset($_SESSION["text_months"]);
				//unset($_SESSION["space_id"]);
				//unset($_SESSION["space_code"]);
				//unset($_SESSION["cost_per_month"]);
				//unset($_SESSION["image_file_name"]);
				
				//unset($_GET["advert_paid"]);
				//unset($_POST["submit_advert"]);
				
				//********************************************************
				//********************************************************
				//**
				//** END DEBUGGING & TESTING
				//**
				//********************************************************
				//********************************************************
				
				
				
				
				$g_strPaypalRowDisplay = "none";
				
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
					
					$strSpaceID = GetSpaceID($_POST["select_space"]);
					if ($strSpaceID != "")
					{
						if (DoCheckForActiveAdvert($strSpaceID))
							PrintJavascriptLine("AlertWarning(\"There is already an active advert in the space '" . $_SESSION["space_description"] . "'!\");", 3, true);
						else
						{
							$g_strPaypalRowDisplay = "block";
							$strTargetPath = "";
							
							if (isset($_FILES["file_image_name"]))
							{
								$strTargetPath = "images/" . basename($_FILES["file"]["name"]);
							}
							if (move_uploaded_file($_FILES["file_image_name"]["tmp_name"], $strTargetPath))
							{
								$_SESSION["image_file_name"] = basename($_FILES["file"]["name"]);
							}
							else
							{
								PrintJavascriptLine("AlertError(\"Could not save file '" . $_FILES["file"]["name"] . "' to the server!<br><br>" . $g_strEmailAdmin . "\");", 3, true);
							}
						}
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
					else
					{			
						PrintJavascriptLine("AlertWarning(\"Your advert has been cancelled!\");", 3, true);
						DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);			
					}
				}
				
				function GetImageAltText()
				{
					$strAltText = "";
					
					if (isset($_FILES["file_image_name"])) 
						$strAltText = $_FILES["file_image_name"]["name"]; 
					else if (isset($_SESSION["file_image_name"])) 
						$strAltText = $_SESSION["file_image_name"]["name"]; 
					else 
						$strAltText = "IMAGE PREVIEW";
						
					return $strAltText;
				}

			?>
				
			<script type="text/javascript">
			
				function DoImagePreview()
				{
					let imgPreview = document.getElementById("image_preview"),
						inputFile = document.getElementById("file_image_name");
					
					if (imgPreview)
					{
						imgPreview.src = URL.createObjectURL(inputFile.files[0]);
					}
				}
				
				function OnChangeFile(inputFile)
				{
					if (inputFile.files[0].size > 500000)
					{
						AlertError("File size cannot exceed 500 kilobytes!");
					}
					else
					{							
						DoImagePreview();
					}
				}
				
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
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.html">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="contact.html">FAQ</a>
					<a class="navigation_link" href="contact.html">Contact</a>
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
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
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Select and image to display</b>
								</td>
								<td class="cell_no_borders">
									<input type="file" required id="file_image_name" name="file_image_name" accept=".jpg, .png, .jpeg, .gif|image/*" onchange="OnChangeFile(this)"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Image preview</b>
								</td>
								<td class="cell_no_borders">
									<img src="" alt="<?php echo GetImageAltText(); ?>" id="image_preview" width="50" />
								</td>
							</tr>
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