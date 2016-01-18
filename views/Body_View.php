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

    public function __construct()
    {
        //$this->template = '<header> %s </header>
        //                   <content> %s </content>
         //                  <footer> %s </footer>';

        $this->template = '<div class="header">
                            Logo, navigation, et cetera goes in here
                            </div>
                            <div class="content">
                            <h1>Header in here</h1>
                             <p>Paragraph in here</p>
                            </div>
                            <div class="footer">
                             Footer content goes in here
                              </div>';

       // $this->header = new Header_View();
       // $this->content = new Content_View();
        //$this->footer = new Footer_View();

       // $this->args = array($this->header, $this->content, $this->footer);
    }

}