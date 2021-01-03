<?php
	require 'connect.php';
	
	//Insert fixing index
	$indexPriceType = $_POST['typeOfIndexPrice'] ;
	
	if (!empty($indexPriceType) )
	{
		$query = pg_query( $cnx, "SELECT MAX(c_fixingindex_id)+1 FROM c_fixingindex" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxFixingIndex = $row[0];
		}
		if (is_null($maxFixingIndex))
		{
			$maxFixingIndex = 1;
		}

		$fixingIndex = STR_REPLACE("'","''",$_POST["fixingIndex"]) ;
		$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
		$fixingIndexTypes = $_POST['fixingIndexTypes'] ;
		$fixingIndexSources = STR_REPLACE("'","''",$_POST["fixingIndexSources"]) ;
		$fixingIndexSources = STR_REPLACE('"','""',$fixingIndexSources) ;
		$firstFixingDate = $_POST["firstFixingDate"] ;
		$lastFixingDate = $_POST["lastFixingDate"] ;
		$fixingFrequency = $_POST['fixingFrequency'] ;
		$settlementMethod = $_POST['settlementMethod'] ;
	
		if (is_null($fixingIndex))
		{$fixingIndex = 'null';}
		if (is_null($fixingIndexTypes))
		{$fixingIndexTypes = 'null';}
		if (is_null($fixingIndexSources))
		{$fixingIndexSources = 'null';}
		if (is_null($firstFixingDate)||$firstFixingDate=='')
		{$firstFixingDate = 'null';}
		else{$firstFixingDate='\''. $firstFixingDate.'\''; }
		if (is_null($lastFixingDate)||$lastFixingDate=='')
		{$lastFixingDate = 'null';}
		else{$lastFixingDate='\''. $lastFixingDate.'\''; }
		if (is_null($fixingFrequency))
		{$fixingFrequency = 'null';}
		if (is_null($settlementMethod))
		{$settlementMethod = 'null';}
		
		$sql = "INSERT INTO c_fixingindex ( c_fixingindex_id, c_fixingindex_typeofindexprice, c_fixingindex_fixingindex, c_fixingindex_fixingindextypes, c_fixingindex_fixingindexsources, c_fixingindex_firstfixingdate, c_fixingindex_lastfixingdate, c_fixingindex_fixingfrequency, c_fixingindex_settlementmethod ) VALUES ("; 
		$sql = $sql.$maxFixingIndex.",".$indexPriceType.",'".$fixingIndex."',".$fixingIndexTypes.",'".$fixingIndexSources."',".$firstFixingDate.",".$lastFixingDate.",".$fixingFrequency.",".$settlementMethod.")";
		echo($sql);
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
?>