<?php
require 'connect.php';
include 'head.php';

if (($handle = fopen('C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_userChangeDATA.csv', 'r')) !== FALSE) {
	
	$nbAvoirs = 0;
	$nbExecutions = 0;

	
	while (($executions = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$transactionID = STR_REPLACE("'","''",$executions[32]) ; //UTI
		$transactionID = STR_REPLACE('"','""',$transactionID) ;
		$internCancelledBill = '';
		$internCancelledBill = $executions[60] ;
		$internBill = $executions[61] ;
		
		//si on a une facture ‡ annuler, on lance un update de l'existente en gardant les numÈros internes de l'avoir et on passe l'actionType ‡ Cancel
		if (!empty($internCancelledBill) )
			{
				$query = pg_query ( $cnx, "SELECT e_actiontype_id FROM e_actiontype WHERE e_actiontype_name = 'C'" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$actionType = $row[0];
				}
				$nbAvoirs ++;
				
				$query = pg_query( $cnx, "UPDATE execution SET execution_actiontype = ".$actionType." , execution_xml = False , execution_uti_asset = '".$transactionID."' , execution_bill_intern_asset = '".$internBill."' WHERE execution_id = (SELECT execution_id FROM execution WHERE execution_bill_intern = '".$internCancelledBill."')"   ); //requete
			}
		else
			{
				//Insertion marketparticipant1
				$marketParticipant1Identifier = STR_REPLACE("'","''",$executions[3]) ;
				$marketParticipant1Identifier = STR_REPLACE('"','""',$marketParticipant1Identifier) ;
				$marketParticipant1 = null;
				if (!empty($marketParticipant1Identifier) )
				{
					$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$marketParticipant1 = $row[0];
					}
		
					if (empty($marketParticipant1))
					{
						$marketParticipant1Type = $executions[4] ;
						
						$query = pg_query( $cnx, "SELECT e_entitytype_id FROM e_entitytype WHERE e_entitytype_name = '".$marketParticipant1Type."'" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$marketParticipant1Type = $row[0];
						}
		
						$query = pg_query( $cnx, "SELECT MAX(e_marketparticipant_id)+1 FROM e_marketparticipant" ); //requete
						
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$maxMarketP1 = $row[0];
						}
						if (empty($maxMarketP1))
						{
							$maxMarketP1 = 1;
						}
							
						if (empty($marketParticipant1Type))
						{$marketParticipant1Type = 'null';}
		
						$sql = "INSERT INTO e_marketparticipant ( e_marketparticipant_id, e_marketparticipant_identifier, e_marketparticipant_type ) VALUES (";
						$sql = $sql.$maxMarketP1.",'".$marketParticipant1Identifier."',".$marketParticipant1Type.")";
		
						//execution de la requete SQL:
						$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
					}
					$query = pg_query ( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$marketParticipant1 = $row[0];
					}
				}
		
				//Insertion trader
				$traderIdentifier = STR_REPLACE("'","''",$executions[5]) ;
				$traderIdentifier = STR_REPLACE('"','""',$traderIdentifier) ;
				$traderName = STR_REPLACE("'","''",$executions[2]) ;
				$traderName = STR_REPLACE('"','""',$traderName) ;
				$trader = null;
				if (!empty($traderIdentifier) )
				{
					$query = pg_query( $cnx, "SELECT e_trader_id FROM e_trader WHERE e_trader_identifier = '".$traderIdentifier."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$trader = $row[0];
					}
		
					if (empty($trader))
					{
						$query = pg_query( $cnx, "SELECT MAX(e_trader_id)+1 FROM e_trader" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$maxTrader = $row[0];
						}
						if (empty($maxTrader))
						{
							$maxTrader = 1;
						}
							
						if (empty($traderIdentifier))
						{$traderIdentifier = 'null';}
		
						$sql = "INSERT INTO e_trader ( e_trader_id, e_trader_identifier, e_trader_name ) VALUES (";
						$sql = $sql.$maxTrader.",'".$traderIdentifier."','".$traderName."')";
		
						//execution de la requete SQL:
						$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
							
						$query = pg_query( $cnx, "SELECT e_trader_id FROM e_trader WHERE e_trader_identifier = '".$traderIdentifier."'" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$trader = $row[0];
						}
					}
				}
		
		
				//Insertion marketparticipant2
				$marketParticipant2Identifier = STR_REPLACE("'","''",$executions[6]) ;
				$marketParticipant2Identifier = STR_REPLACE('"','""',$marketParticipant2Identifier) ;
				$marketParticipant2 = null;
				$marketParticipant2Name = STR_REPLACE("'","''",$executions[1]) ;
				$marketParticipant2Name = STR_REPLACE('"','""',$marketParticipant2Name) ;
				
				if (!is_null($marketParticipant2Identifier) )
				{
					$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant2Identifier."' and e_marketparticipant_name = '".$marketParticipant2Name."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$marketParticipant2 = $row[0];
					}
		
					if (is_null($marketParticipant2))
					{
						$marketParticipant2Type = $executions[7] ;
							
						$query = pg_query( $cnx, "SELECT e_entitytype_id FROM e_entitytype WHERE e_entitytype_name = '".$marketParticipant2Type."'" ); //requete

						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$marketParticipant2Type = $row[0];
						}
		
						$query = pg_query( $cnx, "SELECT MAX(e_marketparticipant_id)+1 FROM e_marketparticipant" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$maxMarketP2 = $row[0];
						}
						
						if (empty($marketParticipant2Type))
						{$marketParticipant2Type = 'null';}
		
						$sql = "INSERT INTO e_marketparticipant ( e_marketparticipant_id, e_marketparticipant_identifier, e_marketparticipant_name, e_marketparticipant_type ) VALUES (";
						$sql = $sql.$maxMarketP2.",'".$marketParticipant2Identifier."','".$marketParticipant2Name."',".$marketParticipant2Type.")";

						//execution de la requete SQL:
						$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
							
						$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant2Identifier."'" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$marketParticipant2 = $row[0];
						}
					}
				}
		
		
				//Insertion reportingEntity
				$reportingEntityIdentifier = STR_REPLACE("'","''",$executions[8]) ;
				$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
				$reportingEntity = null;
				if (!empty($reportingEntityIdentifier) )
				{
					$query = pg_query( $cnx, "SELECT e_reportingentity_id FROM e_reportingentity WHERE e_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$reportingEntity = $row[0];
					}
		
					if (empty($reportingEntity))
					{
						if (!empty($reportingEntityIdentifier) )
						{
							$reportingEntityType = $executions[9] ;
		
							$query = pg_query( $cnx, "SELECT e_entitytype_id FROM e_entitytype WHERE e_entitytype_name = '".$reportingEntityType."'" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$reportingEntityType = $row[0];
							}
		
							$query = pg_query( $cnx, "SELECT MAX(e_reportingentity_id)+1 FROM e_reportingentity" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$maxReportingEntity = $row[0];
							}
							if (empty($maxReportingEntity))
							{
								$maxReportingEntity = 1;
							}
		
							if (empty($reportingEntityType))
							{$reportingEntityType = 'null';}
								
							$sql = "INSERT INTO e_reportingentity ( e_reportingentity_id, e_reportingentity_identifier, e_reportingentity_type ) VALUES (";
							$sql = $sql.$maxReportingEntity.",'".$reportingEntityIdentifier."',".$reportingEntityType.")";
							
							//execution de la requete SQL:
							$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
							$query = pg_query( $cnx, "SELECT e_reportingentity_id FROM e_reportingentity WHERE e_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$reportingEntity = $row[0];
							}
						}
					}
				}
		
		
				//Insertion beneficiary
				$beneficiaryIdentifier = STR_REPLACE("'","''",$executions[10]) ;
				$beneficiaryIdentifier = STR_REPLACE('"','""',$beneficiaryIdentifier) ;
				$beneficiary = null;
				if (!empty($beneficiaryIdentifier) )
				{
					$query = pg_query( $cnx, "SELECT e_beneficiary_id FROM e_beneficiary WHERE e_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$beneficiary = $row[0];
					}
		
					if (empty($beneficiary))
					{
						$beneficiaryIdentifier = $_POST["overviewBeneficiaryID"] ;
						if (!empty($beneficiaryIdentifier) )
						{
							$beneficiaryType = $executions[11] ;
		
							$query = pg_query( $cnx, "SELECT e_entitytype_id FROM e_entitytype WHERE e_entitytype_name = '".$beneficiaryType."'" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$beneficiaryType = $row[0];
							}
								
							$query = pg_query( $cnx, "SELECT MAX(e_beneficiary_id)+1 FROM e_beneficiary" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$maxBeneficiary = $row[0];
							}
							if (empty($maxBeneficiary))
							{
								$maxBeneficiary = 1;
							}
		
							if (empty($beneficiaryType))
							{$beneficiaryType = 'null';}
								
							$sql = "INSERT INTO e_beneficiary ( e_beneficiary_id, e_beneficiary_identifier, e_beneficiary_type ) VALUES (";
							$sql = $sql.$maxBeneficiary.",'".$beneficiaryIdentifier."',".$beneficiaryType.")";
								
							//execution de la requete SQL:
							$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
							$query = pg_query( $cnx, "SELECT e_beneficiary_id FROM e_beneficiary WHERE e_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
							while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
							{
								$beneficiary = $row[0];
							}
						}
					}
				}
		
		
				//Insertion parties
				$query = pg_query( $cnx, "SELECT MAX(e_parties_id)+1 FROM e_parties" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$maxParties = $row[0];
				}
				if (empty($maxParties))
				{
					$maxParties = 1;
				}
		
				$tradingCapacity = $executions[12] ;
				$query = pg_query( $cnx, "SELECT e_tradingcapacity_id FROM e_tradingcapacity WHERE e_tradingcapacity_name = '".$tradingCapacity."'" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$tradingCapacity = $row[0];
				}
				$buySellIndicator = $executions[13] ;
				$query = pg_query( $cnx, "SELECT e_buysellindicator_id FROM e_buysellindicator WHERE e_buysellindicator_name = '".$buySellIndicator."'" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$buySellIndicator = $row[0];
				}
				$initiatorAggressor = $executions[14] ;
				$query = pg_query( $cnx, "SELECT e_initiatoraggressor_id FROM e_initiatoraggressor WHERE e_initiatoraggressor_name = '".$initiatorAggressor."'" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$initiatorAggressor = $row[0];
				}
		
				if (empty($trader))
				{$trader = 'null';}
				if (empty($reportingEntity))
				{$reportingEntity = 'null';}
				if (empty($beneficiary))
				{$beneficiary = 'null';}
				if (empty($tradingCapacity))
				{$tradingCapacity = 'null';}
				if (empty($buySellIndicator))
				{$buySellIndicator = 'null';}
				if (empty($initiatorAggressor))
				{$initiatorAggressor = 'null';}
		
				$sql = "INSERT INTO e_parties ( e_parties_id, e_parties_marketparticipant1, e_parties_trader, e_parties_marketparticipant2, e_parties_reportingentity, e_parties_beneficiary, e_parties_tradingcapacity, e_parties_buysellindicator, e_parties_initiatoraggressor) VALUES (";
				$sql = $sql.$maxParties.",".$marketParticipant1.",".$trader.",".$marketParticipant2.",".$reportingEntity.",".$beneficiary.",".$tradingCapacity.",".$buySellIndicator.",".$initiatorAggressor.")";
				
				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
		
				//Insert order
				$orderID = STR_REPLACE("'","''",$executions[15]) ;
				$orderID = STR_REPLACE('"','""',$orderID) ;
				if (!empty($orderID) )
				{
					$query = pg_query( $cnx, "SELECT MAX(e_order_id)+1 FROM e_order" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$maxOrder = $row[0];
					}
					if (empty($maxOrder))
					{
						$maxOrder = 1;
					}
		
					$orderType = $executions[16] ;
					$query = pg_query( $cnx, "SELECT e_ordertype_id FROM e_ordertype WHERE e_ordertype_name = '".$orderType."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$orderType = $row[0];
					}
					$orderCondition = $executions[17] ;
					$query = pg_query( $cnx, "SELECT e_ordercondition_id FROM e_ordercondition WHERE e_ordercondition_name = '".$orderCondition."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$orderCondition = $row[0];
					}
					$orderStatus = $executions[18] ;
					$query = pg_query( $cnx, "SELECT e_orderstatus_id FROM e_orderstatus WHERE e_orderstatus_name = '".$orderStatus."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$orderStatus = $row[0];
					}
					$minimumExecutionVolume = $executions[19] ;
					$priceLimit = STR_REPLACE(',','.',$executions[20]) ;
					$undisclosedVolume = STR_REPLACE(',','.',$executions[21]) ;
					$orderDuration = $executions[22] ;
					$query = pg_query( $cnx, "SELECT e_orderduration_id FROM e_orderduration WHERE e_orderduration_name = '".$orderDuration."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$orderDuration = $row[0];
					}
		
					if (empty($orderType))
					{$orderType = 'null';}
					if (empty($orderCondition))
					{$orderCondition = 'null';}
					if (empty($orderStatus))
					{$orderStatus = 'null';}
					if (empty($minimumExecutionVolume))
					{$minimumExecutionVolume = 'null';}
					if (empty($priceLimit))
					{$priceLimit = 'null';}
					if (empty($undisclosedVolume))
					{$undisclosedVolume = 'null';}
					if (empty($orderDuration))
					{$orderDuration = 'null';}
		
					$sql = "INSERT INTO e_order ( e_order_id, e_order_identifier, e_order_type, e_order_condition, e_order_status, e_order_minimumexecutionvolume, e_order_pricelimit, e_order_undisclosedvolume, e_order_duration ) VALUES (";
					$sql = $sql.$maxOrder.",'".$orderID."',".$orderType.",".$orderCondition.",".$orderStatus.",".$minimumExecutionVolume.",".$priceLimit.",".$undisclosedVolume.",".$orderDuration.")";
					
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
		
		
				//Insert contract
				$contractID = STR_REPLACE("'","''",$executions[23]) ;
				$contractID = STR_REPLACE('"','""',$contractID) ;
				if (!empty($contractID) )
				{
					$query = pg_query( $cnx, "SELECT MAX(e_contract_id)+1 FROM e_contract" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$maxcontract = $row[0];
					}
					if (empty($maxcontract))
					{
						$maxcontract = 1;
					}
					$contractName = STR_REPLACE("'","''",$executions[24]) ;
					$contractName = STR_REPLACE('"','""',$contractName) ;
					$contractType = $executions[25] ;
					$query = pg_query( $cnx, "SELECT e_contracttype_id FROM e_contracttype WHERE e_contracttype_name = '".$contractType."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$contractType = $row[0];
					}
					$energyCommodity = $executions[26] ;
					$query = pg_query( $cnx, "SELECT e_energycommodity_id FROM e_energycommodity WHERE e_energycommodity_name = '".$energyCommodity."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$energyCommodity = $row[0];
					}
					$fixingIndex = STR_REPLACE("'","''",$executions[27]) ;
					$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
					$settlementMethod = $executions[27] ;

					$query = pg_query( $cnx, "SELECT e_settlementmethod_id FROM e_settlementmethod WHERE e_settlementmethod_name = '".$settlementMethod."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$settlementMethod = $row[0];
					}
					$organisedMarketPlace = $executions[28] ;
					$query = pg_query( $cnx, "SELECT e_organisedmarketplace_id FROM e_organisedmarketplace WHERE e_organisedmarketplace_name = '".$organisedMarketPlace."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$organisedMarketPlace = $row[0];
					}
					$tradingHours = $executions[29] ;
					$lastTraidingDate= $executions[30] ;
		
					if (empty($contractName))
					{$contractName = 'null';}
					if (empty($contractType))
					{$contractType = 'null';}
					if (empty($energyCommodity))
					{$energyCommodity = 'null';}
					if (empty($fixingIndex))
					{$fixingIndex = 'null';}
					if (empty($settlementMethod))
					{$settlementMethod = 'null';}
					if (empty($organisedMarketPlace))
					{$organisedMarketPlace = 'null';}
					if (empty($tradingHours))
					{$tradingHours = 'null';}
					if (empty($lastTraidingDate)||$lastTraidingDate=='')
					{$lastTraidingDate = 'null';}
					else{$lastTraidingDate='\''. $lastTraidingDate.'\''; }
		
					$sql = "INSERT INTO e_contract ( e_contract_id, e_contract_identifier, e_contract_name, e_contract_type, e_contract_energycommodity, e_contract_fixingindex, e_contract_settlementmethod, e_contract_organisedmarketplace, e_contract_tradinghours, e_contract_lasttraidingdate ) VALUES (";
					$sql = $sql.$maxcontract.",'".$contractID."','".$contractName."',".$contractType.",".$energyCommodity.",'".$fixingIndex."',".$settlementMethod.",".$organisedMarketPlace.",".$tradingHours.",".$lastTraidingDate.")";
					
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
		
		
				//Insert transaction
				if (!empty($transactionID) )
				{
					$query = pg_query( $cnx, "SELECT MAX(e_transaction_id)+1 FROM e_transaction" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$maxTransaction = $row[0];
					}
					if (empty($maxTransaction))
					{
						$maxTransaction = 1;
					}
					$transactionTimestamp = $executions[31] ;
					$linkedTransactionID = STR_REPLACE("'","''",$executions[33]) ;
					$linkedTransactionID = STR_REPLACE('"','""',$linkedTransactionID) ;
					$linkedOrderID = '' ;
					$voicebrokered = $executions[34] ;
					$query = pg_query( $cnx, "SELECT e_voicebrokered_id FROM e_voicebrokered WHERE e_voicebrokered_name = '".$voicebrokered."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$voicebrokered = $row[0];
					}
					$price = STR_REPLACE(',','.',$executions[35]) ;
					$indexValue = $executions[36] ;
					$priceCurrency = $executions[37] ;
					$query = pg_query( $cnx, "SELECT e_currency_id FROM e_currency WHERE e_currency_name = '".$priceCurrency."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$priceCurrency = $row[0];
					}
					$notionalAmount = STR_REPLACE(',','.',$executions[38]) ;
					$notionalCurrency = $executions[39] ;
					$query = pg_query( $cnx, "SELECT e_currency_id FROM e_currency WHERE e_currency_name = '".$notionalCurrency."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$notionalCurrency = $row[0];
					}
					$quantity = $executions[40] ;
					$totalNotionalcontractQuantity = $executions[41] ;
					$quantityUnit = $executions[42] ;
					$query = pg_query( $cnx, "SELECT e_quantityunit_id FROM e_quantityunit WHERE LOWER(e_quantityunit_name) = LOWER('".$quantityUnit."')" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$quantityUnit = $row[0];
					}
					$totalNotionalcontractQuantityUnit = $executions[43] ;
					$query = pg_query( $cnx, "SELECT e_quantityunit_id FROM e_quantityunit WHERE LOWER(e_quantityunit_name) = LOWER('".$totalNotionalcontractQuantityUnit."')" ); //requete

					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$totalNotionalcontractQuantityUnit = $row[0];
					}
					$terminationDate = $executions[44] ;
		
					if (empty($transactionTimestamp)||$transactionTimestamp=='')
					{$transactionTimestamp = 'null';}
					else{$transactionTimestamp='\''. $transactionTimestamp.'\''; }
					if (empty($linkedTransactionID))
					{$linkedTransactionID = 'null';}
					if (empty($linkedOrderID))
					{$linkedOrderID = 'null';}
					if (empty($voicebrokered))
					{$voicebrokered = 'null';}
					if (empty($price))
					{$price = 'null';}
					if (empty($indexValue))
					{$indexValue = 'null';}
					if (empty($priceCurrency))
					{$priceCurrency = 'null';}
					if (empty($notionalAmount))
					{$notionalAmount = 'null';}
					if (empty($notionalCurrency))
					{$notionalCurrency = 'null';}
					if (empty($quantity))
					{$quantity = 'null';}
					if (empty($totalNotionalcontractQuantity))
					{$totalNotionalcontractQuantity = 'null';}
					if (empty($quantityUnit))
					{$quantityUnit = 'null';}
					if (empty($totalNotionalcontractQuantityUnit))
					{$totalNotionalcontractQuantityUnit = 'null';}
					if (empty($terminationDate)||$terminationDate=='')
					{$terminationDate = 'null';}
					else{$terminationDate='\''. $terminationDate.'\''; }
		
					$sql = "INSERT INTO e_transaction ( e_transaction_id, e_transaction_uniquetransactionid, e_transaction_timestamp, e_transaction_linkedtransaction, e_transaction_linkedorder, e_transaction_voicebrokered, e_transaction_price, e_transaction_indexvalue, e_transaction_priceCurrency, e_transaction_notionalamount, e_transaction_notionalcurrency, e_transaction_quantity, e_transaction_totalnotionalcontractquantity, e_transaction_quantityunit, e_transaction_totalnotionalcontractquantityunit, e_transaction_terminationdate ) VALUES (";
					$sql = $sql.$maxTransaction.",'".$transactionID."',".$transactionTimestamp.",'".$linkedTransactionID."','".$linkedOrderID."',".$voicebrokered.",".$price.",".$indexValue.",".$priceCurrency.",".$notionalAmount.",".$notionalCurrency.",".$quantity.",".$totalNotionalcontractQuantity.",".$quantityUnit.",".$totalNotionalcontractQuantityUnit.",".$terminationDate.")";
					
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
		
		
				//Insert option
				$optionType = $executions[46] ;
				$query = pg_query( $cnx, "SELECT e_optiontype_id FROM e_optiontype WHERE e_optiontype_name = '".$optionType."'" ); //requete
				while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
				{
					$optionType = $row[0];
				}
				if (!empty($optionType) )
				{
					$query = pg_query( $cnx, "SELECT MAX(e_option_id)+1 FROM e_option" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$maxOption = $row[0];
					}
					if (empty($maxOption))
					{
						$maxOption = 1;
					}
					$optionStyle = $executions[45] ;
					$query = pg_query( $cnx, "SELECT e_optionstyle_id FROM e_optionstyle WHERE e_optionstyle_name = '".$optionStyle."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$optionStyle = $row[0];
					}
					$exerciseDate = $executions[47] ;
					$strikePrice = $executions[48] ;
		
					if (empty($optionStyle))
					{$optionStyle = 'null';}
					if (empty($optionType))
					{$optionType = 'null';}
					if (empty($exerciseDate)||$exerciseDate=='')
					{$exerciseDate = 'null';}
					else{$exerciseDate='\''. $exerciseDate.'\''; }
					if (empty($strikePrice))
					{$strikePrice = 'null';}
		
					$sql = "INSERT INTO e_option ( e_option_id, e_option_style, e_option_type, e_option_exercisedate, e_option_strikeprice ) VALUES (";
					$sql = $sql.$maxOption.",".$optionStyle.",".$optionType.",'".$exerciseDate."',".$strikePrice.")";
					
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
		
		
				//Insert delivery
				$deliveryPointName = STR_REPLACE("'","''",$executions[49]) ;
				$deliveryPointName = STR_REPLACE('"','""',$deliveryPointName) ;
				if (!empty($deliveryPointName) )
				{
					$query = pg_query( $cnx, "SELECT e_deliverypoint_identifier FROM e_deliverypoint WHERE e_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$deliveryPoint = $row[0];
					}
					if (empty($deliveryPoint))
					{
						$query = pg_query( $cnx, "SELECT MAX(e_deliverypoint_id)+1 FROM e_deliverypoint" ); //requete
						while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
						{
							$deliveryPoint = $row[0];
						}
						if (empty($deliveryPoint))
						{
							$deliveryPoint = 1;
						}
		
						$sql = "INSERT INTO e_deliverypoint ( e_deliverypoint_id, e_deliverypoint_identifier ) VALUES (";
						$sql = $sql.$deliveryPoint.",'".$deliveryPointName."')";
						
						//execution de la requete SQL:
						$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
					}
					$query = pg_query( $cnx, "SELECT e_deliverypoint_id FROM e_deliverypoint WHERE e_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$deliveryPoint = $row[0];
					}
		
					$query = pg_query( $cnx, "SELECT MAX(e_deliveryprofile_id)+1 FROM e_deliveryprofile" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$maxDeliveryProfile = $row[0];
					}
					if (empty($maxDeliveryProfile))
					{
						$maxDeliveryProfile = 1;
					}
					$deliveryStartDate = $executions[50] ;
					$deliveryEndDate = $executions[51] ;
					$duration = $executions[52] ;
					$query = pg_query( $cnx, "SELECT e_orderduration_id FROM e_orderduration WHERE e_orderduration_name = '".$duration."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$duration = $row[0];
					}
					$loadType = $executions[53] ;
					$query = pg_query( $cnx, "SELECT e_loadtype_id FROM e_loadtype WHERE e_loadtype_name = '".$loadType."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$loadType = $row[0];
					}
					$daysOfTheWeek = $executions[54] ;
					$query = pg_query( $cnx, "SELECT e_daysoftheweek_id FROM e_daysoftheweek WHERE e_daysoftheweek_name = '".$daysOfTheWeek."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$daysOfTheWeek = $row[0];
					}
					if (empty($daysOfTheWeek)||$daysOfTheWeek=='')
					{$daysOfTheWeek = 1;}
					
					$loadDeliveryIntervals = STR_REPLACE("'","''",$executions[55]) ;
					$loadDeliveryIntervals = STR_REPLACE('"','""',$loadDeliveryIntervals) ;
					$deliveryCapacity = $executions[56] ;
					$deliveryCapacityUnit = $executions[57] ;
					$query = pg_query( $cnx, "SELECT e_quantityunit_id FROM e_quantityunit WHERE e_quantityunit_name = '".$deliveryCapacityUnit."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$deliveryCapacityUnit = $row[0];
					}
					$priceTimeIntervalsQuantity = $executions[58];
		
					if (empty($deliveryPoint))
					{$deliveryPoint = 'null';}
					if (empty($deliveryStartDate)||$deliveryStartDate=='')
					{$deliveryStartDate = 'null';}
					else{$deliveryStartDate='\''. $deliveryStartDate.'\''; }
					if (empty($deliveryEndDate)||$deliveryEndDate=='')
					{$deliveryEndDate = 'null';}
					else{$deliveryEndDate='\''. $deliveryEndDate.'\''; }
					if (empty($duration))
					{$duration = 'null';}
					if (empty($loadType))
					{$loadType = 'null';}
					if (empty($daysOfTheWeek))
					{$daysOfTheWeek = 'null';}
					if (empty($loadDeliveryIntervals))
					{$loadDeliveryIntervals = 'null';}
					if (empty($deliveryCapacity))
					{$deliveryCapacity = 'null';}
					if (empty($quantityUnit))
					{$quantityUnit = 'null';}
					if (empty($priceTimeIntervalsQuantity))
					{$priceTimeIntervalsQuantity = 'null';}
		
					$sql = "INSERT INTO e_deliveryprofile ( e_deliveryprofile_id, e_deliveryprofile_deliverypoint, e_deliveryprofile_deliverystartdate, e_deliveryprofile_deliveryenddate, e_deliveryprofile_duration, e_deliveryprofile_loadtype, e_deliveryprofile_daysoftheweek, e_deliveryprofile_loaddeliveryintervals, e_deliveryprofile_deliverycapacity, e_deliveryprofile_quantityunit, e_deliveryprofile_pricetimeintervalquantity ) VALUES (";
					$sql = $sql.$maxDeliveryProfile.",".$deliveryPoint.",".$deliveryStartDate.",".$deliveryEndDate.",".$duration.",".$loadType.",".$daysOfTheWeek.",'".$loadDeliveryIntervals."',".$deliveryCapacity.",".$quantityUnit.",".$priceTimeIntervalsQuantity.")";
					
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
		
				
				//Insert execution
				$actionType = $executions[59] ;
				if (!empty($actionType) )
				{
					$query = pg_query( $cnx, "SELECT MAX(execution_id)+1 FROM execution" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$execution = $row[0];
					}
					if (empty($execution))
					{
						$execution = 1;
					}
		
					if (empty($maxOrder))
					{$maxOrder = 'null';}
					if (empty($maxcontract))
					{$maxcontract = 'null';}
					if (empty($maxTransaction))
					{$maxTransaction = 'null';}
					if (empty($maxOption))
					{$maxOption = 'null';}
					if (empty($maxDeliveryProfile))
					{$maxDeliveryProfile = 'null';}
					if (empty($actionType))
					{$actionType = 'null';}
					if (empty($internBill))
					{$internBill = 'null';}
					
					$query = pg_query( $cnx, "SELECT e_actiontype_id FROM e_actiontype WHERE e_actiontype_name = '".$actionType."'" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$actionType = $row[0];
					}
		
					$sql = "INSERT INTO execution ( execution_id, execution_parties, execution_order, execution_contract, execution_transaction, execution_option, execution_deliveryprofile, execution_actiontype, execution_bill_intern ) VALUES (";
					$sql = $sql.$execution.",".$maxParties.",".$maxOrder.",".$maxcontract.",".$maxTransaction.",".$maxOption.",".$maxDeliveryProfile.",".$actionType.",'".$internBill."')";
					//echo ($sql);
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
					
					$nbExecutions ++;
				}
		
				$bill = $executions[0] ;
				if (!empty($bill) )
				{
					$query = pg_query( $cnx, "SELECT MAX(e_bill_id)+1 FROM e_bill" ); //requete
					while ($row = pg_fetch_row ( $query ) ) //tant que c'est pas la fin de la table
					{
						$billMax = $row[0];
					}
					if (empty($billMax))
					{
						$billMax = 1;
					}
		
					$sql = "INSERT INTO e_bill ( e_bill_id, e_bill_name, e_bill_execution ) VALUES (";
					$sql = $sql.$billMax.",'".$bill."',".$execution.")";
		
					//execution de la requete SQL:
					$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				}
			}
			
	}
	fclose($handle);
	
	echo($nbAvoirs.' avoirs detectes');
	echo('<br/><br/>');
	echo('Le syst√®me a integre '.$nbExecutions.' nouvelles executions (avoirs exclus)');
	echo('<br/><br/>');
	echo('Fin du traitement');
}

?>