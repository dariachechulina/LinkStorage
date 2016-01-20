<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:46 PM
 */
class Header_View extends view
{
    public function __construct()
    {
        if (isset($_SESSION['uid']))
        {
            $logged_user = new User_Model();
            $logged_user = $logged_user->get_user_by_id($_SESSION['uid']);
            if (strcmp($logged_user->get_role(), 'user') == 0)
            {
                $this->template = '<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><span class="glyphicon glyphicon-globe"></span> &nbsp Link Storage &nbsp</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="/Link/show_my">My links</a></li>
      <li><a href="/Link/add">Add link</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-user"></span> &nbsp;' . $_SESSION['login'] . '
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/User/edit/' . $_SESSION['uid'] . '"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit profile</a></li>
          <li><a href="/User/logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>';
            }

            else
            {
                $this->template = '<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><span class="glyphicon glyphicon-globe"></span> &nbsp Link Storage &nbsp</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="/Link/show_my">My links</a></li>
      <li><a href="/Link/add">Add link</a></li>
      <li><a href="/User/show_users">Users</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-user"></span> &nbsp;' . $_SESSION['login'] . '
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/User/edit/' . $_SESSION['uid'] . '"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit profile</a></li>
          <li><a href="/User/logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>';
            }
        }
        else
        {
            $this->template = '<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
     <a class="navbar-brand"><span class="glyphicon glyphicon-globe"></span> &nbsp Link Storage &nbsp</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="/User/login">Login</a></li>
      <li><a href="/User/register">Register</a></li>
    </ul>
  </div>
</nav>';
        }
    }

}