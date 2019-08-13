$(function () {
    $.ajax({
        url: "../../php/database.php",
        type: "POST",
        scriptCharset: 'utf-8',
        data: {
            "table": "city"
        },
        dataType: "text"
    })
        .done((data) => {
            $("#table").html(data);
        })
        .fail((data) => {
            $("#table").html(data);
            console.log('database error');
            console.log(data);
        });
});