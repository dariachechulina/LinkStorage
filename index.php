<?php

//error_reporting(E_ALL);
ini_set('display_errors', true);
//ini_set('display_startup_errors', 1);
#echo "HELLO";

$login = "root";
$passwd = "qwerty123";
$dat = date("y.m.d");
$tm = date("h:i:s");

$conn= new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once 'cron.php';
require_once 'bootstrap.php';


/*include 'models/User_Model.php';;
include 'models/TmpLink_Model.php';
include 'activation.php';
$login = "root";
$passwd = "qwerty123";
$dat = date("y.m.d");
$tm = date("h:i:s");



$conn= new PDO("mysql:host=localhost;dbname=testdb", $login, $passwd);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$user = new User_Model();
$user->set_login("Daria Che");
$user->set_password("1234");

#$user->save();



$ent_login = $user->get_login();

echo "</br>";
$query = $conn->prepare("SELECT pass FROM users WHERE login = 'dasha'");
$query->execute();
$res = $query->fetchAll();

#var_dump($res);
$l = count($res);
#var_dump($l);
#if ($l != 0) echo "0!!!!!!!!!!!!!!!!    ";

$link = new TmpLink_Model();
$link->send(2, 'dasha93_che@mail.ru');
$user_info = $conn->query("SELECT * FROM userdb WHERE login = 'dasha'", PDO::FETCH_OBJ);
$cur_user = new User_Model();
$cur_user = $user_info->fetchObject('User_Model');

#var_dump($cur_user);
#echo $cur_user->get_login();

echo "</br>";

#var_dump($l);
echo "</br>";

echo "HELLO";*/
?>