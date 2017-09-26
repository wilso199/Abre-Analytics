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
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	require('permissions.php');
	
	$teachercode=htmlspecialchars($_GET["id"], ENT_QUOTES);
	if($pagerestrictions=="" && $teachercode!="")
	{
		
		//Display Students
		?>
		<table id='myTable' class='bordered responsive-table striped tablesorter'>
			<thead>
				<tr class='pointer'>
					<th>Student</th>
					<th>Enrolled Course</th>
					<th>Assessments</th>
					<th>Grades (2015-2016)</th>
				</tr>
			</thead>
			<tbody>
				
			<?php
			$counter=0;
			$sql = "SELECT * from `analytics_schedule` WHERE `Teacher_Code`= '$teachercode' and Course_Code!=0 and Course_Code!=1 group by `Student_ID`
ORDER BY `analytics_schedule`.`Course_Code`";
			$result = $db->query($sql);
			while($row = $result->fetch_assoc())
			{
				$Student_ID=htmlspecialchars($row["Student_ID"], ENT_QUOTES);
				$Course_Name=htmlspecialchars($row["Course_Name"], ENT_QUOTES);
				$Course_Code=htmlspecialchars($row["Course_Code"], ENT_QUOTES);
				
				//Find out the students name
				$counter++;
				$scorescount=0;
				$query = "SELECT Student_Lastname, Student_Firstname FROM `analytics_scores` WHERE `Student_ID` = '$Student_ID' LIMIT 1";
				$dbreturn = databasequery($query);
				foreach ($dbreturn as $value)
				{
					$scorescount++;
					$Student_Firstname=htmlspecialchars($value['Student_Firstname'], ENT_QUOTES);
					$Student_Lastname=htmlspecialchars($value['Student_Lastname'], ENT_QUOTES);					
					echo "<tr>";
						echo "<td><b>$Student_Lastname, $Student_Firstname</b><br><span>Student ID: $Student_ID</span></td>";
						echo "<td>$Course_Name</td>";
						//Find the students assessment scores
						echo "<td>";
							echo "<div id='assessment_$counter'>Loading...</div></div></div>";
							echo "<script>";
								echo "$('#assessment_$counter').load('modules/".basename(__DIR__)."/assessments_lookup.php?Student_ID=$Student_ID');";
							echo "</script>";
						echo "</td>";
						//Find the students grades
						echo "<td>";
							echo "<div id='grade_$counter'>Loading...</div></div>";
							echo "<script>";
								echo "$('#grade_$counter').load('modules/".basename(__DIR__)."/grades_lookup.php?Student_ID=$Student_ID&Teacher_Code=$teachercode');";
							echo "</script>";
						echo "</td>";	
					echo "</tr>";
				}
			}
			
			if($scorescount==0)
			{
				echo "<tr><td colspan='4'>No Tested Students</td></tr>";
			}
			?>			
			</tbody>
		</table>
		
		
		<script>
			$(function()
			{
				$("#myTable").tablesorter( {sortList: [[0,0]]} );		
				<?php echo "$('#downloadlink_csv').attr('href','/modules/".basename(__DIR__)."/export_csvteacher.php?teachercode=$teachercode');" ?>
				<?php echo "$('#downloadlink_pdf').attr('href','/modules/".basename(__DIR__)."/export_pdfteacher.php?teachercode=$teachercode');" ?>
			});	
			
		</script>
		
		<?php 
	}
?>