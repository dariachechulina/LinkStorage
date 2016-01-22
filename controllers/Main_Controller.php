<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:43 PM
 */
class Main_Controller extends Controller
{

    function action_index()
    {
        global $logged_user;

        if (is_object($logged_user) && strcmp($logged_user->get_role(), 'user') !== 0){
            $this->model = new Link_Model();
            $params = $this->model->get_all_links();
            $this->view = new Main_View(array('cont_view' => 'Links', 'all_links' => $params, 'private' => true));
            $this->view->render();
        } else {
            $this->model = new Link_Model();
            $params = $this->model->get_all_public_links();
            $this->view = new Main_View(array('cont_view' => 'Links', 'all_links' => $params));
            $this->view->render();
        }


    }
}