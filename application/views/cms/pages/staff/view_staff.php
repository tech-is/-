<!-- body start -->
<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 30px">スタッフ管理</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn bg-black waves-effect waves-light" id="staff_list">
                                スタッフ一覧
                            </button>
                        </div>
                    </div>
                    <div id="calendar" style="padding: 10px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- シフト入力フォーム -->

<!-- スタッフ一覧テーブル -->
<section id="modalArea_staffForm" class="modalArea">
    <div id="modalBg_staff_list" class="modalBg"></div>
    <div class="modalWrapper_staff_list">
        <h3>スタッフ一覧</h3>
        <table id="datatable" class="table table-bordered table-striped table-hover dataTable" style="min-width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>カラーラベル</th>
                    <th>備考</th>
                </tr>
            </thead>
        </table>
        <div class="pull-left">
            <button id="registButton" type="button" class="btn bg-black m-t-15 waves-effect waves-light">スタッフ追加</button>
            <button id="updateButton" type="button" class="btn bg-black m-t-15 m-l-10 waves-effect waves-light" disabled>更新</button>
        </div>
        <div class="pull-right">
            <button id="deleteButton" type="button" class="btn bg-black m-t-15 waves-effect waves-effect waves-light" disabled>削除</button>
        </div>
        <div class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- シフト入力フォーム -->
<section id="modalAreaShift" class="modalArea">
    <div id="modalBg_add_shift" class="modalBg"></div>
        <div class="modalWrapper_shift">
            <form id="form_shift" action="POST">
                <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                    <h3 id ="modalShiftTitle" style="margin: 0px">シフト追加</h3>
                </div>
                <div class="body">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="start">担当スタッフ<span style="color: red; margin-left: 10px">必須</span></label>
                            <?php
                                if (!empty($staff)) {
                                        echo '<select id="staff" name="staff" class="form-control show-tick">';
                                        echo '<option value=0>スタッフを選択してください</option>';
                                    foreach ($staff as $value) {
                                        echo "<option value={$value['staff_id']}>{$value['staff_name']}</option>";
                                    }
                                } else {
                                    echo '<select id="staff" class="form-control" disabled>';
                                    echo '<option value=0>スタッフが登録されていません</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="shift_start">始業日
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="shift_start" name="shift_start" class="form-control" placeholder="開始日時">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="shift_time">start
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="shift_time" name="shift_time" class="form-control flatpickr-input" placeholder="開始日時" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="shift_end">終業日時
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="shift_end" name="shift_end" class="form-control" placeholder="終了日時">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="_shift_time">end
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="_shift_time" name="_shift_time" class="form-control flatpickr-input" placeholder="開始日時" readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="shift_id" id="shift_id" />
                <div class="pull-left">
                        <button type="submit" id="registerShift" class="btn bg-black m-t-15 waves-effect waves-light" <?php echo !empty($staff)? "": "disabled" ?>>
                            登録
                        </button>
                    <button type='submit' id='updateShift' class='btn bg-black m-t-15 waves-effect waves-light'>更新</button>
                    <button type="button" class="btn bg-black m-l-10 m-t-15 waves-effect waves-light">キャンセル</button>
                </div>
                <div class="pull-right">
                    <button type="button" id="deleteShift" class='btn bg-black m-t-15 waves-effect waves-light'>削除</button>
                </div>
            </div>
        </form>
        <div id="closeModal_register" class="closeModal">
            ×
        </div>
    </div>
</section>

<!-- スタッフ入力フォーム -->
<section id="modalAreaStaff" class="modalArea_shift">
    <div id="modalBg_add_staff" class="modalBg"></div>
    <div class="modalWrapper_shift">
        <form id="form_staff">
            <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                <h3 id="dialogTitle" style="margin: 0px">スタッフ追加</h3>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="staff_name">従業員名
                            <span style="color: red; margin-left: 10px">必須</span>
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="staffFamilyName" name="staffFamilyName" placeholder="姓名">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="staffFirstName" name="staffFirstName" placeholder="名前">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="staff_name">電話番号
                            <span style="color: red; margin-left: 10px">必須</span>
                        </label>
                        <input type="text" class="form-control" id="staff_tel" name="staff_tel" placeholder="ハイフンなし" maxlength="11">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="staff_name">メールアドレス
                            <span style="color: red; margin-left: 10px">必須</span>
                        </label>
                        <input type="text" class="form-control" id="staff_email" name="staff_email" placeholder="...@...">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line focused">
                        <label for="staff_color">シフト用カラーラベル<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="color" class="form-control" id="staff_color" name="staff_color" value="#0080ff">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="staff_content">備考<span style="color: red; margin-left: 10px"></span></label>
                        <textarea rows="4" class="form-control no-resize" id="staff_remarks" name="staff_remarks"></textarea>
                    </div>
                </div>
                <input type="hidden" id="staff_id">
                <div class="form-group">
                    <button type="submit" id="sendRegister" class="btn m-t-15 waves-effect">
                        登録
                    </button>
                    <button type="submit" id="sendUpdate" class="btn m-t-15 waves-effect" style="display: none;">
                        更新
                    </button>
                    <button type="button" class="btn m-l-10 m-t-15 waves-effect cancel">
                        キャンセル
                    </button>
                </div>
            </div>
        </form>
        <div class="closeModal">
            ×
        </div>
    </div>
</section>
<!-- END -->
</div>

<!-- モーダルエリアここまで -->

<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- moment js -->
<script src='<?php echo base_url(); ?>assets/cms/plugins/momentjs/moment.js'></script>

<!-- fullcalendar -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/fullcalendar/locale-all.js"></script>

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

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>

<script>
    staff_json = <?php echo $staff_json ?>;
    event_json = <?php echo $shift ?>;
</script>

<script src="<?php echo base_url(); ?>assets/cms/js/common.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/pages/staff/staff.js"></script>

</body>

</html>