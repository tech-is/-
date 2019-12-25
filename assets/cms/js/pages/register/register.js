$('#sign_up').on('submit', function (e) {
    e.preventDefault();
    $('label' + '.error').remove();
    $('.form-line').removeClass('error')
    let form = $(this).serializeArray();
    let param = {};
    for (let i = 0; i < form.length; i++) {
        param[form[i]['name']] = form[i]['value'];
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '//animarl.com/register/register',
        type: 'POST',
        data: param,
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
        })
});

function process_callback(json) {
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: val.title,
                    text: 'ボタンをクリックして画面を閉じてください',
                    icon: 'success',
                    button: {
                        text: 'OK',
                        value: true
                    },
                }).then(function () {
                    location.href('//animarl.com/login');
                });
                break;
            case 'error':
                swal({
                    title: '送信に失敗しました...',
                    text: val,
                    icon: 'warning',
                    button: {
                        text: 'OK',
                        value: true,
                    },
                });
                break;
            case 'valierr':
                $.each(val, function (name, text) {
                    $('input[name="' + name).parents('.form-line').addClass('error')
                    let parent = $('input[name="' + name + '"]').parents('.form-group');
                    parent.append('<label class="error">' + text + '</label>');
                });
                break;
            default:
                break;
        }
    });
}