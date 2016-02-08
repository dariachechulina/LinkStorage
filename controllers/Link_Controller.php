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
        $model = $this->model;

        if (!isset($_POST['add']))
        {
            $this->view = new Main_View(array(CONTENT => 'Add'));
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
            $model->set_title($_POST['title']);
            $model->set_link($_POST['link']);
            $model->set_description($_POST['description']);
            $model->set_privacy_status($privacy_status);
            $model->set_uid($_SESSION['uid']);

            $is_saved = $model->save();

            if (!$is_saved)
            {
                $params = array('title' => $_POST['title'], 'link' => $_POST['link'], 'description' => $_POST['description'], 'privacy_status' => $privacy_status);
                $this->view = new Main_View(array(CONTENT => 'Add', 'add_data' => $params));
                $this->view->render();
            }

            else {
                header('Location: /Link/show_my');
            }


        }
    }

    function action_edit($lid)
    {
        $model = $this->model;
        $model->get_link_by_id($lid);

        if (!isset($_POST['edit']))
        {
            $this->view = new Main_View(array(CONTENT => 'Edit_Link', 'edit_data' => $model));
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
            $model->set_title($_POST['title']);
            $model->set_link($_POST['link']);
            $model->set_description($_POST['description']);
            $model->set_privacy_status($privacy_status);
            $is_saved = $model->save();

            if (!$is_saved)
            {
                $this->view = new Main_View(array(CONTENT => 'Edit_Link', 'edit_data' => $model));
                $this->view->render();
            }

            else
            {
                header('Location: /Link/show_my');
            }
        }
    }

    function action_show($lid)
    {
        $model = $this->model;
        global $logged_user;
        $link_exist = $model->get_link_by_id($lid);

        $is_public = $model->get_privacy_status() == 'public' ? TRUE : FALSE ;
        $is_anonymous = !is_object($logged_user) ? TRUE : FALSE;
        $role = FALSE;
        $is_my_link = FALSE;

        if (!$is_anonymous)
        {
            $role = $logged_user->get_role();
            $is_my_link = $model->is_mine($lid);
        }

        $is_admin = $role == 'admin' || $role == 'editor';
        $show_access_denied = TRUE;

        if ($link_exist && ($is_admin || $is_my_link || $is_public))
        {
            $show_access_denied = FALSE;
        }

        if (!$show_access_denied)
        {
            if ($is_admin || $is_my_link)
            {
                $this->view = new Main_View(array(CONTENT => 'Link', 'link' => $model, 'actions' => true));
                $this->view->render();
            }
            else
            {
                $this->view = new Main_View(array(CONTENT => 'Link', 'link' => $model));
                $this->view->render();
            }
        }
        else
        {
            $this->view = new Main_View(array(CONTENT => 'Access_Denied'));
            $this->view->render();
        }
    }

    function action_show_my()
    {
        $params = $this->model->get_links_by_uid($_SESSION['uid']);
        $this->view = new Main_View(array(CONTENT => 'Links', 'my_links' => $params));
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
            $this->view = new Main_View(array(CONTENT => 'Access_Denied'));
            $this->view->render();
        }
        if (isset($_POST['lid']))
        {
            $lid = $_POST['lid'];
            $this->model->delete_link($lid);
        }
    }
}