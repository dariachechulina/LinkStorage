<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/19/16
 * Time: 12:45 PM
 */
class Register_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $reg_data = array();
        if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['reg_data']))
        {
            $reg_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['reg_data'];
        }
        if (count($reg_data) == 0)
        {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/register">
        <h2 class="form-signin-heading" align="center">Please sign up</h2> <br>
        <input type=text class="input-block-level" name="name" placeholder="Name"> <br> <br>
        <input type=text class="input-block-level" name="surname" placeholder="Surname"> <br> <br>
        <input type=email class="input-block-level" name="email" placeholder="* E-mail" > <br> <br>
        <input type=text class="input-block-level" name="login" placeholder="* Login" > <br> <br>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" > <br> <br>
        <input type="password" class="input-block-level" name="repass" placeholder="* Repeat password"> <br> <br>

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="register" align="right" >Sign up</button></p>
        <br>
        <p align="center"> Fields marked with * are required </p>
    </form>

</div>';
        }

        else
        {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/User/register">
         <h3 class="form-signin-heading">' . User_Model::$error_pull['register_err'] . '</h3>
        <input type=text class="input-block-level" name="name"  value='. $reg_data['name'] .'> <br> <br>
        <input type=text class="input-block-level" name="surname"  value='. $reg_data['surname'] .'> <br> <br>
        <input type=email class="input-block-level" name="email" value='. $reg_data['email'] .' id="1"> <br> <br>
        <input type=text class="input-block-level" name="login"  value='. $reg_data['login'] .' id="2"> <br> <br>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" value="" id="3"> <br> <br>
        <input type="password" class="input-block-level" name="repass" placeholder="* Repeat password" value="" id="4"> <br> <br>

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="register" align="right" >Sign up</button></p>
        <br>
        <p align="center"> Fields marked with * are required </p>
    </form>

</div>';
        }
    }

}