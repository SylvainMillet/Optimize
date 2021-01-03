<?php
	require '../../connect.php';

	//Insertion marketparticipant
	$marketParticipantID = $_POST["marketParticipantID"];
	if (!empty($marketParticipantID) )
	{
		$marketParticipantIdentifier = STR_REPLACE("'","''",$_POST["marketParticipantIdentifier"]) ;
		$marketParticipantIdentifier = STR_REPLACE("'","''",$marketParticipantIdentifier) ;
		$marketParticipantName = STR_REPLACE("'","''",$_POST["marketParticipantName"]) ;
		$marketParticipantName = STR_REPLACE('"','""',$marketParticipantName) ;

		$marketParticipantType = $_POST["marketParticipantType"] ;
		
		if (is_null($marketParticipantName))
		{$marketParticipantName = 'null';}
		if (is_null($marketParticipantType))
		{$marketParticipantType = 'null';}
		if($_POST['marketParticipantDelegate']=="true")
		{
			$marketParticipantDelegate = "true" ;
		}
		else
		{
			$marketParticipantDelegate = "false" ;
		}
		
		
		
		$sql = "UPDATE e_marketparticipant SET ";
		$sql = $sql. "e_marketparticipant_identifier = '".$marketParticipantIdentifier."'";
		$sql = $sql. ", e_marketparticipant_name = '".$marketParticipantName."'";
		$sql = $sql. ", e_marketparticipant_type = ".$marketParticipantType;
		$sql = $sql. ", e_marketparticipant_delegate = ".$marketParticipantDelegate; 
		$sql = $sql. " WHERE e_marketparticipant_id = ".$marketParticipantID;
		echo $sql;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		echo('------------------------------------SUCCESS---------------------------------------------');

		header('location: modifyMarketParticipant.php');
	}


  
?>