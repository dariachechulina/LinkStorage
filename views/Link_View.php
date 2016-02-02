<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/25/16
 * Time: 10:30 AM
 */
class Link_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;

        $show_data = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['link'];



        $privacy = '';
        if (strcmp($show_data->get_privacy_status(), 'private') == 0)
        {
            $privacy = 'checked=""';
        }



            $this->template = '<div class="container">

    <form class="form-signin" method="post" action="#">
        <h2 class="form-signin-heading" align="center"> </h2> <br>
        <input type=text class="input-block-level" readonly name="title" value="'. $show_data->get_title() .'"> <br> <br>
        <input type=text class="input-block-level" readonly name="link" onclick="location.href = \'http://'.$show_data->get_link().'\';" value="'. $show_data->get_link() .'"> <br> <br>
        <div class="form-group">
  <textarea class="form-control" rows="5" id="comment" name="description" readonly>'. $show_data->get_description() .'</textarea>
</div>
        <div class="checkbox">
      <p align="center"><label><input type="checkbox" name="check" disabled="true" '. $privacy.'> &nbsp; Private link</label></p>
    </div>
    </form>

</div>';


        if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['actions']))
        {
            $this->template = $this->template.'
        <p align="center"> <button class="btn btn-large btn-warning" type="button" onclick="location.href = \'/Link/edit/'.$show_data->get_lid().'\';" name="edit" ><span class="glyphicon glyphicon-pencil"></span> &nbsp;Edit</button> &nbsp;
        <button type="button" class="btn btn-large btn-danger" data-toggle="modal" data-target="#myModal" name="delete">Delete</button> </p><div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete link? This action will be undone </p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-block" data-dismiss="modal" onclick="location.href = \'/Link/edit/'.$show_data->get_lid().'\';" name="confirm_delete" >Delete</button>
        </div>
      </div>

    </div>
  </div>
    ';
        }

        $this->template = $this->template . '</form>

</div>';
    }
}