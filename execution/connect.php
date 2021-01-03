
<?php
//connexion à une base de donnees ACCESS
$bd="REMIT_Execution"; // identifiant DSN
$user="postgres"; // login
$password="root"; // password
$dsn="localhost";
//$cnx = odbc_connect($bd,$user,$password) or die ("Connection denied") ;

//$cnx = odbc_connect("Driver={PostgreSQL ANSI};Server=$dsn;SSL=false;Pooling=false;Port=5432;Database=$bd;", $user, $password);

$cnx = pg_connect("host=localhost port=5432 dbname=REMIT_Execution user=postgres password=root")
or die('Connexion impossible : ' . pg_last_error());

?>