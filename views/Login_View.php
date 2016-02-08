<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/18/16
 * Time: 3:06 PM
 */
class Login_View extends View
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $login_data = array();
        $parameters = $this->get_parameters();


        if (isset($parameters['login_data']))
        {
            $login_data = $parameters['login_data'];
        }
        if (count($login_data) == 0)
        {
            if (isset($parameters['activation']))
            {
                $this->template = '<h3> Please, check your mailbox! </h3> <br> <br>
                <h3>I lost my link, send again </h3>
                <p align="center"> <input type="text" class="input-block-level" id="email" placeholder="Enter your email">
                <button id="resend">Send</button> </p>';
                return;
            }

            $this->template = '<div class="container">

     <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading" align="center"> Sign in </h3>
        <br>
        <input type="text" class="input-block-level" name="login" placeholder="Login">
        <input type="password" class="input-block-level" name="pass" placeholder="Password">

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="login_button"> <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login </button></p>
        <br>
        <p align="center"> Not registered now? <a href="/User/register"> Sign up</a> </p>
    </form>

</div>';
        }

        else
        {
                $login = '';
                if (strcmp($login_data['login'], '') !== 0)
                {
                    $login = $login_data['login'];
                }
                    $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading"> Sign in </h3>
        <br>
        <input type="text" class="input-block-level" name="login" placeholder="Login" value = ' . $login .'>
        <input type="password" class="text-error"  name="pass" placeholder="Password">

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="login_button"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Login</button></p>
        <br>
        <p align="center"> Not registered now? <a href="/User/register"> Sign up</a> </p>
    </form>

</div>';

        }
    }
}