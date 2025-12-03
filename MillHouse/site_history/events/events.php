<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<!-- #BeginTemplate "events_master.dwt" -->

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Events</title>
		<!-- #EndEditable -->
		
		<link href="../styles/style4PC.css" rel="stylesheet" type="text/css" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Gluten:wght@100..900&family=Permanent+Marker&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J:ital,wght@0,100..400;1,100..400&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap" rel="stylesheet" />

		<!-- #BeginEditable CustomStyles -->
		
		<style>
		</style>
		<?php require "../common.php"; ?>
			
		<!-- #EndEditable -->
	</head>
	<body>

		<!-- Begin Container -->
		<div id="container">
			<!-- Begin Masthead -->
			<div class="masthead">
				<div class="masthead_image" style="float:left;">
					<img src="../images/MillHouse.jpg" alt="" height="110"/>
				</div>
				<div class="masthead_text">
					<h1 class="gluten">MillHouse</h1>
					<h3 class="gluten">Neighbourhood House</h3>
				</div>
				<div class="masthead_image" style="float:right;">
					<img src="../images/OldKnittingMill.jpg" alt="" height="110"/>
				</div>
				<div class="masthead_image" style="float:right;">
					<img src="../images/KnittingMill1961.jpg" alt="" height="110"/>
		
				</div>
			</div>
			
			<!-- End Masthead -->
			<div class="below_masthead">
				<!-- Begin Navigation -->
				<div class="navigation">
					<ul>
						<li><a href="../index.html">Home</a></li>
						<li><a href="../site_history/site_history.html">Site History</a></li>
						<li><a href="../Calendar/Calendar.html">Calendar</a></li>
						<li><a href="../photos/photos.html">Photos</a></li>
						<li><a href="../information/information.html">Information</a></li>
						<li><a href="../coder_dojo/CoderDojo.html">CoderDojo</a></li>
						<li>
							<a href="events.php">Events</a>
							<ul>
								<li class="submenu_item"><a href="art4soul/art4soul.php"><b>Art for Soul</b></a></li>
								<li class="submenu_item"><a href="bridge/bridge.php"><b>Bridge</b></a></li>
								<li class="submenu_item"><a href="cyber_cafe/cyber_cafe.php"><b>Cyber Cafe</b></a></li>
								<li class="submenu_item"><a href="deadly/deadly.php"><b>Deadly Catch-up</b></a></li>
								<li class="submenu_item"><a href="dugeons_dragons/dugeons_dragons.php"><b>Dungeons &Aacute; Dragons</b></a></li>
								<li class="submenu_item"><a href="hooker/hookers.html"><b>Hookers</b></a></li>
								<li class="submenu_item"><a href="playgroup/playgroup.php"><b>Millhouse Playgroup</b></a></li>
								<li class="submenu_item"><a href="parent_pathways/parent_pathways.php"><b>Parent Pathways</b></a></li>
								<li class="submenu_item"><a href="u3a_writers/u3a_writers.php"><b>U3a Writers Groups</b></a></li>
							</ul>
						</li>
						<li><a href="../contact/Contact.php">Contact</a></li>
					</ul>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
				<!-- End Navigation -->
				<!-- Begin Content -->
				<div class="content">
					<h1 class="page_heading gluten"><u><script type="text/javascript">document.write(document.title);</script></u></h1>
									
					<!-- #BeginEditable "content" -->
					
					<p>You can keep track of all the ongoing events of the various groups fromm here.</p>					
					
					<form class="form" target="_self" method="post">
						<table cellpadding="0" cellspacing="5" border="0" id="login_form" style="display:<?php echo $_SESSION["display_login_form"]; ?>">
							<tr>
								<td style="text-align:center;" colspan="2"><label><h3>Login to add or edit groups</h3></label><br/><br/></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="password">Password: </label></td>
								<td><input name="password" id="password" type="password" required/></td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:right;">
									<input type="submit" name="login" id="login" value="LOGIN"/>
								</td>
							</tr>
						</table>
					</form>					
					<form class="form" target="_self" method="post" style="display:<?php echo $_SESSION["display_group_form"]; ?>;" id="event_form">
						<table cellpadding="0" cellspacing="5" border="0">
							<tr>
								<td style="text-align:center;" colspan="2"><label><h3>Add or edit group</h3></label><br/><br/></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="name">Group Name (short): </label></td>
								<td><input name="name" id="name" type="text" required value="<?php echo $_SESSION["name"]; ?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="description">Group Description (for display): </label></td>
								<td><input name="description" id="description" type="text" required value="<?php echo $_SESSION["name"]; ?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="name">Group Contact: </label></td>
								<td><input name="contact" id="contact" type="text" required value="<?php echo $_SESSION["contact"]; ?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="email">Group Email: </label></td>
								<td><input name="email" id="email" type="text" required value="<?php echo $_SESSION["email"]; ?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="phone">Group Phone: </label></td>
								<td><input name="phone" id="phone" type="text" required value="<?php echo $_SESSION["phone"]; ?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right;"><label for="event_list">Current groups:</label></td>
								<td>
									<select id="event_list" name="event_list">
									<?php echo DoGetGroupOptions(); ?>
									</select>
									<br/><br/>
									<input type="submit" name="load" id="load" value="LOAD"/>
									&nbsp;
									<input type="reset" name="reset" id="reset" value="RESET"/>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:right;">
									<input type="hidden" id="shortkey" name="shortkey" value="<?php echo $_SESSION["shortkey"]; ?>" />
									<input type="submit" name="upload" id="upload" value="UPLOAD"/>
								</td>
							</tr>
						</table>
					</form>	

					<!-- #EndEditable "content" --></div>
				<!-- End Content -->
			</div>
			<!-- Begin Footer -->
			<div class="footer">
				<div class="footer_navigation">
					<a href="../index.html">Home</a> | 
					<a href="../site_history/site_history.html">Site History</a> | 
					<a href="../Calendar/Calendar.html">Calendar</a> | 
					<a href="../photos/photos.html">Photos</a> |
					<a href="../information/information.html">Information</a> |
					<a href="events.php">Events</a> |
					<a href="../coder_dojo/CoderDojo.html">CoderDojo</a> | 
					<a href="../contact/Contact.php">Contact</a>
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
