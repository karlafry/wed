<?php

class Database extends \mysqli
{
    private $connection;
    private static $instance;

    public function __construct() {
        $this->connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME, null, null);
        $this->connection->set_charset('utf8');

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to connect to Database: " . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }

    /*
	* Get an instance of the Database
	* @return Instance
	*/
    public static function instance() {
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

    /*
     *  Get mysqli connection
     * @return connection
     */
    public function getConnection() {
        return $this->connection;
    }

    public static function db() {
        return self::instance()->getConnection();
    }

    function __destruct() {
        $this->connection->close();
    }


    public static function sqlFromFilters(\stdClass $filters = null, $where = true)
    {
        $sql = '';

        if (count($filters) > 0) {
            $elements = array();
            foreach ($filters as $column => $value) {
                if ($column == 'custom') {
                    $str = implode("\n		AND ", $value);

                    $elements[] = $str;

                    continue;
                }

                if ($column == 'custom_or') {
                    if (count($value) <= 0) {
                        continue;
                    }

                    $str = "(\n\t".implode(" \n\t OR ", $value)."\n\t)";

                    $elements[] = $str;
                    continue;
                }

                if (in_array($column, array('group_by', 'order_by', 'limit'))) {
                    continue;
                }

                $column = str_replace('.', '¦', $column);
                $str = '`'.str_replace('¦', '`.`', $column).'` ';

                if (is_array($value)) {
                    $value = array_unique($value);
                    $str .= "IN ('".implode("', '", $value)."')";
                } elseif (is_numeric($value)) {
                    $str .= '= '.$value;
                } elseif (is_bool($value)) {
                    $str .= '= '.(int) $value;
                } elseif (strpos($value, '%') !== false) {
                    $str .= "LIKE '".$value."'";
                } elseif ($value == 'IS NULL' || strpos($value, 'NOT') !== false || strpos($value, 'BETWEEN') !== false || strpos($value, '!') !== false) {
                    $str .= $value;
                } else {
                    $str .= "= '".$value."'";
                }

                $elements[] = $str;
            }
            if (count($elements) > 0) {
                $sql .= ($where ? 'WHERE ' : 'AND ').implode("\n		AND ", $elements)."\n";
            }

            if (isset($filters->group_by) && is_array($filters->group_by)) {
                $sql .= "GROUP BY\t".implode(",\n\t\t", $filters->group_by)."\n";
            }

            if (isset($filters->order_by)) {
                $order_by = (array) $filters->order_by;
                $sql .= "ORDER BY\t".implode(",\n\t\t", $order_by)."\n";
            }

            if (isset($filters->limit) && $filters->limit != '') {
                $sql .= 'LIMIT '.$filters->limit."\n";
            }
        }

        return $sql;
    }

    public static function fetchAssoc($stmt)
    {
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $result = array();
            $md = $stmt->result_metadata();
            $params = array();
            while($field = $md->fetch_field()) {
                $params[] = &$result[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $params);
            if($stmt->fetch())
                return $result;
        }

        return null;
    }

    public static function fetchObject($stmt)
    {
        $array = self::fetchAssoc($stmt);

        if($array) {
            return (object) $array;
        }
        return null;
    }

    public static function showSql($sql,$params)
    {
        for ($i=0; $i<count($params); $i++) {
            $sql = preg_replace('/\?/',$params[$i],$sql,1);
        }
        return '<pre>'.$sql.'</pre>';
    }
}