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

<!-- スタッフ一覧テーブル -->
<section id="modalArea_staff_list" class="modalArea">
    <div id="modalBg_staff_list" class="modalBg"></div>
        <div class="modalWrapper_staff_list">
        <table class="table table-striped table-bordered" id="datatable" >
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>備考</th>
                <!-- <th>更新日時</th>
                <th>作成日時</th> -->
            </tr>
        </thead>
        </table>
        <div>
            <hr>
            <div class="pull-left">
                <button id="registButton" type="button" class="btn btn-primary">登録</button>
                <button id="updateButton" type="button" class="btn btn-success" disabled>更新</button>
            </div>
            <div class="pull-right">
                <button id="deleteButton" type="button" class="btn btn-danger" disabled>削除</button>
            </div>
        </div>
        <!-- <div id="closeModal_register" class="closeModal">
            ×
        </div> -->
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
    <div class="modalWrapper_event">
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

<!--  -->
<div id="form" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="dialogTitle" class="modal-title">登録</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">No</label>
                                        <span class="label label-danger pull-right">必須</span>
                                    </div>
                                    <div class="input-group col-sm-2">
                                        <input type="text" class="form-control ime-disabled" id="inputNo" placeholder="No" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">名前</label>
                                        <span class="label label-danger pull-right">必須</span>
                                    </div>
                                    <div class="input-group col-sm-2">
                                        <input type="text" class="form-control" id="inputName" placeholder="名前" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">性別</label>
                                        <span class="label label-danger pull-right">必須</span>
                                    </div>
                                    <div class="input-group col-sm-2">
                                        <input type="text" class="form-control" id="inputSex" placeholder="性別">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">年齢</label>
                                        <span class="label label-danger pull-right">必須</span>
                                    </div>
                                    <div class="input-group col-sm-2">
                                        <input type="text" class="form-control ime-disabled" id="inputAge" placeholder="年齢">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">種別</label>
                                        <span class="label label-danger pull-right">必須</span>
                                    </div>
                                    <div class="input-group col-sm-7">
                                        <select id="inputKind" class="form-control" >
                                            <option value="01">キジトラ</option>
                                            <option value="02">長毛種（不明）</option>
                                            <option value="03">ミケ（っぽい）</option>
                                            <option value="04">サビ</option>
                                            <option value="09">その他</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-sm-4">
                                        <label class="control-label">好物</label>
                                        <span class="label label-success pull-right">任意</span>
                                    </div>
                                    <div class="input-group col-sm-7">
                                        <input type="text" class="form-control" id="inputFavorite" placeholder="好物">
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="inputError" class="pull-left" style="color:red; padding:5px;"></div>
                <button id="sendRegistButton" type="button" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;登録</button>
                <button id="sendUpdateButton" type="button" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;修正</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;閉じる</button>
            </div>
        </div>
    </div>
</div>
<!--  -->

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
<script src="../assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js"></script>

<!-- Custom Plugin Js -->
<script src="../assets/cms/js/admin.js"></script>

<script src="../assets/cms/js/sidebar.js"></script>

<script>
    var event_json = <?= json_encode($events, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);?>;
</script>

<script src="../assets/cms/js/pages/staff/staff_list.js"></script>
<!-- <script src="../assets/cms/js/pages/staff/staff_table.js"></script> -->

<script>
var json_data =  [
    {
        "id": "1",
        "name": "あいうえお",
        "detail": "かきくけこ"
    },
    {
        "id": "2",
        "name": "あいうえお",
        "detail": "かきくけこ"
    }
];
</script>

<script src="../assets/cms/js/pages/staff/staff_table.js"></script>

</body>

</html>