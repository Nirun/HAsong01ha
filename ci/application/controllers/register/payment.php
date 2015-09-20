<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Beau
 * Date: 11/9/12
 * Time: 11:40 PM
 * To change this template use File | Settings | File Templates.
 */

class Payment extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $pageID = 4;
        Authen::AllowPage($pageID, $this->session->userdata('role'));

        $this->load->model('register/course_m', 'course_m');

        $this->course_m->context['filter'] = $_GET;

        $data = array();

        if (!empty($_GET)) {
            if (!isset($_GET['course']) && trim($_GET['course']) == '' &&
                !isset($_GET['month']) && trim($_GET['month']) == 0 &&
                !isset($_GET['year']) && trim($_GET['year']) == 0 &&
                !isset($_GET['ref1']) && trim($_GET['ref1']) == 0 &&
                !isset($_GET['ref2']) && trim($_GET['ref2']) == 0
            ) {
                $data['data'][] = array(
                    'course' => $this->course_m->getCourse(0),
                    'reg' => $this->course_m->getPaymentList(0),
                    'optional' => $this->course_m->getCourseOptionalsList(0),
                    'cntreg' => $this->course_m->getCountCourseRegister(0, 0),
                    'cntpaid' => $this->course_m->getCountCourseRegister(0, 1)
                );
            } else {
                $CourseList = $this->course_m->getCoursePayment();
                if (!empty($CourseList)) {
                    foreach ($CourseList as $row) {
                        $data['data'][] = array(
                            'course' => $this->course_m->getCourse($row['courseID']),
                            'reg' => $this->course_m->getPaymentList($row['courseID']),
                            'optional' => $this->course_m->getCourseOptionalsList($row['courseID']),
                            'cntreg' => $this->course_m->getCountCourseRegister($row['courseID'], 0),
                            'cntpaid' => $this->course_m->getCountPaid($row['courseID'])
                        );
                    }
                } else {
                    $data['data'][] = array(
                        'course' => $this->course_m->getCourse(0),
                        'reg' => $this->course_m->getPaymentList(0),
                        'optional' => $this->course_m->getCourseOptionalsList(0),
                        'cntreg' => $this->course_m->getCountCourseRegister(0, 0),
                        'cntpaid' => $this->course_m->getCountCourseRegister(0, 1)
                    );
                }
            }
        } else {
            $data['data'][] = array(
                'course' => $this->course_m->getCourse(0),
                'reg' => $this->course_m->getPaymentList(0),
                'optional' => $this->course_m->getCourseOptionalsList(0),
                'cntreg' => $this->course_m->getCountCourseRegister(0, 0),
                'cntpaid' => $this->course_m->getCountCourseRegister(0, 1)
            );
        }

       //print_r($data['data']);
       //exit;

        $data['course_list'] = $this->course_m->getCourseCode();

        //load template
        $this->template->set_template('admin');
        $this->template->write('title', setting::$WINDOW_TITLE);
        $this->template->write_view('content', 'register/payment_index', $data);
        $this->template->render();

    }

    function PaymentReceipt()
    {
        $this->load->model('register/course_m', 'course_m');
        $type = $this->uri->segment(4);
        $tID = $this->uri->segment(5);
        $cID = $this->uri->segment(6);
        //$pID = $this->uri->segment(7);
        $refID = $this->uri->segment(7);
        $rType = $this->uri->segment(8);
        $digit = $this->uri->segment(9);
        $regID = $this->uri->segment(10);

        $res = $this->course_m->getReceiptDetails($regID,$rType,$refID);
        $recieptinfo = $this->course_m->getReceiptInfo($regID,$rType,$refID);

        if ($type == "add") {
            $replist = $this->course_m->getTraineesList($regID,$rType,$refID);
        }else{
            $replist = $this->course_m->getSeatList($regID,$rType,$refID);
        }

        $data = array();
        $data['data'] = $res;
        $data['recinfo'] = $recieptinfo;
        $data['replist'] = $replist;
        $data['regType'] = $rType;
        $data['digit'] = $digit;
        $data['courseid'] = $cID;
        $data['traineeid'] = $tID;
        $data['regID'] = $regID;

        if ($type == "add") {
            $this->load->view('register/pop_addpayment', $data);
        } else {
            $this->load->view('register/pop_payment', $data);
        }

    }

    function addreceipt()
    {
        $this->load->model('register/course_m', 'course_m');
        //echo $_POST['rID']."<br>".$_POST['cID']."<br>".$_POST['date'];

        $reglist = $_POST['rID'];
        $courseID = $_POST['cID'];
        $traineeID = $_POST['tID'];
        $paymentID = $_POST['pID'];
        $receiptdate = $_POST['date'];
        $rType = $_POST['rType'];
        $digit = $_POST['digit'];
        $regID = $_POST['regID'];

        /*-- Add receipt --*/
        $this->course_m->context['receipt_date'] = $receiptdate;
        $this->course_m->context['courseID'] = $courseID;
        $this->course_m->context['digit'] = $digit;
        $this->course_m->context['adminID'] = $this->session->userdata('ID');

        $list = explode(",", $reglist);
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i] != '') {
                $res = $this->course_m->addreceiptdetails($list[$i]);
            }
        }
        // update refid
        $this->course_m->updateIsPaid($regID);

        //echo $res;

        if ($res == 1) {
            /*-- email --*/
            $this->load->model('register/user_m', 'user_m');
            $data = $this->user_m->get_user_profile($traineeID);
            $mailFrom = 'ha.noreply@ha.co.th';
            $mailTo = $data[0]['email'];
            $subject = 'ยืนยันการชำระเงินจาก สรพ.';
            $content = $this->getPaymentConfirm($regID, $rType);
            //echo $content;
            //exit;
            util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
            $ok = 1;
        } else {
            $ok = 0;
        }
        echo $ok;
        // echo $payID."<br>".$regID."<br>".$receiptID."<br>".$traineeID."<br>".strlen($limit)."<br>".$receiptdate;
    }


    function getPaymentConfirm($regID, $rtype)
    {
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/course_m', 'course_m');
        $course = $this->course_m->getCourseConfirm($regID);
        $seatlist = $this->course_m->getSeatList($regID,$rtype);
        $data = array();
        $data = $course[0];
        $data['sum_register'] = count($seatlist);
        $registrationlist ="";
        $i = 1;
        foreach ($seatlist as $val):
            $registrationlist .= $i.". ".$val['name'] . " " . $val['lastname'] . "<strong>&nbsp;&nbsp;เลขที่นั่ง : </strong>".$val['seatno']."<br />";
            $i++;
        endforeach;
        $content = file_get_contents('template_email/receive.htm');
        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        $content = str_replace('<!--course_name-->', $data['coursename'] . '(' . $data['coursecode'] . ')', $content);
        $content = str_replace('<!--period-->', Thaidate::date($data['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($data['enddate'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--place-->', $data['place'], $content);
        $content = str_replace('<!--sum_register-->', $data['sum_register'], $content);
        $content = str_replace('<!--registrationlist-->', $registrationlist, $content);
        return $content;

    }

    function delPayment()
    {
        $regID = $this->uri->segment(4);
        $rType = $this->uri->segment(5);
        $traineeid = $this->uri->segment(6);
        $refID = $this->uri->segment(7);
        $method = $this->uri->segment(8);
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $this->course_m->updateRegisIsDelete($regID,$rType);
        $this->sendemail($regID,$rType,$refID,$traineeid,$method);
        redirect('/register/payment/');
    }

    function requeuePayment(){
        $regID = $this->uri->segment(4);
        $rType = $this->uri->segment(5);
        $traineeid = $this->uri->segment(6);
        $refID = $this->uri->segment(7);
        $method = $this->uri->segment(8);
        $this->load->model('register/course_m', 'course_m');
        $this->course_m->context['adminID'] = $this->session->userdata('ID');
        $this->course_m->updateRequeueDate($regID,$rType);
        $this->sendemail($regID,$rType,$refID,$traineeid,$method);
        // send billing
        require_once "user.php";
        $billing = new User();
        $billing->getBilling($regID);
        // end send billing
        redirect('/register/payment/');
    }

    function sendemail($regID,$rType,$refID,$tID,$method){

        $this->load->model('register/user_m', 'user_m');
        $data = $this->user_m->get_user_profile($tID);
        $mailFrom = 'ha.noreply@ha.co.th';
        $mailTo = $data[0]['email'];
        if ($method == "del"){
            $subject = 'ยกเลิกการสำรองที่นั่ง';
        }else{
            $subject = 'ได้รับยืนยันการสำรองที่นั่งแล้ว';
        }

        $content = $this->getemailcontent($regID,$refID,$rType,$method);
        //echo $content;
        //exit;
        util::sendEmail($mailFrom, array($mailTo), $subject, $content, 'html');
    }

    function getemailcontent($regID,$refID,$rType,$method){
        header('Content-type: text/html; charset=utf-8');
        $this->load->model('register/course_m', 'course_m');
        $course = $this->course_m->getCourseDetails($regID);
        $reglist = $this->course_m->getTraineesDetails($regID,$rType,$refID);
        $data = array();
        $data = $course[0];
        $data['sum_register'] = count($reglist);
        $registrationlist ="";
        $i = 1;
        foreach ($reglist as $val):
            $registrationlist .= $i.". ".$val['name'] . " " . $val['lastname']."<br />";
            $i++;
        endforeach;

        if ($method == "del"){
            $content = file_get_contents('template_email/cancel.htm');
        }else{
            $content = file_get_contents('template_email/requeue.htm');
        }

        $content = str_replace('<!--name-->', $data['name'] . ' ' . $data['lastname'], $content);
        $content = str_replace('<!--registrationdate-->', Thaidate::date($data['registerdatetime'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--duedate-->', Thaidate::date($data['duedate'] , 'DD MM YYYY'), $content);
        $content = str_replace('<!--course_name-->', $data['coursename'] . '(' . $data['coursecode'] . ')', $content);
        $content = str_replace('<!--period-->', Thaidate::date($data['startdate'], 'DD MM YYYY') . ' - ' . Thaidate::date($data['enddate'], 'DD MM YYYY'), $content);
        $content = str_replace('<!--place-->', $data['place'], $content);
        $content = str_replace('<!--sum_register-->', $data['sum_register'], $content);
        $content = str_replace('<!--registrationlist-->', $registrationlist, $content);
        return $content;
    }


}