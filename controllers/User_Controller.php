<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 5:01 PM
 */
class User_Controller extends Controller
{
    function __construct()
    {
        $this->model = new User_Model();

    }
    function action_index()
    {
        $this->model->set_login('DASHA');
    }

    function action_login()
    {
        if (!isset($_POST['log']))
        {
            $this->view = new Main_View(array('cont_view' => 'Login'));
            $this->view->render();

        }
        else
        {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $log = $this->model->login();

            if (isset(User_Model::$error_pull['login_err']))
            {
                //print User_Model::$error_pull['login_err'];
                $params = array('login' => $_POST['login'], 'pass' => $_POST['pass']);
                $this->view = new Main_View(array('cont_view' => 'Login', 'log_data' => $params));
                $this->view->render();
            }

            if ($log)
            {
                $_SESSION['login'] = $this->model->get_login();
                $_SESSION['uid'] = $this->model->get_uid();
                //$_SESSION['role'] = $this->model->get_role();
                $user = new User_Model();
                $user = $user->get_user_by_id($_SESSION['uid']);

                global $user;
                var_dump($user);


                header("refresh:0; url=/");
            }

        }
    }

    function action_register()
    {
        if (!isset($_POST['register']))
        {
            $this->view = new Main_View(array('cont_view' => 'Register'));
            $this->view->render();
        }
        if (isset($_POST['register']))
        {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $this->model->set_email($_POST['email']);
            $this->model->set_name($_POST['name']);
            $this->model->set_surname($_POST['surname']);

            $reg = $this->model->register($_POST['repass']);

            if ($reg)
            {
                header ("refresh:0; url=/");
            }

            if (isset(User_Model::$error_pull['register_err']))
            {
                $params = array('name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'login' => $_POST['login']);
                $this->view = new Main_View(array('cont_view' => 'Register', 'reg_data' => $params));
                $this->view->render();
            }
        }

    }

    function action_edit($uid)
    {
        $edited_user = $this->model->get_user_by_id($uid);
        $this->model = $this->model->get_user_by_id($_SESSION['uid']);

        if (!isset($_POST['edit']))
        {
            $this->view = new Main_View(array('cont_view' => 'Edit_User', 'edit_data' => $edited_user, 'role' => $this->model->get_role()));
            $this->view->render();
        }

        if (isset($_POST['edit']))
        {
            if (strcmp($_POST['pass'], '') !== 0)
            {
                $edited_user->set_password($_POST['pass']);
            }

            $edited_user->set_name($_POST['name']);
            $edited_user->set_surname($_POST['surname']);

            if ($this->model->get_role() == 'admin' ||
                $this->model->get_role() == 'editor')
            {
                $edited_user->set_status($_POST['status']);
                $edited_user->set_role($_POST['role']);
            }

            $edited_user->save();
            header('Location: /');
        }

        return true;
    }

    function action_show_users()
    {
        $this->model = new User_Model();
        $params = $this->model->get_all_users();
        $this->view = new Main_View(array('cont_view' => 'Users', 'all_users' => $params, 'role' => $_SESSION['role']));
        $this->view->render();
    }

    function action_logout()
    {
        $this->view = new Main_View(array('cont_view' => 'Logout'));
        $this->view->render();
        $this->model->logout();
        header("Location: /");
    }

}