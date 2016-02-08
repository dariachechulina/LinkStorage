<?php

phpinfo();

require_once 'autoload.php';
spl_autoload_register("autoload");

require_once 'constants.php';
$config = new Config();

Route::start();




