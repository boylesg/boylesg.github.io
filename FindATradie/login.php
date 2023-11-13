<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>LOG IN</title>
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
			
			<script type="text/javascript">
			</script>
			
<?php

	$g_strLogin = "block";
	$g_strRecover = "none";
		
	// Processing post data.
	if (isset($_POST["submit_logout"]) && (strlen($_POST["submit_logout"]) > 0))
	{
		$_SESSION["account_id"] = "";
		$_SESSION["account_trade"] = "";
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
	else if (isset($_POST["text_username"]))
	{
		$_SESSION["account_username"] = $_POST["text_username"];
		$_SESSION["account_password"] = $_POST["text_password"];
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
	
	<body onresize="SetPageContetHeight()">
	
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








					<form method="post" id="form_recover" class="form" style="width:380px;display:<?php echo $g_strRecover; ?>;">
						<table>
							<tr>
								<td style="text-align:right;" ><label for="text_recover_surname" id="label_surname">Username: </label></td>
								<td>
									<input name="text_username" id="text_recover_username" style="width: 20em" type="text" value="<?php if (isset($_SESSION["account_username"])) echo $_SESSION["account_username"]; ?>"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_recover_business_name" id="label_business_name" >Business name: </label></td>
								<td>
									<input name="text_business_name" id="text_recover_business_name" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_recover_mobile" id="label_mobile" >Mobile: </label></td>
								<td>
									<input name="text_mobile" id="text_recover_mobile" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;"><br/><input type="button" id="button_login" value="GO TO LOGIN" onclick="OnShowForm('form_login', 'form_recover')"/></td>
								<td style="text-align:right;"><br/><input type="submit" id="submit_recover" name="submit_recover" value="EMAIL REMINDER"/></td>
							</tr>
						</table>
					</form>
					
					<form method="post" id="form_login" class="form" action="account.php" style="width:600px;display:<?php echo $g_strLogin; ?>;">
						<table>
							<tr>
								<td style="text-align:right;"><label for="text_username" id="label_username">Username or email address: </label></td>
								<td>
									<input name="text_username" id="text_username" style="width: 20em" type="text" value="<?php if (isset($_SESSION["account_username"])) echo $_SESSION["account_username"]; ?>"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_password" id="label_password" >Password: </label></td>
								<td>
									<input type="password" name="text_password" id="text_password" style="width: 20em" value="<?php if (isset($_SESSION["account_password"])) echo $_SESSION["account_password"]; ?>"/>
									&nbsp;<input type="checkbox" id="check_show" onclick="OnClickCheckboxShow(this)" /><label for="textPassword">Show password</label>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;"><br/><input type="button" id="button_recover" value="I FORGET MY PASSWORD" onclick="OnShowForm('form_recover', 'form_login')"/></td>
								<td style="text-align:right;"><br/><input type="submit" id="submit_login" name="submit_login" value="LOG IN"/></td>
							</tr>
						</table>
					</form>
					
					<script type="text/javascript">
						
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
		
		<script type="text/javascript">
								
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
