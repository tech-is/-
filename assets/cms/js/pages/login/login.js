function show_prov_register() {
    $('#login').hide();
    $('#forgot-password').hide();
    $('#prov-register').show();
}

function show_login() {
    $('#prov-register').hide();
    $('#forgot-password').hide();
    $('#login').show();
}

function forgot_password() {
    $('#prov-register').hide();
    $('#login').hide();
    $('#forgot-password').show();
}

$('#login').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/login',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'login-email': $('#login-email').val(),
            'login-password': $('#login-password').val()
        },
        dataType: 'json'
    }).then(
        function (data) {
            process_callback(data)
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK'
                },
            })
        });
    return false;
});

$('#prov-register').on('submit', function () {
    event.preventDefault();
    $.ajax({
        url: '//animarl.com/login/prov_register',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'prov-email': $('#prov-email').val(),
        },
        dataType: 'json'
    }).then(
        function (data) {
            process_callback(data);
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK',
                    value: true
                },
            })
        });
});

$('#forgot-password').on('submit', function () {
    $.ajax({
        url: '//animarl.com/login/forgot_password',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'forgot-email': $('#forgot-email').val(),
        }
    }).then(
        function (data) {
            SweetAlertMessage(data === 'success' ? 'success_register' : 'failed_register');
        },
        function () {
            SweetAlertMessage('failed_register');
        })
    return false;
});

function process_callback(json) {
    $('label' + '.error').remove();
    $('.form-line').removeClass('error')
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: 'ログインが完了しました',
                    text: '',
                    icon: 'success',
                    button: {
                        text: 'OK',
                        value: true
                    },
                }).then(function (value) {
                    location.reload();
                });
                break;
            case 'error':
                SweetAlertMessage(val);
                break;
            case 'valierr':
                $.each(val, function (name, text) {
                    $('#' + name).parents('.form-line').addClass('error')
                    let parent = $('#' + name).parents('.input-group');
                    parent.append('<label class="error">' + text + '</label>');
                    $('#' + name).focus();
                });
                break;
            default:
                break;
        }
    });
}

/******************************************************************** */
/** SweetAlert  **/
/******************************************************************** */
function SweetAlertMessage(key) {
    let message_json = {
        success_login: {
            title: 'ログインが完了しました',
            text: '',
            icon: 'success',
            button: {
                text: 'OK',
                value: location.reload()
            },
        },
        failed_login: {
            title: 'ログインに失敗しました…',
            text: 'メールアドレスかパスワードが違います',
            icon: 'warning',
            button: {
                text: 'OK',
                value: true,
            },
        },
        success_register: {
            title: '登録が完了しました！',
            text: 'メールを送信いたしましたのでご確認ください。',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
            },
        },
        failed_register: {
            title: '登録に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: true,
            },
        },
        success_update: {
            title: '更新が完了しました！',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
            }
        },
        failed_update: {
            title: '更新に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: false,
            },
        },
        success_delete: {
            title: '削除が完了しました！',
            icon: 'success',
            button: {
                text: 'OK',
                value: true,
            }
        },
        failed_delete: {
            title: '削除に失敗しました…',
            text: 'また後ほどお試しください',
            icon: 'warning',
            button: {
                text: 'OK',
                value: false,
            }
        }
    }
    swal(message_json[key]);
}