<?php

class Course extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'), '/register');

        $this->load->model('register/course_m', 'course_m');

        //paging
        $limit = setting::$limit;
        $page = (!$this->uri->segment(4)) ? 1 : $this->uri->segment(4);
        $offset = (int)(($page * $limit) - $limit);
        $courseID = 0;

        $this->course_m->context['limit'] = $limit;
        // $this->course_m->context['page'] = $page;
        $this->course_m->context['page'] = $offset;

        $this->course_m->context['filter'] = $_GET;
        $qry = "";
        if (!empty($_GET)) {
            if (//!isset($_GET['course']) && trim($_GET['course']) == '' &&
                isset($_GET['course']) && trim($_GET['course']) == '' &&
                isset($_GET['month']) && trim($_GET['month']) == 0 &&
                isset($_GET['year']) && trim($_GET['year']) == 0 &&
                isset($_GET['status']) && trim($_GET['status']) == 0
            ) {
                $coursecode = '';
                $this->course_m->context['courseID'] = $courseID;
                $res = $this->course_m->getCourseList(true);
            } else {
                //$coursecode = trim($_GET['course']);
                //$this->course_m->context['coursecode'] = $coursecode;

                $this->course_m->context['course'] = $_GET['course'];
                $this->course_m->context['month'] = $_GET['month'];
                $this->course_m->context['year'] = $_GET['year'];
                $this->course_m->context['status'] = $_GET['status'];
                $res = $this->course_m->searchCourse();
                $arrQry = array(
                    'course' => $_GET['course'],
                    'month' => $_GET['month'],
                    'year' => $_GET['year'],
                    'status' => $_GET['status'],
                );
                $qry = "?";
                $qry .= http_build_query($arrQry);
            }
        } else {
            $coursecode = '';
            $this->course_m->context['courseID'] = $courseID;
            $res = $this->course_m->getCourseList(true);
        }
        $total = $this->course_m->getCountCourseList(true);
        $pages = util::paging($total, $limit, 'register/course/index/%s/' . $qry, 'Page', $page);
        //var_dump($total);
        $data = array();
        $data['data'] = $res;
        $data['paging'] = $pages;
        $data['cntCourse'] = $total;
        $data['course_list'] = $this->course_m->getCourseCode();

        //load template
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/course_index', $data);
        $this->template->render();

    }

    function form()
    {
        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/user_m', 'user_m');

        //load optionals
        $data = array();
        $data['optional'] = $this->course_m->getOptionals();

        //coursetype
        $type = $this->course_m->getCourseType();
        $data['course_type'] = $type;

        //courselist
        $res = $this->course_m->getAllCourses();
        $data['data'] = $res;

        //load template
        $this->template->set_template('admin');
        //position
        $position = $this->user_m->getOccupation();
        $data['position'] = $position;

//var_dump($data['position']); exit;


        //popup
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_css('css/uploadfile.css');
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/lib/jquery.uploadfile.min.js');
        $this->template->add_js('js/init_upload.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');
        $this->template->add_js('js_validate/courses.js');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/course_form', $data);
        $this->template->render();

    }

    function save()
    {


        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $map = '';
        $id = 0;

        $this->load->model('register/course_m', 'course_m');

        //map
        $map = $this->course_m->uploadmap();
        $this->course_m->context['picture'] = $map;
        $this->course_m->context['adminID'] = $this->session->userdata('ID');

        //group condition

        $post = $this->input->post();
        $cond_total = intval($post['cond_total']);
        $cond_hosp = (trim($post['cond_hospital']) != '') ? trim($post['cond_hospital']) : null;
        $cond_pos = (!isset($post['cond_position'])) ? null : $post['cond_position'];
        if (trim($post['cond_course']) != '') {
            $cond_course = explode(",", $post['cond_course']);

            if (trim($cond_course[count($cond_course) - 1]) == '') {
                unset($cond_course[count($cond_course) - 1]);
            }
        } else {
            $cond_course = null;
        }

        $arrCon = array();
        $arrCon['hospital'] = json_decode($cond_hosp, true);
        $arrCon['position'] = $cond_pos;
        $arrCon['course'] = $cond_course;
        $arrCon['max_register'] = $cond_total;
        $arrEsp = array();
        $arrEsp['group_course_cond'] = $arrCon;
        $json_cond = json_encode($arrEsp);

        $this->course_m->context['group_condition'] = $json_cond;

        //add course
        $id = $this->course_m->addCourse();

        //docs
        $this->course_m->uploaddocs($id);

        if ($id != 0) {
            redirect('/register/course/', 'refresh');
            exit;
        } else {
            echo 'error insert ';
            exit;
        }

    }

    function edit()
    {
        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/user_m', 'user_m');

        if (!$this->uri->segment(4)) {
            redirect('/register/course/', 'refresh');
            exit;
        }

        $id = $this->uri->segment(4);
        $res = $this->course_m->getCourse($id);
        $opt = $this->course_m->getCourseOptionals($id);
        $docs = $this->course_m->getDocsList($id);
        $precourse = $this->course_m->getPrecourse($id);
        $course = $this->course_m->getAllCourses();
        $type = $this->course_m->getCourseType();


        $precoursenamelist = '';
        if (!empty($precourse)) {
            foreach ($precourse as $val):
                $precoursenamelist .= $this->course_m->getCourseName($val['precourseID']) . "<br>";
            endforeach;
        }

        if (count($res) !== 1) {
            redirect('/register/course/', 'refresh');
            exit;
        }

        $data = array();
        $data['data'] = $res[0];
        $data['optional'] = $this->course_m->getOptionals();
        $data['courseoptional'] = $opt;
        $data['docslist'] = $docs;
        $data['courselist'] = $course;
        $data['precourselist'] = $precourse;
        $data['precoursenamelist'] = $precoursenamelist;
        $data['course_type'] = $type;
        //group course
        //position

        $arr_group_cond = json_decode($res[0]['group_condition'], true);
//        var_dump($arr_group_cond['group_course_cond']);
        $data['current_position'] = $arr_group_cond['group_course_cond']['position'];
        $data['max_register'] = $arr_group_cond['group_course_cond']['max_register'];
        $data['raw_group_course'] = $arr_group_cond['group_course_cond']['course'];
        $data['group_course'] = (is_array($arr_group_cond['group_course_cond']['course'])) ? implode(",", $arr_group_cond['group_course_cond']['course']) : '';
        $data['group_hospital'] = json_encode($arr_group_cond['group_course_cond']['hospital']);
        $position = $this->user_m->getOccupation();
        $data['position'] = $position;


        //load template
        $this->template->set_template('admin');

        //popup
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_css('css/uploadfile.css');
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/lib/jquery.uploadfile.min.js');
        $this->template->add_js('js/init_upload.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');
        $this->template->add_js('js_validate/courses.js');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/course_edit', $data);
        $this->template->render();

    }

    function save_edit()
    {
        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $map = '';
        $ok = true;
        $this->load->model('register/course_m', 'course_m');

        //map
        $map = $this->course_m->uploadmap();
        $this->course_m->context['picture'] = $map;
        $this->course_m->context['adminID'] = $this->session->userdata('ID');

        //docs
        $cID = $this->input->post('courseID');
        $this->course_m->uploaddocs($cID);

        //group condition

        $post = $this->input->post();
        $cond_total = intval($post['cond_total']);
        $cond_hosp = $post['cond_hospital'];
        $cond_pos = (!isset($post['cond_position'])) ? null : $post['cond_position'];
        if (trim($post['cond_course']) != '') {
            $cond_course = explode(",", $post['cond_course']);

            if (trim($cond_course[count($cond_course) - 1]) == '') {
                unset($cond_course[count($cond_course) - 1]);
            }
        } else {
            $cond_course = null;
        }

        $arrCon = array();
        $arrCon['hospital'] = json_decode($cond_hosp, true);
        $arrCon['position'] = $cond_pos;
        $arrCon['course'] = $cond_course;
        $arrCon['max_register'] = $cond_total;
        $arrEsp = array();
        $arrEsp['group_course_cond'] = $arrCon;
        $json_cond = json_encode($arrEsp);


        $this->course_m->context['group_condition'] = $json_cond;

        //edit
        $ok = $this->course_m->editCourse();

        if ($ok) {
            redirect('/register/course/', 'refresh');
        } else {
            echo 'error update';
            exit;
        }
    }

    function status()
    {
        $cid = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $this->course_m->context['IsActive'] = $status;
        $this->course_m->updatestatus($cid);
        redirect('/register/course/', 'refresh');
    }

    function saveprecourse()
    {
        $this->load->model('register/course_m', 'course_m');
        $precourse = '';
        $data = array();
        $prelist = $_POST['list'];
        $courselist = explode(",", $prelist);
        for ($i = 0; $i < count($courselist); $i++) {
            //echo  $courselist[$i] ."<br />";
            $course = $this->course_m->getCourseName($courselist[$i]);
            echo $course . "<br>";
        }
        exit;
    }

    function del()
    {
        if (!$this->uri->segment(4)) {
            redirect('/register/course/', 'refresh');
            exit;
        }

        $id = $this->uri->segment(4);
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $this->course_m->delcourse($id);
        redirect('/register/course/');
    }

    function deldocs()
    {
        if (!$this->uri->segment(5)) {
            redirect('/register/course/', 'refresh');
            exit;
        }

        $id = $this->uri->segment(5);
        $cid = $this->uri->segment(4);
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $this->course_m->deldocs($id);
        redirect('register/course/edit/' . $cid);
    }

    function applylist()
    {
        //authen
        $pageID = 2;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/certificate_m', 'cert_m');
        $type = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $cid = array(
            'courseID' => $id
        );

        $res = $this->course_m->getCourse($id);
        $opt = $this->course_m->getCourseOptionalsList($id);
        $cntpaid = $this->course_m->getCountPaid($id);
        $change = $this->course_m->getChangeTraineeHistory($id);
        $reg = $this->course_m->getRegistrationList($id);

        $data = array();
        $data['data'] = $res[0];
        $data['optionallist'] = $opt;
        $data['countPaid'] = $cntpaid;
        $data['changelist'] = $change;
        $data['reglist'] = $reg;
        $data['course'] = $cid;
        $data['courseID'] = $id;

        if ($type == 'edit') {

            $this->template->set_template('admin');
            $this->template->add_js('register/js/switchcontent.js');
            $this->template->add_js('register/js/course_apply.js');
            $this->template->write('title', setting::$WINDOW_TITLE);
            $this->template->write_view('content', 'register/pop_viewapply', $data);
            $this->template->render();
            //$this->load->view('register/pop_viewapply', $data);
        } else if ($type == 'show') {
            $this->template->set_template('admin');
            $this->template->write('title', setting::$WINDOW_TITLE);
            $this->template->write_view('content', 'register/pop_print_name', $data);
            $this->template->render();
//           $this->load->view('register/pop_print_name', $data);
        } else if ($type == 'tag') {
            $this->cert_m->context['id'] = 2;
            $templateCert = $this->cert_m->getTemplateName();
            $data['template_cert'] = $templateCert;
            $this->template->set_template('admin');
            $this->template->write('title', setting::$WINDOW_TITLE);
            $this->template->write_view('content', 'register/pop_print_tag', $data);
            $this->template->render();
//            $this->load->view('register/pop_print_tag', $data);
        } else if ($type == 'certificate') {
            $this->cert_m->context['id'] = 1;
            $templateCert = $this->cert_m->getTemplateName();
            $data['template_cert'] = $templateCert;
            $this->template->set_template('admin');
            $this->template->write('title', setting::$WINDOW_TITLE);
            $this->template->write_view('content', 'register/pop_print_certificate', $data);
            $this->template->render();
            //$this->load->view('register/pop_print_certificate', $data);
        } else if ($type == 'namelist') {
            $this->load->view('register/pop_print_namelist', $data);
        } else if ($type == 'certificatelist') {
            $this->load->view('register/pop_print_cerlist', $data);
        } else if ($type == 'taglist') {
            $this->load->view('register/pop_print_taglist', $data);
        }

    }

    function changetrainee()
    {
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['fname'] = $_POST['fname'];
        $this->course_m->context['lname'] = $_POST['lname'];
        $this->course_m->context['cID'] = $_POST['cID'];
        $this->course_m->context['tID'] = $_POST['tID'];
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $traineeID = $this->course_m->checkTrainee();

        if ($traineeID != 0) {
            $this->course_m->context['traineeID'] = $traineeID;
            $changeID = $this->course_m->addchangetrainee();

        } else {
            $changeID = 0;
        }

        echo $changeID;
        exit;
    }

    function traineedetails()
    {
        $id = $this->uri->segment(4);

        $cid = array(
            'courseID' => $this->uri->segment(5)
        );

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/user_m', 'user_m');

        $res = $this->course_m->getTraineeDetails($id);
        $list_course = $this->course_m->getCourseByTrainee($id);
        //var_dump ($res);
        //exit();

        $data = array();
        $data['data'] = $res[0];
        $data['course'] = $cid;
        $data['list_course'] = $list_course;

        $this->load->view('register/pop_viewname', $data);
    }

    function preview()
    {
        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/certificate_m', 'cert_m');
        $type = $this->uri->segment(4);
        $cID = $this->uri->segment(5);
        $rlist = $this->uri->segment(6);
        $checkall = $this->uri->segment(7);
        $rid = str_replace("%20", ",", $rlist);

        $this->course_m->context['cID'] = $cID;
        $this->course_m->context['rID'] = $rid;
        $this->course_m->context['checkall'] = $checkall;
        $res = $this->course_m->previewtags();
        $data = array();
        $data['data'] = $res;
//var_dump($res);
//exit;
        if ($type == 'tag') {
            $this->cert_m->context['id'] = 2;
            $txt = $this->cert_m->getTemplate();
            $data['template'] = $txt;
            $this->load->view('register/pop_print_tagpreview', $data);
        } else {
            $this->cert_m->context['id'] = 1;
            $txt = $this->cert_m->getTemplate();
            $data['template'] = $txt;
            $this->load->view('register/pop_print_certificatepreview', $data);
        }

    }

    function valid_course()
    {
        $arrayToJs = array();
        $this->load->model('register/course_m', 'course_m');
        //echo $this->user_m->valid_m();
        if ($this->course_m->valid_course()) {
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

    function upload_hostpital_course()
    {
        $config['upload_path'] = setting::$PATH_PDF;
        $config['allowed_types'] = 'csv';
        $config['file_name'] = 'hospital_list';
        $config['max_size'] = '5120';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('mycsv')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $fn = $data['upload_data']['full_path'];
            $csv = array_map('str_getcsv', file($fn));
            unset($csv[0]);
//            header('Content-Type: application/json');
            $json = json_encode($csv);
            echo $json;
            exit;


        }

    }


}