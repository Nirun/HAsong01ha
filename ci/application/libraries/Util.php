<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 25/9/2555
 * Time: 0:25 น.
 * To change this template use File | Settings | File Templates.
 */
class util
{
    var $CI;
    static $_CI;
    private static $salt = 'hACrypt';

    function util()
    {
        $this->CI =& get_instance();
        self::$_CI = $this->CI;
    }

    public function genBarcode($txt = '', $devMode = false)
    {
        $txt = ($devMode) ? 'Test Generate Barcode' : $txt;
        $this->CI->load->library('zend');
        $this->CI->zend->load('Zend/Barcode');
        $barcodeOption = array('text' => $txt,
            'barHeight' => 30,
            'font' => 2,

        );
        $renderOption = array('');
        $render = Zend_Barcode::render('code128', 'image', $barcodeOption, $renderOption);
        return $render;
        //exit;
    }

    public static function paging($total = 0, $limit = 10, $url, $prefix = 'Page', $cPage = 0, $showRang = false)
    {
        $str = array();
        $opt = '<select id="paging" onchange="location=this.value">';
        $row = ceil($total / $limit);

        for ($i = 1; $i <= $row; $i++) {

            if ($i == $cPage) {
                $str[] .= $i;
            } else {
                if (($cPage - 3 <= $i) && ($i <= $cPage + 3)) {
                    $txt_url = '<a href="' . $url . '">' . $i . '</a>';
                    $txt_url = str_ireplace('%s', $i, $txt_url);
                    // $txt_url .= ($qrystring != null) ? $qrystring : '';
                    $str[] .= $txt_url;
                }
            }
            $opt .= '<option value="' . str_ireplace('%s', $i, $url) . '">' . $i . '</option>';

        }
        $opt .= '</select>';
        $ret = '<strong>' . $prefix . '</strong> : ' . implode('  |  ', $str);
        $ret .= '&nbsp;&nbsp;&nbsp;&nbsp;' . $opt;
        return $ret;

    }

    public static function listMonth($TH = true)
    {
        if ($TH) {
            $arr = array(
                "01" => "มกราคม",
                "02" => "กุมภาพันธ์",
                "03" => "มีนาคม",
                "04" => "เมษายน",
                "05" => "พฤษภาคม",
                "06" => "มิถุนายน",
                "07" => "กรกฎาคม",
                "08" => "สิงหาคม",
                "09" => "กันยายน",
                "10" => "ตุลาคม",
                "11" => "พฤศจิกายน",
                "12" => "ธันวาคม"
            );
        } else {
            $arr = array(
                "01" => "January",
                "02" => "February",
                "03" => "March",
                "04" => "April",
                "05" => "May",
                "06" => "June",
                "07" => "July",
                "08" => "August",
                "09" => "September",
                "10" => "October",
                "11" => "Novemeber",
                "12" => "December"
            );
        }
        return $arr;
    }

    public static function getCountUnreadMail()
    {
        $id = self::$_CI->session->userdata('traineeID');
        self::$_CI->load->model('register/mail_m', 'mail_m');
        return self::$_CI->mail_m->getCountUnread($id);

    }

    public static function getRepresentiveList($regisID = 0)
    {
        self::$_CI->load->model('register/user_m', 'user_m');
        return self::$_CI->user_m->getRepresentive($regisID);
    }

    public static function sendEmail($from = '', $to = array(), $subject = '', $content = '', $mailType = 'text')
    {
        $from = (trim($from) != '') ? $from : 'nirun.noreply@gmail.com';
        $subject = (trim($subject) != '') ? $subject : 'HA Project';
        //$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        $ret = false;
        /*
         $config = array();
         $config['protocol'] = 'smtp';
         $config['smtp_host'] = 'ssl://smtp.googlemail.com';
         $config['smtp_port'] = 465;
         $config['smtp_user'] = 'nirun.noreply@gmail.com';
         $config['smtp_pass'] = 'noreply123';
         $config['mailtype'] = $mailType;
         $config['charset'] = 'utf-8';
         $config['crlf'] = "\r\n";
         $config['newline'] = "\r\n";
         $config['wordwrap'] = TRUE;
         */
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nirun.noreply@gmail.com',
            'smtp_pass' => 'noreply123',
            'mailtype' => $mailType,
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        self::$_CI->load->library('email', $config);
        self::$_CI->email->set_newline("\r\n");
        self::$_CI->email->from($from, 'HA Project');
        self::$_CI->email->to($to);
        self::$_CI->email->subject($subject);
        self::$_CI->email->message($content);
        $ret = self::$_CI->email->send();
        return $ret;
    }

    public static function num2thai($number)
    {
        $t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
        $zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
        (string)$number;
        $number = explode(".", $number);
        if (!empty($number[1])) {
            if (strlen($number[1]) == 1) {
                $number[1] .= "0";
            } else if (strlen($number[1]) > 2) {
                if ($number[1]{2} < 5) {
                    $number[1] = substr($number[1], 0, 2);
                } else {
                    $number[1] = $number[1]{0} . ($number[1]{1} + 1);
                }
            }
        }

        for ($i = 0; $i < count($number); $i++) {
            $countnum[$i] = strlen($number[$i]);
            if ($countnum[$i] <= 7) {
                $var[$i][] = $number[$i];
            } else {
                $loopround = ceil($countnum[$i] / 6);
                for ($j = 1; $j <= $loopround; $j++) {
                    if ($j == 1) {
                        $slen = 0;
                        $elen = $countnum[$i] - (($loopround - 1) * 6);
                    } else {
                        $slen = $countnum[$i] - ((($loopround + 1) - $j) * 6);
                        $elen = 6;
                    }
                    $var[$i][] = substr($number[$i], $slen, $elen);
                }
            }

            $nstring[$i] = "";
            for ($k = 0; $k < count($var[$i]); $k++) {
                if ($k > 0) $nstring[$i] .= $t2[7];
                $val = $var[$i][$k];
                $tnstring = "";
                $countval = strlen($val);
                for ($l = 7; $l >= 2; $l--) {
                    if ($countval >= $l) {
                        $v = substr($val, -$l, 1);
                        if ($v > 0) {
                            if ($l == 2 && $v == 1) {
                                $tnstring .= $t2[($l)];
                            } elseif ($l == 2 && $v == 2) {
                                $tnstring .= $t2[1] . $t2[($l)];
                            } else {
                                $tnstring .= $t1[$v] . $t2[($l)];
                            }
                        }
                    }
                }
                if ($countval >= 1) {
                    $v = substr($val, -1, 1);
                    if ($v > 0) {
                        if ($v == 1 && $countval > 1 && substr($val, -2, 1) > 0) {
                            $tnstring .= $t2[0];
                        } else {
                            $tnstring .= $t1[$v];
                        }

                    }
                }

                $nstring[$i] .= $tnstring;
            }

        }
        $rstring = "";
        if (!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])) {
            if ($nstring[0] == "") $nstring[0] = $t1[0];
            $rstring .= $nstring[0] . "บาท";
        }
        if (count($number) == 1 || empty($nstring[1])) {
            $rstring .= "ถ้วน";
        } else {
            $rstring .= $nstring[1] . "สตางค์";
        }
        return $rstring;
    }

    public static function haEncrypt($txt)
    {
        $msg = self::$salt . $txt;
        return base64_encode($msg);
    }

    public static function haDecrypt($txt)
    {
        $msg = base64_decode($txt);
        $msg = str_replace(self::$salt, '', $msg);
        return $msg;
    }

    public static function getSeat($regestrationID = 0)
    {
        self::$_CI->load->model('register/user_m', 'user_m');
        return self::$_CI->user_m->getSeatByRegistrationID($regestrationID);
    }

    // Debug //
    /*
     * var type var_dump|print_r
     * defualt var_dump = dump ,print_r = print
     */
    public static function debug_post($type = 'dump')
    {
        if ($type == 'dump') {
            var_dump($_POST);
        } else {
            print_r($_POST);
        }
        exit;
    }

    public static function getPrefixById($id = 1)
    {
        self::$_CI->load->model('register/user_m', 'user_m');
        $data = self::$_CI->user_m->getPrefixName();
        $index = $id - 1;
        return $data[$index]['title_th'];
    }

    public static function getReceiptByRegisID($RegID = 0)
    {
        self::$_CI->load->model('register/user_m', 'user_m');
        return self::$_CI->user_m->getRegisterInfo($RegID);
    }
    public static function prefixAddr($val,$pref)
    {
        $txt = "";
        $arr = array(
            'soi' => "ซ. ",
            'rd' => "ถ. ",
            'district' => "เขต ",
            'sub' => "แขวง ",
            'province' => "จ. "

        );
        if (trim($val) != '') {
            $txt = $arr[$pref] . $val;
        }
        return $txt;
    }
}
