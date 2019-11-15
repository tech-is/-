<!--
待ち受け画面
-->

<section class="content">
<div class="container-fluid">
    <div class="row clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card karte_wrapper">
                <div class="header text-center">
                    <h2>受付画面</h2>
                </div>
                <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <b><h4>顧客ID検索</h4></b>
                                <p><?php  echo $karute["customer_id"]; ?></p>
                                <b><h4>顧客名</b></h4>
                                <h6><?php  echo $karute["customer_kana"]; ?></h6>
                                <p><?php  echo $karute["customer_name"]; ?></p>
                                <b><h4>電話番号</b></h4>
                                <p><?php  echo $karute["customer_tel"]; ?></p>
                                <b><h4>郵便番号</b></h4>
                                <p><?php  echo $karute["customer_zip_adress"]; ?></p>
                                <b><h4>住所</b></h4>
                                <p><?php  echo $karute["customer_address"]; ?></p>
                                <b><h4>メールアドレス</b></h4>
                                <p><?php  echo $karute["customer_mail"]; ?></p>
                                <b><h4>メールマガジン</b></h4>
                                <p><?php  echo $karute["customer_magazine"]; ?></p>
                                <b><h4>グループ</b></h4>
                                <p><?php  echo $karute["kind_group_name"]; ?></p>
                                <b><h4>最新予約日</b></h4>
                                <p><?php  echo $karute["reserve_update_at"]; ?></p>
                                <b><h4>担当スタッフ</b></h4>
                                <p><?php  echo $karute["staff_name"]; ?></p>
                            </div>
                            <div class="col-sm-6">
                                <b><h4>ペット名</b></h4>
                                <p><?php  echo $karute["pet_name"]; ?></p>
                                <b><h4>写真</b></h4>
                                <p><?php  echo $karute["pet_img"]; ?></p>
                                <b><h4>分類</b></h4>
                                <p><?php  echo $karute["pet_classification"]; ?></p>
                                <b><h4>種類</b></h4>
                                <p><?php  echo $karute["pet_type"]; ?></p>
                                <b><h4>性別</b></h4>
                                <p><?php  if($karute["pet_animal_gender"] === 1 ){echo 'オス';}else if($karute["pet_animal_gender"] === 2){echo 'メス';}else{ echo 'その他';} ?></p>
                                <b><h4>去勢</b></h4>
                                <p><?php  echo $karute["pet_contraception"] == 1 ? '有' : '無し'; ?></p>
                                <b><h4>体高</b></h4>
                                <p><?php  echo $karute["pet_body_height"]; ?></p>
                                <b><h4>体重</b></h4>
                                <p><?php  echo $karute["pet_body_weight"]; ?></p>
                                <b><h4>誕生日</b></h4>
                                <p><?php  echo $karute["pet_birthday"]; ?></p>
                                <b><h4>ペット情報</b></h4>
                                <p><?php  echo $karute["pet_information"]; ?></p>
                                <b><h4>ペット登録日</b></h4>
                                <p><?php  echo $karute["pet_created_at"]; ?></p>
                                <b><h4>ペット更新日時</b></h4>
                                <p><?php  echo $karute["pet_update_at"]; ?></p>
                                <input type="button" value="前に戻る" onclick="history.back(-1)">
                            </div>
                        </div>
                    </div>
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