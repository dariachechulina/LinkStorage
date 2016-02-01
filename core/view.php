<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:37 PM
 */
class view
{

    public $template;
    public $args = array();

    public function __toString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }


    function prepare_args()
    {

    }

    public function render()
    {
        if(method_exists($this, 'prepare_args'))
        {
            $this->prepare_args();
        }


        print call_user_func_array('sprintf', array_merge(array($this->template), $this->args));
    }

}