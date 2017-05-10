<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>


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
    <?php echo $output; ?>


    <!-- Beginning footer -->
    <div></div>
    <!-- End of Footer -->
</body>
</html>