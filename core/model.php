<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:36 PM
 */
class model
{
    static $error_pull = array();

    public function __construct()
    {
    }
    public function is_mine($id)
    {
    }

    static function print_array(array $error_list)
    {
        $result_string = '';
        foreach ($error_list as $error)
        {
           $result_string = $result_string . '<br> <h3>' . $error .'</h3>';
        }

        return $result_string;
    }
}