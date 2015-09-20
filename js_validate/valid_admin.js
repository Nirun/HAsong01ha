jQuery(document).ready(function () {
    jQuery('#form_signup').validationEngine('attach', {
        'custom_error_messages':{
            '#name':{
                'required':{
                    'message':"invalid name"
                }
            },
            '#lname':{
                'required':{
                    'message':"invalid lastname"
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
            }
        }

    });
    $('input[name^="permission"]').click(function () {

        if ($(this).prop('checked') && $(this).val() == '9') {
            $('input[name^="permission"]').each(function (e) {
                $(this).prop('checked', true);
            });
        }
        else if ($(this).prop('checked') == false && $(this).val() == '9') {
            $('input[name^="permission"]').each(function (e) {
                $(this).prop('checked', false);
            });
        }

        var chk = 0;
        $('input[name^="permission"]').each(function (e) {
            if ($(this).prop('checked') && $(this).val() != '9') {
                chk++;
            }
        });
        if (chk == 8) {
            $('input[name^="permission"]').each(function (e) {
                if ($(this).val() == '9') {
                    $(this).prop('checked', true);
                }
            });
        }
        else {
            $('input[name^="permission"]').each(function (e) {
                if ($(this).val() == '9') {
                    $(this).prop('checked', false);
                }
            });
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
        var url = 'register/admin/valid_user';
        alert(url);
        var data = {user:field.val()}
        $.post(url, data, function (data) {
            if (data == 'false') {
                return options.allrules.validate2fields.alertText;
            }
        });
    }
}
