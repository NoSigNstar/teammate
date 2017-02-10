<?php
include_once ('vendor/assets/inc/db_connect.php');
include_once ('vendor/assets/script_php/bd_abstraction.php');
$pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
$requete  = 'SELECT id, experience ';
$requete .= 'FROM experience_lan_cs';
$stt = requete_bd($pdo, $requete, $parametres=[]);
$dataexp = resultats_fetchall($stt);
deconnexion_serveur_bd($pdo);
?>
