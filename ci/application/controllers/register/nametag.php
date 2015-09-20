<?php
 class Nametag extends CI_Controller{

     function __construct()
     {
         parent::__construct();

     }

     function index()
     {

         $pageID = 5;
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

         if (!empty($_GET)){
             if (!isset($_GET['course']) && trim($_GET['course']) == '' &&
                 !isset($_GET['month']) && trim($_GET['month']) == 0 &&
                 !isset($_GET['year']) && trim($_GET['year']) == 0) {
                 $coursecode = '';
                 $this->course_m->context['courseID']= $courseID;
                 $res = $this->course_m->getCourseList();
             } else {
                 $coursecode = trim($_GET['course']);
                 $this->course_m->context['coursecode'] = $coursecode;
                 $this->course_m->context['month'] = $_GET['month'];
                 $this->course_m->context['year'] = $_GET['year'];
                 $res = $this->course_m->searchCourse();
             }
         }else{
             $coursecode = '';
             $this->course_m->context['courseID']= $courseID;
             $res = $this->course_m->getCourseList();
         }

         $total = $this->course_m->getCountCourseList();
         $pages = util::paging($total, $limit, 'register/nametag/index/%s/','Page',$page);

         $data = array();
         $data['data'] = $res;
         $data['paging'] = $pages;
         $data['cntCourse'] = $total;
         $data['course_list'] = $this->course_m->getCourseCode();

         //load template
         $this->template->set_template('admin');
         $this->template->write('title', setting::$WINDOW_TITLE);
         $this->template->write_view('content', 'register/course_nametag',$data);
         $this->template->render();

     }
 }