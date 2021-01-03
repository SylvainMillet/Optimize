<?php
	require 'connect.php';

	//Update marketparticipant1
	if (isset($_POST["searchMarketParticipant1"]))
	{
		$marketParticipant1 = $_POST["searchMarketParticipant1"];
	}
	if ($marketParticipant1 != '')
	{
		$marketParticipant1Identifier = STR_REPLACE("'","''",$_POST["searchMarketParticipant1ID"]) ;
		$marketParticipant1Identifier = STR_REPLACE("'","''",$marketParticipant1Identifier) ;
		$marketParticipant1Name = STR_REPLACE("'","''",$_POST["searchMarketParticipant1Name"]) ;
		$marketParticipant1Name = STR_REPLACE("'","''",$marketParticipant1Name) ;
		foreach ($_POST['searchMarketParticipant1Type'] as $select)
		{
			$marketParticipant1Type = $select ;
		}
		if ($marketParticipant1Name=='')
		{$marketParticipant1Name = '';}
		if ($marketParticipant1Type=='')
		{$marketParticipant1Type = '';}
	
		$sql = "UPDATE e_marketparticipant SET e_marketparticipant_identifier = '".$marketParticipant1Identifier."', 
				e_marketparticipant_name = '".$marketParticipant1Name."', 
				e_marketparticipant_type = ".$marketParticipant1Type." 
				WHERE e_marketparticipant_id = ".$marketParticipant1;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	//Update trader
	if (isset($_POST["searchTrader"]))
	{
		$trader = $_POST["searchTrader"];
	}
	if ($trader != '')
	{
		$traderIdentifier = STR_REPLACE("'","''",$_POST["searchTraderID"]) ;
		$traderIdentifier = STR_REPLACE('"','""',$traderIdentifier) ;
		if ($traderIdentifier=='')
		{$traderIdentifier = '';}
	
		$sql = "UPDATE e_trader SET e_trader_identifier = '".$traderIdentifier."' 
				WHERE e_trader_id = ".$trader;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchTraderID"]) && $_POST["searchTraderID"] != '')
		{
			$traderIdentifier = STR_REPLACE("'","''",$_POST["searchTraderID"]) ;
			$traderIdentifier = STR_REPLACE('"','""',$traderIdentifier) ;
			//Insert new trader
			$query = pg_query( $cnx, "SELECT MAX(e_trader_id)+1 FROM e_trader" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxTrader = $row[0];
			}
			if (is_null($maxTrader))
			{
				$maxTrader = 1;
			}
			
			$sql = "INSERT INTO e_trader ( e_trader_id, e_trader_identifier ) VALUES (";
			$sql = $sql.$maxTrader.",'".$traderIdentifier."')";
			//execution de la requete SQL:
			echo $sql;
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$trader = $maxTrader;
		}
	}

	//Update marketparticipant2
	if (isset($_POST["searchMarketParticipant2"]))
	{
		$marketParticipant2 = $_POST["searchMarketParticipant2"];
	}
	if ($marketParticipant2 != '')
	{
		$marketParticipant2Identifier = STR_REPLACE("'","''",$_POST["searchMarketParticipant2ID"]) ;
		$marketParticipant2Identifier = STR_REPLACE("'","''",$marketParticipant2Identifier) ;
		$marketParticipant2Name = STR_REPLACE("'","''",$_POST["searchMarketParticipant2Name"]) ;
		$marketParticipant2Name = STR_REPLACE("'","''",$marketParticipant2Name) ;
		foreach ($_POST['searchMarketParticipant2Type'] as $select)
		{
			$marketParticipant2Type = $select ;
		}
		if ($marketParticipant2Name=='')
		{$marketParticipant2Name = '';}
		if ($marketParticipant2Type=='')
		{$marketParticipant2Type = '';}
	
		$sql = "UPDATE e_marketparticipant SET e_marketparticipant_identifier = '".$marketParticipant2Identifier."', 
				e_marketparticipant_name = '".$marketParticipant2Name."', 
				e_marketparticipant_type = ".$marketParticipant2Type." 
				WHERE e_marketparticipant_id = ".$marketParticipant2;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	//Update reportingEntity
	if (isset($_POST["searchReportingEntity"]))
	{
		$reportingEntity = $_POST["searchReportingEntity"];
	}
	if ($reportingEntity != '')
	{
		$reportingEntityIdentifier = STR_REPLACE("'","''",$_POST["searchReportingEntityID"]) ;
		$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
		foreach ($_POST['searchReportingEntityType'] as $select)
		{
			$reportingEntityType = $select ;
		}
		$sql = "UPDATE e_reportingentity SET e_reportingentity_identifier = '".$reportingEntityIdentifier."', 
				e_reportingentity_type = ".$reportingEntityType." 
				WHERE e_reportingentity_id = ".$reportingEntity;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchReportingEntityID"])  && $_POST["searchReportingEntityID"] != '')
		{
			$reportingEntityIdentifier = $_POST["searchReportingEntityID"];
			
			//Insert new reporting entity
			$reportingEntityIdentifier = STR_REPLACE("'","''",$_POST["searchReportingEntityID"]) ;
			$reportingEntityIdentifier = STR_REPLACE('"','""',$reportingEntityIdentifier) ;
			foreach ($_POST['searchReportingEntityType'] as $select)
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
			
			$sql = "INSERT INTO e_reportingentity ( e_reportingentity_id, e_reportingentity_identifier, e_reportingentity_type ) VALUES (";
			$sql = $sql.$maxReportingEntity.",'".$reportingEntityIdentifier."',".$reportingEntityType.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$reportingEntity = $maxReportingEntity;
		}
	}
	
	//Update beneficiary
	if (isset($_POST["searchBeneficiary"]))
	{
		$beneficiary = $_POST["searchBeneficiary"];
	}
	if ($beneficiary != '')
	{
		$beneficiaryIdentifier = STR_REPLACE("'","''",$_POST["searchBeneficiaryID"]) ;
		$beneficiaryIdentifier = STR_REPLACE('"','""',$beneficiaryIdentifier) ;
		foreach ($_POST['searchBeneficiaryType'] as $select)
		{
			$beneficiaryType = $select ;
		}
		$sql = "UPDATE e_beneficiary SET e_beneficiary_identifier = '".$beneficiaryIdentifier."', 
				e_beneficiary_type = ".$beneficiaryType." 
				WHERE e_beneficiary_id = ".$beneficiary;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchBeneficiaryID"]) && $_POST["searchBeneficiaryID"] != '')
		{
			$beneficiaryIdentifier = $_POST["searchBeneficiaryID"];
			
			//Insert new beneficiary
			$beneficiaryIdentifier = STR_REPLACE("'","''",$_POST["searchBeneficiaryID"]) ;
			$beneficiaryIdentifier = STR_REPLACE('"','""',$beneficiaryIdentifier) ;
			foreach ($_POST['searchBeneficiaryType'] as $select)
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
			
			$sql = "INSERT INTO e_beneficiary ( e_beneficiary_id, e_beneficiary_identifier, e_beneficiary_type ) VALUES (";
			$sql = $sql.$maxBeneficiary.",'".$beneficiaryIdentifier."',".$beneficiaryType.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$beneficiary = $maxBeneficiary;
		}

	}

	//Update parties
	if (isset($_POST["searchParties"]))
	{
		$parties = $_POST["searchParties"];
	}
	if ($parties != '')
	{
		foreach ($_POST['searchTradingCapacity'] as $select)
		{
			$tradingCapacity = $select ;
		}
		foreach ($_POST['searchBuySellIndicator'] as $select)
		{
			$buySellIndicator = $select ;
		}
		$initiatorAggressor='';
		if (isset ($_POST['searchInitiatorAggressor'])) {
			foreach ($_POST['searchInitiatorAggressor'] as $select)
			{
				$initiatorAggressor = $select ;
			}
		}
		if ($trader=='')
		{$trader = 'null';}
		if ($reportingEntity=='')
		{$reportingEntity = 'null';}
		if ($beneficiary=='')
		{$beneficiary = 'null';}
		if ($tradingCapacity=='')
		{$tradingCapacity = 'null';}
		if ($buySellIndicator=='')
		{$buySellIndicator = 'null';}
		if ($initiatorAggressor=='')
		{$initiatorAggressor = 'NULL';}

		$sql = "UPDATE e_parties SET e_parties_trader = ".$trader.", 
			e_parties_reportingentity = ".$reportingEntity.", 
			e_parties_beneficiary = ".$beneficiary.", 
			e_parties_tradingcapacity = ".$tradingCapacity.", 
			e_parties_buysellindicator = ".$buySellIndicator.", 
			e_parties_initiatoraggressor = ".$initiatorAggressor." 
			WHERE e_parties_id = ".$parties;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	//Update order
	if (isset($_POST["searchOrder"]))
	{
		$order = $_POST["searchOrder"];
	}
	if ($order != '')
	{
		$orderID = STR_REPLACE("'","''",$_POST["searchOrderID"]) ;
		$orderID = STR_REPLACE('"','""',$orderID) ;
		foreach ($_POST['searchOrderType'] as $select)
		{
			$orderType = $select ;
		}
		foreach ($_POST['searchOrderCondition'] as $select)
		{
			$orderCondition = $select ;
		}
		foreach ($_POST['searchOrderStatus'] as $select)
		{
			$orderStatus = $select ;
		}
		$minimumExecutionVolume = $_POST["searchMinimumExecutionVolume"] ;
		$priceLimit = $_POST["searchPriceLimit"] ;
		$undisclosedVolume = $_POST["searchUndisclosedVolume"] ;
		foreach ($_POST['searchOrderDuration'] as $select)
		{
			$orderDuration = $select ;
		}
		
		if ($orderType=='')
		{$orderType = 'null';}
		if ($orderCondition=='')
		{$orderCondition = 'null';}
		if ($orderStatus=='')
		{$orderStatus = 'null';}
		if ($minimumExecutionVolume=='')
		{$minimumExecutionVolume = 'null';}
		if ($priceLimit=='')
		{$priceLimit = 'null';}
		if ($undisclosedVolume=='')
		{$undisclosedVolume = 'null';}
		if ($orderDuration=='')
		{$orderDuration = 'null';}
		
		$sql = "UPDATE e_order SET e_order_identifier = '".$orderID."', 
			e_order_type = ".$orderType.", 
			e_order_condition = ".$orderCondition.", 
			e_order_status = ".$orderStatus.", 
			e_order_minimumexecutionvolume = ".$minimumExecutionVolume.", 
			e_order_pricelimit = ".$buySellIndicator.", 
			e_order_undisclosedvolume = ".$undisclosedVolume.", 
			e_order_duration = ".$orderDuration." 
			WHERE e_order_id = ".$order;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchOrderID"]) && $_POST["searchOrderID"] != '')
		{
			$orderID = $_POST["searchOrderID"];
			
			//Insert new order
			$query = pg_query( $cnx, "SELECT MAX(e_order_id)+1 FROM e_order" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxOrder = $row[0];
			}
			if (is_null($maxOrder))
			{
				$maxOrder = 1;
			}
			
			$orderID = STR_REPLACE("'","''",$_POST["searchOrderID"]) ;
			$orderID = STR_REPLACE('"','""',$orderID) ;
			foreach ($_POST['searchOrderType'] as $select)
			{
				$orderType = $select ;
			}
			foreach ($_POST['searchOrderCondition'] as $select)
			{
				$orderCondition = $select ;
			}
			foreach ($_POST['searchOrderStatus'] as $select)
			{
				$orderStatus = $select ;
			}
			$minimumExecutionVolume = $_POST["searchMinimumExecutionVolume"] ;
			$priceLimit = $_POST["searchPriceLimit"] ;
			$undisclosedVolume = $_POST["searchUndisclosedVolume"] ;
			foreach ($_POST['searchOrderDuration'] as $select)
			{
				$orderDuration = $select ;
			}
			
			if ($orderType=='')
			{$orderType = 'null';}
			if ($orderCondition=='')
			{$orderCondition = 'null';}
			if ($orderStatus=='')
			{$orderStatus = 'null';}
			if ($minimumExecutionVolume=='')
			{$minimumExecutionVolume = 'null';}
			if ($priceLimit=='')
			{$priceLimit = 'null';}
			if ($undisclosedVolume=='')
			{$undisclosedVolume = 'null';}
			if ($orderDuration=='')
			{$orderDuration = 'null';}
			
			$sql = "INSERT INTO e_order ( e_order_id, e_order_identifier, e_order_type, e_order_condition, e_order_status, e_order_minimumexecutionvolume, e_order_pricelimit, e_order_undisclosedvolume, e_order_duration ) VALUES (";
			$sql = $sql.$maxOrder.",'".$orderID."',".$orderType.",".$orderCondition.",".$orderStatus.",".$minimumExecutionVolume.",".$priceLimit.",".$undisclosedVolume.",".$orderDuration.")";
			//execution de la requete SQL:
			echo $sql;
			echo ('.........'.$order);
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			$order = $maxOrder;
		}
		
	}
	
	//Update contract
	if (isset($_POST["searchContract"]))
	{
		$contract = $_POST["searchContract"];
	}
	if ($contract != '')
	{
		$contractID = STR_REPLACE("'","''",$_POST["searchContractID"]) ;
		$contractID = STR_REPLACE('"','""',$contractID) ;
		$contractName = STR_REPLACE("'","''",$_POST["searchContractName"]) ;
		$contractName = STR_REPLACE('"','""',$contractName) ;
		foreach ($_POST['searchContractType'] as $select)
		{
			$contractType = $select ;
		}
		foreach ($_POST['searchEnergyCommodity'] as $select)
		{
			$energyCommodity = $select ;
		}
		$fixingIndex = $_POST["searchFixingIndex"] ;
		$fixingIndex = STR_REPLACE("'","''",$fixingIndex) ;
		$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
		foreach ($_POST['searchSettlementMethod'] as $select)
		{
			$settlementMethod = $select ;
		}
		foreach ($_POST['searchOrganisedMarketPlace'] as $select)
		{
			$organisedMarketPlace = $select ;
		}
		
		if ($contractName=='')
		{$contractName = 'null';}
		if ($contractType=='')
		{$contractType = 'null';}
		if ($energyCommodity=='')
		{$energyCommodity = 'null';}
		if ($fixingIndex=='')
		{$fixingIndex = 'null';}
		if ($settlementMethod=='')
		{$settlementMethod = 'null';}
		if ($organisedMarketPlace=='')
		{$organisedMarketPlace = 'null';}
		if ($_POST["searchTradingHours1"]=='')
		{
			$tradingHours = '';
		} else {
			$tradingHours = $_POST["searchTradingHours1"].":00/".$_POST["searchTradingHours2"].":59" ;
		}
		if ($_POST["searchLastTraidingDate"]=='')
		{
			$lastTraidingDate = 'null';
			$finishSQL = "e_contract_lasttraidingdate = ".$lastTraidingDate." ";
		} else {
			$lastTraidingDate= $_POST["searchLastTraidingDate"]." ".$_POST["searchLastTraidingTime"] ;
			$finishSQL = "e_contract_lasttraidingdate = '".$lastTraidingDate."' ";
		}
	
		$sql = "UPDATE e_contract SET e_contract_identifier = '".$contractID."', 
			e_contract_name = '".$contractName."', 
			e_contract_type = ".$contractType.", 
			e_contract_energycommodity = ".$energyCommodity.", 
			e_contract_fixingindex = '".$fixingIndex."', 
			e_contract_settlementmethod = ".$settlementMethod.", 
			e_contract_organisedmarketplace = ".$organisedMarketPlace.", 
			e_contract_tradinghours = '".$tradingHours."', ".$finishSQL."
			WHERE e_contract_id = ".$contract;
		//execution de la requete SQL:
		echo $sql;
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchContractID"]) && $_POST["searchContractID"] != '')
		{
			$contractID = $_POST["searchContractID"];
			
			//Insert new contract
			$query = pg_query( $cnx, "SELECT MAX(e_contract_id)+1 FROM e_contract" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxContract = $row[0];
			}
			if (is_null($maxContract))
			{
				$maxContract = 1;
			}
			
			$contractID = STR_REPLACE("'","''",$_POST["searchContractID"]) ;
			$contractID = STR_REPLACE('"','""',$contractID) ;
			$contractName = STR_REPLACE("'","''",$_POST["searchContractName"]) ;
			$contractName = STR_REPLACE('"','""',$contractName) ;
			foreach ($_POST['searchContractType'] as $select)
			{
				$contractType = $select ;
			}
			foreach ($_POST['searchEnergyCommodity'] as $select)
			{
				$energyCommodity = $select ;
			}
			$fixingIndex = $_POST["searchFixingIndex"] ;
			$fixingIndex = STR_REPLACE("'","''",$fixingIndex) ;
			$fixingIndex = STR_REPLACE('"','""',$fixingIndex) ;
			foreach ($_POST['searchSettlementMethod'] as $select)
			{
				$settlementMethod = $select ;
			}
			foreach ($_POST['searchOrganisedMarketPlace'] as $select)
			{
				$organisedMarketPlace = $select ;
			}
			
			if ($contractName=='')
			{$contractName = 'null';}
			if ($contractType=='')
			{$contractType = 'null';}
			if ($energyCommodity=='')
			{$energyCommodity = 'null';}
			if ($fixingIndex=='')
			{$fixingIndex = 'null';}
			if ($settlementMethod=='')
			{$settlementMethod = 'null';}
			if ($organisedMarketPlace=='')
			{$organisedMarketPlace = 'null';}
			if ($_POST["searchTradingHours1"]=='')
			{
				$tradingHours = '';
			} else {
				$tradingHours = $_POST["searchTradingHours1"].":00/".$_POST["searchTradingHours2"].":59" ;
			}
			if ($_POST["searchLastTraidingDate"]=='')
			{
				$lastTraidingDate = 'null';
				$finishSQL = "e_contract_lasttraidingdate = ".$lastTraidingDate." ";
			} else {
				$lastTraidingDate= $_POST["searchLastTraidingDate"]." ".$_POST["searchLastTraidingTime"] ;
				$finishSQL = "e_contract_lasttraidingdate = '".$lastTraidingDate."' ";
			}
			
			$sql = "INSERT INTO e_contract ( e_contract_id, e_contract_identifier, e_contract_name, e_contract_type, e_contract_energycommodity, e_contract_fixingindex, e_contract_settlementmethod, e_contract_organisedmarketplace, e_contract_tradinghours, e_contract_lasttraidingdate ) VALUES (";
			$sql = $sql.$maxContract.",'".$contractID."','".$contractName."',".$contractType.",".$energyCommodity.",'".$fixingIndex."',".$settlementMethod.",".$organisedMarketPlace.",'".$tradingHours."',".$lastTraidingDate.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$contract = $maxContract;
		}
		
	}
	
	
	//Update transaction
	if (isset($_POST["searchUniqueTransaction"]))
	{
		$transaction = $_POST["searchUniqueTransaction"];
	}
	
	if (!empty($transaction))
	{
		$transactionID = STR_REPLACE("'","''",$_POST["searchUniqueTransactionID"]) ;
		$transactionID = STR_REPLACE('"','""',$transactionID) ;
		$transactionTimestamp = $_POST["searchTransactionTimestampDate"]." ".$_POST["searchTransactionTimestampTime"] ;
		$linkedTransactionID = STR_REPLACE("'","''",$_POST["searchLinkedTransactionID"]) ;
		$linkedTransactionID = STR_REPLACE('"','""',$linkedTransactionID) ;
		$linkedOrderID = STR_REPLACE("'","''",$_POST["searchLinkedOrderID"]) ;
		$linkedOrderID = STR_REPLACE('"','""',$linkedOrderID) ;
		foreach ($_POST['searchVoicebrokered'] as $select)
		{
			$voicebrokered = $select ;
		}
		$price = $_POST["searchPrice"] ;
		$indexValue = $_POST["searchIndexValue"] ;
		foreach ($_POST['searchPriceCurrency'] as $select)
		{
			$priceCurrency = $select ;
		}
		$notionalAmount = $_POST["searchNotionalAmount"] ;
		foreach ($_POST['searchNotionalCurrency'] as $select)
		{
			$notionalCurrency = $select ;
		}
		$quantity = $_POST["searchQuantity"] ;
		$totalNotionalcontractQuantity = $_POST["searchTotalNotionalContractQuantity"] ;
		foreach ($_POST['searchQuantityUnit'] as $select)
		{
			$quantityUnit = $select ;
		}
		foreach ($_POST['searchTotalNotionalContractQuantityUnit'] as $select)
		{
			$totalNotionalcontractQuantityUnit = $select ;
		}
		$terminationDate = $_POST["searchTerminationDate"] ;
		
		if ($linkedTransactionID=='')
		{$linkedTransactionID = 'null';}
		if ($linkedOrderID=='')
		{$linkedOrderID = 'null';}
		if ($voicebrokered=='')
		{$voicebrokered = 'null';}
		if ($price=='')
		{$price = 'null';}
		if ($indexValue=='')
		{$indexValue = 'null';}
		if ($priceCurrency=='')
		{$priceCurrency = 'null';}
		if ($notionalAmount=='')
		{$notionalAmount = 'null';}
		if ($notionalCurrency=='')
		{$notionalCurrency = 'null';}
		if ($quantity=='')
		{$quantity = 'null';}
		if ($totalNotionalcontractQuantity=='')
		{$totalNotionalcontractQuantity = 'null';}
		if ($quantityUnit=='')
		{$quantityUnit = 'null';}
		if ($totalNotionalcontractQuantityUnit=='')
		{$totalNotionalcontractQuantityUnit = 'null';}
		if (is_null($terminationDate)||$terminationDate=='')
		{$terminationDate = 'null';}
		else{$terminationDate='\''. $terminationDate.'\''; }
	
		$sql = "UPDATE e_transaction SET e_transaction_uniquetransactionid = '".$transactionID."', 
			e_transaction_timestamp = '".$transactionTimestamp."', 
			e_transaction_linkedtransaction = '".$linkedTransactionID."', 
			e_transaction_linkedorder = '".$linkedOrderID."', 
			e_transaction_voicebrokered = ".$voicebrokered.", 
			e_transaction_price = ".$price.", 
			e_transaction_indexvalue = ".$indexValue.", 
			e_transaction_priceCurrency = ".$priceCurrency.", 
			e_transaction_notionalamount = ".$notionalAmount.", 
			e_transaction_notionalcurrency = ".$notionalCurrency.", 
			e_transaction_quantity = ".$quantity.", 
			e_transaction_totalnotionalcontractquantity = ".$totalNotionalcontractQuantity.", 
			e_transaction_quantityunit = ".$quantityUnit.", 
			e_transaction_totalnotionalcontractquantityunit = ".$totalNotionalcontractQuantityUnit.", 
			e_transaction_terminationdate = ".$terminationDate." 
			WHERE e_transaction_id = ".$transaction;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchUniqueTransactionID"]) && $_POST["searchUniqueTransactionID"] != '')
		{
			$transactionID = $_POST["searchUniqueTransactionID"];
			
			//Insert new transaction
			$query = pg_query( $cnx, "SELECT MAX(e_transaction_id)+1 FROM e_transaction" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxTransaction = $row[0];
			}
			if (is_null($maxTransaction))
			{
				$maxTransaction = 1;
			}
			
			$transactionID = STR_REPLACE("'","''",$_POST["searchUniqueTransactionID"]) ;
			$transactionID = STR_REPLACE('"','""',$transactionID) ;
			$transactionTimestamp = $_POST["searchTransactionTimestampDate"]." ".$_POST["searchTransactionTimestampTime"] ;
			$linkedTransactionID = STR_REPLACE("'","''",$_POST["searchLinkedTransactionID"]) ;
			$linkedTransactionID = STR_REPLACE('"','""',$linkedTransactionID) ;
			$linkedOrderID = STR_REPLACE("'","''",$_POST["searchLinkedOrderID"]) ;
			$linkedOrderID = STR_REPLACE('"','""',$linkedOrderID) ;
			$voicebrokered='';
			if (isset ($_POST['searchVoicebrokered'])) {
				foreach ($_POST['searchVoicebrokered'] as $select)
				{
					$voicebrokered = $select ;
				}
			}
			$price = $_POST["searchPrice"] ;
			$indexValue = $_POST["searchIndexValue"] ;
			foreach ($_POST['searchPriceCurrency'] as $select)
			{
				$priceCurrency = $select ;
			}
			$notionalAmount = $_POST["searchNotionalAmount"] ;
			foreach ($_POST['searchNotionalCurrency'] as $select)
			{
				$notionalCurrency = $select ;
			}
			$quantity = $_POST["searchQuantity"] ;
			$totalNotionalcontractQuantity = $_POST["searchTotalNotionalContractQuantity"] ;
			$quantityUnit='';
			if (isset ($_POST['searchQuantityUnit'])) {
				foreach ($_POST['searchQuantityUnit'] as $select)
				{
					$quantityUnit = $select ;
				}
			}
			foreach ($_POST['searchTotalNotionalContractQuantityUnit'] as $select)
			{
				$totalNotionalcontractQuantityUnit = $select ;
			}
			$terminationDate = $_POST["searchTerminationDate"] ;
			
			if ($linkedTransactionID=='')
			{$linkedTransactionID = 'null';}
			if ($linkedOrderID=='')
			{$linkedOrderID = 'null';}
			if ($voicebrokered=='')
			{$voicebrokered = 'null';}
			if ($price=='')
			{$price = 'null';}
			if ($indexValue=='')
			{$indexValue = 'null';}
			if ($priceCurrency=='')
			{$priceCurrency = 'null';}
			if ($notionalAmount=='')
			{$notionalAmount = 'null';}
			if ($notionalCurrency=='')
			{$notionalCurrency = 'null';}
			if ($quantity=='')
			{$quantity = 'null';}
			if ($totalNotionalcontractQuantity=='')
			{$totalNotionalcontractQuantity = 'null';}
			if ($quantityUnit=='')
			{$quantityUnit = 'null';}
			if ($totalNotionalcontractQuantityUnit=='')
			{$totalNotionalcontractQuantityUnit = 'null';}
			if (is_null($terminationDate)||$terminationDate=='')
			{$terminationDate = 'null';}
			else{$terminationDate='\''. $terminationDate.'\''; }
			
			$sql = "INSERT INTO e_transaction ( e_transaction_id, e_transaction_uniquetransactionid, e_transaction_timestamp, e_transaction_linkedtransaction, e_transaction_linkedorder, e_transaction_voicebrokered, e_transaction_price, e_transaction_indexvalue, e_transaction_priceCurrency, e_transaction_notionalamount, e_transaction_notionalcurrency, e_transaction_quantity, e_transaction_totalnotionalcontractquantity, e_transaction_quantityunit, e_transaction_totalnotionalcontractquantityunit, e_transaction_terminationdate ) VALUES (";
			$sql = $sql.$maxTransaction.",'".$transactionID."','".$transactionTimestamp."','".$linkedTransactionID."','".$linkedOrderID."',".$voicebrokered.",".$price.",".$indexValue.",".$priceCurrency.",".$notionalAmount.",".$notionalCurrency.",".$quantity.",".$totalNotionalcontractQuantity.",".$quantityUnit.",".$totalNotionalcontractQuantityUnit.",".$terminationDate.")";
			//execution de la requete SQL:
			$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
			
			$transaction = $maxTransaction;
		}
	}
	
	
	//Update option
	if (isset($_POST["searchOption"]))
	{
		$option = $_POST["searchOption"];
	}
	if ($option != '')
	{
		foreach ($_POST['searchOptionType'] as $select)
		{
			$optionType = $select ;
		}
		foreach ($_POST['searchOptionStyle'] as $select)
		{
			$optionStyle = $select ;
		}
		$exerciseDate = $_POST["searchExerciseDate"] ;
		$strikePrice = $_POST["searchStrikePrice"] ;
		
		if ($optionStyle=='')
		{$optionStyle = 'null';}
		if ($optionType=='')
		{$optionType = 'null';}
		if (is_null($exerciseDate)||$exerciseDate=='')
		{$exerciseDate = 'null';}
		else{$exerciseDate='\''. $exerciseDate.'\''; }
		if (is_null($strikePrice)||$strikePrice=='')
		{$strikePrice = 'null';}
	
		$sql = "UPDATE e_option SET e_option_style = ".$optionStyle.", 
			e_option_type = ".$optionType.", 
			e_option_exercisedate = ".$exerciseDate.", 
			e_option_strikeprice = ".$strikePrice." 
			WHERE e_option_id = ".$option;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	else {
		if (isset($_POST["searchOptionType"]) && $_POST["searchOptionType"] != '')
		{
			//Insert new option
			$query = pg_query( $cnx, "SELECT MAX(e_option_id)+1 FROM e_option" ); //requete
			while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
			{
				$maxOption = $row[0];
			}
			if (is_null($maxOption))
			{
				$maxOption = 1;
			}
			
			foreach ($_POST['searchOptionType'] as $select)
			{
				$optionType = $select ;
			}
			foreach ($_POST['searchOptionStyle'] as $select)
			{
				$optionStyle = $select ;
			}
			$exerciseDate = $_POST["searchExerciseDate"] ;
			$strikePrice = $_POST["searchStrikePrice"] ;
			
			if ($optionStyle=='')
			{$optionStyle = 'null';}
			if ($optionType=='')
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
			
			$option = $maxOption;
		}
	}
	
	
	//Update delivery point
	if (isset($_POST["searchDeliveryPoint"]))
	{
		$deliveryPoint = $_POST["searchDeliveryPoint"];
	}
	if (isset($_POST["searchDeliveryProfile"]))
	{
		$deliveryProfile = $_POST["searchDeliveryProfile"];
	}
	if ($deliveryPoint != '')
	{
		$deliveryPointName = STR_REPLACE("'","''",$_POST["searchDeliveryPointName"]) ;
		$deliveryPointName = STR_REPLACE('"','""',$deliveryPointName) ;
		if ($deliveryPointName=='')
		{$deliveryPointName = 'null';}
	
		$sql = "UPDATE e_deliverypoint SET e_deliverypoint_identifier = '".$deliveryPointName."' 
			WHERE e_deliverypoint_id = ".$deliveryPoint;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
		$deliveryStartDate = $_POST["searchDeliveryStartDate"] ;
		$deliveryEndDate = $_POST["searchDeliveryEndDate"] ;
		$duration='';
		if (isset ($_POST['searchDuration'])) {
			foreach ($_POST['searchDuration'] as $select)
			{
				$duration = $select ;
			}
		}
		foreach ($_POST['searchLoadType'] as $select)
		{
			$loadType = $select ;
		}
		foreach ($_POST['searchDaysOfTheWeek'] as $select)
		{
			$daysOfTheWeek = $select ;
		}
		$loadDeliveryIntervals = STR_REPLACE("'","''",$_POST["searchLoadDeliveryIntervals"]) ;
		$loadDeliveryIntervals = STR_REPLACE('"','""',$loadDeliveryIntervals) ;
		$loadDeliveryIntervals = preg_replace('/[^A-Za-z0-9\.\-:\/\ \']/', '', $loadDeliveryIntervals);
		$deliveryCapacity = $_POST["searchDeliveryCapacity"] ;
		if (isset ($_POST['searchDeliveryCapacityUnit'])) {
			foreach ($_POST['searchDeliveryCapacityUnit'] as $select)
			{
				$quantityUnit = $select ;
			}
		}
		
		$priceTimeIntervalsQuantity = $_POST['searchPriceTimeIntervalsQuantity'];
	
		if ($deliveryPoint=='')
		{$deliveryPoint = 'null';}
		if (is_null($deliveryStartDate)||$deliveryStartDate=='')
		{$deliveryStartDate = 'null';}
		else{$deliveryStartDate='\''. $deliveryStartDate.'\''; }
		if (is_null($deliveryEndDate)||$deliveryEndDate=='')
		{$deliveryEndDate = 'null';}
		else{$deliveryEndDate='\''. $deliveryEndDate.'\''; }
		if ($duration=='')
		{$duration = 'null';}
		if ($loadType=='')
		{$loadType = 'null';}
		if ($daysOfTheWeek=='')
		{$daysOfTheWeek = 'null';}
		if ($loadDeliveryIntervals=='')
		{$loadDeliveryIntervals = 'null';}
		if ($deliveryCapacity=='')
		{$deliveryCapacity = 'null';}
		if ($quantityUnit=='')
		{$quantityUnit = 'null';}
		if ($priceTimeIntervalsQuantity==''||is_null($priceTimeIntervalsQuantity))
		{$priceTimeIntervalsQuantity = 'null';}
				
		$sql = "UPDATE e_deliveryprofile SET e_deliveryprofile_deliverystartdate = ".$deliveryStartDate.", 
			e_deliveryprofile_deliveryenddate = ".$deliveryEndDate.", 
			e_deliveryprofile_duration = ".$duration.", 
			e_deliveryprofile_loadtype = ".$loadType.", 
			e_deliveryprofile_daysoftheweek = ".$daysOfTheWeek.", 
			e_deliveryprofile_loaddeliveryintervals = '".$loadDeliveryIntervals."', 
			e_deliveryprofile_deliverycapacity = ".$deliveryCapacity.", 
			e_deliveryprofile_quantityunit = ".$quantityUnit.", 
			e_deliveryprofile_pricetimeintervalquantity = ".$priceTimeIntervalsQuantity." 
			WHERE e_deliveryprofile_id = ".$deliveryProfile;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	//Update execution

	$execution = $_POST["searchExecution"];

	foreach ($_POST['searchActionType'] as $select)
	{
		$actionType = $select ;
	}
	if ($actionType != '')
	{
		$sql = "UPDATE execution SET ".
			(isset ($order) && $order != ''?"execution_order = ".$order.", " : '').
			(isset ($contract) && $contract != ''?"execution_contract = ".$contract.", " : '').
			"execution_transaction = ".$transaction.", ".
			(isset ($option) && $option!=''?"execution_option = ".$option.", " : '').
			"execution_actiontype = ".$actionType."
			WHERE execution_id = ".$execution;
		//execution de la requete SQL:
		echo($sql);
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
		
		echo('------------------------------------SUCCESS---------------------------------------------');
	}
	
	$billName = $_POST["searchBillID"] ;
	$bill = $_POST["searchBill"] ;
	if ($bill != '')
	{
		$sql = "UPDATE e_bill SET e_bill_name = '".$billName."'
			WHERE e_bill_id = ".$bill;
		//execution de la requete SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
    
  
?>