<?php
include_once '../inc/db_connect.php';
include_once 'bd_abstraction.php';
if (empty($_POST['exp']) ||
    (empty($_POST['id']))) {
    $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";
} else {
    $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
    $requete = 'INSERT INTO experience_lan_cs (id,experience) ';
    $requete .= 'VALUES (:id,:exp) ';
    $parametres = array(
        ':id' => $_POST['id'],
        ':exp' => $_POST['exp']
    );
    $stt = requete_bd($pdo, $requete, $parametres);
    if ($stt->rowCount() == 1){
        $msg = " Lan validée";
        header( 'Location: http://www.teammate.dev/?p=counterstrike' );
    }else{
        $msg="Erreur : veuillez retry";
    }
}
?>
<p><?php echo $msg; ?></p>
//AJAX !!!
