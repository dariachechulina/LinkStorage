<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:43 PM
 */
class Main_Controller extends Controller
{

    function __construct()
    {
        $this->view = new Main_View();
    }

    function action_index()
    {
        $this->view->render();
    }
}