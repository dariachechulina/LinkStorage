<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/19/16
 * Time: 4:12 PM
 */
class Links_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;

        if(isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['all_links']))
        {
            $this->template = '%s';
            $links = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['all_links'];
            if (isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['private'])
                && $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['private'] == true)
            {
            $table_begin = '<div class="container">
  <h2>Links</h2>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Link</th>
        <th>Description</th>
                <th>Private</th>
                <th>Actions</th>
      </tr>
    </thead>
    <tbody>';
            $table_rows = '';
            for ($i = 0; $i < count($links); $i++)
                {
                    $privacy = '';
                    if (strcmp($links[$i]->get_privacy_status(), 'private') == 0)
                    {
                        $privacy = 'checked=""';
                    }

                    $table_rows = $table_rows . '<tr> <td>' . $links[$i]->get_title() .'</td>' .
                        '<td>' . $links[$i]->get_link() .'</td>' .
                        '<td>' . $links[$i]->get_description() .
                        '<td> <input align="center" type="checkbox" disabled name="check"'. $privacy.'></td>' .

                        '<td> <button class="btn btn-sm btn-warning" type="submit" onclick="location.href = \'/Link/edit/'.$links[$i]->get_lid().'\';" name="edit_link"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-sm btn-danger" type="submit" name="delete_link'.$i.'" data-toggle="modal" data-target="#myModal'.$i.'"><span class="glyphicon glyphicon-remove"></span></button>
         <div class="modal fade" id="myModal'.$i.'" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete link <b>' . $links[$i]->get_title(). '</b>? This action will be undone. </p>
        </div>
        <div class="modal-footer">
          <p align=center> <button type="submit" class="btn btn-success " data-dismiss="modal"  name="delete" >Delete</button>

        <button type="submit" class="btn btn-danger " data-dismiss="modal" onclick="location.href = \'/#\';" name="cancel_' . $i.'" >Cancel</button></p>
        </div>
      </div>

    </div>
  </div>' .'</td>'. '</tr>';
                    // var_dump($table_rows[$i]);

                }
            }

            else
            {
                $table_begin = '<div class="container">
  <h2>Links</h2>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Link</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>';
                $table_rows = '';
                for ($i = 0; $i < count($links); $i++)
                {

                    $table_rows = $table_rows . '<tr> <td>' . $links[$i]->get_title() .'</td>' .
                        '<td>' . $links[$i]->get_link() .'</td>' .
                        '<td>' . $links[$i]->get_description() .'</td> </tr>';
                    // var_dump($table_rows[$i]);

                }
            }

            $table_end = '</tbody>
  </table>
</div>';

            $str_arg = $table_begin . $table_rows . $table_end;
            $this->args = array($str_arg);
            //var_dump($this->args);
        }

        if(isset($this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['my_links']))
        {
            $this->template = '%s';
            $links = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['my_links'];
            $table_begin = '<div class="container">
  <h2>My links</h2>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Link</th>
        <th>Description</th>
        <th>Private</th>
        <th> Actions </th>
      </tr>
    </thead>
    <tbody>';

            $table_rows = '';
            if (count($links) != 0)
            {
                for ($i = 0; $i < count($links); $i++)
                {
                    $privacy = '';
                    if (strcmp($links[$i]->get_privacy_status(), 'private') == 0)
                    {
                        $privacy = 'checked=""';
                    }

                    $table_rows = $table_rows . '<tr> <td>' . $links[$i]->get_title() .'</td>' .
                        '<td>' . $links[$i]->get_link() .'</td>' .
                        '<td>' . $links[$i]->get_description() .'</td>' .
                        '<td> <input align="center" type="checkbox" disabled name="check"'. $privacy.'></td>' .

                        '<td> <button class="btn btn-sm btn-warning" type="submit" onclick="location.href = \'/Link/edit/'.$links[$i]->get_lid().'\';" name="edit_link"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-sm btn-danger" type="submit" name="delete_link'.$i.'" data-toggle="modal" data-target="#myModal'.$i.'"><span class="glyphicon glyphicon-remove"></span></button>
         <div class="modal fade" id="myModal'.$i.'" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete link <b>' . $links[$i]->get_title(). '</b>? This action will be undone. </p>
        </div>
        <div class="modal-footer">
          <p align=center> <button type="submit" class="btn btn-success " data-dismiss="modal"  name="delete" >Delete</button>

        <button type="submit" class="btn btn-danger " data-dismiss="modal" onclick="location.href = \'/Link/show_my\';" name="cancel_' . $i.'" >Cancel</button></p>
        </div>
      </div>

    </div>
  </div>' .'</td>'. '</tr>';
                    // var_dump($table_rows[$i]);

                }

                $table_end = '</tbody>
                             </table>
                             </div>';

                $str_arg = $table_begin . $table_rows . $table_end;
                $this->args = array($str_arg);
            }

            else
            {
                $message = '<h2> You have no added links </h2>';
                $this->args = array($message);
            }


            //var_dump($this->args);
        }

    }
}