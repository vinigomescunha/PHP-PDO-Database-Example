<?php
//created by vinicius gomes - vinigomescunha at gmail.com
define('HOST', 'mysql host');
define('USER', 'mysql user');
define('PWD', 'mysql pass');
define('DB', 'mysql database');
/*
  CREATE TABLE ips(
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  ip text NOT NULL,
  PRIMARY KEY (id)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

 */

Class cPDO extends PDO {

    private $h = HOST, $u = USER, $p = PWD, $db = DB, $pt = '3306', $sgbd = 'mysql', $conn;

    public function __construct() {
        try {
            $str = "{$this->sgbd}:pt={$this->pt};host={$this->h};dbname={$this->db}";
            $this->conn = new PDO($str, $this->u, $this->p);
            $this->conn->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getdata($fd = array(), $t, $c = 1) {
        $dt = array();
        try {
            $sql = "SELECT " . implode(",", $fd) . " FROM " . implode(",", $t) . " WHERE $c";
            foreach ($this->conn->query($sql) as $k => $row) {
                foreach ($fd as $f) {
                    $dt[$k][$f] = $row[$f];
                }
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $dt;
    }

    public function endC() {
        $this->conn = null;
    }

    public function insertdata($c, $t) {
        $sql = "INSERT INTO $t(" . implode(",", array_keys($c)) . ") VALUES (\"" . implode("\",\"", $c) . "\")";
        $l = $this->conn->exec($sql);
        return $this->conn->lastInsertId(); /* return last id inserted */
    }

}
