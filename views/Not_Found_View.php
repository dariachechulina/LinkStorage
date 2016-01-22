<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/21/16
 * Time: 4:18 PM
 */
class Not_Found_View extends view
{
    public function __construct()
    {
        $this->template = '<h1> <b>404</b> </h1>
                            <h2>Page not found</h2>';
    }
}