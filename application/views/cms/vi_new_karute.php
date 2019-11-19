<!--
新規カルテ画面
-->

<section class="content">
<div class="container-fluid">
    <div class="row clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card karte_wrapper">
                <div class="header text-center">
                    <h2>カルテ新規登録</h2>
                </div>
                <form action="../../cl_rireki_karute/update_karute/"  target="" method="post">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4>受け付け日</h4>
                                    <div class="form-line">
                                        <?php print_r($r_karute); ?>
                                    <p><input type="text" name="karute_create_at"value="<?php  echo $r_karute["karute_created_at"]; ?>"></p>
                                </div>
                            </div>
                        </div>
                        <div>
                                <input type="text" class="form-control" name="karute_title" placeholder="カルテタイトル">
                           </div>
                               <div>
                                <input type="text" class="form-control" row= "40" name="karute_title" placeholder="カルテの内容">
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