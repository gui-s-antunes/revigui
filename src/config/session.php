<?php

function validateSession($admin = false){
    session_start();
    $user = $_SESSION['user'];
    if(!isset($user)){
        header('Location: login.php');
        exit();
    }
    elseif($admin && !$_SESSION['user']->is_admin){
        header('Location: paginaInicial.php');
        exit();
    }
}

function isLoggedIn(){
    session_start();
    if($_SESSION['user']){
        header('Location: paginaInicial.php');
    }
}