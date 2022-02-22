<?php
function loadModel($model){
    require_once(MODEL_PATH . "/{$model}.php");
}

function loadView($view, $params = array()){
    if(count($params) > 0){
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;
            }
        }
    }
    require_once(VIEW_PATH . "/{$view}.php");
}

function loadViewTemplate($view, $params = array()){
    if(count($params) > 0){
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;
            }
        }
    }
    require_once(VIEW_TEMPLATE_PATH . "/header.php");
    require_once(VIEW_PATH . "/{$view}.php");
}