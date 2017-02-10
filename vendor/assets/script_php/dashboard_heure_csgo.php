<?php
include_once '../inc/db_connect.php';
include_once 'bd_abstraction.php';
    if (empty($_POST['heures']) ||
       (empty($_POST['id']))) {
        $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";
    } else {
        $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
        $requete = 'INSERT INTO heure_jeu_cs (id,heure) ';
        $requete .= 'VALUES (:id,:heures) ';
        $parametres = array(
            ':id' => $_POST['id'],
            ':heures' => $_POST['heures']
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
