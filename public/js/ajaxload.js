$(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});
function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'showBookDetailOption';
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}