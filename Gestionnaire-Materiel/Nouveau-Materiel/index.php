<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: '. $_SERVER['DOCUMENT_ROOT'] .'/Connexion');
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/headglobale.html');

$headerpage = 'header'.$_COOKIE['qualification'].'.html';

include $headerpage;

include './nouveaumat.html';

include($_SERVER['DOCUMENT_ROOT'] . '/Gestionnaire-Materiel/assets/element/footglobale.html');