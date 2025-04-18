﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		<title>LOG IN</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
		
						
<?php

	function DoSendCode()
	{
		global $g_strAdminEmail;
		global $g_strAdminName;
		
		$_SESSION["login_code"] = GetRandomString(6);
		DoSendEmail($_SESSION["account_email"], $_SESSION["account_first_name"] . " " . $_SESSION["account_surname"], 
					$g_strAdminEmail, $g_strAdminName, "Login code", "<b>CODE: </b>" . $_SESSION["login_code"], 
					"Login code", "CODE: " . $_SESSION["login_code"]);
		
	}

	$g_strLoginDisplay = "block";
	$g_strRecoverDisplay = "none";
	$g_strCodeDisplay = "none";
	$_SESSION["account_username"] = "";
	$_SESSION["account_password"] = "";
	$g_b2Factor = true;
		
	// Processing post data.
	if (isset($_POST["submit_login"]))
	{
		$strQuery = "SELECT * FROM members WHERE username='" . $_POST["text_username"] . "' OR email='" . $_POST["text_username"] . "' AND password='" . $_POST["text_password"] . "'";
		$result = DoQuery($g_dbFindATradie, $strQuery);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			$_SESSION["account_id"] = $row["id"];
			$_SESSION["account_trade"] = (int)$row["trade_id"];
			$_SESSION["account_business_name"] = $row["business_name"];
			$_SESSION["account_first_name"] = $row["first_name"];
			$_SESSION["account_surname"] = $row["surname"];
			$_SESSION["account_abn"] = $row["abn"];
			$_SESSION["account_structure"] = $row["structure"];
			$_SESSION["account_license"] = $row["license"];
			$_SESSION["account_description"] = $row["description"];
			$_SESSION["account_minimum_charge"] = $row["minimum_charge"];
			$_SESSION["account_minimum_budget"] = $row["minimum_budget"];
			$_SESSION["account_maximum_size"] = $row["maximum_size"];
			$_SESSION["account_maximum_distance"] = $row["maximum_distance"];
			$_SESSION["account_unit"] = $row["unit"];
			$_SESSION["account_street"] = $row["street"];
			$_SESSION["account_suburb"] = $row["suburb"];
			$_SESSION["account_state"] = $row["state"];
			$_SESSION["account_postcode"] = $row["postcode"];
			$_SESSION["account_phone"] = $row["phone"];
			$_SESSION["account_mobile"] = $row["mobile"];				
			$_SESSION["account_email"] = $row["email"];
			$_SESSION["account_expiry_date"] = $row["expiry_date"];
			$_SESSION["account_username"] = $row["username"];
			$_SESSION["account_password"] = $row["password"];
			$_SESSION["account_logo_filename"] = $row["logo_filename"];
			$_SESSION["account_profile_filename"] = $row["profile_filename"];
			$_SESSION["account_admin"] = $row["admin"];
			
			// Next we need to get the listb of additional trades.
			$_SESSION["account_additional_trades"] = [];
			
			$result = DoFindQuery1($g_dbFindATradie, "additional_trades", "member_id", $_SESSION["account_id"]);
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$_SESSION["account_additional_trades"][] = $row["trade_id"];
				}
			}
			if ($g_b2Factor)
			{			
				$g_strLoginDisplay = "none";
				$g_strCodeDisplay = "block";
				DoSendCode();
			}
			else
			{
				PrintJavascriptLine("document.location = \"account.php?member_id=" . $_SESSION["account_id"] . "\";", 5, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError('Username and/or password is incorrect!')", 5, true);
		}
	}
	else if (isset($_POST["submit_code"]))
	{
		/*
		echo "<div style=\"background-color:white;\">";
		print_r($_SESSION);
		echo "<br>=================<br>";
		print_r($_POST);
		echo "</div>";
		*/
		if (strcmp($_POST["text_code"], $_SESSION["login_code"]) == 0)
			PrintJavascriptLine("document.location = \"account.php?member_id=" . $_SESSION["account_id"] . "\";", 5, true);
		else
		{
			PrintJavascriptLine("AlertError('The code is incorrect!')", 5, true);
		}
	}
	else if (isset($_POST["submit_resend"]))
	{
		$g_strLoginDisplay = "none";
		$g_strCodeDisplay = "block";
		DoSendCode();
	}
	else if (isset($_GET["submit_logout"]) && (strlen($_GET["submit_logout"]) > 0))
	{
		$_SESSION["account_id"] = "";
		$_SESSION["account_trade"] = -1;
		$_SESSION["account_business_name"] = "";
		$_SESSION["account_first_name"] = "";
		$_SESSION["account_surname"] = "";
		$_SESSION["account_abn"] = "";
		$_SESSION["account_structure"] = "";
		$_SESSION["account_license"] = "";
		$_SESSION["account_description"] = "";
		$_SESSION["account_minimum_charge"] = "";
		$_SESSION["account_minimum_budget"] = "";
		$_SESSION["account_maximum_size"] = "";
		$_SESSION["account_maximum_distance"] = "";
		$_SESSION["account_unit"] = "";
		$_SESSION["account_street"] = "";
		$_SESSION["account_suburb"] = "";
		$_SESSION["account_state"] = "";
		$_SESSION["account_postcode"] = "";
		$_SESSION["account_phone"] = "";
		$_SESSION["account_mobile"] = "";
		$_SESSION["account_email"] = "";
		$_SESSION["account_expiry_date"] = "";
		$_SESSION["account_additional_trades"] = [];
		PrintJavascriptLine("sessionStorage.removeItem(\"member_id\");", 5, true);
	}
	else if (isset($_POST["submit_recover"]))
	{
		$result = DoFindQuery3($g_dbFindATradie, "members", "username", $_POST["text_recover_username"], "business_name", $_POST["text_recover_business_name"], "mobile", $_POST["text_recover_mobile"]);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			mail($row["email"], "Username and pass word recovery at FindATradie", "Username: " . $row["username"] . "%0D%0APassword: " . DoAESDecrypt($row["password"]) . "%0D%0A");			
			PrintJavascriptLine("alert('Your username and password have been emailed to " . $row["email"] . "');", 3);
		}
		else
		{
			PrintJavascriptLine("alert(\"Account with username '" . $_POST["text_recover_username"] . "', business name '" . $_POST["text_recover_business_name"] . "' and mobile '" . $_POST["text_recover_mobile"] . "' was not found!\");", 3);
			$g_strLoginDisplay = "none";
			$g_strRecoverDisplay = "block";
		}
	}

?>

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

				<?php
					
					function DoGetUsername()
					{
						$strUsername = "";
							
						if (isset($_SESSION["account_username"]))
							$strUsername = $_SESSION["account_username"];
						else if (isset($_POST["text_username"]))
							$strUsername = $_POST["text_username"];
							
						return $strUsername;
					}
					
					function DoGetPassword()
					{
						$strPassword = "";
							
						if (isset($_SESSION["account_password"]))
							$strPassword = $_SESSION["account_password"];
						else if (isset($_POST["text_password"]))
							$strPassword = $_POST["text_password"];
							
						return $strPassword;
					}
					
				?>

				<div class="note">

					<form method="post" id="form_recover" class="form" action="login.php" style="width:560px;display:<?php echo $g_strRecoverDisplay; ?>;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_recover_surname" id="label_surname">Username or email: </label></td>
								<td class="cell_no_borders">
									<input name="text_username" id="text_recover_username" style="width: 20em" type="text" value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_recover_business_name" id="label_business_name" >Business name: </label></td>
								<td class="cell_no_borders">
									<input name="text_business_name" id="text_recover_business_name" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_recover_mobile" id="label_mobile" >Mobile: </label></td>
								<td class="cell_no_borders">
									<input name="text_mobile" id="text_recover_mobile" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;" class="cell_no_borders"><br/><input type="button" id="button_login" value="GO TO LOGIN" onclick="OnShowForm('form_login', 'form_recover')"/></td>
								<td style="text-align:right;" class="cell_no_borders"><br/><input type="submit" id="submit_recover" name="submit_recover" value="EMAIL REMINDER"/></td>
							</tr>
						</table>
					</form>
					
					<form method="post" id="form_login" class="form" action="login.php" style="width:560px;display:<?php echo $g_strLoginDisplay; ?>;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_username" id="label_username">Username or email: </label></td>
								<td class="cell_no_borders">
									<input name="text_username" id="text_username" style="width: 20em" type="text" value="<?php echo DoGetUsername(); ?>"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_password" id="label_password" >Password: </label></td>
								<td class="cell_no_borders">
									<input type="password" name="text_password" id="text_password" style="width: 20em" value="<?php echo DoGetPassword(); ?>"/>
									<br/><input type="checkbox" id="check_show" onclick="OnClickCheckboxShow(this)" /><label for="textPassword">Show password</label>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;" class="cell_no_borders"><br/><input type="button" id="button_recover" value="I FORGET MY PASSWORD" onclick="OnShowForm('form_recover', 'form_login')"/></td>
								<td style="text-align:right;" class="cell_no_borders"><br/><input type="button" id="submit_login" name="submit_login" value="LOG IN" onclick="OnClickButtonSubmit()"/></td>
							</tr>
							<tr>
								<td colspan="2"><?php if ($g_b2Factor) echo "We use two factor authentication. An email will be sent to you containing a code that you will need to enter at the next stage."; ?></td>
							</tr>
						</table>
						<input type="hidden" name="submit_login" value="LOG IN" />
					</form>	
					<form method="post" id="form_emailed_code" class="form" action="login.php" style="width:560px;display:<?php echo $g_strCodeDisplay; ?>;">
						<table class="table_no_borders">					
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_code" id="label_code">Code emailed to you: </label></td>
								<td class="cell_no_borders">
									<input name="text_code" id="text_code" style="width: 20em" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders" ><br/><input type="submit" id="submit_resend" name="submit_resend" value="RESEND CODE" /></td>
								<td style="text-align:right;" class="cell_no_borders" ><br/><input type="submit" id="submit_code" name="submit_code" value="SUBMIT CODE" /></td>
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
															
					function OnClickButtonSubmit()
					{
						let textUsername = DoGetInput("text_username"),
							textPassword = DoGetInput("text_password");
						
						if (textUsername && textPassword)
						{
							DoGetInput("form_login").submit();
						}
					}
					
					function OnShowForm(strShowFormID, strHideFormID)
					{
						let formShow = document.getElementById(strShowFormID),
							formHide = document.getElementById(strHideFormID);
							
						if (formShow && formHide)
						{
							formHide.style.display = "none";
							formShow.style.display = "block";
						}
					}
											
					function OnClickCheckboxShow(checkShow)
					{
						let textPassword = document.getElementById("text_password");
						
						if (checkShow && textPassword)
						{
							if (checkShow.checked)
							{
								textPassword.type = "text";
							}
							else
							{
								textPassword.type = "password";
							}
						}
					}
																	
				</script>					



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
