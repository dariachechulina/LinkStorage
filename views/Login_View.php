<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/18/16
 * Time: 3:06 PM
 */
class Login_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $log_data = array();


        if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['log_data']))
        {
            $log_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['log_data'];
        }
        if (count($log_data) == 0)
        {
            if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['activation']))
            {

                $this->template = '<h2> You profile is not active.</h2> <h2> Please, check your mailbox! </h2>';
                header("refresh:5; url=/");
                return;
            }

            $this->template = '<div class="container">

     <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading" align="center"> &nbsp; </h3>
        <br>
        <input type="text" class="input-block-level" name="login" placeholder="Login">
        <input type="password" class="input-block-level" name="pass" placeholder="Password">

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="log"> <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login </button></p>
        <br>
        <p align="center"> Not registered now? <a href="/User/register"> Sign up</a> </p>
    </form>

</div>';
        }

        else
        {




                if (strcmp($log_data['login'], '') !== 0)
                    $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading"> Error: ' . User_Model::$error_pull['login_err'] . '</h3>
        <br>
        <input type="text" class="input-block-level" name="login" value = ' . $log_data['login'] .'>
        <input type="password" class="text-error"  name="pass" placeholder="Password">

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="log"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Login</button></p>
        <br>
        <p align="center"> Not registered now? <a href="/User/register"> Sign up</a> </p>
    </form>

</div>';

                else
                {
                    $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading"> Error: ' . User_Model::$error_pull['login_err'] . '</h3>
        <br>
        <input type="text" class="input-block-level" name="login" placeholder="Login">
        <input type="password" class="text-error"  name="pass" placeholder="Password">

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="log"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Login</button></p>
        <br>
        <p align="center"> Not registered now? <a href="/User/register"> Sign up</a> </p>
    </form>

</div>';
                }

        }
    }
}