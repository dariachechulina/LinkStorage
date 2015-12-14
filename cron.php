<?php

$login = "root";
$passwd = "qwerty123";
$dat = date("y.m.d");
$tm = date("h:i:s");

$conn= new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT * FROM tmplinks WHERE uid = 2");
$query->execute();
$result = $query->fetchAll();
$l = count($result);
if ($l != 0)
{
    //$query = $conn->prepare("DELETE FROM tmplinks WHERE exp_time < CURDATE()");
    //$query->execute();
}