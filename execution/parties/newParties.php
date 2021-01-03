<h3 id="titleParties">Parties of the contract</h3>

<form class="well" id="formMarketParticipant1">
	<legend>Capture of the market participant 1</legend>
	<div class="container">
		<div class="form-groupMarketParticipant1ID col-lg-4">
			<span class="badge">Field 1</span> <label for="marketParticipant1ID">ID
				of the market participant 1 : </label> <input
				id="marketParticipant1ID" type="text" maxlength="20"
				class="form-control">
		</div>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertMarketParticipant1IDLength">
			<h4>Error !</h4>
			Vous devez entrer au moins 3 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formMarketParticipant1").on("submit", function() {
			      if($("#marketParticipant1ID").val().length < 3) {
			        $("div.form-groupMarketParticipant1ID").addClass("has-error");
			        $("#alertMarketParticipant1IDLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertMarketParticipant1IDHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est defini par le type du market participant !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherMarketParticipant1IDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherMarketParticipant1IDHelp").click(function() {$("#afficherMarketParticipant1IDHelp").hide();
						$("#alertMarketParticipant1IDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertMarketParticipant1IDHelp").hide("slow");
						$("#afficherMarketParticipant1IDHelp").show();
					}); 
				}); 
			</script>

		<div class="form-group col-lg-2"></div>
		<div class="form-group col-lg-4">
			<span class="badge">Existing Market Participant</span> <select
				onchange="loadMarketParticipant1(this.value)"
				id="existingMarketParticipant1" class="form-control">
				<option value=""></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_marketparticipant ORDER BY e_marketparticipant.e_marketparticipant_name" ); // requete
					while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
					{
						echo '<option value="' . $row[1] .'|'. $row[3] . '">' . $row[2].' </option>';
					}
				} else {
					echo "Impossible de se connecter a la base de donnees";
				}
				?>
			</select>
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script type="text/javascript">
			function loadMarketParticipant1(valeur)
			{
				var texte;
				liste = document.getElementById("existingMarketParticipant1");
				document.getElementById('marketParticipant1ID').value=(liste.options[liste.selectedIndex].value).split("|")[0];
				document.getElementById('marketParticipant1Name').value=liste.options[liste.selectedIndex].text;
				document.getElementById('marketParticipant1Type').value=(liste.options[liste.selectedIndex].value).split("|")[1];
				//document.getElementById('marketParticipant1Type').value="2";
					
				if(document.getElementById('existingMarketParticipant1').value.length > 0) {
					$( "#marketParticipant1Name" ).prop( "disabled", true );
					$( "#marketParticipant1ID" ).prop( "disabled", true );
					$( "#marketParticipant1Type" ).prop( "disabled", true );
			        return false;
			     }
			     
				if(liste.options[liste.selectedIndex].text == '') {
					$( "#marketParticipant1Name" ).prop( "disabled", false );
					$( "#marketParticipant1ID" ).prop( "disabled", false );
					$( "#marketParticipant1Type" ).prop( "disabled", false );
			        return false;
			     }
			}
		</script>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<label for="marketParticipant1Name">Name of the market participant 1
				: </label> <input id="marketParticipant1Name" type="text"
				maxlength="250" class="form-control">
		</div>


		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertMarketParticipant1Name">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Cette information sert à retrouver plus facilement le market
			participant. Cette information n'est pas envoyee.
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherMarketParticipant1Name" value="Help">
		</div>


		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherMarketParticipant1Name").click(function() {$("#afficherMarketParticipant1Name").hide();
						$("#alertMarketParticipant1Name").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertMarketParticipant1Name").hide("slow");
						$("#afficherMarketParticipant1Name").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 2</span> <label
				for="marketParticipant1Type">Type of the market participant 1 : </label>
			<select id="marketParticipant1Type" class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requete
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
		
		<div class="form-group col-lg-3"></div>
		
		<div class="form-groupBillID col-lg-4">
			<span class="badge">Bill</span> <label for="billID">ID
				of the bill : </label> <input
				id="billID" type="text" maxlength="20"
				class="form-control">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<input type="submit" class="btn btn-success pull-right" value="Next">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formMarketParticipant1").on("submit", function() {
	      if($("#marketParticipant1ID").val().length >= 3) {
	        $("#formMarketParticipant1").hide("slow");
	        $("#formTrader").show("slow");
	        return false;
	      }
	    });
	  });
	</script>
	
<form class="well" style="display: none" id="formTrader">
	<legend>Capture of the trader</legend>
	<div class="container">
		<div class="form-groupTraderID col-lg-4">
			<span class="badge">Field 3</span> <label for="traderID">ID
				of the trader : </label> <input
				id="traderID" type="text" maxlength="20"
				class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertTraderHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de c
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherTraderHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
			$(function (){
				$("#afficherTraderHelp").click(function() {$("#afficherTraderHelp").hide();
					$("#alertTraderHelp").show("slow");
				}); 
    			$(".close").click(function() {
					$("#alertTraderHelp").hide("slow");
					$("#afficherTraderHelp").show();
				}); 
			}); 
		</script>

	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>

		<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backMarketParticipant1").click(function() {
			    $("#formTrader").hide("slow");
			    $("#formMarketParticipant1").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backMarketParticipant1" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formTrader").on("submit", function() {
	        $("#formTrader").hide("slow");
	        $("#formMarketParticipant2").show("slow");
	        return false;
	    });
	  });
	</script>

<form class="well" style="display: none" id="formMarketParticipant2">
	<legend>Capture of the market participant 2</legend>
	<div class="container">
		<div class="form-groupMarketParticipant2ID col-lg-4">
			<span class="badge">Field 4</span> <label for="marketParticipant2ID">ID
				of the market participant 2 : </label> <input
				id="marketParticipant2ID" type="text" maxlength="20"
				class="form-control">
		</div>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertMarketParticipant2IDLength">
			<h4>Error !</h4>
			Vous devez entrer au moins 3 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
		  $(function(){
		    $("#formMarketParticipant2").on("submit", function() {
		      if($("#marketParticipant2ID").val().length < 3) {
		        $("div.form-groupMarketParticipant2ID").addClass("has-error");
		        $("#alertMarketParticipant2IDLength").show("slow").delay(4000).hide("slow");
		        return false;
		      }
		    });
		  });
		</script>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertMarketParticipant2IDHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Le nombre de carateres est defini par le type du market participant !
		</div>
		
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherMarketParticipant2IDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherMarketParticipant2IDHelp").click(function() {$("#afficherMarketParticipant2IDHelp").hide();
						$("#alertMarketParticipant2IDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertMarketParticipant2IDHelp").hide("slow");
						$("#afficherMarketParticipant2IDHelp").show();
					}); 
				}); 
			</script>

		<div class="form-group col-lg-2"></div>
		<div class="form-group col-lg-4">
			<span class="badge">Existing Market Participant</span> <select
				onchange="loadMarketParticipant2(this.value)"
				id="existingMarketParticipant2" class="form-control">
				<option value=""></option>
				<?php
					if ($cnx) {
						$query = pg_query ( $cnx, "SELECT * FROM e_marketparticipant ORDER BY e_marketparticipant.e_marketparticipant_name" ); // requete
						while ($row = pg_fetch_row ( $query ) ) // tant que c'est pas la fin de la table
						{
							echo '<option value="' . $row[1] .'|'. $row[3] .  '|'. $row[4] .'">' . $row[2].' </option>';
						}
					} else {
						echo "Impossible de se connecter à  la base de données";
					}
				?>
			</select>
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script type="text/javascript">
				function loadMarketParticipant2(valeur)
				{
					var texte;
					liste = document.getElementById("existingMarketParticipant2");
					document.getElementById('marketParticipant2ID').value=(liste.options[liste.selectedIndex].value).split("|")[0];
					document.getElementById('marketParticipant2Name').value=liste.options[liste.selectedIndex].text;
					document.getElementById('marketParticipant2Type').value=(liste.options[liste.selectedIndex].value).split("|")[1];
					if (((liste.options[liste.selectedIndex].value).split("|")[2])== "t")
					document.getElementById('marketParticipant2Delegate').checked=true;
					else
					document.getElementById('marketParticipant2Delegate').checked=false;
					
					if(document.getElementById('existingMarketParticipant2').value.length > 0) {
						$( "#marketParticipant2Name" ).prop( "disabled", true );
						$( "#marketParticipant2ID" ).prop( "disabled", true );
						$( "#marketParticipant2Type" ).prop( "disabled", true );
						$( "#marketParticipant2Delegate" ).prop( "disabled", true );
				        return false;
				     }
				     
					if(liste.options[liste.selectedIndex].text == '') {
						$( "#marketParticipant2Name" ).prop( "disabled", false );
						$( "#marketParticipant2ID" ).prop( "disabled", false );
						$( "#marketParticipant2Type" ).prop( "disabled", false );
						$( "#marketParticipant2Delegate" ).prop( "disabled", false );
				        return false;
				     }

					
				}
			</script>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<label for="marketParticipant2Name">Name of the market participant 2
				: </label> <input id="marketParticipant2Name" type="text"
				maxlength="250" class="form-control">
		</div>


		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertMarketParticipant2Name">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Cette information sert à retrouver plus facilement le market
			participant. Cette information n'est pas envoyee.
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherMarketParticipant2Name" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherMarketParticipant2Name").click(function() {$("#afficherMarketParticipant2Name").hide();
						$("#alertMarketParticipant2Name").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertMarketParticipant2Name").hide("slow");
						$("#afficherMarketParticipant2Name").show();
					}); 
				}); 
			</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 5</span> <label
				for="marketParticipant2Type">Type of the market participant 2 : </label>
			<select id="marketParticipant2Type" class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requete
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
			<input id="marketParticipant2Delegate" type="checkbox"> <b>Delegate reporting</b>
		</div>


		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertMarketParticipant2Delegate">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Check this box if market participant ask delegate reporting.
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherMarketParticipant2Delegate" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherMarketParticipant2Delegate").click(function() {$("#afficherMarketParticipant2Delegate").hide();
						$("#alertMarketParticipant2Delegate").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertMarketParticipant2Delegate").hide("slow");
						$("#afficherMarketParticipant2Delegate").show();
					}); 
				}); 
			</script>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backTrader").click(function() {
			    $("#formMarketParticipant2").hide("slow");
			    $("#formTrader").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backTrader" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formMarketParticipant2").on("submit", function() {
	      if($("#marketParticipant2ID").val().length >= 3) {
	        $("#formMarketParticipant2").hide("slow");
	        $("#formReportingEntity").show("slow");
	        return false;
	      }
	    });
	  });
	</script>

<form class="well" style="display: none" id="formReportingEntity">
	<legend>Capture of the reporting entity</legend>
	<div class="container">
		<div class="form-groupReportingEntity col-lg-4">
			<span class="badge">Field 6</span> <label for="reportingEntityID">Reporting entity ID: </label> <input id="reportingEntityID"
				type="text" maxlength="20" class="form-control">
		</div>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertReportingEntityIDLength">
			<h4>Error !</h4>
			Vous devez entrer au moins xxx caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formReportingEntity").on("submit", function() {
			      if($("#reportingEntityID").val().length < 3) {
			        $("div.form-groupReportingEntity").addClass("has-error");
			        $("#alertReportingEntityIDLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertReportingEntityIDHelp">
			<button type="button" class="close">X</button>
			<h4>Warning!</h4>
			Le nombre de carateres est defini par le type du reporting entity !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherReportingEntityIDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherReportingEntityIDHelp").click(function() {$("#afficherReportingEntityIDHelp").hide();
						$("#alertReportingEntityIDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertReportingEntityIDHelp").hide("slow");
						$("#afficherReportingEntityIDHelp").show();
					}); 
				}); 
			</script>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 7</span> <label for="reportingEntityType">Type
				of the reporting entity : </label> <select id="reportingEntityType"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requete
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
			$("#backMarketParticipant2").click(function() {
			    $("#formReportingEntity").hide("slow");
			    $("#formMarketParticipant2").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backMarketParticipant2" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formReportingEntity").on("submit", function() {
	      if($("#reportingEntityID").val().length >= 3) {
	        $("#formReportingEntity").hide("slow");
	        $("#formBeneficiary").show("slow");
	        return false;
	      }
	    });
	  });
	</script>

<form class="well" style="display: none" id="formBeneficiary">
	<legend>Capture of the beneficiary</legend>
	<div class="container">
		<div class="form-groupBeneficiary col-lg-4">
			<span class="badge">Field 8</span> <label for="beneficiaryID">Beneficiary ID : </label> <input id="beneficiaryID" type="text"
				maxlength="10" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertBeneficiaryIDHelp">
			<button type="button" class="close">X</button>
			<h4>Warning!</h4>
			Le nombre de carateres est defini par le type du reporting entity !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherBeneficiaryIDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherBeneficiaryIDHelp").click(function() {$("#afficherBeneficiaryIDHelp").hide();
						$("#alertBeneficiaryIDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertBeneficiaryIDHelp").hide("slow");
						$("#afficherBeneficiaryIDHelp").show();
					}); 
				}); 
			</script>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 9</span> <label for="beneficiaryType">Type
				of the beneficiary : </label> <select id="beneficiaryType"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_entitytype" ); // requete
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

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backReportingEntity").click(function() {
			    $("#formBeneficiary").hide("slow");
			    $("#formReportingEntity").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backReportingEntity" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formBeneficiary").on("submit", function() {
	        $("#formBeneficiary").hide("slow");
	        $("#formTradingCapacity").show("slow");
	        return false;
	    });
	  });
	</script>

<form class="well" style="display: none" id="formTradingCapacity">
	<legend>Capture of the trading capacity</legend>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 10</span> <label for="tradingCapacity">Trading capacity : </label> <select id="tradingCapacity"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_tradingcapacity" ); // requete
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

		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertTradingCapacity">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Cette informa
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherTradingCapacity" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherTradingCapacity").click(function() {$("#afficherTradingCapacity").hide();
						$("#alertTradingCapacity").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertTradingCapacity").hide("slow");
						$("#afficherTradingCapacity").show();
					}); 
				}); 
			</script>
	</div>
	
	<legend>Capture of the buy/sell indicator</legend>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 11</span> <label for="buySellIndicator">Buy/sell indicator : </label> <select id="buySellIndicator"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_buysellindicator" ); // requete
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

		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertBuySellIndicator">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Cette informa
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherBuySellIndicator" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherBuySellIndicator").click(function() {$("#afficherBuySellIndicator").hide();
						$("#alertBuySellIndicator").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertBuySellIndicator").hide("slow");
						$("#afficherBuySellIndicator").show();
					}); 
				}); 
			</script>
	</div>
	
	<legend>Capture of the Initiator/Aggressor</legend>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 12</span> <label for="initiatorAggressor">Initiator / Aggressor : </label> <select id="initiatorAggressor"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_initiatoraggressor" ); // requete
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

		<div class="alert alert-warning col-lg-4" style="display: none"
			id="alertInitiatorAggressor">
			<button type="button" class="close">x</button>
			<h4>Attention!</h4>
			Cette informa
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherInitiatorAggressor" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#afficherInitiatorAggressor").click(function() {$("#afficherInitiatorAggressor").hide();
						$("#alertInitiatorAggressor").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertInitiatorAggressor").hide("slow");
						$("#afficherInitiatorAggressor").show();
					}); 
				}); 
			</script>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backBeneficiary").click(function() {
			    $("#formTradingCapacity").hide("slow");
			    $("#formBeneficiary").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backBeneficiary" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formTradingCapacity").on("submit", function() {
	        $("#formTradingCapacity").hide("slow");
	        $("#titleParties").hide("slow");
	        $("#formOrderDetails").show("slow");
	        $("#titleOrderDetails").show("slow");
	        return false;
	    });
	  });
	</script>
