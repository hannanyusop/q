<?php
session_start();
include_once('../config/database.php');
include_once('../config/var.php');
include_once('../config/function.php');
?>
<head>
    <title><?= basename($_SERVER['REQUEST_URI'], ".php").' | '.$web_title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/metisMenu/metisMenu.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

    </head>