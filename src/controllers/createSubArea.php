<?php
validateSession();
session_start();
loadModel('Area');
loadModel('SubArea');
$user = $_SESSION['user'];
$exception = null;


$areas = new Area([]);
$areas = $areas->getAreas($user->id);
fixShowingFields($areas);

if(count($_POST) > 0){
    try{
        $subarea = new SubArea($_POST);
        $subarea->setNewSubArea($areas);
        addMsgSuccess('Sub-área criada com sucesso!');
    }catch(ValidationException $e){
        $exception = $e;
        addMsgError('Erro ao criar sub-área');
    }
}

loadViewTemplate('createSubArea', ['areas' => $areas, 'exception' => $exception]);