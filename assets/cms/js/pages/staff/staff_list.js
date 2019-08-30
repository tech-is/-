$(document).ready(function() {
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
        eventRender: function(eventObj, $el, calEvent) {
            var start = $.fullCalendar.formatDate(eventObj.start, 'MM月DD日 HH:mm');
            var end = $.fullCalendar.formatDate(eventObj.end, 'MM月DD日 HH:mm');
            $el.popover({
                title: eventObj.title,
                content:  start + " ~ " + end,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
        eventClick: function(calEvent, jsEvent, view)
        {
            var title = calEvent.title;
            // var start = $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm');
            var update_start = $.fullCalendar.formatDate(calEvent.start, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.start, "HH:mm");
            var update_end = $.fullCalendar.formatDate(calEvent.end, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.end, "HH:mm");
            var contents = "<h3 style='margin-bottom:10px'>従業員名:"+ calEvent.title + "</h3>"
            contents += "<p>始業: " + $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm') + "</p>";
            contents += "<p>終業: " + $.fullCalendar.formatDate(calEvent.end, 'YYYY年MM月DD日 HH:mm') + "</p>";
            $('#modalContents').html(contents);
            $('#modalArea').fadeIn();
            $('#update').click(function() {
                $('input[name="update_shift_staff"]').val(title);
                $('input[name="update_shift_start"]').val(update_start);
                $('input[name="update_shift_end"]').val(update_end);
                $('#modalArea_update').fadeIn();
            })
        }
    });
});

/* イベント詳細モーダル */
$('#closeModal , #modalBg').click(function() {
    $('#modalArea').fadeOut();
});

$('#closeModal_update , #modalBg_update , #cancel_update_shift').click(function() {
    $('#modalArea_update').fadeOut();
});

/*スタッフ一覧モーダル */
$('#staff_list').click(function() {
    $('#modalArea_staff_list').fadeIn();
});

$('#closeModal_staff_list, #modalBg_staff_list, #cancel_staff_list').click(function() {
    $('#modalArea_staff_list').fadeOut();
});

/** スタッフ追加モーダル */
$('#add_staff').click(function() {
    $('#modalArea_add_staff').fadeIn();
});

$('#closeModal_add_staff, #modalBg_add_staff, #cancel_add_staff').click(function() {
    $('#modalArea_add_staff').fadeOut();
    $('input[name="shift_staff"]').val("");
    $('input[name="shift_start"]').val("");
    $('input[name="shift_end"]').val("");
});

/** シフト追加モーダル */
$('#add_shift').click(function() {
    $('#modalArea_add_shift').fadeIn();
});

$('#closeModal_add_shift , #modalBg_add_shift, #cancel_add_shift').click(function() {
    $('#modalArea_add_shift').fadeOut();
    $('input[name="shift_staff"]').val("");
    $('input[name="shift_start"]').val("");
    $('input[name="shift_end"]').val("");
});

/* jquery.validate */
$("staff").validate({
    rules: {
        customer: { required: true },
        pet: {required: true },
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