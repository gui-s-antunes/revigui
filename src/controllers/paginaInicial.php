<?php
validateSession();
checkAssuntos();
$todayAssuntos = getTodayAssuntos();
$todayAssuntos = filterEnabled($todayAssuntos);
$todayAssuntos = splitAssuntosByArea($todayAssuntos); // area e subarea
fixShowingFields($assuntos);
session_start();
$date = new Datetime();
$date = $date->format('d/m/Y');

loadViewTemplate('paginaInicial', ['date' => $date, 'todayAssuntos' => $todayAssuntos]);