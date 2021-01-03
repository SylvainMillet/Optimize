<!-- <form class="well" style="display: none" id="formPatient" action="insertPatient.php" method="POST"> -->
<form class="well" style="display: none" id="formPatient">
	<legend>Saisie d'un patient</legend>

	<h3 id="titleParties">Informations générales</h3>

	<div class="container">

		<div class="form-group col-lg-4">
			<label
				for="PatientSexe">Sexe du patient :
			</label>
			<select id="PatientSexe" class="form-control">
				<?php
				if ($cnx) {

					$query = 'SHOW COLUMNS FROM Patient LIKE \'sexe\';';
					$res = mysqli_query($cnx, $query) or die($db_message);
					$tab = mysqli_fetch_object($res);
					$type = substr( $tab->Type, 5, -2);
					$liste_sexe = explode( "','", $type );

					//affichage de la liste
					//echo '<select name="list_sexe" size="1" />';
					for( $i=0; $i<count($liste_sexe); $i++ ){
						echo '<option value=\"'.$i.'\">'.$liste_sexe[$i].'</option>';
					}
					echo '</select>';
					
				} else {
					echo "Impossible de se connecter �  la base de donn�es";
				}
				?>
			</select>
		</div>

		<div class="form-groupPatientNom col-lg-4">
			<label for="PatientNom">Nom *</label>
		<input
			id="PatientNom" type="text" maxlength="60" required	class="form-control">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
				
			    $("#formPatient").on("submit", function() {
			      if($("#PatientNom").val().length < 3) {
			        $("div.form-groupPatientNom").addClass("has-error");
			        $("#alertPatientNomLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertPatientNomHelp">
			<button type="button" class="close">X</button>
			<h4>Information</h4>
			Saisir le nom du patient.
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherPatientNomHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherPatientNomHelp").click(function() {$("#afficherPatientNomHelp").hide();
						$("#alertPatientNomHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertPatientNomHelp").hide("slow");
						$("#afficherPatientNomHelp").show();
					}); 
				}); 
			</script>


		<div class="form-group col-lg-4">
			<label for="PatientPrenom">Prénom *</label> <input id="PatientPrenom" type="text"
				maxlength="60" required class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientBirthdate">Date de naissance *</label> <input
				id="PatientBirthdate" type="date" required
				class="form-control">
		</div>

		<div class="form-group col-lg-3"></div>
		
		<div class="form-group col-lg-4">
			<label for="PatientAddress">Adresse *</label> <input
				id="PatientAddress" type="text" minlength="5" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientZipcode">Code postal *</label> <input
				id="PatientZipcode" type="text" minlength="5" maxlength="5" pattern="[0-9]{5}" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientCity">Ville *</label> <input
				id="PatientCity" type="text" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientPhone">Téléphone</label> <input
				id="PatientPhone" type="text" minlength="10" maxlength="10" pattern="[0-9]{10}"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientMail">Email</label> <input
				id="PatientMail" type="email" minlength="8" maxlength="50"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="PatientSocialSecurityNumber">Numéro de sécurité sociale *</label>
			<input
				id="PatientSocialSecurityNumber" type="text" minlength="15" maxlength="15" pattern="[0-9]{15}" required
				class="form-control">
		</div>

	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<input type="submit" class="btn btn-success pull-right" value="Next">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formPatient").on("submit", function() {
	      //if($("#AddressNom").val().length >= 2) {
	        $("#formPatient").hide("slow");
	        $("#formAddress").show("slow");
	        return false;
	      //}
	    });
	  });
</script>

</form>

<form class="well" style="display: none" id="formAddress">
	<legend>Saisie d'une adresse</legend>

	<h3 id="titleParties">Adresse du patient</h3>

	<div class="container">

		<div class="form-group col-lg-4">
			<label for="AddressAddress">Adresse *</label> <input
				id="AddressAddress" type="text" minlength="5" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressZipcode">Code postal *</label> <input
				id="AddressZipcode" type="text" minlength="5" maxlength="5" pattern="[0-9]{5}" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressCity">Ville *</label> <input
				id="AddressCity" type="text" maxlength="80" required
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressComments">Commentaires</label> <input
				id="AddressComments" type="text" maxlength="250"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressDoorCode1">Code porte 1</label>
			<input
				id="AddressDoorCode1" type="text" maxlength="10"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressDoorCode2">Code porte 2</label>
			<input
				id="AddressDoorCode2" type="text" maxlength="10"
				class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="AddressIntercom">Interphone</label>
			<input
				id="AddressIntercom" type="text" maxlength="80" class="form-control">
		</div>

	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<input type="submit" class="btn btn-success pull-right" value="Next">


	<script>
	  $(function(){
	    $("#formAddress").on("submit", function() {

	        $("#formAddress").hide("slow");
	        loadOverview();
	        return false;
	      
	    });
	  });
	</script>

	<!-- <script>
	  $(function(){
	    $("#formAddress").on("submit", function() {
	        $("#formAddress").hide("slow");
	        $("#formAgenda").show("slow");
	        return false;
	    });
	  });
	</script> -->

</form>

<!-- <form class="well" style="display: none" id="formAddress" action="insertAddress.php" method="POST"> -->
<!-- <form class="well" style="display: none" id="formAgenda">
	<legend>Saisie d'une adresse</legend>

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

</form> -->
<!-- 
<script>
	  $(function(){
	    $("#formAddress").on("submit", function() {

	        $("#formAddress").hide("slow");
	        loadOverview();
	        return false;
	      
	    });
	  });
	</script> -->