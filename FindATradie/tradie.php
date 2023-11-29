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
		<title>Tradie Details</title>
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
		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.php">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="faq.php">FAQ</a>
					<a class="navigation_link" href="contact.php">Contact</a>
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

		<div class="page_content" id="page_content0">

			<div class="note" style="overflow-x:auto;overflow-y:visible;">
				<?php 
				
					if (isset($_GET["member_id"]))
					{
						$results = DoFindQuery1($g_dbFindATradie, "members", "id", $_GET["member_id"]);
						if ($results && ($results->num_rows > 0))
						{
							$row = $results->fetch_assoc();
							if ($row)
							{
								echo "<div class=\"tradie_details\">\n";
								echo "<b><u>BUSINESS PROFILE</u></b><br/<br/><br/>\n";
								echo "<table cellspacing=\"0\" cellpadding=\"10\" class=\"table_no_borders\" style=\"display:inline-block;width:510px;\">\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Business name:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">" . $row["business_name"] . "</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>ABN:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">" . $row["abn"] . "</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Structure:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">" . $row["structure"] . "</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Name:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">";
								echo $row["first_name"] . " " . $row["surname"] . "<br/><br/>";
								echo "<img src=\"images/" . $row["profile_filename"] . "\" alt=\"images/" . $row["profile_filename"] . "\" width=\"150\" />";
								echo "</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Phone:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">\n";
								if ($row["phone"] && ($row["phone"] != ""))
									echo $row["phone"] . "\n";
								echo "		</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Mobile:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">";
								if ($row["mobile"] && ($row["mobile"] != ""))
									echo $row["mobile"] . "\n";
								echo "		</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Email:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">";
								if ($row["email"] && ($row["email"] != ""))
									echo $row["email"];
								echo "		</td>\n";
								echo "	</tr>\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Location:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">" . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"] . "</td>\n";
								echo "	</tr>\n";
								echo "</table>\n";
								if ($row["logo_filename"] && ($row["logo_filename"] != ""))
								{
									echo "<img class=\"advert_image\" style=\"float:right;\" width=\"250\" src=\"images/" . $row["logo_filename"] . "\" alt=\"images/" . $row["logo_filename"] . "\" />\n";
								}
								echo "</div>\n";
								echo "<div class=\"tradie_about\">\n";
								echo "<b><u>TRADES</u></b><br/>\n";
								echo "<b>Primary trade: </b>" . GetTradeName($row["trade_id"]) . "<br/<br/>\n";
								echo "<b>Additional trades: </b>";
								echo GetAdditionalTradeNames($row["id"]) . "<br/><br/>\n";
								
								if ($row["license"] && ($row["license"] != ""))
								{
									echo "<b><u>BUSINESS LICENSES & PROFESSIONAL MEMBERSHIPS</u></b><br/>\n";
									echo RelaceCRLF($row["license"]);
									echo "<br/><br/>";
								}
								if ($row["description"] && ($row["description"] != ""))
								{
									echo "<b><u>ABOUT THE BUSINESS</u></b><br/>\n";
									echo RelaceCRLF($row["description"]);
									echo "<br/>";
								}
								echo "</div>\n";
								echo "<div class=\"tradie_feedback\">\n";
								echo "<b><u>FEEDBACK</u></b>\n";
								DoDisplayFeedback($row["id"], "", false);
								echo "</div>\n";
							}
						}
					}
				?>
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



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
