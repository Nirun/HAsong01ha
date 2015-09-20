<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 7/2/2556
 * Time: 2:35 น.
 * To change this template use File | Settings | File Templates.
 */
class Reports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $pageID = 8;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        //load template
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/report_index');
        $this->template->render();

    }

    function paid()
    {
        $pageID = 8;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $courseID = $this->input->post('courseid');
        $typeID = $this->input->post('typeid');

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/report_m', 'report_m');

        $courselist = $this->report_m->getActiveCourses();
        $data['course_list'] = $courselist;

        if ($courseID !== false) {
            $this->report_m->context['courseID'] = $courseID;
            $this->report_m->context['typeID'] = $typeID;
            $course = $this->course_m->getCourseName($courseID);
            $res = $this->report_m->paid();
            $data['data'] = $res;
            $data['coursename'] = $course;
            $data['courseID'] = $courseID;
            $data['typeID'] = $typeID;

            //   var_dump($data['course_list']); exit;
        } else {
            $data['data'] = false;
        }
        $this->load->view('register/report_paid', $data);
    }

    function receipt()
    {
        $pageID = 8;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $courseID = $this->input->post('courseid');
        $typeID = $this->input->post('typeid');

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/report_m', 'report_m');

        $courselist = $this->report_m->getActiveCourses();
        $data['course_list'] = $courselist;

        if ($courseID !== false) {
            $this->report_m->context['courseID'] = $courseID;
            $this->report_m->context['typeID'] = $typeID;
            $course = $this->course_m->getCourseName($courseID);
            $res = $this->report_m->receipt();
            $data['data'] = $res;
            $data['coursename'] = $course;
            $data['courseID'] = $courseID;
            $data['typeID'] = $typeID;
        } else {
            $data['data'] = false;
        }

        $this->load->view('register/report_receipt', $data);

    }

    function register()
    {
        $pageID = 8;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $courseID = $this->input->post('courseid');

        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/report_m', 'report_m');

        $courselist = $this->report_m->getActiveCourses();
        $data['course_list'] = $courselist;

        if ($courseID !== false) {
            $this->report_m->context['courseID'] = $courseID;
            $course = $this->course_m->getCourseName($courseID);
            $res = $this->report_m->register();
            $data['data'] = $res;
            $data['coursename'] = $course;
            $data['courseID'] = $courseID;
        } else {
            $data['data'] = false;
        }

        $this->load->view('register/report_register', $data);

    }


    function preview()
    {
        $this->load->model('register/course_m', 'course_m');
        $this->load->model('register/report_m', 'report_m');

        $report = $this->uri->segment(4);
        $cID = $this->uri->segment(5);
        $type = $this->uri->segment(6);

        $this->report_m->context['courseID'] = $cID;
        $this->report_m->context['typeID'] = $type;
        $course = $this->course_m->getCourseName($cID);

        if ($report == "paid") {
            $res = $this->report_m->paid();
        } else if ($report == "receipt") {
            $res = $this->report_m->receipt();
        } else if ($report == "register") {
            $res = $this->report_m->register();
        }

        $data['data'] = $res;
        $data['coursename'] = $course;
        $data['courseID'] = $cID;
        $data['typeID'] = $type;

        if ($report == "paid") {
            $this->load->view('register/pop_print_paid', $data);
        } else if ($report == "receipt") {
            $this->load->view('register/pop_print_receipt', $data);
        } else if ($report == "register") {
            $this->load->view('register/pop_print_register', $data);
        }


    }

    function filter()
    {
        switch ($this->uri->segment(3)) {
            case "course":
                $filter = $this->uri->segment(4);
                if ($filter == 'year') {
                    $year = $this->input->post("year");
                    $year = (int)$year - 543;
                    $this->load->model('register/report_m', 'report_m');
                    $this->report_m->context["year"] = $year;
                    $courselist = $this->report_m->getActiveCourses();
                    $arrVal = array();
                    foreach ($courselist as $k => $v) {
                        $arrVal[] = array(
                            'val' => $v["courseID"],
                            'text' => $v['coursecode'] . " " . $v['coursename'] . " รุ่นที่ " . $v['generation']
                        );
                    }
                    echo json_encode($arrVal);
                }
                break;
        }

        exit;
    }


}
