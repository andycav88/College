<?php
include_once "includes/defaults.php";
include_once "models/DB.php";
include_once "models/student.php";
include_once "models/professor.php";
//include_once "includes/header.php";

$controller = $_GET['controller'];
$action = $_GET['action'];
$id = $_GET['id'];

if (empty($action)) {
    $action = "index";
}
if ($controller == "denied") {
    header("Location: index.php");
}
$ctrlName = $controller . "Controller";
include "./controllers/$ctrlName.php";
$ctrl = new $ctrlName;
$ctrl->{$action}($id);
