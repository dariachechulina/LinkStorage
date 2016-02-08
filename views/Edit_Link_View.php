<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 5:05 PM
 */
class Edit_Link_View extends View
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $edit_data = $this->get_parameters()['edit_data'];


            $privacy = '';
            if (strcmp($edit_data->get_privacy_status(), 'private') == 0)
            {
                $privacy = 'checked=""';
            }

                $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center">Edit link</h2> <br>
        <input type="text" class="input-block-level" name="title" placeholder="Title" value=' . $edit_data->get_title() . ' ><br> <br>
        <input type=text class="input-block-level" name="link" placeholder="Link" value=' . $edit_data->get_link() . ' > <br> <br>
        <div class="form-group">
  <textarea class="form-control" rows="5" id="comment" name="description" placeholder="Description">'. $edit_data->get_description() .'</textarea>
</div>

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

}