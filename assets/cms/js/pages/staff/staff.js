/******************************************************************** */
/** flatpickr */
/******************************************************************** */
$('#shift_time').on('change', function () {
    if (!$('#_shift_time').hasClass('lock')) {
        $('#_shift_time').val(timeCalculation($(this).val(), 1800));
    }
});

$('#shift_time').on('focus', function () {
    let el = $('#_shift_time');
    el.flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        defaultDate: el.val(),
        minTime: $(this).val()
    });
});

$('#_shift_time').on('blur', function () {
    let el = $(this);
    if (!el.hasClass('lock')) {
        el.val(timeCalculation(el.val(), 1800));
    }
});

$('#_shift_time').on('focus', function () {
    $(this).addClass('lock');
});

/******************************************************************** */
/** スタッフ一覧テーブル */
/******************************************************************** */
$(function () {
    $('#datatable').DataTable({
        'paging': true,
        'pageLength': 10,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'tabIndex': -1,
        'order': [[0, 'asc']],
        'colReorder': true,
        'data': staff_json,
        'columns': [
            { 'data': 'staff_id' },
            { 'data': 'staff_name' },
            { 'data': 'staff_tel' },
            { 'data': 'staff_mail' },
            { 'data': 'staff_color' },
            { 'data': 'staff_remarks' },
        ],
        'columnDefs': [
            {
                'targets': 0,
                'visible': false,
                'searchable': false
            },
            {
                'targets': 4,
                render: function (data, type, full, meta) {
                    return '<div style="background-color:' + data + '; width: 100 %; height: 24px"></div>';
                }
            }
        ],
        'language': {
            'decimal': '.',
            'emptyTable': '表示するデータがありません。',
            'info': '_START_ ～ _END_ / _TOTAL_ 件中',
            'infoEmpty': '0 ～ 0 / 0 件',
            'infoFiltered': '(合計 _MAX_ 件からフィルタリングしています)',
            'infoPostFix': ',',
            'thousands': ',',
            'lengthMenu': '1ページ _MENU_ 件を表示する',
            'loadingRecords': '読み込み中...',
            'processing': '処理中...',
            'search': '絞り込み:',
            'zeroRecords': '一致するデータが見つかりません。',
            'paginate': {
                'first': '最初',
                'last': '最後',
                'next': '次',
                'previous': '前'
            }
        }
    });
});

$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        var owner = $(this);
        $('#datatable tr').removeClass('active');
        owner.addClass('active');
        $('#updateButton').prop('disabled', false);
        $('#deleteButton').prop('disabled', false);
    }
});

/******************************************************************** */
/*シフトカレンダー */
/******************************************************************** */
$(function () {
    $('#calendar').fullCalendar({
        height: window.innerHeight - 250,
        windowResize: function () {
            $('#calendar').fullCalendar('option', 'height', window.innerHeight - 220);
        },
        locale: 'ja',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow 'more' link when too many events
        events: event_json,
        eventRender: function (eventObj, $el, calEvent) {
            let start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            let end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content: start + ' ~ ' + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            datepicker($('#shift_start'), $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD'));
            datepicker($('#shift_end'), $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD'));
            timepicker($('#shift_time'), $.fullCalendar.formatDate(eventObj.start, 'HH:mm'));
            timepicker($('#_shift_time'), $.fullCalendar.formatDate(eventObj.end, 'HH:mm'));
            $('#modalShiftTitle').text('シフト更新・削除');
            $('#updateShift, #deleteShift').show();
            $('#registerShift').hide();
            $('#staff').val(eventObj.staff_id);
            $('#shift_id').val(eventObj.shift_id);
            $('#modalAreaShift').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            datepicker($('#shift_start'));
            datepicker($('#shift_end'));
            timepicker($('#shift_time'), "09:00");
            timepicker($('#_shift_time'), "09:30");
            $('#modalShiftTitle').text('シフト登録');
            $('#staff').val('0');
            $('#shift_start, #shift_end').val($.fullCalendar.formatDate(date, 'YYYY-MM-DD'));
            $('#registerShift').show();
            $('#updateShift, #deleteShift').hide();
            $('#modalAreaShift').fadeIn();
        }
    });
});

function get_shift_via_ajax() {
    $.ajax({
        url: 'https://www.animarl.com/shift/get_shift_via_ajax',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    }).then(
        function (data) {
            let key = Object.keys(data);
            if (key[0] == 'error') {
                let alert = data.error;
                swal({
                    title: alert.title,
                    msg: alert.msg,
                    icon: 'warning',
                    buttons: {
                        OK: {
                            text: 'OK',
                            value: true,
                        }
                    }
                });
            } else {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', data);
                $('#calendar').fullCalendar('rerenderEvents');
            }
        }, function () {
            SysError_alert();
        }
    )
}
/******************************************************************** */
/** シフト登録・更新 **/
/******************************************************************** */
$('#form_shift').on('submit', function (e) {
    e.preventDefault();
    let param = CreateFormObj($(this));
    let method = $('#shift_id').val() === '' ? 'register_shift' : 'update_shift';
    $.ajax({
        url: 'https://www.animarl.com/shift/' + method,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: param
    }).then(function (data) {
        process_callback(data);
        let key = Object.keys(data);
        if (key[0] == 'success') {
            $('.modalArea').fadeOut();
            get_shift_via_ajax();
        }
    }, function () {
        SysError_alert();
    });
});

/******************************************************************** */
/* シフト削除 */
/******************************************************************** */
$('#deleteShift').on('click', function () {
    swal({
        title: '削除しますか？',
        icon: 'warning',
        buttons: {
            OK: {
                text: 'OK',
                value: true,
                closeModal: false
            },
            Cancel: {
                text: 'Cancel',
                value: false
            }
        }
    }).then(function (value) {
        if (!value) {
            return false;
        }
        let param = {
            shift_id: $('#shift_id').val()
        }
        $.ajax({
            url: 'https://www.animarl.com/shift/delete_shift',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: param,
        }).then(function (data) {
            process_callback(data, true)
        }, function () {
            SysError_alert();
        });
    })
});

/******************************************************************** */
/*スタッフ一覧モーダル */
/******************************************************************** */
$('#staff_list').click(function () {
    $('#modalArea_staffForm').fadeIn();
});

$('.closeModal, .modalBg, .cancel').click(function () {
    $('#modalArea_staffForm').fadeOut();
    if ($('tr').hasClass('active')) {
        $('tr').removeClass('active');
    }
    $('#updateButton, #deleteButton').prop('disabled', true);
});

/******************************************************************** */
/** スタッフ追加モーダル */
/******************************************************************** */
$('#registButton').click(function () {
    $('#modalAreaStaff').fadeIn();
});

$('.closeModal, .modalBg, .cancel').click(function () {
    $('#modalAreaStaff').fadeOut();
    let form = $('#form_staff').serializeArray();
    for (i = 0; i < form.length; i++) {
        $('#' + form[i]['name']).val('');
    }
});

/******************************************************************** */
/** シフト追加モーダル */
/******************************************************************** */
$('.closeModal, .modalBg, .cancel').click(function () {
    $('#modalAreaShift').fadeOut();
    $('#shift_staff').val('');
    $('#shift_start').val('');
    $('#shift_end').val('');
});

/******************************************************************** */
/* スタッフ登録 */
/******************************************************************** */
$('#registButton').on('click', function () {
    $('#sendRegister').show();
    $('#sendUpdate').hide();
    $('#dialogTitle').text('スタッフ追加');
    $('#modalAreaStaff').fadeIn();
});

$('#form_staff').on('submit', function (e) {
    e.preventDefault();
    let param = CreateFormObj($(this));
    if ($('#staff_id').val() == '') {
        var method = 'register_staff';
    } else {
        var method = 'update_staff';
        param['staff_id'] = $('#staff_id').val();
    }
    $.ajax({
        url: 'https://www.animarl.com/staff/' + method,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: param,
        dataType: 'json'
    }).then(function (data) {
        process_callback(data, true)
    }, function () {
        SysError_alert();
    });
});

/******************************************************************** */
/** スタッフ更新
/******************************************************************** */
$(function () {
    $('#datatable').DataTable().rows('.active').on('dblclick', function () {
        setStaff();
    });
});

$('#updateButton').on('click', function () {
    setStaff();
});

function setStaff() {
    let row = $('#datatable').DataTable().rows('.active').data();
    let str = row[0].staff_name;
    let staff_name = str.split(' ');
    $('#dialogTitle').text('スタッフ更新');
    $('input[name="staffFamilyName"]').val(staff_name[0]);
    $('input[name="staffFirstName"]').val(staff_name[1]);
    $('input[name="staff_tel"]').val(row[0].staff_tel);
    $('input[name="staff_email"]').val(row[0].staff_mail);
    $('input[name="staff_color"]').val(row[0].staff_color);
    $('textarea[name="staff_remarks"]').val(row[0].staff_remarks);
    $('#staff_id').val(row[0].staff_id);
    $('#modalAreaStaff').fadeIn();
    $('#sendRegister').hide();
    $('#sendUpdate').show();
}

// $('#sendUpdate').on('click', function () {
//     let param = {}
//     let form = $('#form_staff').serializeArray();
//     for (let i = 0; i < form.length; i++) {
//         param[form[i]['name']] = form[i]['value'];
//     }
//     param['staff_id'] = $('#staff_id').val();
//     $.ajax({
//         url: 'https://www.animarl.com/staff/update_staff',
//         type: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: param
//     }).then(function (data) {
//         process_callback(data)
//     }, function () {
//         SysError_alert();
//     });
// });

/******************************************************************** */
/** スタッフ削除  **/
/******************************************************************** */
$('#deleteButton').on('click', function () {
    swal({
        title: '削除しますか？',
        text: '削除する場合、このスタッフが登録されているシフトも同時に削除されます',
        icon: 'warning',
        buttons: {
            OK: {
                text: 'OK',
                value: true,
                closeModal: false
            },
            Cancel: {
                text: 'Cancel',
                value: false
            }
        }
    }).then((value) => {
        var rows = $('#datatable').DataTable().rows('.active').data();
        $.ajax({
            url: 'https://www.animarl.com/staff/delete_staff',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { staff_id: rows[0].staff_id }
        }).then(function (data) {
            process_callback(data);
        }, function () {
            SysError_alert();
        });
    });
});