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
	
	if(superadmin() && !file_exists("$portal_path_root/modules/Abre-Analytics/setup.txt"))
	{
		//Check for analytics_evaas table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_evaas"))
		{
			$sql = "CREATE TABLE `analytics_evaas` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_evaas` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `analytics_evaas` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for EducatorStateID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT EducatorStateID FROM analytics_evaas"))
		{
			$sql = "ALTER TABLE `analytics_evaas` ADD `EducatorStateID` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for LastName field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT LastName FROM analytics_evaas"))
		{
			$sql = "ALTER TABLE `analytics_evaas` ADD `LastName` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for FirstName field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT FirstName FROM analytics_evaas"))
		{
			$sql = "ALTER TABLE `analytics_evaas` ADD `FirstName` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();

		//Check for EVAASIndex field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT EVAASIndex FROM analytics_evaas"))
		{
			$sql = "ALTER TABLE `analytics_evaas` ADD `EVAASIndex` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for EVAASRating field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT EVAASRating FROM analytics_evaas"))
		{
			$sql = "ALTER TABLE `analytics_evaas` ADD `EVAASRating` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_grades table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_grades"))
		{
			$sql = "CREATE TABLE `analytics_grades` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_grades` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `analytics_grades` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_ID FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Student_ID` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_Firstname field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_Firstname FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Student_Firstname` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_Lastname field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_Lastname FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Student_Lastname` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for School_Year field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT School_Year FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `School_Year` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Course_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Course_Code FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Course_Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Course_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Course_Name FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Course_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Quarter_1 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Quarter_1 FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Quarter_1` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Quarter_2 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Quarter_2 FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Quarter_2` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Quarter_3 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Quarter_3 FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Quarter_3` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Quarter_4 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Quarter_4 FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Quarter_4` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Teacher_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Teacher_Code FROM analytics_grades"))
		{
			$sql = "ALTER TABLE `analytics_grades` ADD `Teacher_Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_schedule table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_schedule"))
		{
			$sql = "CREATE TABLE `analytics_schedule` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_schedule` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `analytics_schedule` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for School_Year field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT School_Year FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `School_Year` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for School_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT School_Code FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `School_Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_ID FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `Student_ID` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Course_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Course_Code FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `Course_Code` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Course_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Course_Name FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `Course_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Teacher_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Teacher_Code FROM analytics_schedule"))
		{
			$sql = "ALTER TABLE `analytics_schedule` ADD `Teacher_Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_scores table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_scores"))
		{
			$sql = "CREATE TABLE `analytics_scores` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_scores` ADD PRIMARY KEY (`ID`);";
			$sql .= "ALTER TABLE `analytics_scores` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Assessment field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Assessment FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Assessment` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Test_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Test_Name FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Test_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_ID FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Student_ID` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_Firstname field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_Firstname FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Student_Firstname` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Middle_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Middle_Name FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Middle_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_Lastname field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_Lastname FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Student_Lastname` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Gender field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Gender FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Gender` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
	
		//Check for DOB field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT DOB FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `DOB` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for School field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT School FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `School` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for School_Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT School_Code FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `School_Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Ethnicity field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Ethnicity FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Ethnicity` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Grade field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Grade FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Grade` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Scaled_Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Scaled_Score FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Scaled_Score` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Performance_Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Performance_Score FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Performance_Score` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Promotional_Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Promotional_Score FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Promotional_Score` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Promotional_Status field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Promotional_Status FROM analytics_scores"))
		{
			$sql = "ALTER TABLE `analytics_scores` ADD `Promotional_Status` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_subscores table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_subscores"))
		{
			$sql = "CREATE TABLE `analytics_subscores` (`Student_ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_subscores` ADD PRIMARY KEY (`Student_ID`);";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Student_ID field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Student_ID FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Student_ID` int(11) NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for LastName field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT LastName FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `LastName` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for FirstName field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT FirstName FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `FirstName` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Testing Grade field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Testing Grade FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Testing Grade` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for TestingProvider field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT TestingProvider FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `TestingProvider` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for ELA_Score field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT ELA_Score FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `ELA_Score` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for ELA_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT ELA_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `ELA_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Reading_Informational_Text field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Reading_Informational_Text FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Reading_Informational_Text` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Reading_Literary_Text field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Reading_Literary_Text FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Reading_Literary_Text` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Writing field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Writing FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Writing` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Mathematics field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Mathematics FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Mathematics` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Mathematics_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Mathematics_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Mathematics_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Multiplication_and_Division field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Multiplication_and_Division FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Multiplication_and_Division` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Numbers_and_Operations field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Numbers_and_Operations FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Numbers_and_Operations` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geometry_SubScore field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geometry_SubScore FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geometry_SubScore` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Fractions field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Fractions FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Fractions` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Modeling_and_Reasoning field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Modeling_and_Reasoning FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Modeling_and_Reasoning` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Decimals field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Decimals FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `Decimals` ADD `Decimals` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Ratios_and_Proportions field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Ratios_and_Proportions FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Ratios_and_Proportions` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Expressions_and_Equations field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Expressions_and_Equations FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Expressions_and_Equations` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geometry_and_Statistics field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geometry_and_Statistics FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geometry_and_Statistics` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for The_Number_System field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT The_Number_System FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `The_Number_System` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Functions field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Functions FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Functions` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Number_Quantities_Equations_and_Expressions field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Number_Quantities_Equations_and_Expressions FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Number_Quantities_Equations_and_Expressions` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Statistics_and_Probability field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Statistics_and_Probability FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Statistics_and_Probability` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Statistics field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Statistics FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Statistics` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Algebra_1 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Algebra_1 FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Algebra_1` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Algebra_1_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Algebra_1_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Algebra_1_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geometry field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geometry FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geometry` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geometry_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geometry_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geometry_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();

		//Check for Circles field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Circles FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Circles` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Congruence_and_Proof field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Congruence_and_Proof FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Congruence_and_Proof` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Probability field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Probability FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Probability` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Similarity_and_Trigonometry field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Similarity_and_Trigonometry FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Similarity_and_Trigonometry` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Social_Studies field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Social_Studies FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Social_Studies` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Social_Studies_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Social_Studies_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Social_Studies_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for History field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT History FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `History` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Government field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Government FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Government` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geography_Economics field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geography_Economics FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geography_Economics` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for History_and_Government field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT History_and_Government FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `History_and_Government` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Economics field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Economics FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Economics` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Geography field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Geography FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Geography` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for American_Government field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT American_Government FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `American_Government` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for American_Government_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT American_Government_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `American_Government_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Historic_Documents field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Historic_Documents FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Historic_Documents` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Principles_and_Structure field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Principles_and_Structure FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Principles_and_Structure` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Ohio_Policy_Economy field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Ohio_Policy_Economy FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Ohio_Policy_Economy` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for American_History field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT American_History FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `American_History` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for American_History_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT American_History_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `American_History_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Skills_and_Documents field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Skills_and_Documents FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Skills_and_Documents` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for 1877_1945 field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT 1877_1945 FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `1877_1945` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for 1945_Present field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT 1945_Present FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `1945_Present` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Science field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Science FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Science` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Science_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Science_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Science_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Earth_Science field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Earth_Science FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Earth_Science` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Life_Science field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Life_Science FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Life_Science` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Physical_Science_SS field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Physical_Science_SS FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Physical_Science_SS` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Biology field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Biology FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Biology` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Biology_PL field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Biology_PL FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Biology_PL` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Heredity field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Heredity FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Heredity` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Evolution field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Evolution FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Evolution` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Diversity_of_Life field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Diversity_of_Life FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Diversity_of_Life` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Cells field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Cells FROM analytics_subscores"))
		{
			$sql = "ALTER TABLE `analytics_subscores` ADD `Cells` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_teachers table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_teachers"))
		{
			$sql = "CREATE TABLE `analytics_teachers` (`ID` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_teachers` ADD PRIMARY KEY (`ID`);";	
			$sql .= "ALTER TABLE `analytics_teachers` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Last_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Last_Name FROM analytics_teachers"))
		{
			$sql = "ALTER TABLE `analytics_teachers` ADD `Last_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for First_Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT First_Name FROM analytics_teachers"))
		{
			$sql = "ALTER TABLE `analytics_teachers` ADD `First_Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Code field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Code FROM analytics_teachers"))
		{
			$sql = "ALTER TABLE `analytics_teachers` ADD `Code` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for analytics_teachers table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM analytics_users"))
		{
			$sql = "CREATE TABLE `analytics_users` (`id` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `analytics_users` ADD PRIMARY KEY (`id`);";	
			$sql .= "ALTER TABLE `analytics_users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for email field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT email FROM analytics_users"))
		{
			$sql = "ALTER TABLE `analytics_users` ADD `email` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
				
		//Write the Setup File
		$myfile = fopen("$portal_path_root/modules/Abre-Analytics/setup.txt", "w");
		fwrite($myfile, '');
		fclose($myfile);

	}
	
?>