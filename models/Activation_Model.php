<?php


class Activation_Model
{
    private $uid, $hash, $exp_time;

    public static $error_pull = array();

    public function send($uid_, $email_)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM tmplinks WHERE uid = ?");
        $query->execute(array($uid_));
        $result = $query->fetchAll();
        if (count($result) !== 0)
        {
            return;
        }

        $this->uid = $uid_;

        $query = $conn->prepare("SELECT login FROM userdb WHERE email = ?");
        $query->execute(array($email_));
        $result = $query->fetchAll();
        $to = $result[0]['login'];

        global $mail;

        $mail->addAddress($email_, $to);

        $base_url='testtask/';
        $cur_exptime = date("y.m.d", time() + 2*(24*60*60));
        $activation=md5($email_.time());
        $this->hash = $activation;
        $this->exp_time = $cur_exptime;

        $query = $conn->prepare("SELECT * FROM tmplinks WHERE uid = ?");
        $query->execute(array($uid_));
        $result = $query->fetchAll();
        if (count($result) == 0)
        {
            $query = "INSERT INTO tmplinks (uid, hash, exp_time) VALUES('$uid_', '$activation', '$cur_exptime')";
            $conn->exec($query);
        }

        else
        {
            $query = $conn->prepare("UPDATE tmplinks SET hash = '$this->hash', exp_time = '$this->exp_time' WHERE uid = ?");
            $query->execute(array($uid_));
        }

        $body='Hello, <br/> <br/> Please, confirm your email address in 2 days: <br/> <br/> <a href="'.$base_url.'Activation?code='.$activation.'">'.$base_url.'Activation?code='.$activation.'</a>';

        $mail->MsgHTML($body);

        if (!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

    public function activate_user($hash_)
    {
        global $conn;
        $query = $conn->prepare("SELECT uid FROM tmplinks WHERE hash = '$hash_'");
        $query->execute();
        $result = $query->fetchAll();
        if (count($result) == 0)
        {
            self::$error_pull['msg'] = 'Link doesn\'t exist';
            return;
        }
        $cur_uid = $result[0]["uid"];

        $query = $conn->prepare("SELECT login, status FROM userdb WHERE uid = ?");
        $query->execute(array($cur_uid));
        $result = $query->fetchAll();
        $cur_login = $result[0]['login'];
        $cur_status = $result[0]['status'];

        if($cur_status == 0)
        {
            $query = $conn->prepare("UPDATE userdb SET status='1' WHERE login=?");
            $query->execute(array($cur_login));
            self::$error_pull['msg'] = 'Profile of user <b>'.$cur_login.'</b> is successfully activated';
            return;
        }
        else
        {
            self::$error_pull['msg'] = 'This activation link has already activated the corresponding profile';
            return;
        }

    }
}