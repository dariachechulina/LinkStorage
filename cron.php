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
    $tm = date('h:i:s');
    $new_hash = "hash" . $tm;
   /* $query = $conn->prepare("UPDATE tmplinks SET hash='$new_hash' WHERE uid=2");
    $query->execute();*/
}