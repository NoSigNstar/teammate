<?php
session_start();
$connected = false;
$dataSession = array();
if (isset($_SESSION['user'])) {
    $connected = true;
    $userNom = $_SESSION['user']['nom'];
    $userPrenom = $_SESSION['user']['prenom'];
    $userRole = $_SESSION['user']['role'];
    $dataSession = array(
        'userNom' => $userNom,
        'userPrenom' => $userPrenom,
        'userRole' => $userRole,
    );
}

include 'vendor/assets/script_php/all_inc.php';
$dataDefault = array(
    'countJoueur' => $countUser,
    'countCompetition' => $countCompetition,
    'connected' => $connected,
    'countUser' => $countUser,
    'members' =>$dataMembers,
    'heures' => $dataheures,
    'rank' => $dataranks,
    'type' => $datatype,
    'exp' => $dataexp,
    'nom' => $datanom,
);
$data = array_merge($dataDefault, $dataSession);

if (isset($_GET['p'])){
    $page = $_GET['p'];
}
if ($page === 'joueurs'){
    echo $twig->render('joueurs.twig', $data);
}elseif ($page === 'home'){
    echo $twig->render('home.twig', $data);
}elseif ($page === 'index'){
    echo $twig->render('index.twig', $data);
}elseif ($page === 'competitions'){
    echo $twig->render('competitions.twig', $data);
}elseif ($page === 'dashboard'){
    echo $twig->render('dashindex.twig', $data);
}elseif ($page === 'profil'){
    echo $twig->render('profil.twig', $data);
}elseif ($page === 'tables'){
    echo $twig->render('dtables.twig', $data);
}elseif ($page === 'counterstrike'){
    echo $twig->render('dcsgo.twig', $data);
}else{
    echo $twig->render('404.twig', $data);
}