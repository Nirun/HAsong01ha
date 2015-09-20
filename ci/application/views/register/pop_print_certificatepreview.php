<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo setting::$WINDOW_TITLE ?></title>
    <style type="text/css">

        @font-face {
            font-family: "sarabun";
            src: url('<?php echo setting::$BASE_URL?>/font/sarabun.eot');
            src: url('<?php echo setting::$BASE_URL?>/font/sarabun.eot?iefix') format('eot'), url('<?php echo setting::$BASE_URL?>/font/sarabun.woff') format('woff'), url('<?php echo setting::$BASE_URL?>/font/sarabun.ttf') format('truetype'), url('<?php echo setting::$BASE_URL?>/font/sarabun.svg') format('svg');

        }

        #bgcertificate {
            font-family: sarabun;
            width: 755px;
            height: 566px;
            background-image: url(<?php echo setting::$BASE_URL?>/certificate.jpg);
            background-repeat: no-repeat;
            margin-left: auto;
            margin-right: auto;
            background-position: top left;
        }

        #action {
            display: none;
        }
    </style>

</head>

<body>
<?php
$total_row = count($data);
foreach ($data as $_data):

    //prefix
    if ($_data['prefix'] == 6) {
        $prefix = $_data['prefix_other'];
    } else {
        $prefix = $_data['title_th'];
    }

    //trainee name
    $trainee = $prefix . " " . $_data['name'] . " " . $_data['lastname'];

    //hospital name
    if ($_data['hospitalother'] != "") {
        $hospital = $_data['hospitalother'];
    } else {
        //$hospital = $_reglist['hospitalID'];
        $hospital = "รพ." . $_data['hospitalname'] . " " . $_data['province'];
    }

    //Course Date
    $sDate = $_data['startdate'];
    $eDate = $_data['enddate'];

    if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
        or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
    ) {
        $CourseDate = "ไม่ได้ระบุวันที่อบรม";
    } else {
        $scDate = Thaidate::date($sDate, "DD MM YYYY");
        $ecDate = Thaidate::date($eDate, "DD MM YYYY");
        $CourseDate = $scDate . ' - ' . $ecDate;
    }

    $img = ($_data['photo'] != '') ? $_data['photo'] : 'default.jpg';

    //change name
    if (!empty($_data['cpother'])) {
        $cpprefix = $_data['cpother'];
    } else {
        $cpprefix = $_data['cprefix'];
    }

    $change = 0;
    if (!empty($_data['cpname']) && !empty($_data['cplastname'])) {
        $changename = $cpprefix . " " . $_data['cpname'] . " " . $_data['cplastname'];
        $changeimg = ($_data['cpphoto'] != '') ? $_data['cpphoto'] : 'default.jpg';
        $change = 1;
    } else {
        $changename = '';
        $changeimg = '';
        $change = 0;
    }

    ?>
    <div id="bgcertificate">
        <table border="0" cellspacing="1" cellpadding="1" align="center">
            <tr valign="top">
                <td width="700" align="center">     <!--certificate-->
                    <?php
                    $name = ($change == 0) ? $trainee : $changename;
                    $course_code = $_data['coursename'];
                    $course_date = $CourseDate;
                    $_code = $_data['coursecode'];
                    $yy =  intval($_data['gen_year']) + 543;
                    $_code .= "-" . substr($yy,-2);
                    $_code .= "-" . $_data['generation'];
                    $_code .= "-" . str_pad($_data['seatNo'], 3, "0", STR_PAD_LEFT);

                    $tpCert = $template;
                    $tpCert = str_replace("#NAME-SURNAME", $name, $tpCert);
                    $tpCert = str_replace("#COURSE-NAME", $course_code, $tpCert);
                    $tpCert = str_replace("#DATE-TIME", $course_date, $tpCert);
                    $tpCert = str_replace("#COURSE-CODE", $_code, $tpCert);
                    echo($tpCert);
                    ?>

                    <!--certificate--></td>
            </tr>
        </table>


    </div>
<?php
endforeach;
?>
<p align="center"><br/>
    <input type="button" value="พิมพ์" onclick="window.print();"/>
    <button onclick="javascript:window.opener.location='<?= setting::$BASE_URL ?>/manage/cert';window.close();">BACK
    </button>
</p>

</body>
</html>
