<option data-ports="0" value="0">Select A Device</option>
<?php



foreach ($devices as $row) {
      if ($row->device_type <> 11  && isset($availability[$row->id])) {


        if($availability[$row->id]->connections < $availability[$row->id]->ports) {
            echo sprintf("<option value='%s' data-ports='%d' data-port_type='%s'>%s</option>\r\n", $row->id, $row->ports, $row->port_type, $row->name);
        }
    } elseif ($row->device_type == 11   && isset($availability[$row->id])) {
        if($availability[$row->id]->connections < $availability[$row->id]->ports * 2){
            echo sprintf("<option value='%s' data-ports='%d'  data-port_type='%s'>%s</option>\r\n", $row->id, $row->ports, $row->port_type, $row->name);
        }

    } else {
    }
}; ?>