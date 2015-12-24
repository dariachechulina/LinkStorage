<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/16/15
 * Time: 1:28 PM
 */
class Link_Controller extends Controller
{
    function __construct()
    {
        $this->model = new Link_Model();
        $this->view = new View();
    }

    function action_index()
    {
        #$this->view->render('first_view.php', 'first_view.php');
        $this->model->set_title('DASHA');
        #$this->view->render('main_view.php', 'template_view.php', array($this->model, 'haha'));
    }

    function action_add()
    {
        if (!isset($_POST['add']))
        {
            $this->view->render('addlink_view.php', 'addlink_view.php');
        }
        if (isset($_POST['add']))
        {
            echo $_POST['title'];
            $this->model->set_title($_POST['title']);
            $this->model->set_link($_POST['link']);
            $this->model->set_description($_POST['description']);
            $this->model->set_privacy_status($_POST['privacy_status']);
            $this->model->set_uid(5);

            $this->model->save();
        }
    }
}