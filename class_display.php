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
	
	//Display books
	if($pagerestrictions=="")
	{
		$teachercode=htmlspecialchars($_GET["teacher"], ENT_QUOTES);
		?>
		<div class='page_container'>
		<div class='row'>
		<?php
		
		$sql = "SELECT * FROM analytics_schedule where Teacher_Code='$teachercode' group by Student_ID";
		$result = $db->query($sql);
		while($row = $result->fetch_assoc())
		{
			$Student_ID=htmlspecialchars($row["Student_ID"], ENT_QUOTES);
			//echo "$Student_ID<br>";
			$sql2 = "SELECT * FROM analytics_scores where Student_ID='$Student_ID' group by Student_ID";
			$result2 = $db->query($sql2);
			while($row2 = $result2->fetch_assoc())
			{
				$Student_Firstname=htmlspecialchars($row2["Student_Firstname"], ENT_QUOTES);
				$Student_Lastname=htmlspecialchars($row2["Student_Lastname"], ENT_QUOTES);
				echo "<a href=''>$Student_Firstname $Student_Lastname</a><br>";
			}
			
		}
		?>
		
		</div>
		</div>
		
		<?php 
	
	}

?>