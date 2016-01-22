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
        $status = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['status'];

        if (isset($status['msg']))
        {
            $this->template = '<h2>'. $status['msg'].'</h2>';
        }

        else
        {
            $this->template = '%s';
            $this->args = array(new Not_Found_View());
        }
    }
}