<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:36 PM
 */
class model
{
    static $error_pull = array();

    protected $connection;

    public function __construct()
    {
        $login = "root";
        $pass = "qwerty123";

        $this->connection = new PDO("mysql:host=localhost;dbname=testdb", $login, $pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function is_mine($id)
    {
    }

    static function print_array(array $error_list)
    {
        $result_string = '';
        foreach ($error_list as $error)
        {
           $result_string = $result_string . '<br> <h3>' . $error .'</h3>';
        }

        return $result_string;
    }

    public function is_action_allowed($role, $action)
    {
        $query = $this->connection->prepare("SELECT * FROM permission WHERE role = '$role' AND action = '$action'");
        $query->execute();
        $result = $query->fetchAll();
        if (!count($result))
        {
            return false;
        }

        return true;
    }

    public function is_action_valid($action)
    {
        $query = $this->connection->prepare("SELECT * FROM permission WHERE action = '$action'");
        $query->execute();
        $result = $query->fetchAll();

        if (!count($result))
        {
            return false;
        }

        return true;
    }
}