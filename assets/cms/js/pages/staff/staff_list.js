$(document).ready(function () {
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
        // timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: event_json,
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
        eventClick: function (calEvent, jsEvent, view) {
            var title = calEvent.title;
            // var start = $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm');
            var update_start = $.fullCalendar.formatDate(calEvent.start, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.start, "HH:mm");
            var update_end = $.fullCalendar.formatDate(calEvent.end, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.end, "HH:mm");
            var contents = "<h3 style='margin-bottom:10px'>従業員名:" + calEvent.title + "</h3>"
            contents += "<p>始業: " + $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm') + "</p>";
            contents += "<p>終業: " + $.fullCalendar.formatDate(calEvent.end, 'YYYY年MM月DD日 HH:mm') + "</p>";
            $('#modalContents').html(contents);
            $('#modalArea').fadeIn();
            $('#update').click(function () {
                $('input[name="update_shift_staff"]').val(title);
                $('input[name="update_shift_start"]').val(update_start);
                $('input[name="update_shift_end"]').val(update_end);
                $('#modalArea_update').fadeIn();
            })
        }
    });
});

/* イベント詳細モーダル */
$('#closeModal , #modalBg').click(function () {
    $('#modalArea').fadeOut();
});

$('#closeModal_update , #modalBg_update , #cancel_update_shift').click(function () {
    $('#modalArea_update').fadeOut();
});

/*スタッフ一覧モーダル */
$('#staff_list').click(function () {
    $('#modalArea_staff_list').fadeIn();
});

$('#closeModal_staff_list, #modalBg_staff_list, #cancel_staff_list').click(function () {
    $('#modalArea_staff_list').fadeOut();
    if ($("tr").hasClass("active")) {
        $("tr").removeClass("active");
    }
    $("#updateButton").prop("disabled", true);
    $("#shiftButton").prop("disabled", true);
    $("#deleteButton").prop("disabled", true);
});

/** スタッフ追加モーダル */
$('#add_staff').click(function () {
    $('#modalArea_add_staff').fadeIn();
});

$('#closeModal_add_staff, #modalBg_add_staff, #cancel_add_staff').click(function () {
    $('#modalArea_add_staff').fadeOut();
    $("input[name='staff_name[0]']").val("");
    $("input[name= 'staff_name[1]']").val("");
    $("input[name='staff_tel']").val("");
    $("input[name='staff_email']").val("");
    $("input[name='staff_color']").val("");
    $("textarea[name='staff_remarks']").val("");
});

/** シフト追加モーダル */
$('#add_shift').click(function () {
    $('#modalArea_add_shift').fadeIn();
});

$('#closeModal_add_shift , #modalBg_add_shift, #cancel_add_shift').click(function () {
    $('#modalArea_add_shift').fadeOut();
    $('input[name="shift_staff"]').val("");
    $('input[name="shift_start"]').val("");
    $('input[name="shift_end"]').val("");
});

/* jquery.validate */
$("staff").validate({
    rules: {
        customer: { required: true },
        pet: { required: true },
        start: { required: true },
        end: { required: true },
        content: { required: true }
    },
    messages: {
        customer: { required: "入力してください。" },
        pet: { required: "入力してください。" },
        start: { required: "入力してください。" },
        end: { required: "入力してください。" },
        content: { required: "入力してください。" }
    },
    highlight: function (input) {
        // console.log(input);
        $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
        $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
        $(element).parents('.input-group').append(error);
        $(element).parents('.form-group').append(error);
    }
});

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
    'data': table_json,
    'columns': [
        { 'data': "staff_id" },
        { 'data': "staff_name" },
        { 'data': "staff_tel" },
        { 'data': "staff_mail" },
        { 'data': "staff_color" },
        { 'data': "staff_remarks" },
    ],
    columnDefs: [
        {
            targets: 4,
            render: function (data, type, full, meta) {
                return "<div style='background-color:" + data + "; width: 100%; height: 24px'></div>";
            }
        },
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

// テーブル行クリックの設定
$('#datatable tbody').on("click", "tr", function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        var owner = $(this);
        $("#datatable tr").removeClass("active");
        owner.addClass("active");
        $("#updateButton").prop("disabled", false);
        $("#shiftButton").prop("disabled", false);
        $("#deleteButton").prop("disabled", false);
    }
});

$("#registButton").on("click", function (e) {
    $("#dialogTitle").html("スタッフ追加");
    $('#modalArea_add_staff').fadeIn();
});

$("#sendRegistButton").on("click", function () {
    $.ajax({
        url: "../cl_staff/register_staff",
        type: "POST",
        data: {
            staff_name: $("input[name='staff_name[0]']").val() + " " + $("input[name= 'staff_name[1]']").val(),
            staff_tel: $("input[name='staff_tel']").val(),
            staff_email: $("input[name='staff_email']").val(),
            staff_color: $("input[name='staff_color']").val(),
            staff_remarks: $("textarea[name='staff_remarks']").val()
        },
        success: function (data) {
            console.log(data);
            // $('#datatable').DataTable().ajax.reload();
            $("#modalArea_add_staff").fadeOut();
        },
        error: function () {
        }
    });
});

//スタッフ更新
$("#updateButton").on("click", function () {
    let row = $('#datatable').DataTable().rows('.active').data();
    let str = row[0].staff_name;
    sessionStorage.setItem('staff_id', row[0].staff_id)
    let staff_name = str.split(' ');
    $("#dialogTitle").html("スタッフ更新");
    $("input[name='staff_name[0]']").val(staff_name[0]) + " " + $("input[name= 'staff_name[1]']").val(staff_name[1]);
    $("input[name='staff_tel']").val(row[0].staff_tel);
    $("input[name='staff_email']").val(row[0].staff_mail);
    $("input[name='staff_color']").val(row[0].staff_color);
    $("textarea[name='staff_remarks']").val(row[0].staff_remarks);
    $('#modalArea_add_staff').fadeIn();
    $('#sendRegistButton').hide();
    $('#sendUpdateButton').show();
});

$("#sendUpdateButton").on("click", function () {
    var param = {
        staff_id: sessionStorage.getItem('staff_id'),
        staff_name: $("input[name='staff_name[0]']").val() + " " + $("input[name= 'staff_name[1]']").val(),
        staff_tel: $("input[name='staff_tel']").val(),
        staff_email: $("input[name='staff_email']").val(),
        staff_color: $("input[name='staff_color']").val(),
        staff_remarks: $("textarea[name='staff_remarks']").val()
    }
    $.ajax({
        url: "../cl_staff/update_staff_list",
        type: "POST",
        data: param,
        success: function (data) {
            alert("更新しました！");
            sessionStorage.removeItem('staff_id');
            // テーブル更新
            // $('#myTable').DataTable().ajax.url("/search").load();
            // $('#myTable').DataTable().ajax.reload();

            // // フォームを閉じる
            // $("#form").modal("hide");
        },
        error: function () {
        }
    });
});

$("#shiftButton").on("click", function () {
    var row = $('#datatable').DataTable().rows('.active').data();
    sessionStorage.setItem('staff_id', row[0].staff_id)
    $("input[name='shift_staff']").val(row[0].staff_name);
    $('#modalArea_add_shift').fadeIn();
});

$("#register_add_shift").on("click", function () {
    var param = {
        staff_id: sessionStorage.getItem('staff_id'),
        start: $("input[name='shift_start']").val(),
        end: $("input[name='shift_end']").val()
    }
    $.ajax({
        url: "../cl_staff/insert_shift",
        type: "POST",
        data: param,
        success: function (data) {
            alert(data);
        },
        error: function () {
        }
    });
});

$("#deleteButton").on("click", function () {
    if (window.confirm("本当にこの従業員を削除しますか？")) {
        var selectedRows = $('#datatable').DataTable().rows('.active').data();
        var param = {
            staff_id: selectedRows[0].staff_id
        }
        $.ajax({
            url: "../cl_staff/delete_staff",
            type: "POST",
            data: param,
            success: function (data) {
                alert("削除しました")
                // $('#myTable').DataTable().ajax.url("/search").load();
                // $('#myTable').DataTable().ajax.reload();
            },
            error: function () {
            }
        });
    }
});
