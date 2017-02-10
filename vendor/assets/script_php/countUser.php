<?php
include_once 'vendor/assets/inc/db_connect.php';
include_once 'vendor/assets/script_php/bd_abstraction.php';

$pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
$requete = 'SELECT COUNT(*) ';
$requete .= 'FROM user ';
$stt = requete_bd($pdo, $requete, $parametres=[]);
$result = $stt->fetchColumn();
    if ($result > 1){
        $countUser = $result[0];
    }else{
        $countUser = 0;
    }
deconnexion_serveur_bd($pdo);