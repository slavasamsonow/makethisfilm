<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{


    /**
     * Проверка логина и пароля
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public function checkUser($username, $password)
    {
        if (preg_match('#@#', $username)) {
            $params = [
                'email' => $username
            ];
            $hash = $this->db->column('SELECT `password` FROM `users` WHERE `email` = :email', $params);
        } else {
            $params = [
                'username' => $username
            ];
            $hash = $this->db->column('SELECT `password` FROM `users` WHERE `username` = :username', $params);
        }
        if (!$hash or $hash != md5('MaRy' . $password)) {
            return false;
        }
        return true;
    }

    public function login($username, $remember){
        if (preg_match('#@#', $username)) {
            $params = [
                'email' => $username
            ];
            $data = $this->db->row('SELECT * FROM `users` WHERE `email` = :email', $params);
        } else {
            $params = [
                'username' => $username
            ];
            $data = $this->db->row('SELECT * FROM `users` WHERE `username` = :username', $params);
        }

        $_SESSION['user'] = $data;
        if($remember == 'remember'){
            setcookie('i', $data['id'], time() + 3600 * 24 * 30, '/');
            setcookie('p', $data['password'], time() + 3600 * 24 * 30, '/');
        }
        else{
            setcookie('i', '', time(), '/');
            setcookie('p', '', time(), '/');
        }
        return true;
    }
}