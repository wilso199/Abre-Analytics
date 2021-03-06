<?php
	
	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */
	
	//Required configuration files
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php'); 
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require_once('permissions.php');
	
	//Display Dropdowns
	if($analyticsadmin==1)
	{
	
		if(isset($_GET["teacher"])){ $teachercode=base64_decode(htmlspecialchars($_GET["teacher"], ENT_QUOTES)); }else{ $teachercode=""; }
		
		//Construct Query
		if(strpos($teachercode, ',') == true)
		{
			$teachercodeexploded = explode(",", $teachercode);
			$queryconstructor="";
			$firsttime="yes";
			foreach($teachercodeexploded as $teachercodeexplode)
			{
			    if($firsttime=="yes")
			    {
				    $queryconstructor=$queryconstructor."Teacher_Code LIKE '%$teachercodeexplode%'";
				    $firsttime="no";
			    }
			    else
			    {
				    $queryconstructor=$queryconstructor." or Teacher_Code LIKE '%$teachercodeexplode%'";
			    }
			}
		}
		else
		{
			$queryconstructor="Teacher_Code LIKE '%$teachercode%'";
		}
		
		echo "<select id='class' name='class' multiple>";
			echo "<option value='' disabled selected>Choose a Class</option>";
			$query = "SELECT * FROM `analytics_schedule` WHERE ($queryconstructor) group by `Course_Code` order by Course_Name";
			$dbreturn = databasequery($query);
			foreach ($dbreturn as $value)
			{
				$Course_Name=htmlspecialchars($value['Course_Name'], ENT_QUOTES);
				$Course_Code=htmlspecialchars($value['Course_Code'], ENT_QUOTES);
				echo "<option value='$Course_Code'>$Course_Name</option>";
			}
		echo "</select>";
			
	}
	
?>

<script>
	$('#class').material_select();
</script>