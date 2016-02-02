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
            $role = 'anonim';
            if (!is_null($id))
            {
                $action = $action . '_any';
            }

            if (!$this->is_action_valid($action))
            {
                return 'access_denied';
            }
        }
        else
        {
            $role = $cur_user->get_role();
        }

        if (!is_null($id) && is_object($cur_user))
        {
            $model_name = $this->get_resource_model();
            $cur_model = new $model_name();

            $result_status = $cur_model->is_mine($id);

            $flag = false;

            switch ($result_status)
            {
                case 1 :
                    $action = $action . '_own';
                    break;

                case 2:
                    $action = $action . '_any';
                    break;

                case 0:
                    $flag = true;
                    break;
            }

            if ($flag && strcmp($role, 'admin') == 0 && strcmp($model_name, 'User_Model') == 0)
            {
                return '404';
            }

            if ($flag && strcmp($role, 'user') !== 0 && strcmp($model_name, 'Link_Model') == 0)
            {
                return '404';
            }

            if ($flag)
            {
                return 'access_denied';
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