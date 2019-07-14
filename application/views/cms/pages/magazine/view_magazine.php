<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>メールテンプレート一覧</h2>
                    </div>
                </div>
            </div>
            <?php
            if(isset($template_name)) {
                for($i = 0; $i < count($template_name); $i++) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header row clearfix">
                                <div class="col-lg-6">
                                    <h2><?= $template_name[$i] ?></h2>
                                </div>
                                <div class="pull-right">
                                    <a href="magazine_form">
                                        <button type="button" class="btn bg-deep-purple waves-effect">
                                            <i class="material-icons">settings</i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="body">
                                <p>From: <?= $from_name[$i] ?></p>
                                <p>< <?= $mail[$i] ?> ></p>
                                <p>件名:<?= $mail_subject[$i] ?></p>
                                <p>本文:</p>
                                <p><?= $mail_detail[$i] ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } else { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2><?= $template_name[$i] ?></h2>
                                <p style="text-align: right">
                                <a href="magazine_form">
                                    <button type="button" class="btn bg-deep-purple waves-effect">
                                        <i class="material-icons">settings</i>
                                        <span>SETTINGS</span>
                                    </button>
                                </p></a>
                            </div>
                            <div class="body">
                                <p>From: <?= $from_name[$i] ?> < <?= $mail[$i] ?> ></p>
                                <p>件名:<?= $mail_subject[$i] ?></p>
                                <p>本文</p>
                                <p><?= $mail_detail[$i] ?></p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

    <!-- Jquery Core Js -->
    <script src="../../assets/cms/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../assets/cms/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../assets/cms/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../assets/cms/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/cms/plugins/node-waves/waves.js"></script>

    <!-- Ckeditor -->
    <!-- <script src="../../assets/cms/plugins/ckeditor/ckeditor.js"></script> -->

    <!-- TinyMCE -->
    <!-- <script src="../../assets/cms/plugins/tinymce/tinymce.js"></script> -->

    <!-- Custom Js -->
    <script src="../../assets/cms/js/admin.js"></script>
    <script src="../../assets/cms/js/pages/magazine.js"></script>

    <!-- Demo Js -->
    <!-- <script src="../../assets/cms/js/demo.js"></script> -->
    </body>

    </html>