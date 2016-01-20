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
        
        $this->template = '<div class="container">

    <form class="form-signin" method="post" action="/Link/add">
        <h2 class="form-signin-heading" align="center"> </h2> <br>
        <input type=text class="input-block-level" name="title" placeholder="Title" value=""> <br> <br>
        <input type=text class="input-block-level" name="link" placeholder="Link" value=""> <br> <br>
        <input type=text class="input-block-level" name="description" placeholder="Description" value="" id="1"> <br> <br>
        <input type=text class="input-block-level" name="privacy_status" placeholder="Privacy status" value="" id="2"> <br> <br>

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="add">Save</button>
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