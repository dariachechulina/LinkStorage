<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 2/5/16
 * Time: 12:12 PM
 */
class error
{
    public static $error_pull = array();

    static function print_array()
    {
        $result_string = '';

        foreach (self::$error_pull as $error)
        {
            $result_string = $result_string . '<br> ' . $error .'';
        }

        return $result_string;
    }
}