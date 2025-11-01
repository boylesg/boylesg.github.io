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
	
		<?php
			/**/
			$_POST["given_names"] = "Fred";
			$_POST["surname"] = "Smith";
			$_POST["amount"] = "100";
			/**/
			require "common.php";
			print_r($_POST);
			DoUpdateQuery2($g_dbMillhouse, "millhouse_db.donations", "given_names", $_POST["given_names"], "surname", 
							$_POST["surname"], "shortkey", $_POST["shortkey"]);

			function DoGetAmountInWords($fAmount)
			{
				$formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
				return $formatter->format($fAmount);
			}
			
		?>
		<p>
			Thank you <?php echo $_POST["given_names"] . " " . $_POST["surname"]; ?> for your contribution of 
			<?php echo DoGetAmountInWords($_POST["amount"]); ?> dollars ($<?php echo $_POST["amount"]; ?>)
		</p>
		<p><input type="button" value="PRINT" id="print_receipt" onclick="window.print()" /></p>
		
	</body>

</html>
