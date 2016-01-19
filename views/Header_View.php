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
        if (isset($_SESSION['login']))
        {
            $this->template = '<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Link Storage</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/">Main page</a></li>
      <li><a href="/Link/show_my">My links</a></li>
      <li><a href="#">Edit profile</a></li>
      <li><a href="/User/logout">Logout</a></li>
    </ul>
  </div>
</nav>';
        }
        else
        {
            $this->template = '<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Link Storage</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/">Main page</a></li>
      <li><a href="/User/login">Login</a></li>
      <li><a href="/User/register">Register</a></li>
    </ul>
  </div>
</nav>';
        }
    }

}