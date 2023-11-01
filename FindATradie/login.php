<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>LOG IN</title>
		<!-- #EndEditable -->
		<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<script src="common.js"></script>
		<script src="AustraliaPost.js"></script>
		<!-- #BeginEditable "page_styles" -->
			<style>
</style>
		<!-- #EndEditable -->
		
		<?php include "common.php"; ?>
		
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
					<li><a href="home.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="new_tradie.php">New Tradie</a></li>
					<li><a href="new_customer.html">New Customer</a></li>
					<script type="text/javascript">
						if (sessionStorage['account_type'] !== "")
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
			<div class="page_content">
				<h1><u><script type="text/javascript">document.write(document.title);</script></u></h1>				
					<!-- #BeginEditable "content" -->








					<script type="text/javascript">		
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
		
	// Array ( [hidden_username] => boylesg [hidden_password] => password [SUBMIT] => tradie_login ) 
	if (isset($_POST["hidden_new_tradie"]) && ($_POST["hidden_new_tradie"] === "new_tradie"))
	{
		$g_strUsername = $_POST["hidden_username"];
		$g_strPassword = $_POST["hidden_password"];
	}
	else if (isset($_POST["submit_login"]))
	{
		$result = DoFindQuery2($g_dbFindATradie, "members", "username", $_POST["text_username"], "password", $_POST["text_password"]);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			PrintSpaces(6);
			echo "sessionStorage['account_type'] = '" . $_POST["hidden_account_type"] . "';\n";
			PrintSpaces(6);
			echo "sessionStorage['account_username'] = '" . $_POST["text_username"] . "';\n";
			PrintSpaces(6);
			echo "sessionStorage['account_password'] = '" . $_POST["text_password"] . "';\n";
			PrintSpaces(6);
			echo  "document.location = 'account.php';";
		}
	}
?>

					</script>
			
					<form method="post" id="form_login" class="form" style="width:570px;">
						<table>
							<tr>
								<td><label style="text-align:right;" for="text_username"id="label_username">Username or email address: </label></td>
								<td>
									<input name="text_username" id="text_username" style="width: 20em" type="text" value="<?php echo $g_strUsername; ?>"/>
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
								<label for="text_password" id="label_password0" >Remember login details: </label></td>
								<td><input name="text_password" id="check_remember" type="checkbox" onclick="OnClickCheckboxRemeber(this)"/></td>
							</tr>
							<tr>
								<td style="text-align:right;" colspan="2"><input type="submit" id="submit_login" name="submit_login" value="LOG IN"/></td>
							</tr>
						</table>
						<input type="hidden" id="hidden_account_type" name="hidden_account_type" value="<?php if (isset($_POST["hidden_new_tradie"])) echo "tradie"; ?>"/>
					</form>
					
					<script type="text/javascript">
						
						function OnClickCheckboxRemeber(checkRemeber)
						{
							if (checkRemeber)
							{
								if (checkRemeber.checked)
								{
									localStorage["login_username"] = document.getElementById("text_username").value;
									localStorage["login_password"] = document.getElementById("text_password").value;
								}
								else
								{
									localStorage["login_username"] = "";
									localStorage["login_password"] = "";
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
					<a href="home.html">Home</a> | 
					<a href="new_tradie.php">New Tradie</a> | 
					<a href="new_customer.html">New Customer</a> | 
					<a href="login.php">Log In</a> | 
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
