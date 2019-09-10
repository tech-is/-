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
                        <h2>顧客一覧</h2>
                        <a href="../cl_customer/">
                            <button type="btn" class="btn btn-primary m-t-15 waves-effect">新規登録</button>
                        </a>
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
                                    print_r($customers);
                                    for($i = 0; $i < count($customers); $i++){
                                        $customer = $customers[$i];
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td>カリン様</td>";
                                        echo "<td>ヤジロベー</td>";
                                        echo "<td>カリン塔1-1</td>";
                                        echo "<td>080-0000-1111</td>";
                                        echo "<td>karin@karintower.com</td>";
                                        echo "<td>若林 朋</td>";
                                        echo "<td>2019-07-01</td>";
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
</body>

</html>