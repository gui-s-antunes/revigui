<?php
loadModel('Login');
session_start();
$exception = null;

if(count($_POST) > 0){
    try{
        $user = new Login($_POST);
        $user = $user->checkLogin();
        $_SESSION['user'] = $user;
        header('Location: paginaInicial.php');
    }
    catch(ValidationException $e){
        $exception = $e;
        addMsgError('Erro ao validar formulário');
    }
}

loadView('login', $_POST + ['exception' => $exception]);