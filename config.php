<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 2/2/16
 * Time: 4:17 PM
 */

require_once 'autoload.php';


spl_autoload_register("autoload");

if (isset($_SESSION['uid']))
{
    global $logged_user;
    $logged_user = new User_Model();
    $logged_user->get_user_by_id($_SESSION['uid']);
}

else
{
    global $logged_user;
    $logged_user = 0;
}

global $links_on_page;
$links_on_page = 3;
