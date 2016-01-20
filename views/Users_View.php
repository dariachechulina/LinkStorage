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
        $role = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['role'];

        if(strcmp($role, 'admin') == 0)
        {
            $this->template = '%s';
            $users = $this->parent_args[0]->parent_args[0]->parent_args[0]->parameters['all_users'];
            $table_begin = '<div class="container">
  <h2>Users</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Login</th>
        <th>Password</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Name</th>
        <th>Surname</th>
      </tr>
    </thead>
    <tbody>';
            $table_rows = '';
            for ($i = 0; $i < count($users); $i++)
            {

                $table_rows = $table_rows . '<tr> <td>' . $users[$i]->get_login() .'</td>' .
                    '<td>' . $users[$i]->get_password() .'</td>' .
                    '<td>' . $users[$i]->get_email() .
                    '<td>' . $users[$i]->get_role() .'</td>' .
                    '<td>' . $users[$i]->get_status() .'</td>' .
                    '<td>' . $users[$i]->get_name() .'</td>' .
                    '<td>' . $users[$i]->get_surname() .'</td>' .'</td> </tr>';
                // var_dump($table_rows[$i]);

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