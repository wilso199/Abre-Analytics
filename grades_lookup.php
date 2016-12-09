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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once('permissions.php');
	
	//Display Dropdowns
	if($pagerestrictions=="")
	{	
		$Student_ID=htmlspecialchars($_GET["Student_ID"], ENT_QUOTES);
		$Teacher_Code=htmlspecialchars($_GET["Teacher_Code"], ENT_QUOTES);
		$query = "SELECT * FROM `analytics_grades` WHERE `Student_ID` = '$Student_ID' and Teacher_Code REGEXP '$Teacher_Code'";
		$dbreturn = databasequery($query);
		foreach ($dbreturn as $value)
		{
			$Course_Name=htmlspecialchars($value["Course_Name"], ENT_QUOTES);
			$Quarter_1=htmlspecialchars($value["Quarter_1"], ENT_QUOTES);
			$Quarter_2=htmlspecialchars($value["Quarter_2"], ENT_QUOTES);
			$Quarter_3=htmlspecialchars($value["Quarter_3"], ENT_QUOTES);
			$Quarter_4=htmlspecialchars($value["Quarter_4"], ENT_QUOTES);
			echo "<b>$Course_Name</b><br><span>";
			if($Quarter_1!=""){ echo "$Quarter_1"; }
			if($Quarter_1!="" && $Quarter_2!==""){ echo ", "; }
			if($Quarter_2!=""){ echo "$Quarter_2"; }
			if($Quarter_2!="" && $Quarter_3!==""){ echo ", "; }
			if($Quarter_3!=""){ echo "$Quarter_3"; }
			if($Quarter_3!="" && $Quarter_4!==""){ echo ", "; }
			if($Quarter_4!=""){ echo "$Quarter_4"; }
			echo "</span><br>";
		}			
	}
	
?>