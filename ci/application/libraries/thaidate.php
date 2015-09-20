<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Beau
 * Date: 11/10/12
 * Time: 12:06 PM
 * To change this template use File | Settings | File Templates.
 */

class Thaidate
{

    static function date($input, $output, $digit_only = false)
    {

        $month_idx = array(
            0 => "0",
            1 => "ม.ค.",
            2 => "ก.พ.",
            3 => "มี.ค.",
            4 => "เม.ย.",
            5 => "พ.ค.",
            6 => "มิ.ย.",
            7 => "ก.ค.",
            8 => "ส.ค.",
            9 => "ก.ย.",
            10 => "ต.ค.",
            11 => "พ.ย.",
            12 => "ธ.ค.");
        if ($input == "0000-00-00 00:00" or $input == "0000-00-00" or $input == "")
            return "";
        $input = str_replace("/", "-", $input);
        list($ary_date, $ary_time) = explode(' ', $input);
        list($year, $month, $day) = explode('-', $ary_date);
        @list($hour, $min, $sec) = explode(':', $ary_time);
        $year = $year + 543;
        $ary_tmp = array();

        $ary_tmp['YYYY'] = $year;
        $ary_tmp['YY'] = substr($year, 2, 2);
        $ary_tmp['MM'] = ($digit_only) ? $month : $month_idx[intval($month)];
        $ary_tmp['DD'] = $day;
        $ary_tmp['HR'] = $hour;
        $ary_tmp['MN'] = $min;
        $ary_tmp['SC'] = $sec;
        return str_replace(array_keys($ary_tmp), array_values($ary_tmp), $output);
    }

    static function thaiMonth($m = 0)
    {
        if ($m == 0) {
            $m = date('n');
        }
        $thaiMonth = array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thaiMonth[$m];
    }
}

?>