<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/20/16
 * Time: 4:43 PM
 */
class Users_View extends view
{
    public $parent_args = array();

    public function __construct(array $params)
    {
        $this->parent_args = $params;
        $role = '';
        if (isset($_SESSION['uid']))
        {
            $logged_user = new User_Model();
            $logged_user = $logged_user->get_user_by_id($_SESSION['uid']);
            $role = $logged_user->get_role();
        }

        if(strcmp($role, 'admin') == 0)
        {
            $this->template = '%s';
            $users = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['all_users'];
            $table_begin = '<div class="container">
  <h2>Users</h2>
  <br><br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Login</th>
        <th>Email</th>
        <th>Role</th>
        <th>Active</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>';
            $table_rows = '';
            for ($i = 0; $i < count($users); $i++)
            {
                $privacy = '';
                if (strcmp($users[$i]->get_status(), '1') == 0)
                {
                    $privacy = 'checked=""';
                }
                $table_rows = $table_rows . '<tr> <td>' . $users[$i]->get_login() .'</td>' .
                    '<td>' . $users[$i]->get_email() .
                    '<td>' . $users[$i]->get_role() .'</td>' .
                    '<td> <input align="center" type="checkbox" disabled name="check"'. $privacy.'></td>' .

                    '<td>' . $users[$i]->get_name() .'</td>' .
                    '<td>' . $users[$i]->get_surname() .'</td>' .
                    '<td> <button class="btn btn-sm btn-warning" type="submit" onclick="location.href = \'/User/edit/'.$users[$i]->get_uid().'\';" name="edit_user"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn btn-sm btn-danger" type="submit" name="delete_user'.$i.'" data-toggle="modal" data-target="#myModal'.$i.'"><span class="glyphicon glyphicon-remove"></span></button>
         <div class="modal fade" id="myModal'.$i.'" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Warning!</h3>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete user <b>' . $users[$i]->get_login(). '</b>? This action will be undone. </p>
        </div>
        <div class="modal-footer">
          <p align=center> <button type="submit" class="btn btn-success " data-dismiss="modal"  name="delete" >Delete</button>

        <button type="submit" class="btn btn-danger " data-dismiss="modal" onclick="location.href = \'/User/show_users\';" name="cancel_' . $i.'" >Cancel</button></p>
        </div>
      </div>

    </div>
  </div>' .'</td>'. '</tr>';

            }

            $table_end = '</tbody>
  </table>
</div>';
            $str_arg = $table_begin . $table_rows . $table_end;
            $this->args = array($str_arg);
            //var_dump($this->args);
        }


        else
        {
            $this->template = '%s';
            $this->args = array(new Access_Denied_View());
        }

    }
}