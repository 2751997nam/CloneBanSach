function likeBook(url, user_id, element, token) {
    var a = element.children("input[name='likes']").val();
    a = parseInt(a);
    var book_id = element.children("input[name='book_id']").val();
    // var element = $(this);
    if(element.children('i').hasClass('liked')) {
        $.ajax({
            url: url,
            method: "POST",
            data: {_method: "PUT", _token: token, user_id: user_id, book_id: book_id, isLike: 0},
            success: function (result) {
                element.children('i').removeClass('liked');
            }
        });
        a = a - 1;
    }else{
        $.ajax({
            url: url,
            method: "POST",
            data: {_method: "PUT", _token: token, user_id: user_id, book_id: book_id, isLike: 1},
            success: function (result) {
                element.children('i').addClass('liked');
            }
        });
        a = a + 1;

    }
    element.children('span').text(a);
    element.children("input[name='likes']").val(a);
}



