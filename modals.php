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

?>

	<!-- Add Question -->
	<div id="teacherrostermodal" class="fullmodal modal modal-fixed-footer">
		<div class="modal-content">
			<h4><div id="teachername"></div></h4>
			<div id="loadingbar" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="width:100%"></div>
			<a class="modal-close black-text" style='position:absolute; right:20px; top:25px;'><i class='material-icons'>clear</i></a>
			<div class="row">
				<div id="teacherstudents"></div>
			</div>
    	</div>
	    <div class="modal-footer">
		    
		    <a class="modal-close waves-effect btn-flat white-text" style='background-color: <?php echo sitesettings("sitecolor"); ?>; margin-left:5px;'>Close</a>
		    <a id='downloadlink_csv' class="waves-effect btn-flat white-text" href="" style='background-color: <?php echo sitesettings("sitecolor"); ?>; margin-left:5px;'>CSV</a>
		    <a id='downloadlink_pdf' class="waves-effect btn-flat white-text" href="" target="_blank" style='background-color: <?php echo sitesettings("sitecolor"); ?>'>PDF</a>
			     
		</div>
	</div>
	
<script>

	$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		belowOrigin: false,
	});
	
</script>