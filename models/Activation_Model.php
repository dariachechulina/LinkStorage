<?php


class Activation_Model extends Model
{
    private $uid, $hash, $exp_time;

    public function send($uid_, $email_, $flag = null)
    {
        $query = $this->connection->prepare("SELECT * FROM tmplinks WHERE uid = ?");
        $query->execute(array($uid_));
        $result = $query->fetchAll();
        if (count($result) !== 0 && is_null($flag))
        {
            return;
        }

        $this->uid = $uid_;

        $query = $this->connection->prepare("SELECT login FROM userdb WHERE email = ?");
        $query->execute(array($email_));
        $result = $query->fetchAll();
        $to = $result[0]['login'];

        global $mail_settings;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = $mail_settings['SMTPDebug'];
        $mail->Debugoutput = $mail_settings['Debugoutput'];
        $mail->Host = $mail_settings['Host'];
        $mail->Port = $mail_settings['Port'];
        $mail->SMTPSecure = $mail_settings['SMTPSecure'];
        $mail->SMTPAuth = $mail_settings['SMTPAuth'];
        $mail->Username = $mail_settings['Username'];
        $mail->Password = $mail_settings['Password'];
        $mail->setFrom($mail_settings['Username'], $mail_settings['From']);
        $mail->addReplyTo($mail_settings['Username'], $mail_settings['From']);
        $mail->Subject = $mail_settings['Subject'];

        $mail->addAddress($email_, $to);

        $base_url='testtask/';
        $cur_exptime = date("y.m.d", time() + 2*(24*60*60));
        $activation=md5($email_.time());
        $this->hash = $activation;
        $this->exp_time = $cur_exptime;

        $query = $this->connection->prepare("SELECT * FROM tmplinks WHERE uid = ?");
        $query->execute(array($uid_));
        $result = $query->fetchAll();
        if (count($result) == 0)
        {
            $query = "INSERT INTO tmplinks (uid, hash, exp_time) VALUES('$uid_', '$activation', '$cur_exptime')";
            $this->connection->exec($query);
        }

        else
        {
            $query = $this->connection->prepare("UPDATE tmplinks SET hash = '$this->hash', exp_time = '$this->exp_time' WHERE uid = ?");
            $query->execute(array($uid_));
        }

        $body='Hello, <br/> <br/> Please, confirm your email address in 2 days: <br/> <br/> <a href="'.$base_url.'Activation?code='.$activation.'">'.$base_url.'Activation?code='.$activation.'</a>';

        $mail->MsgHTML($body);

        if (!$mail->send())
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

    public function resend($email)
    {
        $query = $this->connection->prepare("SELECT * FROM userdb WHERE email = ?");
        $query->execute(array($email));
        $result = $query->fetchAll();

        if (count($result) > 0)
        {
            $this->send($result[0]['uid'], $email, true);
        }
    }

    public function activate_user($hash_)
    {
        $query = $this->connection->prepare("SELECT uid FROM tmplinks WHERE hash = '$hash_'");
        $query->execute();
        $result = $query->fetchAll();
        if (count($result) == 0)
        {
            Error::$error_pull['msg'] = 'Link doesn\'t exist';
            return;
        }
        $cur_uid = $result[0]["uid"];

        $query = $this->connection->prepare("SELECT login, status FROM userdb WHERE uid = ?");
        $query->execute(array($cur_uid));
        $result = $query->fetchAll();

        if (count($result) == 0)
        {
            Error::$error_pull['msg'] = 'Link does\'t exist';
            return;
        }
        $cur_login = $result[0]['login'];
        $cur_status = $result[0]['status'];

        if($cur_status == 0)
        {
            $query = $this->connection->prepare("UPDATE userdb SET status='1' WHERE login=?");
            $query->execute(array($cur_login));
            Error::$error_pull['msg'] = 'Profile of user <b>'.$cur_login.'</b> is successfully activated';
            return;
        }
        else
        {
            Error::$error_pull['msg'] = 'This activation link has already activated the corresponding profile';
            return;
        }

    }
}