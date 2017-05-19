<?php


class Network_rack_model extends SimpleDB{

    protected $db;

    public function __construct(){

        $this->ci = & get_instance();
        $DB = $this->ci->db;
        try {
            $this->dbh = new PDO(sprintf('mysql:dbname=%s;host=%s',$DB->database , $DB->hostname), $DB->username, $DB->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            return $this->dbh;
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage() . var_export($DB, true));
        }

    }
    public function query($sql, $params = array(), $interpolate = false,  $fetch = 'fetchAll', $return = PDO::FETCH_OBJ, $time_zone = false)
    {
        $read='read';
        if ((substr(strtolower(trim($sql)), 0, 6) == 'delete' || substr(strtolower(trim($sql)), 0, 6) == 'update' || substr(strtolower(trim($sql)), 0, 6) == 'insert')) {
            $read = 'write';
        }


        if ($time_zone != false) {
            $stmt = $this->dbh->prepare("set time_zone=:time_zone");
            $p    = array(':time_zone' => $time_zone);
            $stmt->execute($p);
        }

        $interpolated = $sql;
        foreach ($params as $key => $value) {
            if (is_int($value)) {
                $interpolated = str_replace($key, (int) $value, $interpolated);
            } else {
                $interpolated = str_replace($key, "'$value'", $interpolated);
            }
        }

        if ($interpolate != false) {

            switch ($interpolate) {
                case 'current_time':
                    $sql  = "Select current_timestamp";
                    $stmt = $this->dbh->prepare($sql);
                    $stmt->execute();
                    return ($stmt->fetch(PDO::FETCH_COLUMN));

                    break;
                case 'get_time_zone':
                    $sql  = "SELECT @@session.time_zone";
                    $stmt = $this->dbh->prepare($sql);
                    $stmt->execute();
                    return  ($stmt->fetch(PDO::FETCH_COLUMN));

                    break;
                case 'return':
                    return $interpolated;
                    break;
                case 'inline':
                    echo "<pre>$interpolated</pre>";
                    break;
                case 'dump':
                case 'exit_after':
                    break;
                case 'exit':
                default:
                    return "<pre>$interpolated</pre>";
                    die();
                    break;
            }
        }

        if ($read != 'write' && $read != 'insert' && $read != 'delete') {
            try {
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute($params);
            } catch (Exception $e) {
                return  ' | Query: ' . $sql . ' | Exception: ' . $e->getMessage();
            }

        } else {

            try {
                $stmt = $this->dbh->prepare($sql);
                $stmt->execute($params);
            } catch (Exception $e) {
                return ' | Query: ' . $sql . ' | Exception: ' . $e->getMessage();
            }
            if (substr(trim(strtolower($sql)), 0, 6) == 'insert') {
                $return = $this->dbh->lastInsertId();
                return $return;
            }
        }

        try {
            $return = $stmt->$fetch($return);
            if ($interpolate == 'dump') {
                return $this->pretty_print_r($stmt);
                return $this->pretty_print_r($return);
            } elseif ($interpolate == 'exit_after') {
                return $this->pretty_print_r($stmt);
                return $this->pretty_print_r($return, true);
            }
        } catch (Exception $e) {
            $msg = ' | Query: ' . $sql . ' | Exception: ' . $e->getMessage();

            return $msg;
        }

        return $return;
    }

    public function get_devices($user=1){
        $sql="SELECT d.*,
               dt.NAME AS type
        FROM   devices d
               JOIN device_type dt
                 ON dt.device_type = d.device_type
        WHERE  d.active = 1
               AND d.user_id = :user
        ORDER  BY d.position ";
        $params=array(":user"=>$user);

        return $this->query($sql,$params);
    }

    public function get_patches($user=1){
        $sql=("Select * from patches where user_id=:user");
        $params=array(":user"=>$user);
        return $this->query($sql,$params);
    }

    public function get_availability($user=1){
        $sql="SELECT Sum(connections) AS connections,
                       id,
                       ports
                FROM   (SELECT Count(pa.`device 1`) AS connections,
                               d.id,
                               d.ports              AS ports
                        FROM   devices d
                               LEFT JOIN patches pa
                                      ON pa.`device 1` = d.id
                                         AND pa.user_id = d.user_id
                        WHERE  d.user_id = :user
                        GROUP  BY 2
                        UNION ALL
                        SELECT Count(pa.`device 2`) AS connections,
                               d.id,
                               d.ports              AS ports
                        FROM   devices d
                               LEFT JOIN patches pa
                                      ON pa.`device 2` = d.id
                                         AND pa.user_id = d.user_id
                        WHERE  d.user_id = :user
                        GROUP  BY 2
                        UNION ALL
                        SELECT 0       AS connections,
                               d.id,
                               d.ports AS ports
                        FROM   devices d
                        WHERE  d.user_id = :user
                               AND d.id NOT IN (SELECT `device 2`
                                                FROM   patches
                                                WHERE  user_id = :user
                                                UNION ALL
                                                SELECT `device 1`
                                                FROM   patches
                                                WHERE  user_id = :user)
                        GROUP  BY 2)a
                GROUP  BY 2
                 ";

        $params=array(":user"=>$user);
        return $this->query($sql,$params);
    }


    public function assign_patch($device_1=false,$port_1=false,$side_1=false,$device_2=false,$port_2=false,$side_2=false,$user=false)
    {
        $sql = "INSERT INTO patches
                            (`device 1`,
                             `port 1`,
                             `side 1`,
                             `device 2`,
                             `port 2`,
                             `side 2`,
                             `user_id`)
                VALUES     ( :device_1,
                             :port_1,
                             :side_1,
                             :device_2,
                             :port_2,
                             :side_2,
                             :user) ";
        $params=array(':device_1'=>$device_1,
                      ':port_1'=>$port_1,
                      ':side_1'=>$side_1,
                      ':device_2'=>$device_2,
                      ':port_2'=>$port_2,
                      ':side_2'=>$side_2,
                      ':user'=>$user);
        return $this->query($sql,$params);

    }
    public function check_port_free($device_1=false,$port_1=false,$side_1=false,$device_2=false,$port_2=false,$side_2=false,$user=false){
        $sql = "SELECT 'from'     AS source,
                           d.name     AS device_name,
                           `device 1` AS device,
                           `side 1`   AS side,
                           `port 1`   AS port
                    FROM   patches pa
                           JOIN devices d
                             ON d.id = :device_1
                    WHERE  ( ( `device 1` =:device_1
                               AND `port 1` = :port_1
                               AND `side 1` = :side_1 )
                              OR ( `device 2` =:device_1
                                   AND `port 2` = :port_1
                                   AND `side 2` = :side_1 ) )
                           AND pa.user_id =:user
                    UNION ALL
                    SELECT 'to'       AS source,
                           d.name     AS device_name,
                           `device 1` AS device,
                           `side 1`   AS side,
                           `port 1`   AS port
                    FROM   patches pa
                           JOIN devices d
                             ON d.id = :device_2
                    WHERE  ( ( `device 1` =:device_2
                               AND `port 1` = :port_2
                               AND `side 1` = :side_2 )
                              OR ( `device 2` =:device_2
                                   AND `port 2` = :port_2
                                   AND `side 2` = :side_2 ) )
                           AND pa.user_id =:user  ";
        $params=array(':device_1'=>$device_1,':port_1'=>$port_1,':side_1'=>$side_1,':device_2'=>$device_2,':port_2'=>$port_2,':side_2'=>$side_2,':user'=>$user);
        return $this->query($sql,$params);
    }
    
    public function get_user_ports($user=1){
        $sql="SELECT
                                                d1.name,
                                                d1.speed,
                                                d1.location,
                                                dt.name as device,
                                                pa.`device 2` AS device_id,
                                                pa.`port 2` AS port,
                                                pa.`side 2` AS side,
                                                pa.`port 1` AS other_port,
                                                pa.`side 1` AS other_side,
                                                pa.`device 1` AS other_device
                                            FROM
                                                patches pa
                                                    JOIN
                                                devices d1 ON d1.id = pa.`device 1`
                                                    JOIN
                                                device_type dt ON dt.device_type = d1.device_type
                                                WHERE d1.user_id=:user
                                              AND pa.user_id=:user
                                              AND (dt.user_id is NULL or dt.user_id=:user)
                                            UNION ALL SELECT
                                                d2.name,
                                                d2.speed,
                                                d2.location,
                                                dt.name as device,
                                                pa.`device 1` AS device_id,
                                                pa.`port 1` AS port,
                                                pa.`side 1` AS side,
                                                pa.`port 2` AS other_port,
                                                pa.`side 2` AS other_side,
                                                pa.`device 2` AS other_device
                                            FROM
                                                patches pa
                                                    JOIN
                                                devices d2 ON d2.id = pa.`device 2`
                                                    JOIN
                                                device_type dt ON dt.device_type = d2.device_type
                                                  WHERE d2.user_id=:user
                                              AND pa.user_id=:user
                                              AND (dt.user_id is NULL or dt.user_id=:user)";
        $params=array(':user'=>$user);
        return $this->query($sql,$params);
        
    }
    
    public function get_ports($user=1){
        $sql =("SELECT
                                                d1.name,
                                                d1.speed,
                                                d1.location,
                                                dt.name as device,
                                                pa.`device 2` AS device_id,
                                                pa.`port 2` AS port,
                                                pa.`side 2` AS side,
                                                pa.`port 1` AS other_port,
                                                pa.`side 1` AS other_side,
                                                pa.`device 1` AS other_device
                                            FROM
                                                patches pa
                                                    JOIN
                                                devices d1 ON d1.id = pa.`device 1`
                                                    JOIN
                                                device_type dt ON dt.device_type = d1.device_type
                                                where d1.user_id=1 and pa.user_id=:user
                                            UNION ALL SELECT
                                                d2.name,
                                                d2.speed,
                                                d2.location,
                                                dt.name as device,
                                                pa.`device 1` AS device_id,
                                                pa.`port 1` AS port,
                                                pa.`side 1` AS side,
                                                pa.`port 2` AS other_port,
                                                pa.`side 2` AS other_side,
                                                pa.`device 2` AS other_device
                                            FROM
                                                patches pa
                                                    JOIN
                                                devices d2 ON d2.id = pa.`device 2`
                                                    JOIN
                                                device_type dt ON dt.device_type = d2.device_type
                                                where d2.user_id=:user and pa.user_id=:user");


        // By default I use my own account as the displayed rack.
        $params=array(':user'=>$user);
        return $this->query($sql,$params);
    }
    public function get_device_count($user=1){

        $sql="SELECT Count(d.id)   AS count,
                       Sum(d.active) AS active
                FROM   devices d

                WHERE  (
                            d.user_id = :user
                        ) ";

        $params=array(':user'=>$user);
        return $this->query($sql,$params);
    }
    public function get_device_type_count($user=1){
        $sql="SELECT Count(distinct(d.device_type)) AS count
                FROM   device_type d
                WHERE   d.user_id =  :user ";
        $params=array(':user'=>$user);

        return $this->query($sql,$params);
    }
    public function get_patch_count($user=1){

        $sql="SELECT Count(1) AS count
                FROM   patches
                WHERE  user_id = :user ";
        $params=array(':user'=>$user);
        return $this->query($sql,$params);
    }

    public function get_next_position($user){
        $sql="Select max(position)+1 as position from devices where  user_id=:user";
        $params=array(':user'=>$user);
        return $this->query($sql,$params,false,'fetch');
    }

    public function delete_patch($user=false,$device=false, $port=false,$side='All'){

        switch ($side) {
            case 'Front':
            case 'Back':
                $sql = "DELETE FROM patches
                        WHERE  ( ( `device 1` = :device
                                   AND `port 1` = :port
                                   AND `side 1` = :side )
                                  OR ( `device 2` = :device
                                       AND `port 2` = :port
                                       AND `side 2` = :side ) )
                               AND user_id = :user ";
            $params=array(':user'=>$user,':device'=>$device,':port'=>$port,':side'=>$side);
            return $this->query($sql,$params);
                break;
            case 'All':
                $sql = "DELETE FROM patches
                        WHERE  ( ( `device 1` = :device
                                   AND `port 1` = :port )
                                  OR ( `device 2` = :device
                                       AND `port 2` = :port ) )
                               AND user_id = :user   ";
                $params=array(':user'=>$user,':device'=>$device,':port'=>$port);
                return $this->query($sql,$params);
                break;
            default:
                return false;
            break;
        }
    }
    public function reorder($user,$order){

        $sql = "UPDATE devices
                SET    position = NULL
                WHERE  user_id = :user ";

        $params=array(':user'=>$user);
        $this->query($sql,$params);


        foreach ($order as $o => $device) {
            $sql = "UPDATE devices
                    SET    position = :position
                    WHERE  user_id = :user
                    AND id = :device ";
            $params = array(':position'=>$o + 1, ':user'=>$user,':device'=>$device);
            $this->query($sql,$params);
        }
    }
}