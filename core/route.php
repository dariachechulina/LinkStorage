<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 4:39 PM
 */
class Route
{
    static function start()
    {
        $controller_name = 'Main';
        $action_name = 'index';
        $uid = NULL;

        $url_parts = parse_url($_SERVER['REQUEST_URI']);
        $routes = explode('/', $url_parts['path']);

        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
        }
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        if ( !empty($routes[3]) )
        {
            $uid = $routes[3];
        }

        $model_name = $controller_name . "_Model";
        $controller_name = $controller_name . '_Controller';
        $action_name = 'action_'.$action_name;

        $model_file = $model_name.'.php';
        $model_path = "models/".$model_file;
        if(file_exists($model_path))
        {
            include "models/".$model_file;
        }

        $controller_file = $controller_name.'.php';
        $controller_path = "controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            if ($uid == NULL)
            {
                $controller->$action();
            }
            else
            {
                $controller->$action($uid);
            }
        }
        else
        {
           Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
       /* $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');*/
    }

}