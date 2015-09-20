$(document).ready(function () {
    $('#reserve').click(function () {
        var couseID = $(this).attr('rel');
        $.ajax({
            url: 'member/popup_reserve/',
            type: 'POST',
            cache: false,
            data: {'courseID': couseID},
            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (data) {
                $.fancybox({
                    type: 'html',
                    minWidth: 910,
                    minHeight: 600,
                    scrolling: 'yes',
                    content: data
                });
            },
            complete: function () {
                $.fancybox.hideLoading();
            }
        })
    });

    $('#payment').live('click', function () {
        var couseID = $(this).attr('rel');
        var lenObj = $('input[name^=name]').length;
        if ($('input[name="registerBy"]:checked').val() != 1) {
            var checkNull = false;
            for (var i = 0; i < lenObj; i++) {
                var _name1 = $('input[name^=name]')[i].value;
                var _lname1 = $('input[name^=lastname]')[i].value;
                if (_name1.length > 0 && _lname1.length > 0) {
                    checkNull = true;
                    break;
                }
            }
            if (checkNull != true) {
                alert('กรุณากรอกรายละเอียดผู้สมัคร');
                return false;
            }
        }

        for (var i = 0; i < lenObj; i++) {
            var _name = $('input[name^=name]')[i].value;
            var _lname = $('input[name^=lastname]')[i].value;
            var _idcard = $('input[name^=idcard]')[i].value;
            var prefix = $('select[name^=prefix] option:selected')[i].value;
            if (_name.length > 0 && _lname.length > 0) {
               /* if (_idcard.length != 13) {
                    alert('กรุณากรอกรหัสบัตรประชาชน 13 หลัก ให้ถูกต้อง!');
                    return false;
                } else*/
                if (_idcard != '' && $.isNumeric(_idcard) != true) {
                    alert('กรุณากรอกรหัสบัตรประชาชน 13 หลัก ให้ถูกต้อง!');
                    return false;
                }
                else if (prefix == 0) {
                    alert('กรุณาเลือกคำนำหน้า !');
                    return false;
                }
                else {
                    continue;
                }
            }
            /*
             if (_name.length > 0 && _lname.length > 0) {
             if (_idcard.length == 13 && $.isNumeric(_idcard)) {
             continue;
             }
             else {
             alert('กรุณากรอกรหัสบัตรประชาชน 13 หลัก ให้ถูกต้อง!');
             return false;
             }
             }
             */
        }

        $.ajax({
            url: 'member/register/exists',
            type: 'POST',
            cache: false,
            data: $('#frm_reserve').serialize(),
            dataType: 'json',
            async: false,
            success: function (data) {
                console.log(data);
                setdata(data);
            }
        })
        if (json_data.user_exists == true) {
            alert(json_data.msg);
            return false;
        }
        else {

            $('#frm_reserve').submit();
            /*$.ajax({
                url: 'member/popup_payment/' + couseID,
                type: 'POST',
                cache: false,
                data: $('#frm_reserve').serialize(),
                beforeSend: function () {
                    $.fancybox.showLoading();
                },
                success: function (data) {
                    $.fancybox({
                        type: 'html',
                        autoSize: true,
                        scrolling: 'yes',
                        //width:400,
                        //height:200,
                        content: data
                    });
                },
                complete: function () {
                    $.fancybox.hideLoading();
                }
            })*/
        }
    });
    $('.payment2').click(function () {
        var val = $(this).attr('rel');
        var val = val.split(',');
        var couseID = val[0];
        var registerID = val[1];
        $.ajax({
            url: 'member/popup_payment/' + couseID,
            type: 'POST',
            cache: false,
            data: {'registerID': registerID},
            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (data) {
                $.fancybox({
                    type: 'html',
                    autoSize: true,
                    scrolling: 'yes',
                    //width:400,
                    //height:200,
                    content: data
                });
            },
            complete: function () {
                $.fancybox.hideLoading();
            }
        })
    });

    var json_data = {};
    setdata = function (data) {
        json_data = data;
        // console.log(json_data);
    }
    $('#btn_reserve').live('click', function () {
        $.ajax({
            url: 'member/register/exists',
            type: 'POST',
            cache: false,
            data: $('#frm_reserve').serialize(),
            dataType: 'json',
            async: false,
            success: function (data) {
                setdata(data);
            }
        })

        if (json_data.user_exists == true) {
            alert(json_data.msg);
            return false;
        }
        else {
            return true;
        }
        return false;
    });
    $('input[name="registerBy"]').live('change', function () {
        if ($(this).val() == 1) {
            $('input.info_enable').val('');
            $('select.info_enable').val('1');
            $('.info_enable').attr('disabled', 'disabled');
        }
        else {
            $('.info_enable').removeAttr('disabled', 'disabled');
        }
    });
    $('.change-name').live('click', function () {
        var registrationID = $(this).attr('title');
        var seat = $(this).attr('rel');
        $.ajax({
            url: 'member/change/',
            type: 'POST',
            cache: false,
            data: {'registerID': registrationID, 'seat': seat},
            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (data) {
                $.fancybox({
                    type: 'html',
                    autoSize: true,
                    scrolling: 'yes',
                    //width:400,
                    //height:200,
                    content: data
                });
            },
            complete: function () {
                $.fancybox.hideLoading();
            }
        })
        return false;

    });
    $('input[name="submit-change"]').live('click', function () {
        $(this).attr('value', ' กำลังบันทึก ')
        $(this).attr('disabled', 'disabled')
        $.ajax({
            url: 'member/change_save/',
            type: 'POST',
            cache: false,
            data: $('#form-change').serialize(),
            beforeSend: function () {
                $.fancybox.showLoading();
            },
            success: function (data) {
                $.fancybox({
                    type: 'html',
                    autoSize: false,
                    //scrolling:'no',
                    width: 400,
                    height: 200,
                    content: data,
                    afterClose: function () {
                        parent.location.reload(true);
                    }
                });
            },
            complete: function () {
                $.fancybox.hideLoading();
            }

        })
        return false;
    });
    $('#cancel-change').live('click', function () {
        $.fancybox.close();
        return false;
    });
    $('#submit-payment').live('click', function () {
        var check = false
        var msg = '';
        var _val = '';
        $('input[name="receipt_type"]').each(function () {
            //console.log($(this).attr('checked'));
            if ($(this).attr('checked') == 'checked') {
                _val = $(this).val();
                check = true;
            }
        });
        if (check != true) {
            alert('กรุณาเลือกวิธีออกใบเสร็จ');
            return false;
        }
        else {
            if (_val == 'other') {
                var tname = $('input[name="other1_name"]').val();
                var taddress = $('input[name="other1_address"]').val();
                if (tname.trim() == '' || taddress.trim() == '') {
                    msg = 'กรุณากรอกข้อมูลให้ครบ';
                }
            }
            else if (_val == 'separate') {
                var check_add = true;
                if ($('input[name="receipt_default_add"]').attr('checked') == 'checked') {
                    var taddress2 = $('input[name^="other2_add_separate"]')[0].value;
                    if (taddress2.trim() == '') {
                        msg = 'กรุณากรอกข้อมูลให้ครบ';
                    }
                }
                else {
                    $('input[name^="other2_add_separate"]').each(function (i) {
                        if ($(this).val().trim() == '') {
                            msg = 'กรุณากรอกข้อมูลให้ครบ';
                            return false
                        }
                    });
                }
            }
            if (msg != '') {
                alert(msg);
                return false;
            }
        }
        $('#submit-payment').attr('disabled', 'disabled');
        $('#paid-saving').html('<div style="text-align: center;padding-top: 10px;color: red;">กำลังบันทึกข้อมูล...</div>');
        $('#popup-paid').submit();
        /*
        var conf = confirm('กรุณาตรวจสอบข้อมูลอีกครั้งก่อน  หลังจากกดปุ่มตกลง \n โปรดรอให้หน้าต่างด้านล่างปิดเองโดยอัตโนมัติ ');
        if (conf) {
            $('#submit-payment').attr('disabled', 'disabled');
            $('#paid-saving').html('<div style="text-align: center;padding-top: 10px;color: red;">กำลังบันทึกข้อมูล...</div>');
            $('#popup-paid').submit();
            return true;
        }
        else {
            return false;
        }
        */
    });
    $('input[name="receipt_type"]').live('change', function () {
        var _type = $(this).val();
        //alert(_type);
        switch (_type) {
            case 'self':
                $('input[name^="other1"]').attr('disabled', 'disabled');
                $('select[name^="other1"]').attr('disabled', 'disabled');
                //$('textarea[name="other_address"]').attr('disabled', 'disabled');
                //$('input[name^="other_add_separate"]').attr('disabled', 'disabled');
                $('input[name^="receipt_default_add"]').attr('disabled', 'disabled');
                $('input[name^="other2"]').attr('disabled', 'disabled');
                $('select[name^="other2"]').attr('disabled', 'disabled');
                $('input[name^="separate_name"]').attr('disabled', 'disabled');
                break;
            case 'other':
                $('input[name^="other1"]').removeAttr('disabled');
                $('select[name^="other1"]').removeAttr('disabled');
                //$('textarea[name="other_address"]').removeAttr('disabled');
                //$('input[name^="other_add_separate"]').attr('disabled', 'disabled');
                $('input[name^="receipt_default_add"]').attr('disabled', 'disabled');
                $('input[name^="other2"]').attr('disabled', 'disabled');
                $('select[name^="other2"]').attr('disabled', 'disabled');
                $('input[name^="separate_name"]').attr('disabled', 'disabled');
                break;
            case 'separate':
                $('input[name^="other1"]').attr('disabled', 'disabled');
                $('select[name^="other1"]').attr('disabled', 'disabled');
                //$('textarea[name="other_address"]').attr('disabled', 'disabled');
                //$('input[name^="other_add_separate"]').removeAttr('disabled');
                $('input[name^="receipt_default_add"]').removeAttr('disabled');
                $('input[name^="other2"]').removeAttr('disabled');
                $('select[name^="other2"]').removeAttr('disabled');
                $('input[name^="separate_name"]').removeAttr('disabled');
                break;
        }

    })
    $("#payment-btn-preview").live("click", function () {
        var radio = $('input[name="receipt_type"]:checked')
        var _type = radio.val();
        //console.log(_type);
        var data = '';
        switch (_type) {
            case 'self':
                data = radio.closest("td").next("td").html();
                break;
            case 'other':
                data = '<br>ชื่อ หรือ สถานที่ <br>';
                $.each($('input[name^="other1"],select[name^="other1"]'), function (i) {
                    data += $(this).val();
                    if(i==0){
                        data += '<br><br> ใบกำกับภาษี <br>';
                    }
                    else if (i == 1) {
                        data += '<br><br> ที่อยู่ <br><br>';
                    }
                    else {
                        data += ' ';
                    }
                });
                break;
            case 'separate':
                var r = 0;
                var total = $('input[name^="separate_name"]').length;
                var fname = {};
                var tax = {};
                var add = {};
                $.each($('input[name^="separate_name"]'), function (i) {
                    var txt = '';
                    fname[i] = $(this).val();
                    tax[i] = $('input[name^="other2_taxID_separate"]')[i].value;
                    txt += $('input[name^="other2_add"]')[i].value;
                    txt += ' ' + $('input[name^="other2_soi"]')[i].value;
                    txt += ' ' + $('input[name^="other2_road"]')[i].value;
                    txt += ' ' + $('input[name^="other2_district"]')[i].value;
                    txt += ' ' + $('select[name^="other2_province"]')[i].value;
                    txt += ' ' + $('input[name^="other2_postcode"]')[i].value;
                    add[i] = txt;
                });
                for (r = 0; r < total; r++) {
                    data += '<br>ชื่อ <br>';
                    data += fname[r];
                    data += '<br><br>ใบกำกับภาษี <br>';
                    data += tax[r];
                    data += '<br><br> ที่อยู่ <br><br>';
                    if ($('input[name^="receipt_default_add"]').prop("checked") == true && r != 0) {
                        data += add[0];
                    }
                    else {
                        data += add[r];
                    }
                    data += '<hr>';
                }
                break;
        }
        $("#dialog").html(data);
        $("#dialog").dialog({
            modal: true,
            stack: false,
            zIndex: 9999
        });
        $('.ui-widget-overlay').css('z-index', 9998);
        $('.ui-dialog').css('z-index', 9999);
    });

});