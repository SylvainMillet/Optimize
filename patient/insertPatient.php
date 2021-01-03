<?php
	require 'connect.php';

	//Insertion patient
	$patientSexe = $_POST["overviewPatientSexe"];
	$patientNom = STR_REPLACE("'","''",$_POST["overviewPatientNom"]);
	$patientNom = STR_REPLACE('"','""',$patientNom);
	$patientPrenom = STR_REPLACE("'","''",$_POST["overviewPatientPrenom"]);
	$patientPrenom = STR_REPLACE('"','""',$patientPrenom);
	$patientBirthdate = $_POST["overviewPatientBirthdate"];
	$patientAddress = STR_REPLACE("'","''",$_POST["overviewPatientAddress"]);
	$patientAddress = STR_REPLACE('"','""',$patientAddress);
	$patientZipcode = STR_REPLACE("'","''",$_POST["overviewPatientZipcode"]);
	$patientZipcode = STR_REPLACE('"','""',$patientZipcode);
	$patientCity = STR_REPLACE("'","''",$_POST["overviewPatientCity"]);
	$patientCity = STR_REPLACE('"','""',$patientCity);
	$patientPhone = STR_REPLACE("'","''",$_POST["overviewPatientPhone"]);
	$patientPhone = STR_REPLACE('"','""',$patientPhone);
	$patientMail = STR_REPLACE("'","''",$_POST["overviewPatientMail"]);
	$patientMail = STR_REPLACE('"','""',$patientMail);
	$patientSocialSecurityNumber = STR_REPLACE("'","''",$_POST["overviewPatientSocialSecurityNumber"]);
	$patientSocialSecurityNumber = STR_REPLACE('"','""',$patientSocialSecurityNumber);
	
	$addressAddress = STR_REPLACE("'","''",$_POST["overviewAddressAddress"]);
	$addressAddress = STR_REPLACE('"','""',$addressAddress);
	$addressZipcode = STR_REPLACE("'","''",$_POST["overviewAddressZipcode"]);
	$addressZipcode = STR_REPLACE('"','""',$addressZipcode);
	$addressCity = STR_REPLACE("'","''",$_POST["overviewAddressCity"]);
	$addressCity = STR_REPLACE('"','""',$addressCity);
	$addressComments = STR_REPLACE("'","''",$_POST["overviewAddressComments"]);
	$addressComments = STR_REPLACE('"','""',$addressComments);
	$addressDoorCode1 = STR_REPLACE("'","''",$_POST["overviewAddressDoorCode1"]);
	$addressDoorCode1 = STR_REPLACE('"','""',$addressDoorCode1);
	$addressDoorCode2 = STR_REPLACE("'","''",$_POST["overviewAddressDoorCode2"]);
	$addressDoorCode2 = STR_REPLACE('"','""',$addressDoorCode2);
	$addressIntercom = STR_REPLACE("'","''",$_POST["overviewAddressIntercom"]);
	$addressIntercom = STR_REPLACE('"','""',$addressIntercom);



	if (!empty($patientNom) )
	{
		
		
		if (!empty($addressAddress) )
		{
			$sql = "INSERT INTO `adresse`(`adresse`, `codePostal`, `ville`, `commentaires`, `codePorte1`, `codePorte2`, `interphone`) VALUES ('"; 
			$sql = $sql.$addressAddress."','".$addressZipcode."','".$addressCity."','`".$addressComments."','".$addressDoorCode1."','".$addressDoorCode2."','".$addressIntercom."')";

			if(! $cnx ) {
				die('Could not connect: ' . mysqli_error());
			}
			
			$res = mysqli_query($cnx, $sql);
			if(! $res ) {
				die('Could not enter data: ' . mysqli_error());
			 }

			//$res = mysqli_query($cnx, $sql) or die('Erreur : ' . mysqli_connect_errno());

			$address = null;
			$sql = "SELECT MAX(id) FROM adresse WHERE adresse = ";
			$sql = $sql."'".$addressAddress."'"; //requete
			
			$res = mysqli_query($cnx, $sql);
			while($row = mysqli_fetch_row($res)) //tant que c'est pas la fin de la table
			{
				$address = $row[0];
			}
			
		}

		$agenda = null;
		if (!empty($agenda) )
		{
			$sql = "INSERT INTO `agenda`(`lundiDebutAM`, `lundiFinAM`, `lundiDebutPM`, `lundiFinPM`, `mardiDebutAM`, `mardiFinAM`, `mardiDebutPM`, `mardiFinPM`, `mercrediDebutAM`, `mercrediFinAM`, `mercrediDebutPM`, `mercrediFinPM`, `jeudiDebutAM`, `jeudiFinAM`, `jeudiDebutPM`, `vendrediDebutAM`, `vendrediFinAM`, `vendrediDebutPM`, `vendrediFinPM`, `samediDebutAM`, `samediFinAM`, `samediDebutPM`, `samediFinPM`, `dimancheDebutAM`, `dimancheFinAM`, `dimancheDebutPM`, `dimancheFinPM`) VALUES ('"; 
			$sql = $sql.$addressAddress."','".$addressZipcode."','".$addressComments."','".$addressDoorCode1."','".$addressDoorCode2."','".$addressIntercom."')";
			
			$res = mysqli_query($cnx, $sql);

			$query = mysqli_query( $cnx, "SELECT MAX(id) FROM agenda" ); //requete
			while($row = mysqli_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$agenda = $row[0];
			}
		}
		if (empty($agenda) )
		{
			$agenda = 'null';
		}

		$sql = "INSERT INTO `patient`(`sexe`, `nom`, `prenom`, `dateNaissance`, `adresse`, `codePostal`, `ville`, `telephone`, `email`, `numeroSecuriteSociale`, `fk_adresse`,`fk_agenda`) VALUES ('"; 
		$sql = $sql.$patientSexe."','".$patientNom."','".$patientPrenom."','".$patientBirthdate."','".$patientAddress."','".$patientZipcode."','".$patientCity."','".$patientPhone."','".$patientMail."','".$patientSocialSecurityNumber."',".$address.",".$agenda.")";
		echo $sql;
		$res = mysqli_query($cnx, $sql);


	}	
	
	
?>