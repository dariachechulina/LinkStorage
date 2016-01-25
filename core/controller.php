<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:36 PM
 */
class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function action_allowed_status($action, $id = NULL)
    {
        global $logged_user;
        $cur_user = $logged_user;
        if (!is_object($cur_user))
        {
            $cur_user = new User_Model();
            $role = 'anonim';
        }
        else
        {
            $role = $cur_user->get_role();
        }

        if (!is_null($id) && is_object($cur_user))
        {
            $model_name = $this->get_resource_model();
            $cur_model = new $model_name();

            if ($cur_model->is_mine($id))
            {
                $action = $action . '_own';
            }
            else
            {
                $action = $action . '_any';
            }
        }

        if (!$this->is_action_valid($action))
        {
            return '404';
        }

        global $conn;
        $query = $conn->prepare("SELECT * FROM permission WHERE role = '$role' AND action = '$action'");
        $query->execute();
        $result = $query->fetchAll();

        if (!count($result))
        {
            return 'access_denied';
        }

        return 'ok';
    }

    function is_action_valid($action)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM permission WHERE action = '$action'");
        $query->execute();
        $result = $query->fetchAll();

        if (!count($result))
        {
            return false;
        }

        return true;
    }

    public function get_resource_model()
    {

    }
}