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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php'); 
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require_once('permissions.php');
	
	//Display Dropdowns
	if($analyticsadmin==1)
	{

		if(isset($_GET["building"])){ $building=base64_decode(htmlspecialchars($_GET["building"], ENT_QUOTES)); }else{ $building=""; }
		
		//Construct Query
		if(strpos($building, ',') == true)
		{
			$buildingexploded = explode(",", $building);
			$queryconstructor="";
			$firsttime="yes";
			foreach($buildingexploded as $buildingexplode)
			{
				$buildingexplode=encrypt($buildingexplode, "");
			    if($firsttime=="yes")
			    {
				    $queryconstructor=$queryconstructor."location='$buildingexplode'";
				    $firsttime="no";
			    }
			    else
			    {
				    $queryconstructor=$queryconstructor." or location='$buildingexplode'";
			    }
			}
		}
		else
		{
			$building=encrypt($building, "");
			$queryconstructor="location='$building'";
		}
		$items=array();
			echo "<select id='teacher' name='teacher' multiple>";
			echo "<option value='' disabled selected>Choose a Teacher</option>";
			$query = "SELECT * FROM directory where ($queryconstructor) and archived=0";
			$dbreturn = databasequery($query);
			foreach ($dbreturn as $value)
			{
				$firstname=htmlspecialchars($value["firstname"], ENT_QUOTES);
				$firstname=stripslashes(htmlspecialchars(decrypt($firstname, ""), ENT_QUOTES));
				$lastname=htmlspecialchars($value["lastname"], ENT_QUOTES);
				$lastname=stripslashes(htmlspecialchars(decrypt($lastname, ""), ENT_QUOTES));
				$teachercode=htmlspecialchars($value["LocalId"], ENT_QUOTES);
				$teachercode=stripslashes(htmlspecialchars(decrypt($teachercode, ""), ENT_QUOTES));
				$employee=array();
				array_push($employee, $lastname, $firstname, $teachercode);
				array_push($items, $employee);
			}
			
			sort($items, SORT_DESC);
			$counterarray=0;
			foreach($items as $val)
			{
				$lastname=$items[$counterarray]['0'];
				$firstname=$items[$counterarray]['1'];
				$teachercode=$items[$counterarray]['2'];
				echo "<option value='$teachercode'>$lastname, $firstname</option>";
				$counterarray++;
			}
			
			echo "</select>";
			
	}
	
?>

<script>
	$('#teacher').material_select();
</script>