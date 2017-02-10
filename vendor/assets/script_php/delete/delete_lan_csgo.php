<?php
include_once ('../../inc/db_connect.php');
include_once ('../bd_abstraction.php');
if (empty($_POST['id'])){
    echo "Il n'y a pas ID de lan sélectionnée";
}else{
    $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
    $requete  = 'DELETE FROM experience_lan_cs ';
    $requete .= 'WHERE id = :id';

    $parametres = array(
        ':id' => $_POST['id']
    );
    $stt = requete_bd($pdo, $requete, $parametres);
    if( $stt->rowCount() == 1){
        header( 'Location: http://www.teammate.dev/?p=counterstrike' );
    }else{
        echo "Une erreur est survenur.";
    }
    deconnexion_serveur_bd($pdo);
}
?>