<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 5:05 PM
 */
class Edit_Link_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $edit_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['edit_data'];
        $role = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['role'];

        if (strcmp($role, 'user') !== 0)
        {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit profile</h2>
        <input type="text" class="input-block-level" name="name" value='. $edit_data->get_name() .' placeholder="Login">
        <input type=text class="input-block-level" name="surname" value='. $edit_data->get_surname() .' placeholder="Surname"> <br> <br>

        <input type=text class="input-block-level" disabled="true" name="login" value='. $edit_data->get_login() .' placeholder="* Login" > <br> <br>
        <input type=text class="input-block-level" name="role" value='. $edit_data->get_role() .' placeholder="Surname"> <br> <br>
        <input type=text class="input-block-level" name="status" value='. $edit_data->get_status() .' placeholder="Surname"> <br> <br>
        <p align="center">Activation status: &nbsp; <input type=checkbox class="input-block-level" name="status" value='. $edit_data->get_status() .' placeholder="Surname"> <br> <br> </p>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" > <br> <br>


        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="edit">Edit</button> &nbsp;
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
          <p>Are you sure you want to cancel editing? Some information can not be saved. </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>

    </form>
</div>';

        }

        else
        {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit profile</h2>
        <input type="text" class="input-block-level" name="name" value='. $edit_data->get_name() .' placeholder="Login">
        <input type=text class="input-block-level" name="surname" value='. $edit_data->get_surname() .' placeholder="Surname"> <br> <br>

        <input type=text class="input-block-level" disabled="true" name="login" value='. $edit_data->get_login() .' placeholder="* Login" > <br> <br>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" > <br> <br>


        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="edit">Edit</button> &nbsp;
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
          <p>Are you sure you want to cancel editing? Some information can not be saved. </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>
  </form>

</div>';
        }
    }

}