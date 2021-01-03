<?php
	require 'connect.php';

	//Insertion marketparticipant1
	$marketParticipant1Identifier = STR_REPLACE("'","''",$_POST["overviewMarketParticipant1ID"]) ;
	$marketParticipant1Identifier = STR_REPLACE("'","''",$marketParticipant1Identifier) ;
	$marketParticipant1 = NULL;
	if (!empty($marketParticipant1Identifier) )
	{
		$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$marketParticipant1 = $row[0];
		}
		
		if (is_null($marketParticipant1))
		{
			$marketParticipant1Name = STR_REPLACE("'","''",$_POST["overviewMarketParticipant1Name"]) ;
			$marketParticipant1Name = STR_REPLACE('"','""',$marketParticipant1Name) ;
			foreach ($_POST['overviewMarketParticipant1Type'] as $select)
			{
				$marketParticipant1Type = $select ;
			}
		
		    $query = pg_query( $cnx, "SELECT MAX(e_marketparticipant_id)+1 FROM e_marketparticipant" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxMarketP1 = $row[0];
			}
			if (is_null($maxMarketP1))
			{
				$maxMarketP1 = 1;
			}
			
			if (is_null($marketParticipant1Name)||$marketParticipant1Name=='')
			{$marketParticipant1Name = 'null';}
			if (is_null($marketParticipant1Type)||$marketParticipant1Type=='')
			{$marketParticipant1Type = 'null';}
		
			$sql = "INSERT INTO e_marketparticipant ( e_marketparticipant_id, e_marketparticipant_identifier, e_marketparticipant_name, e_marketparticipant_type ) VALUES ("; 
			$sql = $sql.$maxMarketP1.",'".$marketParticipant1Identifier."','".$marketParticipant1Name."',".$marketParticipant1Type.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}
		$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant1Identifier."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$marketParticipant1 = $row[0];
		}
			
		
	}
	
	//Insertion trader
	$traderIdentifier = STR_REPLACE("'","''",$_POST["overviewTraderID"]) ;
	$traderIdentifier = STR_REPLACE('"','""',$traderIdentifier) ;
	$trader = NULL;
	if (!empty($traderIdentifier) )
	{
		$query = pg_query( $cnx, "SELECT e_trader_id FROM e_trader WHERE e_trader_identifier = '".$traderIdentifier."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$trader = $row[0];
		}
		
		if (is_null($trader))
		{
			foreach ($_POST['overviewTraderType'] as $select)
			{
				$traderType = $select ;
			}
		
		    $query = pg_query( $cnx, "SELECT MAX(e_trader_id)+1 FROM e_trader" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxTrader = $row[0];
			}
			if (is_null($maxTrader))
			{
				$maxTrader = 1;
			}
			
			if (is_null($traderIdentifier)||$traderIdentifier=='')
			{$traderIdentifier = 'null';}
		
			$sql = "INSERT INTO e_trader ( e_trader_id, e_trader_identifier ) VALUES ("; 
			$sql = $sql.$maxTrader.",'".$traderIdentifier."')";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$query = pg_query( $cnx, "SELECT e_trader_id FROM e_trader WHERE e_trader_identifier = '".$traderIdentifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$trader = $row[0];
			}
		}
	}
  

	//Insertion marketparticipant2
	$marketParticipant2Identifier = STR_REPLACE("'","''",$_POST["overviewMarketParticipant2ID"]) ;
	$marketParticipant2Identifier = STR_REPLACE('"','""',$marketParticipant2Identifier) ;
	$marketParticipant2 = NULL;
	$marketParticipant2Name = STR_REPLACE("'","''",$_POST["overviewMarketParticipant2Name"]) ;
	$marketParticipant2Name = STR_REPLACE('"','""',$marketParticipant2Name) ;
	
	if (!empty($marketParticipant2Identifier) )
	{
		$query = pg_query( $cnx, "SELECT e_marketparticipant_id FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant2Identifier."' and e_marketparticipant_name = '".$marketParticipant2Name."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$marketParticipant2 = $row[0];
		}
		
		if (is_null($marketParticipant2))
		{
			foreach ($_POST['overviewMarketParticipant2Type'] as $select)
			{
				$marketParticipant2Type = $select ;
			}
		
		    $query = pg_query( $cnx, "SELECT MAX(e_marketparticipant_id)+1 FROM e_marketparticipant" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxMarketP2 = $row[0];
			}
			if (is_null($maxMarketP2))
			{
				$maxMarketP2 = 1;
			}
			
			if (is_null($marketParticipant2Name)||$marketParticipant2Name=='')
			{$marketParticipant2Name = 'null';}
			if (is_null($marketParticipant2Type)||$marketParticipant2Type=='')
			{$marketParticipant2Type = 'null';}
			if(!$_POST['overviewMarketParticipant2Delegate'])
			{
				$marketParticipant2Delegate = $select ;
			}
			else
			{
				$marketParticipant2Delegate = FALSE ;
			}
		
			$sql = "INSERT INTO e_marketparticipant ( e_marketparticipant_id, e_marketparticipant_identifier, e_marketparticipant_name, e_marketparticipant_type, e_marketparticipant_delegate ) VALUES ("; 
			$sql = $sql.$maxMarketP2.",'".$marketParticipant2Identifier."','".$marketParticipant2Name."',".$marketParticipant2Type.",".$marketParticipant2Delegate.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
			$query = pg_query( $cnx, "SELECT MAX (e_marketparticipant_id) FROM e_marketparticipant WHERE e_marketparticipant_identifier = '".$marketParticipant2Identifier."'" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$marketParticipant2 = $row[0];
			}
		}
	}
	
	//Insertion beneficiary
	$beneficiaryIdentifier = STR_REPLACE("'","''",$_POST["overviewBeneficiaryID"]) ;
	$beneficiaryIdentifier = STR_REPLACE('"','""',$beneficiaryIdentifier) ;
	$beneficiary = NULL;
	if (!empty($beneficiaryIdentifier) )
	{
		$query = pg_query( $cnx, "SELECT e_beneficiary_id FROM e_beneficiary WHERE e_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$beneficiary = $row[0];
		}
		
		if (is_null($beneficiary))
		{
			$beneficiaryIdentifier = $_POST["overviewBeneficiaryID"] ;
			if (!empty($beneficiaryIdentifier) )
			{
				foreach ($_POST['overviewBeneficiaryType'] as $select)
				{
					$beneficiaryType = $select ;
				}
			
			    $query = pg_query( $cnx, "SELECT MAX(e_beneficiary_id)+1 FROM e_beneficiary" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$maxBeneficiary = $row[0];
				}
				if (is_null($maxBeneficiary))
				{
					$maxBeneficiary = 1;
				}
				
				if (is_null($beneficiaryType)||$beneficiaryType=='')
				{$beneficiaryType = 'null';}
			
				$sql = "INSERT INTO e_beneficiary ( e_beneficiary_id, e_beneficiary_identifier, e_beneficiary_type ) VALUES ("; 
				$sql = $sql.$maxBeneficiary.",'".$beneficiaryIdentifier."',".$beneficiaryType.")";
				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				
				$query = pg_query( $cnx, "SELECT e_beneficiary_id FROM e_beneficiary WHERE e_beneficiary_identifier = '".$beneficiaryIdentifier."'" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$beneficiary = $row[0];
				}
			}
			else
			{
				
			}
		}
	}
	
	//Insertion reportingEntity
	$reportingEntityIdentifier = STR_REPLACE("'","''",$_POST["overviewReportingEntityID"]) ;
	$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
	$reportingEntity = NULL;
	if (!empty($reportingEntityIdentifier) )
	{
		$query = pg_query( $cnx, "SELECT e_reportingentity_id FROM e_reportingentity WHERE e_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$reportingEntity = $row[0];
		}
		
		if (is_null($reportingEntity))
		{
			if (!empty($reportingEntityIdentifier) )
			{
				$reportingEntityIdentifier = STR_REPLACE("'","''",$_POST["overviewReportingEntityIdentifier"]) ;
				$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
				foreach ($_POST['overviewReportingEntityType'] as $select)
				{
					$reportingEntityType = $select ;
				}
			
			    $query = pg_query( $cnx, "SELECT MAX(e_reportingentity_id)+1 FROM e_reportingentity" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$maxReportingEntity = $row[0];
				}
				if (is_null($maxReportingEntity))
				{
					$maxReportingEntity = 1;
				}

				if (is_null($reportingEntityType)||$reportingEntityType=='')
				{$reportingEntityType = 'null';}
			
				$sql = "INSERT INTO e_reportingentity ( e_reportingentity_id, e_reportingentity_identifier, e_reportingentity_type ) VALUES ("; 
				$sql = $sql.$maxReportingEntity.",'".$reportingEntityIdentifier."',".$reportingEntityType.")";
				//execution de la requete SQL:
				$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
				
				$query = pg_query( $cnx, "SELECT e_reportingentity_id FROM e_reportingentity WHERE e_reportingentity_identifier = '".$reportingEntityIdentifier."'" ); //requete
				while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
				{
					$reportingEntity = $row[0];
				}
			}
		}
	}
	
	//Insertion parties
	$query = pg_query( $cnx, "SELECT MAX(e_parties_id)+1 FROM e_parties" ); //requete
	while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
	{
		$maxParties = $row[0];
	}
	if (is_null($maxParties))
	{
		$maxParties = 1;
	}
	foreach ($_POST['overviewTradingCapacity'] as $select)
	{
		$tradingCapacity = $select ;
	}
	foreach ($_POST['overviewBuySellIndicator'] as $select)
	{
		$buySellIndicator = $select ;
	}
	foreach ($_POST['overviewInitiatorAggressor'] as $select)
	{
		$initiatorAggressor = $select ;
	}
	if (is_null($trader)||$trader=='')
	{$trader = 'null';}
	if (is_null($reportingEntity)||$reportingEntity=='')
	{$reportingEntity = 'null';}
	if (is_null($beneficiary)||$beneficiary=='')
	{$beneficiary = 'null';}
	if (is_null($tradingCapacity)||$tradingCapacity=='')
	{$tradingCapacity = 'null';}
	if (is_null($buySellIndicator)||$buySellIndicator=='')
	{$buySellIndicator = 'null';}
	if (is_null($initiatorAggressor)||$initiatorAggressor=='')
	{$initiatorAggressor = 'null';}

	$sql = "INSERT INTO e_parties ( e_parties_id, e_parties_marketparticipant1, e_parties_trader, e_parties_marketparticipant2, e_parties_reportingentity, e_parties_beneficiary, e_parties_tradingcapacity, e_parties_buysellindicator, e_parties_initiatoraggressor) VALUES ("; 
	$sql = $sql.$maxParties.",".$marketParticipant1.",".$trader.",".$marketParticipant2.",".$reportingEntity.",".$beneficiary.",".$tradingCapacity.",".$buySellIndicator.",".$initiatorAggressor.")";
	//execution de la requete SQL:
	$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	
	
	//Insert order
	$orderID = STR_REPLACE("'","''",$_POST["overviewOrderID"]) ;
	$orderID = STR_REPLACE('"','""',$orderID) ;
	if (!empty($orderID) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_order_id)+1 FROM e_order" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxOrder = $row[0];
		}
		if (is_null($maxOrder))
		{
			$maxOrder = 1;
		}
		
		foreach ($_POST['overviewOrderType'] as $select)
		{
			$orderType = $select ;
		}
		foreach ($_POST['overviewOrderCondition'] as $select)
		{
			$orderCondition = $select ;
		}
		foreach ($_POST['overviewOrderStatus'] as $select)
		{
			$orderStatus = $select ;
		}
		$minimumExecutionVolume = $_POST["overviewMinimumExecutionVolume"] ;
		$priceLimit = $_POST["overviewPriceLimit"] ;
		$undisclosedVolume = $_POST["overviewUndisclosedVolume"] ;
		foreach ($_POST['overviewOrderDuration'] as $select)
		{
			$orderDuration = $select ;
		}
		
		if (is_null($orderType)||$orderType=='')
		{$orderType = 'null';}
		if (is_null($orderCondition)||$orderCondition=='')
		{$orderCondition = 'null';}
		if (is_null($orderStatus)||$orderStatus=='')
		{$orderStatus = 'null';}
		if (is_null($minimumExecutionVolume)||$minimumExecutionVolume=='')
		{$minimumExecutionVolume = 'null';}
		if (is_null($priceLimit)||$priceLimit=='')
		{$priceLimit = 'null';}
		if (is_null($undisclosedVolume)||$undisclosedVolume=='')
		{$undisclosedVolume = 'null';}
		if (is_null($orderDuration)||$orderDuration=='')
		{$orderDuration = 'null';}
		
		$sql = "INSERT INTO e_order ( e_order_id, e_order_identifier, e_order_type, e_order_condition, e_order_status, e_order_minimumexecutionvolume, e_order_pricelimit, e_order_undisclosedvolume, e_order_duration ) VALUES ("; 
		$sql = $sql.$maxOrder.",'".$orderID."',".$orderType.",".$orderCondition.",".$orderStatus.",".$minimumExecutionVolume.",".$priceLimit.",".$undisclosedVolume.",".$orderDuration.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	
	
	//Insert contract
	$contractID = STR_REPLACE("'","''",$_POST["overviewcontractID"]) ;
	$contractID = STR_REPLACE('"','""',$contractID) ;
	if (!empty($contractID) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_contract_id)+1 FROM e_contract" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxcontract = $row[0];
		}
		if (is_null($maxcontract))
		{
			$maxcontract = 1;
		}
		
		$contractName = STR_REPLACE("'","''",$_POST["overviewcontractName"]) ;
		$contractName = STR_REPLACE('"','""',$contractName) ;
		foreach ($_POST['overviewcontractType'] as $select)
		{
			$contractType = $select ;
		}
		foreach ($_POST['overviewEnergyCommodity'] as $select)
		{
			$energyCommodity = $select ;
		}
		$fixingIndex = $_POST["overviewFixingIndex"] ;
		$fixingIndex = STR_REPLACE("'","''",$fixingIndex) ;
		$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
		foreach ($_POST['overviewSettlementMethod'] as $select)
		{
			$settlementMethod = $select ;
		}
		foreach ($_POST['overviewOrganisedMarketPlace'] as $select)
		{
			$organisedMarketPlace = $select ;
		}
		
		if (is_null($contractName)||$contractName=='')
		{$contractName = 'null';}
		if (is_null($contractType)||$contractType=='')
		{$contractType = 'null';}
		if (is_null($energyCommodity)||$energyCommodity=='')
		{$energyCommodity = 'null';}
		if (is_null($fixingIndex)||$fixingIndex=='')
		{$fixingIndex = 'null';}
		if (is_null($settlementMethod)||$settlementMethod=='')
		{$settlementMethod = 'null';}
		if (is_null($organisedMarketPlace)||$organisedMarketPlace=='')
		{$organisedMarketPlace = 'null';}
			if ($_POST["searchTradingHours1"]=='')
		{
			$tradingHours = '';
		} else {
			$tradingHours = $_POST["searchTradingHours1"].":00/".$_POST["searchTradingHours2"].":59" ;
		}
		if ($_POST["searchLastTraidingDate"]=='')
		{
			$lTD = 'null';
			$lastTraidingDate = " ".$lastTraidingDate." ";
		} else {
			$lTD= $_POST["searchLastTraidingDate"]." ".$_POST["searchLastTraidingTime"] ;
			$lastTraidingDate = "'".$lTD."' ";
		}
	
		$sql = "INSERT INTO e_contract ( e_contract_id, e_contract_identifier, e_contract_name, e_contract_type, e_contract_energycommodity, e_contract_fixingindex, e_contract_settlementmethod, e_contract_organisedmarketplace, e_contract_tradinghours, e_contract_lasttraidingdate ) VALUES ("; 
		$sql = $sql.$maxcontract.",'".$contractID."','".$contractName."',".$contractType.",".$energyCommodity.",'".$fixingIndex."',".$settlementMethod.",".$organisedMarketPlace.",'".$tradingHours."',".$lastTraidingDate.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	
	//Insert transaction
	$transactionID = STR_REPLACE("'","''",$_POST["overviewUniqueTransactionID"]) ;
	$transactionID = STR_REPLACE('"','""',$transactionID) ;
	if (!empty($transactionID) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_transaction_id)+1 FROM e_transaction" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxTransaction = $row[0];
		}
		if (is_null($maxTransaction))
		{
			$maxTransaction = 1;
		}
		$transactionTimestamp = $_POST["overviewTransactionTimestampDate"]." ".$_POST["overviewTransactionTimestampTime"] ;
		$linkedTransactionID = STR_REPLACE("'","''",$_POST["overviewLinkedTransactionID"]) ;
		$linkedTransactionID = STR_REPLACE('"','""',$linkedTransactionID) ;
		$linkedOrderID = STR_REPLACE("'","''",$_POST["overviewLinkedOrderID"]) ;
		$linkedOrderID = STR_REPLACE('"','""',$linkedOrderID) ;
		foreach ($_POST['overviewVoicebrokered'] as $select)
		{
			$voicebrokered = $select ;
		}
		$price = $_POST["overviewPrice"] ;
		$indexValue = $_POST["overviewIndexValue"] ;
		foreach ($_POST['overviewPriceCurrency'] as $select)
		{
			$priceCurrency = $select ;
		}
		$notionalAmount = $_POST["overviewNotionalAmount"] ;
		foreach ($_POST['overviewNotionalCurrency'] as $select)
		{
			$notionalCurrency = $select ;
		}
		$quantity = $_POST["overviewQuantity"] ;
		$totalNotionalcontractQuantity = $_POST["overviewTotalNotionalcontractQuantity"] ;
		foreach ($_POST['overviewQuantityUnit'] as $select)
		{
			$quantityUnit = $select ;
		}
		foreach ($_POST['overviewTotalNotionalcontractQuantityUnit'] as $select)
		{
			$totalNotionalcontractQuantityUnit = $select ;
		}
		$terminationDate = $_POST["overviewTerminationDate"] ;
		
		if (is_null($linkedTransactionID)||$linkedTransactionID=='')
		{$linkedTransactionID = 'null';}
		if (is_null($linkedOrderID)||$linkedOrderID=='')
		{$linkedOrderID = 'null';}
		if (is_null($voicebrokered)||$voicebrokered=='')
		{$voicebrokered = 'null';}
		if (is_null($price)||$price=='')
		{$price = 'null';}
		if (is_null($indexValue)||$indexValue=='')
		{$indexValue = 'null';}
		if (is_null($priceCurrency)||$priceCurrency=='')
		{$priceCurrency = 'null';}
		if (is_null($notionalAmount)||$notionalAmount=='')
		{$notionalAmount = 'null';}
		if (is_null($notionalCurrency)||$notionalCurrency=='')
		{$notionalCurrency = 'null';}
		if (is_null($quantity)||$quantity=='')
		{$quantity = 'null';}
		if (is_null($totalNotionalcontractQuantity)||$totalNotionalcontractQuantity=='')
		{$totalNotionalcontractQuantity = 'null';}
		if (is_null($quantityUnit)||$quantityUnit=='')
		{$quantityUnit = 'null';}
		if (is_null($totalNotionalcontractQuantityUnit)||$totalNotionalcontractQuantityUnit=='')
		{$totalNotionalcontractQuantityUnit = 'null';}
		if (is_null($terminationDate)||$terminationDate=='')
		{$terminationDate = 'null';}
		else{$terminationDate='\''. $terminationDate.'\''; }
	
		$sql = "INSERT INTO e_transaction ( e_transaction_id, e_transaction_uniquetransactionid, e_transaction_timestamp, e_transaction_linkedtransaction, e_transaction_linkedorder, e_transaction_voicebrokered, e_transaction_price, e_transaction_indexvalue, e_transaction_priceCurrency, e_transaction_notionalamount, e_transaction_notionalcurrency, e_transaction_quantity, e_transaction_totalnotionalcontractquantity, e_transaction_quantityunit, e_transaction_totalnotionalcontractquantityunit, e_transaction_terminationdate ) VALUES ("; 
		$sql = $sql.$maxTransaction.",'".$transactionID."','".$transactionTimestamp."','".$linkedTransactionID."','".$linkedOrderID."',".$voicebrokered.",".$price.",".$indexValue.",".$priceCurrency.",".$notionalAmount.",".$notionalCurrency.",".$quantity.",".$totalNotionalcontractQuantity.",".$quantityUnit.",".$totalNotionalcontractQuantityUnit.",".$terminationDate.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	
	//Insert option
	foreach ($_POST['overviewOptionType'] as $select)
		{
			$optionType = $select ;
		}
	if (!empty($optionType) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_option_id)+1 FROM e_option" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxOption = $row[0];
		}
		if (is_null($maxOption))
		{
			$maxOption = 1;
		}
		foreach ($_POST['overviewOptionStyle'] as $select)
		{
			$optionStyle = $select ;
		}
		$exerciseDate = $_POST["overviewExerciseDate"] ;
		$strikePrice = $_POST["overviewStrikePrice"] ;
		
		if (is_null($optionStyle)||$optionStyle=='')
		{$optionStyle = 'null';}
		if (is_null($optionType)||$optionType=='')
		{$optionType = 'null';}
		if (is_null($exerciseDate)||$exerciseDate=='')
		{$exerciseDate = 'null';}
		else{$exerciseDate='\''. $exerciseDate.'\''; }
		if (is_null($strikePrice)||$strikePrice=='')
		{$strikePrice = 'null';}
	
		$sql = "INSERT INTO e_option ( e_option_id, e_option_style, e_option_type, e_option_exercisedate, e_option_strikeprice ) VALUES ("; 
		$sql = $sql.$maxOption.",".$optionStyle.",".$optionType.",".$exerciseDate.",".$strikePrice.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	
	//Insert delivery
	$deliveryPointName = STR_REPLACE("'","''",$_POST["overviewDeliveryPointName"]) ;
	$deliveryPointName = STR_REPLACE('"','""',$deliveryPointName) ;
	if (!empty($deliveryPointName) )
	{
		$query = pg_query( $cnx, "SELECT e_deliverypoint_identifier FROM e_deliverypoint WHERE e_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$deliveryPoint = $row[0];
		}
		if (is_null($deliveryPoint))
		{
			$deliveryPointWording = STR_REPLACE("'","''",$_POST["overviewDeliveryPointWording"]) ;
			$deliveryPointWording = STR_REPLACE('"','""',$deliveryPointWording) ;

		    $query = pg_query( $cnx, "SELECT MAX(e_deliverypoint_id)+1 FROM e_deliverypoint" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$deliveryPoint = $row[0];
			}
			if (is_null($deliveryPoint))
			{
				$deliveryPoint = 1;
			}
			
			if (is_null($deliveryPointWording))
			{$deliveryPointWording = 'null';}
		
			$sql = "INSERT INTO e_deliverypoint ( e_deliverypoint_id, e_deliverypoint_identifier, e_deliverypoint_wording ) VALUES ("; 
			$sql = $sql.$deliveryPoint.",'".$deliveryPointName."','".$deliveryPointWording."')";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		}
		$query = pg_query( $cnx, "SELECT e_deliverypoint_id FROM e_deliverypoint WHERE e_deliverypoint_identifier = '".$deliveryPointName."'" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$deliveryPoint = $row[0];
		}
		
		$query = pg_query( $cnx, "SELECT MAX(e_deliveryprofile_id)+1 FROM e_deliveryprofile" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxDeliveryProfile = $row[0];
		}
		if (is_null($maxDeliveryProfile))
		{
			$maxDeliveryProfile = 1;
		}
		$deliveryStartDate = $_POST["overviewDeliveryStartDate"] ;
		$deliveryEndDate = $_POST["overviewDeliveryEndDate"] ;
		foreach ($_POST['overviewDuration'] as $select)
		{
			$duration = $select ;
		}
		foreach ($_POST['overviewLoadType'] as $select)
		{
			$loadType = $select ;
		}
		foreach ($_POST['overviewDaysOfTheWeek'] as $select)
		{
			$daysOfTheWeek = $select ;
		}
		$loadDeliveryIntervals = STR_REPLACE("'","''",$_POST["overviewLoadDeliveryIntervals"]) ;
		$loadDeliveryIntervals = STR_REPLACE('"','""',$loadDeliveryIntervals) ;
		$deliveryCapacity = $_POST["overviewDeliveryCapacity"] ;
		foreach ($_POST['overviewDeliveryCapacityUnit'] as $select)
		{
			$quantityUnit = $select ;
		}
		$priceTimeIntervalsQuantity = $_POST['overviewPriceTimeIntervalsQuantity'];
		
		if (is_null($deliveryPoint)||$deliveryPoint=='')
		{$deliveryPoint = 'null';}
		if (is_null($deliveryStartDate)||$deliveryStartDate=='')
		{$deliveryStartDate = 'null';}
		else{$deliveryStartDate='\''. $deliveryStartDate.'\''; }
		if (is_null($deliveryEndDate)||$deliveryEndDate=='')
		{$deliveryEndDate = 'null';}
		else{$deliveryEndDate='\''. $deliveryEndDate.'\''; }
		if (is_null($duration)||$duration=='')
		{$duration = 'null';}
		if (is_null($loadType)||$loadType=='')
		{$loadType = 'null';}
		if (is_null($daysOfTheWeek)||$daysOfTheWeek=='')
		{$daysOfTheWeek = 'null';}
		if (is_null($loadDeliveryIntervals)||$loadDeliveryIntervals=='')
		{$loadDeliveryIntervals = 'null';}
		if (is_null($deliveryCapacity)||$deliveryCapacity=='')
		{$deliveryCapacity = 'null';}
		if (is_null($quantityUnit)||$quantityUnit=='')
		{$quantityUnit = 'null';}
		if (is_null($priceTimeIntervalsQuantity)||$priceTimeIntervalsQuantity=='')
		{$priceTimeIntervalsQuantity = 'null';}
				
		$sql = "INSERT INTO e_deliveryprofile ( e_deliveryprofile_id, e_deliveryprofile_deliverypoint, e_deliveryprofile_deliverystartdate, e_deliveryprofile_deliveryenddate, e_deliveryprofile_duration, e_deliveryprofile_loadtype, e_deliveryprofile_daysoftheweek, e_deliveryprofile_loaddeliveryintervals, e_deliveryprofile_deliverycapacity, e_deliveryprofile_quantityunit, e_deliveryprofile_pricetimeintervalquantity ) VALUES ("; 
		$sql = $sql.$maxDeliveryProfile.",".$deliveryPoint.",".$deliveryStartDate.",".$deliveryEndDate.",".$duration.",".$loadType.",".$daysOfTheWeek.",'".$loadDeliveryIntervals."',".$deliveryCapacity.",".$quantityUnit.",".$priceTimeIntervalsQuantity.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
	}
	
	//Insert execution
	foreach ($_POST['overviewActionType'] as $select)
	{
		$actionType = $select ;
	}
	if (!empty($actionType) )
	{
		$query = pg_query( $cnx, "SELECT MAX(execution_id)+1 FROM execution" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$execution = $row[0];
		}
		if (is_null($execution))
		{
			$execution = 1;
		}
		
		if (is_null($maxOrder)||$maxOrder=='')
		{$maxOrder = 'null';}
		if (is_null($maxcontract)||$maxcontract=='')
		{$maxcontract = 'null';}
		if (is_null($maxTransaction)||$maxTransaction=='')
		{$maxTransaction = 'null';}
		if (is_null($maxOption)||$maxOption=='')
		{$maxOption = 'null';}
		if (is_null($maxDeliveryProfile)||$maxDeliveryProfile=='')
		{$maxDeliveryProfile = 'null';}
		
		$sql = "INSERT INTO execution ( execution_id, execution_parties, execution_order, execution_contract, execution_transaction, execution_option, execution_deliveryprofile, execution_actiontype ) VALUES ("; 
		$sql = $sql.$execution.",".$maxParties.",".$maxOrder.",".$maxcontract.",".$maxTransaction.",".$maxOption.",".$maxDeliveryProfile.",".$actionType.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
		echo('------------------------------------SUCCESS---------------------------------------------');
	}
	
	$bill = $_POST["overviewBillID"] ;
	if (!empty($bill) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_bill_id)+1 FROM e_bill" ); //requete
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$billMax = $row[0];
		}
		if (is_null($billMax))
		{
			$billMax = 1;
		}
		
		$sql = "INSERT INTO e_bill ( e_bill_id, e_bill_name, e_bill_execution ) VALUES ("; 
		$sql = $sql.$billMax.",'".$bill."',".$execution.")";
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
  
  
  
?>