<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Create an advertisement</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
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

				function DoGetLocationDisplayName($strSpaceName)
				{
					$strSpaceDisplayName = "";
					
					if ($strSpaceName != "")
					{
						if ($strSpaceName == "index1")
							$strSpaceDisplayName = "Home page, top";
						else if ($strSpaceName == "login1")
							$strSpaceDisplayName = "Login page, top";
					}
					return $strSpaceDisplayName;
				}
									
				function DoGetAdvertCostPerMonth($strSpaceName)
				{
					global $g_dbFindATradie;
					$nCost = 0;
					$strID = "";

					if ($strSpaceName != "")
					{
						$results = DoFindQuery1($g_dbFindATradie, "advert_spaces", "advert_space_name", $strSpaceName);
						if ($results->num_rows > 0)
						{							
							$row = $results->fetch_assoc();
							$nCost = (int)$row["cost_per_month"];
							$strID = $row["id"];
						}
					}
					return [$nCost, $strID];
				}
				
				function DoCleanupAdvert($dbConnection, $strImageFilename, $dateExpiry)
				{
					global $g_dbFindATradie;
					
					if (file_exists($strImageFilename))
					{
						echo unlink($strFilePath);
					}
					if (isset($_SESSION["space_id"]))
					{
						$results = DoFindQuery3($g_dbFindATradie, "adverts", "id", $_SESSION["account_id"], "space_id", (int)$_SESSION["space_id"], "expiry_date", $dateExpiry->format("Y-m-d"));
						if ($results->num_rows > 0)
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
				
				
				
				//********************************************************
				//********************************************************
				//**
				//** START DEBUGGING & TESTING
				//**
				//********************************************************
				//********************************************************
				$_GET["location"] = "index1";
				//$_SESSION["account_id"] = "1";
				//$_SESSION["cost_per_month"] = "10";
				$_GET["advert_paid"] = false;
				$_SESSION["space_name"]  = "index1";
				
				//unset($_GET["advert_paid"]);
				unset($_POST["submit_advert"]);
				/*
				unset($_SESSION["text_months"]);
				unset($_SESSION["space_id"]);
				unset($_SESSION["space_name"]);
				unset($_SESSION["cost_per_month"]);
				unset($_SESSION["file"]);
				*/
				
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
					$_SESSION["space_name"] = $_GET["location"];
					$results = DoGetAdvertCostPerMonth($_SESSION["space_name"]);
					$_SESSION["space_id"] = $results[1];
					$_SESSION["cost_per_month"] = $results[0];
				}
				else if (isset($_POST["submit_advert"]))
				{
					$_SESSION["text_months"] = $_POST["text_months"];
					$_SESSION["file"] = $_FILES["file_image_name"];
					$_SESSION["total_cost"] = (int)$_SESSION["text_months"] * (int)$_SESSION["cost_per_month"];
					$_SESSION["text_desc"] = $_POST["text_desc"];
					$g_strPaypalRowDisplay = "block";
				}
				else if (isset($_GET["advert_paid"]))
				{
					$strTargetPath = "";
					if (isset($_SESSION["file"]))
					{
						$strFileName = basename($_SESSION["file"]["name"]);
						$strTargetPath = "images/" . $strFileName;
					}
					$dateExpiry = new DateTime();
					if (isset($_SESSION["text_months"]))
					{
						$interval = DateInterval::createFromDateString($_SESSION["text_months"] . " month");
						$dateExpiry = $dateExpiry->add($interval);
					}			
					if ($_GET["advert_paid"] == "true")
					{
						if (move_uploaded_file($_SESSION["file"]["tmp_name"], $strTargetPath))
						{
							$_SESSION["text_months"] = $_POST["text_months"];
								
							$strQuery = "INSERT INTO adverts (member_id, space_id, space_name, text, image_name, expiry_date) VALUES (" . 
										AppendSQLInsertValues($_SESSION["account_id"], (int)$_SESSION["space_id"], $_SESSION["space_name"], $_POST["text_desc"], $strFileName, $dateExpiry->format("Y-m-d")) . 
											")";
	
							$results = DoQuery($g_dbFindATradie, $strQuery);
							if ($results)
							{
								PrintJavascriptLine("AlertSuccess(\"Your advert was saved to the database and wil expire on " . $dateExpiry->format("d-m-Y") . ".\");", 3, true);
							}
							else
							{
								PrintJavascriptLine("AlertError(\"Your advert could not be saved to the database!\");", 3, true);
								DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);
							}
						}
						else
						{
							PrintJavascriptLine("AlertError(\"Could not save file '" . $strFileName . "' to the server!\");", 3, true);
							DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);			
						}
					}
					else
					{						
						PrintJavascriptLine("AlertWarning(\"Your advert has been cancelled!\");", 3, true);
						DoCleanupAdvert($g_dbFindATradie, $strTargetPath, $dateExpiry);			
					}
					unset($_SESSION["file"]);
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
					<h6><b>LOCATION: </b><?php echo DoGetLocationDisplayName($_SESSION["space_name"]); ?></h6>
					<div style="width:500px;"></div>
					<form class="form" id="advert_form" method="post" action="advert.php" enctype="multipart/form-data" style="width: 748px;">
						<table class="table_no_borders">
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
									<img src="" alt="<?php if (isset($_FILES["file_image_name"])) echo $_FILES["file_image_name"]["name"]; else echo "IMAGE PREVIEW"; ?>" id="image_preview" width="50" />
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
									<input type="text" required size="4" maxlength="3" id="text_months" name="text_months" value="<?php if (isset($_SESSION["text_months"])) echo $_SESSION["text_months"];?>" onkeypress="OnKeyPressDigitsOnly(event)" onkeyup="OnKeyUpMonths(this, event)"/>
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
									$<label id="label_cost_total"><?php echo DoCalculateTotalCost(); ?></label>
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
										<input type="image" id="paypal_submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
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



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
