<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:36 PM
 */
class Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DB_DSN, DB_LOGIN, DB_PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function is_mine($id) {}
    public function exists($id)  {}
}