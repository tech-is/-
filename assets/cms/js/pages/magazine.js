function confirm_form() {
    if (!confirm('この内容で登録しますか？')) {
        /* キャンセルの時の処理 */
        return false;
    } else {
        alert("登録が完了しました")
        return true;
    }
}