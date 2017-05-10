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


    <div class="row">

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                            <div class="huge"><?php echo $devices[0]->count;?></div>
                            <div>Devices</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <a href="/main/devices"><span class="pull-left">View Details</span></a>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-lg-4 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $device_types[0]->count;?></div>
                            <div>Device Types</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <a href="/main/device_types"><span class="pull-left">View Details</span></a>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $ports[0]->count;?></div>
                            <div>Patches</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <a href="/main/patches"><span class="pull-left">View Details</span></a>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>




    </div>
    </div>


    <!-- Beginning footer -->
    <div></div>
    <!-- End of Footer -->
</body>
</html>