<div class="cart-header">
    <p style="color: grey">Sản Phẩm Mới Thêm</p>
</div>
<div class="cart-body">
    @php($c = 0)
    @php($i = 0)
    @forelse($carts as $cart)
        @if($i > 5) @break
        @endif
        <div class="cart-info" style="display: block; margin: 10px 0">
            <div class="cart-title" style="display: inline-block">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($cart->img) }}" alt="{{ $cart->name }}" style="width: 30px; height: 30px">
                <span>{{ strlen($cart->name) > 50 ? substr($cart->name, 0, 50)."..." : $cart->name }}</span>
            </div>
            <div class="cart-content" style="color: orangered;  float: right">
                <span>{{ $cart->price }} đ x {{ $cart->pivot->quantity }}</span>
            </div>
            @php($c += $cart->pivot->quantity)
            <div class="cart-delete" style="text-align: right">
                <a href="javascript:void(0)" style="color: orangered;" class="delete-cart" role="button">Xóa</a>
                <input type="hidden" name="id" value="{{ $cart->pivot->id }}">
                <input type="hidden" name="quantity" value="{{ $cart->pivot->quantity }}">
            </div>
        </div>
    @empty
        <div>Chưa Có Sản Phẩm Nào</div>
    @endforelse
</div>
<div class="cart-footer" style="overflow: auto " >
    <div style="float: left; margin-top: 5px">
        <span style="color: orangered; top: 50%" id="cart-sum-product">{{ $c }} </span>
        Sản Phẩm Trong Giỏ
    </div>
    <button class="btn" style="float: right; background-color: orangered; color: white" onclick="window.location.href='/cart/'">Xem Giỏ Hàng</button>
</div>
<input type="hidden" id="cartSizeInput" value="{{ $c }}">

<script>
    var c = 0;
    function count(a) {
        c = a;
        return  c;
    }
    function cartSize() {
        var size = parseInt($('#cartSizeInput').val());
        if(size > 0) {
            $('#cartSize').css({
                'display': 'block'
            });
            $('#cartSize').children('span').text(size);
        }else {
            $('#cartSize').css({
                'display': 'none'
            });
        }
    }
    $(document).ready(function () {
        cartSize();
    } );
    $('.delete-cart').click(function () {

        var element = $(this);
        var id = $(this).siblings("input[name='id']").val();
        var quantity = parseInt($(this).siblings("input[name='quantity']").val());
        console.log(quantity);
        var token = $("meta[name='_token']").attr('content');
        $.ajax({
            url: "/cart",
            method: "POST",
            data: {id: id, _method: "delete", _token: token},
            success: function (result) {
                element.parents('.cart-info').remove();
                count(0);
                $('#cartSizeInput').val(parseInt($('#cartSizeInput').val()) - quantity);
                $('#cart-sum-product').text($('#cartSizeInput').val());
                cartSize();
            }
        });

    });
</script>