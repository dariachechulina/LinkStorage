<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:37 PM
 */
class view
{
    private $template;

    public $args;

    function __construct()
    {
        $this->template = '<!DOCTYPE html> <head> %s </head> <body> %s </body>';
    }


    function prepare_args()
    {

    }

    function render($content_view, $template_view, $data = null)
    {
        include 'views/'.$template_view;
    }
}