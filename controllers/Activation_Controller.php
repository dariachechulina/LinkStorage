<?php


class Activation_Controller extends Controller
{

    function __construct()
    {
        $this->model = new Activation_Model();
    }

    function action_index()
    {
        if (isset($_GET['code']))
        {
            $cur_hash = $_GET['code'];
            $this->model->activate_user($cur_hash);
            $this->view = new Main_View(array('cont_view' => 'Activation', 'status' => Activation_Model::$error_pull));
            $this->view->render();
        }

        else
        {
            $this->view = new Main_View(array('cont_view' => 'Not_Found'));
            $this->view->render();
        }
    }
}