<?php
error_reporting(0);
if (isset($_POST) && isset($_POST['json'])){
	$racine = realpath(__DIR__) . '/';
	require_once ($racine . '../Classes/class.Parser_Variable.php');

	//Lecture du fichier CSV et transformation en tableau
	$parser = new Parser_Variable(null);
	$parser -> set_delimiter(';');
	$parser -> set_entete(false);

	$json = json_decode($_POST['json']);
	$array = array();
	foreach($json as $key => $val) {
		foreach($val as $k => $v) {
			$array[$k][$key] = $v;
		}
	}
	
	$data_csv = $parser -> parser_ecriture($array);

	$filename = 'C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_userChangeDATA.csv';
	file_put_contents($filename, $data_csv);
	header('Content_type: application/json');
	if (file_exists($filename)) {
		return true;
	} else {
		return false;
	}
} else {
	header('Content_type: application/json');
	return false;
}
?>