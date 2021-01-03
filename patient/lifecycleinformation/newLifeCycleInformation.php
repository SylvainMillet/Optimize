<h3 style="display: none" id="titleLifeCycleInformation">Life cycle
	information</h3>

<form class="well" style="display: none" id="formActionType">
	<legend>Capture of the action type</legend>
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 45</span> <label for="actionType">Action
				type : </label> <select id="actionType" class="form-control">
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
			$("#backDeliveryProfile").click(function() {
				$("#formActionType").hide("slow");
			    $("#titleLifeCycleInformation").hide("slow");
			    $("#formLoadType").show("slow");
			    $("#titleDeliveryProfile").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backDeliveryProfile" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formActionType").on("submit", function() {
	      if($("#actionType").val().length > 0) {
	        $("#formActionType").hide("slow");
	        return false;
	      }
	    });
	  });
	</script>
<script>
	  $(function(){
	    $("#formActionType").on("submit", function() {

	        $("#formActionType").hide("slow");
	        $("#titleLifeCycleInformation").hide("slow");
	        loadOverview();
	        return false;
	      
	    });
	  });
	</script>