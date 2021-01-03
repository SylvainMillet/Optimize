<!DOCTYPE html>
<html lang="en">
	<?php
	include 'head.php';
	require 'connect.php';
	include 'navbar_execution.php';
	?>

	<body>

	<!------------------------------------------------------------ navbar call -------------------------------------------------------------->

	<form enctype="multipart/form-data" class="well" id="formLoadXML"
		action="managementXML.php" method="POST">

		<h3>Generate XML by market participant</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Select market participant</span> <select
					id="existingMarketParticipant" name="existingMarketParticipant"
					class="form-control">
					<option value="All">All new Executions</option>
		<?php
		if ($cnx) {
			$queryMarketParticipant = pg_query ( $cnx, "SELECT * FROM e_marketparticipant ORDER BY e_marketparticipant.e_marketparticipant_name" );
			// requete
			while ( $rowMarketParticipant = pg_fetch_row ( $queryMarketParticipant ) ) // tant que c'est pas la fin de la table
{
				echo '<option value="' . $rowMarketParticipant [1] . '">' . $rowMarketParticipant [2] . ' </option>';
			}
		} else {
			echo "Impossible de se connecter à la base de donnees";
		}
		?>
				</select>
			</div>
		</div>

		<input type="submit" class="btn btn-primary pull-right"
			value="Load execution file">

	</form>

	<form class="well" id="formLoadXML" method="POST">
		
	<?php
	
	if (isset ( $_POST ["existingMarketParticipant"] )) {
		if ($cnx) {
			
			if ($_POST ["existingMarketParticipant"] == 'All') {
				$queryAll = pg_query ( $cnx, "SELECT execution.execution_id, e_parties.e_parties_marketparticipant1, e_parties.e_parties_trader, e_parties.e_parties_marketparticipant2, 
	e_parties.e_parties_reportingentity, e_parties.e_parties_beneficiary, e_tradingcapacity.e_tradingcapacity_name, e_buysellindicator.e_buysellindicator_name,
	e_initiatoraggressor.e_initiatoraggressor_name, e_order.e_order_identifier, e_ordertype.e_ordertype_name, e_ordercondition.e_ordercondition_name, 
	e_orderstatus.e_orderstatus_name, e_order.e_order_minimumexecutionvolume, e_order.e_order_pricelimit, e_order.e_order_undisclosedvolume, 
	e_orderduration.e_orderduration_name, e_contract.e_contract_identifier, e_contract.e_contract_name, e_contracttype.e_contracttype_name, 
	e_energycommodity.e_energycommodity_name, e_contract.e_contract_fixingindex, e_settlementmethod.e_settlementmethod_name, 
	e_organisedmarketplace.e_organisedmarketplace_name, e_contract.e_contract_tradinghours, e_contract.e_contract_lasttraidingdate, e_transaction.e_transaction_timestamp, 
	e_transaction.e_transaction_uniquetransactionid, e_transaction.e_transaction_linkedtransaction, e_transaction.e_transaction_linkedorder, 
	e_voicebrokered.e_voicebrokered_name, e_transaction.e_transaction_price, e_transaction.e_transaction_indexvalue, e_transaction.e_transaction_priceCurrency, 
	e_transaction.e_transaction_notionalamount, e_transaction.e_transaction_notionalcurrency, e_transaction.e_transaction_quantity, 
	e_transaction.e_transaction_totalNotionalContractQuantity, e_transaction.e_transaction_quantityunit, e_transaction.e_transaction_totalNotionalContractQuantityunit,
	e_transaction.e_transaction_terminationdate, e_optionstyle.e_optionstyle_name, e_optiontype.e_optiontype_name, e_option.e_option_exercisedate, 
	e_option.e_option_strikeprice, e_deliverypoint.e_deliverypoint_identifier, e_deliveryprofile.e_deliveryprofile_deliverystartdate, 
	e_deliveryprofile.e_deliveryprofile_deliveryenddate, e_deliveryduration.E_DeliveryDuration_Name,  e_loadtype.e_loadtype_name, e_daysoftheweek.e_daysoftheweek_name, 
	e_deliveryprofile.e_deliveryprofile_loaddeliveryintervals, e_deliveryprofile.e_deliveryprofile_deliverycapacity, e_deliveryprofile.e_deliveryprofile_quantityunit, 
	e_deliveryprofile.e_deliveryprofile_pricetimeintervalquantity, e_actiontype.e_actiontype_name
	
	FROM e_actiontype INNER JOIN (e_daysoftheweek RIGHT JOIN (e_loadtype RIGHT JOIN (e_deliveryduration RIGHT JOIN ((e_tradingcapacity RIGHT JOIN (e_initiatoraggressor RIGHT JOIN (e_buysellindicator RIGHT JOIN e_parties ON e_buysellindicator.e_buysellindicator_id = e_parties.e_parties_buysellindicator) ON e_initiatoraggressor.e_initiatoraggressor_id = e_parties.e_parties_initiatoraggressor) ON e_tradingcapacity.e_tradingcapacity_id = e_parties.e_parties_tradingcapacity) INNER JOIN ((e_ordertype RIGHT JOIN (e_orderstatus RIGHT JOIN (e_orderduration RIGHT JOIN (e_ordercondition RIGHT JOIN e_order ON e_ordercondition.e_ordercondition_id = e_order.e_order_condition) ON e_orderduration.e_orderduration_id = e_order.e_order_duration) ON e_orderstatus.e_orderstatus_id = e_order.e_order_status) ON e_ordertype.e_ordertype_id = e_order.e_order_id) RIGHT JOIN ((e_optiontype RIGHT JOIN (e_optionstyle RIGHT JOIN e_option ON e_optionstyle.e_optionstyle_id = e_option.e_option_style) ON e_optiontype.e_optiontype_id = e_option.e_option_type) RIGHT JOIN ((e_contracttype RIGHT JOIN (e_settlementmethod RIGHT JOIN (e_organisedmarketplace RIGHT JOIN (e_energycommodity RIGHT JOIN e_contract ON e_energycommodity.e_energycommodity_id = e_contract.e_contract_energycommodity) ON e_organisedmarketplace.e_organisedmarketplace_id = e_contract.e_contract_organisedmarketplace) ON e_settlementmethod.e_settlementmethod_id = e_contract.e_contract_settlementmethod) ON e_contracttype.e_contracttype_id = e_contract.e_contract_type) INNER JOIN (e_voicebrokered RIGHT JOIN ((e_deliverypoint INNER JOIN e_deliveryprofile ON e_deliverypoint.e_deliverypoint_id = e_deliveryprofile.e_deliveryprofile_deliverypoint) INNER JOIN (e_transaction INNER JOIN execution ON e_transaction.e_transaction_id = execution.execution_transaction) ON e_deliveryprofile.e_deliveryprofile_id = execution.execution_deliveryprofile) ON e_voicebrokered.e_voicebrokered_id = e_transaction.e_transaction_voicebrokered) ON e_contract.e_contract_id = execution.execution_contract) ON e_option.e_option_id = execution.execution_option) ON e_order.e_order_id = execution.execution_order) ON e_parties.e_parties_id = execution.execution_parties) ON e_deliveryduration.E_DeliveryDuration_id = e_deliveryprofile.e_deliveryprofile_duration) ON e_loadtype.e_loadtype_id = e_deliveryprofile.e_deliveryprofile_loadtype) ON e_daysoftheweek.e_daysoftheweek_id = e_deliveryprofile.e_deliveryprofile_daysoftheweek) ON e_actiontype.e_actiontype_id = execution.execution_actiontype
	WHERE (execution.execution_xml)='f'
	" );
				while ( $rowAll = pg_fetch_row ( $queryAll ) ) // tant que c'est pas la fin de la table
{
					$executionXML = $rowAll [0];
					$marketParticipant1ID = $rowAll [1];
					if (! empty ( $marketParticipant1ID )) {
						$queryMarketParticipant = pg_query ( $cnx, "SELECT e_marketparticipant.e_marketparticipant_id, e_marketparticipant.e_marketparticipant_identifier, 
			e_entitytype.e_entitytype_name
			FROM e_entitytype INNER JOIN e_marketparticipant ON e_entitytype.e_entitytype_id = e_marketparticipant.e_marketparticipant_type
			WHERE (((e_marketparticipant.e_marketparticipant_id)=" . $marketParticipant1ID . "));
			" );
						while ( $rowMarketParticipant = pg_fetch_row ( $queryMarketParticipant ) ) // tant que c'est pas la fin de la table
{
							$marketParticipant1ID = $rowMarketParticipant [1];
							$marketParticipant1Type = strtolower ( $rowMarketParticipant [2] );
						}
					}
					$traderID = $rowAll [2];
					if (! empty ( $traderID )) {
						$queryTrader = pg_query ( $cnx, "SELECT e_trader.e_trader_identifier, e_trader.e_trader_name, 
			e_entitytype.e_entitytype_name
			FROM e_entitytype INNER JOIN e_trader ON e_entitytype.e_entitytype_id = e_trader.e_trader_Type
			WHERE (((e_trader.e_trader_id)=" . $traderID . "));
			" );
						while ( $rowTrader = pg_fetch_row ( $queryTrader ) ) // tant que c'est pas la fin de la table
{
							$traderID = $rowTrader [0];
							$traderName = strtolower ( $rowTrader [1] );
						}
					}
					
					$marketParticipant2ID = $rowAll [3];
					if (! empty ( $marketParticipant2ID )) {
						$queryMarketParticipant2 = pg_query ( $cnx, "SELECT e_marketparticipant.e_marketparticipant_id, e_marketparticipant.e_marketparticipant_identifier, e_marketparticipant.e_marketparticipant_name, e_marketparticipant.e_marketparticipant_delegate, e_entitytype.e_entitytype_name
			FROM e_entitytype INNER JOIN e_marketparticipant ON e_entitytype.e_entitytype_id = e_marketparticipant.e_marketparticipant_type
			WHERE (((e_marketparticipant.e_marketparticipant_id)=" . $marketParticipant2ID . "));
			" );
						while ( $rowMarketParticipant2 = pg_fetch_row ( $queryMarketParticipant2 ) ) // tant que c'est pas la fin de la table
{
							$marketParticipant2ID = $rowMarketParticipant2 [1];
							$marketParticipant2Name = $rowMarketParticipant2 [2];
							$delegateReporting = ($rowMarketParticipant2 [3] === 't' ? true : false);
							$marketParticipant2Type = strtolower ( $rowMarketParticipant2 [4] );
						}
					}
					$reportingEntityID = $rowAll [4];
					if (! empty ( $reportingEntityID )) {
						$queryReportingEntity = pg_query ( $cnx, "SELECT e_reportingentity.e_reportingentity_id, e_reportingentity.e_reportingentity_identifier, 
			e_entitytype.e_entitytype_name
			FROM e_entitytype INNER JOIN e_reportingentity ON e_entitytype.e_entitytype_id = e_reportingentity.e_reportingentity_type
			WHERE (((e_reportingentity.e_reportingentity_id)=" . $reportingEntityID . "));
			" );
						while ( $rowReportingEntity = pg_fetch_row ( $queryReportingEntity ) ) // tant que c'est pas la fin de la table
{
							$reportingEntityID = $rowReportingEntity [1];
							$reportingEntityType = strtolower ( $rowReportingEntity [2] );
						}
					}
					$beneficiaryID = $rowAll [5];
					if (! empty ( $beneficiaryID )) {
						$queryBeneficiary = pg_query ( $cnx, "SELECT e_beneficiary.e_beneficiary_id, e_beneficiary.e_beneficiary_identifier, e_entitytype.e_entitytype_name
			FROM e_entitytype INNER JOIN e_beneficiary ON e_entitytype.e_entitytype_id = e_beneficiary.e_beneficiary_type
			WHERE (((e_beneficiary.e_beneficiary_id)=" . $beneficiaryID . "));
			" );
						while ( $rowBeneficiary = pg_fetch_row ( $queryBeneficiary ) ) // tant que c'est pas la fin de la table
{
							$beneficiaryID = $rowBeneficiary [1];
							$beneficiaryType = strtolower ( $rowBeneficiary [2] );
						}
					}
					$tradingCapacity = $rowAll [6];
					$buySellIndicator = $rowAll [7];
					$initiatorAggressor = $rowAll [8];
					$orderID = $rowAll [9];
					$orderType = strtolower ( $rowAll [10] );
					$orderCondition = $rowAll [11];
					$orderStatus = $rowAll [12];
					$minimumExecutionVolume = $rowAll [13];
					$priceLimit = $rowAll [14];
					$undisclosedVolume = $rowAll [15];
					$orderDuration = $rowAll [16];
					$contractID = $rowAll [17];
					$contractName = $rowAll [18];
					$contractType = $rowAll [19];
					$energyCommodity = $rowAll [20];
					$fixingIndex = $rowAll [21];
					$settlementMethod = $rowAll [22];
					$organisedMarketPlace = $rowAll [23];
					$tradingHours = $rowAll [24];
					$lastTraidingDate = $rowAll [25];
					$lastTraidingTime = $rowAll [25];
					$transactionTimestampDate = $rowAll [26];
					$uniqueTransactionID = $rowAll [27];
					$linkedTransactionID = $rowAll [28];
					$linkedOrderID = $rowAll [29];
					$voicebrokered = $rowAll [30];
					$price = ( float ) $rowAll [31];
					$indexValue = $rowAll [32];
					$priceCurrency = $rowAll [33];
					if (! empty ( $priceCurrency )) {
						$queryPriceCurrency = pg_query ( $cnx, "SELECT e_currency.e_currency_id, e_currency.e_currency_name
			FROM e_currency
			WHERE (((e_currency.e_currency_id)=" . $priceCurrency . "));
			" );
						while ( $rowPriceCurrency = pg_fetch_row ( $queryPriceCurrency ) ) // tant que c'est pas la fin de la table
{
							$priceCurrency = $rowPriceCurrency [1];
						}
					}
					$notionalAmount = $rowAll [34];
					$notionalCurrency = $rowAll [35];
					if (! empty ( $notionalCurrency )) {
						$queryNotionalCurrency = pg_query ( $cnx, "SELECT e_currency.e_currency_id, e_currency.e_currency_name
			FROM e_currency
			WHERE (((e_currency.e_currency_id)=" . $notionalCurrency . "));
			" );
						while ( $rowNotionalCurrency = pg_fetch_row ( $queryNotionalCurrency ) ) // tant que c'est pas la fin de la table
{
							$notionalCurrency = $rowNotionalCurrency [1];
						}
					}
					$quantity = $rowAll [36];
					$totalNotionalContractQuantity = $rowAll [37];
					$quantityUnit = $rowAll [38];
					if (! empty ( $quantityUnit )) {
						$queryQuantityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
			FROM e_quantityunit
			WHERE (((e_quantityunit.e_quantityunit_id)=" . $quantityUnit . "));
			" );
						while ( $rowQuantityUnit = pg_fetch_row ( $queryQuantityUnit ) ) // tant que c'est pas la fin de la table
{
							$quantityUnit = $rowQuantityUnit [1];
						}
					}
					$totalNotionalContractQuantityUnit = $rowAll [39];
					if (! empty ( $totalNotionalContractQuantityUnit )) {
						$querytotalNotionalContractQuantityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
			FROM e_quantityunit
			WHERE (((e_quantityunit.e_quantityunit_id)=" . $totalNotionalContractQuantityUnit . "));
			" );
						while ( $rowtotalNotionalContractQuantityUnit = pg_fetch_row ( $querytotalNotionalContractQuantityUnit ) ) // tant que c'est pas la fin de la table
{
							$totalNotionalContractQuantityUnit = $rowtotalNotionalContractQuantityUnit [1];
						}
					}
					$terminationDate = $rowAll [40];
					$optionStyle = $rowAll [41];
					$optionType = $rowAll [42];
					$exerciseDate = $rowAll [43];
					$strikePrice = $rowAll [44];
					$deliveryPointName = $rowAll [45];
					$deliveryStartDate = $rowAll [46];
					$deliveryEndDate = $rowAll [47];
					$duration = $rowAll [48];
					$loadType = $rowAll [49];
					$daysOfTheWeek = $rowAll [50];
					$loadDeliveryIntervals = $rowAll [51];
					$deliveryCapacity = $rowAll [52];
					$deliveryCapacityUnit = $rowAll [53];
					if (! empty ( $deliveryCapacityUnit )) {
						$queryDeliveryCapacityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
			FROM e_quantityunit
			WHERE (((e_quantityunit.e_quantityunit_id)=" . $deliveryCapacityUnit . "));
			" );
						while ( $rowDeliveryCapacityUnit = pg_fetch_row ( $queryDeliveryCapacityUnit ) ) // tant que c'est pas la fin de la table
{
							$deliveryCapacityUnit = $rowDeliveryCapacityUnit [1];
						}
					}
					$priceTimeIntervalsQuantity = $rowAll [54];
					$actionType = $rowAll [55];
					
					// on genere le xml avec toutes les variables recuperees
					
					$dom = new DOMDocument ( '1.0', 'utf-8' );
					$dom->encoding = "utf-8";
					$dom->formatOutput = true;
					
					$root = $dom->createElement ( 'REMITTable1' );
					$root->setAttribute ( 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance' );
					$root->setAttribute ( 'xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable1_V2.xsd' );
					$dom->appendChild ( $root );
					
					// reporting entity
					$reportingEntity = $dom->createElement ( 'reportingEntityID' );
					$root->appendChild ( $reportingEntity );
					$reportingEntity->appendChild ( $dom->createElement ( $reportingEntityType, $reportingEntityID ) );
					// fin reporting entity
					
					// contract
					$contractXML = $dom->createElement ( 'contractList' );
					$root->appendChild ( $contractXML );
					
					$result = $dom->createElement ( 'contract' );
					$contractXML->appendChild ( $result );
					
					if (! empty ( $contractID )) {
						$result->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
					}
					if (! empty ( $contractName )) {
						$result->appendChild ( $dom->createElement ( 'contractName', $contractName ) );
					}
					if (! empty ( $contractType )) {
						$result->appendChild ( $dom->createElement ( 'contractType', $contractType ) );
					}
					if (! empty ( $energyCommodity )) {
						$result->appendChild ( $dom->createElement ( 'energyCommodity', $energyCommodity ) );
					}
					
					$result2 = $dom->createElement ( 'fixingIndex' );
					$result->appendChild ( $result2 );
					if (empty ( $fixingIndex )) {
						$fixingIndex = 'null';
					}
					$result2->appendChild ( $dom->createElement ( 'indexName', $fixingIndex ) );
					
					if (! empty ( $settlementMethod )) {
						$result->appendChild ( $dom->createElement ( 'settlementMethod', $settlementMethod ) );
					}
					
					$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
					$result->appendChild ( $result2 );
					
					if (! empty ( $organisedMarketPlace )) {
						$result2->appendChild ( $dom->createElement ( 'mic', $organisedMarketPlace ) );
					}
					
					if (! empty ( $tradingHours ) && $tradingHours != 'null') {
						$result2 = $dom->createElement ( 'contractTradingHours' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'startTime', substr ( $tradingHours, 0, 8 ) ) );
						$result2->appendChild ( $dom->createElement ( 'endTime', substr ( $tradingHours, 9, 17 ) ) );
					}
					if (! empty ( $lastTraidingDate ) && $lastTraidingDate != 'null') {
						$dateFormated = $lastTraidingDate . ' ' . $lastTraidingTime;
						$lastTraidingDateTime = date ( 'c', strtotime ( $dateFormated ) );
						$result->appendChild ( $dom->createElement ( 'lastTradingDateTime', $lastTraidingDateTime ) );
					}
					
					if (! empty ( $optionStyle )) {
						$result2 = $dom->createElement ( 'optionDetails' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'optionStyle', $optionStyle ) );
					}
					if (! empty ( $optionType )) {
						$result2->appendChild ( $dom->createElement ( 'optionType', $optionType ) );
					}
					if (! empty ( $exerciseDate )) {
						$exerciseDate = date ( 'c', strtotime ( $exerciseDate ) );
						$result2->appendChild ( $dom->createElement ( 'optionExerciseDate', $exerciseDate ) );
					}
					if (! empty ( $strikePrice )) {
						$result2 = $dom->createElement ( 'optionStrikePrice' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $strikePrice ) );
					}
					
					if (! empty ( $deliveryPointName ) && $deliveryPointName != 'null') {
						$result->appendChild ( $dom->createElement ( 'deliveryPointOrZone', $deliveryPointName ) );
					}
					if (! empty ( $deliveryStartDate ) && $deliveryStartDate != 'null') {
						// $exerciseDate = date('c', strtotime($exerciseDate));
						$result->appendChild ( $dom->createElement ( 'deliveryStartDate', date ( 'Y-m-d', strtotime ( $deliveryStartDate ) ) ) );
					}
					if (! empty ( $deliveryEndDate ) && $deliveryEndDate != 'null') {
						$result->appendChild ( $dom->createElement ( 'deliveryEndDate', date ( 'Y-m-d', strtotime ( $deliveryEndDate ) ) ) );
					}
					if (! empty ( $duration ) && $duration != 'null') {
						$result->appendChild ( $dom->createElement ( 'duration', $duration ) );
					}
					if (! empty ( $loadType ) && $loadType != 'null') {
						$result->appendChild ( $dom->createElement ( 'loadType', $loadType ) );
					}
					
					$result2 = $dom->createElement ( 'deliveryProfile' );
					$result->appendChild ( $result2 );
					$result2->appendChild ( $dom->createElement ( 'daysOfTheWeek', $daysOfTheWeek ) );
					
					$loadDeliveryStartTime = substr ( $loadDeliveryIntervals, 0, 8 );
					$result2->appendChild ( $dom->createElement ( 'loadDeliveryStartTime', $loadDeliveryStartTime ) );
					
					$loadDeliveryEndTime = substr ( $loadDeliveryIntervals, -8 );
					$result2->appendChild ( $dom->createElement ( 'loadDeliveryEndTime', $loadDeliveryEndTime ) );
					// fin contract
					
					// trade
					$tradeXML = $dom->createElement ( 'TradeList' );
					$root->appendChild ( $tradeXML );
					
					$result = $dom->createElement ( 'TradeReport' );
					$tradeXML->appendChild ( $result );
					
					$result->appendChild ( $dom->createElement ( 'RecordSeqNumber', $executionXML ) );
					
					$result2 = $dom->createElement ( 'idOfMarketParticipant' );
					$result->appendChild ( $result2 );
					$result2->appendChild ( $dom->createElement ( $marketParticipant1Type, $marketParticipant1ID ) );
					
					$result2 = $dom->createElement ( 'traderID' );
					$result->appendChild ( $result2 );
					if (empty ( $traderID ) || $traderID != 'null') {
						$traderName = 'EDFDCO';
					}
					$result2->appendChild ( $dom->createElement ( 'traderIdForOrganisedMarket', $traderName ) );
					
					if (! empty ( $marketParticipant2ID ) && $marketParticipant2ID != 'null') {
						$result2 = $dom->createElement ( 'otherMarketParticipant' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $marketParticipant2Type, $marketParticipant2ID ) );
					}
					
					if (! empty ( $beneficiaryID )) {
						$result2 = $dom->createElement ( 'beneficiaryIdentification' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $beneficiaryType, $beneficiaryID ) );
					}
					
					$result->appendChild ( $dom->createElement ( 'tradingCapacity', $tradingCapacity ) );
					
					if (! empty ( $buySellIndicator )) {
						$result->appendChild ( $dom->createElement ( 'buySellIndicator', $buySellIndicator ) );
					}
					if (! empty ( $initiatorAggressor )) {
						$result->appendChild ( $dom->createElement ( 'aggressor', $initiatorAggressor ) );
					}
					
					if (! empty ( $priceLimit )) {
						$result3 = $dom->createElement ( 'triggerDetails' );
						$result2->appendChild ( $result3 );
						
						$result4 = $dom->createElement ( 'priceLimit' );
						$result3->appendChild ( $result4 );
						$result4->appendChild ( $dom->createElement ( 'value', $priceLimit ) );
					}
					
					if (! empty ( $undisclosedVolume )) {
						$result2->appendChild ( $dom->createElement ( 'undisclosedVolume', $undisclosedVolume ) );
					}
					if (! empty ( $orderDuration )) {
						$result2->appendChild ( $dom->createElement ( 'orderDuration', $orderDuration ) );
					}
					
					$result2 = $dom->createElement ( 'contractInfo' );
					$result->appendChild ( $result2 );
					if (! empty ( $contractID )) {
						$result2->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
					}
					
					$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
					$result->appendChild ( $result2 );
					if (! empty ( $organisedMarketPlace )) {
						$result2->appendChild ( $dom->createElement ( 'bil', $organisedMarketPlace ) );
					}
					
					if (! empty ( $transactionTimestampDate )) {
						$transactionTimestampDate = date ( 'c', strtotime ( $transactionTimestampDate ) );
						$result->appendChild ( $dom->createElement ( 'transactionTime', $transactionTimestampDate ) );
					}
					$result2 = $dom->createElement ( 'uniqueTransactionIdentifier' );
					$result->appendChild ( $result2 );
					if (! empty ( $uniqueTransactionID )) {
						$result2->appendChild ( $dom->createElement ( 'uniqueTransactionIdentifier', $uniqueTransactionID ) );
					}
					if (! empty ( $linkedTransactionID )) {
						$result->appendChild ( $dom->createElement ( 'linkedTransactionId', $linkedTransactionID ) );
					}
					if (! empty ( $linkedOrderID )) {
						$result->appendChild ( $dom->createElement ( 'linkedOrderId', $linkedOrderID ) );
					}
					if (! empty ( $voicebrokered )) {
						$result->appendChild ( $dom->createElement ( 'voiceBrokered', $voicebrokered ) );
					}
					$result2 = $dom->createElement ( 'priceDetails' );
					$result->appendChild ( $result2 );
					if (! empty ( $price )) {
						$result2->appendChild ( $dom->createElement ( 'price', $price ) );
						if ($price < 0) {
							echo ("Alerte, le montant de la déclaration " . $executionXML . " est négatif.");
						}
					}
					if (! empty ( $indexValue )) {
						$result2->appendChild ( $dom->createElement ( 'indexValue', $indexValue ) );
					}
					if (! empty ( $priceCurrency )) {
						$result2->appendChild ( $dom->createElement ( 'priceCurrency', $priceCurrency ) );
					}
					$result2 = $dom->createElement ( 'notionalAmountDetails' );
					$result->appendChild ( $result2 );
					if (! empty ( $notionalAmount )) {
						$result2->appendChild ( $dom->createElement ( 'notionalAmount', $notionalAmount ) );
					}
					if (! empty ( $notionalCurrency )) {
						$result2->appendChild ( $dom->createElement ( 'notionalCurrency', $notionalCurrency ) );
					}
					if (! empty ( $quantity )) {
						$result2 = $dom->createElement ( 'quantity' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $quantity ) );
					}
					if (! empty ( $quantityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $quantityUnit ) );
					}
					if (! empty ( $totalNotionalContractQuantity )) {
						$result2 = $dom->createElement ( 'totalNotionalContractQuantity' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $totalNotionalContractQuantity ) );
					}
					if (! empty ( $totalNotionalContractQuantityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $totalNotionalContractQuantityUnit ) );
					}
					if (! empty ( $terminationDate )) {
						$result->appendChild ( $dom->createElement ( 'terminationDate', $terminationDate ) );
					}
					if (! empty ( $deliveryCapacity )) {
						$result2 = $dom->createElement ( 'priceIntervalQuantityDetails' );
						$result->appendChild ( $result2 );
						
						$result2->appendChild ( $dom->createElement ( 'quantity', $deliveryCapacity ) );
					}
					if (! empty ( $deliveryCapacityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $deliveryCapacityUnit ) );
					}
					if (! empty ( $priceTimeIntervalsQuantity )) {
						$result3 = $dom->createElement ( 'priceTimeIntervalQuantity' );
						$result2->appendChild ( $result3 );
						$result3->appendChild ( $dom->createElement ( 'value', $priceTimeIntervalsQuantity ) );
					}
					if (! empty ( $actionType )) {
						$result->appendChild ( $dom->createElement ( 'actionType', $actionType ) );
					}
					// fin trade
					
					echo '<xmp>' . $dom->saveXML () . '</xmp>';
					
					// if ($actionType == 'M')
					// {
					// $dom->save('BACKLOADING_REMITTable1_V2_EDFDCO_'.$executionXML.'_'.$marketParticipant2Name.'.xml') or die('XML Create Error');
					// }
					// else
					// {
					$dom->save ( date ( 'Ymd' ) . '_REMITTable1_V2_EDFDCO_' . $executionXML . '_' . $marketParticipant2Name . '.xml' ) or die ( 'XML Create Error' );
					// }
					
					// si le reporting delegate est true on change les valeurs marketparticipant et seller et trader
					if ($delegateReporting == true) {
						// on genere le xml avec toutes les variables recuperees
						$dom = new DOMDocument ( '1.0', 'utf-8' );
						$dom->encoding = "utf-8";
						$dom->formatOutput = true;
						
						$root = $dom->createElement ( 'REMITTable1' );
						$root->setAttribute ( 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance' );
						$root->setAttribute ( 'xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable1_V2.xsd' );
						$dom->appendChild ( $root );
						
						// reporting entity
						$reportingEntity = $dom->createElement ( 'reportingEntityID' );
						$root->appendChild ( $reportingEntity );
						$reportingEntity->appendChild ( $dom->createElement ( $reportingEntityType, $reportingEntityID ) );
						// fin reporting entity
						
						// contract
						$contractXML = $dom->createElement ( 'contractList' );
						$root->appendChild ( $contractXML );
						
						$result = $dom->createElement ( 'contract' );
						$contractXML->appendChild ( $result );
						
						if (! empty ( $contractID )) {
							$result->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
						}
						if (! empty ( $contractName )) {
							$result->appendChild ( $dom->createElement ( 'contractName', $contractName ) );
						}
						if (! empty ( $contractType )) {
							$result->appendChild ( $dom->createElement ( 'contractType', $contractType ) );
						}
						if (! empty ( $energyCommodity )) {
							$result->appendChild ( $dom->createElement ( 'energyCommodity', $energyCommodity ) );
						}
						
						$result2 = $dom->createElement ( 'fixingIndex' );
						$result->appendChild ( $result2 );
						if (! empty ( $fixingIndex )) {
							$result2->appendChild ( $dom->createElement ( 'indexName', $fixingIndex ) );
						}
						
						if (! empty ( $settlementMethod )) {
							$result->appendChild ( $dom->createElement ( 'settlementMethod', $settlementMethod ) );
						}
						
						$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
						$result->appendChild ( $result2 );
						
						if (! empty ( $organisedMarketPlace )) {
							$result2->appendChild ( $dom->createElement ( 'mic', $organisedMarketPlace ) );
						}
						
						if (! empty ( $tradingHours ) && $tradingHours != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryStartDate', substr ( $deliveryStartDate, 0, 10 ) ) );
							$result2 = $dom->createElement ( 'contractTradingHours' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'startTime', substr ( $tradingHours, 0, 8 ) ) );
							$result2->appendChild ( $dom->createElement ( 'endTime', substr ( $tradingHours, 9, 17 ) ) );
						}
						if (! empty ( $lastTraidingDate ) && $lastTraidingDate != 'null') {
							$dateFormated = $lastTraidingDate . ' ' . $lastTraidingTime;
							$lastTraidingDateTime = date ( 'c', strtotime ( $dateFormated ) );
							$result->appendChild ( $dom->createElement ( 'lastTradingDateTime', $lastTraidingDateTime ) );
						}
						
						if (! empty ( $optionStyle )) {
							$result2 = $dom->createElement ( 'optionDetails' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'optionStyle', $optionStyle ) );
						}
						if (! empty ( $optionType )) {
							$result2->appendChild ( $dom->createElement ( 'optionType', $optionType ) );
						}
						if (! empty ( $exerciseDate )) {
							$exerciseDate = date ( 'c', strtotime ( $exerciseDate ) );
							$result2->appendChild ( $dom->createElement ( 'optionExerciseDate', $exerciseDate ) );
						}
						if (! empty ( $strikePrice )) {
							$result2 = $dom->createElement ( 'optionStrikePrice' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $strikePrice ) );
						}
						
						if (! empty ( $deliveryPointName ) && $deliveryPointName != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryPointOrZone', $deliveryPointName ) );
						}
						if (! empty ( $deliveryStartDate ) && $deliveryStartDate != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryStartDate', substr ( $deliveryStartDate, 0, 10 ) ) );
						}
						if (! empty ( $deliveryEndDate ) && $deliveryEndDate != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryEndDate', substr ( $deliveryEndDate, 0, 10 ) ) );
						}
						if (! empty ( $duration ) && $duration != 'null') {
							$result->appendChild ( $dom->createElement ( 'duration', $duration ) );
						}
						if (! empty ( $loadType ) && $loadType != 'null') {
							$result->appendChild ( $dom->createElement ( 'loadType', $loadType ) );
						}
						
						$result2 = $dom->createElement ( 'deliveryProfile' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'daysOfTheWeek', $daysOfTheWeek ) );
						
						$loadDeliveryStartTime = substr ( $loadDeliveryIntervals, 0, 8 );
						$result2->appendChild ( $dom->createElement ( 'loadDeliveryStartTime', $loadDeliveryStartTime ) );
						
						$loadDeliveryEndTime = substr ( $loadDeliveryIntervals, -8 );
						$result2->appendChild ( $dom->createElement ( 'loadDeliveryEndTime', $loadDeliveryEndTime ) );
						// fin contract
						
						// trade
						$tradeXML = $dom->createElement ( 'TradeList' );
						$root->appendChild ( $tradeXML );
						
						$result = $dom->createElement ( 'TradeReport' );
						$tradeXML->appendChild ( $result );
						
						$result->appendChild ( $dom->createElement ( 'RecordSeqNumber', $executionXML ) );
						
						$result2 = $dom->createElement ( 'idOfMarketParticipant' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $marketParticipant2Type, $marketParticipant2ID ) );
						
						$result2 = $dom->createElement ( 'traderID' );
						$result->appendChild ( $result2 );
						
						if (empty ( $traderName ) || $traderName != 'null') {
							$traderName = $marketParticipant2Name;
						}
						$result2->appendChild ( $dom->createElement ( 'traderIdForOrganisedMarket', $traderName ) );
						
						if (! empty ( $marketParticipant1ID ) && $marketParticipant1ID != 'null') {
							$result2 = $dom->createElement ( 'otherMarketParticipant' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( $marketParticipant1Type, $marketParticipant1ID ) );
						}
						
						if (! empty ( $beneficiaryID )) {
							$result2 = $dom->createElement ( 'beneficiaryIdentification' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( $beneficiaryType, $beneficiaryID ) );
						}
						
						$result->appendChild ( $dom->createElement ( 'tradingCapacity', $tradingCapacity ) );
						
						if (! empty ( $buySellIndicator )) {
							$result->appendChild ( $dom->createElement ( 'buySellIndicator', 'B' ) );
						}
						if (! empty ( $initiatorAggressor )) {
							$result->appendChild ( $dom->createElement ( 'aggressor', $initiatorAggressor ) );
						}
						
						if (! empty ( $priceLimit )) {
							$result3 = $dom->createElement ( 'triggerDetails' );
							$result2->appendChild ( $result3 );
							
							$result4 = $dom->createElement ( 'priceLimit' );
							$result3->appendChild ( $result4 );
							$result4->appendChild ( $dom->createElement ( 'value', $priceLimit ) );
						}
						
						if (! empty ( $undisclosedVolume )) {
							$result2->appendChild ( $dom->createElement ( 'undisclosedVolume', $undisclosedVolume ) );
						}
						if (! empty ( $orderDuration )) {
							$result2->appendChild ( $dom->createElement ( 'orderDuration', $orderDuration ) );
						}
						
						$result2 = $dom->createElement ( 'contractInfo' );
						$result->appendChild ( $result2 );
						if (! empty ( $contractID )) {
							$result2->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
						}
						
						$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
						$result->appendChild ( $result2 );
						if (! empty ( $organisedMarketPlace )) {
							$result2->appendChild ( $dom->createElement ( 'bil', $organisedMarketPlace ) );
						}
						
						if (! empty ( $transactionTimestampDate )) {
							$transactionTimestampDate = date ( 'c', strtotime ( $transactionTimestampDate ) );
							$result->appendChild ( $dom->createElement ( 'transactionTime', $transactionTimestampDate ) );
						}
						$result2 = $dom->createElement ( 'uniqueTransactionIdentifier' );
						$result->appendChild ( $result2 );
						if (! empty ( $uniqueTransactionID )) {
							$result2->appendChild ( $dom->createElement ( 'uniqueTransactionIdentifier', $uniqueTransactionID ) );
						}
						if (! empty ( $linkedTransactionID )) {
							$result->appendChild ( $dom->createElement ( 'linkedTransactionId', $linkedTransactionID ) );
						}
						if (! empty ( $linkedOrderID )) {
							$result->appendChild ( $dom->createElement ( 'linkedOrderId', $linkedOrderID ) );
						}
						if (! empty ( $voicebrokered )) {
							$result->appendChild ( $dom->createElement ( 'voiceBrokered', $voicebrokered ) );
						}
						$result2 = $dom->createElement ( 'priceDetails' );
						$result->appendChild ( $result2 );
						if (! empty ( $price )) {
							$result2->appendChild ( $dom->createElement ( 'price', $price ) );
						}
						if (! empty ( $indexValue )) {
							$result2->appendChild ( $dom->createElement ( 'indexValue', $indexValue ) );
						}
						if (! empty ( $priceCurrency )) {
							$result2->appendChild ( $dom->createElement ( 'priceCurrency', $priceCurrency ) );
						}
						$result2 = $dom->createElement ( 'notionalAmountDetails' );
						$result->appendChild ( $result2 );
						if (! empty ( $notionalAmount )) {
							$result2->appendChild ( $dom->createElement ( 'notionalAmount', $notionalAmount ) );
						}
						if (! empty ( $notionalCurrency )) {
							$result2->appendChild ( $dom->createElement ( 'notionalCurrency', $notionalCurrency ) );
						}
						if (! empty ( $quantity )) {
							$result2 = $dom->createElement ( 'quantity' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $quantity ) );
						}
						if (! empty ( $quantityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $quantityUnit ) );
						}
						if (! empty ( $totalNotionalContractQuantity )) {
							$result2 = $dom->createElement ( 'totalNotionalContractQuantity' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $totalNotionalContractQuantity ) );
						}
						if (! empty ( $totalNotionalContractQuantityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $totalNotionalContractQuantityUnit ) );
						}
						if (! empty ( $terminationDate )) {
							$result->appendChild ( $dom->createElement ( 'terminationDate', $terminationDate ) );
						}
						if (! empty ( $deliveryCapacity )) {
							$result2 = $dom->createElement ( 'priceIntervalQuantityDetails' );
							$result->appendChild ( $result2 );
							
							$result2->appendChild ( $dom->createElement ( 'quantity', $deliveryCapacity ) );
						}
						if (! empty ( $deliveryCapacityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $deliveryCapacityUnit ) );
						}
						if (! empty ( $priceTimeIntervalsQuantity )) {
							$result3 = $dom->createElement ( 'priceTimeIntervalQuantity' );
							$result2->appendChild ( $result3 );
							$result3->appendChild ( $dom->createElement ( 'value', $priceTimeIntervalsQuantity ) );
						}
						if (! empty ( $actionType )) {
							$result->appendChild ( $dom->createElement ( 'actionType', $actionType ) );
						}
						// fin trade
						
						echo '<xmp>' . $dom->saveXML () . '</xmp>';
						// if ($actionType == 'M')
						// {
						// $dom->save('BACKLOADING_REMITTable1_V2_EDFDCO_'.$executionXML.'_delegate_'.$marketParticipant2Name.'.xml');
						// }
						// else
						// {
						$dom->save ( date ( 'Ymd' ) . '_REMITTable1_V2_EDFDCO_' . $executionXML . '_delegate_' . $marketParticipant2Name . '.xml' );
						// }
					}
					echo '<xmp>' . $dom->saveXML () . '</xmp>';
					
					// on met à jour la table Execution avec la date d'envoi et le boolean envoye passe à true
					$sql = "UPDATE execution SET execution_xml = TRUE, execution_date = now() WHERE (((execution_id) =" . $executionXML . "))";
					$sql2 = pg_query ( $cnx, $sql ) or die ( pg_last_error () );
					
					// $file = 'somefile.txt';
					// $remote_file = 'readme.txt';
					
					// envoi du XML par FTP
					// Mise en place d'une connexion basique
					// $conn_id = ftp_connect($ftp_server);
					
					// Identification avec un nom d'utilisateur et un mot de passe
					// $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
					
					// Charge un fichier
					// if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
					// echo "Le fichier $file a àte charge avec succes\n";
					// } else {
					// echo "Il y a eu un probleme lors du chargement du fichier $file\n";
					// }
					
					// Fermeture de la connexion
					// ftp_close($conn_id);
				}
			} else {
				$query = pg_query ( $cnx, "SELECT execution.execution_id, e_parties.e_parties_marketparticipant1, e_parties.e_parties_trader, e_parties.e_parties_marketparticipant2, e_parties.e_parties_reportingentity, e_parties.e_parties_beneficiary, e_tradingcapacity.e_tradingcapacity_name, e_buysellindicator.e_buysellindicator_name, e_initiatoraggressor.e_initiatoraggressor_name, e_order.e_order_identifier, e_ordertype.e_ordertype_name, e_ordercondition.e_ordercondition_name, e_orderstatus.e_orderstatus_name, e_order.e_order_minimumexecutionvolume, e_order.e_order_pricelimit, e_order.e_order_undisclosedvolume, e_orderduration.e_orderduration_name, e_contract.e_contract_identifier, e_contract.e_contract_name, e_contracttype.e_contracttype_name, e_energycommodity.e_energycommodity_name, e_contract.e_contract_fixingindex, e_settlementmethod.e_settlementmethod_name, e_organisedmarketplace.e_organisedmarketplace_name, e_contract.e_contract_tradinghours, e_contract.e_contract_lasttraidingdate, e_transaction.e_transaction_timestamp, e_transaction.e_transaction_uniquetransactionid, e_transaction.e_transaction_linkedtransaction, e_transaction.e_transaction_linkedorder, e_voicebrokered.e_voicebrokered_name, e_transaction.e_transaction_price, e_transaction.e_transaction_indexvalue, e_transaction.e_transaction_priceCurrency, e_transaction.e_transaction_notionalamount, e_transaction.e_transaction_notionalcurrency, e_transaction.e_transaction_quantity, e_transaction.e_transaction_totalNotionalContractQuantity, e_transaction.e_transaction_quantityunit, e_transaction.e_transaction_totalNotionalContractQuantityunit, e_transaction.e_transaction_terminationdate, e_optionstyle.e_optionstyle_name, e_optiontype.e_optiontype_name, e_option.e_option_exercisedate, e_option.e_option_strikeprice, e_deliverypoint.e_deliverypoint_identifier, e_deliveryprofile.e_deliveryprofile_deliverystartdate, e_deliveryprofile.e_deliveryprofile_deliveryenddate, e_deliveryduration.E_DeliveryDuration_Name, e_loadtype.e_loadtype_name, e_daysoftheweek.e_daysoftheweek_name, e_deliveryprofile.e_deliveryprofile_loaddeliveryintervals, e_deliveryprofile.e_deliveryprofile_deliverycapacity, e_deliveryprofile.e_deliveryprofile_quantityunit, e_deliveryprofile.e_deliveryprofile_pricetimeintervalquantity, e_actiontype.e_actiontype_name, e_marketparticipant.e_marketparticipant_identifier, e_marketparticipant.e_marketparticipant_name
					FROM (e_voicebrokered RIGHT JOIN e_transaction ON e_voicebrokered.e_voicebrokered_id = e_transaction.e_transaction_voicebrokered) INNER JOIN ((e_tradingcapacity RIGHT JOIN (e_initiatoraggressor RIGHT JOIN (e_buysellindicator RIGHT JOIN (e_marketparticipant INNER JOIN e_parties ON (e_marketparticipant.e_marketparticipant_id = e_parties.e_parties_marketparticipant2) AND (e_marketparticipant.e_marketparticipant_id = e_parties.e_parties_marketparticipant2)) ON e_buysellindicator.e_buysellindicator_id = e_parties.e_parties_buysellindicator) ON e_initiatoraggressor.e_initiatoraggressor_id = e_parties.e_parties_initiatoraggressor) ON e_tradingcapacity.e_tradingcapacity_id = e_parties.e_parties_tradingcapacity) INNER JOIN ((e_orderstatus RIGHT JOIN (e_orderduration RIGHT JOIN (e_ordercondition RIGHT JOIN (e_ordertype RIGHT JOIN e_order ON e_ordertype.e_ordertype_id = e_order.e_order_id) ON e_ordercondition.e_ordercondition_id = e_order.e_order_condition) ON e_orderduration.e_orderduration_id = e_order.e_order_duration) ON e_orderstatus.e_orderstatus_id = e_order.e_order_status) RIGHT JOIN ((e_optiontype RIGHT JOIN (e_optionstyle RIGHT JOIN e_option ON e_optionstyle.e_optionstyle_id = e_option.e_option_style) ON e_optiontype.e_optiontype_id = e_option.e_option_type) RIGHT JOIN ((e_loadtype RIGHT JOIN (e_deliveryduration RIGHT JOIN (e_deliverypoint INNER JOIN (e_daysoftheweek RIGHT JOIN e_deliveryprofile ON e_daysoftheweek.e_daysoftheweek_id = e_deliveryprofile.e_deliveryprofile_daysoftheweek) ON e_deliverypoint.e_deliverypoint_id = e_deliveryprofile.e_deliveryprofile_deliverypoint) ON e_deliveryduration.E_DeliveryDuration_id = e_deliveryprofile.e_deliveryprofile_duration) ON e_loadtype.e_loadtype_id = e_deliveryprofile.e_deliveryprofile_loadtype) INNER JOIN ((e_contracttype RIGHT JOIN (e_settlementmethod RIGHT JOIN (e_organisedmarketplace RIGHT JOIN (e_energycommodity RIGHT JOIN e_contract ON e_energycommodity.e_energycommodity_id = e_contract.e_contract_energycommodity) ON e_organisedmarketplace.e_organisedmarketplace_id = e_contract.e_contract_organisedmarketplace) ON e_settlementmethod.e_settlementmethod_id = e_contract.e_contract_settlementmethod) ON e_contracttype.e_contracttype_id = e_contract.e_contract_type) INNER JOIN (e_actiontype INNER JOIN execution ON e_actiontype.e_actiontype_id = execution.execution_actiontype) ON e_contract.e_contract_id = execution.execution_contract) ON e_deliveryprofile.e_deliveryprofile_id = execution.execution_deliveryprofile) ON e_option.e_option_id = execution.execution_option) ON e_order.e_order_id = execution.execution_order) ON e_parties.e_parties_id = execution.execution_parties) ON e_transaction.e_transaction_id = execution.execution_transaction
					WHERE (((e_marketparticipant.e_marketparticipant_identifier)= '" . $_POST ["existingMarketParticipant"] . "'));
					" );
				
				while ( $row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
{
					$executionXML = $row [0];
					$marketParticipant1ID = $row [1];
					if (! empty ( $marketParticipant1ID )) {
						$queryMarketParticipant = pg_query ( $cnx, "SELECT e_marketparticipant.e_marketparticipant_id, e_marketparticipant.e_marketparticipant_identifier, 
						e_entitytype.e_entitytype_name
						FROM e_entitytype INNER JOIN e_marketparticipant ON e_entitytype.e_entitytype_id = e_marketparticipant.e_marketparticipant_type
						WHERE (((e_marketparticipant.e_marketparticipant_id)=" . $marketParticipant1ID . "));
						" );
						while ( $rowMarketParticipant = pg_fetch_row ( $queryMarketParticipant ) ) // tant que c'est pas la fin de la table
{
							$marketParticipant1ID = $rowMarketParticipant [1];
							$marketParticipant1Type = strtolower ( $rowMarketParticipant [2] );
						}
					}
					$traderID = $row [2];
					if (! empty ( $traderID )) {
						$queryTrader = pg_query ( $cnx, "SELECT e_trader.e_trader_identifier, e_trader.e_trader_name, 
						e_entitytype.e_entitytype_name
						FROM e_entitytype INNER JOIN e_trader ON e_entitytype.e_entitytype_id = e_trader.e_trader_Type
						WHERE (((e_trader.e_trader_id)=" . $traderID . "));
						" );
						while ( $rowTrader = pg_fetch_row ( $queryTrader ) ) // tant que c'est pas la fin de la table
{
							$traderID = $rowTrader [0];
							$traderName = strtolower ( $rowTrader [1] );
						}
					}
					
					$marketParticipant2ID = $row [3];
					if (! empty ( $marketParticipant2ID )) {
						$queryMarketParticipant2 = pg_query ( $cnx, "SELECT e_marketparticipant.e_marketparticipant_id, e_marketparticipant.e_marketparticipant_identifier, e_marketparticipant.e_marketparticipant_name, e_marketparticipant.e_marketparticipant_delegate, e_entitytype.e_entitytype_name
						FROM e_entitytype INNER JOIN e_marketparticipant ON e_entitytype.e_entitytype_id = e_marketparticipant.e_marketparticipant_type
						WHERE (((e_marketparticipant.e_marketparticipant_id)=" . $marketParticipant2ID . "));
						" );
						while ( $rowMarketParticipant2 = pg_fetch_row ( $queryMarketParticipant2 ) ) // tant que c'est pas la fin de la table
{
							$marketParticipant2ID = $rowMarketParticipant2 [1];
							$marketParticipant2Name = $rowMarketParticipant2 [2];
							$delegateReporting = $rowMarketParticipant2 [3];
							$marketParticipant2Type = strtolower ( $rowMarketParticipant2 [4] );
						}
					}
					$reportingEntityID = $row [4];
					if (! empty ( $reportingEntityID )) {
						$queryReportingEntity = pg_query ( $cnx, "SELECT e_reportingentity.e_reportingentity_id, e_reportingentity.e_reportingentity_identifier, 
						e_entitytype.e_entitytype_name
						FROM e_entitytype INNER JOIN e_reportingentity ON e_entitytype.e_entitytype_id = e_reportingentity.e_reportingentity_type
						WHERE (((e_reportingentity.e_reportingentity_id)=" . $reportingEntityID . "));
						" );
						while ( $rowReportingEntity = pg_fetch_row ( $queryReportingEntity ) ) // tant que c'est pas la fin de la table
{
							$reportingEntityID = $rowReportingEntity [1];
							$reportingEntityType = strtolower ( $rowReportingEntity [2] );
						}
					}
					$beneficiaryID = $row [5];
					if (! empty ( $beneficiaryID )) {
						$queryBeneficiary = pg_query ( $cnx, "SELECT e_beneficiary.e_beneficiary_id, e_beneficiary.e_beneficiary_identifier, e_entitytype.e_entitytype_name
						FROM e_entitytype INNER JOIN e_beneficiary ON e_entitytype.e_entitytype_id = e_beneficiary.e_beneficiary_type
						WHERE (((e_beneficiary.e_beneficiary_id)=" . $beneficiaryID . "));
						" );
						while ( $rowBeneficiary = pg_fetch_row ( $queryBeneficiary ) ) // tant que c'est pas la fin de la table
{
							$beneficiaryID = $rowBeneficiary [1];
							$beneficiaryType = strtolower ( $rowBeneficiary [2] );
						}
					}
					$tradingCapacity = $row [6];
					$buySellIndicator = $row [7];
					$initiatorAggressor = $row [8];
					$orderID = $row [9];
					$orderType = strtolower ( $row [10] );
					$orderCondition = $row [11];
					$orderStatus = $row [12];
					$minimumExecutionVolume = $row [13];
					$priceLimit = $row [14];
					$undisclosedVolume = $row [15];
					$orderDuration = $row [16];
					$contractID = $row [17];
					$contractName = $row [18];
					$contractType = $row [19];
					$energyCommodity = $row [20];
					$fixingIndex = $row [21];
					$settlementMethod = $row [22];
					$organisedMarketPlace = $row [23];
					$tradingHours = $row [24];
					$lastTraidingDate = $row [25];
					$lastTraidingTime = $row [25];
					$transactionTimestampDate = $row [26];
					$uniqueTransactionID = $row [27];
					$linkedTransactionID = $row [28];
					$linkedOrderID = $row [29];
					$voicebrokered = $row [30];
					$price = ( float ) $row [31];
					$indexValue = $row [32];
					$priceCurrency = $row [33];
					if (! empty ( $priceCurrency )) {
						$queryPriceCurrency = pg_query ( $cnx, "SELECT e_currency.e_currency_id, e_currency.e_currency_name
						FROM e_currency
						WHERE (((e_currency.e_currency_id)=" . $priceCurrency . "));
						" );
						while ( $rowPriceCurrency = pg_fetch_row ( $queryPriceCurrency ) ) // tant que c'est pas la fin de la table
{
							$priceCurrency = $rowPriceCurrency [1];
						}
					}
					$notionalAmount = $row [34];
					$notionalCurrency = $row [35];
					if (! empty ( $notionalCurrency )) {
						$queryNotionalCurrency = pg_query ( $cnx, "SELECT e_currency.e_currency_id, e_currency.e_currency_name
						FROM e_currency
						WHERE (((e_currency.e_currency_id)=" . $notionalCurrency . "));
						" );
						while ( $rowNotionalCurrency = pg_fetch_row ( $queryNotionalCurrency ) ) // tant que c'est pas la fin de la table
{
							$notionalCurrency = $rowNotionalCurrency [1];
						}
					}
					$quantity = $row [36];
					$totalNotionalContractQuantity = $row [37];
					$quantityUnit = $row [38];
					if (! empty ( $quantityUnit )) {
						$queryQuantityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
						FROM e_quantityunit
						WHERE (((e_quantityunit.e_quantityunit_id)=" . $quantityUnit . "));
						" );
						while ( $rowQuantityUnit = pg_fetch_row ( $queryQuantityUnit ) ) // tant que c'est pas la fin de la table
{
							$quantityUnit = $rowQuantityUnit [1];
						}
					}
					$totalNotionalContractQuantityUnit = $row [39];
					if (! empty ( $totalNotionalContractQuantityUnit )) {
						$querytotalNotionalContractQuantityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
						FROM e_quantityunit
						WHERE (((e_quantityunit.e_quantityunit_id)=" . $totalNotionalContractQuantityUnit . "));
						" );
						while ( $rowtotalNotionalContractQuantityUnit = pg_fetch_row ( $querytotalNotionalContractQuantityUnit ) ) // tant que c'est pas la fin de la table
{
							$totalNotionalContractQuantityUnit = $rowtotalNotionalContractQuantityUnit [1];
						}
					}
					$terminationDate = $row [40];
					$optionStyle = $row [41];
					$optionType = $row [42];
					$exerciseDate = $row [43];
					$strikePrice = $row [44];
					$deliveryPointName = $row [45];
					$deliveryStartDate = $row [46];
					$deliveryEndDate = $row [47];
					$duration = $row [48];
					$loadType = $row [49];
					$daysOfTheWeek = $row [50];
					$loadDeliveryIntervals = $row [51];
					$deliveryCapacity = $row [52];
					$deliveryCapacityUnit = $row [53];
					if (! empty ( $deliveryCapacityUnit )) {
						$queryDeliveryCapacityUnit = pg_query ( $cnx, "SELECT e_quantityunit.e_quantityunit_id, e_quantityunit.e_quantityunit_name
						FROM e_quantityunit
						WHERE (((e_quantityunit.e_quantityunit_id)=" . $deliveryCapacityUnit . "));
						" );
						while ( $rowDeliveryCapacityUnit = pg_fetch_row ( $queryDeliveryCapacityUnit ) ) // tant que c'est pas la fin de la table
{
							$deliveryCapacityUnit = $rowDeliveryCapacityUnit [1];
						}
					}
					$priceTimeIntervalsQuantity = $row [54];
					$actionType = $row [55];
					
					// on genere le xml avec toutes les variables recuperees
					
					$dom = new DOMDocument ( '1.0', 'utf-8' );
					$dom->encoding = "utf-8";
					$dom->formatOutput = true;
					
					$root = $dom->createElement ( 'REMITTable1' );
					$root->setAttribute ( 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance' );
					$root->setAttribute ( 'xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable1_V2.xsd' );
					$dom->appendChild ( $root );
					
					// reporting entity
					$reportingEntity = $dom->createElement ( 'reportingEntityID' );
					$root->appendChild ( $reportingEntity );
					$reportingEntity->appendChild ( $dom->createElement ( $reportingEntityType, $reportingEntityID ) );
					// fin reporting entity
					
					// contract
					$contractXML = $dom->createElement ( 'contractList' );
					$root->appendChild ( $contractXML );
					
					$result = $dom->createElement ( 'contract' );
					$contractXML->appendChild ( $result );
					
					if (! empty ( $contractID )) {
						$result->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
					}
					if (! empty ( $contractName )) {
						$result->appendChild ( $dom->createElement ( 'contractName', $contractName ) );
					}
					if (! empty ( $contractType )) {
						$result->appendChild ( $dom->createElement ( 'contractType', $contractType ) );
					}
					if (! empty ( $energyCommodity )) {
						$result->appendChild ( $dom->createElement ( 'energyCommodity', $energyCommodity ) );
					}
					
					$result2 = $dom->createElement ( 'fixingIndex' );
					$result->appendChild ( $result2 );
					if (empty ( $fixingIndex )) {
						$fixingIndex = 'null';
					}
					$result2->appendChild ( $dom->createElement ( 'indexName', $fixingIndex ) );
					
					if (! empty ( $settlementMethod )) {
						$result->appendChild ( $dom->createElement ( 'settlementMethod', $settlementMethod ) );
					}
					
					$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
					$result->appendChild ( $result2 );
					
					if (! empty ( $organisedMarketPlace )) {
						$result2->appendChild ( $dom->createElement ( 'mic', $organisedMarketPlace ) );
					}
					
					if (! empty ( $tradingHours ) && $tradingHours != 'null') {
						$result2 = $dom->createElement ( 'contractTradingHours' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'startTime', substr ( $tradingHours, 0, 8 ) ) );
						$result2->appendChild ( $dom->createElement ( 'endTime', substr ( $tradingHours, 9, 17 ) ) );
					}
					if (! empty ( $lastTraidingDate ) && $lastTraidingDate != 'null') {
						$dateFormated = $lastTraidingDate . ' ' . $lastTraidingTime;
						$lastTraidingDateTime = date ( 'c', strtotime ( $dateFormated ) );
						$result->appendChild ( $dom->createElement ( 'lastTradingDateTime', $lastTraidingDateTime ) );
					}
					
					if (! empty ( $optionStyle )) {
						$result2 = $dom->createElement ( 'optionDetails' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'optionStyle', $optionStyle ) );
					}
					if (! empty ( $optionType )) {
						$result2->appendChild ( $dom->createElement ( 'optionType', $optionType ) );
					}
					if (! empty ( $exerciseDate )) {
						$exerciseDate = date ( 'c', strtotime ( $exerciseDate ) );
						$result2->appendChild ( $dom->createElement ( 'optionExerciseDate', $exerciseDate ) );
					}
					if (! empty ( $strikePrice )) {
						$result2 = $dom->createElement ( 'optionStrikePrice' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $strikePrice ) );
					}
					
					if (! empty ( $deliveryPointName ) && $deliveryPointName != 'null') {
						$result->appendChild ( $dom->createElement ( 'deliveryPointOrZone', $deliveryPointName ) );
					}
					if (! empty ( $deliveryStartDate ) && $deliveryStartDate != 'null') {
						// $exerciseDate = date('c', strtotime($exerciseDate));
						$result->appendChild ( $dom->createElement ( 'deliveryStartDate', date ( 'Y-m-d', strtotime ( $deliveryStartDate ) ) ) );
					}
					if (! empty ( $deliveryEndDate ) && $deliveryEndDate != 'null') {
						$result->appendChild ( $dom->createElement ( 'deliveryEndDate', date ( 'Y-m-d', strtotime ( $deliveryEndDate ) ) ) );
					}
					if (! empty ( $duration ) && $duration != 'null') {
						$result->appendChild ( $dom->createElement ( 'duration', $duration ) );
					}
					if (! empty ( $loadType ) && $loadType != 'null') {
						$result->appendChild ( $dom->createElement ( 'loadType', $loadType ) );
					}
					
					$result2 = $dom->createElement ( 'deliveryProfile' );
					$result->appendChild ( $result2 );
					$result2->appendChild ( $dom->createElement ( 'daysOfTheWeek', $daysOfTheWeek ) );
					
					$loadDeliveryStartTime = substr ( $loadDeliveryIntervals, 0, 8 );
					$result2->appendChild ( $dom->createElement ( 'loadDeliveryStartTime', $loadDeliveryStartTime ) );
					
					$loadDeliveryEndTime = substr ( $loadDeliveryIntervals, -8 );
					$result2->appendChild ( $dom->createElement ( 'loadDeliveryEndTime', $loadDeliveryEndTime ) );
					// fin contract
					
					// trade
					$tradeXML = $dom->createElement ( 'TradeList' );
					$root->appendChild ( $tradeXML );
					
					$result = $dom->createElement ( 'TradeReport' );
					$tradeXML->appendChild ( $result );
					
					$result->appendChild ( $dom->createElement ( 'RecordSeqNumber', $executionXML ) );
					
					$result2 = $dom->createElement ( 'idOfMarketParticipant' );
					$result->appendChild ( $result2 );
					$result2->appendChild ( $dom->createElement ( $marketParticipant1Type, $marketParticipant1ID ) );
					
					$result2 = $dom->createElement ( 'traderID' );
					$result->appendChild ( $result2 );
					if (empty ( $traderID ) || $traderID != 'null') {
						$traderName = 'EDFDCO';
					}
					$result2->appendChild ( $dom->createElement ( 'traderIdForOrganisedMarket', $traderName ) );
					
					if (! empty ( $marketParticipant2ID ) && $marketParticipant2ID != 'null') {
						$result2 = $dom->createElement ( 'otherMarketParticipant' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $marketParticipant2Type, $marketParticipant2ID ) );
					}
					
					if (! empty ( $beneficiaryID )) {
						$result2 = $dom->createElement ( 'beneficiaryIdentification' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $beneficiaryType, $beneficiaryID ) );
					}
					
					$result->appendChild ( $dom->createElement ( 'tradingCapacity', $tradingCapacity ) );
					
					if (! empty ( $buySellIndicator )) {
						$result->appendChild ( $dom->createElement ( 'buySellIndicator', $buySellIndicator ) );
					}
					if (! empty ( $initiatorAggressor )) {
						$result->appendChild ( $dom->createElement ( 'aggressor', $initiatorAggressor ) );
					}
					
					if (! empty ( $priceLimit )) {
						$result3 = $dom->createElement ( 'triggerDetails' );
						$result2->appendChild ( $result3 );
						
						$result4 = $dom->createElement ( 'priceLimit' );
						$result3->appendChild ( $result4 );
						$result4->appendChild ( $dom->createElement ( 'value', $priceLimit ) );
					}
					
					if (! empty ( $undisclosedVolume )) {
						$result2->appendChild ( $dom->createElement ( 'undisclosedVolume', $undisclosedVolume ) );
					}
					if (! empty ( $orderDuration )) {
						$result2->appendChild ( $dom->createElement ( 'orderDuration', $orderDuration ) );
					}
					
					$result2 = $dom->createElement ( 'contractInfo' );
					$result->appendChild ( $result2 );
					if (! empty ( $contractID )) {
						$result2->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
					}
					
					$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
					$result->appendChild ( $result2 );
					if (! empty ( $organisedMarketPlace )) {
						$result2->appendChild ( $dom->createElement ( 'bil', $organisedMarketPlace ) );
					}
					
					if (! empty ( $transactionTimestampDate )) {
						$transactionTimestampDate = date ( 'c', strtotime ( $transactionTimestampDate ) );
						$result->appendChild ( $dom->createElement ( 'transactionTime', $transactionTimestampDate ) );
					}
					$result2 = $dom->createElement ( 'uniqueTransactionIdentifier' );
					$result->appendChild ( $result2 );
					if (! empty ( $uniqueTransactionID )) {
						$result2->appendChild ( $dom->createElement ( 'uniqueTransactionIdentifier', $uniqueTransactionID ) );
					}
					if (! empty ( $linkedTransactionID )) {
						$result->appendChild ( $dom->createElement ( 'linkedTransactionId', $linkedTransactionID ) );
					}
					if (! empty ( $linkedOrderID )) {
						$result->appendChild ( $dom->createElement ( 'linkedOrderId', $linkedOrderID ) );
					}
					if (! empty ( $voicebrokered )) {
						$result->appendChild ( $dom->createElement ( 'voiceBrokered', $voicebrokered ) );
					}
					$result2 = $dom->createElement ( 'priceDetails' );
					$result->appendChild ( $result2 );
					if (! empty ( $price )) {
						$result2->appendChild ( $dom->createElement ( 'price', $price ) );
					}
					if (! empty ( $indexValue )) {
						$result2->appendChild ( $dom->createElement ( 'indexValue', $indexValue ) );
					}
					if (! empty ( $priceCurrency )) {
						$result2->appendChild ( $dom->createElement ( 'priceCurrency', $priceCurrency ) );
					}
					$result2 = $dom->createElement ( 'notionalAmountDetails' );
					$result->appendChild ( $result2 );
					if (! empty ( $notionalAmount )) {
						$result2->appendChild ( $dom->createElement ( 'notionalAmount', $notionalAmount ) );
					}
					if (! empty ( $notionalCurrency )) {
						$result2->appendChild ( $dom->createElement ( 'notionalCurrency', $notionalCurrency ) );
					}
					if (! empty ( $quantity )) {
						$result2 = $dom->createElement ( 'quantity' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $quantity ) );
					}
					if (! empty ( $quantityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $quantityUnit ) );
					}
					if (! empty ( $totalNotionalContractQuantity )) {
						$result2 = $dom->createElement ( 'totalNotionalContractQuantity' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'value', $totalNotionalContractQuantity ) );
					}
					if (! empty ( $totalNotionalContractQuantityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $totalNotionalContractQuantityUnit ) );
					}
					if (! empty ( $terminationDate )) {
						$result->appendChild ( $dom->createElement ( 'terminationDate', $terminationDate ) );
					}
					if (! empty ( $deliveryCapacity )) {
						$result2 = $dom->createElement ( 'priceIntervalQuantityDetails' );
						$result->appendChild ( $result2 );
						
						$result2->appendChild ( $dom->createElement ( 'quantity', $deliveryCapacity ) );
					}
					if (! empty ( $deliveryCapacityUnit )) {
						$result2->appendChild ( $dom->createElement ( 'unit', $deliveryCapacityUnit ) );
					}
					if (! empty ( $priceTimeIntervalsQuantity )) {
						$result3 = $dom->createElement ( 'priceTimeIntervalQuantity' );
						$result2->appendChild ( $result3 );
						$result3->appendChild ( $dom->createElement ( 'value', $priceTimeIntervalsQuantity ) );
					}
					if (! empty ( $actionType )) {
						$result->appendChild ( $dom->createElement ( 'actionType', $actionType ) );
					}
					// fin trade
					
					if (! empty ( $executionXML )) {
						$queryBill = pg_query ( $cnx, "SELECT e_bill.e_bill_name
						FROM e_bill	WHERE e_bill.e_bill_execution='" . $executionXML . "';" );
						while ( $rowBill = pg_fetch_row ( $queryBill ) ) // tant que c'est pas la fin de la table
						{
							$bill = $rowBill [0];
						}
					}
					
					//echo '<xmp>' . $dom->saveXML () . '</xmp>';
					
					$dom->save ( $row [57] . '_' . $row [56] . '_' . $bill . '_' . $executionXML . '.xml' ) or die ( 'XML Create Error' );
					
					echo '<xmp>' . $dom->saveXML () . '</xmp>';
					echo '<xmp>' . $delegateReporting . '</xmp>';
					
					// si le reporting delegate est true on change les valeurs marketparticipant et seller et trader
					if ($delegateReporting == "t") {
						// on genere le xml avec toutes les variables recuperees
						$dom = new DOMDocument ( '1.0', 'utf-8' );
						$dom->encoding = "utf-8";
						$dom->formatOutput = true;
						
						$root = $dom->createElement ( 'REMITTable1' );
						$root->setAttribute ( 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance' );
						$root->setAttribute ( 'xmlns', 'http://www.acer.europa.eu/REMIT/REMITTable1_V2.xsd' );
						$dom->appendChild ( $root );
						
						// reporting entity
						$reportingEntity = $dom->createElement ( 'reportingEntityID' );
						$root->appendChild ( $reportingEntity );
						$reportingEntity->appendChild ( $dom->createElement ( $reportingEntityType, $reportingEntityID ) );
						// fin reporting entity
						
						// contract
						$contractXML = $dom->createElement ( 'contractList' );
						$root->appendChild ( $contractXML );
						
						$result = $dom->createElement ( 'contract' );
						$contractXML->appendChild ( $result );
						
						if (! empty ( $contractID )) {
							$result->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
						}
						if (! empty ( $contractName )) {
							$result->appendChild ( $dom->createElement ( 'contractName', $contractName ) );
						}
						if (! empty ( $contractType )) {
							$result->appendChild ( $dom->createElement ( 'contractType', $contractType ) );
						}
						if (! empty ( $energyCommodity )) {
							$result->appendChild ( $dom->createElement ( 'energyCommodity', $energyCommodity ) );
						}
						
						$result2 = $dom->createElement ( 'fixingIndex' );
						$result->appendChild ( $result2 );
						if (! empty ( $fixingIndex )) {
							$result2->appendChild ( $dom->createElement ( 'indexName', $fixingIndex ) );
						}
						
						if (! empty ( $settlementMethod )) {
							$result->appendChild ( $dom->createElement ( 'settlementMethod', $settlementMethod ) );
						}
						
						$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
						$result->appendChild ( $result2 );
						
						if (! empty ( $organisedMarketPlace )) {
							$result2->appendChild ( $dom->createElement ( 'mic', $organisedMarketPlace ) );
						}
						
						if (! empty ( $tradingHours ) && $tradingHours != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryStartDate', substr ( $deliveryStartDate, 0, 10 ) ) );
							$result2 = $dom->createElement ( 'contractTradingHours' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'startTime', substr ( $tradingHours, 0, 8 ) ) );
							$result2->appendChild ( $dom->createElement ( 'endTime', substr ( $tradingHours, -8 ) ) );
						}
						if (! empty ( $lastTraidingDate ) && $lastTraidingDate != 'null') {
							$dateFormated = $lastTraidingDate . ' ' . $lastTraidingTime;
							$lastTraidingDateTime = date ( 'c', strtotime ( $dateFormated ) );
							$result->appendChild ( $dom->createElement ( 'lastTradingDateTime', $lastTraidingDateTime ) );
						}
						
						if (! empty ( $optionStyle )) {
							$result2 = $dom->createElement ( 'optionDetails' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'optionStyle', $optionStyle ) );
						}
						if (! empty ( $optionType )) {
							$result2->appendChild ( $dom->createElement ( 'optionType', $optionType ) );
						}
						if (! empty ( $exerciseDate )) {
							$exerciseDate = date ( 'c', strtotime ( $exerciseDate ) );
							$result2->appendChild ( $dom->createElement ( 'optionExerciseDate', $exerciseDate ) );
						}
						if (! empty ( $strikePrice )) {
							$result2 = $dom->createElement ( 'optionStrikePrice' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $strikePrice ) );
						}
						
						if (! empty ( $deliveryPointName ) && $deliveryPointName != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryPointOrZone', $deliveryPointName ) );
						}
						if (! empty ( $deliveryStartDate ) && $deliveryStartDate != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryStartDate', substr ( $deliveryStartDate, 0, 10 ) ) );
						}
						if (! empty ( $deliveryEndDate ) && $deliveryEndDate != 'null') {
							$result->appendChild ( $dom->createElement ( 'deliveryEndDate', substr ( $deliveryEndDate, 0, 10 ) ) );
						}
						if (! empty ( $duration ) && $duration != 'null') {
							$result->appendChild ( $dom->createElement ( 'duration', $duration ) );
						}
						if (! empty ( $loadType ) && $loadType != 'null') {
							$result->appendChild ( $dom->createElement ( 'loadType', $loadType ) );
						}
						
						$result2 = $dom->createElement ( 'deliveryProfile' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( 'daysOfTheWeek', $daysOfTheWeek ) );
						
						$loadDeliveryStartTime = substr ( $loadDeliveryIntervals, 0, 8 );
						$result2->appendChild ( $dom->createElement ( 'loadDeliveryStartTime', $loadDeliveryStartTime ) );
						
						$loadDeliveryEndTime = substr ( $loadDeliveryIntervals, -8 );
						$result2->appendChild ( $dom->createElement ( 'loadDeliveryEndTime', $loadDeliveryEndTime ) );
						// fin contract
						
						// trade
						$tradeXML = $dom->createElement ( 'TradeList' );
						$root->appendChild ( $tradeXML );
						
						$result = $dom->createElement ( 'TradeReport' );
						$tradeXML->appendChild ( $result );
						
						$result->appendChild ( $dom->createElement ( 'RecordSeqNumber', $executionXML ) );
						
						$result2 = $dom->createElement ( 'idOfMarketParticipant' );
						$result->appendChild ( $result2 );
						$result2->appendChild ( $dom->createElement ( $marketParticipant2Type, $marketParticipant2ID ) );
						
						$result2 = $dom->createElement ( 'traderID' );
						$result->appendChild ( $result2 );
						
						if (empty ( $traderName ) || $traderName != 'null') {
							$traderName = $marketParticipant2Name;
						}
						$result2->appendChild ( $dom->createElement ( 'traderIdForOrganisedMarket', $traderName ) );
						
						if (! empty ( $marketParticipant1ID ) && $marketParticipant1ID != 'null') {
							$result2 = $dom->createElement ( 'otherMarketParticipant' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( $marketParticipant1Type, $marketParticipant1ID ) );
						}
						
						if (! empty ( $beneficiaryID )) {
							$result2 = $dom->createElement ( 'beneficiaryIdentification' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( $beneficiaryType, $beneficiaryID ) );
						}
						
						$result->appendChild ( $dom->createElement ( 'tradingCapacity', $tradingCapacity ) );
						
						if (! empty ( $buySellIndicator )) {
							$result->appendChild ( $dom->createElement ( 'buySellIndicator', 'B' ) );
						}
						if (! empty ( $initiatorAggressor )) {
							$result->appendChild ( $dom->createElement ( 'aggressor', $initiatorAggressor ) );
						}
						
						if (! empty ( $priceLimit )) {
							$result3 = $dom->createElement ( 'triggerDetails' );
							$result2->appendChild ( $result3 );
							
							$result4 = $dom->createElement ( 'priceLimit' );
							$result3->appendChild ( $result4 );
							$result4->appendChild ( $dom->createElement ( 'value', $priceLimit ) );
						}
						
						if (! empty ( $undisclosedVolume )) {
							$result2->appendChild ( $dom->createElement ( 'undisclosedVolume', $undisclosedVolume ) );
						}
						if (! empty ( $orderDuration )) {
							$result2->appendChild ( $dom->createElement ( 'orderDuration', $orderDuration ) );
						}
						
						$result2 = $dom->createElement ( 'contractInfo' );
						$result->appendChild ( $result2 );
						if (! empty ( $contractID )) {
							$result2->appendChild ( $dom->createElement ( 'contractId', $contractID ) );
						}
						
						$result2 = $dom->createElement ( 'organisedMarketPlaceIdentifier' );
						$result->appendChild ( $result2 );
						if (! empty ( $organisedMarketPlace )) {
							$result2->appendChild ( $dom->createElement ( 'bil', $organisedMarketPlace ) );
						}
						
						if (! empty ( $transactionTimestampDate )) {
							$transactionTimestampDate = date ( 'c', strtotime ( $transactionTimestampDate ) );
							$result->appendChild ( $dom->createElement ( 'transactionTime', $transactionTimestampDate ) );
						}
						$result2 = $dom->createElement ( 'uniqueTransactionIdentifier' );
						$result->appendChild ( $result2 );
						if (! empty ( $uniqueTransactionID )) {
							$result2->appendChild ( $dom->createElement ( 'uniqueTransactionIdentifier', $uniqueTransactionID ) );
						}
						if (! empty ( $linkedTransactionID )) {
							$result->appendChild ( $dom->createElement ( 'linkedTransactionId', $linkedTransactionID ) );
						}
						if (! empty ( $linkedOrderID )) {
							$result->appendChild ( $dom->createElement ( 'linkedOrderId', $linkedOrderID ) );
						}
						if (! empty ( $voicebrokered )) {
							$result->appendChild ( $dom->createElement ( 'voiceBrokered', $voicebrokered ) );
						}
						$result2 = $dom->createElement ( 'priceDetails' );
						$result->appendChild ( $result2 );
						if (! empty ( $price )) {
							$result2->appendChild ( $dom->createElement ( 'price', $price ) );
						}
						if (! empty ( $indexValue )) {
							$result2->appendChild ( $dom->createElement ( 'indexValue', $indexValue ) );
						}
						if (! empty ( $priceCurrency )) {
							$result2->appendChild ( $dom->createElement ( 'priceCurrency', $priceCurrency ) );
						}
						$result2 = $dom->createElement ( 'notionalAmountDetails' );
						$result->appendChild ( $result2 );
						if (! empty ( $notionalAmount )) {
							$result2->appendChild ( $dom->createElement ( 'notionalAmount', $notionalAmount ) );
						}
						if (! empty ( $notionalCurrency )) {
							$result2->appendChild ( $dom->createElement ( 'notionalCurrency', $notionalCurrency ) );
						}
						if (! empty ( $quantity )) {
							$result2 = $dom->createElement ( 'quantity' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $quantity ) );
						}
						if (! empty ( $quantityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $quantityUnit ) );
						}
						if (! empty ( $totalNotionalContractQuantity )) {
							$result2 = $dom->createElement ( 'totalNotionalContractQuantity' );
							$result->appendChild ( $result2 );
							$result2->appendChild ( $dom->createElement ( 'value', $totalNotionalContractQuantity ) );
						}
						if (! empty ( $totalNotionalContractQuantityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $totalNotionalContractQuantityUnit ) );
						}
						if (! empty ( $terminationDate )) {
							$result->appendChild ( $dom->createElement ( 'terminationDate', $terminationDate ) );
						}
						if (! empty ( $deliveryCapacity )) {
							$result2 = $dom->createElement ( 'priceIntervalQuantityDetails' );
							$result->appendChild ( $result2 );
							
							$result2->appendChild ( $dom->createElement ( 'quantity', $deliveryCapacity ) );
						}
						if (! empty ( $deliveryCapacityUnit )) {
							$result2->appendChild ( $dom->createElement ( 'unit', $deliveryCapacityUnit ) );
						}
						if (! empty ( $priceTimeIntervalsQuantity )) {
							$result3 = $dom->createElement ( 'priceTimeIntervalQuantity' );
							$result2->appendChild ( $result3 );
							$result3->appendChild ( $dom->createElement ( 'value', $priceTimeIntervalsQuantity ) );
						}
						if (! empty ( $actionType )) {
							$result->appendChild ( $dom->createElement ( 'actionType', $actionType ) );
						}
						// fin trade
						
						echo '<xmp>' . $dom->saveXML () . '</xmp>';
						
						$dom->save ( date ( 'Ymd' ) . '_REMITTable1_V2_EDFDCO_' . $executionXML . '_delegate_' . $marketParticipant2Name . '.xml' );
					}
					echo '<xmp>' . $dom->saveXML () . '</xmp>';
					
					// on met à jour la table Execution avec la date d'envoi et le boolean envoye passe à true
					$sql = "UPDATE execution SET execution_xml = TRUE, execution_date = now() WHERE (execution_id =". $executionXML . ")";
					var_dump($sql);
					$sql2 = pg_query ( $cnx, $sql ) or die ( pg_last_error () );
				}
			}
		} else {
			echo "Impossible de se connecter a la base de donnees";
		}
	}
	?>

		</form>
</body>
</html>

