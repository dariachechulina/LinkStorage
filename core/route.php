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
        $id = NULL;

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
            $id = $routes[3];
        }

        $controller_full_name = $controller_name . '_Controller';
        $action_full_name = 'action_'.$action_name;


        $controller_file = $controller_full_name.'.php';
        $controller_path = "controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        $controller = new $controller_full_name;
        $action = $action_full_name;

        if(method_exists($controller, $action))
        {
            $current_action = strtolower($controller_name. '_' . $action_name);

            $res = $controller->action_allowed_status($current_action, $id);

            if ($res == 'ok')
            {
                if ($id == NULL)
                {
                    $controller->$action();
                }
                else
                {
                    $controller->$action($id);
                }
            }
            if ($res == 'access_denied')
            {
                Route::AccessDeniedPage();
            }

            if ($res == '404')
            {
                Route::ErrorPage404();
            }
        }
        else
        {
           Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $view = new Main_View(array('cont_view' => 'Not_Found'));
        $view->render();
    }

    function AccessDeniedPage()
    {
        $view = new Main_View(array('cont_view' => 'Access_Denied'));
        $view->render();
    }

}