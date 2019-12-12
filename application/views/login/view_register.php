<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo @$_SESSION["token"]?:false; ?>">
    <title>Animerl</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url();?>assets/cms/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/cms/css/style.css" rel="stylesheet" />
</head>

<body class="signup-page" style="max-width: 50%;">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Animarl</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up">
                    <div class="msg">新規本登録画面</div>
                        <label>名前</label>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_name[0]" placeholder="姓" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_name[1]" placeholder="名">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="kana">フリガナ</label>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_kana[0]" placeholder="カナ姓" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_kana[1]" placeholder="カナ名">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="mail">メールアドレス</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="mail" class="form-control" name="shop_email" placeholder="メールアドレス" value="<?php echo $tmp_shop_email ?>" disabled>
                            </div>
                        </div>
                        <label for="tel">電話番号</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" name="shop_tel" placeholder="電話番号(ハイフンなし)">
                            </div>
                        </div>
                        <label for="zip_code">郵便番号</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" name="shop_zip_code" placeholder="郵便番号(ハイフンなし)">
                            </div>
                        </div>
                        <label for="zip_address">住所</label>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_zip_address[0]" placeholder="都道府県">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_zip_address[1]" placeholder="市町村">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="shop_zip_address[2]" placeholder="町域名">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="password">パスワード</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" name="shop_password" minlength="7" placeholder="半角英数字で8文字以上">
                            </div>
                        </div>
                        <label for="confirm_pass">確認用パスワード</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" name="shop_confirm_pass" minlength="7" placeholder="もう一度同じパスワードを入力">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                            <label for="terms"><a href="javascript:void(0);">利用規約</a>に同意します</label>
                        </div>
                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>
                        <div class="m-t-25 m-b--5 align-center">
                            <a href="login">既にアカウントを持っている場合</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url();?>assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- sweetalert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/cms/js/admin.js"></script>
    <script src="<?php echo base_url();?>assets/cms/js/pages/register/register.js"></script>


</body>

</html>