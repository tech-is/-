    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div>
                            <div class="header align-middle" style="margin-bottom:30px;">プロフィール設定</div> 
                                        <form id="form" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="shop_name" class="col-sm-2 control-label">名前</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="" value="<?php echo $Profile['shop_name']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="shop_kana" class="col-sm-2 control-label">フリガナ</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="shop_kana" name="shop_kana" placeholder="" value="<?php echo $Profile['shop_kana']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="shop_email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="shop_email" name="shop_email" placeholder="メールアドレス" value="<?php echo $Profile['shop_email']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="shop_tel" class="col-sm-2 control-label">電話番号</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="tel" class="form-control" id="shop_tel" name="shop_tel" placeholder="電話番号(ハイフンなし)" value="<?php echo $Profile['shop_tel']; ?>">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="shop_zip_code" class="col-sm-2 control-label">郵便番号</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="shop_zip_code" name="shop_zip_code" placeholder="郵便番号(ハイフンなし)" value="<?php echo $Profile['shop_zip_code']; ?>" pattern="\d{3}-?\d{4}">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label for="shop_address" class="col-sm-2 control-label">住所</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="shop_address" name="shop_address" placeholder="" value="<?php echo $Profile['shop_address']; ?>">
                                                    </div>
                                                </div>
                                            </div> 
                                       
                                    <!-- <div role="tabpanel" class="tab-pane fade" id="change_password_settings"> -->
                                     
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">現在のパスワード</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  placeholder="暗号処理の為、表示できません" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="shop_password" class="col-sm-3 control-label">新しいパスワード</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="shop_password" minlength="6" name="shop_password" placeholder="英数字で8文字以上">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="shop_confirm_pass" class="col-sm-3 control-label">確認用パスワード</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="shop_confirm_pass" minlength="6" name="shop_confirm_pass" placeholder="もう一度同じパスワードを入力">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn waves-effect">登録</button>
                                                </div>
                                            </div>   
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
    <!-- SweetAlert Plugin Js -->
    <!-- <script src="<?php echo base_url(); ?>assets/cms/plugins/sweetalert/sweetalert.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/cms/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/cms/js/admin.js"></script>
    <script src="<?php echo base_url();?>assets/cms/js/pages/profile/profile.js"></script>

</body>

</html>
