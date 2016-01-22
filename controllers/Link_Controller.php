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
        //->view = new View();
    }

    function action_index()
    {
        $this->model->set_title('DASHA');
        #$this->view->render('main_view.php', 'template_view.php', array($this->model, 'haha'));
    }

    function action_add()
    {
        if (!isset($_POST['add']))
        {
            $this->view = new Main_View(array('cont_view' => 'Add'));
            $this->view->render();
        }
        if (isset($_POST['add']))
        {
            if(isset($_POST['check']) && strcmp($_POST['check'], 'on') == 0)
            {
                $privacy_status = 'private';
            }
            else
            {
                $privacy_status = 'public';
            }
            $this->model->set_title($_POST['title']);
            $this->model->set_link($_POST['link']);
            $this->model->set_description($_POST['description']);
            $this->model->set_privacy_status($privacy_status);
            $this->model->set_uid($_SESSION['uid']);

            $this->model->save();

            if (isset(Link_Model::$error_pull['validation_err'])) {
                $params = array('title' => $_POST['title'], 'link' => $_POST['link'], 'description' => $_POST['description'], 'privacy_status' => $privacy_status);
                $this->view = new Main_View(array('cont_view' => 'Add', 'add_data' => $params));
                $this->view->render();
            }

            header('Location: /Link/show_my');


        }
    }

    function action_edit($lid)
    {
        $edited_link = $this->model->get_link_by_id($lid);

        if (!isset($_POST['edit']))
        {
            $this->view = new Main_View(array('cont_view' => 'Edit_Link', 'edit_data' => $edited_link));
            $this->view->render();
        }

        if (isset($_POST['edit']))
        {
            if(isset($_POST['check']) && strcmp($_POST['check'], 'on') == 0)
            {
                $privacy_status = 'private';
            }
            else
            {
                $privacy_status = 'public';
            }
            $edited_link->set_title($_POST['title']);
            $edited_link->set_link($_POST['link']);
            $edited_link->set_description($_POST['description']);
            $edited_link->set_privacy_status($privacy_status);
            $edited_link->save();
            header('Location: /Link/show_my');
        }
    }

    function action_show_all()
    {
        $links = $this->model->get_all_public_links();
    }

    function action_show_my()
    {
        $params = $this->model->get_links_by_uid($_SESSION['uid']);
        $this->view = new Main_View(array('cont_view' => 'Links', 'my_links' => $params));
        $this->view->render();
    }
}