<!--
バーコード印刷画面
-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<section class="content">
    <!-- <div class="container-fluid">
        <div class="row clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card karte_wrapper">
                <div class="header text-center"> -->
    <div style="margin: 10%;">
        <h2 class="text-center">バーコード生成</h2>
        <form class="form-horizontal" method="post" action="php_barcode-master/barcode.php" target="_blank">
            <div class="form-group">
                <label class="control-label col-sm-2" for="product">名前:</label>
                <div class="col-sm-10">
                    <input autocomplete="OFF" type="text" class="form-control" id="product" name="product">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="product_id">バーコード番号入力:</label>
                <div class="col-sm-10">
                    <input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id"
                        value="<?php echo time(); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="rate">価格</label>
                <div class="col-sm-10">
                    <input autocomplete="OFF" type="text" class="form-control" id="rate" name="rate">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="print_qty">バーコード作成数</label>
                <div class="col-sm-10">
                    <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty" name="print_qty">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">作成</button>
                </div>
            </div>
        </form>
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