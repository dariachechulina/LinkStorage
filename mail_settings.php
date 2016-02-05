<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/21/16
 * Time: 4:42 PM
 */
// @TODO expect OOP style
include 'libs/class.phpmailer.php';
date_default_timezone_set('Etc/UTC');
require 'libs/PHPMailerAutoload.php';
global $mail;
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
$mail->Subject = 'Account confirmation';