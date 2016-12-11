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
	
	if(isset($_GET["building"])){ $building=htmlspecialchars($_GET["building"], ENT_QUOTES); }else{ $building=""; }
	if(isset($_GET["assessment"])){ $assessment=base64_decode(htmlspecialchars($_GET["assessment"], ENT_QUOTES)); }else{ $assessment=""; }
	if(isset($_GET["teachercode"])){ $teachercode=base64_decode(htmlspecialchars($_GET["teachercode"], ENT_QUOTES)); }else{ $teachercode=""; }
	if(isset($_GET["classcode"])){ $classcode=base64_decode(htmlspecialchars($_GET["classcode"], ENT_QUOTES)); }else{ $classcode=""; }
	
	//Display books
	if($pagerestrictions=="" && $assessment!="" && $teachercode!="" && $classcode!="")
	{
		?>
		
		<div class='page_container mdl-shadow--4dp'>
		<div class='page'>
		<?php
		
		//Construct Query for teachers
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
		
		//Construct Query for courses
		if(strpos($classcode, ',') == true)
		{
			$classcodeexploded = explode(",", $classcode);
			$queryconstructor2="";
			$firsttimeclass="yes";
			foreach($classcodeexploded as $classcodeexplode)
			{
			    if($firsttimeclass=="yes")
			    {
				    $queryconstructor2=$queryconstructor2."Course_Code='$classcodeexplode'";
				    $firsttimeclass="no";
			    }
			    else
			    {
				    $queryconstructor2=$queryconstructor2." or Course_Code='$classcodeexplode'";
			    }
			}
		}
		else
		{
			$queryconstructor2="Course_Code='$classcode'";
		}
		
		//Display All Teachers
		?>
		<table id='myTable' class='bordered responsive-table striped tablesorter'>
			<thead>
				<tr class='pointer'>
					<th>Name</th>
					<th>Limited</th>
					<th>Basic</th>
					<th>Proficient</th>
					<th>Accelerated</th>
					<th>Advanced</th>
				</tr>
			</thead>
			<tbody>
				
				<?php	
				$returncounter=0;
				$sql = "SELECT * FROM `analytics_schedule` WHERE ($queryconstructor) and ($queryconstructor2) group by Teacher_Code";
				$result = $db->query($sql);
				while($row = $result->fetch_assoc())
				{
					$Teacher_Code=htmlspecialchars($row["Teacher_Code"], ENT_QUOTES);
					$sql5 = "SELECT *  FROM `analytics_teachers` WHERE `Code` REGEXP '$Teacher_Code'";
					$result5 = $db->query($sql5);
					while($row5 = $result5->fetch_assoc())
					{
						$Last_Name=htmlspecialchars($row5["Last_Name"], ENT_QUOTES);
						$First_Name=htmlspecialchars($row5["First_Name"], ENT_QUOTES);
						
						echo "<tr class='modal-teacherroster pointer' href='#teacherrostermodal' data-teachername='$First_Name $Last_Name' data-teachercode='$Teacher_Code'>";
							$sql3 = "SELECT analytics_scores.Performance_Score FROM `analytics_schedule` LEFT JOIN `analytics_scores` ON analytics_schedule.Student_ID=analytics_scores.Student_ID WHERE `Teacher_Code` LIKE '$Teacher_Code' and analytics_scores.Test_Name='$assessment' and ($queryconstructor2) group by analytics_schedule.Student_ID";
							$result3 = $db->query($sql3);
							$perf1count=0; $perf2count=0; $perf3count=0; $perf4count=0; $perf5count=0;
							$total_count_students=0;
							while($row3 = $result3->fetch_assoc())
							{
								$returncounter++;
								$Performance_Score=htmlspecialchars($row3["Performance_Score"], ENT_QUOTES);
								if($Performance_Score==1){ $perf1count++; }
								if($Performance_Score==2){ $perf2count++; }
								if($Performance_Score==3){ $perf3count++; }
								if($Performance_Score==4){ $perf4count++; }
								if($Performance_Score==5){ $perf5count++; }
								$total_count_students=$perf1count+$perf2count+$perf3count+$perf4count+$perf5count;
							}
							echo "<td><b>$Last_Name, $First_Name</b></a><p>$total_count_students Students Tested</p></td>";
							if($total_count_students!=0)
							{
								echo "<td><b>".round(($perf1count/$total_count_students)*100)."%"."</b></td>";
								echo "<td><b>".round(($perf2count/$total_count_students)*100)."%"."</b></td>";
								echo "<td><b>".round(($perf3count/$total_count_students)*100)."%"."</b></td>";
								echo "<td><b>".round(($perf4count/$total_count_students)*100)."%"."</b></td>";
								echo "<td><b>".round(($perf5count/$total_count_students)*100)."%"."</b></td>";
							}
							else
							{
								echo "<td><b>N/A</b></td>";
								echo "<td><b>N/A</b></td>";
								echo "<td><b>N/A</b></td>";
								echo "<td><b>N/A</b></td>";
								echo "<td><b>N/A</b></td>";
							}
						echo "</tr>";

					}
				}
				?>
							
			</tbody>
		</table>
		</div>
		</div>
		
<script>

$("#myTable").tablesorter(); 	

</script>
		<?php 
	
	}

?>

<script>
	
	$(function() 
	{
	
		$('.modal-teacherroster').leanModal({
			in_duration: 0,
			out_duration: 0,
			ready: function() { }
		});	
								   	
		$(document).on("click", ".modal-teacherroster", function (event) {
			event.preventDefault();
			$("#loadingbar").show();	
		});
		
		$(document).on("click", ".modal-teacherroster", function (event) {
			event.preventDefault();
			$(".modal-content #teacherstudents").empty();
			var Teacher_Name = $(this).data('teachername');
			$(".modal-content #teachername").text(Teacher_Name);
			var Teacher_Code = $(this).data('teachercode');
										
			$( ".modal-content #teacherstudents" ).load( "modules/<?php echo basename(__DIR__); ?>/teacher.php?id="+Teacher_Code, function() {
				$("#loadingbar").hide();
			});
		});
		
	});
	
</script>