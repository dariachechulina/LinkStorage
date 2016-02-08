<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 2/2/16
 * Time: 4:17 PM
 */

class Config
{
    public function __construct()
    {
        session_start();
        global $links_on_page;
        $links_on_page = 3;

        if (isset($_SESSION['uid']))
        {
            global $logged_user;
            $logged_user = new User_Model();
            $logged_user->get_user_by_id($_SESSION['uid']);
        }

        else
        {
            global $logged_user;
            $logged_user = 0;
        }

        $this->configure_mail_settings();
    }

    public function configure_mail_settings()
    {
        include 'mail_settings.php';
    }
}



