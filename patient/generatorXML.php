<?php
require 'connect.php';
include 'head.php';

if ($cnx) {
	$query = pg_query ( $cnx, "SELECT contract.contract_id, contract.contract_contract, c_parties.c_parties_marketparticipant1, c_parties.c_parties_marketparticipant2, 
	c_parties.c_parties_reportingentity, c_parties.c_parties_beneficiary, c_tradingcapacity.c_tradingcapacity_name, c_buysellindicator.c_buysellindicator_name, 
	c_contract.c_contract_identifier, c_contract.c_contract_date, c_contracttype.c_contracttype_name, c_energycommodity.c_energycommodity_name,
	c_price.c_price_formula, 
	c_price.c_price, c_contract.c_contract_estimatednotionalamount, c_currency.c_currency_name, c_contract.c_contract_totalnotionalcontractquantity, c_contract.c_contract_totalnotionalcontractquantityunit,
	c_contract.c_contract_volumeoptionalitycapacity, c_contract.c_contract_volumeoptionalitycapacityunit, c_volumeoptionality.c_volumeoptionality_name, c_frequency.c_frequency_name, 
	c_contract.c_contract_volumeoptionalityintervals, c_deliverypoint.c_deliverypoint_identifier, c_deliveryprofile.c_deliveryprofile_deliverystartdate, 
	c_deliveryprofile.c_deliveryprofile_deliveryenddate, c_loadtype.c_loadtype_name, c_actiontype.c_actiontype_name, contract.contract_Delegate
	FROM (c_loadtype RIGHT JOIN (c_deliverypoint INNER JOIN c_deliveryprofile ON c_deliverypoint.c_deliverypoint_id = c_deliveryprofile.c_deliveryprofile_deliverypoint) ON c_loadtype.c_loadtype_id = c_deliveryprofile.c_deliveryprofile_loadtype) INNER JOIN ((c_price RIGHT JOIN (c_frequency RIGHT JOIN (c_volumeoptionality RIGHT JOIN (c_contracttype RIGHT JOIN (c_quantityunit RIGHT JOIN (c_currency RIGHT JOIN (c_energycommodity RIGHT JOIN c_contract ON c_energycommodity.c_energycommodity_id = c_contract.c_contract_energycommodity) ON c_currency.c_currency_id = c_contract.c_contract_notionalcurrency) ON c_quantityunit.c_quantityunit_id = c_contract.c_contract_totalnotionalcontractquantityunit) ON c_contracttype.c_contracttype_id = c_contract.c_contract_type) ON c_volumeoptionality.c_volumeoptionality_id = c_contract.c_contract_volumeoptionality) ON c_frequency.c_frequency_id = c_contract.c_contract_volumeoptionalityfrequency) ON c_price.c_price_id = c_contract.c_contract_price) INNER JOIN (c_actiontype RIGHT JOIN (c_tradingcapacity RIGHT JOIN (c_buysellindicator RIGHT JOIN (c_parties INNER JOIN contract ON c_parties.c_parties_id = contract.contract_parties) ON c_buysellindicator.c_buysellindicator_id = c_parties.c_parties_buysellindicator) ON c_tradingcapacity.c_tradingcapacity_id = c_parties.c_parties_tradingcapacity) ON c_actiontype.c_actiontype_id = contract.contract_actiontype) ON c_contract.c_contract_id = contract.contract_contract) ON c_deliveryprofile.c_deliveryprofile_id = contract.contract_deliveryprofile	
	WHERE (contract.contract_xml=0);
	" );
	
	/*$query = pg_query ( $cnx, "SELECT  c_price.c_price_formula
	FROM (c_loadtype RIGHT JOIN (c_deliverypoint INNER JOIN c_deliveryprofile ON c_deliverypoint.c_deliverypoint_id = c_deliveryprofile.c_deliveryprofile_deliverypoint) ON c_loadtype.c_loadtype_id = c_deliveryprofile.c_deliveryprofile_loadtype) INNER JOIN ((c_price RIGHT JOIN (c_frequency RIGHT JOIN (c_volumeoptionality RIGHT JOIN (c_contracttype RIGHT JOIN (c_quantityunit RIGHT JOIN (c_currency RIGHT JOIN (c_energycommodity RIGHT JOIN c_contract ON c_energycommodity.c_energycommodity_id = c_contract.c_contract_energycommodity) ON c_currency.c_currency_id = c_contract.c_contract_notionalcurrency) ON c_quantityunit.c_quantityunit_id = c_contract.c_contract_totalnotionalcontractquantityunit) ON c_contracttype.c_contracttype_id = c_contract.c_contract_type) ON c_volumeoptionality.c_volumeoptionality_id = c_contract.c_contract_volumeoptionality) ON c_frequency.c_frequency_id = c_contract.c_contract_volumeoptionalityfrequency) ON c_price.c_price_id = c_contract.c_contract_price) INNER JOIN (c_actiontype RIGHT JOIN (c_tradingcapacity RIGHT JOIN (c_buysellindicator RIGHT JOIN (c_parties INNER JOIN contract ON c_parties.[c_parties_id] = contract.[contract_Parties]) ON c_buysellindicator.c_buysellindicator_id = c_parties.c_parties_buysellindicator) ON c_tradingcapacity.c_tradingcapacity_id = c_parties.c_parties_tradingcapacity) ON c_actiontype.c_actiontype_id = contract.contract_actiontype) ON c_contract.c_contract_id = contract.contract_contract) ON c_deliveryprofile.c_deliveryprofile_id = contract.contract_deliveryprofile	
	WHERE (((contract.contract_xml)=0));
	" );*/
		
	
	while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
	{
		$priceFormula = $row[12];

		$contractXML = $row[0];
		$contract = $row[1];
		$marketParticipant1ID = $row[2];
	
		if (!empty($marketParticipant1ID))
		{
			$queryMarketParticipant = pg_query ( $cnx, "SELECT c_marketparticipant.c_marketparticipant_id, c_marketparticipant.c_marketparticipant_identifier, 
			c_entitytype.c_entitytype_name
			FROM c_entitytype INNER JOIN c_marketparticipant ON c_entitytype.c_entitytype_id = c_marketparticipant.c_marketparticipant_type
			WHERE ((c_marketparticipant.c_marketparticipant_id=".$marketParticipant1ID."));
			" );
			while ( $rowMarketParticipant = pg_fetch_row ( $queryMarketParticipant ) ) // tant que c'est pas la fin de la table
			{
				$marketParticipant1ID = $rowMarketParticipant[1];
				$marketParticipant1Type = $rowMarketParticipant[2];
			}
		}
		$marketParticipant2ID = $row[3];
		if (!empty($marketParticipant2ID) )
		{
			$queryMarketParticipant2 = pg_query ( $cnx, "SELECT c_marketparticipant.c_marketparticipant_id, c_marketparticipant.c_marketparticipant_identifier, 
			c_entitytype.c_entitytype_name
			FROM c_entitytype INNER JOIN c_marketparticipant ON c_entitytype.c_entitytype_id = c_marketparticipant.c_marketparticipant_type
			WHERE ((c_marketparticipant.c_marketparticipant_id=".$marketParticipant2ID."));
			" );
			while ( $rowMarketParticipant2 = pg_fetch_row ( $queryMarketParticipant2 ) ) // tant que c'est pas la fin de la table
			{
				$marketParticipant2ID = $rowMarketParticipant2[1];
				$marketParticipant2Type = $rowMarketParticipant2[2];
			}
		}
		$reportingEntityID = $row[4];
		if (!empty($reportingEntityID) )
		{
			$queryReportingEntity = pg_query ( $cnx, "SELECT c_reportingentity.c_reportingentity_id, c_reportingentity.c_reportingentity_identifier, 
			c_entitytype.c_entitytype_name
			FROM c_entitytype INNER JOIN c_reportingentity ON c_entitytype.c_entitytype_id = c_reportingentity.c_reportingentity_type
			WHERE ((c_reportingentity.c_reportingentity_id=".$reportingEntityID."));
			" );
			while ( $rowReportingEntity = pg_fetch_row ( $queryReportingEntity ) ) // tant que c'est pas la fin de la table
			{
				$reportingEntityID = $rowReportingEntity[1];
				$reportingEntityType = $rowReportingEntity[2];
			}
		}
		$beneficiaryID = $row[5];
		if (!empty($beneficiaryID) )
		{
			$queryBeneficiary = pg_query ( $cnx, "SELECT c_beneficiary.c_beneficiary_id, c_beneficiary.c_beneficiary_identifier, c_entitytype.c_entitytype_name
			FROM c_entitytype INNER JOIN c_beneficiary ON c_entitytype.c_entitytype_id = c_beneficiary.c_beneficiary_type
			WHERE ((c_beneficiary.c_beneficiary_id=".$beneficiaryID."));
			" );
			while ( $rowBeneficiary = pg_fetch_row ( $queryBeneficiary ) ) // tant que c'est pas la fin de la table
			{
				$beneficiaryID = $rowBeneficiary[1];
				$beneficiaryType = $rowBeneficiary[2];
			}
		}
		$tradingCapacity = $row[6];
		$buySellIndicator = $row[7];
		$contractID = $row[8];
		$contractDate = $row[9];
		$contractType = $row[10];
		$energyCommodity = $row[11];

		if ($row[13]<>null)
		{
			$price = $row[13];
		}
		$estimatedNotionalAmount = $row[14];
		$notionalCurrency = $row[15];
		$totalNotionalcontractQuantity = $row[16];
		$totalNotionalcontractQuantityUnit = $row[17];
		$volumeOptionalityCapacity = $row[18];
		if (!empty($totalNotionalcontractQuantityUnit) )
		{
			$queryTotalNotionalcontractQuantityUnit = pg_query ( $cnx, "SELECT c_quantityunit.c_quantityunit_id, c_quantityunit.c_quantityunit_name
			FROM c_quantityunit
			WHERE ((c_quantityunit.c_quantityunit_id=".$totalNotionalcontractQuantityUnit."));
			" );
			while ( $rowTotalNotionalcontractQuantityUnit = pg_fetch_row ( $queryTotalNotionalcontractQuantityUnit ) ) // tant que c'est pas la fin de la table
			{
				$totalNotionalcontractQuantityUnit = $rowTotalNotionalcontractQuantityUnit[1];
			}
		}
		$volumeOptionalityCapacityUnit =  $row[19];
		if (!empty($volumeOptionalityCapacityUnit) )
		{
			$queryVolumeOptionalityCapacityUnit = pg_query ( $cnx, "SELECT c_quantityunit.c_quantityunit_id, c_quantityunit.c_quantityunit_name
			FROM c_quantityunit
			WHERE ((c_quantityunit.c_quantityunit_id=".$volumeOptionalityCapacityUnit."));
			" );
			while ( $rowVolumeOptionalityCapacityUnit = pg_fetch_row ( $queryVolumeOptionalityCapacityUnit ) ) // tant que c'est pas la fin de la table
			{
				$volumeOptionalityCapacityUnit = $rowVolumeOptionalityCapacityUnit[1];
			}
		}
		$volumeOptionality =  $row[20];
		$volumeOptionalityFrequency =  $row[21];
		$volumeOptionalityIntervals =  $row[22];
		$deliveryPointName =  $row[23];
		$deliveryStartDate =  $row[24];
		$deliveryEndDate =  $row[25];
		$loadType =  $row[26];
		$actionType =  $row[27];
		$delegateReporting =  $row[28];
		
		//On cree le XML avec les premieres infos
		
		$dom = new DOMDocument('1.0','utf-8');
		$dom->encoding = "utf-8";
		$dom->formatOutput = true;
	
		$root = $dom->createElement('REMITTable2');
		$root->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
		$root->setAttribute('xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable2_V1.xsd');
		$dom->appendChild($root);
		
		//reporting entity
		$reportingEntity = $dom->createElement('reportingEntityID');
		$root->appendChild($reportingEntity);
		$reportingEntityType = strtolower($reportingEntityType);
		$reportingEntity->appendChild( $dom->createElement($reportingEntityType, $reportingEntityID) );
		//fin reporting entity
		
		//trade
		$tradeXML = $dom->createElement('TradeList');
		$root->appendChild($tradeXML);
	
		$result = $dom->createElement('nonStandardcontractReport');
		$tradeXML->appendChild($result);
		
		$result->appendChild( $dom->createElement('RecordSeqNumber', $contractXML) );
		
		$result2 = $dom->createElement('idOfMarketParticipant');
		$result->appendChild($result2);
		$marketParticipant1Type = strtolower($marketParticipant1Type);
		$result2->appendChild( $dom->createElement($marketParticipant1Type, $marketParticipant1ID) );
		$result2 = $dom->createElement('otherMarketParticipant');
		$result->appendChild($result2);
		$marketParticipant2Type = strtolower($marketParticipant2Type);
		$result2->appendChild( $dom->createElement($marketParticipant2Type, $marketParticipant2ID) );
		if (!empty($beneficiaryType)&&!empty($beneficiaryID)&&$beneficiaryID<>'test')
		{
			$result2 = $dom->createElement('beneficiaryIdentification');
			$result->appendChild($result2);
			$beneficiaryType = strtolower($beneficiaryType);
			$result2->appendChild( $dom->createElement($beneficiaryType, $beneficiaryID) );
		}
		$result->appendChild( $dom->createElement('tradingCapacity', $tradingCapacity) );
		$result->appendChild( $dom->createElement('buySellIndicator', $buySellIndicator) );
		
		$result->appendChild( $dom->createElement('contractId', $contractID) );
		$contractDate = date('Y-m-d', strtotime($contractDate));
		$result->appendChild( $dom->createElement('contractDate', $contractDate) );
		$result->appendChild( $dom->createElement('contractType', $contractType) );
		$result->appendChild( $dom->createElement('energyCommodity', $energyCommodity) );
		
		$result2 = $dom->createElement('priceOrPriceFormula');
		$result->appendChild($result2);
		if (!empty($price))
		{
			$result2->appendChild( $dom->createElement('price', $price) );
		}
		if (!empty($priceFormula))
		{
			$result2->appendChild( $dom->createElement('priceFormula', $priceFormula) );
		}
		
		if (!empty($estimatedNotionalAmount) && $estimatedNotionalAmount <> 'null')
		{
			$result2 = $dom->createElement('estimatedNotionalAmount');
			$result->appendChild($result2);
			$result2->appendChild( $dom->createElement('value', $estimatedNotionalAmount) );
			$result2->appendChild( $dom->createElement('currency', $notionalCurrency) );
		}
		
		if (!empty($totalNotionalcontractQuantity))
		{
			$result2 = $dom->createElement('totalNotionalcontractQuantity');
			$result->appendChild($result2);
			$result2->appendChild( $dom->createElement('value', $totalNotionalcontractQuantity) );
			$result2->appendChild( $dom->createElement('unit', $totalNotionalcontractQuantityUnit) );
		}
		if (!empty($volumeOptionality))
		{
			$result->appendChild( $dom->createElement('volumeOptionality', $volumeOptionality) );
		}
		$result->appendChild( $dom->createElement('volumeOptionalityFrequency', $volumeOptionalityFrequency) );
		
		//Si dans volumeOptionalityCapacity on trouve un tiret (-), on a 2 intervalles ) dÃ©clarer sinon un seul
		$tiret = strpos($volumeOptionalityCapacity, '-');
		if ($tiret==true)
		{
			//on sÃ©pare les valeurs en min et max
			$volumeOptionalityCapacityIntervals = explode("-", $volumeOptionalityCapacity);
			$volumeOptionalityCapacityMin = $volumeOptionalityCapacityIntervals[0];
			$volumeOptionalityCapacityMax = $volumeOptionalityCapacityIntervals[1];
			
			
			$result2 = $dom->createElement('volumeOptionalityIntervals');
			$result->appendChild($result2);
			$result3 = $dom->createElement('capacity');
			$result2->appendChild($result3);
			$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacityMin) );
			$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
			if (!empty($volumeOptionalityIntervals))
			{
				$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
				$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
			}
			
			$result2 = $dom->createElement('volumeOptionalityIntervals');
			$result->appendChild($result2);
			$result3 = $dom->createElement('capacity');
			$result2->appendChild($result3);
			$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacityMax) );
			$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
			if (!empty($volumeOptionalityIntervals))
			{
				$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
				$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
			}
		}
		else {
			$result2 = $dom->createElement('volumeOptionalityIntervals');
			$result->appendChild($result2);
			$result3 = $dom->createElement('capacity');
			$result2->appendChild($result3);
			$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacity) );
			$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
			if (!empty($volumeOptionalityIntervals))
			{
				$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
				$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
			}
		}

		
		//Quand on arrive aux fixing index et options qui sont multiples, on passe dans une boucle while il y a une ligne renvoyee par la requete
		$queryIndexPrice = pg_query ( $cnx, "SELECT TOP 1 c_typeofindexprice.c_typeofindexprice_name
		FROM c_settlementmethod RIGHT JOIN (c_frequency RIGHT JOIN (c_fxingindextypes RIGHT JOIN (c_typeofindexprice RIGHT JOIN c_fixingindex ON c_typeofindexprice.c_typeofindexprice_id = c_fixingindex.c_fixingindex_typeofindexprice) ON c_fxingindextypes.c_fxingindextypes_id = c_fixingindex.c_fixingindex_fixingindextypes) ON c_frequency.c_frequency_id = c_fixingindex.c_fixingindex_fixingfrequency) ON c_settlementmethod.c_settlementmethod_id = c_fixingindex.c_fixingindex_settlementmethod
		WHERE ((c_fixingindex.c_fixingindex_contract=".$contract."));	
		" );
		while ( $rowIndexPrice = pg_fetch_row ( $queryIndexPrice ) ) // tant que c'est pas la fin de la table
		{
			$typeOfIndexPrice = $rowIndexPrice[0];
			//on genere la suite du XML avec toujours les meme balises
			$result->appendChild( $dom->createElement('typeOfIndexPrice', $typeOfIndexPrice) );
		}
		
		$settlementMethod = '';

		$queryFixingIndexDetails = pg_query ( $cnx, "SELECT c_typeofindexprice.c_typeofindexprice_name, c_fixingindex.c_fixingindex_fixingindex, 
		c_fxingindextypes.c_fxingindextypes_name, c_fixingindex.c_fixingindex_fixingindexsources, c_fixingindex.c_fixingindex_firstfixingdate, 
		c_fixingindex.c_fixingindex_lastfixingdate, c_frequency.c_frequency_name, c_settlementmethod.c_settlementmethod_name, c_fixingindex.c_fixingindex_contract
		FROM c_settlementmethod RIGHT JOIN (c_frequency RIGHT JOIN (c_fxingindextypes RIGHT JOIN (c_typeofindexprice RIGHT JOIN c_fixingindex ON c_typeofindexprice.c_typeofindexprice_id = c_fixingindex.c_fixingindex_typeofindexprice) ON c_fxingindextypes.c_fxingindextypes_id = c_fixingindex.c_fixingindex_fixingindextypes) ON c_frequency.c_frequency_id = c_fixingindex.c_fixingindex_fixingfrequency) ON c_settlementmethod.c_settlementmethod_id = c_fixingindex.c_fixingindex_settlementmethod
		WHERE ((c_fixingindex.c_fixingindex_contract=".$contract."));	
		" );
		while ( $rowFixingIndexDetails = pg_fetch_row ( $queryFixingIndexDetails ) ) // tant que c'est pas la fin de la table
		{
			$typeOfIndexPrice = $rowFixingIndexDetails[0];
			$fixingIndex = $rowFixingIndexDetails[1];
			$fixingIndexTypes = $rowFixingIndexDetails[2];
			$fixingIndexSources = $rowFixingIndexDetails[3];
			$fixingIndexFirstFixingDate = $rowFixingIndexDetails[4];
			$fixingIndexLastFixingDate = $rowFixingIndexDetails[5];
			$fixingIndexFrequency = $rowFixingIndexDetails[6];
			$settlementMethod = $rowFixingIndexDetails[7];
			
			if (!empty($fixingIndex) && $fixingIndex <> 'null')
			{
			//on genere la suite du XML avec toujours les memes balises
			$result2 = $dom->createElement('fixingIndexDetails');
			$result->appendChild($result2);
			$result2->appendChild( $dom->createElement('fixingIndex', $fixingIndex) );
			$result2->appendChild( $dom->createElement('fixingIndexType', $fixingIndexTypes) );
			$result2->appendChild( $dom->createElement('fixingIndexSource', $fixingIndexSources) );
			}
			
		}
		//if (!empty($settlementMethod) && $settlementMethod <> 'null')
		//{
			$result->appendChild( $dom->createElement('settlementMethod', $settlementMethod) );
		//}
		
		$queryOptionDetails = pg_query ( $cnx, "SELECT c_optionstyle.c_optionstyle_name, c_optiontype.c_optiontype_name, c_option.c_option_firstexercisedate, 
		c_option.c_option_lastexercisedate, c_frequency.c_frequency_name, c_option.c_option_strikeindex, c_optionstrikeindextype.c_optionstrikeindextype_name, 
		c_option.c_option_strikeindexsource, c_option.c_option_strikeprice, c_option.c_option_contract
		FROM c_optionstrikeindextype RIGHT JOIN (c_frequency RIGHT JOIN (c_optiontype RIGHT JOIN (c_optionstyle RIGHT JOIN c_option ON c_optionstyle.c_optionstyle_id = c_option.c_option_style) ON c_optiontype.c_optiontype_id = c_option.c_option_type) ON c_frequency.c_frequency_id = c_option.c_option_exercisefrequency) ON c_optionstrikeindextype.c_optionstrikeindextype_id = c_option.c_option_strikeindextype
		WHERE ((c_option.c_option_contract=".$contract."));
		" );
		while ( $rowOptionDetails = pg_fetch_row ( $queryOptionDetails ) ) // tant que c'est pas la fin de la table
		{
			$optionStyle = $rowOptionDetails[0];
			$optionType = $rowOptionDetails[1];
			$optionFirstExerciseDate = $rowOptionDetails[2];
			$optionLastExerciseDate = $rowOptionDetails[3];
			$optionExerciseFrequency = $rowOptionDetails[4];
			$optionStrikeIndex = $rowOptionDetails[5];
			$optionIndexType = $rowOptionDetails[6];
			$optionIndexSource = $rowOptionDetails[7];
			$optionStrikePrice = $rowOptionDetails[8];
			
			$result2 = $dom->createElement('optionDetails');
			$result->appendChild($result2);
			
			//on genere la suite du XML avec toujours les meme balises
			$result2->appendChild( $dom->createElement('optionStyle', $optionStyle) );
			$result2->appendChild( $dom->createElement('optionType', $optionType) );
			$optionFirstExerciseDate = date('Y-m-d', strtotime($optionFirstExerciseDate));
			$result2->appendChild( $dom->createElement('optionFirstExerciseDate', $optionFirstExerciseDate) );
			$optionLastExerciseDate = date('Y-m-d', strtotime($optionLastExerciseDate));
			$result2->appendChild( $dom->createElement('optionLastExerciseDate', $optionLastExerciseDate) );
			$result2->appendChild( $dom->createElement('optionStrikeIndex', $optionStrikeIndex) );
			$result2->appendChild( $dom->createElement('optionIndexType', $optionIndexType) );
			if (!empty($optionIndexSource) && $optionIndexSource <> 'null')
			{
				$result2->appendChild( $dom->createElement('optionIndexSource', $optionIndexSource) );
			}
			if (!empty($optionStrikePrice) && $optionStrikePrice <> 'null')
			{
				$result3 = $dom->createElement('optionStrikePrice');
				$result2->appendChild($result3);
				$result3->appendChild( $dom->createElement('value', $optionStrikePrice) );
				$result3->appendChild( $dom->createElement('currency', $notionalCurrency) );
			}
		}
		
		$result->appendChild( $dom->createElement('deliveryPointOrZone', $deliveryPointName) );
		$deliveryStartDate = date('Y-m-d', strtotime($deliveryStartDate));
		$result->appendChild( $dom->createElement('deliveryStartDate', $deliveryStartDate) );
		$deliveryEndDate = date('Y-m-d', strtotime($deliveryEndDate));
		$result->appendChild( $dom->createElement('deliveryEndDate', $deliveryEndDate) );
		$result->appendChild( $dom->createElement('loadType', $loadType) );
		$result->appendChild( $dom->createElement('actionType', $actionType) );
		
		if ($contractDate < '2016-04-07')
		{
			$dom->save('BACKLOADING_REMITTable2_V1_EDFDCO_V2_'.$contractXML.'.xml');
		}
		else
		{
			$dom->save(date('Ymd').'_REMITTable2_V1_EDFDCO_V2_'.$contractXML.'.xml');
		}
		
		
		
		//si le reporting delegue est true on change les valeurs marketparticipant et seller et trader
		if ($delegateReporting==true)
		{
			//On cree le XML avec les premieres infos
			$dom = new DOMDocument('1.0','utf-8');
			$dom->encoding = "utf-8";
			$dom->formatOutput = true;
		
			$root = $dom->createElement('REMITTable2');
			$root->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
			$root->setAttribute('xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable2_V1.xsd');
			$dom->appendChild($root);
			
			//reporting entity
			$reportingEntity = $dom->createElement('reportingEntityID');
			$root->appendChild($reportingEntity);
			$reportingEntityType = strtolower($reportingEntityType);
			$reportingEntity->appendChild( $dom->createElement($reportingEntityType, $reportingEntityID) );
			//fin reporting entity
			
			//trade
			$tradeXML = $dom->createElement('TradeList');
			$root->appendChild($tradeXML);
		
			$result = $dom->createElement('nonStandardcontractReport');
			$tradeXML->appendChild($result);
			
			$result->appendChild( $dom->createElement('RecordSeqNumber', $contractXML) );
			
			$result2 = $dom->createElement('idOfMarketParticipant');
			$result->appendChild($result2);
			$marketParticipant2Type = strtolower($marketParticipant2Type);
			$result2->appendChild( $dom->createElement($marketParticipant2Type, $marketParticipant2ID) );
			$result2 = $dom->createElement('otherMarketParticipant');
			$result->appendChild($result2);
			$marketParticipant1Type = strtolower($marketParticipant1Type);
			$result2->appendChild( $dom->createElement($marketParticipant1Type, $marketParticipant1ID) );
			if (!empty($beneficiaryType)&&!empty($beneficiaryID)&&$beneficiaryID<>'test')
			{
				$result2 = $dom->createElement('beneficiaryIdentification');
				$result->appendChild($result2);
				$beneficiaryType = strtolower($beneficiaryType);
				$result2->appendChild( $dom->createElement($beneficiaryType, $beneficiaryID) );
			}
			$result->appendChild( $dom->createElement('tradingCapacity', $tradingCapacity) );
			$result->appendChild( $dom->createElement('buySellIndicator', 'B') );
			
			$result->appendChild( $dom->createElement('contractId', $contractID) );
			$contractDate = date('Y-m-d', strtotime($contractDate));
			$result->appendChild( $dom->createElement('contractDate', $contractDate) );
			$result->appendChild( $dom->createElement('contractType', $contractType) );
			$result->appendChild( $dom->createElement('energyCommodity', $energyCommodity) );
			
			$result2 = $dom->createElement('priceOrPriceFormula');
			$result->appendChild($result2);
			if (!empty($price))
			{
				$result2->appendChild( $dom->createElement('price', $price) );
			}
			if (!empty($priceFormula))
			{
				$result2->appendChild( $dom->createElement('priceFormula', $priceFormula) );
			}
			
			if (!empty($estimatedNotionalAmount) && $estimatedNotionalAmount <> 'null')
			{
				$result2 = $dom->createElement('estimatedNotionalAmount');
				$result->appendChild($result2);
				$result2->appendChild( $dom->createElement('value', $estimatedNotionalAmount) );
				$result2->appendChild( $dom->createElement('currency', $notionalCurrency) );
			}
			
			if (!empty($totalNotionalcontractQuantity))
			{
				$result2 = $dom->createElement('totalNotionalcontractQuantity');
				$result->appendChild($result2);
				$result2->appendChild( $dom->createElement('value', $totalNotionalcontractQuantity) );
				$result2->appendChild( $dom->createElement('unit', $totalNotionalcontractQuantityUnit) );
			}
			if (!empty($volumeOptionality))
			{
				$result->appendChild( $dom->createElement('volumeOptionality', $volumeOptionality) );
			}
			$result->appendChild( $dom->createElement('volumeOptionalityFrequency', $volumeOptionalityFrequency) );
			
			//Si dans volumeOptionalityCapacity on trouve un tiret (-), on a 2 intervalles ) dÃ©clarer sinon un seul
			$tiret = strpos($volumeOptionalityCapacity, '-');
			if ($tiret==true)
			{
				//on sÃ©pare les valeurs en min et max
				$volumeOptionalityCapacityIntervals = explode("-", $volumeOptionalityCapacity);
				$volumeOptionalityCapacityMin = $volumeOptionalityCapacityIntervals[0];
				$volumeOptionalityCapacityMax = $volumeOptionalityCapacityIntervals[1];
				
				
				$result2 = $dom->createElement('volumeOptionalityIntervals');
				$result->appendChild($result2);
				$result3 = $dom->createElement('capacity');
				$result2->appendChild($result3);
				$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacityMin) );
				$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
				if (!empty($volumeOptionalityIntervals))
				{
					$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
					$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
				}
				
				$result2 = $dom->createElement('volumeOptionalityIntervals');
				$result->appendChild($result2);
				$result3 = $dom->createElement('capacity');
				$result2->appendChild($result3);
				$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacityMax) );
				$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
				if (!empty($volumeOptionalityIntervals))
				{
					$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
					$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
				}
			}
			else {
				$result2 = $dom->createElement('volumeOptionalityIntervals');
				$result->appendChild($result2);
				$result3 = $dom->createElement('capacity');
				$result2->appendChild($result3);
				$result3->appendChild( $dom->createElement('value', $volumeOptionalityCapacity) );
				$result3->appendChild( $dom->createElement('unit', $volumeOptionalityCapacityUnit) );
				if (!empty($volumeOptionalityIntervals))
				{
					$result2->appendChild( $dom->createElement('startDate', substr($volumeOptionalityIntervals, 0, 10)) );
					$result2->appendChild( $dom->createElement('endDate', substr($volumeOptionalityIntervals, 11, 19)) );
				}
			}
	
			
			//Quand on arrive aux fixing index et options qui sont multiples, on passe dans une boucle while il y a une ligne renvoyee par la requete
			$queryIndexPrice = pg_query ( $cnx, "SELECT TOP 1 c_typeofindexprice.c_typeofindexprice_name
			FROM c_settlementmethod RIGHT JOIN (c_frequency RIGHT JOIN (c_fxingindextypes RIGHT JOIN (c_typeofindexprice RIGHT JOIN c_fixingindex ON c_typeofindexprice.c_typeofindexprice_id = c_fixingindex.c_fixingindex_typeofindexprice) ON c_fxingindextypes.c_fxingindextypes_id = c_fixingindex.c_fixingindex_fixingindextypes) ON c_frequency.c_frequency_id = c_fixingindex.c_fixingindex_fixingfrequency) ON c_settlementmethod.c_settlementmethod_id = c_fixingindex.c_fixingindex_settlementmethod
			WHERE ((c_fixingindex.c_fixingindex_contract=".$contract."));	
			" );
			while ( $rowIndexPrice = pg_fetch_row ( $queryIndexPrice ) ) // tant que c'est pas la fin de la table
			{
				$typeOfIndexPrice = $rowIndexPrice[0];
				//on genere la suite du XML avec toujours les meme balises
				$result->appendChild( $dom->createElement('typeOfIndexPrice', $typeOfIndexPrice) );
			}
			
			$settlementMethod = '';
	
			$queryFixingIndexDetails = pg_query ( $cnx, "SELECT c_typeofindexprice.c_typeofindexprice_name, c_fixingindex.c_fixingindex_fixingindex, 
			c_fxingindextypes.c_fxingindextypes_name, c_fixingindex.c_fixingindex_fixingindexsources, c_fixingindex.c_fixingindex_firstfixingdate, 
			c_fixingindex.c_fixingindex_lastfixingdate, c_frequency.c_frequency_name, c_settlementmethod.c_settlementmethod_name, c_fixingindex.c_fixingindex_contract
			FROM c_settlementmethod RIGHT JOIN (c_frequency RIGHT JOIN (c_fxingindextypes RIGHT JOIN (c_typeofindexprice RIGHT JOIN c_fixingindex ON c_typeofindexprice.c_typeofindexprice_id = c_fixingindex.c_fixingindex_typeofindexprice) ON c_fxingindextypes.c_fxingindextypes_id = c_fixingindex.c_fixingindex_fixingindextypes) ON c_frequency.c_frequency_id = c_fixingindex.c_fixingindex_fixingfrequency) ON c_settlementmethod.c_settlementmethod_id = c_fixingindex.c_fixingindex_settlementmethod
			WHERE ((c_fixingindex.c_fixingindex_contract=".$contract."));	
			" );
			while ( $rowFixingIndexDetails = pg_fetch_row ( $queryFixingIndexDetails ) ) // tant que c'est pas la fin de la table
			{
				$typeOfIndexPrice = $rowFixingIndexDetails[0];
				$fixingIndex = $rowFixingIndexDetails[1];
				$fixingIndexTypes = $rowFixingIndexDetails[2];
				$fixingIndexSources = $rowFixingIndexDetails[3];
				$fixingIndexFirstFixingDate = $rowFixingIndexDetails[4];
				$fixingIndexLastFixingDate = $rowFixingIndexDetails[5];
				$fixingIndexFrequency = $rowFixingIndexDetails[6];
				$settlementMethod = $rowFixingIndexDetails[7];
				
				if (!empty($fixingIndex) && $fixingIndex <> 'null')
				{
				//on genere la suite du XML avec toujours les memes balises
				$result2 = $dom->createElement('fixingIndexDetails');
				$result->appendChild($result2);
				$result2->appendChild( $dom->createElement('fixingIndex', $fixingIndex) );
				$result2->appendChild( $dom->createElement('fixingIndexType', $fixingIndexTypes) );
				$result2->appendChild( $dom->createElement('fixingIndexSource', $fixingIndexSources) );
				}
				
			}
			//if (!empty($settlementMethod) && $settlementMethod <> 'null')
			//{
				$result->appendChild( $dom->createElement('settlementMethod', $settlementMethod) );
			//}
			
			$queryOptionDetails = pg_query ( $cnx, "SELECT c_optionstyle.c_optionstyle_name, c_optiontype.c_optiontype_name, c_option.c_option_firstexercisedate, 
			c_option.c_option_lastexercisedate, c_frequency.c_frequency_name, c_option.c_option_strikeindex, c_optionstrikeindextype.c_optionstrikeindextype_name, 
			c_option.c_option_strikeindexsource, c_option.c_option_strikeprice, c_option.c_option_contract
			FROM c_optionstrikeindextype RIGHT JOIN (c_frequency RIGHT JOIN (c_optiontype RIGHT JOIN (c_optionstyle RIGHT JOIN c_option ON c_optionstyle.c_optionstyle_id = c_option.c_option_style) ON c_optiontype.c_optiontype_id = c_option.c_option_type) ON c_frequency.c_frequency_id = c_option.c_option_exercisefrequency) ON c_optionstrikeindextype.c_optionstrikeindextype_id = c_option.c_option_strikeindextype
			WHERE ((c_option.c_option_contract=".$contract."));
			" );
			while ( $rowOptionDetails = pg_fetch_row ( $queryOptionDetails ) ) // tant que c'est pas la fin de la table
			{
				$optionStyle = $rowOptionDetails[0];
				$optionType = $rowOptionDetails[1];
				$optionFirstExerciseDate = $rowOptionDetails[2];
				$optionLastExerciseDate = $rowOptionDetails[3];
				$optionExerciseFrequency = $rowOptionDetails[4];
				$optionStrikeIndex = $rowOptionDetails[5];
				$optionIndexType = $rowOptionDetails[6];
				$optionIndexSource = $rowOptionDetails[7];
				$optionStrikePrice = $rowOptionDetails[8];
				
				$result2 = $dom->createElement('optionDetails');
				$result->appendChild($result2);
				
				//on genere la suite du XML avec toujours les meme balises
				$result2->appendChild( $dom->createElement('optionStyle', $optionStyle) );
				$result2->appendChild( $dom->createElement('optionType', $optionType) );
				$optionFirstExerciseDate = date('Y-m-d', strtotime($optionFirstExerciseDate));
				$result2->appendChild( $dom->createElement('optionFirstExerciseDate', $optionFirstExerciseDate) );
				$optionLastExerciseDate = date('Y-m-d', strtotime($optionLastExerciseDate));
				$result2->appendChild( $dom->createElement('optionLastExerciseDate', $optionLastExerciseDate) );
				$result2->appendChild( $dom->createElement('optionStrikeIndex', $optionStrikeIndex) );
				$result2->appendChild( $dom->createElement('optionIndexType', $optionIndexType) );
				if (!empty($optionIndexSource) && $optionIndexSource <> 'null')
				{
					$result2->appendChild( $dom->createElement('optionIndexSource', $optionIndexSource) );
				}
				if (!empty($optionStrikePrice) && $optionStrikePrice <> 'null')
				{
					$result3 = $dom->createElement('optionStrikePrice');
					$result2->appendChild($result3);
					$result3->appendChild( $dom->createElement('value', $optionStrikePrice) );
					$result3->appendChild( $dom->createElement('currency', $notionalCurrency) );
				}
			}
			
			$result->appendChild( $dom->createElement('deliveryPointOrZone', $deliveryPointName) );
			$deliveryStartDate = date('Y-m-d', strtotime($deliveryStartDate));
			$result->appendChild( $dom->createElement('deliveryStartDate', $deliveryStartDate) );
			$deliveryEndDate = date('Y-m-d', strtotime($deliveryEndDate));
			$result->appendChild( $dom->createElement('deliveryEndDate', $deliveryEndDate) );
			$result->appendChild( $dom->createElement('loadType', $loadType) );
			$result->appendChild( $dom->createElement('actionType', $actionType) );
			
			echo '<xmp>'. $dom->saveXML() .'</xmp>';
			if ($actionType == 'M')
			{
				$dom->save('BACKLOADING_REMITTable2_V1_EDFDCO_V2_'.$contractXML.'_delegate'.'.xml');
			}
			else
			{
				$dom->save(date('Ymd').'_REMITTable2_V1_EDFDCO_V2_'.$contractXML.'_delegate'.'.xml');
			}
		}
	
		//on met à jour la table Execution avec la date d'envoi et le boolean envoye passe à true
		$sql = "UPDATE contract SET contract.contract_xml = TRUE, contract.contract_Date = now() WHERE ((contract.contract_id = ";
		$sql = $sql.$contractXML."))";
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;

	}
} else {
	echo "Impossible de se connecter à la base de donnees";
}

?>