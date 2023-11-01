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
					<li><a href="login.php">Log In</a></li>
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

<?php
	
	// Array ( [hidden_username] => boylesg [hidden_password] => password [SUBMIT] => tradie_login ) 
	if (isset($_POST["SUBMIT"]) && ($_POST["SUBMIT"] === "tradie_login"))
	{
	}
?>

					<form method="post" id="form_login" class="form" style="width:570px;">
						<table>
							<tr>
								<td><label style="text-align:right;" for="text_username"id="label_username">Username or email address: </label></td>
								<td><input name="text_username" id="text_username" style="width: 20em" type="text" value="<?php if (isset($_POST["hidden_username"])) echo $_POST["hidden_username"]; ?>"/></td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_password" id="label_password" >Password: </label></td>
								<td>
									<input name="text_password" id="text_password" style="width: 20em" type="password"  value="<?php if (isset($_POST["hidden_password"])) echo $_POST["hidden_password"]; ?>"/>
									&nbsp;<input type="checkbox" id="check_show" onclick="OnClickCheckboxShow(this)" /><label for="textPassword">Show password</label>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;"><label for="text_password" id="label_password" >Remember login details: </label></td>
								<td><input name="text_password" id="check_remember" type="checkbox" disabled onclick="OnClickCheckboxRemeber(this)"/></td>
							</tr>
							<tr>
								<td style="text-align:right;" colspan="2"><input type="submit" id="submit_login" name="submit_login" value="Log in"/></td>
							</tr>
						</table>
					</form>
					
					<script type="text/javascript">
						
						function OnClickCheckboxRemeber(checkRemeber)
						{
							if (checkRemeber)
							{
								if (checkRemeber.checked)
								{
									localStorage["login_username"] = "<?php if (isset($_POST["hidden_username"])) echo $_POST["hidden_username"]; ?>";
									localStorage["login_password"] = "<?php if (isset($_POST["hidden_password"])) echo $_POST["hidden_password"]; ?>";
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
						
						let checkRemember = document.getElementById("check_remember"),
							textUsername = document.getElementById("text_password"),
							textPassword = document.getElementById("text_username");
							
						if (checkRemember && textUsername && textPassword)
						{
							checkRemember.disabled = (textUsername.value.length == 0) && (textPassword.value.length == 0);
						}
						
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
