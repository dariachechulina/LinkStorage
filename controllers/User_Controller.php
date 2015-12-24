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
        $this->view = new View();
    }
    function action_index()
    {
        #$this->view->render('first_view.php', 'first_view.php');
        $this->model->set_login('DASHA');
        $this->view->render('main_view.php', 'template_view.php', array($this->model, 'haha'));
    }

    function action_login()
    {
        if (!isset($_POST['log']))
        {
            $this->view->render('login_view.php', 'login_view.php');
        }
        else
        {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $this->model->login();
        }
    }

    function action_register()
    {
        if (!isset($_POST['register']))
        {
            $this->view->render('register_view.php', 'register_view.php');
        }
        if (isset($_POST['register']))
        {
            $this->model->set_login($_POST['login']);
            $this->model->set_password($_POST['pass']);
            $this->model->set_email($_POST['email']);
            $this->model->set_name($_POST['name']);
            $this->model->set_surname($_POST['surname']);

            $this->model->register($_POST['repass']);
        }

    }

    function action_edit($uid)
    {
        $edited_user = $this->model->get_user_by_id($uid);

        if (!isset($_POST['edit']))
        {
            $this->view->render('edit_view.php', 'template_view.php', $edited_user);
        }

        if (isset($_POST['edit']))
        {
            $edited_user->set_password($_POST['pass']);
            $edited_user->set_email($_POST['email']);
            $edited_user->set_name($_POST['name']);
            $edited_user->set_surname($_POST['surname']);
            $edited_user->save();
        }

    }

    function action_edit_user($uid)
    {
        if ($this->model->get_role() != 'admin')
        {
            echo 'You have no permission for this action';
            return false;
        }

        $edited_user = $this->model->get_user_by_id($uid);

        if (!isset($_POST['edit']))
        {
            $this->view->render('edit_view.php', 'template_view.php', array($edited_user, $this->model->get_role()));
        }

        if (isset($_POST['edit']))
        {
            $edited_user->set_password($_POST['pass']);
            $edited_user->set_email($_POST['email']);
            $edited_user->set_role($_POST['role']);
            $edited_user->set_status($_POST['status']);
            $edited_user->set_name($_POST['name']);
            $edited_user->set_surname($_POST['surname']);
            $edited_user->save();
        }

        return true;
    }

}