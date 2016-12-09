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
	require_once('permissions.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php'); 
	
	//Display Dropdowns
	if($pagerestrictions=="")
	{	
	
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=analytics.csv');
		
		$output = fopen('php://output', 'w');
		
		fputcsv($output, array('Teacher Name', 'Student ID', 'Student Name', 'Enrolled Course', 'Assessments', 'Grades'));
		include "../../core/abre_dbconnect.php";


			$Teacher_Code=htmlspecialchars($_GET["teachercode"], ENT_QUOTES);
			
			$sql = "SELECT *  FROM `analytics_teachers` WHERE `Code` LIKE '$Teacher_Code'";
			$result = $db->query($sql);
			while($row = $result->fetch_assoc())
			{	
				$Teacher_First_Name=htmlspecialchars($row['First_Name'], ENT_QUOTES);
				$Teacher_Last_Name=htmlspecialchars($row['Last_Name'], ENT_QUOTES);
			}

			$sql = "SELECT * from `analytics_schedule` WHERE `Teacher_Code`= '$Teacher_Code' and Course_Code!=0 and Course_Code!=1 group by `Student_ID`
ORDER BY `analytics_schedule`.`Course_Code`";
			$result = $db->query($sql);
			while($row = $result->fetch_assoc())
			{
				$Student_ID=htmlspecialchars($row["Student_ID"], ENT_QUOTES);
				$Course_Name=htmlspecialchars($row["Course_Name"], ENT_QUOTES);
				$Course_Code=htmlspecialchars($row["Course_Code"], ENT_QUOTES);
				
				//Find out the students name
				$scorescount=0;
				$query = "SELECT Student_Lastname, Student_Firstname FROM `analytics_scores` WHERE `Student_ID` = '$Student_ID' LIMIT 1";
				$dbreturn = databasequery($query);
				foreach ($dbreturn as $value)
				{
					$scorescount++;
					$Student_Firstname=htmlspecialchars($value['Student_Firstname'], ENT_QUOTES);
					$Student_Lastname=htmlspecialchars($value['Student_Lastname'], ENT_QUOTES);
					
					//Assessments lookup
					$query = "SELECT Test_Name, Scaled_Score, Performance_Score FROM `analytics_scores` WHERE `Student_ID` = '$Student_ID'";
					$dbreturn = databasequery($query);
					$assessmentbuild="";
					foreach ($dbreturn as $value)
					{
						$Test_Name=htmlspecialchars($value['Test_Name'], ENT_QUOTES);
						$Scaled_Score=htmlspecialchars($value['Scaled_Score'], ENT_QUOTES);
						$Performance_Score=htmlspecialchars($value['Performance_Score'], ENT_QUOTES);
						$assessmentbuild = $assessmentbuild."$Test_Name (Scaled Score: $Scaled_Score, Performance Score: $Performance_Score) ";
					}	
					
					//Grades lookup
					$query = "SELECT * FROM `analytics_grades` WHERE `Student_ID` = '$Student_ID' and Teacher_Code='$Teacher_Code'";
					$dbreturn = databasequery($query);
					$gradebuild="";
					foreach ($dbreturn as $value)
					{
						$Course_Name=htmlspecialchars($value["Course_Name"], ENT_QUOTES);
						$Quarter_1=htmlspecialchars($value["Quarter_1"], ENT_QUOTES);
						$Quarter_2=htmlspecialchars($value["Quarter_2"], ENT_QUOTES);
						$Quarter_3=htmlspecialchars($value["Quarter_3"], ENT_QUOTES);
						$Quarter_4=htmlspecialchars($value["Quarter_4"], ENT_QUOTES);
						$gradebuild = $gradebuild."$Course_Name (Quarter 1: $Quarter_1, Quarter 2: $Quarter_2, Quarter 3: $Quarter_3, Quarter 4: $Quarter_4) ";
					}			
					
					$data = ["$Teacher_First_Name $Teacher_Last_Name",$Student_ID,"$Student_Lastname, $Student_Firstname",$Course_Name,$assessmentbuild,$gradebuild];
					fputcsv($output, $data);
					$assessmentbuild="";
					$gradebuild="";
				}
			}
		
		
		fclose($output);
		mysqli_close($db);
		exit();
		
	}
  
?>