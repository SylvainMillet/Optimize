
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>

<body>


	<!------------------------------------------------------------ navbar call -------------------------------------------------------------->
<?php
require 'connect.php';
include 'navbar_execution.php';
?>

	<h3 id="titleSearch">Search view</h3>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Existing Execution by Unique Transaction Identifier</span> <select
				onchange="loadExecution(this.value)" id="existingExecution"
				class="form-control">
				<option value=""></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT execution.execution_id,  
							
					mp1.e_marketparticipant_identifier, mp1.e_marketparticipant_name, mp1.e_marketparticipant_type, tr.e_trader_identifier,
					mp2.e_marketparticipant_identifier, mp2.e_marketparticipant_name,  mp2.e_marketparticipant_type, re.e_reportingentity_identifier, 
					re.e_reportingentity_type, be.e_beneficiary_identifier, be.e_beneficiary_type, 
					e_parties.e_parties_tradingcapacity, e_parties.e_parties_buysellindicator, e_parties.e_parties_initiatoraggressor,
							
					e_order.e_order_identifier, e_order.e_order_type, e_order.e_order_condition, e_order.e_order_status, e_order.e_order_minimumexecutionvolume, 
					e_order.e_order_pricelimit, e_order.e_order_undisclosedvolume, e_order.e_order_duration, 
							
					e_contract.e_contract_identifier, e_contract.e_contract_name, e_contract.e_contract_type, e_contract.e_contract_energycommodity, 
					e_contract.e_contract_fixingindex, e_contract.e_contract_settlementmethod, e_contract.e_contract_organisedmarketplace, e_contract.e_contract_tradinghours, 
					e_contract.e_contract_lasttraidingdate,
							
					e_transaction.e_transaction_timestamp, e_transaction.e_transaction_uniquetransactionid, e_transaction.e_transaction_linkedtransaction, 
					e_transaction.e_transaction_linkedorder, e_transaction.e_transaction_voicebrokered, e_transaction.e_transaction_price, 
					e_transaction.e_transaction_indexvalue, e_transaction.e_transaction_priceCurrency, e_transaction.e_transaction_notionalamount, 
					e_transaction.e_transaction_notionalcurrency, e_transaction.e_transaction_quantity, e_transaction.e_transaction_totalnotionalcontractquantity, 
					e_transaction.e_transaction_quantityunit, e_transaction.e_transaction_totalnotionalcontractquantityunit, e_transaction.e_transaction_terminationdate,
							
					e_option.e_option_style, e_option.e_option_type, e_option.e_option_exercisedate, e_option.e_option_strikeprice, 
							
					e_deliverypoint.e_deliverypoint_identifier, e_deliveryprofile.e_deliveryprofile_deliverystartdate, e_deliveryprofile.e_deliveryprofile_deliveryenddate, 
					e_deliveryprofile.e_deliveryprofile_duration, e_deliveryprofile.e_deliveryprofile_loadtype, e_deliveryprofile.e_deliveryprofile_daysoftheweek, 
					e_deliveryprofile.e_deliveryprofile_loaddeliveryintervals, e_deliveryprofile.e_deliveryprofile_deliverycapacity, 
					e_deliveryprofile.e_deliveryprofile_quantityunit, e_deliveryprofile.e_deliveryprofile_pricetimeintervalquantity, 
					
					execution.execution_actiontype, 
							
					e_bill.e_bill_name, 
							
					e_parties.e_parties_marketparticipant1,  e_parties.e_parties_trader, e_parties.e_parties_marketparticipant2,  e_parties.e_parties_reportingentity, 
					e_parties.e_parties_beneficiary, execution.execution_parties, 
							
					execution.execution_order, execution.execution_contract, execution.execution_transaction, execution.execution_option, execution.execution_deliveryprofile,
					e_deliveryprofile.e_deliveryprofile_deliverypoint, e_bill.e_bill_id, execution.execution_id
							
					FROM (e_parties LEFT JOIN e_marketparticipant mp1 ON (e_parties.e_parties_marketparticipant1 = mp1.e_marketparticipant_id)
									LEFT JOIN e_marketparticipant mp2 ON (e_parties.e_parties_marketparticipant2 = mp2.e_marketparticipant_id) 
									LEFT JOIN e_trader tr ON (e_parties.e_parties_trader = tr.e_trader_id) 
									LEFT JOIN e_reportingentity re ON (e_parties.e_parties_reportingentity = re.e_reportingentity_id) 
									LEFT JOIN e_beneficiary be ON (e_parties.e_parties_beneficiary = be.e_beneficiary_id) 
									INNER JOIN (e_order RIGHT JOIN (e_option RIGHT JOIN (e_contract INNER JOIN ((e_deliverypoint INNER JOIN e_deliveryprofile ON e_deliverypoint.e_deliverypoint_id = e_deliveryprofile.e_deliveryprofile_deliverypoint) INNER JOIN (e_transaction INNER JOIN execution ON e_transaction.e_transaction_id = execution.execution_transaction) ON e_deliveryprofile.e_deliveryprofile_id = execution.execution_deliveryprofile) ON e_contract.e_contract_id = execution.execution_contract) ON e_option.e_option_id = execution.execution_option) ON e_order.e_order_id = execution.execution_order) ON e_parties.e_parties_id = execution.execution_parties) INNER JOIN e_bill ON execution.execution_id = e_bill.e_bill_id;
					
 						
 					" ); // requête
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
					{
						echo '<option value="' . $row[0] .'|'. $row[1] .'|'. $row[2] .'|'. $row[3]
						.'|'. $row[4] .'|'. $row[5] .'|' . $row[6] .'|'. $row[7] .'|'. $row[8] .'|'. $row[9] .'|'. $row[10] .'|'. $row[11]
						.'|'. $row[12] .'|'. $row[13] .'|'. $row[14] .'|'. $row[15] .'|'. $row[16] .'|'. $row[17] .'|'. $row[18] .'|'. $row[19]
						.'|'. $row[20] .'|'. $row[21] .'|'. $row[22] .'|'. $row[23]	.'|'. $row[24] .'|'. $row[25] .'|'. $row[26] .'|'. $row[27]
						.'|'. $row[28] .'|'. $row[29] .'|'. $row[30] .'|'. $row[31]	.'|'. $row[32] .'|'. $row[33] .'|'. $row[34] .'|'. $row[35]
						.'|'. $row[36] .'|'. $row[37] .'|'. $row[38] .'|'. $row[39]	.'|'. $row[40] .'|'. $row[41] .'|'. $row[42] .'|'. $row[43]
						.'|'. $row[44] .'|'. $row[45] .'|'. $row[46] .'|'. $row[47]	.'|'. $row[48] .'|'. $row[49] .'|'. $row[50] .'|'. $row[51]
						.'|'. $row[52] .'|'. $row[53] .'|'. $row[54] .'|'. $row[55] .'|'. $row[56] .'|'. $row[57] .'|'. $row[58] .'|'. $row[59]
						.'|'. $row[60] .'|'. $row[61] .'|'. $row[62] .'|'. $row[63] .'|'. $row[64] .'|'. $row[65] .'|'. $row[66] .'|'. $row[67]
						.'|'. $row[68] .'|'. $row[69] .'|'. $row[70] .'|'. $row[71] .'|'. $row[72] .'|'. $row[73] .'|'. $row[74] .'|'. $row[75]
						.'|'. $row[76] . '">' . $row[33].' </option>';
					}
				} else {
					echo "Impossible de se connecter à la base de données";
				}
				?>
			</select>
		</div>
	</div>

	<script src="/REMIT/js/jquery.js"></script>
	<script type="text/javascript">
		function loadExecution(valeur)
		{
			liste = document.getElementById('existingExecution');
			document.getElementById('searchMarketParticipant1ID').value=(liste.options[liste.selectedIndex].value).split("|")[1];
			document.getElementById('searchMarketParticipant1Name').value=(liste.options[liste.selectedIndex].value).split("|")[2];
			document.getElementById('searchMarketParticipant1Type').value=(liste.options[liste.selectedIndex].value).split("|")[3];
			document.getElementById('searchTraderID').value=(liste.options[liste.selectedIndex].value).split("|")[4];
			document.getElementById('searchBillID').value=(liste.options[liste.selectedIndex].value).split("|")[62];
			document.getElementById('searchMarketParticipant2ID').value=(liste.options[liste.selectedIndex].value).split("|")[5];
			document.getElementById('searchMarketParticipant2Name').value=(liste.options[liste.selectedIndex].value).split("|")[6];
			document.getElementById('searchMarketParticipant2Type').value=(liste.options[liste.selectedIndex].value).split("|")[7];
			document.getElementById('searchReportingEntityID').value=(liste.options[liste.selectedIndex].value).split("|")[8];
			document.getElementById('searchReportingEntityType').value=(liste.options[liste.selectedIndex].value).split("|")[9];
			document.getElementById('searchBeneficiaryID').value=(liste.options[liste.selectedIndex].value).split("|")[10];
			document.getElementById('searchBeneficiaryType').value=(liste.options[liste.selectedIndex].value).split("|")[11];
			document.getElementById('searchTradingCapacity').value=(liste.options[liste.selectedIndex].value).split("|")[12];
			document.getElementById('searchBuySellIndicator').value=(liste.options[liste.selectedIndex].value).split("|")[13];
			document.getElementById('searchInitiatorAggressor').value=(liste.options[liste.selectedIndex].value).split("|")[14];
			
			document.getElementById('searchOrderID').value=(liste.options[liste.selectedIndex].value).split("|")[15];
			document.getElementById('searchOrderType').value=(liste.options[liste.selectedIndex].value).split("|")[16];
			document.getElementById('searchOrderCondition').value=(liste.options[liste.selectedIndex].value).split("|")[17];
			document.getElementById('searchOrderStatus').value=(liste.options[liste.selectedIndex].value).split("|")[18];
			document.getElementById('searchMinimumExecutionVolume').value=(liste.options[liste.selectedIndex].value).split("|")[19];
			document.getElementById('searchPriceLimit').value=(liste.options[liste.selectedIndex].value).split("|")[20];
			document.getElementById('searchUndisclosedVolume').value=(liste.options[liste.selectedIndex].value).split("|")[21];
			document.getElementById('searchOrderDuration').value=(liste.options[liste.selectedIndex].value).split("|")[22];
			
			document.getElementById('searchContractID').value=(liste.options[liste.selectedIndex].value).split("|")[23];
			document.getElementById('searchContractName').value=(liste.options[liste.selectedIndex].value).split("|")[24];
			document.getElementById('searchContractType').value=(liste.options[liste.selectedIndex].value).split("|")[25];
			document.getElementById('searchEnergyCommodity').value=(liste.options[liste.selectedIndex].value).split("|")[26];
			document.getElementById('searchFixingIndex').value=(liste.options[liste.selectedIndex].value).split("|")[27];
			document.getElementById('searchSettlementMethod').value=(liste.options[liste.selectedIndex].value).split("|")[28];
			document.getElementById('searchOrganisedMarketPlace').value=(liste.options[liste.selectedIndex].value).split("|")[29];
			document.getElementById('searchTradingHours1').value=((liste.options[liste.selectedIndex].value).split("|")[30]).split("/")[0];
			if ((liste.options[liste.selectedIndex].value).split("|")[30] != "") {
				
				var hh = (((liste.options[liste.selectedIndex].value).split("|")[30]).split("/")[0]).split(":")[0];
				var mm = (((liste.options[liste.selectedIndex].value).split("|")[30]).split("/")[0]).split(":")[1];
				var heure= hh+":"+mm;
				document.getElementById('searchTradingHours1').value=heure;
			}
			if ((liste.options[liste.selectedIndex].value).split("|")[30] != "") {
				
				var hh = (((liste.options[liste.selectedIndex].value).split("|")[30]).split("/")[1]).split(":")[0];
				var mm = (((liste.options[liste.selectedIndex].value).split("|")[30]).split("/")[1]).split(":")[1];
				var heure= hh+":"+mm;
				document.getElementById('searchTradingHours2').value=heure;
			}
			if ((liste.options[liste.selectedIndex].value).split("|")[31] != "") {
				document.getElementById('searchLastTraidingDate').value=((liste.options[liste.selectedIndex].value).split("|")[31]).split(" ")[0];
				var hh = (((liste.options[liste.selectedIndex].value).split("|")[31]).split(" ")[1]).split(":")[0];
				var mm = (((liste.options[liste.selectedIndex].value).split("|")[31]).split(" ")[1]).split(":")[1];
				var heure= hh+":"+mm;
				document.getElementById('searchLastTraidingTime').value=heure;
			}
			
			if ((liste.options[liste.selectedIndex].value).split("|")[32] != "") {
				document.getElementById('searchTransactionTimestampDate').value=((liste.options[liste.selectedIndex].value).split("|")[32]).split(" ")[0];
				var hh = (((liste.options[liste.selectedIndex].value).split("|")[32]).split(" ")[1]).split(":")[0];
				var mm = (((liste.options[liste.selectedIndex].value).split("|")[32]).split(" ")[1]).split(":")[1];
				var heure= hh+":"+mm;
				document.getElementById('searchTransactionTimestampTime').value=heure;
			}
			document.getElementById('searchUniqueTransactionID').value=(liste.options[liste.selectedIndex].value).split("|")[33];
			document.getElementById('searchLinkedTransactionID').value=(liste.options[liste.selectedIndex].value).split("|")[34];
			document.getElementById('searchLinkedOrderID').value=(liste.options[liste.selectedIndex].value).split("|")[35];
			document.getElementById('searchVoicebrokered').value=(liste.options[liste.selectedIndex].value).split("|")[36];
			document.getElementById('searchPrice').value=(liste.options[liste.selectedIndex].value).split("|")[37];
			document.getElementById('searchIndexValue').value=(liste.options[liste.selectedIndex].value).split("|")[38];
			document.getElementById('searchPriceCurrency').value=(liste.options[liste.selectedIndex].value).split("|")[39];
			document.getElementById('searchNotionalAmount').value=(liste.options[liste.selectedIndex].value).split("|")[40];
			document.getElementById('searchNotionalCurrency').value=(liste.options[liste.selectedIndex].value).split("|")[41];
			document.getElementById('searchQuantity').value=(liste.options[liste.selectedIndex].value).split("|")[42];
			document.getElementById('searchTotalNotionalContractQuantity').value=(liste.options[liste.selectedIndex].value).split("|")[43];
			document.getElementById('searchQuantityUnit').value=(liste.options[liste.selectedIndex].value).split("|")[44];
			document.getElementById('searchTotalNotionalContractQuantityUnit').value=(liste.options[liste.selectedIndex].value).split("|")[45];
			if ((liste.options[liste.selectedIndex].value).split("|")[46] != "") {
				document.getElementById('searchTerminationDate').value=((liste.options[liste.selectedIndex].value).split("|")[46]).split(" ")[0];

			}
			
			document.getElementById('searchOptionStyle').value=(liste.options[liste.selectedIndex].value).split("|")[47];
			document.getElementById('searchOptionType').value=(liste.options[liste.selectedIndex].value).split("|")[48];
			if ((liste.options[liste.selectedIndex].value).split("|")[49] != "") {
				document.getElementById('searchExerciseDate').value=((liste.options[liste.selectedIndex].value).split("|")[49]).split(" ")[0];

			}
			document.getElementById('searchStrikePrice').value=(liste.options[liste.selectedIndex].value).split("|")[50];
			
			document.getElementById('searchDeliveryPointName').value=(liste.options[liste.selectedIndex].value).split("|")[51];
			if ((liste.options[liste.selectedIndex].value).split("|")[52] != "") {
				document.getElementById('searchDeliveryStartDate').value=((liste.options[liste.selectedIndex].value).split("|")[52]).split(" ")[0];
			}
			if ((liste.options[liste.selectedIndex].value).split("|")[53] != "") {
				document.getElementById('searchDeliveryEndDate').value=((liste.options[liste.selectedIndex].value).split("|")[53]).split(" ")[0];

			}
			document.getElementById('searchDuration').value=(liste.options[liste.selectedIndex].value).split("|")[54];
			document.getElementById('searchLoadType').value=(liste.options[liste.selectedIndex].value).split("|")[55];
			document.getElementById('searchDaysOfTheWeek').value=(liste.options[liste.selectedIndex].value).split("|")[56];
			document.getElementById('searchLoadDeliveryIntervals').value=(liste.options[liste.selectedIndex].value).split("|")[57];
			document.getElementById('searchDeliveryCapacity').value=(liste.options[liste.selectedIndex].value).split("|")[58];
			document.getElementById('searchDeliveryCapacityUnit').value=(liste.options[liste.selectedIndex].value).split("|")[59];
			document.getElementById('searchPriceTimeIntervalsQuantity').value=(liste.options[liste.selectedIndex].value).split("|")[60];
			
			document.getElementById('searchActionType').value=(liste.options[liste.selectedIndex].value).split("|")[61];

			document.getElementById('searchMarketParticipant1').value=(liste.options[liste.selectedIndex].value).split("|")[63];
			document.getElementById('searchTrader').value=(liste.options[liste.selectedIndex].value).split("|")[64];
			document.getElementById('searchMarketParticipant2').value=(liste.options[liste.selectedIndex].value).split("|")[65];
			document.getElementById('searchReportingEntity').value=(liste.options[liste.selectedIndex].value).split("|")[66];
			document.getElementById('searchBeneficiary').value=(liste.options[liste.selectedIndex].value).split("|")[67];
			document.getElementById('searchParties').value=(liste.options[liste.selectedIndex].value).split("|")[68];
			document.getElementById('searchOrder').value=(liste.options[liste.selectedIndex].value).split("|")[69];
			document.getElementById('searchContract').value=(liste.options[liste.selectedIndex].value).split("|")[70];
			document.getElementById('searchTransaction').value=(liste.options[liste.selectedIndex].value).split("|")[71];
			document.getElementById('searchOption').value=(liste.options[liste.selectedIndex].value).split("|")[72];
			document.getElementById('searchDeliveryProfile').value=(liste.options[liste.selectedIndex].value).split("|")[73];
			document.getElementById('searchDeliveryPoint').value=(liste.options[liste.selectedIndex].value).split("|")[74];
			document.getElementById('searchBill').value=(liste.options[liste.selectedIndex].value).split("|")[75];
			document.getElementById('searchExecution').value=(liste.options[liste.selectedIndex].value).split("|")[76];
				
		}
	</script>


	<form class="well" id="formSearch"
		action="updateExecution.php" method="POST">

		<h3>Parties of the contract</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 1</span> <label
					for="searchMarketParticipant1ID">ID of the market participant 1 :
				</label> <input id="searchMarketParticipant1ID"
					name="searchMarketParticipant1ID" type="text" maxlength="12"
					class="form-control">
			</div>
			
			<div class="form-group col-lg-2"></div>
			
			<div class="form-group col-lg-4">
				<label
					for="searchMarketParticipant1Name">Name of the market participant 1 :
				</label> <input id="searchMarketParticipant1Name"
					name="searchMarketParticipant1Name" type="text" maxlength="250"
					class="form-control">
			</div>

		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 2</span> <label
					for="searchMarketParticipant1Type">Type of the market participant
					1 : </label> <select id="searchMarketParticipant1Type"
					name="searchMarketParticipant1Type[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
			
			<div class="form-group col-lg-2"></div>
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 3</span> <label for="searchTraderID">ID
					of the trader : </label> <input id="searchTraderID"
					name="searchTraderID" type="text" maxlength="20"
					class="form-control">
			</div>
			
		</div>
			
		<div class="container">
			
			<div class="form-group col-lg-4">
				<label for="searchBillID">ID of
					the bill : </label> <input id="searchBillID"
					name="searchBillID" type="text" maxlength="20"
					class="form-control">
			</div>
			
			<div class="form-group col-lg-2"></div>
			
			
			
		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 4</span> <label
					for="searchMarketParticipant2ID">ID of the market participant 2 :
				</label> <input id="searchMarketParticipant2ID"
					name="searchMarketParticipant2ID" type="text" maxlength="12"
					class="form-control">
			</div>
			
			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<label
					for="searchMarketParticipant2Name">Name of the market participant 2 :
				</label> <input id="searchMarketParticipant2Name"
					name="searchMarketParticipant2Name" type="text" maxlength="250"
					class="form-control">
			</div>

		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 5</span> <label
					for="searchMarketParticipant2Type">Type of the market participant
					2 : </label> <select id="searchMarketParticipant2Type"
					name="searchMarketParticipant2Type[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
			
			<div class="form-group col-lg-2"></div>
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 6</span> <label
					for="searchReportingEntityID">Reporting entity ID: </label> <input
					id="searchReportingEntityID" name="searchReportingEntityID"
					type="text" maxlength="12" class="form-control">
			</div>

		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 7</span> <label
					for="searchReportingEntityType">Type of the reporting entity : </label>
				<select id="searchReportingEntityType"
					name="searchReportingEntityType[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
			
			<div class="form-group col-lg-2"></div>
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 8</span> <label
					for="searchBeneficiaryID">Beneficiary ID : </label> <input
					id="searchBeneficiaryID" name="searchBeneficiaryID" type="text"
					maxlength="12" class="form-control">
			</div>

		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 9</span> <label
					for="searchBeneficiaryType">Type of the beneficiary : </label> <select
					id="searchBeneficiaryType" name="searchBeneficiaryType[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
			
			<div class="form-group col-lg-2"></div>
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 10</span> <label
					for="searchTradingCapacity">Trading capacity : </label> <select
					id="searchTradingCapacity" name="searchTradingCapacity[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_tradingcapacity" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

			
		<div class="container">

			<div class="form-group col-lg-4">
				<span class="badge">Field 11</span> <label
					for="searchBuySellIndicator">Buy/sell indicator : </label> <select
					id="searchBuySellIndicator" name="searchBuySellIndicator[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_buysellindicator" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 12</span> <label
					for="searchInitiatorAggressor">Initiator / Aggressor : </label> <select
					id="searchInitiatorAggressor" name="searchInitiatorAggressor[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_initiatoraggressor" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>


		<h3>Order details</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 13</span> <label for="searchOrderID">Order
					ID : </label> <input id="searchOrderID" name="searchOrderID"
					type="text" maxlength="100" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 14</span> <label for="searchOrderType">Order
					Type : </label> <select id="searchOrderType"
					name="searchOrderType[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_ordertype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 15</span> <label
					for="searchOrderCondition">Order Condition : </label> <select
					id="searchOrderCondition" name="searchOrderCondition[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_ordercondition" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 16</span> <label for="searchOrderStatus">Order
					Status : </label> <select id="searchOrderStatus"
					name="searchOrderStatus[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_orderstatus" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>


		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 17</span> <label
					for="searchMinimumExecutionVolume">Minimum Execution Volume : </label>
				<input id="searchMinimumExecutionVolume"
					name="searchMinimumExecutionVolume" type="number" step="0.01"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 18</span> <label for="searchPriceLimit">Price
					Limit : </label> <input id="searchPriceLimit"
					name="searchPriceLimit" type="number" step="0.00001"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 19</span> <label
					for="searchUndisclosedVolume">Undisclosed Volume : </label> <input
					id="searchUndisclosedVolume" name="searchUndisclosedVolume"
					type="number" step="0.00001" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 20</span> <label
					for="searchOrderDuration">Order Duration : </label> <select
					id="searchOrderDuration" name="searchOrderDuration[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_orderduration" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>


		<h3 id="titlecontractDetails">Contract details</h3>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 21</span> <label for="searchContractID">Contract
					ID : </label> <input id="searchContractID"
					name="searchContractID" type="text" maxlength="50"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 22</span> <label
					for="searchContractName">Contract Name : </label> <input
					id="searchContractName" name="searchContractName" type="text"
					maxlength="200" class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 23</span> <label
					for="searchContractType">Contract Type : </label> <select
					id="searchContractType" name="searchContractType[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_contracttype" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 24</span> <label
					for="searchEnergyCommodity">Energy commodity : </label> <select
					id="searchEnergyCommodity" name="searchEnergyCommodity[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_energycommodity" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>


		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 25</span> <label for="searchFixingIndex">Fixing
					Index : </label> <input id="searchFixingIndex"
					name="searchFixingIndex" type="text" maxlength="150"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 26</span> <label
					for="searchSettlementMethod">Settlement Method : </label> <select
					id="searchSettlementMethod" name="searchSettlementMethod[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_settlementmethod" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 27</span> <label
					for="searchOrganisedMarketPlace">Organised Market Place : </label>
				<select id="searchOrganisedMarketPlace"
					name="searchOrganisedMarketPlace[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_organisedmarketplace" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 28</span> <label
					for="searchTradingHours1">TradingHours 1 : </label> <input
					id="searchTradingHours1" name="searchTradingHours1" type="time"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 28'</span> <label
					for="searchTradingHours2">TradingHours 2 : </label> <input
					id="searchTradingHours2" name="searchTradingHours2" type="time"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 29</span> <label
					for="searchLastTraidingDate">Last Traiding Date : </label> <input
					id="searchLastTraidingDate" name="searchLastTraidingDate"
					type="date" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 29'</span> <label
					for="searchLastTraidingTime">Last Traiding Time : </label> <input
					id="searchLastTraidingTime" name="searchLastTraidingTime"
					type="time" class="form-control">
			</div>
		</div>


		<h3>Transaction details</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 30</span> <label
					for="searchTransactionTimestampDate">Transaction timestamp date :
				</label> <input id="searchTransactionTimestampDate"
					name="searchTransactionTimestampDate" type="date"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 30'</span> <label
					for="searchTransactionTimestampTime">Transaction timestamp time :
				</label> <input id="searchTransactionTimestampTime"
					name="searchTransactionTimestampTime" type="time"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 31</span> <label
					for="searchUniqueTransactionID">Unique Transaction ID : </label>
				<input id="searchUniqueTransactionID"
					name="searchUniqueTransactionID" type="text" maxlength="100"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 32</span> <label
					for="searchLinkedTransactionID">Linked Transaction ID : </label>
				<input id="searchLinkedTransactionID"
					name="searchLinkedTransactionID" type="text" maxlength="100"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 33</span> <label
					for="searchLinkedOrderID">Linked Order ID : </label> <input
					id="searchLinkedOrderID" name="searchLinkedOrderID" type="text"
					maxlength="100" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 34</span> <label
					for="searchVoicebrokered">Voice-brokered : </label> <select
					id="searchVoicebrokered" name="searchVoicebrokered[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_voicebrokered" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 35</span> <label for="searchPrice">Price
					: </label> <input id="searchPrice" name="searchPrice"
					type="number" step="0.00001" onfocusout="myScript()" class="form-control">
			</div>
			
			<div class="alert alert-block alert-danger col-lg-3" style="display: none" id="alertPrice">
			<button type="button" class="close">X</button>
				<h4>Error !</h4>
				Price incoherent ! Check fields 35, 38 and 41. Reminder: Price = Notional Amount / Total Notional Contract Quantity!
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 36</span> <label for="searchIndexValue">Index
					value : </label> <input id="searchIndexValue"
					name="searchIndexValue" type="number" step="0.00001"
					class="form-control">
			</div>
		</div>
		
	<script src="/REMIT/js/jquery.js"></script>
	<script>
		function myScript() {
		      if (($("#searchPrice").val().length < 1) || ($("#searchNotionalAmount").val().length < 1) || ($("#searchTotalNotionalContractQuantity").val().length < 1)) {
			        $("#alertPrice").show("slow").delay(4000).hide("slow");
			        return false;
			  }
		      if ($("#searchPrice").val() != ($("#searchNotionalAmount").val()/$("#searchTotalNotionalContractQuantity").val()).toFixed(5)) { //toFixed pour arrondir à 5 après virgule
			        $("#alertPrice").show("slow");
			        return false;
			  }
		}
		$(function (){
			$(".close").click(function() {
				$("#alertPrice").hide("slow");
			}); 
		}); 
	</script>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 37</span> <label
					for="searchPriceCurrency">Price currency : </label> <select
					id="searchPriceCurrency" name="searchPriceCurrency[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_currency" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 38</span> <label
					for="searchNotionalAmount">Notional Amount : </label> <input
					id="searchNotionalAmount" name="searchNotionalAmount"
					type="number" step="0.01" class="form-control">
			</div>
			
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 39</span> <label
					for="searchNotionalCurrency">Notional currency : </label> <select
					id="searchNotionalCurrency" name="searchNotionalCurrency[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_currency" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 40</span> <label for="searchQuantity">Quantity
					/ Volume : </label> <input id="searchQuantity"
					name="searchQuantity" type="number" step="0.00001"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 41</span> <label
					for="searchTotalNotionalContractQuantity">Total Notional Contract
					Quantity : </label> <input
					id="searchTotalNotionalContractQuantity"
					name="searchTotalNotionalContractQuantity" type="number"
					step="0.00001" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 42</span> <label
					for="searchQuantityUnit">Quantity Unit (field 40) : </label>
				<select id="searchQuantityUnit" name="searchQuantityUnit[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_quantityunit" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[1] . '  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
		
			<div class="form-group col-lg-4">
				<span class="badge">Field 42'</span> <label
					for="searchTotalNotionalContractQuantityUnit">Total Notional contract Quantity Unit (field 41) : </label>
				<select id="searchTotalNotionalContractQuantityUnit" name="searchTotalNotionalContractQuantityUnit[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_quantityunit" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[1] . '  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		
			<div class="form-group col-lg-2"></div>
			
			<div class="form-group col-lg-4">
				<span class="badge">Field 43</span> <label
					for="searchTerminationDate">Termination date : </label> <input
					id="searchTerminationDate" name="searchTerminationDate"
					type="date" class="form-control">
			</div>
		</div>

		<h3 id="titleOptionDetails">Option details</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 44</span> <label for="searchOptionStyle">Option
					Style : </label> <select id="searchOptionStyle"
					name="searchOptionStyle[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_optionstyle" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 45</span> <label for="searchOptionType">Option
					Type : </label> <select id="searchOptionType"
					name="searchOptionType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_optiontype" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 46</span> <label
					for="searchExerciseDate">Option Exercise date : </label> <input
					id="searchExerciseDate" name="searchExerciseDate" type="date"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 47</span> <label for="searchStrikePrice">Option
					Strike Price : </label> <input id="searchStrikePrice"
					name="searchStrikePrice" type="number" step="0.00001"
					class="form-control">
			</div>
		</div>

		<h3 id="titleDeliveryProfile">Delivery profile</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 48</span> <label
					for="searchDeliveryPointName">Delivery point or zone : </label> <input
					id="searchDeliveryPointName" name="searchDeliveryPointName"
					type="text" maxlength="16" class="form-control">
			</div>
			
			<div class="form-group col-lg-2"></div>
			
			<div class="form-group col-lg-4">
				<span class="badge">Field 49</span> <label
					for="searchDeliveryStartDate">Delivery start date : </label> <input
					id="searchDeliveryStartDate" name="searchDeliveryStartDate"
					type="date" class="form-control">
			</div>

			<div class="form-group col-lg-4"
				style="display: none">
				<input id="searchDeliveryPointWording"
					name="searchDeliveryPointWording" type="text" disabled="disabled"
					class="form-control">
			</div>
		</div>


		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 50</span> <label
					for="searchDeliveryEndDate">Delivery end date : </label> <input
					id="searchDeliveryEndDate" name="searchDeliveryEndDate"
					type="date" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>
			
			<div class="form-group col-lg-4">
				<span class="badge">Field 51</span> <label for="searchDuration">Duration
					: </label> <select id="searchDuration" name="searchDuration[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_deliveryduration" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 52</span> <label for="searchLoadType">Load
					type : </label> <select id="searchLoadType"
					name="searchLoadType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_loadtype" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 53</span> <label
					for="searchDaysOfTheWeek">Days of the week : </label> <select
					id="searchDaysOfTheWeek" name="searchDaysOfTheWeek[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_daysoftheweek" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 54</span> <label
					for="searchLoadDeliveryIntervals">Load Delivery Intervals : </label>
				<input id="searchLoadDeliveryIntervals"
					name="searchLoadDeliveryIntervals" type="text" maxlength="50"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 55</span> <label
					for="searchDeliveryCapacity">Delivery Capacity Price : </label> <input
					id="searchDeliveryCapacity" name="searchDeliveryCapacity"
					type="number" step="0.01" class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 56</span> <label
					for="searchDeliveryCapacityUnit">Delivery Capacity Unit : </label> <select
					id="searchDeliveryCapacityUnit" name="searchDeliveryCapacityUnit[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_quantityunit" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[1] . '  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 57</span> <label
					for="searchPriceTimeIntervalsQuantity">Price/Time Intervals
					Quantity : </label> <input id="searchPriceTimeIntervalsQuantity"
					name="searchPriceTimeIntervalsQuantity" type="number" step="0.00001"
					class="form-control">
			</div>
		</div>

		<h3 id="titleLifeCycleInformation">Life cycle information</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 58</span> <label for="searchActionType">Action
					type : </label> <select id="searchActionType"
					name="searchActionType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM e_actiontype" ); //requête
						while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
						}
					}
					else{
						echo "Impossible de se connecter à la base de données";
					}
					?>
				</select>
			</div>
		</div>
		

		<div style="display: none">
			<input id="searchMarketParticipant1"
				name="searchMarketParticipant1" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchTrader"
				name="searchTrader" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchMarketParticipant2"
				name="searchMarketParticipant2" type="text" maxlength="20"
				class="form-control">
		</div>

		<div style="display: none">
			<input id="searchReportingEntity"
				name="searchReportingEntity" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchBeneficiary"
				name="searchBeneficiary" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchParties"
				name="searchParties" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchOrder"
				name="searchOrder" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchContract"
				name="searchContract" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchTransaction"
				name="searchTransaction" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchOption"
				name="searchOption" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchDeliveryProfile"
				name="searchDeliveryProfile" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchDeliveryPoint"
				name="searchDeliveryPoint" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchBill"
				name="searchBill" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div style="display: none">
			<input id="searchExecution"
				name="searchExecution" type="text" maxlength="20"
				class="form-control">
		</div>

		<input type="submit" class="btn btn-success pull-right"
			value="Record execution"> <input onclick="window.print()"
			type="button" id="button-imprimer" value="Imprimer" />

	</form>

	<script src="/REMIT/js/jquery.js"></script>

</body>
</html>
