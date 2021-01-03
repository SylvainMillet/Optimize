
<?php
//connexion � une base de donn�es mariaDB
$host="127.0.0.1"; //host DB
$bd="symbiose"; // identifiant DSN
$user="root"; // login
$password=""; // password
$cnx = mysqli_connect($host,$user,$password,$bd);
if(! $cnx ) {
    die('Could not connect: ' . mysqli_error());
}

?>