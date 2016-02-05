<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 5:05 PM
 */
class Edit_User_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $edit_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['edit_data'];


            $privacy = '';
            if (strcmp($edit_data->get_status(), '1') == 0)
            {
                $privacy = 'checked=""';
            }

            $edited_role = $edit_data->get_role();

        $cur_message = (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['error'])) ? $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['error'] : 'Edit profile';

                $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">'.$cur_message.'</h2> <br>
        <input type="text" class="input-block-level" name="name" placeholder="* Name" value=' . $edit_data->get_name() . ' > <br> <br>
        <input type=text class="input-block-level" name="surname" placeholder="* Surname" value=' . $edit_data->get_surname() . ' > <br> <br>

        <input type=text class="input-block-level" disabled="true" name="login" value=' . $edit_data->get_login() . ' placeholder="Login" > <br> <br>';

                if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['actions'])
                    && isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['is_mine']) && !$this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['is_mine']) {
                    $this->template = $this->template . '

        <p align="center">Role: &nbsp; <select name="role">
  <option value=' . $edited_role . ' disabled selected>' . $edited_role . '</option>
  <option value="user">user</option>
  <option value="editor">editor</option>
  <option value="admin">admin</option>
</select></p><div class="checkbox">
      <p align="center"><label><input align="center" type="checkbox" name="check"' . $privacy . '> Active </label></p>
    </div>';
                }

        // @TODO optimize it
        if(isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['is_mine']) && $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['is_mine'] == true
            || !isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['is_mine']))
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