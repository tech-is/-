<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Animarl</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="<?php echo @$_SESSION["token"]?:false; ?>">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/cms/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>assets/cms/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>assets/cms/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/cms/css/style.css" rel="stylesheet">
</head>


<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Animarl</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" method="POST">
                    <div class="msg">
                        新しいパスワードを入力してください
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <!-- <input type="email" class="form-control" name="email" placeholder="Email" required autofocus> -->
                            <input type="text" class="form-control" id="login-email" placeholder="Email" autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <!-- <input type="password" class="form-control" name="password" placeholder="Password" required> -->
                            <input type="password" class="form-control" id="login-password" placeholder="Password">
                        </div>
                    </div>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET MY PASSWORD</button>
                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="<?php echo base_url(); ?>login">ログイン</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../../assets/cms/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/cms/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../../assets/cms/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/cms/js/admin.js"></script>
    <script src="../../assets/cms/js/pages/examples/forgot-password.js"></script>
</body>

</html>