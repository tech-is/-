<!-- body start -->
<section class="content">
    <div class="container-fluid">
    <!-- Body Copy -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class="pull-left">
                            <h2 class="card-inside-title" style="line-height: 30px">予約一覧</h2>
                        </div>
                        <div class="pull-right">
                            <button type="button" class="btn btn waves-effect" id="register">
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
        <div class="header clearfix" style="margin: 10px 0px">
            <h2 id="modal_title" class="pull-left" style="font-weight: bold; line-height: 37px; margin: 0px">新規予約</h2>
        </div>
        <div class="body">
            <table class="table table-bordered" id="datatable" style="width: 100%">
                <thead>
                    <th>ペットID</th>
                    <th>顧客名</th>
                    <th>ペット名</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>グループ</th>
                </thead>
            </table>
            <form id="form_reserve">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_customer">顧客名
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="reserve_customer" class="form-control" name="reserve_customer" placeholder="テーブルの行を選択してください" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_pet">ペット名
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="reserve_pet" class="form-control" name="reserve_pet" placeholder="テーブルの行を選択してください" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_start">始業日
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="reserve_start" name="reserve_start" class="form-control" placeholder="開始日時">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_time">start
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="reserve_time" name="reserve_time" class="form-control" placeholder="開始日時" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="reserve_end">終業日時
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="reserve_end" name="reserve_end" class="form-control" placeholder="終了日時">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="_reserve_time">end
                                    <span style="color: red; margin-left: 10px">必須</span>
                                </label>
                                <input type="text" id="_reserve_time" name="_reserve_time" class="form-control" placeholder="開始日時" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="color">カレンダーカラーラベル</label>
                                <input type="color" id="reserve_color" class="form-control" name="reserve_color" value="#3a87ad">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="reserve_content">予約内容</label>
                        <textarea rows=2 id="reserve_content" class="form-control no-resize" name="reserve_content" placeholder="トリミング"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reserve_id" id="reserve_id">
                <input type="hidden" name="reserve_pet_id" id="reserve_pet_id">
                <div class="pull-left">
                    <button type="submit" id="registerReserve" class="btn m-t-15 waves-effect">登録</button>
                    <button type='submit' id='updateReserve' class='btn m-t-15 waves-effect'>更新</button>
                    <button type="button" class="btn m-l-10 m-t-15 waves-effect cancel">キャンセル</button>
                </div>
                <div class="pull-right">
                    <button type="button" id="deleteReserve" class='btn m-t-15 waves-effect'>削除</button>
                </div>
            </div>
        </form>
    </div>
</section>

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

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom Plugin Js -->
<script>
    total = <?php echo $total?>;
    reserve = <?php echo $reserve?>;
</script>
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/common.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/pages/reserve/reserve.js"></script>

</body>

</html>