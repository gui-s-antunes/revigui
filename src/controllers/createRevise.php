<?php
validateSession();
loadModel('Area');
loadModel('SubArea');
loadModel('Assunto');
session_start();
$user = $_SESSION['user'];
$areas = null;
$sub_areas = null;
$selectedArea = null;
$date = new DateTime();
$date->modify('-2 year');
$date = $date->format('Y-m-d');
$exception = null;
$areas = new Area([]);
$areas = $areas->getAreas($user->id); // 
fixShowingFields($areas);

if($_GET['option']){
    $id = $_GET['option'];
    try{
        $sub_areas = new SubArea([]); 
        $sub_areas = $sub_areas->getSubAreas($id, $areas);
        fixShowingFields($sub_areas);
        $selectedArea = new Area([]); 
        $selectedArea = $selectedArea->getOneArea($id);
        $selectedArea->fixFields();
    }
    catch(ValidationException $e){
        $exception = $e;
        addMsgError('Erro ao procurar Área ou Subárea');
    }
}

if(count($_POST) > 0){
    try{
        $assunto = new Assunto($_POST);
        $assunto->setAssunto($sub_areas);
        $assunto->insert();
        addMsgSuccess('Sucesso ao adicionar o assunto!');
        $_POST = [];
    } catch(ValidationException $e){
        $exception = $e;
        addMsgError('Falha ao adicionar assunto!');
    }
}




loadViewTemplate('createRevise', ['areas' => $areas, 'selectedArea' => $selectedArea, 'sub_areas' => $sub_areas, 'dateLimit' => $date]);