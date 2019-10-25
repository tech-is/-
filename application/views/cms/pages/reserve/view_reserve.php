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
                                新規予約
                            </button>
                        </div>
                    </div>
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
                <table class="table table-bordered" id="datatable" style="width: 100%">
                    <thead>
                        <th>顧客ID</th>
                        <th>ペットID</th>
                        <th>顧客名</th>
                        <th>ペット名</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>グループ</th>
                    </thead>
                </table>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_customer">顧客名<span style="color: red; margin-left: 10px">必須</span> </label>
                                <input type="text" id="reserve_customer" class="form-control" placeholder="顧客名" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_pet">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="reserve_pet" class="form-control" placeholder="ペット名" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="start" class="form-control flatpickr-input" placeholder="開始日時" value="<?php echo date("Y-m-d")."T00:00" ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="text" id="end" class="form-control flatpickr-input" placeholder="開始日時" value="<?php echo date("Y-m-d")."T00:00" ?>">
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
                <input type="hidden" id="reserve_pet_id">
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

<!-- シフト入力フォーム -->
<section id="modalArea_add_shift" class="modalArea">
    <div id="modalBg_add_shift" class="modalBg"></div>
        <div class="modalWrapper_shift">
            <form id="form_shift" action="POST">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 id ="modal_shift_title" style="margin: 0px">シフト追加</h3>
                </div>
                <div class="body">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="start">担当スタッフ<span style="color: red; margin-left: 10px">必須</span></label>
                            <?php
                                if(isset($select_staff)) {
                                    echo '<select id="select_shift_staff" class="form-control show-tick" value="">';
                                    echo '<option value="">-- スタッフを選択してください --</option>';
                                    foreach($select_staff as $value) {
                                        echo "<option value={$value['staff_id']}>{$value['staff_name']}</option>";
                                    }
                                } else {
                                    echo '<select id="update_shift_staff" class="form-control show-tick" disabled value="">';
                                    echo '<option value="">スタッフが登録されていません</option>';
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="shift_start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" name="shift_start" class="form-control" placeholder="開始日時" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="shift_end">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                    <input type="text" name="shift_end" class="form-control" placeholder="終了日時" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="shift_id" id="shift_id" />
                    <div class="pull-left">
                        <?php if(isset($select_staff)){ ?>
                            <button type="submit" id="register_add_shift" class="btn btn-primary m-t-15 waves-effect">登録</button>
                        <?php } else { ?>
                            <button type="submit" id="register_add_shift" class="btn btn-primary m-t-15 waves-effect" disabled>登録</button>
                        <?php } ?>
                        <button type='submit' id='send_Update_shift' class='btn btn-primary m-t-15 waves-effect'>更新</button>
                        <button type="button" id="cancel_add_shift" class="btn btn-primary m-t-15 waves-effect" style="margin-left: 10px;">キャンセル</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" id="send_Delete_shift" class='btn btn-primary m-t-15 waves-effect'>削除</button>
                    </div>
                </div>
            </form>
        <div id="closeModal_register" class="closeModal">
            ×
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
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='<?php echo base_url(); ?>assets/cms/plugins/momentjs/moment.js'></script>

<!-- fullcalendar -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar-3.9.0/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar-3.9.0/locale-all.js"></script>

<!-- Bootstrap Core Js -->
<script src=" <?php echo base_url(); ?>assets/cms/plugins/bootstrap/js/bootstrap.js"> </script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.js"></script>

<!-- Morris Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/morrisjs/morris.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- Custom Plugin Js -->
<script>
    total = <?php echo $total?>;
    reserve = <?php echo $reserve?>;
</script>
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/sidebar.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/pages/reserve/reserve.js"></script>

</body>

</html>