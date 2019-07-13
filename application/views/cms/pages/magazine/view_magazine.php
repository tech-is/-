<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="display: inline; clear: both;">メールマガジンテンプレート一覧
                            <a href="magazine_form">
                                <button type="button" class="btn bg-deep-purple waves-effect">
                                    <i class="material-icons">edit</i>
                                    <span>NEW</span>
                                </button>
                            </a>
                        </h2>
                    </div>
                </div>
                <!-- magazine template body  -->
                <?php
                    if(isset($template_name)) {
                        for($i = 0; $i < count($template_name); $i++) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="card">
                                    <div class="header">
                                        <h2 style="display: inline"><?= $template_name[$i] ?>
                                            <a href="magazine_form">
                                                <button type="button" class="btn bg-deep-purple waves-effect">
                                                    <i class="material-icons">settings</i>
                                                    <span>SETTINGS</span>
                                                </button>
                                            </a>
                                            <a href="magazine_delete">
                                                <button type="button" class="btn bg-pink waves-effect">
                                                    <i class="material-icons">delete</i>
                                                    <span>DELETE</span>
                                                </button>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <p>From: <?= $from_name[$i] ?> < <?= $mail[$i] ?> ></p>
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
    <!-- <script src="../../assets/cms/js/pages/forms/editors.js"></script> -->

    <!-- Demo Js -->
    <script src="../../assets/cms/js/demo.js"></script>
    </body>

    </html>