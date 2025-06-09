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
		<title>Edit Advert</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
			<style>
</style>
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








			<div class="page_content" id="page_content0">
			
			<?php
			
				$_SESSION["page_name"] = "";
				$_SESSION["space_code"] = "";
				$_SESSION["current_page"] = "";
				$_SESSION["cost_per_year"] = "";
				$_SESSION["advert_text"] = "";
					
				if (isset($_GET["page_name"]))
				{
					$_SESSION["page_name"] = $_GET["page_name"];
					$_SESSION["space_code"] = $_GET["page_name"] . "_" . $_GET["advert_slot_index"];
				}
				else if (isset($_POST["advert_space_code"]))
				{
					$_SESSION["space_code"] = $_POST["advert_space_code"];
				}
				if (isset($_GET["current_page"]))
				{
					$_SESSION["current_page"] = $_GET["current_page"];
				}
				else if (isset($_POST["current_page"]))
				{
					$_SESSION["current_page"] = $_POST["current_page"];
				}
				if (isset($_GET["cost_per_year"]))
				{
					$_SESSION["cost_per_year"] = $_GET["cost_per_year"];
				}
				else if (isset($_POST["cost_per_year"]))
				{
					$_SESSION["cost_per_year"] = $_POST["cost_per_year"];
				}
				if (isset($_POST["advert_text"]))
				{
					$_SESSION["advert_text"] = $_POST["advert_text"];
				}
				if (isset($_GET["advert_id"]))
				{
					$_SESSION["advert_id"] = $_GET["advert_id"];
				}
				
				/*
					Array ( 
							[page_name] => account 
							[advert_slot_index] => 2 
							[current_page] => https://www.find-a-tradie.com.au/account.php 
						  )

					Array ( 
							[advert_text] => gfdfgadfngkdfgndfkgdkfgkadfgkdfagkdfgkbdafkgd 
							[button_submit_advert] => 
							[advert_space_code] => account_2 
							[current_page] => https://www.find-a-tradie.com.au/account.php
							[cost_per_year] => 120
						  )

					Array ( 
							[logo_filename] => Array ( 
														[name] => UploadProfile.jpg 
														[full_path] => UploadProfile.jpg 
														[type] => image/jpeg 
														[tmp_name] => C:\Windows\Temp\php16A5.tmp 
														[error] => 0 
														[size] => 8539 ) 
						  ) 				
				*/
				$g_strDisplayPriceLevel1 = $g_strDisplayPriceLevel2 = $g_strDisplayPriceLevel3 = $g_strDisplayPriceLevel4 = "none";
				if (isset($_POST["button_submit_advert"]))
				{
					$dateNow = new DateTime();
					$dateExpiry = new DateTime();
					$strSpaceID = DoGetSpaceID($_SESSION["space_code"]);
					
					if (isset($_GET["advert_id"]))
					{
						$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "text", $_SESSION["advert_text"], "id", $_SESSION["advert_id"]);
						if ($results)
						{
							if (DoSaveLogoImage($_SESSION["account_id"], $_FILES["logo_filename"]))
							{
								PrintJavascriptLine("AlertSuccess(\"Changes to your advert were saved!\");", 3, true);
							}
							else
							{
								PrintJavascriptLine("AlertSuccess(\"Changes to your advert were saved!\");", 3, true);
							}
						}
						else
						{
							PrintJavascriptLine("AlertError(\"Changes to your advert could not be saved!\");", 3, true);
						}
					}
					else
					{
						if ($_SESSION["account_id"] == 1)
							$dateNow->modify("12 months");
							
						$results = DoInsertQuery5($g_dbFindATradie, "adverts", "space_id", intval($strSpaceID), 
													"text", $_POST["advert_text"], "member_id", $_SESSION["account_id"], 
													"expiry_date", $dateNow->format("Y-m-d"), "page_name", $_POST["page_name"]);
						if ($results)
						{
							if ($_SESSION["account_id"] == 1)
							{
								PrintJSAlertSuccess("Your advert has been added and will expire in 12 months!", 4);
							}
							else
							{
								$results = DoFindQuery4($g_dbFindATradie, "adverts", "space_id", $strSpaceID, 
														"member_id", $_SESSION["account_id"], 
														"expiry_date", $dateNow->format("Y-m-d"), 
														"text", $_POST["advert_text"]);
	
								if ($results && ($results->num_rows > 0))
								{
									if ($row = $results->fetch_assoc())
									{
										$strDateAdded = $row["date_added"];
										$strDateAdded = substr($row["date_added"], 0, strpos($row["date_added"], " ") - 1);
										$dateAdded = new DateTime($strDateAdded);
										if ($dateAdded = $dateNow)
										{
											$_SESSION["advert_id"] = $row["id"];
											if (DoSaveLogoImage($_SESSION["account_id"], $_FILES["logo_filename"]))
											{
												if (strcmp(intval($_GET["cost_per_year"]), $g_strPriceLevel4) == 0)
												{
													$g_strDisplayPriceLevel4 = "block";
												}
												else if (strcmp(intval($_GET["cost_per_year"]), $g_strPriceLevel3) == 0)
												{
													$g_strDisplayPriceLevel3 = "block";
												}
												else if (strcmp(intval($_GET["cost_per_year"]), $g_strPriceLevel2) == 0)
												{
													$g_strDisplayPriceLevel2 = "block";
												}
												else if (strcmp(intval($_GET["cost_per_year"]), $g_strPriceLevel1) == 0)
												{
													$g_strDisplayPriceLevel1 = "block";
												}
											}
											$_SESSION["advert_id"] = $row["id"];
										}
									}
								}
							}
						}
						else
						{
							PrintJSErrorSuccess("Failed to insert new advert into adverts table!", 4);
						}
					}
				}
				else if (isset($_GET["advert_id"]))
				{
					$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_GET["advert_id"]);
					if ($results && ($results->num_rows > 0))
					{
						if ($row = $results->fetch_assoc())
						{
							$_SESSION["advert_text"] = $row["text"];
						}
					}
				}
				else if (isset($_GET["paypal_advert_payment"]))
				{
					if (intval($_GET["paypal_advert_payment"]) > 0)
					{
						$dateExpiry = new DateTime();
						$dateExpiry->modify("+12 months");
						$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "expiry_date", $dateExpiry->format("Y-m-d"), "id", $_SESSION["advert_id"]);
				
						if ($results)
						{
							PrintJSAlertSuccess("Your advert has been added and will expire in 12 months!", 4);
							unset($_SESSION["page_name"]);
							unset($_SESSION["space_code"]);
							unset($_SESSION["current_page"]);
							unset($_SESSION["cost_per_year"]);
							unset($_SESSION["advert_text"]);
							unset($_SESSION["advert_id"]);
						}
						else
						{
							PrintJSAlertError("Your advert expiry date could not be updated!", 4);
						}
					}
					else
					{
						$results = DoDeleteQuery($g_dbFindATradie, "adverts", "id", $_SESSION["advert_id"]);
						if ($results)
							PrintJSAlertWarning("Your advert has been deleted!", 4);
						else
							PrintJSAlertError("Your advert could not be deleted!", 4);
					}
				}
				else
				{
					/*
					echo "GET\n----\n";
					print_r($_GET);
					echo "\n<br/><br/>\n";
					echo "POST\n----\n";
					print_r($_POST);
					echo "\n<br/><br/>\n";
					echo "FILES\n----\n";
					print_r($_FILES);
					*/
				}
				
			?>
			
			<form method="post" enctype="multipart/form-data" id="advert_form" class="form" style="width:748px;">
				<h6>Advert Details</h6>
				<table cellspacing="0" cellpadding="10" border="0">
					<tr>
						<td>
							<b>Current business logo</b><br/><br/>
							<img src="https://www.find-a-tradie.com.au/<?php echo $_SESSION["account_logo_filename"]; ?>" alt="<?php echo $_SESSION["account_logo_filename"]; ?>" width="300"/>
						</td>
					</tr>
					<tr>
						<td>
							<b>New business logo</b><br/><br/>
							<input type="file" name="logo_filename" id="logo_filename" />
						</td>
					</tr>
					<tr>
						<td>
							<b>Advert text (you can use HTML tags)</b><br/><br/>
							<textarea name="advert_text" id="advert_text" rows="10" cols="100"><?php echo $_SESSION["advert_text"]; ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<button id="button_submit_advert" name="button_submit_advert">
								<img src="/images/save.png" alt="save.png" width="35"/>
							</button>

						</td>
					</tr>
					<tr>
						<td>
							<div style="display:<?php echo $g_strPaypalTest; ?>">
								<div style="display:<?php echo $g_strDisplayPriceLevel4; ?>">
									<div  class="price"><b>$<?php echo $g_strPriceLevel4; ?> for 12 months</b></div>
									<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="UQTFACVJZN84J" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>			
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel3; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel3; ?> for 12 months</b></div>
									<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="YLYNKRXQG3QMU" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel2; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel2; ?> for 12 months</b></div>
									<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="4FPTE2NUTZV34" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel1; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel1; ?> for 12 months</b></div>
									<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="QCJ8E7WVCZ93Q" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>				
								</div>
							</div>
							<div style="display:<?php echo $g_strPaypalLive; ?>">
								<div style="display:<?php echo $g_strDisplayPriceLevel4; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel4; ?> for 12 months</b></div>
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="ZSPJBYAAWTRYS" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>					
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel3; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel3; ?> for 12 months</b></div>
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="AB3JSKQCJSQRU" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>				
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel2; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel2; ?> for 12 months</b></div>
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="Z8PE7XKU6272A" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>				
								</div>
								<div style="display:<?php echo $g_strDisplayPriceLevel1; ?>;">
									<div  class="price"><b>$<?php echo $g_strPriceLevel1; ?> for 12 months</b></div>
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick" />
										<input type="hidden" name="hosted_button_id" value="3SLW8ZH5LUFR8" />
										<input type="hidden" name="currency_code" value="AUD" />
										<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
									</form>			
								</div>
							</div>		
							<?php
								$_SESSION["current_page"] = substr($_SESSION["current_page"], 0, strpos($_SESSION["current_page"], "php") + 3);
							?>
							<a href="<?php echo $_SESSION["current_page"]; ?>" style="display:<?php if (isset($_GET["paypal_advert_payment"]) || isset($_GET["advert_id"])) echo "block"; else echo "none"; ?>"><img src="/images/back.png" alt="save.png" width="35"/></a>
						</td>
					</tr>
				</table>
				<input type="hidden" id="advert_space_code" name="advert_space_code" value="<?php  echo $_SESSION["space_code"]; ?>" />
				<input type="hidden" id="current_page" name="current_page" value="<?php  echo $_SESSION["current_page"]; ?>" />
				<input type="hidden" id="cost_per_year" name="cost_per_year" value="<?php  echo $_SESSION["cost_per_year"]; ?>" />
				<input type="hidden" id="page_name" name="page_name" value="<?php  echo $_SESSION["page_name"]; ?>" />
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
