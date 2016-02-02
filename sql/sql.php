<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/25/16
 * Time: 12:15 PM
 */
$login = "root";
$passwd = "qwerty123";

global $conn;



$query = "INSERT INTO permission (role, action) VALUES ('user', 'link_add')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('user', 'link_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('user', 'user_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('user', 'user_logout')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('user', 'user_show_my')";
$conn->exec($query);


$query = "INSERT INTO permission (role, action) VALUES ('editor', 'link_add')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'link_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'user_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'user_logout')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'user_show_my')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'link_edit_any')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('editor', 'show_all')";
$conn->exec($query);


$query = "INSERT INTO permission (role, action) VALUES ('admin', 'link_add')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'link_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'user_edit_own')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'user_logout')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'user_show_my')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'link_edit_any')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'user_edit_any')";
$conn->exec($query);

$query = "INSERT INTO permission (role, action) VALUES ('admin', 'show_all')";
$conn->exec($query);