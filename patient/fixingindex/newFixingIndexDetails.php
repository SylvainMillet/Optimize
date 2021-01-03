<h3 style="display: none" id="titleFixingIndexDetails">Fixing Index
	details</h3>

<form class="well" style="display: none" id="formFixingIndexDetails">
	<legend>Capture of the fixing index details</legend>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 24</span> <label for="typeOfIndexPrice">Type
				of index price : </label> <select id="typeOfIndexPrice" name="typeOfIndexPrice"
				class="form-control">
				<option value=null></option>
				<?php
				if($cnx){
					$query= pg_query( $cnx, "SELECT * FROM c_typeofindexprice" ); //requete
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
		<div class="form-groupFixingIndex col-lg-4">
			<span class="badge">Field 25</span> <label for="fixingIndex">Fixing
				Index : </label> <input id="fixingIndex" name="fixingIndex" type="text" maxlength="150"
				class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertFixingIndexHelp">
			<button type="button" class="close">X</button>
			<h4>Info</h4>
			Max 150 !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherFixingIndexHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherFixingIndexHelp").click(function() {$("#afficherFixingIndexHelp").hide();
						$("#alertFixingIndexHelp").show("slow");
						document.getElementById('fixingIndex').value=document.getElementById('contractID').value;
					}); 
	    			$(".close").click(function() {
						$("#alertFixingIndexHelp").hide("slow");
						$("#afficherFixingIndexHelp").show();
					}); 
				}); 
			</script>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertFixingIndexLength">
			<h4>Error !</h4>
			Vous devez entrer au max 150 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formFixingIndexDetails").on("submit", function() {
			      if($("#fixingIndex").val().length > 150) {
			        $("div.form-groupFixingIndex").addClass("has-error");
			        $("#alertFixingIndexLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 26</span> <label for="fixingIndexTypes">Fixing
				Index Types : </label> <select id="fixingIndexTypes" name="fixingIndexTypes"
				class="form-control">
				<option value=null></option>
				<?php
				if($cnx){
					$query= pg_query( $cnx, "SELECT * FROM c_fxingindextypes" ); //requete
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
		<div class="form-groupFixingIndexSources col-lg-4">
			<span class="badge">Field 27</span> <label for="fixingIndexSources">Fixing
				Index Sources : </label> <input id="fixingIndexSources" name="fixingIndexSources" type="text"
				maxlength="100" class="form-control">
		</div>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertFixingIndexSourcesLength">
			<h4>Error !</h4>
			Vous devez entrer au max 100 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formFixingIndexDetails").on("submit", function() {
			      if($("#fixingIndexSources").val().length > 100) {
			        $("div.form-groupFixingIndexSources").addClass("has-error");
			        $("#alertFixingIndexSourcesLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 28</span> <label for="firstFixingDate">First
				fixing date : </label> <input id="firstFixingDate" name="firstFixingDate" type="date"
				class="form-control">
		</div>
		<div class="form-group col-lg-4">
			<span class="badge">Field 29</span> <label for="lastFixingDate">Last
				fixing date : </label> <input id="lastFixingDate" name="lastFixingDate" type="date"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 30</span> <label for="fixingFrequency">Fixing
				Frequency : </label> <select id="fixingFrequency" name="fixingFrequency"
				class="form-control">
				<option value=null></option>
				<?php
				if($cnx){
					$query= pg_query( $cnx, "SELECT * FROM c_frequency" ); //requete
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
			<span class="badge">Field 31</span> <label for="settlementMethod">Settlement
				Method : </label> <select id="settlementMethod" name="settlementMethod" class="form-control">
				<option value=null></option>
				<?php
				if($cnx){
					$query= pg_query( $cnx, "SELECT * FROM c_settlementmethod" ); //requete
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
		<div class="form-group col-lg-12">
			<table id="fixingIndexTable">
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

	<button type="reset" class="btn btn-warning pull-left">Erase</button>

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backcontract").click(function() {
				$("#formFixingIndexDetails").hide("slow");
			    $("#titleFixingIndexDetails").hide("slow");
			    $("#formcontractDetails").show("slow");
			    $("#titlecontractDetails").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input
		type="button" class="btn btn-primary pull-right" id="backcontract"
		value="Back">

	<button type="button" class="btn btn-success pull-right" onclick="insertFixingIndexTable()">Save and add</button>

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	function insertFixingIndexTable() {
		typeOfIndexPrice = document.getElementById("typeOfIndexPrice");
		fixingIndexTypes = document.getElementById("fixingIndexTypes");
		fixingFrequency = document.getElementById("fixingFrequency");
		settlementMethod = document.getElementById("settlementMethod");
	    var table = document.getElementById("fixingIndexTable");
	    var row = table.insertRow(1);
	    var cell0 = row.insertCell(0);
	    var cell1 = row.insertCell(1);
	    var cell2 = row.insertCell(2);
	    var cell3 = row.insertCell(3);
	    var cell4 = row.insertCell(4);
	    var cell5 = row.insertCell(5);
	    var cell6 = row.insertCell(6);
	    var cell7 = row.insertCell(7);
	    cell0.innerHTML = typeOfIndexPrice[typeOfIndexPrice.selectedIndex].text;
	    cell1.innerHTML = document.getElementById('fixingIndex').value;
	    cell2.innerHTML = fixingIndexTypes[fixingIndexTypes.selectedIndex].text;
	    cell3.innerHTML = document.getElementById('fixingIndexSources').value;
	    cell4.innerHTML = document.getElementById('firstFixingDate').value;
	    cell5.innerHTML = document.getElementById('lastFixingDate').value;
	    cell6.innerHTML = fixingFrequency[fixingFrequency.selectedIndex].text;
	    cell7.innerHTML = settlementMethod[settlementMethod.selectedIndex].text;
	
	    var table2 = document.getElementById("overviewFixingIndexTable");
	    var row = table2.insertRow(1);
	    var cell0 = row.insertCell(0);
	    var cell1 = row.insertCell(1);
	    var cell2 = row.insertCell(2);
	    var cell3 = row.insertCell(3);
	    var cell4 = row.insertCell(4);
	    var cell5 = row.insertCell(5);
	    var cell6 = row.insertCell(6);
	    var cell7 = row.insertCell(7);
	    cell0.innerHTML = typeOfIndexPrice[typeOfIndexPrice.selectedIndex].text;
	    cell1.innerHTML = document.getElementById('fixingIndex').value;
	    cell2.innerHTML = fixingIndexTypes[fixingIndexTypes.selectedIndex].text;
	    cell3.innerHTML = document.getElementById('fixingIndexSources').value;
	    cell4.innerHTML = document.getElementById('firstFixingDate').value;
	    cell5.innerHTML = document.getElementById('lastFixingDate').value;
	    cell6.innerHTML = fixingFrequency[fixingFrequency.selectedIndex].text;
	    cell7.innerHTML = settlementMethod[settlementMethod.selectedIndex].text;

	    var arrayFixingIndex = [document.getElementById('typeOfIndexPrice').value, document.getElementById('fixingIndex').value, document.getElementById('fixingIndexTypes').value,
	                            document.getElementById('fixingIndexSources').value, document.getElementById('firstFixingDate').value, document.getElementById('lastFixingDate').value,
	                            document.getElementById('fixingFrequency').value, document.getElementById('settlementMethod').value]; 
	    var arrayFixingIndexString = arrayFixingIndex.join('|');

		$.ajax({
			type : "POST",
			url : "insertcontractFixingIndex.php",
			data : {
				"typeOfIndexPrice" : document.getElementById('typeOfIndexPrice').value,
				"fixingIndex" : document.getElementById('fixingIndex').value,
				"fixingIndexTypes" : document.getElementById('fixingIndexTypes').value,
				"fixingIndexSources" : document.getElementById('fixingIndexSources').value,
				"firstFixingDate" : document.getElementById('firstFixingDate').value,
				"lastFixingDate" : document.getElementById('lastFixingDate').value,
				"fixingFrequency" : document.getElementById('fixingFrequency').value,
				"settlementMethod" : document.getElementById('settlementMethod').value
			},
			//("form#formFixingIndexDetails").serialize(),
			async : false,
			cache : false,
			success : function(msg) {
				if (msg != '') {
					data = msg;
					console.log (data);
				}
			},
			error : function(msg, ajaxOptions, thrownError) {
				alert("Une erreur est survenue !");
				/*alert(msg.status);
				 alert(msg.responseText);
				 alert(thrownError);*/
			}
		});

	}

</script>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formFixingIndexDetails").on("submit", function() {
	        $("#formFixingIndexDetails").hide("slow");
	        $("#titleFixingIndexDetails").hide("slow");
	        $("#tableFixingIndexDetails").hide("slow");
	        $("#formOptionDetails").show("slow");
	        $("#titleOptionDetails").show("slow");
	        return false;
	    });
	  });
	</script>
