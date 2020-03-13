function show_prov_register() {
    $('#login, #forgot-password').hide();
    $('#prov-register').show();
}

function show_login() {
    $('#prov-register, #forgot-password').hide();
    $('#login').show();
}

function forgot_password() {
    $('#prov-register, #login').hide();
    $('#forgot-password').show();
}

$('#login').on('submit', function () {
    event.preventDefault();
    $.ajax({
        url: 'https://www.animarl.com/login/login',
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
        data => process_callback(data, true),
        error => SysError_alert()
    );
});

$('#prov-register').on('submit', function (e) {
    event.preventDefault();
    $.ajax({
        url: 'https://www.animarl.com/login/prov_register',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'prov-email': $('#prov-email').val(),
        },
        dataType: 'json'
    }).then(
        data => process_callback(data),
        error => SysError_alert()
    );
});

$('#forgot-password').on('submit', function () {
    event.preventDefault();
    $.ajax({
        url: 'https://www.animarl.com/login/send_token_for_reset',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'forgot-email': $('#forgot-email').val(),
        },
        datatype: 'json'
    }).then(
        data => process_callback(data),
        error => SysError_alert()
    );
});