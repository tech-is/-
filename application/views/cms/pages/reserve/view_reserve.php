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
                            <a href="reserve_new_form">
                                <button type="button" class="btn bg-deep-purple waves-effect">
                                    <i class="material-icons">contact_mail</i>
                                    <span>new</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
            <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div id="event_list" style="padding: 10px"></div>
                </div>
            </div> -->
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

<!-- full calender -->
<!-- <script src="../assets/cms/plugins/fullcalendar/packages/core/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/daygrid/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/interaction/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/timegrid/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/list/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/core/locales/ja.js"></script> -->

<!-- fullcalendar-3.10.0 -->
<script src="../assets/cms/plugins/fullcalendar-3.9.0/dist/fullcalendar.min.js"></script>

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
        header: {
        left: 'prev,next today',
        center: 'title',
        // right: 'month,basicWeek,basicDay'
        right: 'month,agendaWeek,agendaDay,listMonth'
        },
        timeFormat: 'HH:mm',
        timezone: 'Asia/Tokyo',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: <?php echo json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);?>,
        // events: [
        //     {
        //         title: 'All Day Event',
        //         start: '2018-03-01'
        //     },
        //     {
        //         title: 'Long Event',
        //         start: '2018-03-07',
        //         end: '2018-03-10'
        //     },
        //     {
        //         id: 999,
        //         title: 'Repeating Event',
        //         start: '2018-03-09T16:00:00'
        //     },
        //     {
        //         id: 999,
        //         title: 'Repeating Event',
        //         start: '2019-08-16T16:00:00'
        //     },
        //     {
        //         title: 'Conference',
        //         start: '2018-03-11',
        //         end: '2018-03-13'
        //     },
        //     {
        //         title: 'Meeting',
        //         start: '2018-03-12T10:30:00',
        //         end: '2018-03-12T12:30:00'
        //     }
        // ],
        eventClick: function(calEvent, jsEvent, view) {
                var contents = "<h2>"+ calEvent.title + "</h2>"
                contents += "<p>" + calEvent.content + "</p>";
                contents += "<p>" + calEvent.start + "</p>";
                contents += "<p>" + calEvent.end + "</p>";
                // contents += calEvent.staff
                // $('#modalContents').html(calEvent.title);
                $('#modalContents').html(contents);
                $('#modalArea').fadeIn();
        }
    });
});
</script>

    <!-- // document.addEventListener('DOMContentLoaded', function () {
    //     calendar_lend();
    // });

    // function calendar_lend() {
    //     var calendarEl = document.getElementById('calendar');

    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         plugins: [ 'interaction', 'dayGrid'],
    //         locale: 'ja',
    //         editable: true,
    //         eventLimit: true, // allow "more" link when too many events
    //         events: <?php echo json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);?>,
    //         eventClick: function(calEvent, jsEvent, view) {
    //             // var content =   "<h1>"+ calEvent.title + "</h1>"
    //             $('#modalContents').html(calEvent.title);
    //             $('#modalArea').fadeIn();
    //         }
    //     });
    //     calendar.render();
    // } -->
<script>
$(function () {
    $('#closeModal , #modalBg').click(function(){
        $('#modalArea').fadeOut();
    });
});
</script>
</body>

</html>