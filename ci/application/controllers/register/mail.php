<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 8/10/2555
 * Time: 0:18 น.
 * To change this template use File | Settings | File Templates.
 */
class Mail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $pageID = 7;
        Authen::AllowPage($pageID, $this->session->userdata('role'));
        //load template
        $this->load->model('register/mail_m', 'mail_m');
        $this->load->model('register/course_m', 'course_m');
        $res = $this->mail_m->getTemplate();
        $data = array();
        $data['course_list'] = $this->course_m->getAllCourses();
        $data['template'] = $res;
        $this->template->set_template('admin');
        $this->template->add_css('js/source/jquery.fancybox.css');
        $this->template->add_js('js/lib/jquery.mousewheel-3.0.6.pack.js');
        $this->template->add_js('js/source/jquery.fancybox.pack.js');
        $this->template->add_js('js_validate/mail_index.js');

        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/mail_index', $data);
        $this->template->render();
    }

    function popup_template()
    {

        $data = array();
        $this->load->view('register/mail_popup', $data);
    }

    function preview_template()
    {
        $this->load->model('register/mail_m', 'mail_m');
        // $res = $this->mail_m->getMailList();
        $tpID = $this->input->post('template');
        $mailForm = $this->mail_m->getMailForm($tpID);
        $data = array();
        // $data['email'] = $res;
        $data['group'] = $this->input->post('group');
        $data['to'] = $this->input->post('to');
        $data['cc'] = $this->input->post('cc');
        $data['bcc'] = $this->input->post('bcc');
        $data['type'] = $this->input->post('type');
        $data['tp_id'] = $tpID;
        $data['subject'] = $this->input->post('subject');
        $data['desc'] = $this->input->post('desc');
        $txt = $this->convertToTags($mailForm[0]['tp_code']);
        //$txt = stripslashes($mailForm[0]['tp_code']);
        $data['form'] = $txt;
        $this->load->view('register/mail_preview', $data);
    }

    function save_form()
    {
        $this->load->model('register/mail_m', 'mail_m');
        $res = $this->mail_m->save_template();
        if ($res) {
            redirect('register/mail/');
            exit;
        }
    }

    function send()
    {
        $this->load->model('register/mail_m', 'mail_m');
        $arrTo = array();
        $arrCC = array();
        $arrBCC = array();
        $arrTraineeID = array();
        $type = $this->input->post('type');
        if ($type == 1):
            $arrTo = explode(';', $this->input->post('to'));
            $arrCC = explode(';', $this->input->post('cc'));
            $arrBCC = explode(';', $this->input->post('bcc')); else:
            $courseID = $this->input->post('group');
            $res = $this->mail_m->getMailList($courseID);
            foreach ($res as $val) {
                $arrTo[] = $val['email'];
                $arrTraineeID[] = $val['traineeID'];
            }
        endif;
        $tpID = $this->input->post('tp_id');
        $mailForm = $this->mail_m->getMailForm($tpID);
        $txt = $this->convertToTags($mailForm[0]['tp_code']);
        // $txt = stripslashes($mailForm[0]['tp_code']);
        $subject = $this->input->post('subject');
        $desc = $this->input->post('desc');
        $tp = str_ireplace('< !--message-- >', $desc, $txt);

// insert email to inbox
        if (count($arrTraineeID)) {
            foreach ($arrTraineeID as $keyU => $user_id) {
                $check = null;
                $check = $this->mail_m->add_inbox($user_id, $subject, $tp);
            }
        }
        $config = array();
        $config['protocol'] = 'smtp';
        //$config['smtp_host'] = 'sg2nlvphout-v01.shr.prod.sin2.secureserver.net';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'nirun.noreply@gmail.com';
        $config['smtp_pass'] = 'noreply123';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email', $config);
        $this->email->from('nirun.noreply@gmail.com', 'HA Project');
        $this->email->to($arrTo);
        $this->email->cc($arrCC);
        $this->email->bcc($arrBCC);
        $this->email->subject($subject);
        $this->email->message($tp);
        $this->email->send();
        redirect('register/mail/');
        //var_dump($_POST);
        exit;
    }

    function convertToTags($msg)
    {
        $txt = str_replace('&lt;', '<', $msg);
        $txt = str_replace('&gt;', '>', $txt);
        return $txt;
    }

    function remind()
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/mail_m', 'mail_m');
        $res = $this->mail_m->getListRemind();
        foreach ($res as $val) {
            $fullname = $val['name'] . ' ' . $val['lastname'];
            $dateregist = Thaidate::date($val['registerdatetime'], 'DD MM YYYY');
            $dateregistend = Thaidate::date(date('Y-m-d H:i:s'), 'DD MM YYYY');
            $course = $val['coursename'] . '(' . $val['coursecode'] . ')';
            $coursedate = Thaidate::date($val['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($val['enddate'], 'DD MM YYYY');
            $courseplace = $val['place'];
            if ($val['refType'] == '0') {
                $total = 1;
                $list = '';
            } else {
                $dataRepresentative = util::getRepresentiveList($val['registrationID']);
                $total = count($dataRepresentative);
                $listName = array();
                foreach ($dataRepresentative as $keyP => $valP) {
                    $listName[] = ' ' . $valP['name'] . ' ' . $valP['lastname'];
                }
                $list = implode(',', $listName);
            }
            // email
            $mailFrom = 'nirun.noreply@gmail.com';
            $mailTo = $val['email'];
            $subject = 'แจ้งเตือนการชำระเงิน';
            $content= $this->remindContent($fullname,$dateregist,$dateregistend,$course,$coursedate,$courseplace,$total,$list);
            //echo $content;
            util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
        }

        exit;
    }

    private function remindContent($fullname = '', $dateregist = '', $dateregistend = '', $course = '', $coursedate = '', $courseplace = '', $total = '', $list = '')
    {
        $content = file_get_contents('template_email/remind.htm');
        $content = str_replace('<!--fullname-->', $fullname, $content);
        $content = str_replace('<!--dateregist-->', $dateregist, $content);
        $content = str_replace('<!--dateregistend-->', $dateregistend, $content);
        $content = str_replace('<!--course-->', $course, $content);
        $content = str_replace('<!--coursedate-->', $coursedate, $content);
        $content = str_replace('<!--courseplace-->', $courseplace, $content);
        $content = str_replace('<!--total-->', $total, $content);
        $content = str_replace('<!--list-->', $list, $content);
        return $content;
    }
}
