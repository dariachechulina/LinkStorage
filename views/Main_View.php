<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:06 PM
 */


class Main_View extends View
{
    private $head;
    private $body;
    public $parameters = array();

    public function __construct(array $params = null)
    {
        if (!is_null($params))
        {
            $this->parameters = $params;
        }

        $this->template = '<!DOCTYPE html>
                            <head> %s </head>
                            <body> %s </body>
                            ';

        $this->head = new Head_View();
        $this->body = new Body_View(array($this));

        $this->args = array($this->head, $this->body);

        $this->head->parent_args = array($this);
        $this->body->parent_args = array($this);


    }

}