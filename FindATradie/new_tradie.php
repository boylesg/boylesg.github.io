<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>NEW TRADIE</title>
		<!-- #EndEditable -->
		<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<script src="common.js"></script>
		<script src="AustraliaPost.js"></script>
		<!-- #BeginEditable "page_styles" -->
			<style>
			
				.trade_table_cell
				{
					line-height:2em;
					height:2em;
					vertical-align:middle;
					padding-left:1em;
					padding-right:1em;
				}
				
				.form_trade
				{
					width:80em;
				}
												
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
					<li><a href="login.html">Log In</a></li>
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
						
						//*******************************************************************************************
						//*******************************************************************************************
						//* 
						//* HTML gneration functions
						//* 
						//*******************************************************************************************
						//*******************************************************************************************
						
						function DoGenerateTradesRadioButtons()
						{	
							global $g_dbFindATradie;
							$strChecked = "checked"; 
							 
							$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
							
							while ($row = $queryResult->fetch_assoc())
						    {
								echo "<tr>";
								echo "<td style=\"text-align:right;width:1px;\" class=\"trade_table_cell\"><input type=\"radio\" name=\"trade\" id=\"" . $row["id"] . "\" " . $strChecked . "\" onblur=\"OnClickTradesRadio(this)\" /></td>";
								echo "<td style=\"text-align:left;width:20em;\" class=\"trade_table_cell\">" . strtoupper($row["name"][0]) . substr($row["name"], 1) ."</td>";
								echo "<td colspan=\"2\" style=\"text-align:left;\" class=\"trade_table_cell\"><label>" . $row["description"] . "</label></td>";
								$strChecked = "";		
						    }
						    $queryResult->free_result();
						}
					
					
					
					
						function DoGenerateAdditionalTradesCheckBoxes()
						{	
							global $g_dbFindATradie;
							$nCount = 0;
							$nNumCols = 20;
							 
							$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
							
							while ($row = $queryResult->fetch_assoc())
						    {
						    	if (($nCount == 0) || (($nCount % $nNumCols) == 0))
						    		echo "<td>";
								echo "<input type=\"checkbox\" id=\"check_" . $row["name"] . "\" name=\"" . $row["name"] . "(" . $row["id"] . ")\" onclick=\"OnClickTradesCheck(this)\" />";
								echo "<label>" . $row["name"] . "</label><br/>";	
					    		$nCount++;
						    	if (($nCount % $nNumCols) == 0)
						    	{
						    		echo "<td>";
						    		$nCount = 0;
						    	}
						    }
						    $queryResult->free_result();
						}
						
						
						
						
						//*******************************************************************************************
						//*******************************************************************************************
						//* 
						//* Form data processing functions
						//* 
						//*******************************************************************************************
						//*******************************************************************************************
						
						echo $_POST;
						
					?>
					<div id="trade" style="display:none;">
						<h2>What is your primary trade?</h2>
						<form id="form_select_trade" class="form form_trade">
							<table border="0" style="width:100%;">
								<!--<script type="text/javascript">DoGenerateTradesRadioButtons();</script>-->
			
								<?php DoGenerateTradesRadioButtons(); ?>

								<tr>
									<td style="text-align:left;" colspan="3">
										<hr/>
										Request another trade<br/><br/>
										<label>Name</label><br/>
										<input type="text" id="text_trade_name" name="trade name" size="64" /><br/><br/>
										<label>Description</label><br/>
										<textarea id="text_trade_description" name="trade description" cols="64" rows="3"></textarea><br/><br/>
										<input type="button" id="button_new_trade" onclick="OnclickButtonNewTrade()" value="Finished Editing"/>&nbsp;&nbsp;
										<a style="visibility:hidden;" id="email_new_trade" href="">Email new trade request</a>
										<hr/>
									</td>
								</tr>
								<tr>
									<td colspan="3"><b><u>Any sdditional trades your are qualified in.</u></b></td>
								</tr>
								<tr>
									<td colspan="3" style="text-align::left;">
										<table border="0" style="width:100%;">
											<tr>
												<?php DoGenerateAdditionalTradesCheckBoxes(); ?>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="3" style="text-align:right;"><br/><input type="button" value="Next" class="next_button" onclick="DoNext('trade', 'business_details', 'form_select_trade')"/></td>
								</tr>
							</table>
						</form>
					</div>
					
					<div id="business_details" style="display:none;">
						<h2>Details about your business</h2>
						<form id="form_business_details" class="form form_trade" style="width:55em;">
							<table>
								<tr>
									<td colspan="2"><b><u>Business details</u></b></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Business name</b></td>
									<td><input type="text" id="name" size="32" name="business name" pattern="[0-9,a-z,A-Z,-,',&]{5}" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>ABN</b></td>
									<td><input type="text" id="abn" size="32" name="ABN" pattern="^[1-9]{2}\s[0-9]{3}\s[0-9]{3}\s[0-9]{3}$"/>&nbsp;&nbsp;<label>e.g. 51 824 753 556</label></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Business structure</b></td>
									<td>
										<select id="structure" name="structure">
											<option selected>Sole trader</option>
											<option>Company</option>
											<option>Cooperative</option>
											<option>Partnership</option>
											<option>Indigenous corporation</option>
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Trade license &amp; professional membership details</b></td>
									<td style="text-align:left;"><textarea id="license" name="Trade licenses & professional memberships" cols="64" rows="4"></textarea></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Description of business &amp; services</b></td>
									<td style="text-align:left;"><textarea id="Trade license & professional membership details" name="Description of business & services" cols="64" rows="16" pattern="[0-9,a-z,A-Z,-,',&]{20}"></textarea></td>
								</tr>
								<tr>
									<td colspan="2"><b><u>Job preferences</u></b></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Minimum charge $</b></td>
									<td style="text-align:left;"><input type="text" id="minimum_charge" size="8" name="minimum charge" pattern="^[1-9]\d*(\.\d+)?$" value="100"/></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Minimum preferred budget $</b></td>
									<td style="text-align:left;"><input type="text" id="minimum_budget" size="8" name="minimum_budget" pattern="^[1-9]\d*(\.\d+)?$" value="5000"/></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Minimum preferred job size</b></td>
									<td style="text-align:left;">
										<select id="minimum_size" name="minimum_size">
											<option selected>Up to 50</option>
											<option>50 - 100</option>
											<option>100 - 250</option>
											<option>250 - 500</option>
											<option>More than 500</option>
										</select>
										<b>m<sup>2</sup></b>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Maximum distance you will travel</b></td>
									<td style="text-align:left;"><input type="text" id="maximum_distance" name="maximum distance" size="8" pattern="^[0-9]\d*(\.\d+)?$" value="20" style="text-align:right" />&nbsp;<b>km</b></td>
								</tr>
								<tr>
									<td style="text-align:left;"><br/><input type="button" value="Previous" class="next_button" onclick="DoNext('business_details', 'trade', '')"/></td>
									<td style="text-align:right;"><br/><input type="button" value="Next" class="next_button" onclick="DoNext('business_details', 'business_contact', 'form_business_details')"/></td>
								</tr>
							</table>
						</form>					
					</div>

					<div id="business_contact" style="display:none;">
						<h2>Business contact details</h2>
						<form id="form_business_contact" class="form" style="width:30em;">
							<table>
								<tr>
									<td style="text-align:right;"><b>Unit</b></td>
									<td style="text-align:left;"><input type="text" id="unit" name="unit" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Street</b></td>
									<td><textarea id="street" name="street" cols="32" rows="2"></textarea></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>City, suburb or town</b></td>
									<td style="text-align:left;">
										<select id="suburb" name="city/suburb/town" style="width:18em;" onchange="OnChangeSuburb(this, document.getElementById('postcode'), document.getElementById('state'))">
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>State</b></td>
									<td style="text-align:left;">
										<select id="state" name="state" onchange="OnChangeState(this, document.getElementById('suburb'), document.getElementById('postcode'))">
											<option selected=>ACT</option>
											<option>NSW</option>
											<option>NT</option>
											<option>QLD</option>
											<option>SA</option>
											<option>TAS</option>
											<option>VIC</option>
											<option>WA</option>
										</select>
									
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Postcode</b></td>
									<td style="text-align:left;">
										<select id="postcode" name="postcode" onchange="OnChangePostcode(this, document.getElementById('suburb'), document.getElementById('state'))">
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Office phone number</b></td>
									<td style="text-align:left;"><input type="text"  id="phone" name="office phone number" pattern="^[0-9]{8}$" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Mobile number</b></td>
									<td style="text-align:left;"><input type="text"  id="mobile" name="mobile number" pattern="^[0-9]{10}$" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Email address</b></td>
									<td style="text-align:left;"><input type="text"  id="email" name="email address" pattern="^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$" /></td>
								</tr>
								<tr>
									<td style="text-align:left;"><input type="button" value="Previous" class="next_button" onclick="DoNext('business_contact', 'business_details')"/></td>
									<td style="text-align:right;"><input type="button" value="Next" class="next_button" onclick="DoNext('business_details', '')"/></td>
								</tr>
							</table>
						</form>					
					</div>

					<script type="text/javascript">
						DoFillSuburbsAndPostcodeSelects(document.getElementById("suburb"), document.getElementById("postcode"), document.getElementById("state"));
					</script>

					<form method="post" id="hidden" style="visibility:hidden;" name="new_tradie">
						<input type="hidden" id="hidden_other_trade_name" name="hidden_other_trade_name" value=""/>
						<input type="hidden" id="hidden_other_trade_description" name="hidden_other_trade_description" value=""/>

						<input type="hidden" id="hidden_trade" name="hidden_trade" value=""/>
						<input type="hidden" id="hidden_additional_trades" name="hidden_additional_trades" value=""/>
						<input type="hidden" id="hidden_business_name" name="hidden_business_name" value=""/>
						<input type="hidden" id="hidden_abn" name="hidden_abn" value=""/>
						<input type="hidden" id="hidden_license" name="hidden_license" value=""/>
						<input type="hidden" id="hidden_description" name="hidden_description" value=""/>
						<input type="hidden" id="hidden_minimum_charge" name="hidden_minimum_charge" value=""/>
						<input type="hidden" id="hidden_minimum_budget" name="hidden_minimum_budget" value=""/>
						<input type="hidden" id="hidden_minimum_size" name="hidden_minimum_size" value=""/>
						<input type="hidden" id="hidden_maximum_distance" name="hidden_maximum_distance" value=""/>

						<input type="hidden" id="hidden_unit" name="hidden_unit" value=""/>
						<input type="hidden" id="hidden_street" name="hidden_street" value=""/>
						<input type="hidden" id="hidden_suburb" name="hidden_suburb" value=""/>
						<input type="hidden" id="hidden_state" name="hidden_state" value=""/>
						<input type="hidden" id="hidden_postcode" name="hidden_postcode" value=""/>
						<input type="hidden" id="hidden_mobile" name="hidden_mobile" value=""/>
						<input type="hidden" id="hidden_phone" name="hidden_phone" value=""/>
						<input type="hidden" id="hidden_email" name="hidden_email" value=""/>
					</form>
					
					<script type="text/javascript">
					
						if (sessionStorage["new_tradie_stage"] === undefined)
							sessionStorage["new_tradie_stage"] = "trade";
							
						let div2Show = document.getElementById(sessionStorage["new_tradie_stage"]);
						
						if (div2Show)
							div2Show.style.display = "block";
						
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
					<a href="login.html">Log In</a> | 
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
