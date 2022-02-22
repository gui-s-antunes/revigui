<?php

function addMsgSuccess($msg){
    $_SESSION['message'] = [
        'type' => 'success-message',
        'msg' => $msg
    ];
}

function addMsgError($msg){
    $_SESSION['message'] = [
        'type' => 'error-message',
        'msg' => $msg
    ];
}

function fixShowingFields($objects){
    foreach($objects as $object){
        $object->fixFields();
    }
}

function fixDateShowing($assuntos){
    foreach($assuntos as $assunto){
        $assunto->date_revise = convertDateToDayMonthYear($assunto->date_revise);
    }
}

function convertDateToDayMonthYear($date){
    $dateFormatted = new DateTime($date);
    return $dateFormatted->format('d/m/Y');
}