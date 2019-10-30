<!--
待ち受け画面
-->

<section class="content">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <form action="" method="">
                    <h2>顧客ID</h2>
                    <button id="register" type="btn" class="btn btn-primary m-t-15 waves-effect">顧客登録</button>
                    <button id="register3" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>予約登録</button>
                    <button id="register4" type="btn" class="btn btn-primary m-t-15 waves-effect" disabled>顧客更新</button>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><b>グループ登録</b></p>
                            <div class="form-group" style="display:inline-flex;">
                                <div class="form-line" style="margin-right: 10px">
                                    <input type="text" class="form-control" name="kind_group_name" id="select_group" placeholder="例：金・銀・銅">
                                    <label class="form-label"></label>
                                </div>
                                <div class="wrapper" style="margin-top: 6px">
                                    <button id="group_register" type="button" class="btn btn-primary waves-effect">登録</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p><b>グループ削除</b></p>
                            <div class="form-group" style="display:inline-flex">
                                <div class="wrapper" style="width: 100%; margin-right: 10px">
                                    <select name="" id="select_1" class="form-control show-tick">
                                        <?php foreach ($groups as $group) : ?>
                                            <option value="<?php echo $group["kind_group_id"]; ?>"><?php echo $group["kind_group_name"]; ?></option>"
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="wrapper" style="margin-top: 6px">
                                    <button id="delete_group_register" type="button" class="btn btn-primary waves-effect">削除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>ペットID</th>
                                    <th>顧客名</th>
                                    <th>ペット名</th>
                                    <th>電話番号</th>
                                    <th>メールアドレス</th>
                                    <th>グループ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($list); $i++) {
                                    $disply = $list[$i];
                                    echo "<tr>";
                                    echo "<td>$disply[pet_id]</td>";
                                    echo "<td>$disply[customer_name]</td>";
                                    echo "<td>$disply[pet_name]</td>";
                                    echo "<td>$disply[customer_tel]</td>";
                                    echo "<td>$disply[customer_mail]</td>";
                                    echo isset($disply["kind_group_name"]) ? "<td>$disply[kind_group_name]</td>" : "<td></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        </form>
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


<!--ボタン効果Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/total/total.js"></script>

</body>

</html>