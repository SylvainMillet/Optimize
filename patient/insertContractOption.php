<?php
	require 'connect.php';
		
	//Insert option
	$optionType = $_POST['optionType'] ;
	if (!empty($optionType) )
	{
		$query = pg_query( $cnx, "SELECT MAX(c_option_id)+1 FROM c_option" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxOption = $row[0];
		}
		if (is_null($maxOption))
		{
			$maxOption = 1;
		}
		$optionStyle = $_POST['optionStyle'] ;
		$firstExerciseDate = $_POST["firstExerciseDate"] ;
		$lastExerciseDate = $_POST["lastExerciseDate"] ;
		$exerciseFrequency = $_POST['exerciseFrequency'] ;
		$strikeIndex = STR_REPLACE("'","''",$_POST["strikeIndex"]) ;
		$strikeIndex = STR_REPLACE('"','""',$strikeIndex) ;
		$strikeIndexType = $_POST['strikeIndexType'] ;
		$strikeIndexSource = STR_REPLACE("'","''",$_POST["strikeIndexSource"]) ;
		$strikeIndexSource = STR_REPLACE('"','""',$strikeIndexSource) ;
		$strikePrice = $_POST["strikePrice"] ;
		
		if (is_null($optionStyle))
		{$optionStyle = 'null';}
		if (is_null($firstExerciseDate)||$firstExerciseDate=='')
		{$firstExerciseDate = 'null';}
		else{$firstExerciseDate='\''. $firstExerciseDate.'\''; }
		if (is_null($lastExerciseDate)||$lastExerciseDate=='')
		{$lastExerciseDate = 'null';}
		else{$lastExerciseDate='\''. $lastExerciseDate.'\''; }
		if (is_null($exerciseFrequency))
		{$exerciseFrequency = 'null';}
		if (is_null($strikeIndex))
		{$strikeIndex = 'null';}
		if (is_null($strikeIndexType))
		{$strikeIndexType = 'null';}
		if (is_null($strikeIndexSource)||$strikeIndexSource=='')
		{$strikeIndexSource = 'null';}
		if (is_null($strikePrice)||$strikePrice=='')
		{$strikePrice = 'null';}
	
		$sql = "INSERT INTO  c_option ( c_option_id, c_option_style, c_option_type, c_option_firstexercisedate, c_option_lastexercisedate, c_option_exercisefrequency, c_option_strikeindex, c_option_strikeindextype, c_option_strikeindexsource, c_option_strikeprice ) VALUES ("; 
		$sql = $sql.$maxOption.",".$optionStyle.",".$optionType.",".$firstExerciseDate.",".$lastExerciseDate.",".$exerciseFrequency.",'".$strikeIndex."',".$strikeIndexType.",'".$strikeIndexSource."',".$strikePrice.")";
		echo($sql);
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
?>