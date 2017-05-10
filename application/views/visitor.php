<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to My Network Rack</title>

    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
  <?php require_once('basic.php');?>

</head>
<body>
<h1><?php echo $title; ?>
    <a href="#" class='toggleDetails right'><button>Toggle Details</button></a>
    <a href='/main' class="right"><button><?php echo $loggedIn==true?'Configure':'Log In';?></button></a>
    <a href='/auth/<?php echo $loggedIn==true?'logout':'create_user';?>'class="right"><button><?php echo $loggedIn==true?'Log Out':'Sign Up';?></button></a>
</h1>

<div id="container">
<div id="infoMessage"><?php echo @$message; ?></div>
    <?php require('devices/rack_main.php');?>

</div>
<style>
    table.printable{
        display:block;
    }
</style>
<?php require_once('devices/disassociate.php');?>
</body>
</html>
