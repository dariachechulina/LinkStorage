<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:36 PM
 */
class model
{
    protected $connection;

    public function __construct()
    {
        $login = "root";
        $pass = "qwerty123";

        $this->connection = new PDO("mysql:host=localhost;dbname=testdb", $login, $pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //@TODO maybe it is better to make it abstract?
    public function is_mine($id)
    {
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