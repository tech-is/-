<?php

function select_staff($staffs)
{
    if (isset($staffs)) {
        $select = "<select id='staff_id' name='staff_id' class='form-control show-tick'>";
        foreach($staffs as $row => $staff) {
            $select .= "<option value='{$staff['staff_id']}'>{$staff['staff_name']}</option>";
        }
    } else {
        $select = "<select id='staff_id' name='staff_id' class='form-control' disabled>";
        $select .= "<option>スタッフが登録されていません</option>";
    }
    $select .= "</select>";
    return $select;
}
?>
<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 37px">予約一覧</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-deep-purple waves-effect" id="register">
                                <!-- <i class="material-icons">contact_mail</i> -->
                                新規予約
                            </button>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modalArea_register" class="modalArea">
    <div id="modalBg_register" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents_register"></div>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
        <form action="" id="reserve">
            <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                <h2 class="pull-left" style="font-weight: bold; line-height: 37px; margin: 0px">新規予約</h2>
            </div>
            <div class="body">
                <div class="form-group">
                    <div class="form-line">
                        <label for="customer_name">お客様名<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="text" id="customer_name" class="form-control" name="customer" placeholder="例：田中太郎さん">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="customer_pet">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="text" id="customer_pet" class="form-control" name="customer_pet" placeholder="例：ポチくん">
                    </div>
                </div>
                <div class="form-group">
                    <label for="staff">担当スタッフ</label>
                    <?php echo select_staff($staffs)?>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="datetime-local" id="reserve_start"name="start" class="form-control" placeholder="開始日時" value="<?php echo date("Y-m-d")."T00:00" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_end">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="time" id="reserve_end" name="reserve_end" class="form-control" placeholder="終了日時">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="from_name">予約内容</label>
                        <textarea rows=4 id="reserve_content" class="form-control no-resize" name="content" placeholder="トリミング"></textarea>
                    </div>
                </div>
                <button type="button" id="sendResisterReserve" class="btn bg-pink waves-effect">
                    登録
                </button>
                <button type="button" class="btn bg-orange waves-effect" style="margin-right: 10px">
                    キャンセル
                </button>
            </div>
        </form>
    </div>
</section>

<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents"></div>
        <div id="closeModal" class="closeModal">
            ×
        </div>
        <button id='update'>変更</button>
        <button id='delete'>削除</button>
    </div>
</section>

<section id="modalArea_update" class="modalArea">
    <div id="modalBg_update" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents_update"></div>
        <div id="closeModal_update" class="closeModal">
            ×
        </div>
    </div>
</section>
<!-- モーダルエリアここまで -->

<!-- Jquery Core Js -->
<script src="../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='../assets/cms/plugins/momentjs/moment.js'></script>

<!-- fullcalendar -->
<script src="../assets/cms/plugins/fullcalendar-3.9.0/fullcalendar.min.js"></script>
<script src="../assets/cms/plugins/fullcalendar-3.9.0/locale-all.js"></script>

<!-- Bootstrap Core Js -->
<script src=" ../assets/cms/plugins/bootstrap/js/bootstrap.js"> </script>

<!-- Slimscroll Plugin Js -->
<script src="../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="../assets/cms/plugins/raphael/raphael.min.js"></script>
<script src="../assets/cms/plugins/morrisjs/morris.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="../assets/cms/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Validation Plugin Js -->
<script src="../assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Plugin Js -->
<script src="../assets/cms/js/admin.js"></script>

<script src="../assets/cms/js/sidebar.js"></script>

<script>
    var event_json = <?php echo isset($events)? json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT): 0;?>
</script>
<script>
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
        timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true,
        editable: true,
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
            // var title = calEvent.title;
            var staff_id = calEvent.staff_id;
            sessionStorage.setItem('reserve_id', calEvent.reserve_id);
            var update_start = $.fullCalendar.formatDate(calEvent.start, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.start, "HH:mm");
            var update_end = $.fullCalendar.formatDate(calEvent.end, 'YYYY-MM-DD') + "T" + $.fullCalendar.formatDate(calEvent.end, "HH:mm");
            var contents = "<h2>予約名:"+ calEvent.title + "</h2>"
                contents += "<p>開始日時:" + $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>終了日時:" + $.fullCalenda.formatDate(calEvent.end, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>予約内容:" + calEvent.content + "</p>";
            $('#modalContents').html(contents);
            $('#modalArea').fadeIn();
            $('#update_shift').on('click',function() {
                // $('input[name="update_shift_staff"]').val(title);
                $('#update_shift_staff').val(staff_id);
                $('input[name="update_shift_start"]').val(update_start);
                $('input[name="update_shift_end"]').val(update_end);
                $('#modalArea_update').fadeIn();
            })
        }
    });
});
</script>
<!-- モーダルウィンドウを閉じる -->
<script>
$(function () {
    $('#closeModal , #modalBg').on('click',function() {
        $('#modalArea').fadeOut();
    });

    $('#closeModal_register , #modalBg_register').on('click',function() {
        $('#modalArea_register').fadeOut();
    });

    $('#register').on('click',function() {
        // $('#modalContents_register').load("../assets/cms/html_parts/reserve_form_parts.php");
        $('#modalArea_register').fadeIn();
    });

    $('#update').on('click',function() {
        var reserve_id = sessionStorage.getItem('reserve_id');
        $.ajax({
            url:'../cl_reserve/get_reserve_data',
            type:'POST',
            data:{
                'event_id': reserve_id,
            }
        })
        .done( (data) => {
            $('#modalArea').fadeOut();
            $('#modalArea_update').fadeIn();
        })
        .fail( (data) => {
            alert("失敗しました");
        })
    });

    $('#closeModal_update , #modalBg_update').on('click', function() {
        $('#modalArea_update').fadeOut();
    });
});

</script>
<script>
    $('#sendResisterReserve').on('click', function() {
        let param = {
            customer_name : $('#customer_name').val(),
            customer_pet : $('#customer_pet').val(),
            staff_id : $('#staff_id').val(),
            reserve_start : $('#reserve_start').val(),
            reserve_end : $('#reserve_start').val().slice(0 , -5) + $('#reserve_end').val(),
            reserve_content:  $('#reserve_content').val()
        };
        $.ajax({
            url:'../cl_reserve/register_reserve_data',
            type:'POST',
            data: param
        })
        .done( (data) => {
            console.log(data);
            // $('#modalArea').fadeOut();
            // $('#modalArea_update').fadeIn();
        })
        .fail( (data) => {
            alert("失敗しました");
        })
    });
</script>
</body>

</html>