<?php
validateSession();
loadModel('Assunto');
session_start();
$user = $_SESSION['user'];

if(!empty($_GET['id']) && !empty($_GET['toggle'])){
    try{
        $id = $_GET['id'];
        $assunto = new Assunto(['id' => $id]);
        if($_GET['toggle'] === 'disable'){
            $assunto->disableRow();
        }
        elseif($_GET['toggle'] === 'enable'){
            $assunto->enableRow();
        }
    }
    catch(Exception $e){
        echo $e;
    }
}

header('Location: manageRevise.php');