<?php
include_once '../inc/db_connect.php';
include_once 'bd_abstraction.php';
    if (empty($_POST['prenom']) ||
        empty($_POST['nom']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['naissance']) ||
        empty($_POST['ville'])) {
        header( 'Location: http://www.teammate.dev/' );
        $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";
    } else {
        $pdo = connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName);
        $requete = 'INSERT INTO user (mail, nom, prenom, date_de_naissance, ville, password, datetime, profil_id) ';
        $requete .= 'VALUES (:mail, :nom, :prenom, :date_de_naissance, :ville, :password, :datetime, :profil_id) ';
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $datetime = date_create()->format('Y-m-d H:i:s');
        $parametres = array(
            ':mail' => $_POST['email'],
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':date_de_naissance' => $_POST['naissance'],
            ':ville' => $_POST['ville'],
            ':password' => $pass,
            ':datetime' => $datetime,
            ':profil_id' => NULL,
        );
        $stt = requete_bd($pdo, $requete, $parametres);
        if ($stt->rowCount() == 1){
            $msg = " Inscription validée";
            header( 'Location: http://www.teammate.dev/?p=home' );
        }else{
            $msg="Erreur : veuillez retry";
        }
    }
?>
    <p><?php echo $msg; ?></p>
//AJAX !!!
