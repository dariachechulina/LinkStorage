<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:46 PM
 */
class Content_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;

        if (isset($this->parent_args[0]->parent_args[0]->parameters['cont_view']))
        {
            $this->template = '%s';
            $class_name = $this->parent_args[0]->parent_args[0]->parameters['cont_view'].'_View';
         //   var_dump($class_name);
            $this->args = array(new $class_name(array($this)));
        }
        else
        {
                $this->template = 'Content here';
        }
    }
}