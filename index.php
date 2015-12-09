<?php



$login = "root";
$passwd = "qwerty123";
$dat = date("y.m.d");
$tm = date("h:i:s");



$conn= new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include 'User.php';

$user = new User();
$user->set_login("Daria Che");
$user->set_password("1234");

$user->save();
echo "HELLO";
?>