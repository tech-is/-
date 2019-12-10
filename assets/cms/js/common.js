function process_callback(json) {
    $('label' + '.error').remove();
    $('.form-line').removeClass('error')
    $.each(json, function (index, val) {
        switch (index) {
            case 'success':
                swal({
                    title: val.title,
                    text: val.msg,
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
                    title: val.title,
                    text: val.msg,
                    icon: 'warning',
                    button: {
                        text: 'OK',
                        value: true,
                    },
                });
                break;
            case 'valierr':
                $.each(val, function (name, text) {
                    // $('#' + name).parents('.form-line').addClass('error')
                    // let parent = $('#' + id).parents('.input-group');
                    // parent.append('<label class="error">' + text + '</label>');
                    // $('#' + name).focus();
                    $('input[name="' + name + '"]').parents('.form-line').addClass('error')
                    // let parent = $('input[name="' + name + '"]').parents('.input-group');
                    let parent = $('input[name="' + name + '"]').parents('.form-group');
                    parent.append('<label class="error">' + text + '</label>');
                    $('input[name="' + name + '"]').focus();
                });
                break;
            default:
                break;
        }
    });
}