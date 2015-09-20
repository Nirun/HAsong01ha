<?php

class Certificate extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $pageID = 6;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $this->load->model('register/course_m', 'course_m');

        //paging
        $limit = setting::$limit;
        $page = (!$this->uri->segment(4)) ? 1 : $this->uri->segment(4);
        $offset = (int)(($page * $limit) - $limit);
        $courseID = 0;

        $this->course_m->context['limit'] = $limit;
        $this->course_m->context['page'] = $offset;

        $this->course_m->context['filter'] = $_GET;
        $qry = '';
        if (!empty($_GET)) {
            if (!isset($_GET['course']) && trim($_GET['course']) == '' &&
                !isset($_GET['month']) && trim($_GET['month']) == 0 &&
                !isset($_GET['year']) && trim($_GET['year']) == 0
            ) {
                $coursecode = '';
                $this->course_m->context['courseID'] = $courseID;
                $res = $this->course_m->getCourseList();
            } else {
                $coursecode = trim($_GET['course']);
                $this->course_m->context['coursecode'] = $coursecode;
                $this->course_m->context['month'] = $_GET['month'];
                $this->course_m->context['year'] = $_GET['year'];
                $arr = array(
                    'course' => $coursecode,
                    'month' => $_GET['month'],
                    'year' => $_GET['year']
                );
                $qry = '?' . http_build_query($arr);
                $res = $this->course_m->searchCourse();
            }
        } else {
            $coursecode = '';
            $this->course_m->context['courseID'] = $courseID;
            $res = $this->course_m->getCourseList();
        }

        $total = $this->course_m->getCountCourseList();
        $pages = util::paging($total, $limit, 'register/certificate/index/%s/' . $qry, 'Page', $page);

        $data = array();
        $data['data'] = $res;
        $data['paging'] = $pages;
        $data['cntCourse'] = $total;
        $data['course_list'] = $this->course_m->getCourseCode();

        //load template
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/course_certificate', $data);
        $this->template->render();

    }

    function get_template()
    {
//        $this->template->set_template('admin');
//        $this->template->write('title', setting::$WINDOW_TITLE);
//        $this->template->write_view('content', 'register/template_cert');
//        $this->template->render();
        // UI
//        $this->load->view('register/template_cert');

        $data = array();
        $this->load->model('register/certificate_m', 'cert_m');
        $this->cert_m->context['id'] = 1;
        $txt = $this->cert_m->getTemplate();
        $data['template_cert'] = $txt;
        //load template
        $this->template->set_template('admin');
        $this->template->add_js('js_ui/jquery-ui.js');
        $this->template->add_css('css/cert.css');
        $this->template->add_css('js_ui/jquery-ui.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/template_cert', $data);
        $this->template->render();
    }

    function get_template_nametag()
    {
        $data = array();
        $this->load->model('register/certificate_m', 'cert_m');
        $this->cert_m->context['id'] = 2;
        $txt = $this->cert_m->getTemplate();
        $data['template'] = $txt;
//        $this->load->view('register/template_nametag',$data);
        //load template
        $this->template->set_template('admin');
        $this->template->add_js('js_ui/jquery-ui.js');
        $this->template->add_css('css/namtag.css');
        $this->template->add_css('js_ui/jquery-ui.css');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/template_nametag', $data);
        $this->template->render();
    }

    function save_tp()
    {
        //$txt = $_POST['txt'];
        $txt = $this->input->post('txt', false);
        //print($txt); exit;
        $this->load->model('register/certificate_m', 'cert_m');
        $this->cert_m->context['id'] = 1;
        $this->cert_m->context['txt'] = $txt;
        $res = $this->cert_m->setTemplate();

    }

    function save_tp_nametag()
    {
        //$txt = $_POST['txt'];
        $txt = $this->input->post('txt', false);
        //print($txt); exit;
        $this->load->model('register/certificate_m', 'cert_m');
        $this->cert_m->context['id'] = 2;
        $this->cert_m->context['txt'] = $txt;
        $res = $this->cert_m->setTemplate();

    }


}