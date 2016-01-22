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
        global $logged_user;

        if (!is_object($logged_user)) {
            $this->template = '%s';
            $this->args = array(new Access_Denied_View());
            return;
        }

        $role = $logged_user->get_role();

        if (!is_object($edit_data) && strcmp($role, 'user') !== 0) {
            $this->template = '%s';
            $this->args = array(new Not_Found_View());
            return;
        }

        if (!is_object($edit_data) && strcmp($role, 'user') == 0) {
            $this->template = '%s';
            $this->args = array(new Access_Denied_View());
            return;
        }

        if (is_object($logged_user)) {


            $privacy = '';
            if (strcmp($edit_data->get_privacy_status(), 'private') == 0)
            {
                $privacy = 'checked=""';
            }

            if (strcmp($role, 'user') !== 0) {
                $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit link</h2> <br>
        <input type="text" class="input-block-level" name="title" placeholder="Title" value=' . $edit_data->get_title() . ' ><br> <br>
        <input type=text class="input-block-level" name="link" placeholder="Link" value=' . $edit_data->get_link() . ' > <br> <br>
        <input type=text class="input-block-level" name="description" placeholder="Description" value=' . $edit_data->get_description() . ' >
        <div class="checkbox">
      <p align="center"><label><input align="center" type="checkbox" name="check"'. $privacy.'> Private link </label></p>
    </div>


        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="edit"><span class="glyphicon glyphicon-floppy-save"></span> &nbsp;Save</button> &nbsp;
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
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>

    </form>
</div>';
            }

            if (strcmp($role, 'user') == 0 &&
                ($edit_data->get_uid() == $logged_user->get_uid())
            )
            {
                $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit link</h2> <br>
        <input type="text" class="input-block-level" name="title" value=' . $edit_data->get_title() . ' placeholder="Title"> <br> <br>
        <input type=text class="input-block-level" name="link" value=' . $edit_data->get_link() . ' placeholder="Link"> <br> <br>
        <input type=text class="input-block-level" name="description" value=' . $edit_data->get_description() . ' placeholder="Description">
        <div class="checkbox">
      <p align="center"><label><input align="center" type="checkbox" name="check"'. $privacy.'> Private link </label></p>
    </div>

        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="edit"><span class="glyphicon glyphicon-floppy-save"></span> &nbsp;Save</button> &nbsp;
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
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/#\';" name="confirm_cancel" >Cancel anyway</button>
        </div>
      </div>

    </div>
  </div>

    </form>
</div>';
            }

            if (strcmp($role, 'user') == 0 &&
                ($edit_data->get_uid() !== $logged_user->get_uid())
            ) {

                $this->template = '%s';
                $this->args = array(new Access_Denied_View());
            }
        }
    }

}