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
}