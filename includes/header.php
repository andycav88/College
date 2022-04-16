<?php

session_start();
if ($title != "Password Reset" && $title != "Register")
    if (!$_SESSION['active']) {
        $ruta = "Location:http://" . $_SERVER['SERVER_NAME'] . "/college/";
        header("Location:http://" . $_SERVER['SERVER_NAME'] . "/college/");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- <title>Dashboard - SB Admin</title> -->
    <title><?php echo $title ?></title>
    <link href="http://localhost/college/dist/css/style.online.css" rel="stylesheet" />
    <link href="http://localhost/college/dist/css/styles.css" rel="stylesheet" />
    <script src="http://localhost/college/dist/js/all.js"></script>

    <script src="http://localhost/college/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost/college/dist/js/scripts.js"></script>
    <script src="http://localhost/college/dist/js/jquery-3.6.0.js"></script>
    <script src="http://localhost/college/dist/js/Chart.min.js"></script>
    <!-- <script src="http://localhost/college/dist/js/simple-datatables.js"></script> -->
    <script src="http://localhost/college/dist/js/datatables-simple-demo.js"></script>
</head>