<?php
include_once '../inc/db_connect.php';
include_once 'bd_abstraction.php';
if (empty($_POST['nom'])) {
    $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";
} else {
    $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
    $requete = 'UPDATE counter_strike ';
    $requete .= 'SET nom = :nom ';
    $parametres = array(
        ':nom' => $_POST['nom']
    );
    $stt = requete_bd($pdo, $requete, $parametres);
    if ($stt->rowCount() == 1){
        $msg = "Le nom est validée";
        header( 'Location: http://www.teammate.dev/?p=counterstrike' );
    }else{
        $msg="Erreur : veuillez retry";
    }
}
?>
<p><?php echo $msg; ?></p>
//AJAX !!!
