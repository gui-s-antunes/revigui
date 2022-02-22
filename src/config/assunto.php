<?php

function fixNextRevises($assuntos){
    $date = new DateTime();
    $date->setTime(0, 0, 0, 0);
    
    foreach($assuntos as $assunto){
        $dateAssunto = new DateTime($assunto->date_revise);
        $revive_streak = $assunto->revive_streak;
        
        while($dateAssunto < $date){
            $revive_streak += $revive_streak;
            $dateAssunto->modify("+{$revive_streak} day");
        }

        $oldDateRevise = new DateTime($assunto->date_revise);
        
        if($oldDateRevise != $dateAssunto){
            $assunto->setNewReviseDate($dateAssunto->format('Y-m-d'), $revive_streak);
            $assunto->update();
        }
    }
}

function checkAssuntos(){
    $assuntos = getAssuntos();
    fixNextRevises($assuntos);
}

function filterEnabled($assuntos){
    $enabledAssuntos = [];
    foreach($assuntos as $assunto){
        if($assunto->is_disabled === "0"){
            array_push($enabledAssuntos, $assunto);
        }
    }
    return $enabledAssuntos;
}

function getAssuntos(){
    loadModel('Assunto');
    $user = $_SESSION['user'];
    return Assunto::getUserAssuntos($user->id);
}

function getAssuntosPlusParents(){
    loadModel('Assunto');
    $user = $_SESSION['user'];
    return Assunto::getAllAssuntos($user->id);
}

function getTodayAssuntos(){
    $assuntos = getAssuntosPlusParents();
    $date = new DateTime();
    $date->setTime(0,0,0,0);

    $todayAssuntos = [];

    foreach($assuntos as $assunto){
        $date_revise = new DateTime($assunto->date_revise);
        if($date_revise == $date){
            array_push($todayAssuntos, $assunto);
        }
    }

    return $todayAssuntos;
}

function splitAssuntosByArea($assuntos){
    $splitedAssuntos = [];
    $currentArea = '';
    $currentSubArea = '';
    $subareas = [];
    $area = [];

    foreach($assuntos as $assunto){
        if($assunto->area !== $currentArea){
            if(count($subareas) > 0) $area[$currentSubArea] = $subareas;
            if(count($area) > 0) $splitedAssuntos[$currentArea] = $area;
            $area = [];
            $subareas = [];
            $currentArea = $assunto->area;
        }

        if($assunto->sub_area !== $currentSubArea){
            if(count($subareas) > 0) $area[$currentSubArea] = $subareas; 
            $subareas = [];
            $currentSubArea = $assunto->sub_area;
        }

        array_push($subareas, $assunto);
    }

    if(count($subareas) > 0) $area[$currentSubArea] = $subareas;
    if(count($area) > 0) $splitedAssuntos[$currentArea] = $area;
    return $splitedAssuntos;
}