<?php
function connexion_serveur_bd($dbHost, $dbUser, $dbPassword, $dbName)
{
    $pdo = null;
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8";

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $errMsg = 'Connection error: ' . $e->getMessage();
    }

    return $pdo;
}

function requete_bd($pdo, $requete, $parametres=[])
{
    $stt = null;

    try {
        $stt = $pdo->prepare($requete);
        $stt->execute($parametres);
    } catch (PDOException $e) {
        $queryError = true;
        echo $errMsg = 'Query error : ' . $e->getMessage();
    }

    return $stt;
}

function deconnexion_serveur_bd(&$pdo)
{
    $pdo = null;
}

function resultats_fetch_object($resultats)
{
    return $resultats->fetch(PDO::FETCH_OBJ);
}

function resultats_fetchall($resultats){
    return $resultats->fetchAll(PDO::FETCH_ASSOC);
}

function return_errors($errMsg){
    echo $errMsg;
};
?>