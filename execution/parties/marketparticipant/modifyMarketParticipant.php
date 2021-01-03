
<!DOCTYPE html>
<html lang="en">
<?php
include '../../head.php';
require '../../connect.php';
include '../../navbar_execution.php';
?>

<body>

<h3 id="titleParties">Parties of the contract</h3>


<form class="well" id="formMarketParticipant" action="insertMarketParticipant.php" method="POST" onsubmit="return verif_vide();">
	
	<legend>Capture of the market participant</legend>
	<div class="container">
		<div class="form-groupMarketParticipantIdentifier col-lg-4">
			<span class="badge">Field 1</span> <label for="marketParticipantIdentifier">ID
				of the market participant : </label> <input
				id="marketParticipantIdentifier" name="marketParticipantIdentifier" type="text" maxlength="20"
				class="form-control">
		</div>

		<div class="form-group col-lg-2"></div>
		
		<div class="form-group col-lg-4">
			<span class="badge">Existing Market Participant</span> <select
				onchange="loadMarketParticipant(this.value)"
				id="existingMarketParticipant" class="form-control">
				<option value=""></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_marketparticipant order by e_marketparticipant_name ASC" ); // requete
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
					{
						echo '<option value="' . $row[1] .'|'. $row[3] . '|'. $row[4] . '|'. $row[0] .'">' . $row[2].' </option>';
					}
				} else {
					echo "Impossible de se connecter à  la base de données";
				}
				?>
			</select>
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script type="text/javascript">
			function loadMarketParticipant(valeur)
			{
				var texte;
				liste = document.getElementById("existingMarketParticipant");
				document.getElementById('marketParticipantIdentifier').value=(liste.options[liste.selectedIndex].value).split("|")[0];
				document.getElementById('marketParticipantName').value=liste.options[liste.selectedIndex].text;
				document.getElementById('marketParticipantID').value=(liste.options[liste.selectedIndex].value).split("|")[3];
				document.getElementById('marketParticipantType').value=(liste.options[liste.selectedIndex].value).split("|")[1];
				if (((liste.options[liste.selectedIndex].value).split("|")[2])== "t")
				document.getElementById('marketParticipantDelegate').checked=true;
				else
				document.getElementById('marketParticipantDelegate').checked=false;
			}
		</script>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<label for="marketParticipantName">Name of the market participant
				: </label> <input id="marketParticipantName" name="marketParticipantName" type="text"
				maxlength="250" class="form-control">
		</div>
		
		<div class="form-group col-lg-2"></div>
		
		<div class="form-group col-lg-4">
				<input id="marketParticipantID" name="marketParticipantID" type="text" class="form-control" style="display: none">
		</div>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 2</span> <label
				for="marketParticipantType">Type of the market participant : </label>
			<select id="marketParticipantType" name="marketParticipantType" class="form-control">
				<option value=""></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requete
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
					{
						echo '<option value="' . $row[0] . '">' . $row[2] . ' (' . $row[1] . ')  </option>';
					}
				} else {
					echo "Impossible de se connecter a  la base de donnees";
				}
				?>
			</select>
		</div>
	</div>
	
	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Delegate reporting</span> <input id="marketParticipantDelegate" name="marketParticipantDelegate" value="true" type="checkbox">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<input type="submit" class="btn btn-success pull-right" value="Save changes">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script type="text/javascript">
	function verif_vide(){
		mpID=document.getElementById('marketParticipantID');
		mpIdentifier=document.getElementById('marketParticipantIdentifier');
		mpName=document.getElementById('marketParticipantName');
		mpType=document.getElementById('marketParticipantType');
		if(mpID.value==""){
			alert("No market participant selected");
			return false; //le form part pas
		}
		if(mpIdentifier.value==""){
			alert("No market participant identifier");
			return false; //le form part pas
		}
		if(mpName.value==""){
			alert("No market participant name");
			return false; //le form part pas
		}
		if(mpType.value==""){
			alert("No market participant type selected");
			return false; //le form part pas
		}
	}
	
	
</script>


</body>
