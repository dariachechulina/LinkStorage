<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 2/8/16
 * Time: 1:30 PM
 */


include 'libs/class.phpmailer.php';
date_default_timezone_set('Etc/UTC');
require 'libs/PHPMailerAutoload.php';
global $mail_settings;
$mail_settings = array(
    'SMTPDebug' => 0,
    'Debugoutput' => 'html',
    'Host' => 'smtp.gmail.com',
    'Port' => 587,
    'SMTPSecure' => 'tls',
    'SMTPAuth' => true,
    'Username' => 'dashachechulina@gmail.com',
    'Password' => 'zyof cacq ieae cuxa',
    'From' => 'Link Storage',
    'Subject' => 'Account confirmation'
);