<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: ../Connexion');
    exit();
}

include('./assets/element/headglobale.html');

$headerpage = './header'.$_COOKIE['qualification'].'.html';

include $headerpage;

include './gestion-materiel.html';

include('./assets/element/footglobale.html');