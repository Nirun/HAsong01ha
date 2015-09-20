<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 24/9/2555
 * Time: 0:40 น.
 * To change this template use File | Settings | File Templates.
 */
class Home extends CI_Controller
{
    function index(){

        $this->template->write('title',setting::$WINDOW_TITLE);
        $this->template->write_view('content','home_message');	
        $this->template->render();
    }
}
