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

    if (file_exists('core/'. $className . '.php'))
    {
        require_once 'core/'. $className . '.php';
    }

    if (file_exists('controllers/'. $className . '.php'))
    {
        require_once 'controllers/'. $className . '.php';
    }

    if (file_exists($className . '.php'))
    {
        require_once $className . '.php';
    }
}
