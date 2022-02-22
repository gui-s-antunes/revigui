<?php
validateSession();
session_start();
loadModel('Area');
$user = $_SESSION['user'];

$exception = null;

if(count($_POST) > 0){
    try{
        $area = new Area($_POST);
        $area->setNewArea($user->id);
        addMsgSuccess('Área criada com sucesso!');
        header('Location: createRevise.php');
    }
    catch(ValidationException $e){
        $exception = $e;
        addMsgError('Erro ao criar Área!');
    }
}

loadViewTemplate('createArea', ['exception' => $exception]);