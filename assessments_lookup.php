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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once('permissions.php');
	
	//Display Dropdowns
	if($pagerestrictions=="")
	{	
		$Student_ID=htmlspecialchars($_GET["Student_ID"], ENT_QUOTES);
		$query = "SELECT Test_Name, Scaled_Score, Performance_Score FROM `analytics_scores` WHERE `Student_ID` = '$Student_ID'";
		$dbreturn = databasequery($query);
		foreach ($dbreturn as $value)
		{
			$Test_Name=htmlspecialchars($value['Test_Name'], ENT_QUOTES);
			$Scaled_Score=htmlspecialchars($value['Scaled_Score'], ENT_QUOTES);
			$Performance_Score=htmlspecialchars($value['Performance_Score'], ENT_QUOTES);
			echo "<b>$Test_Name</b><br><span>Scaled Score: $Scaled_Score, Performance Score: $Performance_Score</span><br>";
		}		
	}
?>