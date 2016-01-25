<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 4:33 PM
 */
class Add_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $add_data = array();

        if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['add_data']))
        {
            $add_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['add_data'];

            if (strcmp($add_data['privacy_status'], 'private') == 0)
            {
                $privacy = 'checked=""';
            }
            else
            {
                $privacy = '';
            }

            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h3 class="form-signin-heading"> Error: ' . Link_Model::$error_pull['validation_err'] . '</h3>
        <input type=text class="input-block-level" name="title" placeholder="Title" value=' . $add_data['title'] .'> <br> <br>
        <input type=text class="input-block-level" name="link" placeholder="Link" value=' . $add_data['link'] .'> <br> <br>
        <div class="form-group">
  <textarea class="form-control" rows="5" id="comment"  name="description" placeholder="Description">'.$add_data['description'] .'</textarea>
</div>
        <div class="checkbox">
      <p align="center"><label><input type="checkbox" name="check" '. $privacy.' > &nbsp; Private link</label></p>
    </div>

        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="add"><span class="glyphicon glyphicon-floppy-save"></span> &nbsp;Save</button> &nbsp;
        <button type="button" class="btn btn-large btn-danger" data-toggle="modal" data-target="#myModal" name="cancel">Cancel</button> </p><div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel adding? Information will not be saved. </p>
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

        else {
            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center"> </h2> <br>
        <input type=text class="input-block-level" name="title" placeholder="Title" value=""> <br> <br>
        <input type=text class="input-block-level" name="link" placeholder="Link" value=""> <br> <br>
        <div class="form-group">
  <textarea class="form-control" rows="5" id="comment" name="description" placeholder="Description"></textarea>
</div>
        <div class="checkbox">
      <p align="center"><label><input type="checkbox" name="check"> &nbsp; Private link</label></p>
    </div>

        <p align="center"> <button class="btn btn-large btn-primary" type="submit" name="add"><span class="glyphicon glyphicon-floppy-save"></span> &nbsp;Save</button> &nbsp;
        <button type="button" class="btn btn-large btn-danger" data-toggle="modal" data-target="#myModal" name="cancel">Cancel</button> </p><div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel adding? Information will not be saved. </p>
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