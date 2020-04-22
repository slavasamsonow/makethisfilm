<?php

namespace app\lib;

use PDO;

class Db
{

    protected $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db'], $config['user'], $config['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' . $key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function paramNV($params)
    {
        $paramNV = '';
        foreach ($params as $param => $val) {
            $paramNV .= $param . ' = :' . $param . ', ';
        }
        $paramNV = subst($paramNV, 0, -2);
        return $paramNV;
    }

    public function getErrorCode($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->errorInfo();
    }
}