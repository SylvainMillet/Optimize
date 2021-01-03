<?php
require 'connect.php';
include 'head.php';

if (($handle = fopen("C:\wamp\www\REMIT\contractS.csv", "r")) !== FALSE) {
	while (($contracts = fgetcsv($handle, 1000, ";")) !== FALSE) {

		//Insertion marketparticipant1
		$marketParticipant1Identifier = STR_REPLACE("'","''",utf8_encode($contracts[6])) ;
		$marketParticipant1Identifier = STR_REPLACE('"','""',$marketParticipant1Identifier) ;
		$marketParticipant1 = null;
		if (!empty($marketParticipant1Identifier) )
		{
			$query = pg_query( $cnx, "SELECT c_marketparticipant_id FROM c_marketparticipant WHERE c_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$marketParticipant1 = $row[0];
			}

			if (empty($marketParticipant1))
			{
				$marketParticipant1Type = $contracts[7] ;

				$query = pg_query( $cnx, "SELECT c_entitytype_id FROM c_entitytype WHERE c_entitytype_name = '".$marketParticipant1Type."'" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$marketParticipant1Type = $row[0];
				}

				$query = pg_query( $cnx, "SELECT MAX(c_marketparticipant_id)+1 FROM c_marketparticipant" ); //requete

				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$maxMarketP1 = $row[0];
				}
				if (empty($maxMarketP1))
				{
					$maxMarketP1 = 1;
				}
					
				if (empty($marketParticipant1Type))
				{$marketParticipant1Type = 'null';}

				$sql = "INSERT INTO c_marketparticipant ( c_marketparticipant_id, c_marketparticipant_identifier, c_marketparticipant_type ) VALUES (";
				$sql = $sql.$maxMarketP1.",'".$marketParticipant1Identifier."',".$marketParticipant1Type.")";

				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			}
			$query = pg_query( $cnx, "SELECT c_marketparticipant_id FROM c_marketparticipant WHERE c_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$marketParticipant1 = $row[0];
			}
		}

		//Insertion marketparticipant2
		$marketParticipant2Identifier = STR_REPLACE("'","''",$contracts[8]) ;
		$marketParticipant2Identifier = STR_REPLACE('"','""',$marketParticipant2Identifier) ;
		$marketParticipant2 = null;
		if (!empty($marketParticipant2Identifier) )
		{
			$query = pg_query( $cnx, "SELECT c_marketparticipant_id FROM c_marketparticipant WHERE c_marketparticipant_identifier = '".$marketParticipant2Identifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$marketParticipant2 = $row[0];
			}

			if (empty($marketParticipant2))
			{
				$marketParticipant2Name = STR_REPLACE("'","''",$contracts[1]) ;
				$marketParticipant2Name = STR_REPLACE('"','""',$marketParticipant2Name) ;
				$marketParticipant2Type = $contracts[9] ;
					
				$query = pg_query( $cnx, "SELECT c_entitytype_id FROM c_entitytype WHERE c_entitytype_name = '".$marketParticipant2Type."'" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$marketParticipant2Type = $row[0];
				}

				$query = pg_query( $cnx, "SELECT MAX(c_marketparticipant_id)+1 FROM c_marketparticipant" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$maxMarketP2 = $row[0];
				}
					
				if (empty($marketParticipant2Name))
				{$marketParticipant2Name = 'null';}
				if (empty($marketParticipant2Type))
				{$marketParticipant2Type = 'null';}

				$sql = "INSERT INTO c_marketparticipant ( c_marketparticipant_id, c_marketparticipant_identifier, c_marketparticipant_Name, c_marketparticipant_type ) VALUES (";
				$sql = $sql.$maxMarketP2.",'".$marketParticipant2Identifier."','".$marketParticipant2Name."',".$marketParticipant2Type.")";
echo($sql);
				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
					
				$query = pg_query( $cnx, "SELECT c_marketparticipant_id FROM c_marketparticipant WHERE c_marketparticipant_identifier = '".$marketParticipant2Identifier."'" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$marketParticipant2 = $row[0];
				}
			}
		}


		//Insertion reportingEntity
		$reportingEntityIdentifier = STR_REPLACE("'","''",$contracts[10]) ;
		$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
		$reportingEntity = null;
		if (!empty($reportingEntityIdentifier) )
		{
			$query = pg_query( $cnx, "SELECT c_reportingentity_id FROM c_reportingentity WHERE c_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$reportingEntity = $row[0];
			}

			if (empty($reportingEntity))
			{
				if (!empty($reportingEntityIdentifier) )
				{
					$reportingEntityType = $contracts[11] ;

					$query = pg_query( $cnx, "SELECT c_entitytype_id FROM c_entitytype WHERE c_entitytype_name = '".$reportingEntityType."'" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$reportingEntityType = $row[0];
					}

					$query = pg_query( $cnx, "SELECT MAX(c_reportingentity_id)+1 FROM c_reportingentity" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$maxReportingEntity = $row[0];
					}
					if (empty($maxReportingEntity))
					{
						$maxReportingEntity = 1;
					}

					if (empty($reportingEntityType))
					{$reportingEntityType = 'null';}

					$sql = "INSERT INTO c_reportingentity ( c_reportingentity_id, c_reportingentity_identifier, c_reportingentity_type ) VALUES (";
					$sql = $sql.$maxReportingEntity.",'".$reportingEntityIdentifier."',".$reportingEntityType.")";

					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;

					$query = pg_query( $cnx, "SELECT c_reportingentity_id FROM c_reportingentity WHERE c_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$reportingEntity = $row[0];
					}
				}
			}
		}


		//Insertion beneficiary
		$beneficiaryIdentifier = STR_REPLACE("'","''",$contracts[12]) ;
		$beneficiaryIdentifier = STR_REPLACE('"','""',$beneficiaryIdentifier) ;
		$beneficiary = null;
		if (!empty($beneficiaryIdentifier) )
		{
			$query = pg_query( $cnx, "SELECT c_beneficiary_id FROM c_beneficiary WHERE c_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$beneficiary = $row[0];
			}

			if (empty($beneficiary))
			{
				$beneficiaryIdentifier = $_POST["overviewBeneficiaryID"] ;
				if (!empty($beneficiaryIdentifier) )
				{
					$beneficiaryType = $contracts[13] ;

					$query = pg_query( $cnx, "SELECT c_entitytype_id FROM c_entitytype WHERE c_entitytype_name = '".$beneficiaryType."'" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$beneficiaryType = $row[0];
					}

					$query = pg_query( $cnx, "SELECT MAX(c_beneficiary_id)+1 FROM c_beneficiary" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$maxBeneficiary = $row[0];
					}
					if (empty($maxBeneficiary))
					{
						$maxBeneficiary = 1;
					}

					if (empty($beneficiaryType))
					{$beneficiaryType = 'null';}

					$sql = "INSERT INTO c_beneficiary ( c_beneficiary_id, c_beneficiary_identifier, c_beneficiary_type ) VALUES (";
					$sql = $sql.$maxBeneficiary.",'".$beneficiaryIdentifier."',".$beneficiaryType.")";

					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;

					$query = pg_query( $cnx, "SELECT c_beneficiary_id FROM c_beneficiary WHERE c_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
					while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
					{
						$beneficiary = $row[0];
					}
				}
			}
		}


		//Insertion parties
		$query = pg_query( $cnx, "SELECT MAX(c_parties_id)+1 FROM c_parties" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxParties = $row[0];
		}
		if (empty($maxParties))
		{
			$maxParties = 1;
		}

		$tradingCapacity = $contracts[14] ;
		$query = pg_query( $cnx, "SELECT c_tradingcapacity_id FROM c_tradingcapacity WHERE c_tradingcapacity_name = '".$tradingCapacity."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$tradingCapacity = $row[0];
		}
		$buySellIndicator = $contracts[15] ;
		$query = pg_query( $cnx, "SELECT c_buysellindicator_id FROM c_buysellindicator WHERE c_buysellindicator_name = '".$buySellIndicator."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$buySellIndicator = $row[0];
		}

		if (empty($reportingEntity))
		{$reportingEntity = 'null';}
		if (empty($beneficiary))
		{$beneficiary = 'null';}
		if (empty($tradingCapacity))
		{$tradingCapacity = 'null';}
		if (empty($buySellIndicator))
		{$buySellIndicator = 'null';}
		$sql = "INSERT INTO c_parties ( c_parties_id, c_parties_marketparticipant1, c_parties_marketparticipant2, c_parties_reportingentity, c_parties_beneficiary, c_parties_tradingcapacity, c_parties_buysellindicator) VALUES (";
		$sql = $sql.$maxParties.",".$marketParticipant1.",".$marketParticipant2.",".$reportingEntity.",".$beneficiary.",".$tradingCapacity.",".$buySellIndicator.")";

		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;


		//Insert contract
		$contractID = STR_REPLACE("'","''",$contracts[16]) ;
		$contractID = STR_REPLACE('"','""',$contractID) ;

		if (!empty($contractID) )
		{
			$query = pg_query( $cnx, "SELECT MAX(c_contract_id)+1 FROM c_contract" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxcontract = $row[0];
			}
			if (empty($maxcontract))
			{
				$maxcontract = 1;
			}
			$contractDate = $contracts[17] ;
			$contractType = $contracts[18] ;
			$query = pg_query( $cnx, "SELECT c_contracttype_id FROM c_contracttype WHERE c_contracttype_name = '".$contractType."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$contractType = $row[0];
			}
			$energyCommodity = $contracts[19] ;
			$query = pg_query( $cnx, "SELECT c_energycommodity_id FROM c_energycommodity WHERE c_energycommodity_name = '".$energyCommodity."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$energyCommodity = $row[0];
			}

			if (is_string(utf8_decode($contracts[20])))
			{
				$priceFormula = STR_REPLACE("'","''",$contracts[20]) ;
				$priceFormula = STR_REPLACE('"','""',$priceFormula) ;
			}
			if (is_numeric($contracts[20]))
			{
				$price = $contracts[20] ;
			}

			$query = pg_query( $cnx, "SELECT MAX(c_price_id)+1 FROM c_price" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxPrice = $row[0];
			}
			if (empty($maxPrice))
			{
				$maxPrice = 1;
			}

			if (empty($priceFormula))
			{$priceFormula = 'null';}
			if (empty($price)||$price=='')
			{$price = 'null';}

			$sql = "INSERT INTO c_price ( c_price_id, c_price_formula, c_price ) VALUES (";
			$sql = $sql.$maxPrice.",'".$priceFormula."',".$price.")";
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;

			$estimatedNotionalAmount = STR_REPLACE("'","''",$contracts[21]) ;
			$estimatedNotionalAmount = STR_REPLACE('"','""',$estimatedNotionalAmount) ;
			$notionalCurrency = $contracts[22] ;
			$query = pg_query( $cnx, "SELECT c_currency_id FROM c_currency WHERE c_currency_name = '".$notionalCurrency."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$notionalCurrency = $row[0];
			}
			$totalNotionalcontractQuantity = STR_REPLACE("'","''",$contracts[23]) ;
			$totalNotionalcontractQuantity = STR_REPLACE('"','""',$totalNotionalcontractQuantity) ;
			$volumeOptionalityCapacity = STR_REPLACE("'","''",$contracts[24]) ;
			$volumeOptionalityCapacity = STR_REPLACE('"','""',$volumeOptionalityCapacity) ;
			$totalNotionalcontractQuantityUnit = $contracts[25] ;
			$query = pg_query( $cnx, "SELECT c_quantityunit_id FROM c_quantityunit WHERE c_quantityunit_name = '".$totalNotionalcontractQuantityUnit."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$totalNotionalcontractQuantityUnit = $row[0];
			}
			$volumeOptionalityCapacityUnit = $contracts[26] ;
			$query = pg_query( $cnx, "SELECT c_quantityunit_id FROM c_quantityunit WHERE c_quantityunit_name = '".$volumeOptionalityCapacityUnit."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$volumeOptionalityCapacityUnit = $row[0];
			}
			$volumeOptionality = $contracts[27] ;
			$query = pg_query( $cnx, "SELECT c_volumeoptionality_id FROM c_volumeoptionality WHERE c_volumeoptionality_name = '".$volumeOptionality."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$volumeOptionality = $row[0];
			}
			$volumeOptionalityFrequency = $contracts[28] ;
			$query = pg_query( $cnx, "SELECT c_frequency_id FROM c_frequency WHERE c_frequency_name = '".$volumeOptionalityFrequency."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$volumeOptionalityFrequency = $row[0];
			}
			$volumeOptionalityIntervals = STR_REPLACE("'","''",$contracts[29]) ;
			$volumeOptionalityIntervals = STR_REPLACE('"','""',$volumeOptionalityIntervals) ;

			if (empty($contractDate)||$contractDate=='')
			{$contractDate = 'null';}
			else{$contractDate='\''. $contractDate.'\''; }
			if (empty($contractType))
			{$contractType = 'null';}
			if (empty($energyCommodity))
			{$energyCommodity = 'null';}
			if (empty($maxPrice))
			{$maxPrice = 'null';}
			if (empty($estimatedNotionalAmount)||$estimatedNotionalAmount=='')
			{$estimatedNotionalAmount = 'null';}
			if (empty($notionalCurrency))
			{$notionalCurrency = 'null';}
			if (empty($totalNotionalcontractQuantity)||$totalNotionalcontractQuantity=='')
			{$totalNotionalcontractQuantity = 'null';}
			if (empty($volumeOptionalityCapacity)||$volumeOptionalityCapacity=='')
			{$volumeOptionalityCapacity = 'null';}
			if (empty($totalNotionalcontractQuantityUnit))
			{$totalNotionalcontractQuantityUnit = 'null';}
			if (empty($volumeOptionalityCapacityUnit))
			{$volumeOptionalityCapacityUnit = 'null';}
			if (empty($volumeOptionality))
			{$volumeOptionality = 'null';}
			if (empty($volumeOptionalityFrequency))
			{$volumeOptionalityFrequency = 'null';}
			if (empty($volumeOptionalityIntervals))
			{$volumeOptionalityIntervals = 'null';}

			$sql = "INSERT INTO c_contract ( c_contract_id, c_contract_identifier, c_contract_date, c_contract_type, c_contract_energycommodity, c_contract_price, c_contract_estimatednotionalamount, c_contract_notionalcurrency, c_contract_totalnotionalcontractquantity, c_contract_volumeoptionalitycapacity, c_contract_totalnotionalcontractquantityunit, c_contract_volumeoptionalitycapacityunit, c_contract_volumeoptionality, c_contract_volumeoptionalityfrequency, c_contract_volumeoptionalityintervals ) VALUES (";
			$sql = $sql.$maxcontract.",'".$contractID."',".$contractDate.",".$contractType.",".$energyCommodity.",".$maxPrice.",".$estimatedNotionalAmount.",".$notionalCurrency.",".$totalNotionalcontractQuantity.",".$volumeOptionalityCapacity.",".$totalNotionalcontractQuantityUnit.",".$volumeOptionalityCapacityUnit.",".$volumeOptionality.",".$volumeOptionalityFrequency.",'".$volumeOptionalityIntervals."')";

			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}
		

		//Insert delivery
		$deliveryPointName = STR_REPLACE("'","''",$contracts[47]) ;
		$deliveryPointName = STR_REPLACE('"','""',$deliveryPointName) ;
		if (!empty($deliveryPointName) )
		{
			$query = pg_query( $cnx, "SELECT c_deliverypoint_identifier FROM c_deliverypoint WHERE c_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$deliveryPoint = $row[0];
			}
			if (empty($deliveryPoint))
			{
				$query = pg_query( $cnx, "SELECT MAX(c_deliverypoint_id)+1 FROM c_deliverypoint" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$deliveryPoint = $row[0];
				}
				if (empty($deliveryPoint))
				{
					$deliveryPoint = 1;
				}

				$sql = "INSERT INTO c_deliverypoint ( c_deliverypoint_id, c_deliverypoint_identifier ) VALUES (";
				$sql = $sql.$deliveryPoint.",'".$deliveryPointName."')";

				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			}
			$query = pg_query( $cnx, "SELECT c_deliverypoint_id FROM c_deliverypoint WHERE c_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$deliveryPoint = $row[0];
			}

			$query = pg_query( $cnx, "SELECT MAX(c_deliveryprofile_id)+1 FROM c_deliveryprofile" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxDeliveryProfile = $row[0];
			}
			if (empty($maxDeliveryProfile))
			{
				$maxDeliveryProfile = 1;
			}
			$deliveryStartDate = $contracts[48] ;
			$deliveryEndDate = $contracts[49] ;
			$loadType = $contracts[50] ;
			$query = pg_query( $cnx, "SELECT c_loadtype_id FROM c_loadtype WHERE c_loadtype_name = '".$loadType."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$loadType = $row[0];
			}

			if (empty($deliveryPoint))
			{$deliveryPoint = 'null';}
			if (empty($deliveryStartDate)||$deliveryStartDate=='')
			{$deliveryStartDate = 'null';}
			else{$deliveryStartDate='\''. $deliveryStartDate.'\''; }
			if (empty($deliveryEndDate)||$deliveryEndDate=='')
			{$deliveryEndDate = 'null';}
			else{$deliveryEndDate='\''. $deliveryEndDate.'\''; }
			if (empty($loadType))
			{$loadType = 'null';}

			$sql = "INSERT INTO c_deliveryprofile ( c_deliveryprofile_id, c_deliveryprofile_deliverypoint, c_deliveryprofile_deliverystartdate, c_deliveryprofile_deliveryenddate, c_deliveryprofile_loadtype ) VALUES (";
			$sql = $sql.$maxDeliveryProfile.",".$deliveryPoint.",".$deliveryStartDate.",".$deliveryEndDate.",".$loadType.")";

			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}


		//Insert contract
		$actionType = $contracts[51] ;
		$query = pg_query( $cnx, "SELECT c_actiontype_id FROM c_actiontype WHERE c_actiontype_name = '".$actionType."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$actionType = $row[0];
		}

		if (!empty($actionType) )
		{
			$query = pg_query( $cnx, "SELECT MAX(contract_id)+1 FROM contract" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$contract = $row[0];
			}
			if (empty($contract))
			{
				$contract = 1;
			}

			$query = pg_query( $cnx, "SELECT MAX(c_contract_id) FROM c_contract" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxcontract = $row[0];
			}
			
			$query = pg_query( $cnx, "SELECT MAX(c_deliveryprofile_id) FROM c_deliveryprofile" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxDeliveryProfile = $row[0];
			}
			
			if (empty($maxcontract))
			{$maxcontract = 'null';}
			if (empty($maxParties))
			{$maxParties = 'null';}
			if (empty($maxDeliveryProfile))
			{$maxDeliveryProfile = 'null';}
			if (empty($actionType))
			{$actionType = 'null';}

			$sql = "INSERT INTO contract ( contract_id, contract_Parties, contract_contract, contract_deliveryprofile, contract_actiontype ) VALUES (";
			$sql = $sql.$contract.",".$maxParties.",".$maxcontract.",".$maxDeliveryProfile.",".$actionType.")";
			echo($sql);
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
		}
			
					
		//Insert fixing index
		$indexPriceType = $contracts[30] ;
		$query = pg_query( $cnx, "SELECT c_typeofindexprice_id FROM c_typeofindexprice WHERE c_typeofindexprice_name = '".$indexPriceType."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$indexPriceType = $row[0];
		}
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

			$fixingIndex = STR_REPLACE("'","''",$contracts[31]) ;
			$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
			$fixingIndexTypes = $contracts[32] ;
			$query = pg_query( $cnx, "SELECT c_fxingindextypes_id FROM c_fxingindextypes WHERE c_fxingindextypes_name = '".$fixingIndexTypes."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$fixingIndexTypes = $row[0];
			}
			$fixingIndexSources = STR_REPLACE("'","''",$contracts[33]) ;
			$fixingIndexSources = STR_REPLACE('"','""',$fixingIndexSources) ;
			$firstFixingDate = $contracts[34] ;
			$lastFixingDate = $contracts[35] ;
			$fixingFrequency = $contracts[36] ;
			$query = pg_query( $cnx, "SELECT c_frequency_id FROM c_frequency WHERE c_frequency_name = '".$fixingFrequency."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$fixingFrequency = $row[0];
			}
			$settlementMethod = $contracts[37] ;
			$query = pg_query( $cnx, "SELECT c_settlementmethod_id FROM c_settlementmethod WHERE c_settlementmethod_name = '".$settlementMethod."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$settlementMethod = $row[0];
			}

			if (empty($fixingIndex))
			{$fixingIndex = 'null';}
			if (empty($fixingIndexTypes))
			{$fixingIndexTypes = 'null';}
			if (empty($fixingIndexSources))
			{$fixingIndexSources = 'null';}
			if (empty($firstFixingDate)||$firstFixingDate=='')
			{$firstFixingDate = 'null';}
			else{$firstFixingDate='\''. $firstFixingDate.'\''; }
			if (empty($lastFixingDate)||$lastFixingDate=='')
			{$lastFixingDate = 'null';}
			else{$lastFixingDate='\''. $lastFixingDate.'\''; }
			if (empty($fixingFrequency))
			{$fixingFrequency = 'null';}
			if (empty($settlementMethod))
			{$settlementMethod = 'null';}

			$sql = "INSERT INTO c_fixingindex ( c_fixingindex_id, c_fixingindex_typeofindexprice, c_fixingindex_fixingindex, c_fixingindex_fixingindextypes, c_fixingindex_fixingindexsources, c_fixingindex_firstfixingdate, c_fixingindex_lastfixingdate, c_fixingindex_fixingfrequency, c_fixingindex_settlementmethod, c_fixingindex_contract ) VALUES (";
			$sql = $sql.$maxFixingIndex.",".$indexPriceType.",'".$fixingIndex."',".$fixingIndexTypes.",'".$fixingIndexSources."',".$firstFixingDate.",".$lastFixingDate.",".$fixingFrequency.",".$settlementMethod.",".$contract.")";
echo($sql);
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}


		//Insert option
		$optionType = $contracts[39] ;
		$query = pg_query( $cnx, "SELECT c_optiontype_id FROM c_optiontype WHERE c_optiontype_name = '".$optionType."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$optionType = $row[0];
		}
		if (!empty($optionType) )
		{
			$query = pg_query( $cnx, "SELECT MAX(c_option_id)+1 FROM c_option" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxOption = $row[0];
			}
			if (empty($maxOption))
			{
				$maxOption = 1;
			}
			$optionStyle = $contracts[38] ;
			$query = pg_query( $cnx, "SELECT c_optionstyle_id FROM c_optionstyle WHERE c_optionstyle_name = '".$optionStyle."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$optionStyle = $row[0];
			}
			$firstExerciseDate = $contracts[40] ;
			$lastExerciseDate = $contracts[41] ;
			$exerciseFrequency = $contracts[42] ;
			$query = pg_query( $cnx, "SELECT c_frequency_id FROM c_frequency WHERE c_frequency_name = '".$exerciseFrequency."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$exerciseFrequency = $row[0];
			}
			$strikeIndex = STR_REPLACE("'","''",$contracts[43]) ;
			$strikeIndex = STR_REPLACE('"','""',$strikeIndex) ;
			$strikeIndexType = $contracts[44] ;
			$query = pg_query( $cnx, "SELECT c_optionstrikeindextype_id FROM c_optionstrikeindextype WHERE c_optionstrikeindextype_name = '".$strikeIndexType."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$strikeIndexType = $row[0];
			}
			$strikeIndexSource = STR_REPLACE("'","''",$contracts[45]) ;
			$strikeIndexSource = STR_REPLACE('"','""',$strikeIndexSource) ;
			$strikePrice = $contracts[46] ;

			if (empty($optionStyle))
			{$optionStyle = 'null';}
			if (empty($firstExerciseDate)||$firstExerciseDate=='')
			{$firstExerciseDate = 'null';}
			else{$firstExerciseDate='\''. $firstExerciseDate.'\''; }
			if (empty($lastExerciseDate)||$lastExerciseDate=='')
			{$lastExerciseDate = 'null';}
			else{$lastExerciseDate='\''. $lastExerciseDate.'\''; }
			if (empty($exerciseFrequency))
			{$exerciseFrequency = 'null';}
			if (empty($strikeIndex))
			{$strikeIndex = 'null';}
			if (empty($strikeIndexType))
			{$strikeIndexType = 'null';}
			if (empty($strikeIndexSource))
			{$strikeIndexSource = 'null';}
			if (empty($strikePrice))
			{$strikePrice = 'null';}

			$sql = "INSERT INTO  c_option ( c_option_id, c_option_style, c_option_type, c_option_firstexercisedate, c_option_lastexercisedate, c_option_exercisefrequency, c_option_strikeindex, c_option_strikeindextype, c_option_strikeindexsource, c_option_strikeprice, c_option_contract ) VALUES (";
			$sql = $sql.$maxOption.",".$optionStyle.",".$optionType.",".$firstExerciseDate.",".$lastExerciseDate.",".$exerciseFrequency.",'".$strikeIndex."',".$strikeIndexType.",'".$strikeIndexSource."',".$strikePrice.",".$contract.")";
echo($sql);
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}
				
		

		$bill = $contracts[0] ;
		if (!empty($bill) )
		{
			$query = pg_query( $cnx, "SELECT MAX(c_bill_id)+1 FROM c_bill" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$billMax = $row[0];
			}
			if (empty($billMax))
			{
				$billMax = 1;
			}
			$sql = "INSERT INTO c_bill ( c_bill_id, c_bill_name, c_bill_contract ) VALUES (";
			$sql = $sql.$billMax.",'".$bill."',".$contract.")";

			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}

	}
	fclose($handle);
}


?>