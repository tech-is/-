<!--
個人カルテ一覧履歴
-->
<section class="content ">
<?php  for ($i = 0; $i < count($r_karute); $i++):
        $disply = $r_karute[$i]; ?>
         <!-- Changelogs -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header align-middle">                      
                            <h2>カルテ一覧</h2>
                            <small><?php echo $disply['karute_update_at'] ?></small>
                            <div class="pull-right">
                            <button class="btn btn-primary waves-effect" style="margin-left:10px; "><a href="/Karte_history/delete_karute/?karute_id=<?php echo $disply['karute_id'] ?>" style="color:#ffffff;">消去</a></button>
                            <button class="btn btn-primary waves-effect"><a href="/Karte_history/?karute_id=<?php echo $disply['karute_id'] ?>" class="card-link" style="color:#ffffff;">カルテ内容修正</a></button>
                            <button class="btn btn-primary waves-effect"><a href="<?php echo base_url(); ?>total_list" class="card-link" style="color:#ffffff;">顧客情報修正</a></button>
                            </div>
                        </div>
                        <div class="body" style ="font-size: 18px;">
                        <div>
                            <p>顧  客  名    :   <?php echo $disply['customer_name'] ?></p>
                            <p>カルテタイトル :  <?php echo $disply['karute_title'] ?></p>
                            <p>カルテ内容     :  <?php echo $disply['karute_comment'] ?></p>
                        </div>
                       
                        </div>
                    </div>
                </div>
            </div>
<?php endfor; ?>
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