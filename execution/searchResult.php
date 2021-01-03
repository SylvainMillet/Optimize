
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

<h3 id="titleOverview">Overview</h3>

<form class="well" id="formOverview" action="insertExecution.php" method="POST">

	<h3>Parties of the contract</h3>

	<div class="container">
		<div class="form-groupMarketParticipant1ID col-lg-4">
			<span class="badge">Field 1</span> <label for="overviewMarketParticipant1ID">ID
				of the market participant 1 : </label> <input
				id="overviewMarketParticipant1ID" name="overviewMarketParticipant1ID" type="text" maxlength="10"
				class="form-control">
		</div>
		
		<div class="form-groupMarketParticipant1Name col-lg-4" style="display: none">
			<input id="overviewMarketParticipant1Name" name="overviewMarketParticipant1Name" type="text" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 2</span> <label
				for="overviewMarketParticipant1Type">Type of the market participant 1 : </label>
			<select id="overviewMarketParticipant1Type" name="overviewMarketParticipant1Type[]" class="form-control">
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
	</div>

	<div class="container">
		<div class="form-groupTraderID col-lg-4">
			<span class="badge">Field 3</span> <label for="overviewTraderID">ID
				of the trader : </label> <input
				id="overviewTraderID" name="overviewTraderID" type="text" maxlength="20"
				class="form-control">
		</div>
		
		<div class="form-group col-lg-2"></div>
		
		<div class="form-groupBillID col-lg-4">
			<span class="badge">Bill</span> <label for="overviewBillID">ID
				of the bill : </label> <input
				id="overviewBillID" name="overviewBillID" type="text" maxlength="20"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupMarketParticipant2ID col-lg-4">
			<span class="badge">Field 4</span> <label for="overviewMarketParticipant2ID">ID
				of the market participant 2 : </label> <input
				id="overviewMarketParticipant2ID" name="overviewMarketParticipant2ID" type="text" maxlength="10"
				class="form-control">
		</div>
		
		<div class="form-groupMarketParticipant2Name col-lg-4" style="display: none">
			<input id="overviewMarketParticipant2Name" name="overviewMarketParticipant2Name" type="text" disabled="disabled" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 5</span> <label
				for="overviewMarketParticipant2Type">Type of the market participant 2 : </label>
			<select id="overviewMarketParticipant2Type" name="overviewMarketParticipant2Type[]" class="form-control">
				<option value=null></option>
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
	</div>

	<div class="container">
		<div class="form-groupReportingEntity col-lg-4">
			<span class="badge">Field 6</span> <label for="overviewReportingEntityID">Reporting entity ID: </label> <input id="overviewReportingEntityID" name="overviewReportingEntityID"
				type="text" maxlength="10" class="form-control">
		</div>
		
		<div class="form-groupReportingEntityName col-lg-4" style="display: none">
			<input id="overviewReportingEntityName" name="overviewReportingEntityName" type="text" disabled="disabled" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 7</span> <label for="overviewReportingEntityType">Type
				of the reporting entity : </label> <select id="overviewReportingEntityType" name="overviewReportingEntityType[]"
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
	</div>

	<div class="container">
		<div class="form-groupBeneficiary col-lg-4">
			<span class="badge">Field 8</span> <label for="overviewBeneficiaryID">Beneficiary ID : </label> <input id="overviewBeneficiaryID" name="overviewBeneficiaryID" type="text"
				maxlength="10" class="form-control">
		</div>
		
		<div class="form-groupBeneficiaryName col-lg-4" style="display: none">
			<input id="overviewBeneficiaryName" name="overviewBeneficiaryName" type="text" disabled="disabled" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 9</span> <label for="overviewBeneficiaryType">Type
				of the beneficiary : </label> <select id="overviewBeneficiaryType" name="overviewBeneficiaryType[]"
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
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 10</span> <label for="overviewTradingCapacity">Trading capacity : </label> <select id="overviewTradingCapacity" name="overviewTradingCapacity[]"
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

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 11</span> <label for="overviewBuySellIndicator">Buy/sell indicator : </label> <select id="overviewBuySellIndicator" name="overviewBuySellIndicator[]"
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
			<span class="badge">Field 12</span> <label for="overviewInitiatorAggressor">Initiator / Aggressor : </label> <select id="overviewInitiatorAggressor" name="overviewInitiatorAggressor[]"
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
		<div class="form-groupOrderID col-lg-4">
			<span class="badge">Field 13</span> <label for="overviewOrderID">Order ID : </label> <input id="overviewOrderID" name="overviewOrderID" type="text"
				maxlength="100" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 14</span> <label for="overviewOrderType">Order Type : </label> <select id="overviewOrderType" name="overviewOrderType[]" class="form-control">
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
			<span class="badge">Field 15</span> <label for="overviewOrderCondition">Order Condition : </label> <select id="overviewOrderCondition" name="overviewOrderCondition[]"
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
			<span class="badge">Field 16</span> <label for="overviewOrderStatus">Order Status : </label> <select id="overviewOrderStatus" name="overviewOrderStatus[]"
				class="form-control">
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
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 17</span> <label for="overviewMinimumExecutionVolume">Minimum Execution Volume : </label>
			<input id="overviewMinimumExecutionVolume" name="overviewMinimumExecutionVolume" type="number" step="0.01" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 18</span> <label for="overviewPriceLimit">Price Limit : </label>
			<input id="overviewPriceLimit" name="overviewPriceLimit" type="number" step="0.01" class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 19</span> <label for="overviewUndisclosedVolume">Undisclosed Volume : </label>
			<input id="overviewUndisclosedVolume" name="overviewUndisclosedVolume" type="number" step="0.01" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 20</span> <label for="overviewOrderDuration">Order Duration : </label> <select id="overviewOrderDuration" name="overviewOrderDuration[]"
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
	

	<h3 id="titlecontractDetails">contract details</h3>

	<div class="container">
		<div class="form-groupcontractID col-lg-4">
			<span class="badge">Field 21</span> <label for="overviewcontractID">contract ID : </label> <input id="overviewcontractID" name="overviewcontractID" type="text"
				maxlength="50" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-groupcontractName col-lg-4">
			<span class="badge">Field 22</span> <label for="overviewcontractName">contract Name : </label> <input id="overviewcontractName" name="overviewcontractName" type="text"
				maxlength="200" class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 23</span> <label for="overviewcontractType">contract Type : </label> <select id="overviewcontractType" name="overviewcontractType[]" class="form-control">
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
			<span class="badge">Field 24</span> <label for="overviewEnergyCommodity">Energy
				commodity : </label> <select id="overviewEnergyCommodity" name="overviewEnergyCommodity[]"
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
			<span class="badge">Field 25</span> <label for="overviewFixingIndex">Fixing Index : </label> <input id="overviewFixingIndex" name="overviewFixingIndex" type="text"
				maxlength="150" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 26</span> <label for="overviewSettlementMethod">Settlement Method : </label> <select id="overviewSettlementMethod" name="overviewSettlementMethod[]"
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
			<span class="badge">Field 27</span> <label for="overviewOrganisedMarketPlace">Organised Market Place : </label> <select id="overviewOrganisedMarketPlace" name="overviewOrganisedMarketPlace[]"
				class="form-control">
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
		<div class="form-groupTradingHours col-lg-4">
			<span class="badge">Field 28</span> <label
				for="overviewTradingHours1">TradingHours 1 : </label>
			<input id="overviewTradingHours1" name="overviewTradingHours1" type="time"
				class="form-control">
		</div>
		
		<div class="form-group col-lg-2"></div>
		
		<div class="form-groupTradingHours col-lg-4">
			<span class="badge">Field 28'</span> <label
				for="overviewTradingHours2">TradingHours 2 : </label>
			<input id="overviewTradingHours2" name="overviewTradingHours2" type="time"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 29</span> <label
				for="overviewLastTraidingDate">Last Traiding Date : </label> <input id="overviewLastTraidingDate" named="overviewLastTraidingDate"
				type="date" class="form-control">
		</div>
		
		<div class="form-group col-lg-2"></div>
		
		<div class="form-group col-lg-4">
			<span class="badge">Field 29'</span> <label for="overviewLastTraidingTime">Last Traiding Time : </label> <input id="overviewLastTraidingTime" name="overviewLastTraidingTime" type="time"
				class="form-control">
		</div>
	</div>


	<h3>Transaction details</h3>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 30</span> <label for="overviewTransactionTimestampDate">Transaction timestamp date : </label> <input id="overviewTransactionTimestampDate" name="overviewTransactionTimestampDate" type="date"
				class="form-control">
		</div>
		
		<div class="form-group col-lg-2"></div>
		
		<div class="form-group col-lg-4">
			<span class="badge">Field 30'</span> <label for="overviewTransactionTimestampTime">Transaction timestamp time : </label> <input id="overviewTransactionTimestampTime" name="overviewTransactionTimestampTime" type="time"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 31</span> <label for="overviewUniqueTransactionID">Unique Transaction ID : </label> <input id="overviewUniqueTransactionID" name="overviewUniqueTransactionID" type="text" maxlength="100"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 32</span> <label for="overviewLinkedTransactionID">Linked Transaction ID : </label> <input id="overviewLinkedTransactionID" name="overviewLinkedTransactionID" type="text" maxlength="100"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 33</span> <label for="overviewLinkedOrderID">Linked Order ID : </label> <input id="overviewLinkedOrderID" name="overviewLinkedOrderID" type="text" maxlength="100"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 34</span> <label for="overviewVoicebrokered">Voice-brokered : </label> <select id="overviewVoicebrokered" name="overviewVoicebrokered[]"
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
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 35</span> <label for="overviewPrice">Price : </label>
			<input id="overviewPrice" name="overviewPrice" type="number" step="0.01" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 36</span> <label for="overviewIndexValue">Index value : </label>
			<input id="overviewIndexValue" name="overviewIndexValue" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 37</span> <label for="overviewPriceCurrency">Price currency : </label> <select id="overviewPriceCurrency" name="overviewPriceCurrency[]"
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

		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 38</span> <label for="overviewNotionalAmount">Notional Amount : </label>
			<input id="overviewNotionalAmount" name="overviewNotionalAmount" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 39</span> <label for="overviewNotionalCurrency">Notional currency : </label> <select id="overviewNotionalCurrency" name="overviewNotionalCurrency[]"
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

		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 40</span> <label for="overviewQuantity">Quantity / Volume : </label>
			<input id="overviewQuantity" name="overviewQuantity" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 41</span> <label for="overviewTotalNotionalcontractQuantity">Total Notional contract Quantity : </label>
			<input id="overviewTotalNotionalcontractQuantity" name="overviewTotalNotionalcontractQuantity" type="number" step="0.01" class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 42</span> <label for="overviewDeliveryCapacityUnit">Total Notional contract Quantity Unit: </label> <select id="overviewDeliveryCapacityUnit" name="overviewDeliveryCapacityUnit[]"
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
			<span class="badge">Field 43</span> <label for="overviewTerminationDate">Termination date : </label> <input id="overviewTerminationDate" name="overviewTerminationDate" type="date"
				class="form-control">
		</div>
	</div>

	<h3 id="titleOptionDetails">Option details</h3>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 44</span> <label for="overviewOptionStyle">Option
				Style : </label> <select id="overviewOptionStyle" name="overviewOptionStyle[]" class="form-control">
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
			<span class="badge">Field 45</span> <label for="overviewOptionType">Option
				Type : </label> <select id="overviewOptionType" name="overviewOptionType[]" class="form-control">
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
			<span class="badge">Field 46</span> <label for="overviewExerciseDate">Option Exercise date : </label> <input id="overviewExerciseDate"  name="overviewExerciseDate" type="date"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-groupStrikePrice col-lg-4">
			<span class="badge">Field 47</span> <label for="overviewStrikePrice">Option Strike
				Price : </label> <input id="overviewStrikePrice" name="overviewStrikePrice" type="number" step="0.01"
				class="form-control">
		</div>
	</div>

	<h3 id="titleDeliveryProfile">Delivery profile</h3>

	<div class="container">
		<div class="form-groupDeliveryPointName col-lg-4">
			<span class="badge">Field 48</span>
			<label for="overviewDeliveryPointName">Delivery point or zone : </label>
			<input id="overviewDeliveryPointName" name="overviewDeliveryPointName" type="text" maxlength="16" class="form-control">
		</div>
		
		<div class="form-groupDeliveryPointWording col-lg-4" style="display: none">
			<input id="overviewDeliveryPointWording" name="overviewDeliveryPointWording" type="text" disabled="disabled" class="form-control">
		</div>
	</div>


	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 49</span>
			<label for="overviewDeliveryStartDate">Delivery start date : </label> <input id="overviewDeliveryStartDate" name="overviewDeliveryStartDate" type="date"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 50</span>
			<label for="overviewDeliveryEndDate">Delivery end date : </label> <input id="overviewDeliveryEndDate" name="overviewDeliveryEndDate" type="date"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 51</span> <label for="overviewDuration">Duration : </label> <select id="overviewDuration" name="overviewDuration[]" class="form-control">
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

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 52</span>
			<label for="overviewLoadType">Load type : </label>
			<select id="overviewLoadType" name="overviewLoadType[]"
				class="form-control">
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
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
				<span class="badge">Field 53</span>
				<label for="overviewDaysOfTheWeek">Days of the week : </label>
				<select id="overviewDaysOfTheWeek" name="overviewDaysOfTheWeek[]"
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

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 54</span>
			<label for="overviewLoadDeliveryIntervals">Load Delivery Intervals : </label>
			<input id="overviewLoadDeliveryIntervals" name="overviewLoadDeliveryIntervals" type="text" maxlength="50" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 55</span> <label for="overviewDeliveryCapacity">Delivery Capacity
				Price : </label> <input id="overviewDeliveryCapacity" name="overviewDeliveryCapacity"  type="number" step="0.01"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>

		<div class="form-group col-lg-4">
			<span class="badge">Field 56</span>
			<label for="overviewDeliveryCapacityUnit">Delivery Capacity Unit : </label>
			<select id="overviewDeliveryCapacityUnit" name="overviewDeliveryCapacityUnit[]"
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
			<span class="badge">Field 57</span> <label for="overviewPriceTimeIntervalsQuantity">Price/Time Intervals Quantity : </label> <input id="overviewPriceTimeIntervalsQuantity" name="overviewPriceTimeIntervalsQuantity" type="number" step="0.01"
				class="form-control">
		</div>
	</div>


	<h3 id="titleLifeCycleInformation">Life cycle information</h3>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 58</span> <label for="overviewActionType">Action
				type : </label> <select id="overviewActionType" name="overviewActionType[]" class="form-control">
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

	<input type="submit" class="btn btn-success pull-right" value="Record execution">
	
	<input onclick="window.print()" type="button" id="button-imprimer" value="Imprimer" /> 

</form>

<script src="/REMIT/js/jquery.js"></script>

</body>
</html>