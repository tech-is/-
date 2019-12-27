//datatable
$(function () {
    $("#datatable").DataTable({
        paging: true,
        pageLength: 10,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        tabIndex: -1,
        order: [[0, "asc"]],
        colReorder: true,
        columnDefs: [
            {
                targets: 0,
                visible: false,
                searchable: false
            }
        ],
        language: {
            decimal: ".",
            emptyTable: "表示するデータがありません。",
            info: "_START_ ～ _END_ / _TOTAL_ 件中",
            infoEmpty: "0 ～ 0 / 0 件",
            infoFiltered: "(合計 _MAX_ 件からフィルタリングしています)",
            infoPostFix: ",",
            thousands: ",",
            lengthMenu: "1ページ _MENU_ 件を表示する",
            loadingRecords: "読み込み中...",
            processing: "処理中...",
            search: "絞り込み:",
            zeroRecords: "一致するデータが見つかりません。",
            paginate: {
                first: "最初",
                last: "最後",
                next: "次",
                previous: "前"
            }
        }
    });
});

// カスタマーデータ登録
$("#register").on("click", function () {
    //顧客登録 ボタンタグにid
    $("#img_wrapper").css({ width: "", height: "" });
    $("#img_wrapper > img").attr("src", "");
    $("#sendUpdateData").hide(); //顧客登録画面内の更新ボタン
    $("#send_register").show(); //顧客登録画面内の登録ボタン
    $("#modalArea_register").fadeIn(); //モーダルエリアそのもの
});
//カスタマー登録の×のイベント
$("#modalBg_register, #C_cancel, #P_cancel").on("click", function () {
    $("#modalArea_register").fadeOut(); //モーダルエリアを閉じる
});

$("#total_form").on("submit", function (e) {
    //顧客登録画面内の登録ボタンをクリック時
    e.preventDefault();
    var method = "insert_total";
    let fd = new FormData($("#total_form").get(0));
    if ($("#customer_id").val() !== "" && $("#pet_id").val() !== "") {
        fd.append("customer_id", $("#customer_id").val());
        fd.append("pet_id", $("#pet_id").val());
        var method = "update_total";
    }
    $.ajax({
        url: "https://www.animarl.com/total_list/" + method,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        processData: false,
        contentType: false,
        data: fd,
        dataType: "json"
    }).then(
        data => process_callback(data),
        error => SysError_alert()
    );
});

/******************************************************************** */
/** グループ **/
/******************************************************************** */
//グループ登録ボタンをクリック時
$("#group_register").on("click", function () {
    $.ajax({
        url: "/https://www.animarl.com/total_list/insert_kind_group",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: { kind_group_name: $("#select_group").val() },
        dataType: "json"
    }).then(
        data => process_callback(data),
        error => SysError_alert()
    );
});

$("#delete_group_register").on("click", function () {
    swal({
        title: "削除しますか？",
        icon: "warning",
        buttons: {
            OK: {
                text: "OK",
                value: true,
                closeModal: "false"
            },
            Cancel: {
                text: "Cancel",
                value: false
            }
        }
    }).then(function (data) {
        if (data) {
            $.ajax({
                url: "/https://www.animarl.com/total_list/delete_kind_group",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: { kind_group_name: $("#delete_group").val() },
                dataType: "json"
            }).then(
                data => process_callback(data),
                error => SysError_alert()
            );
        }
    });
});
/*************************************************************************** */
/** Total更新 **/
/*************************************************************************** */
// テーブル行クリックの設定 id=データテーブル tbody要素に対して
$("#datatable tbody").on("click", "tr", function () {
    if ($(this).find(".dataTables_empty").length == 0) {
        $("#datatable tr").removeClass("active");
        $(this).addClass("active");
        $("#updateTotal").prop("disabled", false); //予約ボタン
    }
});

//更新ボタンを押す、押した後のイベント
$("#updateTotal").on("click", function () {
    $.ajax({
        url: "https://www.animarl.com/total_list/get_total_all_data",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            pet_id: $("#datatable").DataTable().rows(".active").data()[0][0]
        }
    }).then(
        function (data) {
            $("#sendUpdateData").show();
            $("#send_register").hide();
            let form = $("#total_form").serializeArray();
            for (let i = 0; i < form.length; i++) {
                let name = form[i]["name"];
                if (name === "pet_information" || name === "customer_magazine") {
                    $("textarea[name='" + name + "']").val(data[name]);
                } else if (name === "customer_magazine" || name === "pet_animal_gender" || name === "pet_contraception") {
                    $("[name='" + name + "']:checked").val(data[name]);
                } else {
                    $("input[name='" + name + "']").val(data[name]);
                }
            }
            if (data["pet_img"] !== null) {
                $("#img_wrapper > img").attr("src", data["pet_img"]);
                $("#img_wrapper").css({ width: "", height: "" });
            } else {
                $("#img_wrapper > img").attr("src", "");
                $("#img_wrapper").css({ width: "0px", height: "0px" });
            }
            $("#customer_id").val(data["customer_id"]);
            $("#pet_id").val(data["pet_id"]);
            $("#modalArea_register").fadeIn();
        },
        function () {
            SysError_alert('データの取得に失敗しました');
        }
    );
});

// $("#sendUpdateData").on("click", function () {
//     let fd = new FormData($("#total_form").get(0));
//     fd.append("customer_id", $("#customer_id").val());
//     fd.append("pet_id", $("#pet_id").val());
//     $.ajax({
//         url: "https://www.animarl.com/total_list/update_total",
//         type: "POST",
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
//         },
//         processData: false,
//         contentType: false,
//         data: fd,
//         dataType: "json"
//     }).then(
//         function (data) {
//             process_callback(data);
//         },
//         function () {
//             SysError_alert();
//         }
//     );
// });

$(function () {
    $("#files").on("change", function () {
        // upするinputのID
        let file = $(this).prop("files")[0];
        if ($(this).prop("files")[0] === "undefined") {
            // if (!file.type.match('image.*')) { //こちらでjpg フィルタ処理
            $(this).val("");
            $("#img_wrapper > img").attr("src", "");
            $("#img_wrapper").css({ width: "0px", height: "0px" });
            return;
        } else {
            let reader = new FileReader();
            reader.onload = function () {
                //OKならこちらでリサイズ処理して表示
                $("#img_wrapper > img").attr("src", reader.result);
                $("#img_wrapper").css({ width: "", height: "" });
            };
            reader.readAsDataURL(file);
        }
    });
});
