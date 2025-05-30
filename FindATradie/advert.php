<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/advert_stuff.php";
	?>
	<script type="text/javascript">	

		sessionStorage["member_id"] = <?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; else echo "0"; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Create an advertisement</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
		
			<style>
</style>
						
			<?php

				function DoGenerateAdvertCostMap()
				{
					global $g_dbFindATradie;
					$results = DoFindAllQuery($g_dbFindATradie, "advert_spaces");
			
					if ($results && ($results->num_rows > 0))
					{
						$nI = 0;
						while ($row = $results->fetch_assoc())
						{
							echo "[\"" . $row["space_code"] . "\", " . $row["cost_per_year"] . "]";
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
				$g_strSpaceDisabled = "";
				
				if (isset($_GET["location"]) && !isset($_POST["add_advert"]) && !isset($_GET["advert_paid"]))
				{
					if ($row = DoGetAdvertSpace($_GET["location"]))
					{			
						$_SESSION["space_id"] = $row["id"];
						$_SESSION["space_code"] = $row["space_code"];
						$_SESSION["space_description"] = $row["space_description"];
						$_SESSION["cost_per_year"] = $row["cost_per_year"];
					}
				}
				else if (isset($_POST["add_advert"]))
				{
					$g_strDisplayAddButton = "block";
					$g_strDisplayEditButton = "none";

					if ($row = DoGetAdvertSpace($_GET["location"]))
					{			
						$_SESSION["space_id"] = $row["id"];
						$_SESSION["space_code"] = $row["space_code"];
						$_SESSION["space_description"] = $row["space_description"];
						$_SESSION["cost_per_year"] = $row["cost_per_year"];
					}
					$_SESSION["total_cost"] = (int)$_SESSION["cost_per_year"];
					$_SESSION["text_desc"] = $_POST["text_desc"];
					
					$strSpaceID = GetSpaceID($_POST["select_space"]);
					if ($strSpaceID != "")
					{
						if (DoCheckForActiveAdvert($strSpaceID))
							PrintJavascriptLine("AlertWarning(\"There is already an active advert in the space '" . $_SESSION["space_description"] . "'!\");", 3, true);
						else
						{
							$g_strPaypalRowDisplay = "block";
							$dateExpiry = new DateTime();
							
							$results = DoInsertQuery4($g_dbFindATradie, "adverts", "member_id", $_SESSION["account_id"], 
														"space_id", $_SESSION["space_id"], "text", $_POST["text_desc"], 
														"image_name", DoGetLogoImageFilename($_SESSION["account_id"]), 
														"expiry_date", $dateExpiry->format("Y-m-d"));
							if ($results)
							{
							}
							else
							{
								PrintJavascriptLine("AlertError(\"Your advert could not be saved to the database!\");", 3, true);
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
					$dateExpiry->modify("12 month");		
					if ($_GET["advert_paid"] == "true")
					{	
						if ($result = DoUpdateQuery2($g_dbFindATradie, "adverts", "text", $_POST["text_desc"], "expiry_date", $dateExpiry->format("Y-m-d"), "id", $_SESSION["advert_id"]))
						{
							PrintJavascriptLine("document.location = \"account.php\"", 4, true);
						}
					}
					else
					{	
						$results = DoDeleteQuery($g_dbFindATradie, "adverts", "id", $_SESSION["advert_id"]);		
						PrintJavascriptLine("AlertWarning(\"Your advert has been cancelled!\");", 3, true);
					}
					unset($_SESSION["space_code"]);
					unset($_SESSION["advert_id"]);
					unset($_SESSION["edit_advert"]);
					unset($_SESSION["space_description"]);
					unset($_SESSION["text_desc"]);
				}
				else if (isset($_GET["advert_id"]))
				{
					$g_strDisplayAddButton = "none";
					$g_strDisplayEditButton = "block";
					$g_strSpaceDisabled = "disabled";

					$result = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_GET["advert_id"]);
					if ($result && ($result->num_rows > 0))
					{
						if ($row = $result->fetch_assoc())
						{
							if ($rowAdvert = GetAdvert($_GET["advert_id"]))
							{
								if ($rowAdvertSpace = GetAdvertSpace($rowAdvert["space_id"]))
								{
									$_SESSION["space_code"] = $rowAdvertSpace["space_code"];
									$_SESSION["advert_id"] = $_GET["advert_id"];
									$_SESSION["space_description"] = $rowAdvertSpace["space_description"];
									$_SESSION["cost_per_year"] = $rowAdvertSpace["cost_per_year"];
								}
								$_SESSION["text_desc"] = $rowAdvert["text"];
							}
						}
					}
				}
				else if (isset($_POST["edit_advert"]))
				{
					$g_strSpaceDisabled = "disabled";
					if ($results = DoUpdateQuery1($g_dbFindATradie, "adverts", "text", $_POST["text_desc"], "id", $_SESSION["advert_id"]))
					{
						PrintJavascriptLine("document.location = \"account.php\"", 4, true);
					}
				}
				
			?>
			<script type="text/javascript">
			
				let g_mapSpaceCosts = new Map([
												<?php DoGenerateAdvertCostMap(); ?>
											  ]);
											  
				function OnChangeSelectAdvertSpace()
				{
					let selectSpace = document.getElementById("select_space"),
						labelCostMonth = document.getElementById("label_cost_month"),
						labelTotalCost = document.getElementById("label_cost_total"));
							
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
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;" title="Join find-a-tradie as a tradie looking for customers...">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php" title="Join find-a-tradie as a customer looking for tradies...">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
					
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;" title="Login to your account...">LOG IN</a>
			<a class="masthead_button" href="login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;" title="Logout of your account...">LOG OUT</a>
			
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item"><a class="navigation_link" href="index.php" title="Return to the home page...">HOME</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="benefits.php" title="Read about the many benefits of becoming a find-a-tradie member...">BENEFITS</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="about.php" title="Read about why find-a-tradie was created...">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item"><a class="navigation_link" href="faq.php" title="Frequently Asked Questions answered...">FAQ</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="contact.php" title="Contact find-a-tradie...">CONTACT</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="forum.php" title="Talk to tradies about your job...">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" title="Go to the facebook page..."><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
				<a id="find-a-tradie-app" class="app_button" href="https://www.find-a-tradie.com.au/app/find_a_tradie.apk" download title="Download the android app...">
					<img src="images/AndroidMobile.png" height="60" />
				</a>
				&nbsp;
				<a id="find-a-tradie-app" class="app_button" href="" download title="IOS app is comming...">
					<img src="images/AppleMobile.png" height="60" />
				</a>

			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<marquee id="advert_marquee " behavior="alternate" scrolldelay="80" truespeed loop="-1" style="<?php if (strcmp(basename($_SERVER['REQUEST_URI']), "admin.php") == 0) echo "none"; else echo "block";?>;" class="advert_marquee">
				<?php DoGenerateAdvertSlotHTML(); ?></marquee>
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
									<select id="select_space" name="select_space" onchange="OnChangeSelectAdvertSpace()" <?php echo $g_strSpaceDisabled; ?>>
										<?php DoGenerateAdvertSpaceOptions($_SESSION["space_code"]); ?>
									</select>
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
									<b>Cost for 12 month:</b>
								</td>
								<td class="cell_no_borders">
									$<label id="label_cost_total"><?php if (isset($_SESSION["cost_per_year"])) echo $_SESSION["cost_per_year"]; ?></label>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders" colspan="2">
									<input type="submit" id="add_advert"  name="add_advert" value="SAVE" style="display:<?php echo $g_strDisplayAddButton?>"/>
									<input type="submit" id="edit_advert"  name="edit_advert" value="EDIT" style="display:<?php echo $g_strDisplayEditButton?>"/>
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
