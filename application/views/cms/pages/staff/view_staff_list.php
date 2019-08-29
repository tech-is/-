<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 37px">スタッフ管理</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-deep-purple waves-effect" id="staff_list">
                                スタッフ一覧
                            </button>
                            <button type="button" class="btn bg-deep-purple waves-effect" id="add_staff">
                                新規スタッフ追加
                            </button>
                            <button type="button" class="btn bg-deep-purple waves-effect" id="add_shift">
                                シフト追加
                            </button>
                        </div>
                    </div>
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- スタッフ一覧 -->
<section id="modalArea_staff_list" class="modalArea">
    <div id="modalBg_staff_list" class="modalBg"></div>
        <div class="modalWrapper">
        <table id="datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        </table>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- シフト入力フォーム -->
<section id="modalArea_add_shift" class="modalArea">
    <div id="modalBg_add_shift" class="modalBg"></div>
        <div class="modalWrapper">
            <form id="form_add_shift">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 style="margin: 0px">シフト追加</h3>
                </div>
                <div class="body">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="customer">従業員名<span style="color: red; margin-left: 10px">必須</span></label>
                            <input type="text" class="form-control" name="shift_staff" placeholder="例：田中太郎さん">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="start">始業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="datetime-local" name="shift_start" class="form-control" placeholder="開始日時">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="end">終業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="datetime-local" name="shift_end" class="form-control" placeholder="終了日時">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary m-t-15 waves-effect">登録</button>
                        <button type="button" id="cancel_add_shift" class="btn btn-primary m-t-15 waves-effect" style="margin-left: 10px;">キャンセル</button>
                    </div>
                </div>
            </form>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- スタッフ入力フォーム -->
<section id="modalArea_add_staff" class="modalArea">
    <div id="modalBg_add_staff" class="modalBg"></div>
        <div class="modalWrapper">
            <form id="form_add_staff">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 style="margin: 0px">スタッフ追加</h3>
                </div>
                <div class="body">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="new_staff">従業員名<span style="color: red; margin-left: 10px">必須</span></label>
                            <input type="text" class="form-control" name="new_staff" placeholder="例：田中太郎さん">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="customer">シフト用カラーラベル<span style="color: red; margin-left: 10px">必須</span></label>
                            <input type="color" class="form-control" name="add_staff_color" value="#0080ff">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="customer">備考<span style="color: red; margin-left: 10px">必須</span></label>
                            <textarea rows="4" class="form-control no-resize" name="add_staff_content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary m-t-15 waves-effect">登録</button>
                        <button type="button" id="cancel_add_staff" class="btn btn-primary m-t-15 waves-effect" style="margin-left: 10px;">キャンセル</button>
                    </div>
                </div>
            </form>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>
<!-- END -->

<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents"></div>
        <button id='update' class='btn btn-primary m-t-15 waves-effect'>変更</button>
        <button id='delete' class='btn btn-primary m-t-15 waves-effect'>削除</button>
        <div id="closeModal" class="closeModal">
            ×
        </div>
    </div>
</section>

<section id="modalArea_update" class="modalArea">
    <div id="modalBg_update" class="modalBg"></div>
    <div class="modalWrapper">
        <form id="staff">
            <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                <h3 style="font-weight: bold; line-height: 37px; margin: 0px">シフト変更</h3>
                <!-- <div class="pull-right">
                    <button type="button" class="btn bg-pink waves-effect">
                        <i class="material-icons">cancel</i>
                        <span>cancel</span>
                    </button>
                    <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px">
                        <i class=" material-icons">save</i>
                        <span>SAVE</span>
                    </button>
                </div> -->
            </div>
            <div class="body">
                <div class="form-group">
                    <div class="form-line">
                        <label for="update_shift_staff">従業員名<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="text" class="form-control" name="update_shift_staff" placeholder="例：田中太郎さん" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="update_shift_start">始業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="datetime-local" name="update_shift_start" class="form-control" placeholder="開始日時" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="update_shift_end">終業日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="datetime-local" name="update_shift_end" class="datetimepicker form-control" placeholder="終了日時">
                            </div>
                        </div>
                    </div>
                </div>
                <button id='update' class='btn btn-primary m-t-15 waves-effect'>変更</button>
                <button type='button' id='cancel_update_shift' class='btn btn-primary m-t-15 waves-effect'>キャンセル</button>
            </div>
        </form>
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

<!-- Validation Plugin Js -->
<script src="../assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Jquery-datatable -->
<script src="../assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>

<!-- Custom Plugin Js -->
<script src="../assets/cms/js/admin.js"></script>

<script src="../assets/cms/js/sidebar.js"></script>

<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
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
        events: <?php echo json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);?>,
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
            var start = $.fullCalendar.formatDate(calEvent.start, 'YYYY年MM月DD日 HH:mm');
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

$('#closeModal , #modalBg').click(function() {
    $('#modalArea').fadeOut();
});


$('#closeModal_update , #modalBg_update , #cancel_update_shift').click(function() {
    $('#modalArea_update').fadeOut();
});

/*スタッフ一覧モーダル */
$('#staff_list').click(function() {
    $('#datatable').DataTable({
            "id": "1",
            "name": "Tiger Nixon",
            "position": "System Architect",
            "salary": "$320,800",
            "start_date": "2011/04/25",
            "office": "Edinburgh",
            "extn": "5421"
    });
    $('#modalArea_staff_list').fadeIn();
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

/* END */
</script>

<script>
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
</script>
</body>

</html>