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
        <h3 class="form-signin-heading" align="center"> </h3> <br>
        <input type=text class="input-block-level" name="name" placeholder="Name"> <br> <br>
        <input type=text class="input-block-level" name="surname" placeholder="Surname"> <br> <br>
        <input type=email class="input-block-level" name="email" placeholder="* E-mail" > <br> <br>
        <input type=text class="input-block-level" name="login" placeholder="* Login" > <br> <br>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" > <br> <br>
        <input type="password" class="input-block-level" name="repass" placeholder="* Repeat password"> <br> <br>

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="register" align="right" >Sign up</button>
        <button type="button" class="btn btn-large btn-primary" data-toggle="modal" data-target="#myModal" name="cancel">Cancel</button> </p>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel registration? Information will not be saved. </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>
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

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="register" align="right" >Sign up</button>
        <button type="button" class="btn btn-large btn-primary" data-toggle="modal" data-target="#myModal" name="cancel">Cancel</button> </p>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel registration? Information will not be saved. </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div><br>
        <p align="center"> Fields marked with * are required </p>
    </form>

</div>';
        }
    }

}