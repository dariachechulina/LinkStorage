<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:06 PM
 */
class Main_View extends view
{
    private $head;
    private $body;
    static public $content_view;

    public function __construct()
    {
        $this->template = '<!DOCTYPE html>
                            <head> %s </head>
                            <body> %s </body>';

        $this->head = new Head_View();
        $this->body = new Body_View();

        $this->args = array($this->head, $this->body);
    }

}