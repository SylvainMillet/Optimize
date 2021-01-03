<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>

<body>


	<!------------------------------------------------------------ navbar call -------------------------------------------------------------->
<?php
require 'connect.php';
include 'navbar_patient.php';
?>
	<script src="/REMIT/js/jquery.js"></script>

	<h1>Patient</h1>




	<input type="button" class="btn btn-primary pull-right"	id="launchPatientForm" value="Formulaire de saisie">

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#launchPatientForm").click(function() {
				loadPatientForm();
			}); 
		}); 
	</script>

	<script type="text/javascript">
	function loadPatientForm()
	{
		$("#formPatient").show("slow");
        return false;
	}

</script>
	<!------------------------------------------------------------ form parties of the patient -------------------------------------------------------------->
<?php
include '../patient/patient/newPatient.php';
?>

	<!------------------------------------------------------------ overview  -------------------------------------------------------------->
<?php
include 'overview.php';
?>

</body>

</html>