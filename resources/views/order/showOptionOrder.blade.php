<style>
    .order {
        border-bottom: 2px solid grey;
        padding-top: 15px;
        padding-bottom: 20px;
    }
</style>
@forelse($orders as $order)
    <div class="order" style="position: relative">
        <div style="width: 500px; display: inline-block">
            <div>
                <label for="">Tên Khách Hàng: </label>
                <span>{{ $order->name }}</span>
            </div>
            <div>
                <label for="">SĐT: </label>
                <span>{{ $order->phone }}</span>
            </div>
            <div>
                <label for="">Email: </label>
                <span>{{ $order->email }}</span>
            </div>
            <div>
                <label for="">Địa Chỉ: </label>
                <span>{{ $order->address }}</span>
            </div>
        </div>
        <div style="position: absolute; top: 15px; right: 20px">
            <label for="">Thời Gian Tạo</label>
            <span>{{ Carbon\Carbon::parse($order->created_at)->format('H:i:s d-m-Y') }}</span>
        </div>
        <table class="table" style="background-color: #9acfea">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sách</th>
                <th>Giá</th>
                <th>Khuyến Mại</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
            </thead>
            <tbody>
            @php($i =  1)
            @php($sum = 0)
            @foreach($order->order_items as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2, ',', '.') }} đ</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->quantity }}</td>
                    @php($money = round((float)$item->price * (100 - (int)$item->discount)/100 * ((int)$item->quantity), 2))
                    <td>{{ number_format($money, 2, ',', '.') }} đ</td>
                </tr>
                @php($sum += $money)
            @endforeach
            </tbody>
        </table>
        <div style="overflow: auto">
            <div style="display: inline-block">
                <span style="font-size: 24px"><strong>Tổng: </strong></span>
                <span style="color: orangered; font-size: 20px"><strong>{{ number_format($sum, 2, ',', '.') }} đ</strong></span>
            </div>
            <?php
            $date = date("Y-m-d H:i:s", strtotime('-72 hours', time()));
            ?>
            @if($order->bill === null || $order->bill->was_paid !== 1)
                @if($date < $order->created_at)
                    <button class="btn btn-danger cancel" style="float:right;">Huỷ</button>
                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                @else
                    <span style="float: right">(Quá 3 ngày đơn hàng không thể huỷ)</span>
                @endif
            @endif
        </div>

    </div>
@empty
    <div style="height: 100px;">
        <div style="text-align: center;  vertical-align: middle; line-height: 100px">
            <strong>Chưa có đơn hàng</strong>
        </div>
    </div>
@endforelse
{{ $orders->links() }}
<script>
    $('.cancel').click(function () {
        var element = $(this);
        var id = element.siblings("input[type='hidden'][name='orderId']").val();
        if(confirm('Bạn có muốn huỷ đơn hàng?')) {
            $.ajax({
                url : "{{ route('order.destroy') }}",
                method: "Post",
                data: {_method: "delete", _token: "{{ csrf_token() }}", id: id},
                success: function (result) {
                    // if(result !== "") alert(result);
                    // else element.parents('.order').remove();
                    $(".content").html(result);
                }
            });
        }
    });
</script>