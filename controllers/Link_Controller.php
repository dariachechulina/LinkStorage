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
            $this->model->set_uid($_SESSION['uid']);

            $this->model->save();
        }
    }

    function action_edit($lid)
    {
        $edited_link = $this->model->get_link_by_id($lid);

        if (!isset($_POST['edit']))
        {
            $this->view->render('link_edit_view.php', 'template_view.php', $edited_link);
        }

        if (isset($_POST['edit']))
        {
            $edited_link->set_title($_POST['title']);
            $edited_link->set_link($_POST['link']);
            $edited_link->set_description($_POST['description']);
            $edited_link->set_privacy_status($_POST['privacy_status']);
            $edited_link->save();
        }
    }

    function action_show_all()
    {
        $links = $this->model->get_all_public_links();
        $this->view->render('main_view.php', 'main_view.php', $links);
    }

    function action_show_my()
    {
        $links = $this->model->get_links_by_uid($_SESSION['uid']);
        $this->view->render('main_view.php', 'main_view.php', $links);
    }
}