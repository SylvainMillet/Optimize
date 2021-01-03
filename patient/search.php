
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>

<body>


	<!------------------------------------------------------------ navbar call -------------------------------------------------------------->
<?php
require 'connect.php';
include 'navbar_contract.php';
?>

	<h3 id="titleSearch">Search view</h3>
	
	<div class="container">
		<div class="form-group col-lg-4">
 			<span class="badge">Existing contract by ID bill</span> <select
 				onchange="loadcontract(this.value)"
 				id="existingcontract" class="form-control">
 				<option value=""></option>
				<?php
 					if ($cnx) {
 						$query = pg_query ( $cnx, "SELECT contract.contract_id, contract.contract_contract, c_parties.c_parties_marketparticipant1, 
 						c_parties.c_parties_marketparticipant2, c_parties.c_parties_reportingentity, c_parties.c_parties_beneficiary, 
 						c_parties.c_parties_tradingcapacity, c_parties.c_parties_buysellindicator, c_bill.c_bill_name, c_contract.c_contract_identifier, 
 						c_contract.c_contract_date, c_contract.c_contract_type, c_contract.c_contract_energycommodity, c_contract.c_contract_price, 
 						c_contract.c_contract_estimatednotionalamount, c_contract.c_contract_notionalcurrency, c_contract.c_contract_totalnotionalcontractquantity, 
 						c_contract.c_contract_volumeoptionalitycapacity, c_contract.c_contract_totalnotionalcontractquantityunit, c_contract.c_contract_volumeoptionalitycapacityunit, c_contract.c_contract_volumeoptionality, 
 						c_contract.c_contract_volumeoptionalityfrequency, c_contract.c_contract_volumeoptionalityintervals, c_deliverypoint.c_deliverypoint_identifier, 
 						c_deliveryprofile.c_deliveryprofile_deliverystartdate, c_deliveryprofile.c_deliveryprofile_deliveryenddate, 
 						c_deliveryprofile.c_deliveryprofile_loadtype, contract.contract_actiontype
 						FROM c_deliverypoint INNER JOIN (c_deliveryprofile INNER JOIN ((c_contract INNER JOIN c_bill ON c_contract.c_contract_id = c_bill.c_bill_contract) INNER JOIN (c_parties INNER JOIN contract ON c_parties.c_parties_id = contract.contract_Parties) ON c_contract.c_contract_id = contract.contract_contract) ON c_deliveryprofile.c_deliveryprofile_id = contract.contract_deliveryprofile) ON c_deliverypoint.c_deliverypoint_id = c_deliveryprofile.c_deliveryprofile_deliverypoint;
 						
 						
 						" ); // requête
 						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
 						{
 							echo '<option value="' . $row[0] .'|'. $row[1] .'|'. $row[2] .'|'. $row[3]
 							.'|'. $row[3] .'|'. $row[6] .'|' . odbc_result ( $query, 7 ) .'|'. odbc_result ( $query, 8 ) 
 							.'|'. odbc_result ( $query, 9 ) .'|'. odbc_result ( $query, 10 ) .'|'. odbc_result ( $query, 11 ) .'|'. odbc_result ( $query, 12 ) 
 							.'|'. odbc_result ( $query, 13 ) .'|'. odbc_result ( $query, 14 ) .'|'. odbc_result ( $query, 15 ) .'|'. odbc_result ( $query, 16 ) 
 							.'|'. odbc_result ( $query, 17 ) .'|'. odbc_result ( $query, 18 ) .'|'. odbc_result ( $query, 19 ) .'|'. odbc_result ( $query, 20 ) 
 							.'|'. odbc_result ( $query, 21 ) .'|'. odbc_result ( $query, 22 ) .'|'. odbc_result ( $query, 23 ) .'|'. odbc_result ( $query, 24 )
 							.'|'. odbc_result ( $query, 25 ) .'|'. odbc_result ( $query, 26 ) .'|'. odbc_result ( $query, 27 ) .'|'. odbc_result ( $query, 28 )
 							. '">' . odbc_result ( $query, 9 ).' </option>';
 						}
 					} else {
 						echo "Impossible de se connecter à  la base de données";
 					}
 				?>
 			</select>
		</div>
		</div>
		
	<script src="/REMIT/js/jquery.js"></script>
	<script type="text/javascript">
		function loadcontract(valeur)
		{
			liste = document.getElementById('existingcontract');
			document.getElementById('searchMarketParticipant1ID').value=(liste.options[liste.selectedIndex].value).split("|")[0];
			document.getElementById('searchMarketParticipant1Name').value=liste.options[liste.selectedIndex].text;
			document.getElementById('searchBillID').value=(liste.options[liste.selectedIndex].value).split("|")[8];
			document.getElementById('searchMarketParticipant2ID').value=(liste.options[liste.selectedIndex].value).split("|")[0];
			document.getElementById('searchMarketParticipant2Name').value=(liste.options[liste.selectedIndex].value).split("|")[1];
			document.getElementById('searchTradingCapacity').value=(liste.options[liste.selectedIndex].value).split("|")[6];
			document.getElementById('searchBuySellIndicator').value=(liste.options[liste.selectedIndex].value).split("|")[7];
			document.getElementById('searchcontractID').value=(liste.options[liste.selectedIndex].value).split("|")[9];
			document.getElementById('searchcontractDate').value=(liste.options[liste.selectedIndex].value).split("|")[10];
			document.getElementById('searchcontractType').value=(liste.options[liste.selectedIndex].value).split("|")[11];
			document.getElementById('searchEnergyCommodity').value=(liste.options[liste.selectedIndex].value).split("|")[12];
			//document.getElementById('searchPrice').value=(liste.options[liste.selectedIndex].value).split("|")[13];
			document.getElementById('searchEstimatedNotionalAmount').value=(liste.options[liste.selectedIndex].value).split("|")[14];
			document.getElementById('searchNotionalCurrency').value=(liste.options[liste.selectedIndex].value).split("|")[15];
			document.getElementById('searchTotalNotionalcontractQuantity').value=(liste.options[liste.selectedIndex].value).split("|")[16];
			document.getElementById('searchVolumeOptionalityCapacity').value=(liste.options[liste.selectedIndex].value).split("|")[17];
			document.getElementById('searchNotionalQuantityUnit').value=(liste.options[liste.selectedIndex].value).split("|")[18];
			document.getElementById('searchVolumeOptionalityCapacityUnit').value=(liste.options[liste.selectedIndex].value).split("|")[19];
			document.getElementById('searchVolumeOptionality').value=(liste.options[liste.selectedIndex].value).split("|")[20];
			document.getElementById('searchVolumeOptionalityFrequency').value=(liste.options[liste.selectedIndex].value).split("|")[21];
			document.getElementById('searchVolumeOptionalityIntervalsBegin').value=(liste.options[liste.selectedIndex].value).split("|")[22];
			document.getElementById('searchDeliveryPointName').value=(liste.options[liste.selectedIndex].value).split("|")[23];
			document.getElementById('searchDeliveryStartDate').value=(liste.options[liste.selectedIndex].value).split("|")[24];
			document.getElementById('searchDeliveryEndDate').value=(liste.options[liste.selectedIndex].value).split("|")[25];
			document.getElementById('searchLoadType').value=(liste.options[liste.selectedIndex].value).split("|")[26];
			document.getElementById('searchActionType').value=(liste.options[liste.selectedIndex].value).split("|")[27];
				
		}
	</script>


	<form class="well" id="formSearch"
		action="updatecontract.php" method="POST">

		<h3 id="titleParties">Parties of the contract</h3>
		
		<div class="container">
			<div class="form-groupMarketParticipant1ID col-lg-4">
				<span class="badge">Field 1</span> <label
					for="searchMarketParticipant1ID">ID of the market participant 1 :
				</label> <input id="searchMarketParticipant1ID"
					name="searchMarketParticipant1ID" type="text" maxlength="10"
					class="form-control">
			</div>

			<div class="form-groupMarketParticipant1Name col-lg-4"
				style="display: none">
				<input id="searchMarketParticipant1Name"
					name="searchMarketParticipant1Name" type="text"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 2</span> <label
					for="searchMarketParticipant1Type">Type of the market participant
					1 : </label> <select id="searchMarketParticipant1Type"
					name="searchMarketParticipant1Type[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_entitytype" ); //requête
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
		
			<div class="form-groupBillID col-lg-4">
				<span class="badge">Bill</span> <label for="searchBillID">ID of
					the bill : </label> <input id="searchBillID"
					name="searchBillID" type="text" maxlength="20"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-groupMarketParticipant2ID col-lg-4">
				<span class="badge">Field 3</span> <label
					for="searchMarketParticipant2ID">ID of the market participant 2 :
				</label> <input id="searchMarketParticipant2ID"
					name="searchMarketParticipant2ID" type="text" maxlength="10"
					class="form-control">
			</div>

			<div class="form-groupMarketParticipant2Name col-lg-4"
				style="display: none">
				<input id="searchMarketParticipant2Name"
					name="searchMarketParticipant2Name" type="text"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 4</span> <label
					for="searchMarketParticipant2Type">Type of the market participant
					2 : </label> <select id="searchMarketParticipant2Type"
					name="searchMarketParticipant2Type[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_entitytype" ); //requête
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
			<div class="form-groupReportingEntity col-lg-4">
				<span class="badge">Field 5</span> <label
					for="searchReportingEntityID">Reporting entity ID: </label> <input
					id="searchReportingEntityID" name="searchReportingEntityID"
					type="text" maxlength="10" class="form-control">
			</div>

			<div class="form-groupReportingEntityName col-lg-4"
				style="display: none">
				<input id="searchReportingEntityName"
					name="searchReportingEntityName" type="text" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 6</span> <label
					for="searchReportingEntityType">Type of the reporting entity : </label>
				<select id="searchReportingEntityType"
					name="searchReportingEntityType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_entitytype" ); //requête
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
			<div class="form-groupBeneficiary col-lg-4">
				<span class="badge">Field 7</span> <label
					for="searchBeneficiaryID">ID of the beneficiary : </label> <input
					id="searchBeneficiaryID" name="searchBeneficiaryID" type="text"
					maxlength="10" class="form-control">
			</div>

			<div class="form-groupBeneficiaryName col-lg-4" style="display: none">
				<input id="searchBeneficiaryName" name="searchBeneficiaryName"
					type="text" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 8</span> <label
					for="searchBeneficiaryType">Beneficiary Type: </label> <select
					id="searchBeneficiaryType" name="searchBeneficiaryType[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_entitytype" ); //requête
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
				<span class="badge">Field 9</span> <label
					for="searchTradingCapacity">Trading capacity : </label> <select
					id="searchTradingCapacity" name="searchTradingCapacity[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_tradingcapacity" ); //requête
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
				<span class="badge">Field 10</span> <label
					for="searchBuySellIndicator">Buy/sell indicator : </label> <select
					id="searchBuySellIndicator" name="searchBuySellIndicator[]"
					class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_buysellindicator" ); //requête
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

		<h3 id="titlecontractDetails">contract details</h3>

		<div class="container">
			<div class="form-groupcontractID col-lg-4">
				<span class="badge">Field 11</span> <label for="searchcontractID">contract
					ID : </label> <input id="searchcontractID"
					name="searchcontractID" type="text" maxlength="100"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 12</span> <label
					for="searchcontractDate">contract Date : </label> <input
					id="searchcontractDate" name="searchcontractDate" type="date"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 13</span> <label
					for="searchcontractType">contract Type : </label> <select
					id="searchcontractType" name="searchcontractType"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_contracttype" ); // requête
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
				<span class="badge">Field 14</span> <label
					for="searchEnergyCommodity">Energy commodity : </label> <select
					id="searchEnergyCommodity" name="searchEnergyCommodity[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_energycommodity" ); // requête
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
			<div class="form-groupPriceFormula col-lg-4">
				<span class="badge">Field 15</span> <label
					for="searchPriceFormula">Price formula : </label>
				<textarea id="searchPriceFormula" name="searchPriceFormula"
					cols="50" rows="5" class="form-control"></textarea>
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-groupPrice col-lg-4">
				<span class="badge">Field 15'</span> <label for="searchPrice">Price
					: </label> <input id="searchPrice" name="searchPrice"
					type="number" step="0.01" class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-groupEstimatedNotionalAmount col-lg-4">
				<span class="badge">Field 16</span> <label
					for="searchEstimatedNotionalAmount">Estimated Notional Amount : </label>
				<input id="searchEstimatedNotionalAmount"
					name="searchEstimatedNotionalAmount" type="text"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 17</span> <label
					for="searchNotionalCurrency">Notional Currency : </label> <select
					id="searchNotionalCurrency" name="searchNotionalCurrency[]"
					class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_currency" ); // requête
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
			<div class="form-groupTotalNotionalcontractQuantity col-lg-4">
				<span class="badge">Field 18</span> <label
					for="searchTotalNotionalcontractQuantity">Total Notional contract
					Quantity : </label> <input
					id="searchTotalNotionalcontractQuantity"
					name="searchTotalNotionalcontractQuantity" type="number"
					step="0.01" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-groupVolumeOptionalityCapacity col-lg-4">
				<span class="badge">Field 19</span> <label
					for="searchVolumeOptionalityCapacity">Volume Optionality Capacity
					: </label> <input id="searchVolumeOptionalityCapacity"
					name="searchVolumeOptionalityCapacity" type="text" maxLength="20"
					class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 20</span> <label
					for="searchNotionalQuantityUnit">Notional Quantity Unit : </label>
				<select id="searchNotionalQuantityUnit"
					name="searchNotionalQuantityUnit[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_quantityunit" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
					?>
				</select>
			</div>

			<div class="form-group col-lg-2"></div>
			
			<div class="form-group col-lg-4">
				<span class="badge">Field 20'</span> <label
					for="searchVolumeOptionalityCapacityUnit">Volume Optionality Capacity Unit (19) : </label>
				<select id="searchVolumeOptionalityCapacityUnit"
					name="searchVolumeOptionalityCapacityUnit[]" class="form-control">
					<option value=null></option>
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_quantityunit" ); // requête
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
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
				<span class="badge">Field 21</span> <label
					for="searchVolumeOptionality">Volume Optionality : </label> <select
					id="searchVolumeOptionality" name="searchVolumeOptionality[]"
					class="form-control">
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_volumeoptionality" ); // requête
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
				<span class="badge">Field 22</span> <label
					for="searchVolumeOptionalityFrequency">Volume Optionality
					Frequency : </label> <select
					id="searchVolumeOptionalityFrequency"
					name="searchVolumeOptionalityFrequency[]" class="form-control">
					<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM c_frequency" ); // requête
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
				<span class="badge">Field 23</span> <label
					for="searchVolumeOptionalityIntervalsBegin">Volume Optionality
					Intervals begin : </label> <input
					id="searchVolumeOptionalityIntervalsBegin"
					name="searchVolumeOptionalityIntervalsBegin" type="date"
					class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<label for="searchVolumeOptionalityIntervalsEnd">Volume
					Optionality Intervals end : </label> <input
					id="searchVolumeOptionalityIntervalsEnd"
					name="searchVolumeOptionalityIntervalsEnd" type="date"
					class="form-control">
			</div>
		</div>

		<h3 id="titleFixingIndexDetails">Fixing Index details</h3>

		<div class="container">
			<div class="form-group col-lg-12">
				<table id="searchFixingIndexTable"
					name="searchFixingIndexTable[]">
					<tr>
						<th>Type of index price</th>
						<th>Fixing Index</th>
						<th>Fixing Index Types</th>
						<th>Fixing Index Sources</th>
						<th>First fixing date</th>
						<th>Last fixing date</th>
						<th>Fixing Frequency</th>
						<th>Settlement Method</th>
					</tr>
				</table>
			</div>
		</div>



		<h3 id="titleOptionDetails">Option details</h3>

		<div class="container">
			<div class="form-group col-lg-12">
				<table id="searchOptionTable" name="searchOptionTable[]">
					<tr>
						<th>Option Style</th>
						<th>Option Type</th>
						<th>Option First Exercise date</th>
						<th>Option Last Exercise date</th>
						<th>Option Exercise Frequency</th>
						<th>Option Stike Index</th>
						<th>Option Strike Index Type</th>
						<th>Option Strike Index Source</th>
						<th>Option Strike Price</th>
					</tr>
				</table>
			</div>
		</div>

		<h3 id="titleDeliveryProfile">Delivery profile</h3>

		<div class="container">
			<div class="form-groupDeliveryPointName col-lg-4">
				<span class="badge">Field 41</span> <label
					for="searchDeliveryPointName">Delivery point or zone : </label> <input
					id="searchDeliveryPointName" name="searchDeliveryPointName"
					type="text" maxlength="16" class="form-control">
			</div>

			<div class="form-groupDeliveryPointWording col-lg-4"
				style="display: none">
				<input id="searchDeliveryPointWording"
					name="searchDeliveryPointWording" type="text"
					class="form-control">
			</div>
		</div>


		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 42</span> <label
					for="searchDeliveryStartDate">Delivery start date : </label> <input
					id="searchDeliveryStartDate" name="searchDeliveryStartDate"
					type="date" class="form-control">
			</div>

			<div class="form-group col-lg-2"></div>

			<div class="form-group col-lg-4">
				<span class="badge">Field 43</span> <label
					for="searchDeliveryEndDate">Delivery end date : </label> <input
					id="searchDeliveryEndDate" name="searchDeliveryEndDate"
					type="date" class="form-control">
			</div>
		</div>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 44</span> <label for="searchLoadType">Load
					type : </label> <select id="searchLoadType"
					name="searchLoadType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_loadtype" ); //requête
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


		<h3 id="titleLifeCycleInformation">Life cycle information</h3>

		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 45</span> <label for="searchActionType">Action
					type : </label> <select id="searchActionType"
					name="searchActionType[]" class="form-control">
					<option value=null></option>
					<?php
					if($cnx){
						$query= pg_query( $cnx, "SELECT * FROM c_actiontype" ); //requête
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

		<input type="submit" class="btn btn-success pull-right"
			value="Save changes contract">
		<input onclick="window.print()"
			type="button" id="button-imprimer" value="Imprimer" />

	</form>

	<script src="/REMIT/js/jquery.js"></script>

</body>
</html>
