<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 23/10/2555
 * Time: 15:52 น.
 * To change this template use File | Settings | File Templates.
 */
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $this->load->model('register/admin_m', 'admin_m');
        $this->admin_m->context['limit'] = setting::$limit;
        $this->admin_m->context['page'] = 0;
        $user = array();
        $listUser = $this->admin_m->getAdminList();
        foreach ($listUser as $key => $val) {
            $user[] = array(
                'id' => $val['adminID'],
                'name' => $val['firstname'] . ' ' . $val['lastname'],
                'position' => $val['position'],
                'permission' => $this->getPermissionName($val['adminID'])
            );
        }

        $data = array();
        $data['user'] = $user;
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/admin_index', $data);
        $this->template->render();

    }

    function form()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $this->load->model('register/admin_m', 'admin_m');
        $permission = $this->admin_m->getPermission();

        $this->template->set_template('admin');
        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_admin.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');

        $data = array();
        $data['permission'] = $permission;
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/admin_form', $data);
        $this->template->render();
    }

    function edit()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        if (!$this->uri->segment(4)) {
            redirect('/register/admin/', 'refresh');
            exit;
        }
        $id = $this->uri->segment(4);
        $this->load->model('register/admin_m', 'admin_m');
        $res = $this->admin_m->get_user($id);
        if (count($res) !== 1) {
            redirect('/register/admin/', 'refresh');
            exit;
        }
        $auth = array();
        $res2 = $this->admin_m->getAuthenByUserId($id);
        foreach ($res2 as $key => $val) {
            $auth[] = $val['permissionID'];
        }
        $permission = $this->admin_m->getPermission();
        $this->template->set_template('admin');
        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_admin.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');

        $data = array();
        $data['data'] = $res[0];
        $data['auth'] = $auth;
        $data['permission'] = $permission;
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/admin_edit', $data);
        $this->template->render();
    }

    function save()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $ok = true;
        $this->load->model('register/admin_m', 'admin_m');
        $this->admin_m->context['adminID'] = $this->session->userdata('ID');
        $ok = $this->admin_m->addAdmin();
        if ($ok) {
            redirect('/register/admin', 'refresh');
        } else {
            echo 'error insert ';
            exit;
        }
    }

    function save_edit()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $ok = true;
        $this->load->model('register/admin_m', 'admin_m');
        $this->admin_m->context['adminID'] = $this->session->userdata('ID');
        $ok = $this->admin_m->editAdmin();
        if ($ok) {
            redirect('/register/admin', 'refresh');
        } else {
            echo 'error Update ';
            exit;
        }
    }

    function admin_delete()
    {
        $pageID = 1;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        if (!$this->uri->segment(4)) {
            redirect('/register/admin/', 'refresh');
            exit;
        }
        $id = $this->uri->segment(4);
        $this->load->model('register/admin_m', 'admin_m');
        $this->admin_m->del_admin($id);
        redirect('/register/admin');

    }

    function valid_user()
    {
        $arrayToJs = array();
        $this->load->model('register/admin_m', 'admin_m');
        //echo $this->user_m->valid_m();
        if ($this->admin_m->valid_m()) {
            $arrayToJs[1] = true;
            //$arrayToJs[2] = 'ok';
        } else {
            $arrayToJs[1] = false;
            // $arrayToJs[2] = 'error';
        }
        $arrayToJs[0] = 'user';
        echo json_encode($arrayToJs);
        exit;
    }

    function getPermissionName($AdminID)
    {
        $arr = array();
        $arrRet = array();
        $ret = '';
        $this->load->model('register/admin_m', 'admin_m');
        $arr = $this->admin_m->getPermissionByAdmin($AdminID);
        foreach ($arr as $key => $val) {
            $arrRet[] = $val['permission'];
        }
        $ret = implode(',', $arrRet);
        return $ret;
    }

    function login()
    {
        $url = setting::$BASE_URL.'/register';
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        $auth = new Authen();
        $isLogin = $auth->login($user, $password);
        if ($isLogin) {
            $url = '/register/main/index/';
        }
        else{
            $url = '/register/main/index/?err=error_login';
        }
        //header('location:'.$url);
        redirect($url);
        //exit;
    }

    function view()
    {
        exit;
//        $pageID = 1;
//        Authen::AllowPage($pageID, $this->session->userdata('role'), '/register');
        var_dump($this->session->userdata('isLogin'));
        exit('session');

//        $data = array(
//            'user' => 1,
//            'name' => 'ball',
//            'lastname' => 'j'
//        );
//        $res = Log::setLog(2, 8, $data);
//
//        $data = Log::getLog(2,8,20,1,'desc');
//        var_dump($data);
//        exit('log');
    }

    function logout()
    {
        $url = setting::$BASE_URL.'/register';
        $auth = new Authen();
        $auth->logout();
        redirect($url);
        //header('location:'.$url);
        //exit;
    }
}
