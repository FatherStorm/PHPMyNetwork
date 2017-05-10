<?php
$AddlClass="unassigned";
$tooltip="Unassigned";
$datas=array();

if($row->port_type=='WirelessOnly'){
echo '<span class="glyphicon glyphicon-cloud"  style="font-size:24pt;margin:.25em;" title="'.$row->name.' can only connect via Wifi"></span>';
}else {

    if (isset($ports[$row->id][$x])) {
        $datas=array();
        $tooltip = "";
        $AddlClass = "assigned";
        krsort($ports[$row->id][$x]);
        foreach ($ports[$row->id][$x] as $side => $assignment) {

            $idx=$side=='Front'?$x*2:$x*2+1;
            $tooltip .= sprintf(" %s Port# %d %s \r\n&rarr; %s Port# %d  %s   \r\n",
                $row->name,
                $x,
                $assignment->side,
                $assignment->name,
                $assignment->other_port,
                $assignment->other_side);
            $datas[$side] = sprintf('#port_%d_%d', $assignment->other_device, $assignment->other_port);

            $printable[$idx]=sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$x,$side,$assignment->name,$assignment->speed,$assignment->location,$assignment->other_port);

        }




    }else{
        $idx=$x*2;
        $printable[$idx]=sprintf("<tr class='ul'><td>%s</td><td></td><td></td><td></td><td></td><td></td></tr>",$x);
    }
    echo sprintf('<div  id="port_%d_%s" class="port port_%s %s" title="%s" data-target_front="%s" data-target_back="%s"   data-device="%d" data-port="%s"  data-ports="%d" data-port_type="%s">%d</div>',
        $row->id, $x,
        $row->speed,
        $AddlClass,
        $tooltip,
        @$datas->Front, @$datas->Back,
        $row->id,
        $x,
        $row->ports,
        $row->port_type,
        $x);
}