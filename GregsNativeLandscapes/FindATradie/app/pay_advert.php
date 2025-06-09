<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>RENEW MEMBERSHIP</title>
		<link href="styles/paypal_style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<style>
		
			.price
			{
				margin-left: 22px;
				margin-bottom: 20px;
				font-weight: bold;
				font-size: xx-large;
			}
			
		</style>
		<?php 
		
			require_once "../common.php";
			
			$g_strDisplayPriceLevel1 = "none";
			$g_strDisplayPriceLevel2 = "none";
			$g_strDisplayPriceLevel3 = "none";
			$g_strDisplayPriceLevel4 = "none";
			
			if (isset($_GET["amount"]))
			{
				if (strcmp($_GET["amount"], $g_strPriceLevel1) == 0)
				{
					$g_strDisplayPriceLevel1 = "block";
				}
				else if (strcmp($_GET["amount"], $g_strPriceLevel2) == 0)
				{
					$g_strDisplayPriceLevel2 = "block";
				}
				else if (strcmp($_GET["amount"], $g_strPriceLevel3) == 0)
				{
					$g_strDisplayPriceLevel3 = "block";
				}
				else if (strcmp($_GET["amount"], $g_strPriceLevel4) == 0)
				{
					$g_strDisplayPriceLevel4 = "block";
				}
				else
				{
					print_r($_GET);
				}
			}
			else if (isset($_GET["paypal_advert_payment"]))
			{
				PrintJavascriptLine("AppInventor.setWebViewString(\"paypal_advert_payment=" . $_GET["paypal_advert_payment"] . "\");", 2, true);
			}
		
		?>
	</head>
	

	<body>

		<div id="paypal_live" style="display:<?php echo $g_strPaypalLive; ?>">
		
				<div style="display:<?php echo $g_strDisplayPriceLevel1;?>;">
					<div class="price"><b>$<?php echo $g_strPriceLevel1; ?> for 12 months</b></div>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="VF7D5V7W4CPJ4" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				<div style="display:<?php echo $g_strDisplayPriceLevel2;?>;">
					<div  class="price"><b>$<?php echo $g_strPriceLevel2; ?> for 12 months</b></div>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="F4FH6AVBNP2YS" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</div>
				<div style="display:<?php echo $g_strDisplayPriceLevel3;?>;">
					<div  class="price"><b>$<?php echo $g_strPriceLevel3; ?> for 12 months</b></div>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="78WNB6PA7CP4A" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</div>
				<div style="display:<?php echo $g_strDisplayPriceLevel4;?>;">
					<div  class="price"><b>$<?php echo $g_strPriceLevel4; ?> for 12 months</b></div>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="TWZN6KQ34TCKQ" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>			
				</div>				
		</div>
		
		<div id="paypal_test" style="display:<?php echo $g_strPaypalTest; ?>">
		
			<div style="display:<?php echo $g_strDisplayPriceLevel1;?>;">
				<div  class="price"><b>$<?php echo $g_strPriceLevel1; ?> for 12 months</b></div>
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="hosted_button_id" value="EKGLAFJNPTZJQ" />
						<input type="hidden" name="currency_code" value="AUD" />
						<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
					</form>
				</div>
			<div style="display:<?php echo $g_strDisplayPriceLevel2;?>;">
				<div  class="price"><b>$<?php echo $g_strPriceLevel2; ?> for 12 months</b></div>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="DJKLEWWU3SHHA" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>
			</div>
			<div style="display:<?php echo $g_strDisplayPriceLevel3;?>;">
				<div  class="price"><b>$<?php echo $g_strPriceLevel3; ?> for 12 months</b></div>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="W22A5JKGRMJXY" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>				
			</div>
			<div style="display:<?php echo $g_strDisplayPriceLevel4;?>;"></div>
			<div  class="price"><b>$<?php echo $g_strPriceLevel4; ?> for 12 months</b></div>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="RJ5N5VXSSTGBG" />
					<input type="hidden" name="currency_code" value="AUD" />
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
				</form>					
			</div>

		</div>

	</body>
		
</html>
