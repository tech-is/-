$(function () {
    $('#datatable').DataTable({
        'responsive': true,
        'searching': true,
        'paging': true,
        'columnDefs': [
            {
                "targets": 0,
                "visible": false,
                "searchable": false
            }
        ]
    });
});