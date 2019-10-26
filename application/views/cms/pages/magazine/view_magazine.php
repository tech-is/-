
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
            if(isset($mail_subject)) {
                for($i = 0; $i < count($mail_subject); $i++) { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header clearfix">
                                <div class="pull-left">
                                    <h2 style="line-height: 37px"><?= $mail_subject[$i] ?></h2>
                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn bg-red waves-effect view_magazine" style="margin-right:10px;">
                                        <i class="material-icons">contact_mail</i>
                                    </button>
                                    <a href="magazine_form">
                                        <button type="button" class="btn bg-blue waves-effect">
                                            <i class="material-icons">settings</i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="body">
                                <p>From: <?= $from_name[$i] ?></p>
                                <p>< <?= $mail[$i] ?> ></p>
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
<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <div class="modalContents" id="modalContents"></div>
            <div id="closeModal" class="closeModal">
                ×
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

    <!-- Custom Plugin Js -->
    <script src="../assets/cms/js/admin.js"></script>

    <script>
    $(function () {
        $('#closeModal , #modalBg').click(function(){
            $('#modalArea').fadeOut();
        });
        $('.view_magazine').click(function() {
            $('#modalContents').load("../assets/cms/html_parts/reserve_form_parts.php?magazine_id=<?= $magazine_id?>");
            $('#modalArea').fadeIn();
        });
        $("#reserve").validate({
            rules: {
                customer: {
                    required: true,
                    maxlength: 50
                }
            },
            messages: {
                customer: {
                    required: "お名前を入力してください。",
                    maxlength: "お名前は50文字以内で入力してください。"
                },
            }
        });
    });
    </script>
    </body>

    </html>