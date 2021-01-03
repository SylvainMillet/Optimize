
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>

<body>

	<!------------------------------------------------------------ navbar call -------------------------------------------------------------->
<?php
require 'connect.php';
include 'navbar_execution.php';
?>
	
	<input type="button" class="btn btn-primary pull-right"
		id="launchOverview" value="Load overview">

	<script src="/REMIT/js/jquery.js"></script>
	<script>  
		$(function (){
			$("#launchOverview").click(function() {
				loadOverview();
			}); 
		}); 
	</script>
	<h1>New execution</h1>
	<!------------------------------------------------------------ form parties of the contract -------------------------------------------------------------->
<?php
include '/parties/newParties.php';
?>
	<!------------------------------------------------------------ form order details -------------------------------------------------------------->
<?php
include '/order/newOrderDetails.php';
?>
	<!------------------------------------------------------------ form contract details -------------------------------------------------------------->
<?php
include '/contract/newcontractDetails.php';
?>
	<!------------------------------------------------------------ form transaction details -------------------------------------------------------------->
<?php
include '/transaction/newTransaction.php';
?>
	<!------------------------------------------------------------ form option details -------------------------------------------------------------->
<?php
include '/option/newOptionDetails.php';
?>
	<!------------------------------------------------------------ form delivery profile -------------------------------------------------------------->
<?php
include '/deliveryprofile/newDeliveryProfile.php';
?>
	<!------------------------------------------------------------ form Life cycle information -------------------------------------------------------------->
<?php
include '/lifecycleinformation/newLifeCycleInformation.php';
?>
	<!------------------------------------------------------------ overview  -------------------------------------------------------------->
<?php
include 'overview.php';
?>

</body>

</html>