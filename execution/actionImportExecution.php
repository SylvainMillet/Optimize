<?php

include 'head.php';
include 'navbar_execution.php';

$racine = realpath(__DIR__) . '/';
require_once ($racine . '../Classes/class.Parser_Variable.php');

maj_csv();

header('Location: dataTable.php');

function nb_lines_id($array, $key = '') {
	$id_lines = array();

	if (isset($array) && !empty($array)) {
		if (empty($key)) {
			array_walk($array, function($value, $key) use (&$id_lines) {
				$id_lines["$value"][] = $key;
			});
		} else {
			array_walk($array[$key], function($value, $key) use (&$id_lines) {
				$id_lines["$value"][] = $key;
			});
		}
	}
	
	return $id_lines;
}

function nb_iteration_id($array, $key = '') {
	$id_nb = array();

	if (isset($array) && !empty($array)) {
		if (empty($key)) {
			array_walk($array, function($value) use (&$id_nb) {
				if (!isset($id_nb["$value"])) {
					$id_nb["$value"] = 1;
				} else {
					$id_nb["$value"]++;
				}
			});
		} else {
			array_walk($array[$key], function($value) use (&$id_nb) {
				if (!isset($id_nb["$value"])) {
					$id_nb["$value"] = 1;
				} else {
					$id_nb["$value"]++;
				}
			});
		}
	}
	
	return $id_nb;
}

function get_db_data($cnx) {
	$query = pg_query($cnx, 'SELECT receptacle.compte_felix, receptacle.raison_sociale, receptacle.nom, receptacle.marketparticipant1_id, receptacle.marketparticipant1_type, receptacle.trader_id, receptacle.marketparticipant2_id, receptacle.marketparticipant2_type, receptacle.reportingentity_id, receptacle.repordingentity_type, receptacle.beneficiary_id, receptacle.beneficiary_type, receptacle.trading_capacity, receptacle.buysell_indicator, receptacle.initiator_aggressor, receptacle.order_id, receptacle.order_type, receptacle.order_condition, receptacle.order_status, receptacle.minimum_execution_volume, receptacle.price_limit, receptacle.undisclosed_volume, receptacle.order_duration, receptacle.contract_id, receptacle.contract_name, receptacle.contract_type, receptacle.energy_commodity, receptacle.settlement_method, receptacle.organisedmarketplace_id, receptacle.contract_trading_hours, receptacle.last_trading_datetime, receptacle.transaction_timestamp, receptacle.linked_transaction_id, receptacle.linked_order_id, receptacle.voice_brokered, receptacle.price, receptacle.index_value, receptacle.price_currency, receptacle.notional_amount, receptacle.notional_currency, receptacle.quantity, receptacle.total_notional_contract_quantity, receptacle.quantityunit, receptacle.total_notional_contract_quantity_unit, receptacle.termination_date, receptacle.option_style, receptacle.option_type, receptacle.option_exercise_date, receptacle.option_strike_price, receptacle.delivery_point, receptacle.delivery_startdate, receptacle.delivery_enddate, receptacle.duration, receptacle.load_type, receptacle.days_of_the_week, receptacle.load_delivery_intervals, receptacle.delivery_capacity, receptacle.delivery_capacity_unit, receptacle.price_interval_quantity, receptacle.action_type, receptacle.intern_bill_cancelled, receptacle.intern_bill
FROM receptacle;

' ); //requete

	$data_db = array();
	while($line = pg_fetch_array($query, NULL, PGSQL_ASSOC)) //tant que c'est pas la fin de la table
	{
		array_walk($line, function($value, $key) use (&$data_db) {
			$data_db[$key][] = $value;
		});
	}
	return $data_db;
}

function maj_csv() {
	global $racine;
	$csv_to_db_key = array('ID du Compte' => 'compte_felix');
	$csv_key = array_keys($csv_to_db_key)[0];

	require_once ($racine . 'connect.php');

	//Lecture du fichier CSV et transformation en tableau
	$parser = new Parser_Variable(null);
	$parser -> set_delimiter(';');
	$data_csv = $parser -> parser_lecture($racine . '/dataCSV/'.date('Ymd').'_originalDATA.csv');

	//Recuperation des donnees de la base de donnees sous forme de tableau associatif
	$data_db = get_db_data($cnx);

	//Calcul du nombre d'iterations par numero de contrat dans le fichier CSV
	$id_nb = nb_iteration_id($data_csv, $csv_key);

	//echo nl2br(print_r($id_nb, true));

	//Tableaux temporaires de cles
	$tmp_keys = array_keys($data_db);
	$tmp_id = array_keys($id_nb);

	//Creation des doublons dans les donnees provenant de la base de donnees
	array_walk($data_db[$csv_to_db_key[$csv_key]], function($value, $key) use (&$data_db, &$id_nb, $tmp_id, $tmp_keys) {
		if (in_array("$value", $tmp_id)) {
			//echo "$value => $id_nb[$value]" . '<br>';
			$nb = $id_nb["$value"];
			$id_nb["$value"] = 0;
			for ($i = 1; $i < $nb; $i++) {
				foreach($tmp_keys as $k) {
					$data_db[$k][] = $data_db[$k][$key];
				}
			
			}
		}
	});

	unset($tmp_id);
	unset($tmp_keys);
	unset($id_nb);

	//Calcul du nombre d'iterations par numero de contrat dans le resultat 
	$id_nb = nb_iteration_id($data_db, $csv_to_db_key[$csv_key]);

	//echo nl2br(print_r($id_nb, true));
	//echo nl2br(print_r(array_keys($data_csv), true));
	
	unset($id_nb);
	/* TO DO MeJ donnees */
	$nb_line_csv = nb_lines_id($data_csv, $csv_key);
	$nb_lines_db = nb_lines_id($data_db, $csv_to_db_key[$csv_key]);
	
	/* On parcourt le tableau de la base pour le complèter avec les données du fichier */
	array_walk($nb_lines_db, function($value, $key) use (&$nb_line_csv, &$data_db, $data_csv){
		if(array_key_exists($key, $nb_line_csv)) {
			foreach($nb_line_csv[$key] as $k => $val) {
				$data_db["transaction_timestamp"][$value[$k]] = $data_csv["Date Emission Facture"][$val];
				$data_db["linked_transaction_id"][$value[$k]] = $data_csv["Numero Sequentiel Facture"][$val];
				$data_db["linked_order_id"][$value[$k]] = $data_csv["ID_CONTRAT"][$val];
				if($data_csv["CONSO"][$val] != 0){
					$data_db["price"][$value[$k]] = $data_csv["MT_HEFF"][$val]/$data_csv["CONSO"][$val];
				}
				else {
					$data_db["Price"][$value[$k]] = 999999;
				}
				$data_db["notional_amount"][$value[$k]] = $data_csv["MT_HEFF"][$val];
				$data_db["total_notional_contract_quantity"][$value[$k]] = $data_csv["CONSO"][$val];
				$data_db["delivery_startdate"][$value[$k]] = $data_csv["Date_DEBUT"][$val];
				$data_db["delivery_enddate"][$value[$k]] = $data_csv["DATE_FIN"][$val];
				$data_db["intern_bill_cancelled"][$value[$k]] = $data_csv["Numero Facture Annulee"][$val];
				$data_db["intern_bill"][$value[$k]] = $data_csv["Identifiant Facture"][$val];
			}
		}
	});
	
	$ar_tmp = $data_db["delivery_enddate"];
	array_walk($ar_tmp, function($value, $key) use (&$data_db){
		$date = DateTime::createFromFormat("d/m/Y", "07/04/2016");

		if (!empty($value)) {
			$date2 = DateTime::createFromFormat("d/m/Y", $value);
			//on supprime les lignes dont date fin livraison avant 07/04/2016
			if ($date2 < $date) {
				//on réinitiale les clés du tableau;
				$tmp = array_keys($data_db);
				foreach($tmp as $val) {
					unset ($data_db[$val][$key]);
				}
			}
		} else {
			//on supprime les lignes sans date
			$tmp = array_keys($data_db);
			foreach($tmp as $val) {
				unset ($data_db[$val][$key]);
			}
		}

		unset($tmp);
		unset($date);
		unset($date2);
	});
	
	$ar_tmp = $data_db["intern_bill_cancelled"];
	array_walk($ar_tmp, function($value, $key) use (&$data_db){

		if (!empty($value)) {
			$cancelledBill = $data_db["intern_bill_cancelled"][$key];
			$cancelledAmount = $data_db["notional_amount"][$key];
			$cancelledVolume = $data_db["total_notional_contract_quantity"][$key];
			//on controle les factures annulées et on supprime les correspondance entre numero, montant et volume
			
			//tableau des cles a supprimer
			$supp = array();
			
			$ar_tmp2 = $data_db["intern_bill"];
			array_walk($ar_tmp2, function($value2, $key2) use (&$data_db,$cancelledBill, $cancelledAmount, $cancelledVolume, $key, &$supp){
				if ($data_db["intern_bill"][$key2] == $cancelledBill && $data_db["notional_amount"][$key2]+$cancelledAmount == 0 && $data_db["total_notional_contract_quantity"][$key2]+$cancelledVolume == 0) {		
					$supp[] = $key2;
					$supp[] = $key;
				}
				
			});
			
			//on supprime les lignes de supp[]
			$tmp = array_keys($data_db);
			foreach ($supp as $valSupp) {
				foreach($tmp as $val) {
					unset ($data_db[$val][$valSupp]);
				}
			}
		
		}

		unset($tmp);
		unset($date);
		unset($date2);
	});
	
	unset($ar_tmp);

	$tmp = array_keys($data_db);
	foreach($tmp as $val) {
		$data_db[$val] = array_values($data_db[$val]);
	}

	foreach($data_db['load_delivery_intervals'] as $key => $val) {
		$data_db['load_delivery_intervals'][$key] = str_replace('/ ', ' / ', $val);
	}

	unset($nb_line_csv);
	unset($nb_line_db);

	$csv = $parser -> parser_ecriture($data_db);

	file_put_contents('C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_epuratedDATA.csv', $csv, LOCK_EX);

	//echo nl2br($str);

	unset($parser);
	unset($data_db);
	unset($data_csv);
}

?>