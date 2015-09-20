<?php
 
class Main extends CI_Controller
{
    function index(){
		//load template
        $data = array();
        $msg = '';
        $code = (isset($_GET['err']))?trim($_GET['err']):'';
        if($code!=''){
            $this->lang->load('error','thai');
            $msg = $this->lang->line($code);
        }
        $data['error_msg'] = $msg;
        $data['isLogin'] = $this->session->userdata('isLogin');
		$this->template->set_template('admin');
		$this->template->write('title',setting::$WINDOW_TITLE);
        $this->template->write_view('content','register/mainpage',$data);
        $this->template->render();

    }
	
}
