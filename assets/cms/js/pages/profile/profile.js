$('#form').on('submit', function (e) {
    e.preventDefault();
    let form = $(this).serializeArray();
    let param = {};
    // let fd = new FormData($(this).get(0));
    for (let i = 0; i < form.length; i++) {
        param[form[i]['name']] = form[i]['value'];
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '//animarl.com/Profile/update_profile',
        type: 'POST',
        data: param,
        datatype: 'json'
    }).then(
        function (data) {
            // let json = JSON.parse(data);
            // console.log(data);
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
    $('label.error').remove();
    $('.form-group').removeClass('error')
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: val,
                    text: 'ボタンをクリックして画面を閉じてください',
                    icon: 'success',
                    button: {
                        text: 'OK',
                        value: true
                    },
                }).then(function () {
                    location.reload();
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
                    $('#' + name).parents('.form-line').addClass('error')
                    let parent = $('#' + name).parents('.form-group');
                    parent.append('<label class="error">' + text + '</label>');
                    $('#' + name).focus();
                });
                break;
            default:
                break;
        }
    });
}