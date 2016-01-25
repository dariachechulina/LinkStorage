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

    function action_index()
    {
        $this->model->set_login('DASHA');
    }

    function action_login()
    {
        if (!isset($_POST['log'])) {
            $this->view = new Main_View(array('cont_view' => 'Login'));
            $this->view->render();

        } else {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $log = $this->model->login();

            global $logged_user;
            var_dump($logged_user);

            if (isset(User_Model::$error_pull['login_err'])) {
                //print User_Model::$error_pull['login_err'];
                $params = array('login' => $_POST['login'], 'pass' => $_POST['pass']);
                $this->view = new Main_View(array('cont_view' => 'Login', 'log_data' => $params));
                $this->view->render();
            }

            if ($log) {
                $_SESSION['login'] = $this->model->get_login();
                $_SESSION['uid'] = $this->model->get_uid();

                header("refresh:0; url=/");
            }

        }
    }

    function action_register()
    {
        if (!isset($_POST['register'])) {
            $this->view = new Main_View(array('cont_view' => 'Register'));
            $this->view->render();
        }
        if (isset($_POST['register'])) {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $this->model->set_email($_POST['email']);
            $this->model->set_name($_POST['name']);
            $this->model->set_surname($_POST['surname']);

            $reg = $this->model->register($_POST['repass']);

            if ($reg) {
                header("refresh:0; url=/");
            }

            if (isset(User_Model::$error_pull['register_err'])) {
                $params = array('name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'login' => $_POST['login']);
                $this->view = new Main_View(array('cont_view' => 'Register', 'reg_data' => $params));
                $this->view->render();
            }
        }

    }

    function action_edit($uid = null)
    {
        global $logged_user;

        if ($uid == null) {
            $this->view = new Main_View(array('cont_view' => 'Not_Found'));
            $this->view->render();
        }
        else {
            $this->model->get_user_by_id($uid);

            if (!isset($_POST['edit'])) {
                $this->view = new Main_View(array('cont_view' => 'Edit_User', 'edit_data' => $this->model));
                $this->view->render();
            }

            if (isset($_POST['edit'])) {

                $active_status = '0';
                if (isset($_POST['check']) && strcmp($_POST['check'], 'on') == 0)
                {
                    $active_status = '1';
                }

                if (isset($_POST['pass']) && strcmp($_POST['pass'], '') !== 0) {
                    $this->model->set_password($_POST['pass']);
                }

                $this->model->set_name($_POST['name']);
                $this->model->set_surname($_POST['surname']);

                if ($logged_user->get_role() == 'admin'){
                    $this->model->set_status($active_status);
                    if (isset($_POST['role']))
                    {
                        $this->model->set_role($_POST['role']);
                    }
                    $this->model->save();
                    header('Location: /User/show_users');
                }

                else
                {
                    $this->model->save();
                    header('Location: /');
                }

            }
        }

        return true;
    }

    function action_show_users()
    {
        $params = $this->model->get_all_users();
        $this->view = new Main_View(array('cont_view' => 'Users', 'all_users' => $params));
        $this->view->render();
    }

    function action_logout()
    {
        $this->view = new Main_View(array('cont_view' => 'Logout'));
        $this->view->render();
        $this->model->logout();
        header("Location: /");
    }

    function action_delete()
    {
        var_dump($_POST);
    }

    public function get_resource_model()
    {
        return $this->resource_model;
    }

}