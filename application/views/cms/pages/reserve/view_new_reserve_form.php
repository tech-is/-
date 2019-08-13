<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="POST" action="#">
                        <div class="header clearfix">
                            <h2 class="pull-left" style="font-weight: bold; line-height: 37px">新規予約</h2>
                            <div class="pull-right">
                                <button type="button" class="btn bg-pink waves-effect"
                                    onclick="window.open('magazine', '_self')">
                                    <i class="material-icons">cancel</i>
                                    <span>cancel</span>
                                </button>
                                <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px"
                                    onclick="return confirm_form()">
                                    <i class=" material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <!-- <h2 class="card-inside-title">新規予約</h2> -->
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="template_name">お客様名</label>
                                    <input type="text" class="form-control" name="template_name" placeholder="お客様名">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="template_name">ペット名</label>
                                    <input type="text" class="form-control" name="template_name" placeholder="お客様名">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                <label for="from_name">予定日</label>
                                    <input type="text" class="datetimepicker form-control" placeholder="クリックしてカレンダーで予定日を追加してください" data-dtp="dtp_GAJiB">
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="form-line">
                                <label for="from_name">担当者</label>
                                <input type="text" class="form-control" name="from_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <label for="template_name">予約詳細</label>
                                <textarea rows="4" class="form-control no-resize" placeholder="例：トリミング"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="../../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../../assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Moment Plugin Js -->
<script src="../../assets/cms/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="../../assets/cms/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>

<!-- Custom Js -->
<script src="../../assets/cms/js/admin.js"></script>

<script>
$(function() {
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format:"YYYY-MM-DD HH:mm",
        clearButton: true,
        weekStart: 1,
        lang:"ja",
    });
});
</script>
</body>

</html>