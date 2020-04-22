<?php

namespace app\core;

use app\lib\Db;

class Model{

    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

}