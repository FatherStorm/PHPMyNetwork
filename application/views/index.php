<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <?php
    if (isset($css_files)) {
        foreach ($css_files as $file) {
            sprintf(' <link type="text/css" rel="stylesheet" href="%s" />', $file);
        }
    }
    if (isset($js_files)) {
        foreach ($js_files as $file) {
            sprintf(' <script src="%s"></script> ', $file);
        }
    }
    ?>
    <?php require_once('basic.php'); ?>
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
<style>
    table.printable{
        display:none;
    }
</style>
</head>
<body>
<!-- Beginning header -->
<div>
    <?php require_once('devices/nav.php');?>

</div>
<?php

?>
<div id="container">

    <h1><?php echo $title; ?><a href="#" class='toggleDetails right'><button>Toggle Details</button></a></h1>


    <div id="infoMessage"><?php echo @$message; ?></div>
    <?php require('devices/rack_main.php'); ?>


    <!-- Beginning footer -->
    <div></div>
    <!-- End of Footer -->
</body>
<?php require('devices/associate.php'); ?>
<?php require('devices/disassociate.php'); ?>
</html>