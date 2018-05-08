function sub() {
    // console.log('sub');
    var quantity = $('#quantity').val();
    if(quantity > 1) quantity--;
    $('#quantity').val(quantity);
}

function add(max) {
    // console.log('add');
    max = parseInt(max);
    var quantity = $('#quantity').val();
    if(quantity < max) quantity++;
    $('#quantity').val(quantity);
}

function inputQuantity(quantity) {
    $('#quantity').on('keydown', function(e){
        -1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    $('#quantity').on('keydown keyup', function(e){
        if (parseInt($(this).val()) > parseInt(quantity)
            && e.keyCode !== 46 // keycode for delete
            && e.keyCode !== 8 // keycode for backspace
        ) {
            e.preventDefault();
            $(this).val(quantity);
        }

        if ($(this).val() < 1
            && e.keyCode !== 46 // keycode for delete
            && e.keyCode !== 8 // keycode for backspace
        ) {
            e.preventDefault();
            $(this).val(1);
        }
    });
}

function outOfStock(quantity) {
    if(quantity < 1) {
        $("#addToCart").prop('disabled', true);
        $('#buyNow').prop('disabled', true);
    }
}

function bookDetailOption(element, page) {
    element.siblings('.book-detail-options').removeClass('chose');
    element.addClass('chose');
    $('#showBookDetailOption').load(page);
}

function addToCart(user_id, book_id, url, bookQuantity, token) {
    // console.log(user_id);
    // console.log(book_id);
    // console.log(url);
    // console.log(token);
    // $("#addToCart").unbind('click');
    $('#addToCart').prop('disabled', true);
    var a = parseInt($("#cartSize").val());
    var quantity = parseInt($("#quantity").val());
    // var book_id = book_id;
    // var user_id = user_id;
    if(a + quantity > bookQuantity) {
        alert('Quá Số Lượng Cho Phép');
        // $("#addToCart").bind('click', addToCart);
        $('#addToCart').prop('disabled', false);
        return;

    }
    else
        $.ajax({
            url: url,
            method: "POST",
            data: {book_id: book_id, user_id: user_id, quantity: a + quantity,
                _token: token,  _method: "PUT" },
            success: function (result) {
                a = a + quantity;
                $('#cartSize').val(a);
                $('.cart-dropdown-menu').html(result);
                alert('Thêm Sản Phẩm Thành Công');
            },
            complete: function () {
                $('#addToCart').prop('disabled', false);
                // $("#addToCart").bind('click', addToCart);
            }
        });
}