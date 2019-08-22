<?php
function select_staff()
{
    if(isset($staff_id)) {
        $select = "<select name='staff_id' class='form-control show-tick'>";
        while($staff_id) {
            $select .= "<option value='{$staff_id}'>{$staff_id}</option>";
        }
    } else {
        $select = "<select name='staff_id' class='form-control' disabled>";
        $select .= "<option>スタッフが登録されていません</option>";
    }
    $select .= "</select>";
    return $select;
}
?>
<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="POST" action="../cl_reserve/register_reserve_data">
                        <div class="header clearfix">
                            <h2 class="pull-left" style="font-weight: bold; line-height: 37px">新規予約</h2>
                            <div class="pull-right">
                                <button type="button" class="btn bg-pink waves-effect"
                                    onclick="window.open('reserve', '_self')">
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
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="template_name">お客様名<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" class="form-control" name="customer" placeholder="例：田中太郎さん">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="from_name">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" class="form-control" name="from_name" placeholder="例：ポチくん">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <div class="form-line"> -->
                                    <label for="staff">担当者</label>
                                        <?= select_staff()?>
                                <!-- </div> -->
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                            <input type="text" name="start" class="datetimepicker form-control" placeholder="開始日時">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="end">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                            <input type="text" name="end" class="datetimepicker form-control" placeholder="終了日時">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="from_name">予約内容</label>
                                    <textarea rows=4 class="form-control" name="content" placeholder="トリミング"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="../assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../assets/cms/plugins/node-waves/waves.js"></script>

<!-- Moment Plugin Js -->
<script src="../assets/cms/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="../assets/cms/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<!-- <script src="../assets/cms/js/pages/magazine.js"></script> -->
<script>
$('.datetimepicker').bootstrapMaterialDatePicker({
    format: 'YYYY-MM-DDTHH:mm',
    clearButton: true,
    weekStart: 1
});
</script>
</body>

</html>