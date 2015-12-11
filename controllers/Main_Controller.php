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
        $this->view->generate('main_view.php', 'main_view.php');
    }
}