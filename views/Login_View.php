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
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/login">
        <h2 class="form-signin-heading" align="center">Please sign in</h2>
        <input type="text" class="input-block-level" name="login" placeholder="Login">
        <input type="password" class="input-block-level" name="pass" placeholder="Password">

        <button class="btn btn-large btn-primary" type="submit" name="log">Sign in</button>
    </form>

</div>';
        }

        else
        {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/login">
        <h3 class="form-signin-heading">' . User_Model::$error_pull['login_err'] . '</h3>
        <input type="text" class="input-block-level" name="login" value = ' . $log_data['login'] .'>
        <input type="password" class="text-error"  name="pass" placeholder="Password">

        <button class="btn btn-large btn-primary" type="submit" name="log">Sign in</button>
    </form>

</div>';
        }
    }
}