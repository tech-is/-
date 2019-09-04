$('#datatable').DataTable({
    // 'paging': true,
    // 'pageLength': 5,
    'lengthChange': true,
    'searching': true,
    // 'ordering': true,
    // 'info': true,
    // 'autoWidth': false,
    // "scrollCollapse": true,
    // 'scrollX'     : true,
    // 'scrollY'     : '185px',
    // 'tabIndex': -1,
    // 'order': [[0, 'asc']],
    // 'colReorder': true,
    // 'serverSide'  : false,
    // 'ajax'        : {
    //     'url'  : '/init',
    //     'type' : 'POST',
    //     'data' : function ( d ) {
    //         d.searchName = $("#searchName").val();
    //     }
    // },
    'data': table_json,
    'columns': [
        { 'data': "staff_id" },
        { 'data': "staff_name"},
        { 'data': "staff_color"},
        { 'data': "staff_remarks" },
        { 'data': "staff_created_at" },
        { 'data': "staff_updated_at"}
        // { 'data': 'detail', width: 40 }
    ],
    columnDefs: [
        {
            targets: 2,
            render: function (data, type, full, meta) {
                return "<div style='background-color:" + data + "; width: 150px; height: 50px'></div>";
            }
        },
        {   
            targets: 3,
            'width': '20%',
            // render: function (data, type, full, meta) {
            //     return "<div class='line-break width-200'>"+ data + "</div>";
            // },    
        }
    ],
    'language': {
        'decimal': ".",
        'emptyTable': "表示するデータがありません。",
        'info': "_START_ ～ _END_ / _TOTAL_ 件中",
        'infoEmpty': "0 ～ 0 / 0 件",
        'infoFiltered': "(合計 _MAX_ 件からフィルタリングしています)",
        'infoPostFix': "",
        'thousands': ",",
        'lengthMenu': "1ページ _MENU_ 件を表示する",
        'loadingRecords': "読み込み中...",
        'processing': "処理中...",
        'search': "絞り込み:",
        'zeroRecords': "一致するデータが見つかりません。",
        'paginate': {
            'first': "最初",
            'last': "最後",
            'next': "次",
            'previous': "前"
        }
    }
});

// テーブル行クリックの設定
$('#datatable tbody').on("click", "tr", function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        var owner = $(this);
        $("#datatable tr").removeClass("active");
        owner.addClass("active");
        $("#updateButton").prop("disabled", false);
        $("#deleteButton").prop("disabled", false);
    }
});

// 検索ボタンクリック時の処理
$("#searchButton").on("click", function () {
    $('#myTable').DataTable().ajax.url("/search").load();
    $('#myTable').DataTable().ajax.reload();
});

//
$("#registButton").on("click", function (e) {
    // ダイアログ表示
    // $('#form').on('show.bs.modal', function (event) {
    // $('#form').on('click', function () {
        // コントロール制御
        // $("#form #dialogTitle").text("新規登録");
        // $("#form #sendRegistButton").show();
        // $("#form #sendUpdateButton").hide();
        // $("#form #inputNo").prop("disabled", true);
        // フォーカス
        // setTimeout(function () {
        //     $("#inputNo").focus();
        // }, 500);
        
        $('#modalArea_add_staff').fadeIn();
    // })
    // .modal("show");
});

$("#sendRegistButton").on("click", function () {
    $.ajax({
        url: "../cl_staff/register_staff",
        type: "POST",
        data: {
            staff_name: $("input[name='staff_name[0]']").val() + $("input[name= 'staff_name[1]']").val(),
            staff_color: $("input[name='staff_color']").val(),
            staff_remarks: $("textarea[name='staff_remarks']").val()
        },
        success: function (data) {
            console.log(data);
            // jsonResponse = jsonResponse.replace(/\\/g, "");
            // var data = JSON.parse(jsonResponse);
            // テーブル更新
            // $('#myTable').DataTable().ajax.url("/search").load();
            $('datatable').DataTable().ajax.reload();
            // フォームを閉じる
            $("#form").modal("hide");
        },
        error: function () {
        }
    });
});

$("#updateButton").on("click", function () {

    var selectedRows = $('#datatable').DataTable().rows('.active').data();

    var param = {
        no: selectedRows[0].no
    }

    $.ajax({
        url: "../cl_staff/register_staff",
        type: "POST",
        data: JSON.stringify(param),
        success: function(data) {
            // var data = JSON.parse(jsonResponse);
        var cat = data[0];

    // ダイアログ表示
        $('#form').on('show.bs.modal', function (event) {

        // 取得したデータのセット
        $("#inputNo").val(cat.no);
        $("#inputName").val(cat.name);
        $("#inputSex").val(cat.sex);
        $("#inputAge").val(cat.age);
        $("#inputKind").val(cat.kind_cd);
        $("#inputFavorite").val(cat.favorite);

        // コントロール制御
        $("#form #dialogTitle").text("更新");
        $("#form #sendRegistButton").hide();
        $("#form #sendUpdateButton").show();
        $("#form #inputNo").prop("disabled", true);
        setTimeout(function () {
            $("#inputName").focus();
        }, 500);

    }).modal("show");

    // },
    // error: function() {
    // }
    }
    });
});

$("#sendUpdateButton").on("click", function () {
    var param = {
        no: $("#inputNo").val()
        , name: $("#inputName").val()
        , sex: $("#inputSex").val()
        , age: $("#inputAge").val()
        , kind_cd: $("#inputKind").val()
        , favorite: $("#inputFavorite").val()
    }

    $.ajax({
        url: "http://localhost:8080/update",
        type: "POST",
        data: JSON.stringify(param),
        success: function (jsonResponse) {
            jsonResponse = jsonResponse.replace(/\\/g, "");
            var data = JSON.parse(jsonResponse);

            // テーブル更新
            // $('#myTable').DataTable().ajax.url("/search").load();
            // $('#myTable').DataTable().ajax.reload();

            // // フォームを閉じる
            // $("#form").modal("hide");
        },
        error: function () {
        }
    });
});

$("#deleteButton").on("click", function () {
    var selectedRows = $('#datatable').DataTable().rows('.active').data();

    var param = {
        no: selectedRows[0].no
    }

    $.ajax({
        url: "http://localhost:8080/delete",
        type: "POST",
        data: JSON.stringify(param),
        success: function (jsonResponse) {
            // テーブル更新
            $('#myTable').DataTable().ajax.url("/search").load();
            $('#myTable').DataTable().ajax.reload();
        },
        error: function () {
        }
    });

});
