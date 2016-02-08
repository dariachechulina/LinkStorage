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
        $controller_name = MAIN_CONTROLLER;
        $action_name = INDEX;
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

        $controller = new $controller_full_name;
        $action = $action_full_name;

        if(method_exists($controller, $action))
        {
            $current_action = strtolower($controller_name. '_' . $action_name);

            $action_status = $controller->action_allowed_status($current_action, $id);

            if ($action_status == SUCCESS)
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
            if ($action_status == ACCESS_DENIED)
            {
                Route::AccessDeniedPage();
            }

            if ($action_status == NOT_FOUND)
            {
                Route::NotFoundPage();
            }
        }
        else
        {
           Route::NotFoundPage();
        }

    }

    function NotFoundPage()
    {
        $view = new Main_View(array(CONTENT => NOT_FOUND));
        $view->render();
    }

    function AccessDeniedPage()
    {
        $view = new Main_View(array(CONTENT => ACCESS_DENIED));
        $view->render();
    }

}