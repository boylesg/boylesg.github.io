<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "../master.dwt" -->
	
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/advert_stuff.php";
	?>
	<script type="text/javascript">	
	
		var g_nCurrentAdvert = 0;
		var g_arrayAdverts = [
								<?php DoGenerateJSAdvertArray(); ?>
					 		 ];
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>File Upload</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="../styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
			<style>
</style>
		<!-- #EndEditable -->
		<script type="text/javascript">
			
			function DoChangeBackgroundImage()
			{
				let nImageNum = Math.ceil(Math.random() * 39),
					strFilename = "url('/images/background" + nImageNum + ".jpg')";
					
				document.body.style.backgroundImage = strFilename;
			}
			
			setInterval(DoNextAdvert, 3000);
			
		</script>
	</head>

	<body class="body" onload="DoChangeBackgroundImage()">
			
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<div class="logo">
				<img alt="" src="../images/FATLogo.png" width="100" /></div>
			<div class="title_container">
				<div class="title text_outline" id="title">FIND A TRADIE</div>
				<div class="tag text_outline" id="tag">Created by an Australian tradie</div>
			</div>
			<a class="masthead_button" href="../new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="../new_customer.php">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
				
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="../login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;">LOG IN</a>
			<a class="masthead_button" href="../login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;">LOG OUT</a>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item">
					<a class="navigation_link" href="../index.php">HOME</a></li>
					<li class="navigation_list_item">
					<a class="navigation_link" href="../benefits.php">BENEFITS</a></li>
					<li class="navigation_list_item">
					<a class="navigation_link" href="../about.php">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item">
					<a class="navigation_link" href="../faq.php">FAQ</a></li>
					<li class="navigation_list_item">
					<a class="navigation_link" href="../contact.php">CONTACT</a></li>
					<li class="navigation_list_item">
					<a class="navigation_link" href="../forum.php">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" >
				<img src="../images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<div class="advert_marquee">
				<?php DoGenerateAdvertSlotHTML(); ?>
			</div>
			<!-- #BeginEditable "content" -->








			
			<form class="form" method="post" target="_self" enctype="multipart/form-data">
				<h6>Upload <?php if (isset($_GET["upload"])) echo $_GET["upload"]; ?> image file...</h6>
				<input type="file" required id="<?php if (isset($_GET["upload"])) echo $_GET["upload"]; ?>_file_name" name="<?php if (isset($_GET["upload"])) echo $_GET["upload"]; ?>_file_name" accept=".jpg, .jpeg|image/*" />
				<br/><br/>
				<label><b>Member ID: </b></label>
				<input type="text" readonly size="5" id="member_id0" name="member_id0" value="<?php if (isset($_GET["member_id"])) echo $_GET["member_id"]; ?>" />
				<br/><br/>
				<input type="submit" name="submit_file" value="UPLOAD"/>
				<br/><br/><h6>
					
				<?php
				
					$strTargetPath = "";
					
					if (isset($_FILES["logo_file_name"]))
					{
						$strTargetPath = DoGetLogoImageFilename($_POST["member_id"], false);
						if (move_uploaded_file($_FILES["logo_file_name"]["tmp_name"], $strTargetPath))
						{
							$results = DoUpdateQuery1($g_dbFindATradie, "members", "logo_filename", $strTargetPath, "id", $_POST["member_id"]);
							if ($results)
							{
								echo "Logo image file '" . $_FILES["logo_file_name"]["name"] . "' was uploaded!";
							}
							else
							{
								echo "Column 'logo_filename' could not be updated!";
							}
						}
						else
						{
							echo "Could not save file '" . $strTargetPath . "'";
						}
					}
					else if (isset($_FILES["profile_file_name"]))
					{
						$strTargetPath = DoGetProfileImageFilename($_POST["member_id"], false);
						if (move_uploaded_file($_FILES["profile_file_name"]["tmp_name"], $strTargetPath))
						{
							$results = DoUpdateQuery1($g_dbFindATradie, "members", "profile_filename", $strTargetPath, "id", $_POST["member_id"]);
							if ($results)
							{
								echo "Profile image file '" . $_FILES["profile_file_name"]["name"] . "' was saved!";
							}
							else
							{
								echo "Column 'profile_filename' could not update!";
							}
						}
						else
						{
							echo "Could not save file '" . $strTargetPath . "'";
						}
					}
					else
					{
						echo "<div style=\"background-color:white;\">";
						print_r($_GET);
						echo "<br/><br/>";
						print_r($_POST);
						echo "<br/><br/>";
						print_r($_FILES);
						echo "</div>";
					}
					
				?>
				</h6>
			</form>








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
		
		<script type="text/javascript">	
		
			DoSetAdverts();
		
		</script>
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
