<?php


$login = "root";
$passwd = "qwerty123";

$db = new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("DELETE FROM tmplinks WHERE exp_time < CURDATE()");
