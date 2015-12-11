<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:37 PM
 */
class view
{
    function generate($content_view, $template_view, $data = null)
    {
        include 'views/'.$template_view;
    }
}