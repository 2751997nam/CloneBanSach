$(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});
function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'showBookDetailOption';
    $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
            $('.loading').hide();
        }
    });
}