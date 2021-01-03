<script src="/REMIT/js/jquery.js"></script>
<script type="text/javascript">
	function loadOverview()
	{
		var e = document.getElementById("PatientSexe");
		document.getElementById('overviewPatientSexe').value  = e.options[e.selectedIndex].text;
		document.getElementById('overviewPatientNom').value = document.getElementById('PatientNom').value;
		document.getElementById('overviewPatientPrenom').value = document.getElementById('PatientPrenom').value;
		document.getElementById('overviewPatientBirthdate').value = document.getElementById('PatientBirthdate').value;
		document.getElementById('overviewPatientAddress').value = document.getElementById('PatientAddress').value;
		document.getElementById('overviewPatientZipcode').value = document.getElementById('PatientZipcode').value;
		document.getElementById('overviewPatientCity').value = document.getElementById('PatientCity').value;
		document.getElementById('overviewPatientPhone').value = document.getElementById('PatientPhone').value;
		document.getElementById('overviewPatientMail').value = document.getElementById('PatientMail').value;
		document.getElementById('overviewPatientSocialSecurityNumber').value = document.getElementById('PatientSocialSecurityNumber').value;
	
		document.getElementById('overviewAddressAddress').value = document.getElementById('AddressAddress').value;
		document.getElementById('overviewAddressZipcode').value = document.getElementById('AddressZipcode').value;
		document.getElementById('overviewAddressCity').value = document.getElementById('AddressCity').value;
		document.getElementById('overviewAddressComments').value = document.getElementById('AddressComments').value;
		document.getElementById('overviewAddressDoorCode1').value = document.getElementById('AddressDoorCode1').value;
		document.getElementById('overviewAddressDoorCode2').value = document.getElementById('AddressDoorCode2').value;
		document.getElementById('overviewAddressIntercom').value = document.getElementById('AddressIntercom').value;


        $("#titleOverview").show("slow");
		$("#formOverview").show("slow");
        return false;
	}

</script>

<script type="text/javascript">
	$(function() {
	  $("input:disabled").closest("div").click(function() {
	    $(this).find("input:disabled").attr("disabled", false).focus();
	  });
	  $("select:disabled").closest("div").click(function() {
		$(this).find("select:disabled").attr("disabled", false).focus();
	  });
	});
</script>

<h3 style="display: none" id="titleOverview">Patient</h3>

<form class="well" style="display: none" id="formOverview" action="insertPatient.php" method="POST">

	<h3 id="titlePatient">Récapitulatif du patient</h3>

	<div class="container">
		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientSexe">Sexe :
			</label> <input id="overviewPatientSexe" name="overviewPatientSexe" type="text" readonly
				 class="form-control">
		</div>
		
		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientNom">Nom :
			</label> <input id="overviewPatientNom" name="overviewPatientNom" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientPrenom">Prénom :
			</label> <input id="overviewPatientPrenom" name="overviewPatientPrenom" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientBirthdate">Date de naissance :
			</label> <input id="overviewPatientBirthdate" name="overviewPatientBirthdate" type="date" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientAddress">Adresse :
			</label> <input id="overviewPatientAddress" name="overviewPatientAddress" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientZipcode">Code postal :
			</label> <input id="overviewPatientZipcode" name="overviewPatientZipcode" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientCity">Ville :
			</label> <input id="overviewPatientCity" name="overviewPatientCity" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientPhone">Téléphone :
			</label> <input id="overviewPatientPhone" name="overviewPatientPhone" type="text" pattern="[0-9]{10}"
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientMail">Email :
			</label> <input id="overviewPatientMail" name="overviewPatientMail" type="email" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewPatientSocialSecurityNumber">Numéro de sécurité sociale :
			</label> <input id="overviewPatientSocialSecurityNumber" name="overviewPatientSocialSecurityNumber" type="text" 
				 class="form-control">
		</div>

		<h3 id="titleAddress">Adresse de visite du patient</h3>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressAddress">Adresse de visite :
			</label> <input id="overviewAddressAddress" name="overviewAddressAddress" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressZipcode">Adresse code postal :
			</label> <input id="overviewAddressZipcode" name="overviewAddressZipcode" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressCity">Adresse ville :
			</label> <input id="overviewAddressCity" name="overviewAddressCity" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressComments">Commentaires :
			</label> <input id="overviewAddressComments" name="overviewAddressComments" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressDoorCode1">Code porte 2 :
			</label> <input id="overviewAddressDoorCode1" name="overviewAddressDoorCode1" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressDoorCode2">Code porte 2 :
			</label> <input id="overviewAddressDoorCode2" name="overviewAddressDoorCode2" type="text" 
				 class="form-control">
		</div>

		<div class="form-groupMarketParticipant1ID col-lg-4">
			<label
				for="overviewAddressIntercom">Interphone :
			</label> <input id="overviewAddressIntercom" name="overviewAddressIntercom" type="text" 
				 class="form-control">
		</div>

	</div>
	

		
	<input type="submit" class="btn btn-success pull-right" value="Enregistrer le patient">
	
	<input onclick="window.print()" type="button" id="button-imprimer" value="Imprimer" /> 

</form>

