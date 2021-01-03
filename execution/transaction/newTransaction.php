<h3 style="display: none" id="titleTransaction">Transaction
	details</h3>

<form class="well" style="display: none" id="formTransaction">
	<legend>Capture of the transaction details</legend>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 30</span> <label for="transactionTimestampDate">Transaction timestamp date : </label> <input id="transactionTimestampDate" type="date"
				class="form-control">
		</div>
		<div class="form-group col-lg-4">
			<span class="badge">Field 30'</span> <label for="transactionTimestampTime">Transaction timestamp time : </label> <input id="transactionTimestampTime" type="time"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 31</span> <label for="uniqueTransactionID">Unique Transaction ID : </label> <input id="uniqueTransactionID" type="text" maxlength="100"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 32</span> <label for="linkedTransactionID">Linked Transaction ID : </label> <input id="linkedTransactionID" type="text" maxlength="100"
				class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 33</span> <label for="linkedOrderID">Linked Order ID : </label> <input id="linkedOrderID" type="text" maxlength="100"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 34</span> <label for="voicebrokered">Voice-brokered : </label> <select id="voicebrokered"
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
			<span class="badge">Field 35</span> <label for="price">Price : </label>
			<input id="price" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 36</span> <label for="indexValue">Index value : </label>
			<input id="indexValue" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 37</span> <label for="priceCurrency">Price currency : </label> <select id="priceCurrency"
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
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 38</span> <label for="notionalAmount">Notional Amount : </label>
			<input id="notionalAmount" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 39</span> <label for="notionalCurrency">Notional currency : </label> <select id="notionalCurrency"
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
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 40</span> <label for="quantity">Quantity / Volume : </label>
			<input id="quantity" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 41</span> <label for="totalNotionalcontractQuantity">Total Notional contract Quantity : </label>
			<input id="totalNotionalcontractQuantity" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 42</span> <label for="quantityUnit">Quantity Unit (field 40) : </label> <select id="quantityUnit"
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
			<span class="badge">Field 42'</span> <label for="totalNotionalcontractQuantityUnit">Total Notional contract Quantity Unit (field 41) : </label> <select id="totalNotionalcontractQuantityUnit"
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
			<span class="badge">Field 43</span> <label for="terminationDate">Termination date : </label> <input id="terminationDate" type="date"
				class="form-control">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backcontract").click(function() {
				$("#formTransaction").hide("slow");
			    $("#titleTransaction").hide("slow");
			    $("#formcontractDetails").show("slow");
			    $("#titlecontractDetails").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next"> <input
		type="button" class="btn btn-primary pull-right" id="backcontract"
		value="Back">
</form>


<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formTransaction").on("submit", function() {
	        $("#formTransaction").hide("slow");
	        $("#titleTransaction").hide("slow");
	        $("#formOptionDetails").show("slow");
	        $("#titleOptionDetails").show("slow");
	        return false;
	    });
	  });
	</script>
