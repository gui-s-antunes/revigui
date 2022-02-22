<?php
validateSession();
session_start();
loadModel('Area');
loadModel('SubArea');
loadModel('Assunto');
$user = $_SESSION['user'];
$assunto = null;
$id = null;
$areas = null;
$selectedArea = null;
$areaChange = null;
$sub_areas = null;
$exception = null;
$assuntoOld = null;

if(count($_POST) > 0){
    try{
        $assuntoOld = Assunto::getAssunto($user->id, $_GET['id']); // verifica se o id do assunto é válido
        $assuntoOld = Assunto::getOneAssunto($_GET['id']);
        $assuntoNew = new Assunto($_POST);
        $assuntoOld->setNewAssuntoFields($assuntoNew);
        $assuntoOld->update();
        header('Location: manageRevise.php');
        exit();
    }
    catch(ValidationException $e){
        addMsgError('Erro ao alterar assunto!');
        $exception = $e;
    }
}

if(!empty($_GET['subarea']) && !empty($_GET['id'])){
    try{
        $id = $_GET['id'];
        $selectedSubArea = $_GET['subarea'];

        $sub_area = SubArea::getOneSubArea($selectedSubArea); // subarea vinda do bd


        $areas = new Area([]);
        $areas = $areas->getAreas($user->id); // todas as areas

        $sub_areas = new SubArea([]);
        $sub_areas->verifySelectedSubArea($sub_area->areas_id, $areas);
        

        $assunto = Assunto::getAssunto($user->id, $id);
        $assunto = Assunto::getOneAssunto($id);
        $assunto->fixFields(); // sem isso, as fields ficam com a aparencia do htmlentities
        $assunto->changeSubArea($selectedSubArea);
        $assunto->update();

        header("Location: editAssunto.php?id={$id}&subete={$selectedSubArea}");
    }catch(ValidationException $e){
        addMsgError('Erro ao buscar Área ou Sub-área!');
        header('Location: manageRevise.php');
    }
}

if(!empty($_GET['option'])){
    $areas = new Area([]);
    $areas = $areas->getAreas($user->id);
    $sub_areas = new SubArea([]);
    $sub_areas = $sub_areas->getSubAreas($_GET['option'], $areas);
    $selectedArea = new Area([]);
    $selectedArea = $selectedArea->getOneArea($_GET['option']);
    $areaChange = true;
}
elseif(!empty($_GET['change']) && $_GET['change'] === '1'){
    $areas = new Area([]);
    $areas = $areas->getAreas($user->id);
    fixShowingFields($areas);
    $areaChange = true;
}

if(!empty($_GET['id'])){
    try{
        $id = $_GET['id'];
        $assunto = Assunto::getAssunto($user->id, $id); // id, nome, descricao, data de revisão, is_disabled, nome subarea, nome area
        $assunto->fixFields();
    }catch(ValidationException $e){
        addMsgError('Erro ao buscar assunto');
        header('Location: manageRevise.php');
    }

}
else{
    header('Location: manageRevise.php');
}

loadViewTemplate('editAssunto', [
    'assunto' => $assunto,
    'id' => $id,
    'selectedArea' => $selectedArea,
    'areas' => $areas,
    'areaChange' => $areaChange,
    'sub_areas' => $sub_areas,
    'exception' => $exception,
    'assuntoOld' => $assuntoOld
]);