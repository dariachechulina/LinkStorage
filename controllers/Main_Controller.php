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
        $this->model = new Link_Model();
        $params = $this->model->get_all_public_links();
        $this->view = new Main_View(array('cont_view' => 'Links', 'all_links' => $params));
        $this->view->render();
    }
}