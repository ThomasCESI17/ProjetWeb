<?php

session_start();

if ($_SESSION['ID']==NULL) {
    header('Location: http://localhost/Connexion');
    exit();
}

include './accueil.html';