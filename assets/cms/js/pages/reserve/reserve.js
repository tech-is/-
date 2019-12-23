$('#register').on('click', function () {
    $('#modal_title').text('新規予約');
    $('#registerReserve').show();
    $('#updateReserve, #deleteReserve').hide();
    $('#reserve_start, #reserve_end').flatpickr({
        dateFormat: 'Y-m-d',
        defaultDate: 'today'
    });
    $('#reserve_time').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        defaultDate: '09:00'
    });
    $('#_reserve_time').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        defaultDate: '09:30'
    });
    $('.modalArea').fadeIn();
});


/******************************************************************** */
/** 顧客一覧テーブル */
/******************************************************************** */
$(function () {
    $('#datatable').DataTable({
        'paging': true,
        'pageLength': 5,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'tabIndex': -1,
        'order': [[0, 'asc']],
        'colReorder': true,
        'data': total,
        'columns': [
            { 'data': 'pet_id' },
            { 'data': 'customer_name' },
            { 'data': 'pet_name' },
            { 'data': 'customer_tel' },
            { 'data': 'customer_mail' },
            { 'data': 'kind_group_name' }
        ],
        'columnDefs': [
            {
                'targets': 0,
                'visible': false,
                'searchable': false
            }
        ],
        'language': {
            'decimal': '.',
            'emptyTable': '表示するデータがありません。',
            'info': '_START_ ～ _END_ / _TOTAL_ 件中',
            'infoEmpty': '0 ～ 0 / 0 件',
            'infoFiltered': '(合計 _MAX_ 件からフィルタリングしています)',
            'infoPostFix': '',
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

/******************************************************************** */
/*予約カレンダー */
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
        navLinks: true,
        editable: true,
        eventLimit: true,
        events: reserve,
        eventRender: function (eventObj, $el, calEvent) {
            var start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content: start + ' ~ ' + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            datepicker($('#reserve_start'), $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD'));
            datepicker($('#reserve_end'), $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD'));
            timepicker($('#reserve_time'), $.fullCalendar.formatDate(eventObj.start, 'HH:mm'));
            timepicker($('#_reserve_time'), $.fullCalendar.formatDate(eventObj.end, 'HH:mm'));
            $('#registerReserve').hide();
            $('#modal_title').text('予約更新・削除');
            $('#reserve_id').val(eventObj.reserve_id)
            $('#reserve_pet').val(eventObj.title);
            $('#reserve_customer').val(eventObj.customer_name);
            $('#reserve_color').val(eventObj.color);
            $('#reserve_pet_id').val(eventObj.reserve_pet_id);
            $('#modalArea_register, #updateReserve, #deleteReserve').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            datepicker($('#reserve_start'), $.fullCalendar.formatDate(date, 'YYYY-MM-DD'));
            datepicker($('#reserve_end'), $.fullCalendar.formatDate(date, 'YYYY-MM-DD'));
            timepicker($('#reserve_time'), '09:00');
            timepicker($('#_reserve_time'), '09:30');
            $('#reserve_id, #reserve_pet, #reserve_customer').val('')
            $('#modal_title').text('新規予約');
            $('#registerReserve').show();
            $('#updateReserve, #deleteReserve').hide();
            $('#modalArea_register').fadeIn();
        }
    });
});

/******************************************************************** */
/** ajax **/
/******************************************************************** */
function get_reserve_via_ajax() {
    $.ajax({
        url: ' reserve/get_reserve_via_ajax',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    }).then(
        function (data) {
            if (data !== 'error') {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', data);
                $('#calendar').fullCalendar('rerenderEvents');
            }
        }, function () {
            SysError_alert();
        }
    )
}

$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        let owner = $(this);
        $('#datatable tr').removeClass('active');
        owner.addClass('active');
        let row = $('#datatable').DataTable().rows(owner).data()[0];
        $('#reserve_pet_id').val(row.pet_id);
        $('#reserve_customer').val(row.customer_name);
        $('#reserve_pet').val(row.pet_name);
    }
});

$('#form_reserve').on('submit', function (e) {
    e.preventDefault();
    let param = CreateFormObj($(this));
    if ($('#reserve_id').val() === '') {
        var method = 'register_reserve';
    } else {
        var method = 'update_reserve';
    }
    $.ajax({
        url: ' reserve/' + method,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: param,
        dataType: 'json'
    }).then(function (data) {
        process_callback(data);
        let key = Object.keys(data);
        if (key[0] == 'success') {
            $('.modalArea').fadeOut();
            get_reserve_via_ajax();
        }
    }, function () {
        SysError_alert();
    })
});

function updateReserve(param) {
    $.ajax({
        url: 'reserve/update_reserve',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: param,
        dataType: 'json'
    }).then(
        function (data) {
            process_callback(data);
            let key = Object.keys(data);
            if (key[0] == 'success') {
                $('.modalArea').fadeOut();
                get_reserve_via_ajax();
            }
        }, function () {
            SysError_alert();
        }
    );
}

$('#deleteReserve').on('click', function () {
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
    }).then((value) => {
        if (value) {
            $.ajax({
                url: 'reserve/delete_reserve',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'reserve_id': $('#updateReserve').val(),
                }
            }).then(
                function (data) {
                    process_callback(data);
                    let key = Object.keys(data);
                    if (key[0] == 'success') {
                        $('.modalArea').fadeOut();
                        get_reserve_via_ajax();
                    }
                }, function () {
                    SysError_alert();
                }
            );
        }
    })
});

/******************************************************************** */
/*モーダル制御 */
/******************************************************************** */
$('.closeModal, .modalBg, .cancel').on('click', function () {
    $('label' + '.error').remove();
    $('.modalArea').fadeOut();
});
