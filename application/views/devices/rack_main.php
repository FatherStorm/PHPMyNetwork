<div id="body">
    <!-- End of header-->
    <div style='height:20px;'></div>
    <ul id=sortable>
        <?php
        $sortByNatural=$sortByPorts=$sortSinglePorts=array();
        foreach($devices as $row){
            if ($row->ports >= 8) {
                $sortByNatural[]=$row;
            }elseif($row->ports ==1){
                $sortSinglePorts[]=$row;
            } else{
                $sortByPorts[]=$row;
            }
        }
        usort($sortByPorts,function($a,$b){
           return $a->ports<=$b->ports;
        });



        foreach ($sortByNatural as $row) {
                require('device.php');
        };
        foreach ($sortByPorts as $row) {
                require('device.php');
        };
        echo"<br style='clear:both'/>";
        foreach ($sortSinglePorts as $row) {
                require('device.php');
        };
        ?>


    </ul>
    <br style="clear:both;">
</div>