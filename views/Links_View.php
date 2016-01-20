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
            $table_begin = '<div class="container">
  <h2>Links</h2>
  <table class="table table-bordered">
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
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Link</th>
        <th>Description</th>
        <th>Privacy status</th>
      </tr>
    </thead>
    <tbody>';

            $table_rows = '';
            if (count($links) != 0)
            {
                for ($i = 0; $i < count($links); $i++)
                {

                    $table_rows = $table_rows . '<tr> <td>' . $links[$i]->get_title() .'</td>' .
                        '<td>' . $links[$i]->get_link() .'</td>' .
                        '<td>' . $links[$i]->get_description() .'</td>' .
                        '<td>' . $links[$i]->get_privacy_status() .'</td>' .'</tr>';
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