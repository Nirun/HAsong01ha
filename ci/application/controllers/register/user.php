<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 29/9/2555
 * Time: 23:04 น.
 * To change this template use File | Settings | File Templates.
 */
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $limit = setting::$limit;
        $page = (!$this->uri->segment(4)) ? 1 : $this->uri->segment(4);
        $offset = (int)(($page * $limit) - $limit);
        $courseID = 0; // (!$this->uri->segment(4)) ? 0 : $this->uri->segment(4);
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $this->load->model('register/course_m', 'course_m');

        $this->user_m->context['filter'] = $_GET;

        if (!isset($_GET['course']) || trim($_GET['course']) == '') {
            $resLastCourse = $this->user_m->getLastCourse(true);
            //var_dump($resLastCourse); exit;
            $courseID = (count($resLastCourse) > 0) ? $resLastCourse[0]['courseID'] : 0;
            $this->user_m->context['filter']['course'] = $courseID;
        } else {
            $courseID = trim($_GET['course']);
        }

        $this->user_m->context['courseID'] = $courseID;
        $this->user_m->context['limit'] = $limit;
        $this->user_m->context['page'] = $offset;
        $res = $this->user_m->getUserList();
        $total = $this->user_m->getCountUserListByFilter();
        //load template
        //var_dump($this->uri);exit;
        $data = array();
        $arr = $_GET;
        $data['g_name'] = (isset($arr['name'])) ? $arr['name'] : '';
        $data['g_lastname'] = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $data['g_register_type'] = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $data['g_occupation'] = (isset($arr['position'])) ? $arr['position'] : '';
        $data['g_hospital'] = (isset($arr['hospital'])) ? $arr['hospital'] : '';
        $data['g_course'] = (isset($arr['course'])) ? $arr['course'] : '';
        $data['_row'] = $offset;
        $arrQuery = array(
            'name' => $data['g_name'],
            'lastname' => $data['g_lastname'],
            'register_type' => $data['g_register_type'],
            'position' => $data['g_occupation'],
            'hospital' => $data['g_hospital'],
            'course' => $data['g_course'],
        );
        foreach ($arrQuery as $key => $val) {
            if ($val == '') {
                unset($arrQuery[$key]);
            }
        }
        $txt_query = (count($arrQuery) > 0) ? '?' . http_build_query($arrQuery) : '';
        $dataCourse = $this->course_m->getCourse($courseID);
        //var_dump($dataCourse); exit;
        $opt = $this->course_m->getCourseOptionalsList($dataCourse[0]['courseID']);
        $optional = '';
        foreach ($opt as $keyO => $valO) {
            $optional .= $valO['optional'] . ' ';
        }
        $data['paging'] = util::paging($total, $limit, 'register/user/index/%s/' . $txt_query, 'Page', $page);
        $data['hospital_list'] = $this->hospital_m->getHospital();
        $data['last_course'] = (count($dataCourse) > 0) ? $dataCourse[0] : null;
        $data['totalRegister'] = $this->user_m->getTotalRegisterByCourse($courseID);
        $data['optional'] = $optional;
//        $arrCL = $this->course_m->getAllCourses();
//        $rowCL = 0;
//        foreach ($arrCL as $k => $v) {
//            if ($v['IsActive'] == 0) {
//                unset($arrCL[$rowCL]);
//            }
//            $rowCL++;
//        }
        //$data['course_list'] = $arrCL;
        $data['course_list'] = $this->course_m->getAllCourses(true);
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        unset($data['register_type'][1]);
        $data['showCourse'] = false; // ($this->uri->segment(3)) ? true : false;
        $data['data'] = $res;
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/user_index', $data);
        $this->template->render();
    }

    function all_members()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $limit = setting::$limit;
        $page = (!$this->uri->segment(4)) ? 1 : $this->uri->segment(4);
        $offset = (int)(($page * $limit) - $limit);
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');

        $this->user_m->context['filter'] = $_GET;

        $this->user_m->context['limit'] = $limit;
        $this->user_m->context['page'] = $offset;
        $res = $this->user_m->getAllUserList();
        $total = $this->user_m->getCountAllUserListByFilter();
        $total_user = $this->user_m->getCountAllUserList();
        //load template
        //var_dump($this->uri);exit;
        $data = array();
        $arr = $_GET;
        $data['g_name'] = (isset($arr['name'])) ? $arr['name'] : '';
        $data['g_lastname'] = (isset($arr['lastname'])) ? $arr['lastname'] : '';
        $data['g_register_type'] = (isset($arr['register_type'])) ? $arr['register_type'] : '';
        $data['g_occupation'] = (isset($arr['position'])) ? $arr['position'] : '';
        $data['g_hospital'] = (isset($arr['hospital'])) ? $arr['hospital'] : '';
        $data['g_course'] = (isset($arr['course'])) ? $arr['course'] : '';
        $data['_row'] = $offset;
        $arrQuery = array(
            'name' => $data['g_name'],
            'lastname' => $data['g_lastname'],
            'register_type' => $data['g_register_type'],
            'position' => $data['g_occupation'],
            'hospital' => $data['g_hospital'],
            'course' => $data['g_course'],
        );
        foreach ($arrQuery as $key => $val) {
            if ($val == '') {
                unset($arrQuery[$key]);
            }
        }
        $txt_query = (count($arrQuery) > 0) ? '?' . http_build_query($arrQuery) : '';

        $data['paging'] = util::paging($total, $limit, 'register/user/all_members/%s/' . $txt_query, 'Page', $page);
        $data['hospital_list'] = $this->hospital_m->getHospital();
        $data['totalRegister'] = $total_user;
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        $data['data'] = $res;
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/all_members', $data);
        $this->template->render();

    }

    function form()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        //load template
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $data = array();
        $data['hospital'] = $this->hospital_m->getHospital();
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['province'] = $this->user_m->getProvince();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        unset($data['register_type'][1]);
        $this->template->set_template('admin');
        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_signup.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/user_form', $data);
        $this->template->render();
    }

    function edit()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        if (!$this->uri->segment(4)) {
            redirect('/register/user/');
            exit;
        }
        $id = $this->uri->segment(4);
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $res = $this->user_m->get_user($id);
        if (count($res) !== 1) {
            redirect('/register/user/');
            exit;
        }
        $data = array();

        $list_course = $this->user_m->getCourseByUser($id, true);
        //var_dump($list_course); exit;
        $data['data'] = $res[0];
        $data['list_course'] = $list_course;
        $data['hospital'] = $this->hospital_m->getHospital();
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['province'] = $this->user_m->getProvince();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        unset($data['register_type'][1]);
        $this->template->set_template('admin');
        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_signup.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/user_edit', $data);
        $this->template->render();
    }

    function user_delete()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        if (!$this->uri->segment(4)) {
            redirect('/register/user/all_members');
            exit;
        }
        $id = $this->uri->segment(4);
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->del_user($id);
        redirect('/register/user/all_members');

    }

    function register_delete()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        if (!$this->uri->segment(4)) {
            redirect('/register/user/');
            exit;
        }
        $id = $this->uri->segment(4);
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->del_register($id);
        redirect('/register/user');

    }

    function save()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $picture = '';
        $ok = true;
        $config['upload_path'] = setting::$PATE_TRIANEE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture')) {
            $data = $this->upload->data();
            $picture = $data['file_name'];
        } else {
            $picture = '';
        }
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->context['picture'] = $picture;
        $this->user_m->context['adminID'] = $this->session->userdata('ID');
        $ok = $this->user_m->addTrianee();

        if ($ok) {
            //load template
//            $this->template->set_template('admin');
//            $this->template->write('title', setting::$WINDOW_TITLE);
//            $this->template->write_view('content', 'register/user_index');
//            $this->template->render();
            redirect('/register/user');
        } else {
            echo 'error insert ';
            exit;
        }
    }

    function save_edit()
    {
        $pageID = 3;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        $picture = '';
        $ok = true;
        $config['upload_path'] = setting::$PATE_TRIANEE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture')) {
            $data = $this->upload->data();
            $picture = $data['file_name'];
        } else {
            $picture = '';
        }
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->context['picture'] = $picture;
        $this->user_m->context['adminID'] = $this->session->userdata('ID');
        $ok = $this->user_m->editTrianee();

        if ($ok) {
            //load template
//            $this->template->set_template('admin');
//            $this->template->write('title', setting::$WINDOW_TITLE);
//            $this->template->write_view('content', 'register/user_index');
//            $this->template->render();
            redirect('/register/user');
            exit;
        } else {
            echo 'error insert ';
            exit;
        }
    }

    function valid_user()
    {
        $arrayToJs = array();
        $this->load->model('register/user_m', 'user_m');
        //echo $this->user_m->valid_m();
        if ($this->user_m->valid_m()) {
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

    function valid_user_email()
    {
        $arrayToJs = array();
        $this->load->model('register/user_m', 'user_m');
        //echo $this->user_m->valid_m();
        if ($this->user_m->valid_mail()) {
            $arrayToJs[1] = true;
            //$arrayToJs[2] = 'ok';
        } else {
            $arrayToJs[1] = false;
            // $arrayToJs[2] = 'error';
        }
        $arrayToJs[0] = 'email';
        echo json_encode($arrayToJs);
        exit;
    }

    /*
    * Member section
    *
    */

    function member_index()
    {
        $data = array();
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_index', $data);
        $this->template->render();
    }

    function member_login()
    {
        $url = setting::$BASE_URL . '/member/apply';
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        $auth = new Authen();
        $isLogin = $auth->login($user, $password, 1);
        if ($isLogin) {
            $url = '/member/main';
        } else {
            $url = setting::$BASE_URL . '/member/apply';
        }
        redirect($url);
        exit;
    }

    function member_logout()
    {
        $url = setting::$BASE_URL . '/member/index';
        $auth = new Authen();
        $auth->logout();
        redirect($url);
        exit;
    }

    function member_forgot()
    {
        $data = array();
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->add_js('js_validate/forgot.js');
        $this->template->write_view('content', 'member_forgot', $data);
        $this->template->render();
    }

    function member_forgot_send()
    {

        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->getForgetPassword();
        if (count($res) > 0) {
            $data = $res[0];
//            $msg = 'To ' . $data['name'] . ' ' . $data['lastname'] . "\r\n";
//            $msg .= 'User name : ' . $data['username'] . "\r\n";
//            $msg .= 'Password: ' . $data['password'] . "\r\n";
            // email
            $mailFrom = 'nirun.noreply@gmail.com';
            $mailTo = $data['email'];
            $subject = 'HA Forgot password';
            $content = file_get_contents('template_email/forgot.htm');
            $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
            $content = str_replace('<!--user-->', $data['username'], $content);
            $content = str_replace('<!--password-->', $data['password'], $content);
            //echo $content; exit;
            util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');

//            $config = array();
//            $config['protocol'] = 'smtp';
//            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
//            $config['smtp_port'] = 465;
//            $config['smtp_user'] = 'nirun.noreply@gmail.com';
//            $config['smtp_pass'] = 'noreply123';
//            $config['mailtype'] = 'text';
//            $config['charset'] = 'utf-8';
//            $config['crlf'] = "\r\n";
//            $config['newline'] = "\r\n";
//            $config['wordwrap'] = TRUE;
//            $this->load->library('email', $config);
//            $this->email->from('nirun.noreply@gmail.com', 'HA Project');
//            $this->email->to($data['email']);
//            $this->email->subject('HA Forgot password');
//            $this->email->message($msg);
//            $this->email->send();
        }
        redirect(setting::$BASE_URL . '/member/index/');
        exit;
    }

    function apply()
    {
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $data = array();
        $data['hospital'] = $this->hospital_m->getHospital();
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['province'] = $this->user_m->getProvince();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        unset($data['register_type'][1]);

        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_signup.js');
        $this->template->add_js('js_validate/clear_value.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');
        // popup
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_css('css/member.css');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_apply', $data);
        $this->template->render();
    }

    function apply_main()
    {

        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
//        var_dump($this->session->userdata);
        $mounth = date('m');
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->user_m->get_user($id);
        //$course = $this->course_m->getCoursesByMonth($mounth);
        $course = $this->course_m->getRegisterCoursesByMonth($mounth);
        if (count($res) !== 1) {
            redirect(setting::$BASE_URL);
            exit;
        }
        $data = array();
        $list_course = $this->user_m->getCourseByUser($id);
        $data['data'] = $list_course;
        //var_dump($list_course);
        //var_dump($list_course); exit;
        $data['course'] = $course;
        $this->template->set_template('member');
        $this->template->add_js('js_validate/jquery.js');
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');

        $this->template->add_js('js_validate/popup_reserve.js');
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_main', $data);
        $this->template->render();
    }

    function apply_save()
    {

        $picture = '';
        $ok = true;
        $config['upload_path'] = setting::$PATE_TRIANEE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture')) {
            $data = $this->upload->data();
            $picture = $data['file_name'];
        } else {
            $picture = '';
        }
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->context['picture'] = $picture;
        $this->user_m->context['adminID'] = 0; // user register
        $trainee_name = $this->input->post('name');
        $trainee_lastname = $this->input->post('lastname');
        $resTrainee = $this->user_m->checkTraineeByName($trainee_name, $trainee_lastname);
        if (count($resTrainee) == 1) {
            $trainee_id = $resTrainee[0]['traineeID'];
            $ok = $this->user_m->editTrianeeWithoutCo($trainee_id);
        } else {

            $ok = $this->user_m->addTrianee();
        }


        if ($ok) {
            //load template
//            $this->template->write('title', setting::$WINDOW_TITLE);
//            $this->template->write_view('content', 'register/user_index');
//            $this->template->render();

            redirect(setting::$BASE_URL . '/member/main/');
            exit;
        } else {
            echo 'error insert ';
            exit;
        }
    }

    function apply_detail()
    {

        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/hospital_m', 'hospital_m');
        $res = $this->user_m->get_user($id);
        if (count($res) !== 1) {
            redirect(setting::$BASE_URL);
            exit;
        }
        $data = array();
        // var_dump($res); exit;
        $list_course = $this->user_m->getCourseByUser($id, true);
        //var_dump($list_course); exit;
        $data['data'] = $res[0];
        $data['list_course'] = $list_course;
        $data['hospital'] = $this->hospital_m->getHospital();
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['province'] = $this->user_m->getProvince();
        $data['sent_type'] = $this->user_m->getAddType(); // array('0' => 'บ้าน', '1' => 'ที่ทำงาน');
        $data['register_type'] = $this->user_m->getRegisType(); // array('0' => 'สมัครเอง', '1' => 'สรพ สมัครให้', '2' => 'ผู้ประสานงานสถานพยาบาลสมัครให้');
        unset($data['register_type'][1]);
        $this->template->set_template('member');
        // validate
        $this->template->add_js('js_validate/languages/jquery.validationEngine-en.js');
        $this->template->add_js('js_validate/jquery.validationEngine.js');
        $this->template->add_js('js_validate/valid_signup.js');
        $this->template->add_css('css/validationEngine.jquery.css');
        $this->template->add_css('css/template.css');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_detail', $data);
        $this->template->render();
    }

    function apply_save_edit()
    {
        $picture = '';
        $ok = true;
        $config['upload_path'] = setting::$PATE_TRIANEE;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('picture')) {
            $data = $this->upload->data();
            $picture = $data['file_name'];
        } else {
            $picture = '';
        }
        $this->load->model('register/user_m', 'user_m');
        $this->user_m->context['picture'] = $picture;
        $this->user_m->context['adminID'] = $this->session->userdata('ID');
        $ok = $this->user_m->editTrianeeWithoutCo();

        if ($ok) {
            //load template
//            $this->template->set_template('admin');
//            $this->template->write('title', setting::$WINDOW_TITLE);
//            $this->template->write_view('content', 'register/user_index');
//            $this->template->render();
            redirect('/member/detail');
            exit;
        } else {
            echo 'error update ';
            exit;
        }
    }

    function apply_course_result()
    {
        //var_dump($this->input->get('month'));
        $mounth = date('m');
        $m = $this->input->get('month');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->course_m->getCoursesByMonth($m);
        $course = $this->course_m->getRegisterCoursesByMonth($mounth);
        $data = array();
        $data['data'] = $res;
        $data['course'] = $course;
        $this->template->set_template('member');

        $this->template->add_js('scripts/thickbox.js');
        $this->template->add_css('css/thickbox.css');
        $this->template->add_css('css/member.css');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_course_result', $data);
        $this->template->render();

    }

    function apply_course_view()
    {

        if (!$this->uri->segment(3)) {
            redirect('/member/main/');
            exit;
        }
        $courseID = $this->uri->segment(3);
        $this->load->model('register/course_m', 'course_m');
        $dataCourse = $this->course_m->getCourse($courseID);
        $dataDocs = $this->course_m->getDocsList($courseID);
        $opt = $this->course_m->getCourseOptionalsList($dataCourse[0]['courseID']);
        //var_dump($dataCourse,$opt,$dataDocs); exit;
        $data = array();
        $data['data'] = $dataCourse[0];
        $data['optional'] = $opt;
        $data['docs'] = $dataDocs;
        $this->template->set_template('member');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_course_view', $data);
        $this->template->render();

    }

    function apply_course_detail()
    {
        if (!$this->uri->segment(3)) {
            redirect('/member/main/');
            exit;
        }
        $courseID = $this->uri->segment(3);
        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/user_m', 'user_m');
        $dataCourse = $this->course_m->getCourse($courseID);
        $dataDocs = $this->course_m->getDocsList($courseID);
        $opt = $this->course_m->getCourseOptionalsList($dataCourse[0]['courseID']);
        $totalRegister = $this->user_m->getTotalRegisterByCourse($courseID);
        //var_dump($dataCourse,$opt,$dataDocs); exit;
        $C_reg = $this->course_m->getCountCourseRegister($courseID, 0);
        $C_paid = $this->course_m->getCountCourseRegister($courseID, 1);

        $limitDate = 0;
        $isShowBtn = false;
        $data = array();
        $data['data'] = $dataCourse[0];
//        var_dump($data['data']); exit;
        $data['optional'] = $opt;
        $data['docs'] = $dataDocs;
        $data['courseID'] = $courseID;
        $data['C_reg'] = $C_reg;
        $data['C_paid'] = $C_paid;
        $data['coursetypeID'] = $dataCourse[0]['coursetypeID']; // group course = 3
        $this->template->set_template('member');

        $limitTrainees = $data['data']['limittrainees'];
        $registerEndDate = explode(' ', $data['data']['registenddate']);
        $limitDate = intval((strtotime(date('Y-m-d')) - strtotime($registerEndDate[0])) / (60 * 60 * 24));

        $validate_limit = FALSE;
        if (intval($totalRegister) >= intval($limitTrainees) && $validate_limit) {
            $isShowBtn = false;
        } elseif ($limitDate > 0) {
            $isShowBtn = false;
        } else {
            $isShowBtn = true;
        }
        $data['isShowBtn'] = $isShowBtn;

        $btn_status = 1;
        if (intval($totalRegister) >= intval($limitTrainees)) {
            $btn_status = 3;
        } else if ($limitDate > 0) {
            $btn_status = 2;
        } else {
            $btn_status = 1;
        }
        $data['btn_status'] = $btn_status;

        // $this->template->add_js('scripts/thickbox.js');
        //  $this->template->add_css('css/thickbox.css');

        $this->template->add_js('js_validate/jquery.js');
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');

        $this->template->add_js('js_validate/popup_reserve.js');
        $this->template->add_js('js_validate/valid_group_course.js');
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_css('js_ui/jquery-ui.css');
        $this->template->add_js('js_ui/jquery-ui.js');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_course_detail', $data);
        $this->template->render();

    }

    function apply_mail()
    {
        //var_dump($this->input->get('month'));
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/mail_m', 'mail_m');
        $dataMail = $this->mail_m->getUserMailList($id);

        $data = array();
        $data['data'] = $dataMail;
        $this->template->set_template('member');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_mail', $data);
        $this->template->render();

    }

    function apply_mail_view()
    {
        //var_dump($this->input->get('month'));
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->uri->segment(4);
        $this->load->model('register/mail_m', 'mail_m');
        $read = $this->mail_m->mark_read($id);
        $dataMail = $this->mail_m->getUserMailDesc($id);
        $data = array();
        $data['data'] = $dataMail;
        $this->template->set_template('member');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_mail_view', $data);
        $this->template->render();

    }

    function apply_mail_delete()
    {
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->uri->segment(4);
        $this->load->model('register/mail_m', 'mail_m');
        $del = $this->mail_m->delete_inbox($id);
        redirect(setting::$BASE_URL . '/member/mail/');
    }

    function register_save()
    {

        $this->load->model('register/user_m', 'user_m');
        $data = array();
        $data['registerBy'] = $this->input->post('registerBy');
        $data['traineeID'] = $this->input->post('traineeID');
        $data['courseID'] = $this->input->post('courseID');
        $data['own_food'] = $this->input->post('own_food');
        if ($data['registerBy'] == 3) {
            for ($i = 0; $i < 20; $i++) {
                if (trim($_POST['name'][$i]) != '' && trim($_POST['lastname'][$i])) {
                    $data['register'][] = array(
                        'name' => trim($_POST['name'][$i]),
                        'lastname' => trim($_POST['lastname'][$i]),
                        'idcard' => trim($_POST['idcard'][$i]),
                        'email' => trim($_POST['email'][$i]),
                        'food' => trim($_POST['food'][$i]),
                    );
                }
            }
        }
        $this->user_m->context['data'] = $data;
        $ret = $this->user_m->addRegister();
        redirect(setting::$BASE_URL . '/member/main/');
        exit;
    }

    function popup_payment()
    {
        //echo 'popup'; exit;

        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $user_info = $this->user_m->get_user_profile($id);
        $province = $this->user_m->getProvince();
        $registerID = (isset($_POST['registerID'])) ? $_POST['registerID'] : '';
        $data = array();
        if ($registerID != '') {
            $data['registerID'] = $registerID;
            $data['traineeID'] = $id;
        } else {
            //exit('register with paid');
            $data['registerBy'] = $this->input->post('registerBy');
            $data['traineeID'] = $this->input->post('traineeID');
            $data['own_food'] = $this->input->post('own_food');
            if ($data['registerBy'] == 3) {
                $lenObj = count($_POST['name']);
                for ($i = 0; $i < $lenObj; $i++) {
                    if (trim($_POST['name'][$i]) != '' && trim($_POST['lastname'][$i])) {
                        $data['register'][] = array(
                            'name' => trim($_POST['name'][$i]),
                            'lastname' => trim($_POST['lastname'][$i]),
                            'food' => trim($_POST['food'][$i]),
                            'prefix' => trim($_POST['prefix'][$i]),
                            'occupation' => trim($_POST['occupation'][$i]),
                            'idcard' => trim($_POST['idcard'][$i]),
                            'email' => trim($_POST['email'][$i]),
                        );
                    }
                }
            }
        }
        $val = array();
        $val['province'] = $province;
        $val['data'] = json_encode($data);
        $val['regis_bill'] = (isset($data['register'])) ? $data['register'] : false;
        $val['user_info'] = $user_info[0];
        $val['courseID'] = $this->uri->segment(3);
        $this->template->set_template('member');
        $this->template->add_js('js_validate/jquery.js');
        $this->template->add_js('js_validate/popup_reserve.js');
        $this->template->add_js('js_ui/jquery-ui.js');
        $this->template->add_css('js_ui/jquery-ui.css');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'popup_payment', $val);
        $this->template->render();
//        $this->load->view('popup_payment', $val);
    }

    function popup_reserve()
    {
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->user_m->get_user_profile($id);
        $food = $this->user_m->getFoodType();
//        $courseID = $this->input->post('courseID');
        $courseID = $this->uri->segment(3);
        $resCourse = $this->course_m->getCourse($courseID);
        $data = array();
        $data['data'] = $res[0];
        $data['food'] = $food;
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['traineeID'] = $id;
        $data['courseID'] = $courseID;
        $data['courseType'] = $resCourse[0]['coursetypeID'];
        $data['course'] = $resCourse[0];

        $this->template->set_template('member');
        $this->template->add_js('js_validate/jquery.js');
        $this->template->add_js('js_validate/popup_reserve.js');
        $this->template->add_js('js_ui/jquery-ui.js');
        $this->template->add_css('js_ui/jquery-ui.css');
        $this->template->add_css('css/member.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'popup_reserve', $data);
        $this->template->render();

        //$this->load->view('popup_reserve', $data);
    }

    function register_paid()
    {

//        echo 'xx ' . $this->input->post('register') . 'xx';
//        util::debug_post();


        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/user_m', 'user_m');
        $courseID = $this->input->post('courseID');

        $res = json_decode($this->input->post('register'), true);
        $this->user_m->context['payment_type'] = 1; // transfer
        $this->user_m->context['courseID'] = $courseID;
        $this->user_m->context['desc'] = '';
        $this->user_m->context['cheq'] = '';
        $this->user_m->context['bank_name'] = '';
        $this->user_m->context['register'] = $res;
        // add Receipt info
        $is_separate = 0;
        $add_default = 0;
        $regType = trim($this->input->post('receipt_type'));
        if ($regType == 'self') {
            $user_name = $this->input->post('user_name');
            $user_address = $this->input->post('user_address');
            $user_soi = $this->input->post('user_soi');
            $user_road = $this->input->post('user_road');
            $user_district = $this->input->post('user_district');
            $user_province = $this->input->post('user_province');
            $user_postcode = $this->input->post('user_postcode');
            $user_taxID = $this->input->post('user_taxID');
        } elseif ($regType == 'other') {
            $user_name = $this->input->post('other1_name');
            $user_address = $this->input->post('other1_address');
            $user_soi = $this->input->post('other1_soi');
            $user_road = $this->input->post('other1_road');
            $user_district = $this->input->post('other1_district');
            $user_province = $this->input->post('other1_province');
            $user_postcode = $this->input->post('other1_postcode');
            $user_taxID = $this->input->post('other1_taxID');
        } elseif ($regType == 'separate') {
            $user_name = $this->input->post('separate_name');
            $user_address = $this->input->post('other2_add_separate');
            $user_soi = $this->input->post('other2_soi_separate');
            $user_road = $this->input->post('other2_road_separate');
            $user_district = $this->input->post('other2_district_separate');
            $user_province = $this->input->post('other2_province_separate');
            $user_postcode = $this->input->post('other2_postcode_separate');
            $user_taxID = $this->input->post('other2_taxID_separate');
            $is_separate = 1;
            $add_default = (trim($this->input->post('receipt_default_add')) != '') ? 1 : 0; // default add
        }

        $this->user_m->context['receipt_type'] = $this->input->post('receipt_type');
        $this->user_m->context['nameBilling'] = $user_name;
        $this->user_m->context['addBilling'] = $user_address;
        $this->user_m->context['soiBilling'] = $user_soi;
        $this->user_m->context['roadBilling'] = $user_road;
        $this->user_m->context['districtBilling'] = $user_district;
        $this->user_m->context['provinceBilling'] = $user_province;
        $this->user_m->context['postcodeBilling'] = $user_postcode;
        $this->user_m->context['tax_id'] = $user_taxID;
        $this->user_m->context['default_add'] = $add_default;

        $traineeID = $res['traineeID'];
        $data = $this->user_m->get_user_profile($traineeID);

        $regisID = 0;
        /** Check Over Limit trainee **/
        $total_reg = 1;
        $dataCourse = $this->course_m->getCourse($courseID);
        $totalRegister = $this->user_m->getTotalRegisterByCourse($courseID);
        if ($res['registerBy'] == '3') {
            $total_reg = count($res['register']);
        }
        $total_reg += intval($totalRegister);
        $total_limit = $dataCourse[0]['limittrainees'];
        if ($total_reg > intval($total_limit)) {
            $reg_status = 4; // que
        } else {
            $reg_status = 2;
        }
        $this->user_m->context['IsPaid'] = $reg_status;
        /* end Check Over Limit trainee */
        if (isset($res['registerID'])) {
            $ret = $this->user_m->addPaymentUpdateRegister();
            $regisID = trim($res['registerID']);
        } else {
            $ret = $this->user_m->addPaymentWithRegister();
            if ($ret != false) {
                $regisID = $ret;
            }
        }

        if ($regisID != 0) {


            // email
            $mailFrom = 'nirun.noreply@gmail.com';
            $mailTo = $data[0]['email'];
            if ($reg_status == 2) {
                $subject = 'ยืนยันการชำระเงิน';
                $content = $this->getBilling($regisID);
            } else {
                $subject = 'ยืนยันการได้รับข้อมูลสำรองที่นั่ง - รอที่นั่งว่าง';
                $content = $this->getQueue($regisID);
            }

            util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
            //echo $content;
        }
        redirect(setting::$BASE_URL . '/member/main/');
        exit;
    }

    function register_exists()
    {
        $arr = array();
        $this->load->model('register/user_m', 'user_m');
        $type = $this->input->post('registerBy');
        $traineeID = $this->input->post('traineeID');
        $courseID = $this->input->post('courseID');
        if ((int)$type == 1):
            $res = $this->user_m->getCourseExistsByUserId($traineeID, $courseID);
            if (count($res) > 0) :
                $arr['msg'] = Msg::$course_exists;
                $arr['user_exists'] = true;
            else:
                $arr['msg'] = Msg::$no_course_short;
                $arr['user_exists'] = false;
            endif;
        elseif ((int)$type == 3):
            $arr['msg'] = Msg::$no_course_short;
            $arr['user_exists'] = false;
            for ($i = 0; $i < count($_POST['name']); $i++) {
                if (trim($_POST['name'][$i]) != '' && trim($_POST['lastname'][$i])) {
                    $name = trim($_POST['name'][$i]);
                    $lastname = trim($_POST['lastname'][$i]);
                    $res = $this->user_m->getCourseExistsByRepresentative($name, $lastname, $courseID);
                    if (count($res) > 0) {
                        $arr['msg'] = $name . ' ' . $lastname . ' ได้สมัครอบรมในหลักสุตรนี้แล้ว';
                        $arr['user_exists'] = true;
                        break;
                    }
                }
            }
        endif;
        echo json_encode($arr);
        exit;
    }

    function barcode()
    {
        $txt = $this->uri->segment(4);
        $util = new util();
        echo $util->genBarcode($txt);
        exit;

    }

    function apply_course_receipt()
    {

        $id = $this->uri->segment(3);
        $regisID = util::haDecrypt($id);
        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->checkRegisterExists($regisID);
        $data = array();
        if ($res > 0) {
            $content = $this->getBillingOnly($regisID);
            $data['is_show'] = true;
            $data['content'] = $content;
        } else {
            $data['is_show'] = false;
            $data['content'] = '';
        }
        $this->load->view('print_view', $data);
    }

    function change_name()
    {
        $id = $this->input->post('registerID');
        $this->load->model('register/user_m', 'user_m');
        $food = $this->user_m->getFoodType();
        $res = $this->user_m->getRegisterInfo($id);
        $data = array();
        $data['data'] = $res[0];
        $data['food'] = $food;
        $data['prefix'] = $this->user_m->getPrefixName();
        $data['occupation'] = $this->user_m->getOccupation();
        $data['position'] = $this->user_m->getPosition();
        $data['seat'] = $this->input->post('seat');
        $this->load->view('popup_change', $data);

    }

    function change_save()
    {

        $type = $this->input->post('changeType');
        $this->load->model('register/user_m', 'user_m');
        if ($type == 0) {
            $resTrainee = $this->user_m->updateTraineeChange();
        } else {
            $resRegistration = $this->user_m->updateChangeRegister();
        }
        $resReceipt = $this->user_m->updateReceiptInfo();
        echo 'บันทึกข้อมูลเรียบร้อย';
        echo '<br> กด ESC หรือ x เพื่อปิด';
        exit;
    }

    function getBilling($regisID = 0)
    {
        header('Content-type: text/html; charset=utf-8');
        $amount = 0;
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->user_m->getBillingInfo($regisID);
        $data = array();
        $data = $res[0];
        $regisBy = 0;
        if ((int)$data['registerBy'] == 3) {
            $representive = $this->user_m->getRepresentive($regisID);
            $price = (double)$data['price'];
            $sum_rep = count($representive);
            $amount = (double)($price * $sum_rep);
            $data['sum_register'] = $sum_rep;
            $regisBy = 3;
        } else {
            $amount = (double)$data['price'];
            $data['sum_register'] = '1';
            $regisBy = 0;
        }
        $price_format = (double)$data['price'];
        $data['amount'] = number_format($amount, 2);
        $data['price_format'] = number_format($price_format, 2);
        $data['txt_price'] = util::num2thai($amount);
        //$data['ref1'] = '1' . str_pad($data['traineeID'], 5, '0', STR_PAD_LEFT);
        $data['ref1'] = str_pad($data['traineeID'], 4, '0', STR_PAD_LEFT);
        $date = explode(' ', $data['startdate']);
        $date = explode('-', $date[0]);
        $month = $date[1];
        $year = (int)$date[0] + 543;
        //$data['ref2'] = substr($data['coursecode'], 2, 3) . substr($data['generation'], 0, 1) . $month . substr($year, 2, 2) . str_pad($data['registrationID'], 4, '0', STR_PAD_LEFT);
        //$data['ref2'] = substr($data['coursecode'], 2, 3) . substr($data['generation'], 0, 1) . str_pad($data['registrationID'], 4, '0', STR_PAD_LEFT);
        // get Temp ID
//        $tmp = $this->user_m->getTmpId();
//        $tmpID = $tmp[0]['id'];
        $regDate = date('Y-m-d');
        $separateRegDate = explode("-", $regDate);
        $regDate = date('Y-m-d', strtotime($regDate . " +15 days"));
        $nowDate = date('Y-m-d');
        $txt_end_pay = "กรุณาชำระเงินภายใน  15 วัน";
        if (strtotime($regDate) <= strtotime($nowDate)) {
            $txt_end_pay = "วันสุดท้ายในการชำระเงิน " . Thaidate::date($data["payenddate"], "DD MM YYYY");
        } else {
            $txt_end_pay = "วันสุดท้ายในการชำระเงิน " . Thaidate::date($regDate . ' 00:00:00', "DD MM YYYY");
        }

        $ref_no = intval($this->user_m->getRefNo($data['courseID'])) + 1; // SET NEW REF_ID
        $data['ref2'] = substr($data['coursecode'], 2, 3) . substr($data['generation'], 0, 1) . str_pad($ref_no, 4, '0', STR_PAD_LEFT);
        $content = file_get_contents('template_email/bill.html');
        $content = str_replace('<!--date-->', date('d/m/Y'), $content);
        $content = str_replace('<!--txt_end_pay-->', $txt_end_pay, $content);
        $content = str_replace('<!--company_id-->', $data['hospitalID'], $content);
        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        //$content = str_replace('<!--name-->', $data['receipt_name'], $content);
        $content = str_replace('<!--ref1-->', $data['ref1'], $content);
        $content = str_replace('<!--ref2-->', $data['ref2'], $content);
        $content = str_replace('<!--amount-->', $data['amount'], $content);
        $content = str_replace('<!--txt_price-->', $data['txt_price'], $content);
        $content = str_replace('<!--sum_register-->', $data['sum_register'], $content);
        $content = str_replace('<!--period-->', Thaidate::date($data['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($data['enddate'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--place-->', $data['place'], $content);
        $content = str_replace('<!--course_name-->', $data['coursename'] . '(' . $data['coursecode'] . ')', $content);
        $content = str_replace('<!--course_day-->', $data['days'], $content);
        $content = str_replace('<!--price-->', $data['price_format'], $content);
        $content = str_replace('<!--dd-->', date('d'), $content);
        $content = str_replace('<!--mm-->', Thaidate::thaiMonth(date('n')), $content);
        $content = str_replace('<!--yy-->', (int)date('Y') + 543, $content);
        $content = str_replace('<!--billing_address-->', $this->getBillingAddress($regisID, $regisBy), $content);

        $resCourse = $this->course_m->getCourse($data['courseID']); //TODO SET COMPANY CODE
        $courseType = $resCourse[0]['coursetypeID'];
        $companycode = '90122';
        if ($courseType == 2) {
            $companycode = '90122';
        } else {
            $companycode = '9968';
        }
        $content = str_replace('<!--companycode-->', $companycode, $content);

        // update ref no.
        $this->user_m->updateRegistrationRefNo($data['registrationID'], $data['ref1'], $data['ref2']);
        $this->user_m->setRefNo($data['registrationID'], $data['traineeID'], $data['courseID'], $data['ref1'], $data['ref2']);
        //$tmp = $this->user_m->delTmpId($tmpID); // Delete Temp ID
        return $content;
    }

    function getBillingOnly($regisID = 0)
    {
        header('Content-type: text/html; charset=utf-8');
        $amount = 0;
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->user_m->getBillingInfo($regisID);
        $data = array();
        $data = $res[0];
        //print_r($data);
        $regisBy = 0;
        if ((int)$data['registerBy'] == 3) {
            $representive = $this->user_m->getRepresentive($regisID);
            $price = (double)$data['price'];
            $sum_rep = count($representive);
            $amount = (double)($price * $sum_rep);
            $data['sum_register'] = $sum_rep;
            $regisBy = 3;
        } else {
            $amount = (double)$data['price'];
            $data['sum_register'] = '1';
            $regisBy = 0;
        }
        $price_format = (double)$data['price'];
        $data['amount'] = number_format($amount, 2);
        $data['price_format'] = number_format($price_format, 2);
        $data['txt_price'] = util::num2thai($amount);
        if (intval($regisID) > 9999) {
            $refNo = $this->user_m->getRefInfo($regisID);
            $data['ref1'] = $refNo[0]['billing_ref1'];
            $data['ref2'] = $refNo[0]['billing_ref2'];
        } else {
            $data['ref1'] = str_pad($data['traineeID'], 4, '0', STR_PAD_LEFT);
            $data['ref2'] = substr($data['coursecode'], 2, 3) . substr($data['generation'], 0, 1) . str_pad($data['registrationID'], 4, '0', STR_PAD_LEFT);
        }

//        $refInfo =$this->user_m->getRefInfo($regisID);
//        $data['ref2'] = $refInfo[0]['billing_ref2'];
//        $data['ref1'] = $refInfo[0]['billing_ref1'];

        $regDate = date('Y-m-d', strtotime($data['registerdatetime']));
        $separateRegDate = explode("-", $regDate);
        $regDate = date('Y-m-d', strtotime($regDate . " +15 days"));
        $nowDate = date('Y-m-d');
        $txt_end_pay = "กรุณาชำระเงินภายใน  15 วัน";
        if (strtotime($regDate) <= strtotime($nowDate)) {
            $txt_end_pay = "วันสุดท้ายในการชำระเงิน " . Thaidate::date($data["payenddate"], "DD MM YYYY");
        } else {
            $txt_end_pay = "วันสุดท้ายในการชำระเงิน " . Thaidate::date($regDate . ' 00:00:00', "DD MM YYYY");
        }
        $content = file_get_contents('template_email/bill.html');
        $content = str_replace('<!--date-->', date('d/m/Y'), $content);
        $content = str_replace('<!--txt_end_pay-->', $txt_end_pay, $content);
        $content = str_replace('<!--company_id-->', $data['hospitalID'], $content);
        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        //$content = str_replace('<!--name-->', $data['receipt_name'], $content);
        $content = str_replace('<!--ref1-->', $data['ref1'], $content);
        $content = str_replace('<!--ref2-->', $data['ref2'], $content);
        $content = str_replace('<!--amount-->', $data['amount'], $content);
        $content = str_replace('<!--txt_price-->', $data['txt_price'], $content);
        $content = str_replace('<!--sum_register-->', $data['sum_register'], $content);
        $content = str_replace('<!--period-->', Thaidate::date($data['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($data['enddate'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--place-->', $data['place'], $content);
        $content = str_replace('<!--course_name-->', $data['coursename'] . '(' . $data['coursecode'] . ')', $content);
        $content = str_replace('<!--course_day-->', $data['days'], $content);
        $content = str_replace('<!--price-->', $data['price_format'], $content);
        $content = str_replace('<!--dd-->', (int)$separateRegDate[2], $content);
        $content = str_replace('<!--mm-->', Thaidate::thaiMonth((int)$separateRegDate[1]), $content);
        $content = str_replace('<!--yy-->', (int)$separateRegDate[0] + 543, $content);
        $content = str_replace('<!--billing_address-->', $this->getBillingAddress($regisID, $regisBy), $content);

        $resCourse = $this->course_m->getCourse($data['courseID']); //TODO SET COMPANY CODE
        $courseType = $resCourse[0]['coursetypeID'];
        $companycode = '90122';
        if ($courseType == 2) {
            $companycode = '90122';
        } else {
            $companycode = '9968';
        }
        $content = str_replace('<!--companycode-->', $companycode, $content);

        return $content;
    }

    function apply_course_remove()
    {
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->uri->segment(3);
        $regisID = util::haDecrypt($id);
        $traineeID = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $chk = $this->user_m->checkYourRegistration($regisID, $traineeID);
        if ($chk > 0) {
            $res = $this->user_m->removeYourRegistration($regisID, $traineeID);
        }
        redirect('/member/main/');
        exit;
    }

    function member_doc()
    {
        Authen::memberAllow($this->session->userdata('isLogin'));
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->get_user($id);
        if (count($res) !== 1) {
            redirect(setting::$BASE_URL);
            exit;
        }
        $mounth = date('m');
        $this->load->model('register/course_m', 'course_m');
        $course = $this->course_m->getRegisterCoursesByMonth($mounth);
        $list_course = $this->user_m->getCourseByUser($id, true);
        $data = array();
        $data['course'] = $course;
        $data['list_course'] = $list_course;

        $this->template->set_template('member');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'member_doc', $data);
        $this->template->render();
    }

    function getQueue($regisID = 0)
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->getBillingInfo($regisID);
        $data = array();
        $data = $res[0];
        $content = file_get_contents('template_email/queuemail.htm');
        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        return $content;
    }

    function getConfirmQueue($regisID = 0)
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->getBillingInfo($regisID);
        $data = array();
        $total = 1;
        $data = $res[0];
        $content = file_get_contents('template_email/confirmqueuemail.htm');
        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        $content = str_replace('<!--regDate-->', Thaidate::date($data['registerdatetime'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--period-->', Thaidate::date($data['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($data['enddate'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--place-->', $data['place'], $content);
        $content = str_replace('<!--course_name-->', $data['coursename'] . '(' . $data['coursecode'] . ')', $content);

        if ((int)$data['registerBy'] == 3) {
            $representive = $this->user_m->getRepresentive($regisID);
            $total = count($representive);
            $arrGroup = array();
            foreach ($representive as $key => $val) {
                $arrGroup[] = ' คุณ ' . $val['name'] . ' ' . $val['lastname'];
            }
            $groupName = implode(',', $arrGroup);
            $content = str_replace('<!--group_name-->', $groupName, $content);
        }
        $content = str_replace('<!--total-->', $total, $content);
        return $content;
    }

    function confirm_queue()
    {
        $ret = true;
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/user_m', 'user_m');
        $regisID = $this->uri->segment(4);
        $res = $this->user_m->getBillingInfo($regisID);
        $content = $this->getBilling($regisID);
        $content_confirm = $this->getConfirmQueue($regisID);

        try {
            $mailFrom = 'nirun.noreply@gmail.com';
            $mailTo = $res[0]['email'];
            $subject = 'ยืนยันการชำระเงิน';
            $subject_confirm = 'ได้รับยืนยันการสำรองที่นั่งแล้ว';
            util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
            util::sendEmail($mailFrom, array($mailTo), $subject_confirm, $content_confirm, 'html');
        } catch (Exception $e) {
            $ret = false;
        }

        return $ret;

    }

    function getBillingAddress($regisID, $regisBy = 0)
    {
        $txt = "";
        $this->load->model('register/user_m', 'user_m');
        if ($regisBy == 0) {
            $res = $this->user_m->getRegisterInfo($regisID);
            $addr = $res[0];
            $txtAddr = "";
            $txtAddr = $addr['rc_address'];
            $txtAddr .= ' ' . $addr['rc_soi'];
            $txtAddr .= ' ' . $addr['rc_road'];
            $txtAddr .= ' ' . $addr['rc_district'];
            $txtAddr .= ' ' . $addr['rc_province'];
            $txtAddr .= ' ' . $addr['rc_postcode'];
            $txt = "<div><p>" . $res[0]['rc_name'] . "</p>";
            $txt .= "<span>" . $txtAddr . "</span></div>";
//            $txt .= "<span>" . $res[0]['rc_address'] . "</span</div>";

        } else {
            $res1 = $this->user_m->getRepresentive($regisID);
            foreach ($res1 as $k => $v) {
                $regID = $v['registrationID'];
                $res2 = $this->user_m->getRegisterInfo($regID);
                $addr = $res2[0];
                $txtAddr = "";
                $txtAddr = $addr['rc_address'];
                $txtAddr .= ' ' . $addr['rc_soi'];
                $txtAddr .= ' ' . $addr['rc_road'];
                $txtAddr .= ' ' . $addr['rc_district'];
                $txtAddr .= ' ' . $addr['rc_province'];
                $txtAddr .= ' ' . $addr['rc_postcode'];
                $txt .= "<div><p>" . $res2[0]['rc_name'] . "</p>";
                $txt .= "<span>" . $txtAddr . "</span></div>";
            }

        }

        return $txt;
    }

    function getRemindEmail()
    {
        $this->load->model('register/user_m', 'user_m');
        $res = $this->user_m->getRemindWaiting();
        $rec = 0;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $mailFrom = 'nirun.noreply@gmail.com';
                $mailTo = $data['email'];
                $subject = 'ยืนยันการชำระเงิน เหลือเวลาอีก 3 วัน';
                $content = $this->getBillingOnly($data['registrationID']);
                util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
                //echo $content;
                $rec++;
                echo($rec . '. > regID >' . $data['registrationID'] . ' email > ' . $mailTo . '<br>');
            }
        }

    }

    function register_group_course()
    {
        $ret = false;
        $courseID = $this->input->post('courseID');
        $id = $this->session->userdata('traineeID');
        $this->load->model('register/user_m', 'user_m');
        $this->load->model('register/course_m', 'course_m');
        $dataCourse = $this->course_m->getCourse($courseID);
        $course_cond = $dataCourse[0]['group_condition'];

        $res = $this->user_m->get_user_profile($id);
        $hospitalID = $res[0]['hospitalID'];
        if ($course_cond != null) {
            $datacond = json_decode($course_cond, true);

        }
        if ($course_cond == null) {
            $ret = true;
        } else if (count($datacond['group_course_cond']['hospital']) > 0) {
            $chk = false;
            $arrHos = $datacond['group_course_cond']['hospital'];
            foreach ($arrHos as $k => $v) {
                if ($hospitalID == $v[0]) {
                    $chk = true;
                    break;
                }
            }
            if ($chk) {
                $max_register = $datacond['group_course_cond']['max_register'];
                if ($max_register != 0) {
                    $dataChk = $this->user_m->getCountHospitalRegisterGroup($courseID);
                    if (count($dataChk) > 0) {
                        foreach ($dataChk as $k1 => $v1) {
                            if ($hospitalID == $v1['hospitalID'] && $max_register > $v1['total']) {
                                $ret = true;
                                break;
                            }
                        }

                        var_dump($dataChk, $max_register);

                    } else {
                        $ret = true;
                    }
                } else {
                    $ret = true;
                }

            }
            // print_r($arrHos);
        }

        var_dump($ret);
//        var_dump($res, $course_cond);
        exit;
    }
}