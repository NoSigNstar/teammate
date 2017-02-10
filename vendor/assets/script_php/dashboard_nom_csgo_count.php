<?php
include_once ('vendor/assets/inc/db_connect.php');
include_once ('vendor/assets/script_php/bd_abstraction.php');
$pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
$requete  = 'SELECT id, nom ';
$requete .= 'FROM counter_strike';
$stt = requete_bd($pdo, $requete, $parametres=[]);
$datanom = resultats_fetchall($stt);
deconnexion_serveur_bd($pdo);
?>
