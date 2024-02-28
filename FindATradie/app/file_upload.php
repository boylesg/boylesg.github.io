<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>Untitled 1</title>
	</head>
	
	<body>
		
		<form method="post" target="_self" enctype="multipart/form-data">
			<input type="file" required id="file_name" name="file_name" accept=".jpg, .png, .jpeg, .gif|image/*" />
			<br><br>
			<input type="submit" name="submit_file" />
		</form>
		
	</body>
	
	<?php
	
		echo "<br>";
		print_r($_POST);
		echo "<br>";
		print_r($_FILES["file_name"]);
		
	?>
	
</html>
