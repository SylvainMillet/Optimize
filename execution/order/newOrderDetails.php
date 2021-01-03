<h3 style="display: none" id="titleOrderDetails">Order details</h3>

<form class="well" style="display: none" id="formOrderDetails">
	<legend>Capture of the order details</legend>
	<div class="container">
		<div class="form-groupOrderID col-lg-4">
			<span class="badge">Field 13</span> <label for="orderID">Order ID : </label> <input id="orderID" type="text"
				maxlength="100" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertOrderIDHelp">
			<button type="button" class="close">X</button>
			<h4>Info</h4>
			Max 100 !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherOrderIDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherOrderIDHelp").click(function() {$("#afficherOrderIDHelp").hide();
						$("#alertOrderIDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertOrderIDHelp").hide("slow");
						$("#afficherOrderIDHelp").show();
					}); 
				}); 
			</script>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertOrderIDLength">
			<h4>Error !</h4>
			Vous devez entrer au max 100 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formOrderDetails").on("submit", function() {
			      if($("#orderID").val().length > 100) {
			        $("div.form-groupOrderID").addClass("has-error");
			        $("#alertOrderIDLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 14</span> <label for="orderType">Order Type : </label> <select id="orderType" class="form-control">
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
			<span class="badge">Field 15</span> <label for="orderCondition">Order Condition : </label> <select id="orderCondition"
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
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 16</span> <label for="orderStatus">Order Status : </label> <select id="orderStatus"
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
			<span class="badge">Field 17</span> <label for="minimumExecutionVolume">Minimum Execution Volume : </label>
			<input id="minimumExecutionVolume" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 18</span> <label for="priceLimit">Price Limit : </label>
			<input id="priceLimit" type="number" step="0.01" class="form-control">
		</div>
	</div>
	
	<div class="container">
		<div class="form-groupPrice col-lg-4">
			<span class="badge">Field 19</span> <label for="undisclosedVolume">Undisclosed Volume : </label>
			<input id="undisclosedVolume" type="number" step="0.01" class="form-control">
		</div>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 20</span> <label for="orderDuration">Order Duration : </label> <select id="orderDuration"
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

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backParties").click(function() {
				$("#formOrderDetails").hide("slow");
			    $("#titleOrderDetails").hide("slow");
			    $("#formTradingCapacity").show("slow");
			    $("#titleParties").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backParties" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formOrderDetails").on("submit", function() {
	        $("#formOrderDetails").hide("slow");
	        $("#titleOrderDetails").hide("slow");
	        $("#formcontractDetails").show("slow");
	        $("#titlecontractDetails").show("slow");
	        return false;
	    });
	  });
	</script>
