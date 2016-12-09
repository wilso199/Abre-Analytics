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
	require_once('permissions.php');
	
	//Display Dropdowns
	if($analyticsadmin==1)
	{
			?>
			<div class='page_container'>
				<form>
				<div class="row">
		        	<div class="input-field col l3 s12">
						<select id="assessment" name="assessment">
						    <option value="" disabled selected>Choose an Assessment</option>
							<?php
							$sql = "SELECT * FROM analytics_scores where Test_Name!='' group by Test_Name";
							$result = $db->query($sql);
							$numrows = $result->num_rows;
							$bookcount=0;
							while($row = $result->fetch_assoc())
							{
								$ID=htmlspecialchars($row["ID"], ENT_QUOTES);
								$Test_Name=htmlspecialchars($row["Test_Name"], ENT_QUOTES);
									
								echo "<option value='$Test_Name'>$Test_Name</option>";
							}
							?>
						</select>
		        	</div>
		        	<div class="input-field col l3 s12">
						<select id="building" name="building" multiple>
						    <option value="" disabled selected>Choose an Building</option>
							<option value='Bridgeport'>Bridgeport</option>
							<option value='Brookwood'>Brookwood</option>
							<option value='Crawford Woods'>Crawford Woods</option>
							<option value='Fairwood'>Fairwood</option>
							<option value='Highland'>Highland</option>
							<option value='Linden'>Linden</option>
							<option value='Ridgeway'>Ridgeway</option>
							<option value='Riverview'>Riverview</option>
							<option value='Garfield'>Garfield</option>
							<option value='Wilson'>Wilson</option>
							<option value='Hamilton Freshman'>Hamilton Freshman</option>
							<option value='Hamilton High'>Hamilton High</option>
						</select>
		        	</div>
					<div class="input-field col l3 s12">
						<div id="chooseteacher">
							<?php include "teacher_choices.php"; ?>
						</div>
		        	</div>
		        	<div class="input-field col l3 s12">
						<div id="chooseclass">
							<?php include "class_choices.php"; ?>
						</div>
		        	</div>
				</div>
				</form>
			</div>
			<?php
			
			//Display Data
			?>
			<div class='page_container'><div class="row"><div class="col s12">
					<div id='topicLoader' class='mdl-progress mdl-js-progress mdl-progress__indeterminate' style='width:100%'></div>
			</div></div></div>
			<?php		
			echo "<div id='displayassessment'>"; include "assessment_display.php"; echo "</div>";	
				
		?>
		
		<script>
			
		$(function()
		{
			
			//Hide the loader
			$("#topicLoader").hide();
			
			//Show the dropdowns
			$('#assessment, #building').material_select();
			
			//When building is changed, update the teachers
			$('#building').change(function()
			{
				$("#displayassessment").hide();
				var building = $('#building').val();
				building = btoa(building);
				$("#chooseteacher").load( "modules/analytics/teacher_choices.php?building="+building );
				$("#chooseclass").load( "modules/analytics/class_choices.php" );
			});
				
			//When the teacher is changed, update the classes		    	
			$("#chooseteacher").on('change', '#teacher', function()
			{   	
				$("#displayassessment").hide();
				var teacher = $('#teacher').val();
				teacher = btoa(teacher);
				$("#chooseclass").load( "modules/analytics/class_choices.php?teacher="+teacher );
			});
			
			//When the classes are changed, update the results
			$("#chooseclass").on('change', '#class', function()
			{ 
				var assessment = $('#assessment').val();
				assessment = btoa(assessment);
				var teacher = $('#teacher').val();
				teacher = btoa(teacher);
				var classcode = $('#class').val();
				classcode = btoa(classcode);
						    	
				$("#topicLoader").show();			
				$("#displayassessment").load('modules/analytics/assessment_display.php?assessment='+assessment+'&teachercode='+teacher+'&classcode='+classcode, function() {
					$("#topicLoader").hide();
					$("#displayassessment").show();
				});
			});
			
			//When the assessment is changed, update the results if other fields are not blank
			$('#assessment').change(function()
			{   	
				var assessment = $('#assessment').val();
				var teacher = $('#teacher').val();
				var classcode = $('#class').val();
				var building = $('#building').val();
				
				if(assessment!="" && teacher!="" && classcode!="" && building!="")
				{
					assessment = btoa(assessment);
					teacher = btoa(teacher);
					classcode = btoa(classcode);
					building = btoa(building);
					
					$("#topicLoader").show();			
					$("#displayassessment").load('modules/analytics/assessment_display.php?assessment='+assessment+'&teachercode='+teacher+'&classcode='+classcode, function() {
						$("#topicLoader").hide();
						$("#displayassessment").show();
					});
				}
			});
		
		});
		
		</script>
		
<?php } ?>