<h3 style="display: none" id="titleDeliveryProfile">Delivery profile</h3>

	<form class="well" style="display: none" id="formDeliveryPoint">
		<legend>Capture of the Delivery Point</legend>
		<div class="container">
			<div class="form-groupDeliveryPointName col-lg-4">
				<span class="badge">Field 41</span>
				<label for="deliveryPointName">Delivery point or zone : </label>
				<input id="deliveryPointName" type="text" maxlength="16" class="form-control">
			</div>
			
			<div class="alert alert-block alert-danger col-lg-3" style="display: none" id="alertDeliveryPointNameLength">
				<h4>Error !</h4>
				Vous devez entrer 16 caracteres !
			</div>
			
			<script src="/REMIT/js/jquery.js"></script>
			<script>
			  $(function(){
			    $("#formDeliveryPoint").on("submit", function() {
			      if($("#deliveryPointName").val().length < 16) {
			        $("div.form-groupDeliveryPointName").addClass("has-error");
			        $("#alertDeliveryPointNameLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>	
	
			<div class="alert alert-warning col-lg-3" style="display: none" id="alertDeliveryPointNameHelp">
				<button type="button" class="close">X</button>
				<h4>Attention!</h4>
				Le nombre de carateres est fixe a 16.
			</div>
			<div class="col-lg-1">
				<input type="button" class="btn btn-primary" id="afficherDeliveryPointNameHelp"
					value="Help">
			</div>
	
			<script src="/REMIT/js/jquery.js"></script>
			<script>  
				$(function (){
					$("#afficherDeliveryPointNameHelp").click(function() {$("#afficherDeliveryPointNameHelp").hide();
						$("#alertDeliveryPointNameHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertDeliveryPointNameHelp").hide("slow");
						$("#afficherDeliveryPointNameHelp").show();
					}); 
				}); 
			</script>
			<div class="form-group col-lg-2">
			</div>
			<div class="form-group col-lg-4">
				<span class="badge">Existing Delivery point</span>
				<select id="existingDeliveryPoint"
					class="form-control">
					<option value=null></option>
					<option value="1">Delivery point 1</option>
					<option value="2">Delivery point 2</option>
				</select>
			</div>
			
		</div>
		
		<div class="container">
			<div class="form-group col-lg-4">
				<label for="deliveryPointWording">Delivery point wording : </label> <input id="deliveryPointWording" type="text" maxlength="150"
					class="form-control">
			</div>
	
			<div class="alert alert-warning col-lg-4" style="display: none" id="alertDeliveryPointWording">
				<button type="button" class="close">x</button>
				<h4>Attention!</h4>
				Cette information sert a retrouver plus facilement le DeliveryPoint. Cette information n'est pas envoyee.
			</div>
			<div class="col-lg-1">
				<input type="button" class="btn btn-primary" id="afficherDeliveryPointWording"
					value="Help">
			</div>
			
			<script src="/REMIT/js/jquery.js"></script>
			<script>  
				$(function (){
					$("#afficherDeliveryPointWording").click(function() {$("#afficherDeliveryPointWording").hide();
						$("#alertDeliveryPointWording").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertDeliveryPointWording").hide("slow");
						$("#afficherDeliveryPointWording").show();
					}); 
				}); 
			</script>
		</div>
		
		<button type="reset" class="btn btn-warning pull-left">Erase</button>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
			$(function (){
				$("#backOption").click(function() {
					$("#formDeliveryPoint").hide("slow");
				    $("#titleDeliveryProfile").hide("slow");
				    $("#formOptionDetails").show("slow");
				    $("#titleOptionDetails").show("slow");
				    return false;
				}); 
			}); 
		</script>

		<input type="submit" class="btn btn-success pull-right" value="Next">
		<input type="button" class="btn btn-primary pull-right"
			id="backOption" value="Back">

	</form>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>
	  $(function(){
	    $("#formDeliveryPoint").on("submit", function() {
	      if($("#deliveryPointName").val().length == 16) {
	        $("#formDeliveryPoint").hide("slow");
	        $("#formDeliveryDate").show("slow");
	        return false;
	      }
	    });
	  });
	</script>
	
	<form class="well" style="display: none" id="formDeliveryDate">
		<legend>Capture of the delivery dates</legend>
			<div class="container">
				<div class="form-group col-lg-4">
					<span class="badge">Field 42</span>
					<label for="deliveryStartDate">Delivery start date : </label> <input id="deliveryStartDate" type="date"
						class="form-control">
				</div>
				<div class="form-group col-lg-4">
					<span class="badge">Field 43</span>
					<label for="deliveryEndDate">Delivery end date : </label> <input id="deliveryEndDate" type="date"
						class="form-control">
				</div>
			</div>
			
		<button type="reset" class="btn btn-warning pull-left">Erase</button>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
			$(function (){
				$("#backDeliveryPoint").click(function() {
					$("#formDeliveryDate").hide("slow");
				    $("#formDeliveryPoint").show("slow");
				    return false;
				}); 
			}); 
		</script>

		<input type="submit" class="btn btn-success pull-right" value="Next">
		<input type="button" class="btn btn-primary pull-right"
			id="backDeliveryPoint" value="Back">

	</form>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>
	  $(function(){
	    $("#formDeliveryDate").on("submit", function() {
	        $("#formDeliveryDate").hide("slow");
	        $("#formLoadType").show("slow");
	        return false;
	    });
	  });
	</script>
	
	<form class="well" style="display: none" id="formLoadType">
		<legend>Capture of the delivery profile load type</legend>
		<div class="container">
			<div class="form-group col-lg-4">
				<span class="badge">Field 44</span>
				<label for="loadType">Load type : </label>
				<select id="loadType"
					class="form-control">
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
		
		<button type="reset" class="btn btn-warning pull-left">Erase</button>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
			$(function (){
				$("#backDeliveryDate").click(function() {
					$("#formLoadType").hide("slow");
				    $("#formDeliveryDate").show("slow");
				    return false;
				}); 
			}); 
		</script>
	
		<input type="submit" class="btn btn-success pull-right" value="Next">
		<input type="button" class="btn btn-primary pull-right"
			id="backDeliveryDate" value="Back">

	</form>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>
	  $(function(){
	    $("#formLoadType").on("submit", function() {

	        $("#formLoadType").hide("slow");
	        $("#titleDeliveryProfile").hide("slow");
	        $("#formActionType").show("slow");
	        $("#titleLifeCycleInformation").show("slow");
	        return false;
	      
	    });
	  });
	</script>