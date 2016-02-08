<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:46 PM
 */
class Content_View extends View
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;

        if (isset($this->parent_args[0]->parent_args[0]->parameters[CONTENT]))
        {
            $this->template = '<h3> '.Error::print_array().'</h3><br> %s';
            $class_name = $this->parent_args[0]->parent_args[0]->parameters[CONTENT].'_View';
            $this->args = array(new $class_name(array($this)));
        }
    }
}