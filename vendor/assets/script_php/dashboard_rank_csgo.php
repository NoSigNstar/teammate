<?php
include_once '../inc/db_connect.php';
include_once 'bd_abstraction.php';
if (empty($_POST['id']) ||
    empty($_POST['rank'])){
    $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";
} else {
    $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
    $requete = 'INSERT INTO rank_cs (id,rank) ';
    $requete .= 'VALUES (:id,:rank) ';
    $parametres = array(
        ':id' => $_POST['id'],
        ':rank' => $_POST['rank']
    );
    $stt = requete_bd($pdo, $requete, $parametres);
    if ($stt->rowCount() == 1){
        $msg = " Heures validée";
        header( 'Location: http://www.teammate.dev/?p=counterstrike' );
    }else{
        $msg="Erreur : veuillez retry";
    }
}
?>
<p><?php echo $msg; ?></p>
//AJAX !!!
