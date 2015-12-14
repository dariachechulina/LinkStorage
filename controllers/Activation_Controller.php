<?php


class Activation_Controller extends Controller
{
    function action_index()
    {
        $cur_hash = $_GET['code'];
        $this->model = new Activation_Model();
        $result_status = $this->model->activate_user($cur_hash);
        echo $result_status;
    }
}