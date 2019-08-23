<?php
function escape_mail_detail($mail_detail) {
    $esc_mail_detail = str_replace("<br>", " ", $mail_detail);
    if(mb_strlen($esc_mail_detail) > 20) {
        $resize_mail_detail = mb_substr($esc_mail_detail, 0, 20);
            return $resize_mail_detail. "･･･" ;
        } else {
            return $esc_mail_detail;
    }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header clearfix">
                        <div class ="pull-left">
                            <h2 style="line-height: 37px; margin-left:10px;">メールテンプレート</h2>
                        </div>
                        <div class="pull-right">
                            <a href="magazine_new_form">
                                <button type="button" class="btn bg-deep-purple waves-effect" style="margin-right:10px;">
                                    <i class="material-icons">edit</i>
                                    <span>new</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(isset($template_name)) {
                for($i = 0; $i < count($template_name); $i++) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header clearfix">
                                <div class="pull-left">
                                    <h2 style="line-height: 37px"><?= $template_name[$i] ?></h2>
                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn bg-deep-purple waves-effect" style="margin-right:30px;" onclick="window.open('magazine_send', '_self')">
                                        <i class="material-icons">contact_mail</i>
                                    </button>
                                    <a href="magazine_form">
                                        <button type="button" class="btn bg-deep-purple waves-effect" style="margin-right:10px;">
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
                                <p><?= escape_mail_detail($mail_detail[$i]) ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } else { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>テンプレートがありません。テンプレートを新規作成してください</h2>
                            </div>
                        </div>
                    </div>
            <?php } ?>
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

    <script src="../assets/cms/js/admin.js"></script>

    <script src="../assets/cms/js/pages/magazine.js"></script>
    </body>

    </html>