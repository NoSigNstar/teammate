<?php
include_once ('vendor/assets/inc/db_connect.php');
include_once ('vendor/assets/script_php/bd_abstraction.php');
$pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
$requete  = 'SELECT id, mail, nom, prenom, date_de_naissance, ville, datetime, role ';
$requete .= 'FROM user';
$stt = requete_bd($pdo, $requete, $parametres=[]);
$dataMembers = $stt->fetchAll(PDO::FETCH_ASSOC);
deconnexion_serveur_bd($pdo);
?>
