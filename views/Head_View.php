<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:45 PM
 */
class Head_View extends view
{
    public $parent_args = array();

    function __construct()
    {
        $this->template = '<title> Link Storage </title>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="/scripts/logout.js"></script>
  <script src="/scripts/resend_email.js"></script>
  <script src="/scripts/delete_user.js"></script>
  <script src="/scripts/delete_link.js"></script>
  <link rel="shortcut icon" href="/im.jpg" type="image/x-icon">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
                       <link href="/style.css" rel="stylesheet">
  ';

    }
}