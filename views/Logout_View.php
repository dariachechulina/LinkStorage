<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 12:04 PM
 */
class Logout_View extends View
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;

        $this->template = '';
    }
}