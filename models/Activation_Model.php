<?php


class Activation_Model
{
    private $uid, $hash, $exp_time;

    public function send($uid_, $email_)
    {
        $this->uid = $uid_;
        global $conn;
        $query = $conn->prepare("SELECT login FROM userdb WHERE email = ?");
        $query->execute(array($email_));
        $result = $query->fetchAll();
        $to = $result[0]['login'];

        include 'libs/class.phpmailer.php';
        date_default_timezone_set('Etc/UTC');
        require 'libs/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "dashachechulina@gmail.com";
        $mail->Password = "zyof cacq ieae cuxa";
        $mail->setFrom('dashachechulina@gmail.com', 'Daria Chechulina');
        $mail->addReplyTo('dashachechulina@gmail.com', 'Daria Chechulina');
        $mail->addAddress($email_, $to);
        $mail->Subject = 'Account confirmation';

        $base_url='testtask/';
        $cur_exptime = date("y.m.d", time() - 2*(24*60*60));
        $activation=md5($email_.time());
        $this->hash = $activation;
        $this->exp_time = $cur_exptime;
        $query = "INSERT INTO tmplinks (uid, hash, exp_time) VALUES('$uid_', '$activation', '$cur_exptime')";
        global $conn;
        $conn->exec($query);
        $id = $conn->lastInsertId();

        $body='Hello, <br/> <br/> Please, confirm your email address in 2 days: <br/> <br/> <a href="'.$base_url.'activation?code='.$activation.'">'.$base_url.'activation?code='.$activation.'</a>';

        $mail->MsgHTML($body);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
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
            return "expired";
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
            return "success";
        }
        else
        {
            return "reused";
        }

    }
}