<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 1/13/16
 * Time: 12:46 PM
 */
class Body_View extends view
{
    private $header, $content, $footer;
    public $parent_args = array();

    public function __construct(array $params)
    {

        $this->template = '<div class="header">
                            %s
                            </div>
                            <div class="content">
                             %s
                            </div>
                            <div class="page-wrapper">

                            <div class="page-buffer"></div>
                            </div>
                            <div class="page-footer" align="center">
                            <p>Link Storage. Daria <span class="glyphicon glyphicon-copyright-mark"></span> 2015-2016</p>

                            </div>';

        $this->parent_args = $params;
        $this->header = new Header_View();
        $this->content = new Content_View(array($this));

       $this->args = array($this->header, $this->content);
    }

}