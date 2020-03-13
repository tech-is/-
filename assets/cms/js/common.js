function process_callback(json, reload = false) {
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
                    reload ? location.reload() : false;
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
                    $('#' + name).parents('.form-line').addClass('error')
                    let parent = $('#' + name).parents('.form-group');
                    parent.append('<label class="error">' + text + '</label>');
                });
                break;
            default:
                break;
        }
    });
}

function SysError_alert(text = false) {
    swal({
        title: 'システムエラー',
        text: text ? text : 'また後ほどお試しください',
        icon: 'warning',
        button: {
            text: 'OK',
            value: true
        }
    })
}

function datepicker(el, defTime = false) {
    el.flatpickr({
        dateFormat: 'Y-m-d',
        defaultDate: defTime
    });
}

function timepicker(el, defTime = false) {
    el.flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        defaultDate: defTime
    });
}

function getUnixtime(datetime) {
    let _timestamp = new Date(datetime + ' 0:0:0');
    let timestamp = _timestamp.getTime() / 1000 + 86400;
    let _d = new Date(timestamp * 1000);
    var Y = _d.getFullYear();
    var m = ("0" + (_d.getMonth() + 1)).slice(-2);
    var d = ("0" + _d.getDate()).slice(-2);
    let format = Y + '-' + m + '-' + d;
}

function formatUnixdate(timestamp) {
    let _d = new Date(timestamp * 1000);
    let H = ("0" + _d.getHours()).slice(-2);
    let i = ("0" + _d.getMinutes()).slice(-2);
    let s = ("0" + _d.getSeconds()).slice(-2);
    let format = Y + '-' + m + '-' + d;
    return format;
}

function timeCalculation(time = "00:00", add = -1800) {
    let _time = time == "24:00" ? "00:00" : time;
    let times = _time.split(':');
    let second = (times[0] * 3600 + times[1] * 60) + add;
    let H = Math.floor(second / 3600);
    let _H = Math.sign(H) === -1 ? 24 + H : H;
    let i = Math.floor((second - (H * 3600)) / 60);
    let format = ("0" + _H).slice(-2) + ':' + ("0" + i).slice(-2);
    console.log(format);
    return format;
}

function CreateFormObj(el, val = true) {
    let form = el.serializeArray();
    let param = {};
    for (let i = 0; i < form.length; i++) {
        param[form[i]['name']] = val ? form[i]['value'] : '';
    }
    return param;
}