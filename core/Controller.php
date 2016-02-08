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
        $this->model = new Model();
    }

    function action_allowed_status($action, $id = NULL)
    {
        global $logged_user;
        $cur_user = $logged_user;
        if (!is_object($cur_user))
        {
            $role = ANONYMOUS;
            if (!is_null($id))
            {
                $action = $action . '_any';
            }

            if (!$this->model->is_action_valid($action))
            {
                return ACCESS_DENIED;
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

            $model_exists = $cur_model->exists($id);

            if ($model_exists)
            {
                $is_mine = $cur_model->is_mine($id);
                if ($is_mine)
                {
                    $action .= '_own';
                }
                else
                {
                    $action = $action . '_any';
                }
            }

            else
            {
                if (strcmp($role, ADMIN) == 0)
                {
                    return NOT_FOUND;
                }
                else
                {
                    return ACCESS_DENIED;
                }
            }
        }


        if (!$this->model->is_action_valid($action))
        {
            return NOT_FOUND;
        }

        if (!$this->model->is_action_allowed($role, $action))
        {
            return ACCESS_DENIED;
        }

        return SUCCESS;
    }


    public function get_resource_model()
    {

    }
}