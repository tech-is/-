<!--
待ち受け画面
-->

<?php  for ($i = 0; $i < count($r_karute); $i++):
        $disply = $r_karute[$i]; ?>
<section class="content">
     <!-- Changelogs -->
     <div class="block-header">
                <h2>履歴一覧</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                カルテ一覧
                                <small>30th October 2018</small>
                            </h2>
                        </div>
                        <div class="body" style ="font-size: 18px;">
                        <div>
                            <p>顧  客  名    :   <?php echo $disply['customer_name'] ?></p>
                            <p>カルテタイトル :  <?php echo $disply['karute_title'] ?></p>
                            <p>カルテ内容     :  <?php echo $disply['karute_comment'] ?></p>
                            <!-- <p><?php// echo $disply['karute_created_at'] ?></p> -->
                            <!-- <p><?php //echo $disply['karute_update_at'] ?></p> -->
                        </div>
                        <div>
                            <button><a href="/Karte_history/delete_karute/?karute_id=<?php echo $disply['karute_id'] ?>" class="card-link">消去</a></button><br>
                            <button><a href="/Karte_history/?karute_id=<?php echo $disply['karute_id'] ?>" class="card-link">カルテ内容修正</a></button><br>
                            <button><a href="<?php echo base_url(); ?>cl_total_list" class="card-link">顧客情報修正</a></button><br>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
<?php endfor; ?>
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