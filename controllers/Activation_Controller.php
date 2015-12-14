<?php


class Activation_Controller extends Controller
{

    function __construct()
    {
        $this->model = new Activation_Model();
        $this->view = new View();
    }

    function action_index()
    {
        $cur_hash = $_GET['code'];
        $result_status = $this->model->activate_user($cur_hash);
        echo $result_status;
    }
}