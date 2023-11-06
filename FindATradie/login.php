<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>LOG IN</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
		<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<script src="common.js"></script>
		<script src="AustraliaPost.js"></script>
		<!-- #BeginEditable "page_styles" -->
			<style>
			</style>
		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Container -->
		<div class="container" id="container">
			<!-- Begin Masthead -->
			<div class="masthead" id="masthead">
				<img class="logo" alt="" src="images/Tradie.png" width="90" />
				<div class="web_title_container" id="web_title_container">
					<div class="web_name" id="web_name">
						Find a Tradie<br/>
					</div>
					<div class="web_tag_line">
						Gardener, landscaper, electrician, plumber, builder, carpenter, plasterer, painter &amp; more
					</div>
				</div>
				<img class="trades_image" src="images/Tools.png" alt="images/Tools.png"/>
			</div>
			<!-- End Masthead -->
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="new_tradie.php">New Tradie</a></li>
					<li><a href="new_customer.html">New Customer</a></li>
					<script type="text/javascript">
						if ((localStorage['account_username'] !== "") || (sessionStorage['account_username'] !== ""))
							document.write("<li><a href=\"account.php\">Account</a></li>");
						else
							document.write("<li><a href=\"login.php\">Login</a></li>");
					</script>
					<li><a href="compare.html">Compare</a></li>
					<li><a href="contact.html">FAQ</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
			<!-- End Navigation -->
			<!-- Begin Page Content -->
			<div class="page_content" id="page_content">
				<h1><u><script type="text/javascript">document.write(document.title);</script></u></h1>				
					<!-- #BeginEditable "content" -->








<?php

	function DoDebugPostData()
	{
		$_POST["hidden_new_tradie"] = "new_tradie";
		$_POST["hidden_username"] = "boylesg";
		$_POST["hidden_password"] = "password";
	}
	if (!isset($_POST["submit_login"]))
	{
		DoDebugPostData();
	}
	
	
	
	
	
	
	
	
	$_POST["hidden_new_tradie"] = "XXXXX";
	
	
	
	
	
	
	
	
	
	$g_strUsername = "";
	$g_strPassword = "";
	$g_strLogin = "block";
	$g_strRecover = "none";
		
	// Array ( [hidden_username] => boylesg [hidden_password] => password [SUBMIT] => tradie_login ) 
	if (isset($_POST["hidden_new_member"]) && ($_POST["hidden_new_member"] === "new_member"))
	{
		$g_strUsername = $_POST["hidden_username"];
		$g_strPassword = $_POST["hidden_password"];
	}
	else if (isset($_POST["submit_login"]))
	{
		$strQuery = "SELECT * FROM members WHERE username='" . $_POST["text_username"] . "' OR email='" . $_POST["text_username"] . "' AND password='" . $_POST["text_password"] . "'";
		$result = DoQuery($g_dbFindATradie, $strQuery);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			PrintSpaces(3);
			echo "<script type=\"text/javascript\">";
			PrintSpaces(6);
			echo "sessionStorage['account_type'] = '" . $_POST["hidden_account_type"] . "';\n";
			PrintSpaces(6);
			echo "sessionStorage['account_username'] = '" . $_POST["text_username"] . "';\n";
			PrintSpaces(6);
			echo "sessionStorage['account_password'] = '" . $_POST["text_password"] . "';\n";
			PrintSpaces(6);
			echo  "document.location = 'account.php';";
			PrintSpaces(3);
			echo "</script>";
						
			$_SESSION["account_id"] = $row["id"];
			$_SESSION["account_trade"] = $row["trade"];
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
		}
		else
		{
			PrintSpaces(4);
			echo "<script type=\"text/javascript\">";
			PrintSpaces(6);
			echo "alert('ERROR: incorrect password!');\n";
			PrintSpaces(4);
			echo "</script>";
		}
	}
	else if (isset($_POST["submit_recover"]))
	{
		$result = DoFindQuery3($g_dbFindATradie, "members", "username", $_POST["text_username"], "business_name", $_POST["text_business_name"], "mobile", $_POST["text_mobile"]);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			mail($row["email"], "Username and pass word recovery at FindATradie", "Username: " . $row["username"] . "%0D%0APassword: " . $row["password"] . "%0D%0A");			
			PrintSpaces(3);
			echo "<script type=\"text/javascript\">";
			PrintSpaces(6);
			echo "alert('Your username and password have been emailed to " . $row["email"] . "');\n";
			PrintSpaces(3);
			echo "</script>";
		}
		else
		{
			PrintSpaces(3);
			echo "<script type=\"text/javascript\">\n";
			PrintSpaces(6);
			echo "alert(\"Account with username '" . $_POST["text_username"] . "', business name '" . $_POST["text_business_name"] . "' and mobile '" . $_POST["text_mobile"] . "' was not found!\");\n";
			PrintSpaces(3);
			echo "</script>";
			$g_strLogin = "none";
			$g_strRecover = "block";
		}
	}

?>
					<form method="post" id="form_recover" class="form" style="width:380px;display:<?php echo $g_strRecover; ?>;">
						<table>
							<tr>
								<td style="text-align:right;" ><label for="text_surname" id="label_surname">Username: </label></td>
								<td>
									<input name="text_username" id="text_username" style="width: 20em" type="text" value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_business_name" id="label_business_name" >Business name: </label></td>
								<td>
									<input name="text_business_name" id="text_business_name" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_mobile" id="label_mobile" >Mobile: </label></td>
								<td>
									<input name="text_mobile" id="text_mobile" style="width: 20em" type="text"  value=""/>
								</td>
							</tr>
							<tr>
								<td style="text-align:left;"><br/><input type="button" id="button_login" value="GO TO LOGIN" onclick="OnShowForm('form_login', 'form_recover')"/></td>
								<td style="text-align:right;"><br/><input type="submit" id="submit_recover" name="submit_recover" value="EMAIL REMINDER"/></td>
							</tr>
						</table>
					</form>
					
					<form method="post" id="form_login" class="form" style="width:570px;display:<?php echo $g_strLogin; ?>;">
						<table>
							<tr>
								<td style="text-align:right;"><label for="text_username"id="label_username">Username or email address: </label></td>
								<td>
									<input name="text_username" id="text_username0" style="width: 20em" type="text" value="<?php echo $g_strUsername; ?>"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_password" id="label_password" >Password: </label></td>
								<td>
									<input name="text_password" id="text_password" style="width: 20em" type="password"  value="<?php echo $g_strPassword; ?>"/>
									&nbsp;<input type="checkbox" id="check_show" onclick="OnClickCheckboxShow(this)" /><label for="textPassword">Show password</label>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">
								<label for="text_password" id="label_stay" >Stay pogged in: </label></td>
								<td><input name="text_password" id="check_remember" type="checkbox" onclick="OnClickCheckboxRemeber(this)"/></td>
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
						
						function OnClickCheckboxRemeber(checkRemeber)
						{
							if (checkRemeber)
							{
								if (checkRemeber.checked)
								{
									localStorage["account_type"] = sessionStorage["account_type"];
									localStorage["account_username"] = sessionStorage["account_username"];
									localStorage["account_password"] = sessionStorage["account_password"];
								}
								else
								{
									localStorage["account_type"] = "";
									localStorage["account_username"] = "";
									localStorage["account_password"] = "";
								}
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
						
						function SetUsernamePassword()
						{
							let inputUsername = document.getElementById("text_username"),
								inputPassword = document.getElementById("text_password");
								
							if (inputUsername && inputUsername)
							{
								if (inputUsername.value.length == 0)
									inputUsername.value = localStorage["login_username"];
								if (inputPassword.value.length == 0)
									inputPassword.value = localStorage["login_password"];
							}
						}
						SetUsernamePassword();
												
					</script>					








					<!-- #EndEditable -->
			<!-- End Page Content -->
			</div>
			<!-- Begin Footer -->
			<div class="footer">
				<p>
					<a href="index.html">Home</a> | 
					<a href="new_tradie.php">New Tradie</a> | 
					<a href="new_customer.html">New Customer</a> | 
					<script type="text/javascript">
						if ((localStorage['account_username'] !== "") || (sessionStorage['account_username'] !== ""))
							document.write("<a href=\"account.php\">Account</a>");
						else
							document.write("<a href=\"login.php\">Login</a>");
					</script> | 
					<a href="about.html">About</a> | 
					<a href="compare.html">Compare</a> | 
					<a href="faq.html">FAQ</a> | 
					<a href="contact.html">Contact</a>
					<span style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
				</p>
			</div>
			<!-- End Footer --></div>
		<!-- End Container -->
	
	</body>
	
<!-- #EndTemplate -->
	
</html>
