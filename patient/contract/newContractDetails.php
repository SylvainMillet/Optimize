<h3 style="display: none" id="titlecontractDetails">contract details</h3>

<form class="well" style="display: none" id="formcontractDetails">
	<legend>Capture of the contract details</legend>
	<div class="container">
		<div class="form-groupcontractID col-lg-4">
			<span class="badge">Field 11</span> <label for="contractID">contract ID : </label> <input id="contractID" type="text"
				maxlength="100" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertcontractIDHelp">
			<button type="button" class="close">X</button>
			<h4>Info</h4>
			Max 100 !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="affichercontractIDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#affichercontractIDHelp").click(function() {$("#affichercontractIDHelp").hide();
						$("#alertcontractIDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertcontractIDHelp").hide("slow");
						$("#affichercontractIDHelp").show();
					}); 
				}); 
			</script>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertcontractIDLength">
			<h4>Error !</h4>
			Vous devez entrer au max 100 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formcontractDetails").on("submit", function() {
			      if($("#contractID").val().length > 100) {
			        $("div.form-groupcontractID").addClass("has-error");
			        $("#alertcontractIDLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 12</span> <label for="contractDate">contract
				Date : </label> <input id="contractDate" type="date"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 13</span> <label for="contractType">contract Type : </label> <select id="contractType" class="form-control">
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
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 14</span> <label for="energyCommodity">Energy
				commodity : </label> <select id="energyCommodity"
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
			<span class="badge">Field 15</span> <label for="priceFormula">Price
				formula : </label> <textarea id="priceFormula" cols="50" rows="5"
				class="form-control"></textarea>
		</div>

		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 15'</span> <label for="price">Price : </label>
			<input id="price" type="number" step="0.01" class="form-control">
		</div>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertPrice">
			<h4>Error !</h4>
			Price or price formula necessary !
		</div>

		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertPriceHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est limite a 1000 pour une formula or 20 for a
			decimal !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary" id="afficherPriceHelp"
				value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherPriceHelp").click(function() {$("#afficherPriceHelp").hide();
						$("#alertPriceHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertPriceHelp").hide("slow");
						$("#afficherPriceHelp").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-groupEstimatedNotionalAmount col-lg-4">
			<span class="badge">Field 16</span> <label
				for="estimatedNotionalAmount">Estimated Notional Amount : </label> <input
				id="estimatedNotionalAmount" type="number" step="0.01" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertEstimatedNotionalAmountHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est lim !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherEstimatedNotionalAmountHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherEstimatedNotionalAmountHelp").click(function() {$("#afficherEstimatedNotionalAmountHelp").hide();
						$("#alertEstimatedNotionalAmountHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertEstimatedNotionalAmountHelp").hide("slow");
						$("#afficherEstimatedNotionalAmountHelp").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 17</span> <label for="notionalCurrency">Notional
				Currency : </label> <select id="notionalCurrency"
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
				for="totalNotionalcontractQuantity">Total Notional contract Quantity
				: </label> <input id="totalNotionalcontractQuantity" type="number"
				step="0.01" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertTotalNotionalcontractQuantityHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est lim !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherTotalNotionalcontractQuantityHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherTotalNotionalcontractQuantityHelp").click(function() {$("#afficherTotalNotionalcontractQuantityHelp").hide();
						$("#alertTotalNotionalcontractQuantityHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertTotalNotionalcontractQuantityHelp").hide("slow");
						$("#afficherTotalNotionalcontractQuantityHelp").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-groupVolumeOptionalityCapacity col-lg-4">
			<span class="badge">Field 19</span> <label
				for="volumeOptionalityCapacity">Volume Optionality Capacity : </label>
			<input id="volumeOptionalityCapacity" type="number" step="0.01"
				class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertVolumeOptionalityCapacityHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est lim !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherVolumeOptionalityCapacityHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherVolumeOptionalityCapacityHelp").click(function() {$("#afficherVolumeOptionalityCapacityHelp").hide();
						$("#alertVolumeOptionalityCapacityHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertVolumeOptionalityCapacityHelp").hide("slow");
						$("#afficherVolumeOptionalityCapacityHelp").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 20</span> <label for="notionalQuantityUnit">Notional
				Quantity Unit (field 18) : </label> <select id="notionalQuantityUnit"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM c_quantityunit" ); // requête
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
{
						echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
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
			<span class="badge">Field 20'</span> <label for="volumeOptionalityCapacityUnit">Volume Optionality Capacity Unit (field 19) : </label> <select id="volumeOptionalityCapacityUnit"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM c_quantityunit" ); // requête
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
{
						echo '<option value="' . $row[1] . '">' . $row[1] . '</option>';
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
			<span class="badge">Field 21</span> <label for="volumeOptionality">Volume
				Optionality : </label> <select id="volumeOptionality"
				class="form-control">
				<option value=null></option>
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
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 22</span> <label
				for="volumeOptionalityFrequency">Volume Optionality Frequency : </label>
			<select id="volumeOptionalityFrequency" class="form-control">
				<option value=null></option>
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
				for="volumeOptionalityIntervalsBegin">Volume Optionality Intervals
				begin : </label> <input id="volumeOptionalityIntervalsBegin"
				type="date" class="form-control">
		</div>
		<div class="form-group col-lg-4">
			<label for="volumeOptionalityIntervalsEnd">Volume Optionality
				Intervals end : </label> <input id="volumeOptionalityIntervalsEnd"
				type="date" class="form-control">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backParties").click(function() {
				$("#formcontractDetails").hide("slow");
			    $("#titlecontractDetails").hide("slow");
			    $("#formTradingCapacity").show("slow");
			    $("#titleParties").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" id="launchFixingIndexTable" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backParties" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formcontractDetails").on("submit", function() {

	      if(($("#contractID").val().length > 4)&&($("#priceFormula").val().length > 0)||($("#price").val().length > 0)) {
	        $("#formcontractDetails").hide("slow");
	        $("#titlecontractDetails").hide("slow");
	        $("#formFixingIndexDetails").show("slow");
	        $("#titleFixingIndexDetails").show("slow");
	        return false;
	      }
	      else if(($("#priceFormula").val().length < 1)||($("#price").val().length < 1)){
	    	  $("div.form-groupPrice").addClass("has-error");
		      $("#alertPrice").show("slow").delay(4000).hide("slow");
		      return false;
		  }
	    });
	  });
	</script>
