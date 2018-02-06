<?php

/**
 * Created by PhpStorm.
 * User: karla
 * Date: 28/01/2018
 * Time: 16:33
 */
class Database
{
    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi(DBHOST, DBUSER, DBPASS, DBNAME);
        $this->connection->set_charset('utf8');
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
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

                $column = str_replace('.', '�', $column);
                $str = '`'.str_replace('�', '`.`', $column).'` ';

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
}