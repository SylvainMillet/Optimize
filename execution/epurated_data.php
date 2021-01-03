<?php
	$racine = realpath(__DIR__) . '/';
	require_once ($racine . '../Classes/class.Parser_Variable.php');

	function array_to_json($array) {
		$json_array = array();
	
		$keys = array_keys($array);
	
		array_walk($array[$keys[0]], function($value, $key) use (&$json_array, $array, $keys) {
			foreach ($keys as $k) {
				$json_array[$key][$k] = preg_replace('/[^A-Za-z0-9\.\-:\/\ \']/', '', $array[$k][$key]);
				$json_array[$key][$k] = preg_replace('/\,/', '.', $array[$k][$key]);
				$json_array[$key][$k] = preg_replace('/'.PHP_EOL.'/', '', $array[$k][$key]);
			}
		});
	
		return json_encode($json_array);
	}
	
	$filename = 'C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_epuratedDATA.csv';

	if (file_exists($filename)) {
		//Lecture du fichier CSV et transformation en tableau
		$parser = new Parser_Variable(null);
		$parser -> set_delimiter(';');
		$data_csv = $parser -> parser_lecture($filename);
	
		//Changement du format du tableau
		$json = array_to_json($data_csv);
		header('Content_type: application/json');
	
		echo $json;
	} else {
		echo "File $filename doesn't exists.";
	}



	unset($data_csv);
	unset($json);
	unset($parser);
	
?>