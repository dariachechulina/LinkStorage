<?php


class Activation_Controller extends Controller
{
    function action_index()
    {
        $cur_hash = $_GET['code'];
        global $conn;
        $query = $conn->prepare("SELECT uid FROM tmplinks WHERE hash = '$cur_hash'");
        $query->execute();
        $result = $query->fetchAll();
        $cur_uid = $result[0]["uid"];

        $query = $conn->prepare("SELECT login FROM userdb WHERE uid = ?");
        $query->execute(array($cur_uid));
        $result = $query->fetchAll();
        $cur_login = $result[0]['login'];

        $query = $conn->prepare("UPDATE userdb SET status='1' WHERE login=?");
        $query->execute(array($cur_login));

        echo $cur_login . ", your profile was successfully activated";
    }
}