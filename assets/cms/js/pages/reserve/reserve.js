/******************************************************************** */
/** flatpickr */
/******************************************************************** */
$(function () {
    $("#start").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });

    $("#end").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
});
/******************************************************************** */
/** スタッフ一覧テーブル */
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
            { 'data': "customer_id" },
            { 'data': "pet_id" },
            { 'data': "customer_name" },
            { 'data': "pet_name" },
            { 'data': "customer_tel" },
            { 'data': "customer_mail" },
            { 'data': "kind_group_name" }
        ],
        columnDefs: [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            },
            {
                "targets": 1,
                "visible": false,
                "searchable": false
            }
        ],
        'language': {
            'decimal': ".",
            'emptyTable': "表示するデータがありません。",
            'info': "_START_ ～ _END_ / _TOTAL_ 件中",
            'infoEmpty': "0 ～ 0 / 0 件",
            'infoFiltered': "(合計 _MAX_ 件からフィルタリングしています)",
            'infoPostFix': "",
            'thousands': ",",
            'lengthMenu': "1ページ _MENU_ 件を表示する",
            'loadingRecords': "読み込み中...",
            'processing': "処理中...",
            'search': "絞り込み:",
            'zeroRecords': "一致するデータが見つかりません。",
            'paginate': {
                'first': "最初",
                'last': "最後",
                'next': "次",
                'previous': "前"
            }
        }
    });
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
        eventLimit: true, // allow "more" link when too many events
        events: reserve,
        eventRender: function (eventObj, $el, calEvent) {
            var start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content: start + " ~ " + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function (eventObj, jsEvent, view) {
            let start = $.fullCalendar.formatDate(eventObj.start, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.start, 'HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(eventObj.end, 'HH:mm');
            update_shift_id = eventObj.shift_id
            $('#modal_shift_title').html("シフト更新・削除");
            $('#start').val(start);
            $('#end').val(end);
            $('#select_shift_staff').val(eventObj.staff_id);
            $('#shift_id').val(eventObj.shift_id);
            $('#modalArea_register').fadeIn();
        },
        dayClick: function (date, jsEvent, view) {
            let day = $.fullCalendar.formatDate(date, 'YYYY-MM-DD') + 'T' + $.fullCalendar.formatDate(date, 'HH:mm');
            $("#start").val(day);
            $('#modalArea_register').fadeIn();
        }
    });
});


$('#datatable').on('click', 'tr', function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        let owner = $(this);
        $("#datatable tr").removeClass("active");
        owner.addClass("active");
        let row = $('#datatable').DataTable().rows(owner).data()[0];
        $("#reserve_pet_id").val(row.pet_id);
        $("#reserve_customer").val(row.customer_name);
        $("#reserve_pet").val(row.pet_name);
    }
});

// テーブル行クリックの設定
$('#sendResisterReserve').on('click', function () {
    $.ajax({
        url: ' cl_reserve/register_reserve_data',
        type: 'POST',
        data: {
            "reserve_pet_id": $('#reserve_pet_id').val(),
            "reserve_start": $('#start').val(),
            "reserve_end": $('#end').val(),
            "reserve_content": $('#reserve_content').val()
        }
    })
        .done((data) => {
            console.log(data);
        })
        .fail((data) => {
            alert("失敗しました");
        })
});

$('#closeModal , #modalBg').on('click', function () {
    $('#modalArea').fadeOut();
});

$('#closeModal_register , #modalBg_register').on('click', function () {
    $('#modalArea_register').fadeOut();
});

$('#register').on('click', function () {
    $('#modalArea_register').fadeIn();
});

$('#update').on('click', function () {
    var reserve_id = sessionStorage.getItem('reserve_id');
    $.ajax({
        url: '../cl_reserve/get_reserve_data',
        type: 'POST',
        data: {
            'event_id': reserve_id,
        }
    })
        .done((data) => {
            $('#modalArea').fadeOut();
            $('#modalArea_update').fadeIn();
        })
        .fail((data) => {
            alert("失敗しました");
        })
});

$('#closeModal_update , #modalBg_update').on('click', function () {
    $('#modalArea_update').fadeOut();
});

