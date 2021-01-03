<?php
	require 'connect.php';

	//Search by marketparticipant
	$marketParticipant = STR_REPLACE("'","''",$_POST["searchMarketParticipantID"]) ;
	$marketParticipant = STR_REPLACE('"','""',$marketParticipant) ;
	$bill = STR_REPLACE("'","''",$_POST["searchBillID"]) ;
	$bill = STR_REPLACE('"','""',$bill) ;
	$contractID = STR_REPLACE("'","''",$_POST["searchcontractID"]) ;
	$contractID = STR_REPLACE('"','""',$contractID) ;
	$uniqueTransactionID = STR_REPLACE("'","''",$_POST["searchUniqueTransactionID"]) ;
	$uniqueTransactionID = STR_REPLACE('"','""',$uniqueTransactionID) ;
	
	//Search by marketparticipant
	if (!empty($marketParticipant) )
	{
		$query = pg_query( $cnx, "SELECT c_parties.c_parties_id, c_parties.c_parties_marketparticipant1, c_parties.c_parties_marketparticipant2, c_marketparticipant.c_marketparticipant_id, c_marketparticipant.c_marketparticipant_identifier
			FROM c_marketparticipant INNER JOIN c_parties ON (c_marketparticipant.c_marketparticipant_id = c_parties.c_parties_marketparticipant2) OR (c_marketparticipant.c_marketparticipant_id = c_parties.c_parties_marketparticipant1)
			WHERE c_marketparticipant.c_marketparticipant_identifier LIKE  '*".$marketParticipant1Identifier."*'" ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$marketParticipant = $row[0];
		}
		$query = pg_query( $cnx, "SELECT e_parties_id FROM e_parties WHERE e_parties_marketparticipant1 LIKE xx OR e_parties_marketparticipant1 LIKE xx " ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxParties = $row[0];
		}
		$query = pg_query( $cnx, "SELECT e_order FROM Execution WHERE " ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxOrder = $row[0];
		}	
	}
	
	//Search by contract
	if (!empty($contractID) )
	{
		$query = pg_query( $cnx, "SELECT e_contract_id FROM e_contract" ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxcontract = $row[0];
		}
		if (is_null($maxcontract))
		{
			$maxcontract = 1;
		}
	
		$sql = "INSERT INTO e_contract ( e_contract_id, e_contract_identifier, e_contract_name, e_contract_type, e_contract_energycommodity, e_contract_fixingindex, e_contract_settlementmethod, e_contract_organisedmarketplace, e_contract_tradinghours, e_contract_lasttraidingdate ) VALUES ("; 
		$sql = $sql.$uniqueTransactionID."'";
		echo($sql);
		//exécution de la requête SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
	
	
	//Search by transaction
	if (!empty($transactionID) )
	{
		$query = pg_query( $cnx, "SELECT e_transaction_id FROM e_transaction" ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$maxTransaction = $row[0];
		}
	
		$sql = "INSERT INTO e_transaction ( e_transaction_id, e_transaction_uniquetransactionid, e_transaction_timestamp, e_transaction_linkedtransaction, e_transaction_linkedorder, e_transaction_voicebrokered, e_transaction_price, e_transaction_indexvalue, e_transaction_priceCurrency, e_transaction_notionalamount, e_transaction_notionalcurrency, e_transaction_quantity, e_transaction_totalnotionalcontractquantity, e_transaction_quantityunit, e_transaction_totalnotionalcontractquantityunit, e_transaction_terminationdate ) VALUES ("; 
		$sql = $sql.$maxTransaction.",'".$transactionID."','".$transactionTimestamp."','".$linkedTransactionID."','".$linkedOrderID."',".$voicebrokered.",".$price.",".$indexValue.",".$priceCurrency.",".$notionalAmount.",".$notionalCurrency.",".$quantity.",".$totalNotionalcontractQuantity.",".$quantityUnit.",".$totalNotionalcontractQuantityUnit.",".$terminationDate.")";
		echo($sql);
		//exécution de la requête SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}

	
	//Search by bill
	if (!empty($bill) )
	{
		$query = pg_query( $cnx, "SELECT MAX(e_bill_id)+1 FROM e_bill" ); //requête
		while($row = pg_fetch_row($query)) //tant que c'est pas la fin de la table
		{
			$billMax = $row[0];
		}
		if (is_null($billMax))
		{
			$billMax = 1;
		}
		
		$sql = "INSERT INTO e_bill ( e_bill_id, e_bill_name, e_bill_execution ) VALUES ("; 
		$sql = $sql.$billMax.",'".$bill."',".$execution.")";
	
		//exécution de la requête SQL:
		$sql2 = pg_query($cnx, $sql) or die( pg_last_error() ) ;
	}
  
  
  
?>