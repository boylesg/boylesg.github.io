<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<!-- #BeginTemplate "master.dwt" -->

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Home</title>
		<!-- #EndEditable -->
		<!-- #BeginEditable CustomStyles -->
		
		<?php require "common.php"; ?>
		
		<style>
		</style>
			
		<!-- # EndEditable -->
		<link href="styles/style4PC.css" rel="stylesheet" type="text/css" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@100..900&family=Permanent+Marker&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J:ital,wght@0,100..400;1,100..400&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />
	</head>
	<body>

		<!-- Begin Container -->
		<div id="container">
			<!-- Begin Masthead -->
			<div class="masthead">
				<div class="masthead_image" style="float:left;">
					<a href="..images/MillHouse.jpg"><img src="../images/MillHouse.jpg" alt="" height="110"/></a>
				</div>
				<div class="masthead_text">
					<h1 class="gluten">MillHouse</h1>
					<h3 class="gluten">Neighbourhood House</h3>
				</div>
				<div class="masthead_image" style="float:right;">
					<a href="..images/OldKnittingMill.jpg"><img src="../images/OldKnittingMill.jpg" alt="" height="110"/></a>
				</div>
				<div class="masthead_image" style="float:right;">
					<a href="..images/KnittingMill1961.jpg"><img src="../images/KnittingMill1961.jpg" alt="" height="110"/></a>
				</div>
			</div>
			
			<!-- End Masthead -->
			<div class="below_masthead">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td style="vertical-align:top;">
							<!-- Begin Navigation -->
							<div class="navigation">
								<ul>
									<li><a href="donation.php">Home</a></li>
									<li><a href="site_history/site_history.html">Site History</a></li>
									<li><a href="people/people.html">Millhouse People</a></li>
									<li><a href="Calendar/Calendar.html">Calendar</a></li>
									<li><a href="photos/photos.html">Photos</a></li>
									<li><a href="information/information.html">Information</a></li>
									<li><a href="events/events.php">Events</a></li>
									<li><a href="coder_dojo/CoderDojo.html">CoderDojo</a></li>
									<li><a href="contact/Contact.php">Contact</a></li>
								</ul>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>
							<!-- End Navigation -->
						</td>
						<td style="vertical-align:top;">
							<!-- Begin Content -->
							<div class="content">
								<h1 class="page_heading gluten"><u><script type="text/javascript">document.write(document.title);</script></u></h1>
																
								<!-- #BeginEditable "content" -->
			
								<?php
								
									//*****************************************************************************************
									//
									// FROM PAYPAL
									// ------------
									//
									// $_GET - COMPLETION
									// 		[tx] => 6GU84877K8518040D 
									//		[st] => Completed 
									//		[amt] => 100.00 
									//		[cc] => AUD [cm] => 
									//		[item_number] => 
									//		[item_name] => Like-minded locals, from all walks of life, come together with their neighbours at Mill 
									//						House. )
									//
									// $_GET - CANCELLATION
									//		EMPTY
									//******************************************************************************************
									$_GET["amt"] = 100;
									//unset($_SESSION["donation_added"]);
									
									$date = new DateTime(); 

									// MySQL datetime format: 2025-11-01 21:53:00
									if (!isset($_SESSION["donation_added"]) && 
										DoInsertQuery4($g_dbMillhouse, "millhouse_db.donations", "given_names", 
													"", "surname", "", "amount", $_GET["amt"], 
													"date", $date->format("Y-m-d G:i:s")))
									{
										$_SESSION["donation_added"] = true;
									}
													
									function DoGetLastShortkey()
									{
										$nShortkey = 0;
										$row = DoGetLastInserted("millhouse_db.donations", "shortkey");
						
										if ($row)
										{
											$nShortkey = $row["shortkey"];
										}
										return $nShortkey;
									}

									DoGetLastShortkey();

								?>	
								<h1>Thankyou for your donation of $<?php if (isset($_GET["amt"])) echo $_GET["amt"]; else echo "0" ?></h1>
								<p>If require a receipt then please fill out the form below and click the button...</p>
								<form method="post" action="receipt.php" target="_self" class="form">
									<table border="0" cellpadding="5" cellspacing="0">
										<tr>
											<td style="text-align:right"><label for="given_names">Given names:</label></td>
											<td><input type="text" id="given_names" name="given_names"/></td>
										</tr>
										<tr>
											<td style="text-align:right"><label for="surname">Surname:</label></td>
											<td><input type="text" id="surname" name="surname"/></td>
										</tr>
										<tr>
											<td style="text-align:right"><label for="amount">Amount donated:</label></td>
											<td>$<input type="text" id="amount" name="amount" readonly value="<?php if (isset($_GET["amt"])) echo $_GET["amt"]; ?>" /></td>
										</tr>
										<tr>
											<td  style="text-align:right" colspan="2"><input type="submit" id="submit" name="submit" style="width:180px;" value="GENERATE RECEIPT" /></td>
										</tr>
									</table>
									<input type="hidden" name="shortkey" value="<?php echo DoGetLastShortkey(); ?>" />
								</form>	
			
								<!-- #EndEditable "content" --></div>
							<!-- End Content -->
						</td>
					</tr>
				</table>
			</div>
			<!-- Begin Footer -->
			<div class="footer">
				<div class="footer_navigation">
					<a href="donation.php">Home</a> | 
					<a href="site_history/site_history.html">Site History</a> | 
					<a href="Calendar/Calendar.html">Calendar</a> | 
					<a href="photos/photos.html">Photos</a> |
					<a href="information/information.html">Information</a> |
					<a href="events/events.php">Events</a> |
					<a href="coder_dojo/CoderDojo.html">CoderDojo</a> | 
					<a href="contact/Contact.php">Contact</a>
				</div>
				<div class="footer_attribution">
					<b>Web site by: </b> Gregary Boyles 2025<br/>
					<b>Email: </b><script type="text/javascript">document.write("gregplants" + "@" + "bigpond" + "." + "com");</script>
				</div>
			</div>
			<!-- End Footer --></div>
		<!-- End Container -->
		
	</body>

<!-- #EndTemplate -->

</html>
