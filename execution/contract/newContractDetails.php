<h3 style="display: none" id="titlecontractDetails">contract details</h3>

<form class="well" style="display: none" id="formcontractDetails">
	<legend>Capture of the contract details</legend>
	<div class="container">
		<div class="form-groupcontractID col-lg-4">
			<span class="badge">Field 21</span> <label for="contractID">contract ID : </label> <input id="contractID" type="text"
				maxlength="50" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertcontractIDHelp">
			<button type="button" class="close">X</button>
			<h4>Info</h4>
			Max 50 !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="affichercontractIDHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#affichercontractIDHelp").click(function() {$("#affichercontractIDHelp").hide();
						$("#alertcontractIDHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertcontractIDHelp").hide("slow");
						$("#affichercontractIDHelp").show();
					}); 
				}); 
			</script>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertcontractIDLength">
			<h4>Error !</h4>
			Vous devez entrer au max 50 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
			  $(function(){
			    $("#formcontractDetails").on("submit", function() {
			      if($("#contractID").val().length > 50) {
			        $("div.form-groupcontractID").addClass("has-error");
			        $("#alertcontractIDLength").show("slow").delay(4000).hide("slow");
			        return false;
			      }
			    });
			  });
			</script>
	</div>

	<div class="container">
		<div class="form-groupcontractName col-lg-4">
			<span class="badge">Field 22</span> <label for="contractName">contract Name : </label> <input id="contractName" type="text"
				maxlength="200" class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertcontractNameHelp">
			<button type="button" class="close">X</button>
			<h4>Info</h4>
			Max 200 !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="affichercontractNameHelp" value="Help">
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>  
				$(function (){
					$("#affichercontractNameHelp").click(function() {$("#affichercontractNameHelp").hide();
						$("#alertcontractNameHelp").show("slow");
					}); 
	    			$(".close").click(function() {
						$("#alertcontractNameHelp").hide("slow");
						$("#affichercontractNameHelp").show();
					}); 
				}); 
			</script>

		<div class="alert alert-block alert-danger col-lg-3"
			style="display: none" id="alertcontractNameLength">
			<h4>Error !</h4>
			Vous devez entrer au max 200 caracteres !
		</div>

		<script src="/REMIT/js/jquery.js"></script>
		<script>
		  $(function(){
		    $("#formcontractDetails").on("submit", function() {
		      if($("#contractName").val().length > 200) {
		        $("div.form-groupcontractName").addClass("has-error");
		        $("#alertcontractNameLength").show("slow").delay(4000).hide("slow");
		        return false;
		      }
		    });
		  });
		</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 23</span> <label for="contractType">contract Type : </label> <select id="contractType" class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_contracttype" ); // requête
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
			<span class="badge">Field 24</span> <label for="energyCommodity">Energy
				commodity : </label> <select id="energyCommodity"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_energycommodity" ); // requête
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
			<span class="badge">Field 25</span> <label for="fixingIndex">Fixing Index : </label> <input id="fixingIndex" type="text"
				maxlength="150" class="form-control">
		</div>

	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 26</span> <label for="settlementMethod">Settlement Method : </label> <select id="settlementMethod"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_settlementmethod" ); // requête
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
			<span class="badge">Field 27</span> <label for="organisedMarketPlace">Organised Market Place : </label> <select id="organisedMarketPlace"
				class="form-control">
				<option value=null></option>
				<?php
				if ($cnx) {
					$query = pg_query ( $cnx, "SELECT * FROM e_organisedmarketplace" ); // requête
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
		<div class="form-groupTradingHours col-lg-2">
			<span class="badge">Field 28</span> <label
				for="tradingHours1">TradingHours 1 : </label>
			<input id="tradingHours1" type="time"
				class="form-control">
		</div>
		<div class="form-groupTradingHours col-lg-2">
			<span class="badge">Field 28'</span> <label
				for="tradingHours2">TradingHours 2 : </label>
			<input id="tradingHours2" type="time"
				class="form-control">
		</div>

		<div class="alert alert-warning col-lg-3" style="display: none"
			id="alertTradingHoursHelp">
			<button type="button" class="close">X</button>
			<h4>Attention!</h4>
			Strange format be careful !
		</div>
		<div class="col-lg-1">
			<input type="button" class="btn btn-primary"
				id="afficherTradingHoursHelp" value="Help">
		</div>
	
		<script src="/REMIT/js/jquery.js"></script>
		<script>  
			$(function (){
				$("#afficherTradingHoursHelp").click(function() {$("#afficherTradingHoursHelp").hide();
					$("#alertTradingHoursHelp").show("slow");
				}); 
	    			$(".close").click(function() {
					$("#alertTradingHoursHelp").hide("slow");
					$("#afficherTradingHoursHelp").show();
				}); 
			}); 
		</script>
	</div>

	<div class="container">
		<div class="form-group col-lg-4">
			<span class="badge">Field 29</span> <label
				for="lastTraidingDate">Last Traiding Date : </label> <input id="lastTraidingDate"
				type="date" class="form-control">
		</div>
		<div class="form-group col-lg-4">
			<span class="badge">Field 29'</span> <label for="lastTraidingTime">Last Traiding Time : </label> <input id="lastTraidingTime" type="time"
				class="form-control">
		</div>
	</div>

	<button type="reset" class="btn btn-warning pull-left">Erase</button>
	
	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#backOrder").click(function() {
				$("#formcontractDetails").hide("slow");
			    $("#titlecontractDetails").hide("slow");
			    $("#formOrderDetails").show("slow");
			    $("#titleOrderDetails").show("slow");
			    return false;
			}); 
		}); 
	</script>

	<input type="submit" class="btn btn-success pull-right" value="Next">
	<input type="button" class="btn btn-primary pull-right"
		id="backOrder" value="Back">

</form>

<script src="/REMIT/js/jquery.js"></script>
<script>
	  $(function(){
	    $("#formcontractDetails").on("submit", function() {
	        $("#formcontractDetails").hide("slow");
	        $("#titlecontractDetails").hide("slow");
	        $("#formTransaction").show("slow");
	        $("#titleTransaction").show("slow");
	        return false;
	    });
	  });
	</script>
