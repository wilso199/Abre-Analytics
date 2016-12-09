<?php 

	/*
	* Copyright 2015 Hamilton City School District	
	* 		
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
	* 
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
	* 
    * You should have received a copy of the GNU General Public License
    * along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */	
    
    //Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require('permissions.php');
	
	if($pagerestrictions=="")
	{
		?>
		<div class='page_container'>
		<div class='row'>
		<?php
		
		$sql = "SELECT * FROM analytics_scores group by Test_Name";
		$result = $db->query($sql);
		$numrows = $result->num_rows;
		$bookcount=0;
		while($row = $result->fetch_assoc())
		{
			$ID=htmlspecialchars($row["ID"], ENT_QUOTES);
			$Test_Name=htmlspecialchars($row["Test_Name"], ENT_QUOTES);
				
			echo "<div><a href='#analytics/assessment/$ID'>$Test_Name</a></div>";
		}
		?>
		
		</div>
		</div>
		
		<?php 
	
	}

?>