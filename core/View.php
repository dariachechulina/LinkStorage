<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:37 PM
 */
class View
{
    public $template;
    public $args = array();

    public function __toString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }


    public function render()
    {
        print call_user_func_array('sprintf', array_merge(array($this->template), $this->args));
    }


    public function get_parameters()
    {
        $p = $this->parent_args[0];

        while (true)
        {
            if (isset($p->parent_args[0]) && is_object($p->parent_args[0]))
            {
                $p = $p->parent_args[0];
            }

            else
            {
                break;
            }
        }

        $parameters = $p->parameters;
        return $parameters;
    }

}