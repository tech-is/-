<?php

 //$segment_3 = $this->uri->segment(3);
 // echo $segment_3;
 $flg = $this->input->get('flg', TRUE);
?>
<head>
  <!-- Custom Css -->
  <link href="../../css/style.css" rel="stylesheet">

</head>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                顧客・ペット一覧管理ページ
                <small>新規顧客・ペット一覧登録はここから</small>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>顧客・ペット一覧</h2>
                            <button id="register" type="btn" class="btn btn-primary m-t-15 waves-effect">顧客登録</button>
                            <button id="register2" type="btn" class="btn btn-primary m-t-15 waves-effect">ペット登録</button>
                        <a href="../cl_reserve/">
                            <button type="btn" class="btn btn-primary m-t-15 waves-effect">スケジュール</button>
                        </a>
                                <?php if(isset($flg)){
                                if($flg == "2"){
                                    echo "<div class=\"body\"><div class=\"alert alert-success\">登録しました</div></div>";
                                }else{
                                    echo "<div class=\"body\"><div class=\"alert alert-danger\">削除しました</div></div>";
                                }
                            }
                        ?>
                    <form action="customer_validation" method="POST">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>顧客名</th>
                                            <th>ペット名</th>
                                            <th>住所</th>
                                            <th>電話番号</th>
                                            <th>メールアドレス</th>
                                            <th>担当スタッフ</th>                                      
                                            <th>最終予約日</th>
                                            <th>設定</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // print_r($customers);
                                    for($i = 0; $i < count($customers); $i++){
                                        $customer = $customers[$i];
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td>$customer[customer_name]</td>";
                                        echo "<td>未設定ヤジロベー</td>";
                                        echo "<td>$customer[customer_address]</td>";
                                        echo "<td>$customer[customer_tel]</td>";
                                        echo "<td>$customer[customer_mail]</td>";
                                        echo "<td>未設定若林 朋</td>";
                                        echo "<td>未設定019-07-01</td>";
                                        echo "<td>";
                                        echo "<button type=\"btn\" class=\"btn btn-primary m-t-15 waves-effect\">予約</button>";
                                        echo "<button type=\"btn\" class=\"btn btn-primary m-t-15 waves-effect\">削除</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- #END# Exportable Table -->
    </div>
</section>
<!-- モーダルウィンドウ カスタマー -->
<section id="modalArea" class="modalBg">
            <div id="modalBg" class="modalArea"></div>
    <div class="modalWrapper">
            <div class="modalContents" id="modalContents"></div>
            <div id="closeModal" class="closeModal">
                ×
            </div>
            <div class="block-header">
                    <h2>顧客管理情報</h2>
            </div>
        <!-- Input -->
    <form>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            顧客管理
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">お名前（漢字）</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_name'); ?>
                                            <input type="text" class="form-control" name="customer_name" required >
                                            <label class="form-label">山田　太郎</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">フリガナ(全角カナ)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_kana'); ?>
                                            <input type="text" class="form-control" name="customer_kana" required>
                                            <label class="form-label">ヤマダ　タロウ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">メールアドレス(半角英数字)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_mail'); ?>
                                            <input type="mail" class="form-control" name="customer_mail" required>
                                            <label class="form-label">半角英数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">電話番号</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_tel'); ?>
                                            <input type="text" class="form-control" name="customer_tel"
                                                pattern="\d{2,4}-?\d{3,4}-?\d{3,4}"
                                                title="固定回線の場合は市外局番付きハイフン（-）無しでご記入ください。" required >
                                            <label class="form-label">半角数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">郵便番号</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_zip_adress'); ?>
                                            <input type="text" class="form-control" name="customer_zip_adress"
                                                pattern="\d{3}-?\d{4}" title="郵便番号は、3桁の数字、ハイフン（-）無しで、4桁の数字の順で記入してください。"
                                                required >
                                            <label class="form-label">半角数字</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">住所(全角)</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <?php echo form_error('customer_address'); ?>
                                            <input type="text" class="form-control" name="customer_address"
                                            required>
                                            <label class="form-label">(例: 東京都中央区日本橋茅場町〇〇番地〇〇マンション〇〇号)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">メールマガジン</h2>
                            <div class="switch">
                                <label>未希望
                                <input type="checkbox" id="customer_magazine" name="customer_magazine" value=1>
                                <span class="lever switch-col-red"></span>希望</label>
                            </div>
                            <h2 class="card-inside-title">追加情報</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" name="customer_add_info"
                                                placeholder="顧客に関する情報：例：夏に旅行をする"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">GROUP</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <select class="form-control show-tick" name="customer_group">
                                        <option value="gold">金</option>
                                        <option value="silver">銀</option>
                                        <option value="bronze">銅</option>
                                        <option value="black">黒</option>
                                    </select>
                                </div>
                            </div>
                            <button id="sendCustomerData" type="button" class="btn btn-primary m-t-15 waves-effect">登録</button>
                            <button type="reset" class="btn btn-primary m-t-15 waves-effect">クリア</button>
                            <button type="reset" id="C_cancel" class="btn btn-primary m-t-15 waves-effect">キャンセル</button>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </form>
<!-- #END# Input -->
</section>
<!-- モーダルウィンドウのペット -->
<section id="modalPetArea" class="modalBg">
            <div id="modalPetBg" class="modalArea"></div>
    <div class="modalWrapper">
            <div class="modalContents" id="modalPetContents"></div>
            <div id="closePetModal" class="closeModal">
                ×
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ペット登録</h2>
                            <?= isset($comment)? $comment: false; ?>
                        </div>
                        <div class="body">
                            <form>
                            <?php echo form_error('pet_name'); ?>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pet_name" required>
                                        <label class="form-label">名前</label>
                                    </div>
                                </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>写真</h2>
                                                </div>
                                                <div class="body">
                                                    <input type="file" id="files" name="" multiple />
                                                    <output id="list"></output>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pet_classification" required>
                                        <label class="form-label">分類</label>
                                    </div>
                                    <div class="help-info">犬、猫、鳥</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pet_type" required>
                                        <label class="form-label">種類</label>
                                    </div>
                                    <div class="help-info">トイ・プードル</div>
                                </div>
                            <div class="form-group form-float">
                                <label class="form-label">性別</label>
                                <div class="form-line">
                                    <input type="radio" name="pet_animal_gender" id="male" value="1" class="with-gap" checked/>
                                    <label for="male">オス</label>

                                    <input type="radio" name="pet_animal_gender" id="female" value="2" class="with-gap">
                                    <label for="female" class="m-l-20">メス</label>

                                    <input type="radio" name="pet_animal_gender" id="other" value="3" class="with-gap">
                                    <label for="other" class="m-l-20">その他</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="date">生年月日</label>
                                    <input id="date" name="pet_birthday" class="form-control" type="date">
                                </div>
                            </div>
                                <div class="form-group">
                                    <div class="form-line">
                                    <label class="with-gap">去勢</label>
                                    <input type="radio" name="pet_contraception" id="on" value= "on" class="with-gap">
                                    <label for="on">有</label>
                                    <input type="radio" name="pet_contraception" id="off" value="off" class="with-gap" checked/>
                                    <label for="off">無</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="pet_body_height" >
                                        <label class="form-label">体高</label>
                                    </div>
                                    <div class="help-info">cm</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="pet_body_weight" >
                                        <label class="form-label">体重</label>
                                    </div>
                                    <div class="help-info">kg</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="pet_information" cols="30" rows="5" class="form-control no-resize" ></textarea>
                                        <label class="form-label">備考：</label>
                                    </div>
                                </div>
                                    <input type="hidden" name="pet_customer_id" value="pet_customer_id">
                                    <button  id="sendPetData" type="button" class="btn btn-primary waves-effect">ペット登録</button>
                                    <button class="btn btn-primary waves-effect" type="reset">クリア</button>
                                    <button type="reset" id="P_cancel" class="btn btn-primary waves-effect">キャンセル</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- #END# Input -->

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

<!-- Jquery DataTable Plugin Js -->
<script src="../assets/cms/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../assets/cms/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="../assets/cms/js/demo.js"></script>

<!-- モーダルウィンドウ・顧客、ペット登録 -->
<script>
$('#register').on('click', function(){
    $('#modalArea').fadeIn();
});
$('#modalBg, #C_cancel').on('click', function(){
    $('#modalArea').fadeOut();
});


$('#register2').on('click', function(){
    $('#modalPetArea').fadeIn();
});
$('#modalPetBg, #P_cancel').on('click', function(){
    $('#modalPetArea').fadeOut();
});

// カスタマーデータ登録
$('#sendCustomerData').on('click', function(){
    let param = {
        customer_name : $("input[name='customer_name']").val(),
        customer_kana : $("input[name='customer_kana']").val(),
        customer_mail : $("input[name='customer_mail']").val(),
        customer_tel : $("input[name='customer_tel']").val(),
        customer_zip_adress : $("input[name='customer_zip_adress']").val(),
        customer_address : $("input[name='customer_address']").val(),
        customer_magazine : $("[name='customer_magazine']:checked").val(),
        customer_add_info : $("textarea[name='customer_add_info']").val(),
        customer_group : $("select[name='customer_group']").val()
    }
    $.ajax({
        url: '../Cl_customer/customer_validation',
        type: 'POST',
        data: param
    })
    .done(function(data, textStatus, jqXHR) {
        // alert("success!");
        console.log(data);
    })
    .fail(function(data, textStatus, errorThrown) {
        console.log(data);
    })
});
// ペットデータ登録

$('#sendPetData').on('click', function(){
    let param = {
        pet_name : $("input[name='pet_name']").val(),
        customer_kana : $("input[name='customer_kana']").val(),
        customer_mail : $("input[name='customer_mail']").val(),
        customer_tel : $("input[name='customer_tel']").val(),
        customer_zip_adress : $("input[name='customer_zip_adress']").val(),
        customer_address : $("input[name='customer_address']").val(),
        customer_magazine : $("[name='customer_magazine']:checked").val(),
        customer_add_info : $("textarea[name='customer_add_info']").val(),
        customer_group : $("select[name='customer_group']").val()
    }
    $.ajax({
        url: '../Cl_pet_info/pet_info_validation',
        type: 'POST',
        data: param
    })
    .done(function(data, textStatus, jqXHR) {
        // alert("success!");
        console.log(data);
    })
    .fail(function(data, textStatus, errorThrown) {
        console.log(data);
    })
});

</script>
</body>

</html>