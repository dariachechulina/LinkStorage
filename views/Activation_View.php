<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/21/16
 * Time: 6:01 PM
 */
class Activation_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
    }
}