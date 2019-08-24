<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 37px">予定一覧</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-deep-purple waves-effect" id="register">
                                <i class="material-icons">contact_mail</i>
                                <span>new</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents"></div>
            <div id="closeModal" class="closeModal">
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

<!-- Select Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="../assets/cms/plugins/raphael/raphael.min.js"></script>
<script src="../assets/cms/plugins/morrisjs/morris.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="../assets/cms/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>

<script>
$(document).ready(function() {

    $('#calendar').fullCalendar({
        locale: 'ja',
        header: {
        left: 'prev,next today',
        center: 'title',
        // right: 'month,basicWeek,basicDay'
        right: 'month,agendaWeek,agendaDay,listMonth'
        },
        // timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: <?php echo json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);?>,
        eventClick: function(calEvent, jsEvent, view) {
                var contents = "<h2>予約名:"+ calEvent.title + "</h2>"
                contents += "<p>開始日時:" + $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>終了日時:" + $.fullCalendar.formatDate(calEvent.end, 'YYYY年MM月DD日 HH:mm') + "<p>";
                contents += "<p>予約内容:" + calEvent.content + "</p>";
                // contents += calEvent.staff
                // $('#modalContents').html(calEvent.title);
                $('#modalContents').html(contents);
                $('#modalArea').fadeIn();
        }
    });
});
</script>

<!-- モーダルウィンドウを閉じる -->
<script>
$(function () {
    $('#closeModal , #modalBg').click(function(){
        $('#modalArea').fadeOut();
    });
    $('#register').click(function() {
        $('#modalContents').load("../assets/cms/reserve_form_parts.php");
        $('#modalArea').fadeIn();
    });
});
</script>

</body>

</html>