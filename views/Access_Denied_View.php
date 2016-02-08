<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 4:59 PM
 */
class Access_Denied_View extends View
{
    public function __construct()
    {
        $this->template = '<h1> Access denied! </h1>
                            <h2>You have no permission for this action.</h2>';
    }
}