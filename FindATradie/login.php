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
		<title>LOG IN</title>
		<!-- #EndEditable -->
		<?php include "common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<?php
			
				function DoGetRandomBackgroundImage()
				{
					$strImagfeFileName = "background";
					$nNum = rand(1, 9);
					$strImagfeFileName = $strImagfeFileName . $nNum;
					return $strImagfeFileName;
				}
				
			?>
			<style>

			
				body 
				{
					color: #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: small;
					font-style: normal;
					background-image: url('images/<?php echo DoGetRandomBackgroundImage(); ?>.jpg');
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
				}
				
			</style>
			
		<!-- #BeginEditable "page_styles" -->
		
			<style>
</style>
						
<?php

	$g_strLogin = "block";
	$g_strRecover = "none";
	$_SESSION["account_username"] = "";
	$_SESSION["account_password"] = "";
		
	// Processing post data.
	if (isset($_POST["submit_login"]))
	{
		$_SESSION["account_username"] = DoAESDecrypt($_POST["text_username"]);
		$_SESSION["account_password"] = $_POST["text_password"];
		$strQuery = "SELECT * FROM members WHERE username='" . $_SESSION["account_username"] . "' OR email='" . $_SESSION["account_username"] . "' AND password='" . $_SESSION["account_password"] . "'";
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
			PrintJavascriptLine("document.location = \"account.php?submit_login=LOG IN\";", 5, true);
		}
		else
		{
			PrintJavascriptLine("AlertError('Username and/or password is incorrect!')", 5, true);
		}
	}
	else if (isset($_POST["submit_logout"]) && (strlen($_POST["submit_logout"]) > 0))
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
	}
	else if (isset($_POST["submit_recover"]))
	{
		$result = DoFindQuery3($g_dbFindATradie, "members", "username", $_POST["text_recover_username"], "business_name", $_POST["text_recover_business_name"], "mobile", $_POST["text_recover_mobile"]);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			mail($row["email"], "Username and pass word recovery at FindATradie", "Username: " . $row["username"] . "%0D%0APassword: " . $row["password"] . "%0D%0A");			
			PrintJavascriptLine("alert('Your username and password have been emailed to " . $row["email"] . "');", 3);
		}
		else
		{
			PrintJavascriptLine("alert(\"Account with username '" . $_POST["text_recover_username"] . "', business name '" . $_POST["text_recover_business_name"] . "' and mobile '" . $_POST["text_recover_mobile"] . "' was not found!\");", 3);
			$g_strLogin = "none";
			$g_strRecover = "block";
		}
	}

?>

		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tools.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie.</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">HOME</a>
				<a class="navigation_link" href="benefits.php">BENEFITS</a>
				<a class="navigation_link" href="about.php">ABOUT</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">LOG IN</a>\n";
							
					?>
				<a class="navigation_link" href="faq.php">FAQ</a>
				<a class="navigation_link" href="contact.php">CONTACT</a>
				<a class="navigation_link" href="forum.php">FORUM</a>
				<div class="nav_images">
					<img src="images/tools/ACTester.png" alt="images/tools/ACTester.png" class="nav_image" />
					<img src="images/tools/Chainsaw.png" alt="images/tools/Chainsaw.png" class="nav_image" style="width:80px;" />
					<img src="images/tools/LawnMower.png" alt="images/tools/LawnMower.png" class="nav_image" />
					<img src="images/tools/SewingMachine.png" alt="images/tools/SewingMachine.png" class="nav_image" />
					<img src="images/tools/PlumberWrench.png" alt="images/tools/PlumberWrench.png" class="nav_image" />
					<img src="images/tools/GlassCutter.png" alt="images/tools/GlassCutter.png" class="nav_image" />
				</div>
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








				<div class="note">

					<form method="post" id="form_recover" class="form" action="login.php" style="width:560px;display:<?php echo $g_strRecover; ?>;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_recover_surname" id="label_surname">Username or email: </label></td>
								<td class="cell_no_borders">
									<input name="text_username" id="text_recover_username" style="width: 20em" type="text" value="<?php echo $_SESSION["account_username"]; ?>"/>
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
					
					<form method="post" id="form_login" class="form" action="login.php" style="width:560px;display:<?php echo $g_strLogin; ?>;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_username" id="label_username">Username or email: </label></td>
								<td class="cell_no_borders">
									<input name="text_username" id="text_username" style="width: 20em" type="text" value="<?php echo $_SESSION["account_username"]; ?>"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders"><label for="text_password" id="label_password" >Password: </label></td>
								<td class="cell_no_borders">
									<input type="password" name="text_password" id="text_password" style="width: 20em" value="<?php if (isset($_SESSION["account_password"])) echo $_SESSION["account_password"]; ?>"/>
									<br/><input type="checkbox" id="check_show" onclick="OnClickCheckboxShow(this)" /><label for="textPassword">Show password</label>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;" class="cell_no_borders"><br/><input type="button" id="button_recover" value="I FORGET MY PASSWORD" onclick="OnShowForm('form_recover', 'form_login')"/></td>
								<td style="text-align:right;" class="cell_no_borders"><br/><input type="button" id="submit_login" name="submit_login" value="LOG IN" onclick="OnClickButtonSubmit()"/></td>
							</tr>
						</table>
						<br/><br/>Your password and username will be encrypted when you click the 'login' button.
						<input type="hidden" name="submit_login" value="LOG IN" />
					</form>
					
					<div class="advert" id="advert_login1" style="width:630px;height:240px;">
						<?php DoInsertAdvert("login1", 180, "advert_login1"); ?>
					</div>
					<div class="advert" id="advert_login2" style="width:1250px;height:300px;margin-top:20px;margin-left:0px;margin-right:0px;">
						<?php DoInsertAdvert("login2", 180, "advert_login2"); ?>
					</div>
					
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



				<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
				
				<script type="text/javascript">
										
					function OnClickButtonSubmit()
					{
						let textUsername = DoGetInput("text_username"),
							textPassword = DoGetInput("text_password");
						
						if (textUsername && textPassword)
						{
							textUsername.value = DoEncrypt(textUsername.value);
							textPassword.value = DoEncrypt(textPassword.value);
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
