<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 5:01 PM
 */
class User_Controller extends Controller
{
    private $resource_model = 'User_Model';

    function __construct()
    {
        $this->model = new User_Model();
    }

    function action_login()
    {
        $model = $this->model;

        if (!isset($_POST['login_button']))
        {
            $this->view = new Main_View(array(CONTENT => 'Login'));
            $this->view->render();
        }
        else
        {
            $model->set_login($_POST['login']);
            $model->pass = $_POST['pass'];
            $login_status = $model->login();

            if ($login_status == VALIDATION_ERROR)
            {
                $params = array('login' => $_POST['login'], 'pass' => $_POST['pass']);
                $this->view = new Main_View(array(CONTENT => 'Login', 'login_data' => $params));
                $this->view->render();
            }

            if ($login_status == NOT_ACTIVE)
            {
                $this->view = new Main_View(array(CONTENT => 'Login', 'activation' => 'false'));
                $this->view->render();
            }

            if ($login_status == SUCCESS)
            {
                $_SESSION['login'] = $model->get_login();
                $_SESSION['uid'] = $model->get_uid();

                header("refresh:0; url=/");
            }

        }
    }

    function action_register()
    {
        $model = $this->model;
        if (!isset($_POST['register'])) {
            $this->view = new Main_View(array(CONTENT => 'Register'));
            $this->view->render();
        }
        if (isset($_POST['register']))
        {
            $model->set_register_data($_POST);
            $is_registered = $model->register($_POST['repass']);

            if ($is_registered)
            {
                header("refresh:0; url=/");
            }

            if (!$is_registered)
            {
                $params = array('name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'login' => $_POST['login']);
                $this->view = new Main_View(array(CONTENT => 'Register', 'reg_data' => $params));
                $this->view->render();
            }
        }

    }

    function action_edit($uid = null)
    {
        global $logged_user;
        $model = $this->model;

        $model->get_user_by_id($uid);

        if (!isset($_POST['edit']))
        {
            if (strcmp($logged_user->get_role(), ADMIN) == 0)
            {
                $is_mine = ($logged_user->get_uid() == $model->get_uid()) ? true : false;
                $roles = array(0 => USER, 1 => EDITOR, 2 => ADMIN);
                $this->view = new Main_View(array(CONTENT => 'Edit_User', 'edit_data' => $model, 'actions' => true, 'is_mine' => $is_mine, 'roles' => $roles));
                $this->view->render();
            }
            else
            {
                $this->view = new Main_View(array(CONTENT => 'Edit_User', 'edit_data' => $model));
                $this->view->render();
            }
        }

        if (isset($_POST['edit']))
        {
            $active_status = '0';
            if (isset($_POST['check']) && strcmp($_POST['check'], 'on') == 0)
            {
                $active_status = '1';
            }

            if (isset($_POST['pass']) && strcmp($_POST['pass'], '') !== 0) {
                $model->pass = $_POST['pass'];
            }

            $model->set_name($_POST['name']);
            $model->set_surname($_POST['surname']);

            if ($logged_user->get_role() == ADMIN && $logged_user->get_uid() != $model->get_uid())
            {
                $model->set_status($active_status);
                if (isset($_POST['role']))
                {
                    $model->set_role($_POST['role']);
                }
            }

            $is_saved = $model->save();

            if (!$is_saved)
            {
                if (strcmp($logged_user->get_role(), ADMIN) == 0)
                {
                    $is_mine = ($logged_user->get_uid() == $model->get_uid()) ? true : false;
                    $roles = array(0 => USER, 1 => EDITOR, 2 => ADMIN);
                    $this->view = new Main_View(array(CONTENT => 'Edit_User', 'edit_data' => $model, 'actions' => true, 'is_mine' => $is_mine, 'roles' => $roles));
                    $this->view->render();
                }
                else
                {
                    $this->view = new Main_View(array(CONTENT => 'Edit_User', 'edit_data' => $model));
                    $this->view->render();
                }
            }

            else
            {
                if (strcmp($logged_user->get_role(), ADMIN) == 0 && $logged_user->get_uid() != $model->get_uid())
                {
                    header('Location: /User/show_users');
                }

                else
                {
                    header('Location: /');
                }
            }
        }

        return true;
    }

    function action_show_users()
    {
        $params = $this->model->get_all_users();
        $this->view = new Main_View(array(CONTENT => 'Users', 'all_users' => $params));
        $this->view->render();
    }

    function action_logout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->view = new Main_View(array(CONTENT => ACCESS_DENIED));
            $this->view->render();
        }
        else
        {
            $this->model->logout();
            header("Location: /");
        }

    }

    function action_delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->view = new Main_View(array(CONTENT => ACCESS_DENIED));
            $this->view->render();
        }
        if (isset($_POST['uid']))
        {
            $uid = $_POST['uid'];
            $this->model->delete_user($uid);
        }
    }

    public function get_resource_model()
    {
        return $this->resource_model;
    }

}