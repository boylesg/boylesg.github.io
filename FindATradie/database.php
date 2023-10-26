<?php

	function ConnectToDatabase()
	{
		$strNameDB = "find_a_tradie";
		$dbFindATradie = new mysqli("localhost", "root", "Pulsar112358#", $strNameDB);
	
		// Check connection
		if ($dbFindATradie->connect_errno) 
		{
		  echo "<h1>Failed to connect to MySQL: " . $dbFindATradie->connect_errno . "!</h1>";
		  exit();
		}
		else if ($dbFindATradie)
		{
			echo "Successfully connected to '". $strNameDB . "'!";
		}
		return $dbFindATradie;
	}
	$g_dbFindATradie = ConnectToDatabase();

	
	
	function DoGenerateTradesRadioButtons()
	{	
		global $g_dbFindATradie;
		$strChecked = "checked"; 
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades");
		
		while ($row = $queryResult->fetch_assoc())
	    {
			echo "<tr>";
			echo "<td style=\"text-align:right;width:1px;\" class=\"trade_table_cell\"><input type=\"radio\" name=\"trade\" id=\"" . $row["name"] . "(" . $row["id"] . ")\" " . $strChecked . "\" onblur=\"OnClickTradesRadio(this)\" /></td>";
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
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades");
		
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

?>



