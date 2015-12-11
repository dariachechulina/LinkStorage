<?php


class TmpLink_Model
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
        $activation=md5($email_.time());
        $this->hash = $activation;
        $tm = date("h:i:s");
        $query = "INSERT INTO tmplinks (uid, hash, exp_time) VALUES('$uid_', '$activation', '$tm')";
        global $conn;
        $conn->exec($query);
        $id = $conn->lastInsertId();

        $body='Hello, <br/> <br/> Please, confirm your email address: <br/> <br/> <a href="'.$base_url.'activation?code='.$activation.'">'.$base_url.'activation?code='.$activation.'</a>';

        $mail->MsgHTML($body);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
}