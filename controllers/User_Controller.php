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
        $this->view->generate('first_view.php', 'first_view.php');
    }

    function action_login()
    {
        $this->model->login($_POST['login'], $_POST['pass']);
    }

    function action_register()
    {
        $this->model->register($_POST['login'], $_POST['pass'], $_POST['repass'], $_POST['email'], $_POST['name'], $_POST['surname']);
    }

    function action_edit()
    {

    }

    function action_user_edit()
    {

    }

    function action_delete()
    {

    }
}