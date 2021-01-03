<h3 style="display: none" id="titleOptionDetails">Option details</h3>

<form class="well" style="display: none" id="formOptionDetails">
	<legend>Capture of the option details</legend>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 44</span> <label for="optionStyle">Option
				Style : </label> <select id="optionStyle" class="form-control">
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
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 45</span> <label for="optionType">Option
				Type : </label> <select id="optionType" class="form-control">
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
			<span class="badge">Field 46</span> <label for="exerciseDate">Option Exercise date : </label> <input id="exerciseDate" type="date"
				class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-groupStrikePrice col-lg-4">
			<span class="badge">Field 47</span> <label for="strikePrice">Option Strike
				Price : </label> <input id="strikePrice" type="number" step="0.01"
				class="form-control">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backFixingIndex").click(function() {
				$("#formOptionDetails").hide("slow");
			    $("#titleOptionDetails").hide("slow");
			    $("#formTransaction").show("slow");
			    $("#titleTransaction").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backFixingIndex" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formOptionDetails").on("submit", function() {

	        $("#formOptionDetails").hide("slow");
	        $("#titleOptionDetails").hide("slow");
	        $("#formDeliveryPoint").show("slow");
	        $("#titleDeliveryProfile").show("slow");
	        return false;
	      
	    });
	  });
	</script>
