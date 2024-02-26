<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>RENEW MEMBERSHIP</title>
		<link href="styles/paypal_style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<?php 
		
			require_once "../common.php";
			
			$g_strDisplay10 = "none";
			$g_strDisplay80 = "none";
			$g_strDisplay100 = "none";
			
			if (isset($_GET["amount"]))
			{
				if (strcmp($_GET["amount"], "10") == 0)
				{
					$g_strDisplay10 = "block";
					$g_strDisplay80 = "none";
					$g_strDisplay100 = "none";
				}
				else if (strcmp($_GET["amount"], "80") == 0)
				{
					$g_strDisplay10 = "none";
					$g_strDisplay80 = "block";
					$g_strDisplay100 = "none";
				}
				else if (strcmp($_GET["amount"], "100") == 0)
				{
					$g_strDisplay10 = "none";
					$g_strDisplay80 = "none";
					$g_strDisplay100 = "block";
				}
			}
			else if (isset($_GET["paypal"]))
			{
				PrintJavascriptLine("AppInventor.setWebViewString(\"paypal_membership_payment=" . $_GET["paypal"] . "\");", 2, true);
			}
		
		?>
	</head>
	

	<body>
	
		<div id="paypal_live" style="display:<?php echo $g_strPaypalLive; ?>">
				<p style="display:<?php echo $g_strDisplay10;?>">
					<b>$10</b><br/><br/>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="VF7D5V7W4CPJ4" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</p>
				<p style="display:<?php echo $g_strDisplay80;?>">
					<b>$80</b><br/><br/>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="F4FH6AVBNP2YS" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</p>
				<p style="display:<?php echo $g_strDisplay100;?>">
					<b>$100</b><br/><br/>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="78WNB6PA7CP4A" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</p>
		</div>
		
		<div id="paypal_test" style="display:<?php echo $g_strPaypalTest; ?>">
		
			<p style="display:<?php echo $g_strDisplay10;?>">
				<b>$10</b><br/><br/>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="RJ5N5VXSSTGBG" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>
			</p>
			<p style="display:<?php echo $g_strDisplay80;?>">
				<b>$80</b><br/><br/>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="DJKLEWWU3SHHA" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>
			</p>
			<p style="display:<?php echo $g_strDisplay100;?>">
				<b>$100</b><br/><br/>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="W22A5JKGRMJXY" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>				
			</p>
		</div>

	</body>
		
</html>
