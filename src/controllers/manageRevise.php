<?php
validateSession();
session_start();
loadModel('Assunto');

$user = $_SESSION['user'];
$assuntos = Assunto::getAllAssuntos($user->id);
fixShowingFields($assuntos);
fixDateShowing($assuntos);

loadViewTemplate('manageRevise', ['assuntos' => $assuntos]);