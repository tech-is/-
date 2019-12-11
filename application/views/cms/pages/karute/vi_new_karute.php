<!--
新規カルテ画面
-->

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card karte_wrapper">
                <div class="header text-center">
                    <h2>カルテ編集</h2>
                </div>
                <form
                    action="<?php echo base_url(); ?>Karte_history/update_karute"
                    target="" method="post">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <h4>受け付け日</h4>
                                <p><?php  echo $d_karute['karute_created_at']; ?></p>
                            </div>
                            
                                <input type="hidden" name="karute_id"
                                    value="<?php  echo $karute_id; ?>">
                            <div>
                                <p>タイトル</p>    
                                <input type="text" class="form-control" name="karute_title" placeholder="カルテタイトル" value="<?php  echo $d_karute['karute_title']; ?>" required><br>
                            </div>
                            <div>
                                <p>内 容</p>
                                <textarea class="form-control" cols="10" row="40" name="karute_comment" placeholder="カルテの内容" required><?php  echo $d_karute['karute_comment']; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="wrapper" style="margin-top: 6px">
                            <button type="submit" class="btn btn waves-effect">登録</button>
                        <a href="/Karte_history/"><input type="button" value="前へ戻る"class="btn btn waves-effect"></a>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.js"></script>


<!--ボタン効果Sweetalert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/cms/js/pages/total/total.js"></script>

</body>

</html>