<?php

ini_set('display_errors', true);

$login = "root";
$passwd = "qwerty123";
$dat = date("y.m.d");
$tm = date("h:i:s");

$conn= new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'cron.php';
require_once 'bootstrap.php';

?>