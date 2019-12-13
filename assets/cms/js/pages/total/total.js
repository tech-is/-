//datatable
$(function () {
    $('#datatable').DataTable({
        'columnDefs': [
            {
                targets: 0,
                visible: false,
                searchable: false
            }
        ]
    });
});

// カスタマーデータ登録
$('#register').on('click', function () { //顧客登録 ボタンタグにid
    $('#img_wrapper').css({ 'width': '', 'height': '' });
    $('#img_wrapper > img').attr('src', '');
    $("#sendUpdateData").hide(); //顧客登録画面内の更新ボタン
    $("#send_register").show(); //顧客登録画面内の登録ボタン
    $('#modalArea_register').fadeIn();//モーダルエリアそのもの
});
//カスタマー登録の×のイベント
$('#modalBg_register, #C_cancel, #P_cancel').on('click', function () {
    $('#modalArea_register').fadeOut();//モーダルエリアを閉じる
});

$('#total_form').on('submit', function (e) { //顧客登録画面内の登録ボタンをクリック時
    e.prevent
    let fd = new FormData($('#total_form').get(0));
    $.ajax({
        url: "//animarl.com/total_list/insert_total",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        data: fd,
        dataType: 'json'
    }).then(
        function (data) {
            process_callback(data);
        },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK',
                    value: true
                },
            })
        });
    return false;
});

/******************************************************************** */
/** グループ項目削除 **/
/******************************************************************** */
$(function () {
    $("#delete_group_register").on("click", function () {
        // var selectedRows = $('#select_1').DataTable().rows('.active').data();
        SweetAlertMessage("confirm_kind_group_delete");
    });
});

function kind_group_delete() {
    var param = {
        kind_group_id: $("#select_1").val()
    }
    $.ajax({
        url: "//animarl.com/total_list/delete_kind_group",
        type: "POST",
        data: param,
    }).done(function (data) {
        if (data == 1) {
            SweetAlertMessage("success_delete");
        } else {
            SweetAlertMessage("failed_delete");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        SweetAlertMessage("failed_register");
    });
}


//グループ登録ボタンをクリック時
$('#group_register').on('click', function () {
    let param = { kind_group_name: $('#select_group').val() }
    $.ajax({
        url: '//animarl.com/total_list/insert_kind_group',
        type: 'POST',
        data: param
    })
        .done(function (data, textStatus, jqXHR) {
            if (data == "success") {
                SweetAlertMessage("success_register");
                console.log(data);
            } else {
                SweetAlertMessage("failed_register");
                console.log(data);
                // location.reload();
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            // SweetAlertMessage("failed_register");
            console.log(data);
        });
});

//予約登録
$('#register3').on('click', function () { //予約登録ボタンを押したら
    $('#modalReserveArea').fadeIn();
});
//予約登録で×を押したときのイベント
$('#modalBg_register, #R_cancel').on('click', function () {
    $('#modalReserveArea').fadeOut();
});
//ポスト値
$('#sendResisterReserve').on('click', function () {
    let param = {
        pet_name: $('#pet_name').val(),
        reserve_start: $('#reserve_start').val()
    }
    //投げる
    $.ajax({
        url: '//animarl.com/reserve/register_reserve_data',
        type: 'POST',
        data: param
    })
        //成功したとき
        .done((data) => {
            if (data == "success") {
                SweetAlertMessage("success_register");
                console.log(data);
            } else {
                SweetAlertMessage("failed_register");
                console.log(data);
                // location.reload();
            }
        })
        //失敗したとき
        .fail((data) => {
            SweetAlertMessage("failed_register");
            console.log(data);
        });
});

/*************************************************************************** */
/** Total更新 **/
/*************************************************************************** */
// テーブル行クリックの設定 id=データテーブル tbody要素に対して
$('#datatable tbody').on("click", "tr", function () {
    if ($(this).find('.dataTables_empty').length == 0) {
        $("#datatable tr").removeClass("active");
        $(this).addClass("active");
        $("#register3, #register4").prop("disabled", false); //予約ボタン
        // $().prop("disabled", false); //更新ボタン false で既存のdiabledを外す。
    }
});

//更新ボタンを押す、押した後のイベント
$('#register4').on("click", function () { //更新ボタン
    let pet_id = $('#datatable').DataTable().rows('.active').data()[0][0];
    $.ajax({
        url: '//animarl.com/total_list/get_total_all_data',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            pet_id: pet_id
        }
    }).then(function (data) {
        $("#sendUpdateData").show();
        $("#send_register").hide();
        let form = $('#total_form').serializeArray();
        for (let i = 0; i < form.length; i++) {
            let name = form[i]['name'];
            if (name === 'pet_information' || name === 'customer_magazine' || name === 'pet_information') {
                $("textarea[name='" + name + "']").val(data[name]);
            } else if (name === 'customer_magazine' || name === 'pet_animal_gender' || name === 'pet_contraception') {
                $("[name='" + name + "']:checked").val(data[name]);
            } else {
                $("input[name='" + name + "']").val(data[name]);
            }
        }
        if (data['pet_img'] !== null) {
            $('#img_wrapper > img').attr('src', data['pet_img']);
            $('#img_wrapper').css({ 'width': '', 'height': '' });
        } else {
            $('#img_wrapper > img').attr('src', '');
            $('#img_wrapper').css({ 'width': '0px', 'height': '0px' });
        }
        $("#customer_id").val(data['customer_id']);
        $("#pet_id").val(data['pet_id']);
        $('#modalArea_register').fadeIn();
    }, function () {
        alert("失敗しました");
    });
});

$("#sendUpdateData").on("click", function () {
    let fd = new FormData($('#total_form').get(0));
    fd.append("customer_id", $("#customer_id").val());
    fd.append("pet_id", $("#pet_id").val());
    $.ajax({
        url: '//animarl.com/total_list/update_total',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        data: fd,
        dataType: 'json'
    }).then(function (data) {
        process_callback(data);
    },
        function () {
            swal({
                title: 'システムエラー',
                text: 'また後ほどお試しください',
                icon: 'warning',
                button: {
                    text: 'OK',
                    value: true
                },
            })
        });
    return false;
});

/******************************************************************** */
/** SweetAlert  **/
/******************************************************************** */
function SweetAlertMessage(key) {
    let message_json = {
        success_register: {
            title: "登録が完了しました！",
            text: "ボタンをクリックして画面を閉じてください",
            icon: "success",
            button: {
                text: "OK",
                value: "success",
                visible: true,
                className: "",
                closeModal: true,
            },
        },
        failed_register: {
            title: "登録に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        success_update: {
            title: "更新が完了しました！",
            icon: "success",
            button: {
                text: "OK",
                value: true,
            }
        },
        failed_update: {
            title: "更新に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        success_delete: {
            title: "削除が完了しました！",
            icon: "success",
            button: {
                text: "OK",
                value: true,
            }
        },
        failed_delete: {
            title: "削除に失敗しました…",
            text: "また後ほどお試しください",
            icon: "warning",
            button: {
                text: "OK",
                value: false,
            },
        },
        confirm_kind_group_delete: {
            title: "削除しますか？",
            icon: "warning",
            buttons: {
                OK: {
                    text: "OK",
                    value: "kind_group_delete",
                    closeModal: "false"
                },
                Cancel: {
                    text: "Cancel",
                    value: "false"
                }
            }
        },
        confirm_staff_delete: {
            title: "削除しますか？",
            icon: "warning",
            buttons: {
                OK: {
                    text: "OK",
                    value: "staff_delete",
                    closeModal: false
                },
                Cancel: {
                    text: "Cancel",
                    value: false
                }
            }
        }
    }
    let swal_data = message_json[key];
    swal(
        swal_data
    ).then((value) => {
        switch (value) {
            case "success":
                location.reload(true);
                break;
            case "kind_group_delete":
                kind_group_delete();
                break;
        }
    })
}

$(function () {
    $("#reserve_start").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
    $("#reserve_end").flatpickr({
        minDate: "today",
        enableTime: true,
        dateFormat: "Y-m-dTH:i",
        time_24hr: true
    });
});

$(function () {
    $('#files').on("change", function () { // upするinputのID
        let file = $(this).prop('files')[0];
        if ($(this).prop('files')[0] === "undefined") {
            // if (!file.type.match('image.*')) { //こちらでjpg フィルタ処理
            $(this).val('');
            $('#img_wrapper > img').attr('src', '');
            $('#img_wrapper').css({ 'width': '0px', 'height': '0px' });
            return;
        } else {
            let reader = new FileReader();
            reader.onload = function () {//OKならこちらでリサイズ処理して表示
                $('#img_wrapper > img').attr('src', reader.result);
                $('#img_wrapper').css({ 'width': '', 'height': '' });
            }
            reader.readAsDataURL(file);
        }
    });
});