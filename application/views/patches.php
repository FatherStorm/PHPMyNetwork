<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <?php //
    //foreach($css_files as $file): ?>
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo $file; ?><!--" />-->
    <!-- -->
    <?php //endforeach; ?>
    <?php //foreach($js_files as $file): ?>
    <!-- -->
    <!--    <script src="--><?php //echo $file; ?><!--"></script>-->
    <?php //endforeach; ?>
    <?php require_once('basic.php'); ?>

</head>
<body>
<!-- Beginning header -->
<div>
  <?php require_once('devices/nav.php');?>
</div>
<?php

?>
<div id="container">

    <h1><?php echo $title; ?></h1>


    <div id="infoMessage"><?php echo @$message; ?></div>
   <?php require('devices/rack_main.php');?>


    <!-- Beginning footer -->
    <div></div>
    <!-- End of Footer -->
</body>
<?php require_once('devices/associate.php');?>
<?php require_once('devices/disassociate.php');?>
</html>