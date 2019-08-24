<section class="content">
    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="POST" action="#">
                        <div class="header clearfix">
                            <h2 class="pull-left" style="font-weight: bold; line-height: 37px">新規作成</h2>
                            <div class="pull-right">
                                <button type="button" class="btn bg-pink waves-effect"
                                    onclick="window.open('magazine', '_self')">
                                    <i class="material-icons">cancel</i>
                                    <span>cancel</span>
                                </button>
                                <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px"
                                    onclick="return confirm_form()">
                                    <i class=" material-icons">save</i>
                                    <span>SAVE</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">メールヘッダー</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="template_name">テンプレート名</label>
                                    <input type="text" class="form-control" name="template_name" placeholder="例: 休業のお知らせ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="from_name">差出人</label>
                                    <input type="text" class="form-control" name="from_name" placeholder="例: 株式会社Animarl">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="mail_subject">件名</label>
                                    <input type="text" class="form-control" name="mail_subject" placeholder="例: 短期休業のお知らせ">
                                </div>
                            </div>
                            <h2 class="card-inside-title">メール本文</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="6" class="form-control no-resize" placeholder="メール本文を入力してください"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

<!-- Custom Js -->
<script src="../assets/cms/js/admin.js"></script>
<script src="../assets/cms/js/pages/magazine.js"></script>

</body>

</html>