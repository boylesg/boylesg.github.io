<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>RENEW MEMBERSHIP</title>
		<link href="styles/paypal_style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<?php include "../common.php"; ?>
	</head>

	<body>
	
		<div id="paypal_live" style="display:<?php echo $g_strPaypalLive; ?>">
			<table cellpadding="50" cellspacing="0" border="1">
				<tr>
					<td><b>Renew for 1 month</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth); ?></td>
					<td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="ML57FQAQM8FBY" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 6 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 6); ?></td>
					<td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="MSH56S2JA7R9Y" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 12 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 12); ?></td>
					<td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="7MXQ5HRMGLC3N" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 18 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 18); ?></td>
					<td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="B4HP8BQ4VE3QY" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 24 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 24); ?></td>
					<td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="WNJ2DTPLE2V2W" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
			</table>
		</div>
		
		<div id="paypal_test" style="display:<?php echo $g_strPaypalTest; ?>">
		
			<table cellpadding="50" cellspacing="0" border="1">
				<tr>
					<td><b>Renew for 1 month</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth); ?></td>
					<td>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="YBHPW5W868SCA" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 6 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 6); ?></td>
					<td>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="NYX3H2YG5WXL4" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 12 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 12); ?></td>
					<td>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="YZ38VG9ZEQ28C" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 18 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 18); ?></td>
					<td>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="RMJTTK3XZUSNS" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>
				<tr>
					<td><b>Renew for 24 months</b></td>
					<td>$<?php echo sprintf("%02d", $g_nCostPerMonth * 24); ?></td>
					<td>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="hosted_button_id" value="7RZP99QBSCDTY" />
							<input type="hidden" name="currency_code" value="AUD" />
							<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
						</form>
					</td>
				</tr>

			</table>
			
		</div>

	</body>
	
	<?php
		
		if (isset($_GET["paypal"]))
		{
			PrintJavascriptLine("AppInventor.setWebViewString(paypal_membership_payment=" . $_GET["paypal"] . ");", 2, true);
		}
	
	?>
	
</html>
