<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>Receipt</title>
		<style>
			@media print 
			{
        		#print_receipt 
        		{
            		display: none; /* Hides the button when printing */
        		}

   			}

			h1,h2,h3,h4,h5,h6
			{
				font-family: Arial, Helvetica, sans-serif;
			  	font-weight: bold;
				color: black;
			}
			p
			{
				font-family: Arial, Helvetica, sans-serif;
				color: black;
				font-size: large;
			}
			h1
			{
				font-size: xx-large;
			}
			h2
			{
				font-size: x-large;
			}
			h3
			{
				font-size: large;
			}
			h4
			{
				font-size: medium;
			}
			h5
			{
				font-size: x-small;
			}
			h6
			{
				font-size: xx-small;
			}

		</style>
	</head>
	
	<body>
	
		
		<img alt="Logo.jpg" src="images/Logo.jpg" width="400" />
	
		<h1>DONATION RECEIPT</h1>
	
		<p><b>Date:</b> <?php echo date("l j F Y"); ?></p>
		<p><b>Organization Name:</b> Millhouse – Neighborhood House</p>
		<p><b>Street Address:</b> 88-90 Burke Street</p>
		<p><b>City:</b> Maryborough</p>
		<p><b>State:</b> VIC</p>
		<p><b>Postcode:</b> 3465</p>
		<p><b>ABN:</b> 59 149 634 975</p>
		<p><b>Payment method:</b> <img src="images/PayPalLogo.png" alt="PayPalLogo.png" height="15" /></p>
		<p><b><u>DONOR DETAILS</u></b></p>
		<p><b>Name: </b><?php echo $_POST["given_names"] . " " . $_POST["surname"]; ?></p>
		<p><b>Email: </b><?php echo $_POST["email"]; ?></p>
		<p><b>Phone: </b><?php echo $_POST["phone"]; ?></p>

		<?php
			/*
			$_POST["given_names"] = "Fred";
			$_POST["surname"] = "Smith";
			$_POST["amount"] = "100";
			*/
			require "common.php";
			
			DoUpdateQuery4($g_dbMillhouse, "millhouse_db.donations", "given_names", $_POST["given_names"], "surname", 
							$_POST["surname"], "email", $_POST["email"], "phone", $_POST["phone"], "shortkey", $_POST["shortkey"]);

			function DoGetAmountInWords($fAmount)
			{
				$formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
				return $formatter->format($fAmount);
			}
			
		?>
		<hr/>
		<p style="font-size:large;">
			Thank you <?php echo $_POST["given_names"] . " " . $_POST["surname"]; ?> so much for your generous 
			contribution of 
			<?php echo DoGetAmountInWords($_POST["amount"]); ?> dollars ($<?php echo $_POST["amount"]; ?>) to 
			Millhouse. We are very grateful for your support.
		</p>
		<p>
			Your contribution will help us to build a supportive community of towns in the central goldields region of 
			Victoria. And to provide a place for people to meet, share interests, share a meal, make friends and get 
			help.
		</p>
		<hr/>
		<p><input type="button" value="PRINT" id="print_receipt" onclick="window.print()" /></p>
		
	</body>

</html>
