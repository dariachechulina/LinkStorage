<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/18/16
 * Time: 12:02 PM
 */


function autoload($className)
{
    if (file_exists('views/'. $className . '.php'))
    {
        require_once 'views/'. $className . '.php';
    }

    if (file_exists('models/'. $className . '.php'))
    {
        require_once 'models/'. $className . '.php';
    }
}
