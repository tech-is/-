$(function () {
    // Textarea auto growth
    // autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').datepicker({
        language: 'ja',
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });
})