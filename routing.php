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
    
    if($_SESSION['usertype']=="staff")
    {
		echo "	
			'analytics': function(name)
			{
				$('#navigation_top').hide();
				$('#content_holder').hide();
				$('.tooltipped').tooltip('remove');
				$('#loader').show();
				$('#titletext').text('Analytics');
				document.title = 'Analytics';
				$('#content_holder').load('modules/analytics/assessment.php?id='+name, function() { init_page(); });
				$('#modal_holder').load('modules/analytics/modals.php');			
			},
			'analytics/teacher/?:name': function(name)
			{
				$('#navigation_top').hide();
				$('#content_holder').hide();
				$('#loader').show();
				$('#titletext').text('Analytics');
				document.title = 'Analytics';
				$('#content_holder').load('modules/analytics/teacher.php?id='+name, function() { init_page(); });
			},";
	}    
?>