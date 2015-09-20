jQuery(document).ready(function () {
    jQuery('#form_signup').validationEngine('attach', {
        'custom_error_messages':{
            '.prefix':{
                'required':{
                    'message':"กรุณาเลือกคำนำหน้าชื่อ"
                }
            },
            '#name':{
                'required':{
                    'message':"invalid name"
                }
            },
            '#lastname':{
                'required':{
                    'message':"invalid lastname"
                }
            },
            '#idcard':{
                'required':{
                    'message':"invalid id card"
                }
            },
            '#user':{
                'required':{
                    'message':"invalid id user"
                },
                'custom':{
                    'message':"ห้ามมีช่องว่าง"
                },
                'minSize':{
                    'message':"อย่างน้อย  6 ตัวอักษร"
                }
            },
            '#password':{
                'required':{
                    'message':"invalid id password"
                },
                'custom':{
                    'message':"ห้ามมีช่องว่าง"
                },
                'minSize':{
                    'message':"อย่างน้อย  6 ตัวอักษร"
                }
            },
            '#cpassword':{
                'required':{
                    'message':"invalid id confirm password"
                },
                'equals':{
                    'message':"ไม่เหมือนกับ password"
                }
            },
            '#email':{
                'required':{
                    'message':"invalid email"
                },
                'custom[email]':{
                    'message':"email type"
                }
            },
            '.register_type':{
                'required':{
                    'message':"กรุณาเลือกการสมัคร"
                }
            },
            '#coname':{
                'required':{
                    'message':"invalid co-name"
                }
            },
            '#comobile':{
                'required':{
                    'message':"invalid co-mobile"
                },
                'custom[number]':{
                    'message':"Number only"
                },
                'minSize':{
                    'message':"Number is not format"
                }
            },
            '#coemail':{
                'required':{
                    'message':"invalid co-email"
                },
                'custom[email]':{
                    'message':"email type"
                }
            },
            '.occupation':{
                'required':{
                    'message':"กรุณาเลือกอาชีพ"
                }
            },
            '.position':{
                'required':{
                    'message':"กรุณาเลือกตำแหน่ง"
                }
            },
            '.placetype':{
                'required':{
                    'message':"กรุณาเลือกประเภทที่อยู่"
                }
            },
            '#address':{
                'required':{
                    'message':"invalid address"
                }
            },
            '#zip':{
                'required':{
                    'message':"invalid postcode"
                }
            },
            '#tel':{
                'required':{
                    'message':"invalid telephone number"
                }
            },
            '#mobile':{
                'required':{
                    'message':"invalid mobile number"
                },
                'custom[number]':{
                    'message':"Number only"
                },
                'minSize':{
                    'message':"Number is not format"
                }
            },
            '#hospital_id':{
                'required':{
                    'message':"กรุณาเลือก รพ."
                }
            }
        },

        onValidationComplete:function (form, status) {
            if (status == true) {
                $('.button').attr('disabled', 'disabled');
                $.fancybox({
                    type:'html',
                    autoSize:true,
                    scrolling:'no',
                    closeBtn:false,
                    closeClick:true,
                    content:'   กำลังบันทึกข้อมูล...   '
                });
                form.validationEngine('detach');
                form.submit();

            }
        }


    });
    if ($('input[name="register_type"]:checked').val() == 1) {
        $('input[name^="co"]').attr('disabled', 'disabled');
    }
    $('input[name="register_type"]').live('change', function () {
        if ($(this).val() == 1) {
            $('input[name^="co"]').attr('disabled', 'disabled');
            $('input[name^="co"]').val('');
        }
        else {
            $('input[name^="co"]').removeAttr('disabled');
        }
    });
    //   $('input[type="text"]').val('');
    //   $('input[type="password"]').val('');
    $('#hospital_id').live('change', function () {
        var hospID = $(this).val();
        if (hospID == 0) {
            $('#hospital_other').addClass("validate[required] hospital_other");
        }
        else {
            $('#hospital_other').removeClass("validate[required] hospital_other");
        }
    });
});
function CheckPass(field, rules, i, options) {
    var pass = $('#password').val();
    if (pass != '' && field.val() != pass) {
        return "ไม่เหมือนกับ password";
    }
}
function CheckUser(field, rules, i, options) {
    if (field.val() != '' && field.val().length >= 6) {
        var msg = '';
        var url = 'register/user/valid_user';
        var data = {user:field.val()}
        $.post(url, data, function (data) {
            if (data == 'false') {
                return options.allrules.validate2fields.alertText;
            }
        });
    }
}
