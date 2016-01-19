<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:45 PM
 */
class Head_View extends view
{
    public $parent_args = array();

    function __construct()
    {
        $this->template = '<title> Link Storage </title>
                            <link href="../style.css" rel="stylesheet">
                            <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">';
    }
}