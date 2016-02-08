<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 5:05 PM
 */
class Edit_User_View extends View
{
    public $parent_args = array();


    public function __construct(array $params)
    {
        $this->parent_args = $params;

        $parameters = $this->get_parameters();

        $edit_data = $parameters['edit_data'];

            $privacy = '';
            if (strcmp($edit_data->get_status(), '1') == 0)
            {
                $privacy = 'checked=""';
            }

            $edited_role = $edit_data->get_role();


                $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit profile</h2> <br>
        <input type="text" class="input-block-level" name="name" placeholder="* Name" value=' . $edit_data->get_name() . ' > <br> <br>
        <input type=text class="input-block-level" name="surname" placeholder="* Surname" value=' . $edit_data->get_surname() . ' > <br> <br>

        <input type=text class="input-block-level" disabled="true" name="login" value=' . $edit_data->get_login() . ' placeholder="Login" > <br> <br>';

                if (isset($parameters['actions'])
                    && isset($parameters['is_mine']) && !$parameters['is_mine']) {

                    $select_role = '<p align="center">Role: &nbsp; <select name="role">';
                    $roles = $parameters['roles'];

                    foreach ($roles as $role)
                    {
                        if ($edited_role == $role)
                        {
                            $select_role .= '<option selected value="' . $role . '">' . $role . '</option>';
                        }
                        else
                        {
                            $select_role .= '<option value="' . $role . '">' . $role . '</option>';
                        }
                    }

                    $select_role .= '</select></p>';

                    $this->template .= $select_role .'

<div class="checkbox">
      <p align="center"><label><input align="center" type="checkbox" name="check"' . $privacy . '> Active </label></p>
    </div>';
                }

        if((isset($parameters['is_mine']) && $parameters['is_mine'] == true)
            || !isset($parameters['is_mine']))
        {
            $this->template = $this->template . '<input type="password" class="input-block-level" name="pass" placeholder="Password" > <br> <br>';
        }

        $this->template = $this->template . '<p align="center"> <button class="btn btn-large btn-primary" type="submit" name="edit"><span class="glyphicon glyphicon-floppy-save"></span> &nbsp;Save</button> &nbsp;
        <button type="button" class="btn btn-large btn-danger" data-toggle="modal" data-target="#myModal" name="cancel">Cancel</button> </p>
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
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/User/show_users\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>

    </form>
</div>';



    }

}