<?php
$icon=($row->wireless==1?'glyphicon glyphicon-signal':'glyphicon glyphicon-random');
$icon_tt=($row->wireless==1?'Wireless':'Wired');
$printable=array();

?>
<?php if($row->ports>=8){?>
    <li class="device col-lg-12" data-id="<?php echo $row->id;?>">
        <span style="float:right;margin:3px;>" class="<?php echo $icon;?>" title="<?php echo $icon_tt;?>"></span>
        <span class='device_name' title="<?php echo $row->location;?>"><?php echo $row->name;?> [<?php echo $row->type;?>] <?php echo $row->location;?></span>

        <br/>
<!--            <pre>--><?php //print_r($row);?><!--</pre>-->
        <?php include(sprintf('device_%d.php',$row->ports));?>

        <table class="printable" style="width:100%;">


            <tr>
                <th>Port#</th>
                <th>Side</th>
                <th>Name</th>
                <th>Speed</th>
                <th>Location</th>
                <th>Far Port</th>
            </tr>

            <tbody  style="width:100%">
            <?php
            ksort($printable);
            echo implode("\r\n",$printable);?>
            </tbody>
        </table>
    </li>

<?php }elseif($row->ports>1){ ?>

    <li class="device device_smallish col-lg-6 col-sm-6 " data-id="<?php echo $row->id;?>">

        <span style="float:right;margin:3px;>" class=" <?php echo $icon;?>" title="<?php echo $icon_tt;?>"></span>
        <span class='device_name' title="<?php echo $row->location;?>"><?php echo $row->name;?> (<?php echo $row->id;?>) [<?php echo $row->type;?>]</span>

        <br/>
<!--            <pre>--><?php //print_r($row);?><!--</pre>-->
        <?php include(sprintf('device_%d.php',$row->ports));?>

        <table class="printable printable_limited" style="width:100%;">

            <thead>
            <tr>
                <th>Port#</th>
                <th>Side</th>
                <th>Name</th>
                <th>Speed</th>
                <th>Location</th>
                <th title="Remote Port">Far Port</th>
            </tr>
            </thead>
            <tbody  style="width:100%">
            <?php
            ksort($printable);
            echo implode("\r\n",$printable);?>
            </tbody>
        </table>
    </li>


<?php }else{ ?>

    <li class="device device_small col-lg-3 col-sm-6 " data-id="<?php echo $row->id;?>">

        <span style="float:right;margin:3px;>" class=" <?php echo $icon;?>" title="<?php echo $icon_tt;?>"></span>
        <span class='device_name' title="<?php echo $row->location;?>"><?php echo $row->name;?> [<?php echo $row->type;?>] <?php echo $row->location;?></span>

        <br/>
<!--            <pre>--><?php //print_r($row);?><!--</pre>-->
        <?php include(sprintf('device_%d.php',$row->ports));?>


    </li>

<?php } ?>

