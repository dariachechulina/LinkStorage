<?php


if (isset($_GET['code']))
{
    $cur_hash = $_GET['code'];
    echo $cur_hash;


    global $conn;
    var_dump($conn);
    $query = $conn->prepare("SELECT uid FROM tmplinks WHERE hash = '$cur_hash'");

    $query->execute();

    $result = $query->fetchAll();

    $cur_uid = $result[0]["uid"];
    var_dump($result);
    echo $cur_uid;

    $query = $conn->prepare("SELECT login FROM userdb WHERE uid = ?");
    $query->execute(array($cur_uid));
    $result = $query->fetchAll();

    $cur_login = $result[0]['login'];

    echo $cur_login;
}
