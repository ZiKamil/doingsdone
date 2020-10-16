<?php


$urlnavigationOfProject = "/index.php?".(isset($_GET['ParamSelect'])? 'ParamSelect='.esc($_GET['ParamSelect']) : '').(isset($_GET['show_completed'])?'&show_completed='.esc($_GET['show_completed']):'').'&project=';

$currentproject = isset($_GET['project']) ? esc($_GET['project']) : "";

$contentside = include_template('contentside.php', [
    'projectz' => $projectz,
    'urlnavigationOfProject' => $urlnavigationOfProject,
    'currentproject' => $currentproject
]);



