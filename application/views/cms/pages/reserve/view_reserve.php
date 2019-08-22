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

<!-- Jquery Core Js -->
<script src="../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='../assets/cms/plugins/momentjs/moment.js'></script>

<!-- full calender -->
<script src="../assets/cms/plugins/fullcalendar/packages/core/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/daygrid/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/interaction/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/timegrid/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/list/main.js"></script>
<script src="../assets/cms/plugins/fullcalendar/packages/core/locales/ja.js"></script>


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

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        calendar_lend();
        calendar_list();
    });

    function calendar_lend() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            locale: 'ja',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($events);?>
        });
        calendar.render();
    }

    function calendar_list() {
        var calendarEl = document.getElementById('event_list');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['list'],
            locale: 'ja',
            defaultView: 'listWeek',
            events: <?php echo json_encode($events);?>
        });
        calendar.render();
    }
</script>
</body>

</html>