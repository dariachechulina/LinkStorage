<?php

$login = "root";
$passwd = "qwerty123";

global $conn;
$conn = new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'autoload.php';
require_once 'core/route.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

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
$links_on_page = 5;

Route::start();




