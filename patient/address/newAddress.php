<form class="well" style="display: none" id="formAddress" action="insertAddress.php" method="POST">
	<legend>Saisie d'un patient</legend>

	<h3 id="titleParties">Adresse du patient</h3>

	<div class="container">

		<div class="form-group col-lg-4">
			<label for="address">Adresse *</label> <input
				id="address" type="text" minlength="5" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="zipcode">Code postal *</label> <input
				id="zipcode" type="text" minlength="5" maxlength="5" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="city">Ville *</label> <input
				id="city" type="text" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="comments">Commentaires</label> <input
				id="comments" type="text" maxlength="250"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="doorCode1">Code porte 1 *</label>
			<input
				id="doorCode1" type="text" maxlength="10"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="doorCode2">Code porte 2 *</label>
			<input
				id="doorCode2" type="text" maxlength="10"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="intercom">Code porte 2 *</label>
			<input
				id="intercom" type="text" maxlength="80"
				class="form-control">
		</div>

	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<input type="submit" class="btn btn-success pull-right" value="Next">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formAddress").on("submit", function() {
	      //if($("#AddressNom").val().length >= 2) {
	        $("#formPatient").hide("slow");
	        $("#formAddress").show("slow");
	        return false;
	      //}
	    });
	  });
	</script>

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formAddress").on("submit", function() {
	      if($("#AddressNom").val().length >= 2) {
	        $("#formAddress").hide("slow");
	        $("#formReportingEntity").show("slow");
	        return false;
	      }
	    });
	  });
	</script>