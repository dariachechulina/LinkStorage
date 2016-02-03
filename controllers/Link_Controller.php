<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/16/15
 * Time: 1:28 PM
 */
class Link_Controller extends Controller
{
    private $resource_model = 'Link_Model';

    function __construct()
    {
        $this->model = new Link_Model();
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
        $this->model->get_link_by_id($lid);

        if (!isset($_POST['edit']))
        {
            $this->view = new Main_View(array('cont_view' => 'Edit_Link', 'edit_data' => $this->model));
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
            $this->model->set_title($_POST['title']);
            $this->model->set_link($_POST['link']);
            $this->model->set_description($_POST['description']);
            $this->model->set_privacy_status($privacy_status);
            $this->model->save();
            header('Location: /Link/show_my');
        }
    }

    function action_show($lid)
    {
        global $logged_user;
        $is_obj = $this->model->get_link_by_id($lid);

        if (!is_object($logged_user) && $is_obj && strcmp($this->model->get_privacy_status(), 'public') == 0 ||
             is_object($logged_user) && $is_obj && strcmp($this->model->get_privacy_status(), 'public') == 0
                                     && $logged_user->get_uid() !== $this->model->get_uid()
                                     && strcmp($logged_user->get_role(), 'user') == 0)
        {
            $this->view = new Main_View(array('cont_view' => 'Link', 'link' => $this->model));
            $this->view->render();
        }

        else if (is_object($logged_user) && $is_obj && $logged_user->get_uid() == $this->model->get_uid() ||
                 is_object($logged_user) && $is_obj && strcmp($logged_user->get_role(), 'user') !== 0)
        {
            $this->view = new Main_View(array('cont_view' => 'Link', 'link' => $this->model, 'actions' => true));
            $this->view->render();
        }

        else
        {
            $this->view = new Main_View(array('cont_view' => 'Access_Denied'));
            $this->view->render();
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

    public function get_resource_model()
    {
        return $this->resource_model;
    }

    public function action_delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->view = new Main_View(array('cont_view' => 'Access_Denied'));
            $this->view->render();
        }
        if (isset($_POST['lid']))
        {
            $lid = $_POST['lid'];
            $this->model->delete_link($lid);
        }
    }
}