<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
        }
        th {
            text-align: center;
        }
        td {
            padding: 0 10px;
        }
    </style>
</head>
<body>
<div style="max-width: 680px; border: 2px solid black; overflow: auto; padding: 20px">
    <div style="border-bottom: 1px solid black">
        <div>
            <label for="">Đơn vị bán hàng:</label>
            <strong>Công Ty Cổ Phần Book.com</strong>
        </div>
        <div>
            <label for="">Mã Số Thuế</label>
            <span>0 3 1 1 8 0 0 2 4</span>
        </div>
        <div>
            <label for="">Địa Chỉ:</label>
            <span>Tổ 6, Mộ Lao, Hà Đông, TP Hà Nội</span>
        </div>
        <div>
            <label for="">Điện Thoại: </label>
            <span>...................  </span>
            <label for="">Fax: </label>
            <span>....................</span>
        </div>
    </div>
    <div style="overflow: auto; margin-top: 20px">
        <div style="text-align: center;">
                <span style="font-size: 25px; font-weight: bold; margin-bottom: 0">HOÁ ĐƠN</span>
                <br>
                <span>........, Ngày ....., Tháng ....., Năm .......</span>
        </div>
        <div style="float: right; margin-top: 10px">
            <div>
                <label for="">Mã HĐ: </label>
                <span>{{ $bill->bill_code }}</span>
            </div>
            <div>
                <label for="">Nhân Viên Giao Hàng:</label>
                <span>{{ $bill->employee_code }}</span>
            </div>
        </div>
    </div>
    <div style="width: 400px">
        <div>
            <label for="">Họ Tên Người Mua Hàng:</label>
            <span>{{ $bill->order->name }}</span>
        </div>
        <div>
            <label for="">Địa Chỉ:</label>
            <span>{{ $bill->order->address }}</span>
        </div>
        <div>
            <label for="">SDT:</label>
            <span>{{ $bill->order->phone }}</span>
        </div>
        <div>
            <label for="">Email:</label>
            <span>{{ $bill->order->email }}</span>
        </div>
    </div>
    <div>
        <?php $order = $bill->order ?>
        <table style="margin-top: 20px">
            <thead>
            <tr>
                <th  style="vertical-align: middle">STT</th>
                <th style="vertical-align: middle; width: 300px">Tên Sách</th>
                <th style="vertical-align: middle">Giá</th>
                <th style="vertical-align: middle">Giảm Giá</th>
                <th style="vertical-align: middle">Số Lượng</th>
                <th style="vertical-align: middle">Thành Tiền</th>
            </tr>
            </thead>
            <tbody>
            @php($j = 1)
            @php($sum = 0)
            @foreach($order->order_items as $item)
                <tr>
                    <td> {{ $j++ }} </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->quantity }}</td>
                    @php($money = round((float)$item->price * (100 - (int)$item->discount)/100 * ((int)$item->quantity), 2))
                    <td>{{ number_format($money, 2, ',', '.') }} đ</td>
                    @php($sum += $money)
                </tr>
        @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px">
                <span style="font-size: 18px"><strong>Tổng: </strong></span>
                <span style="font-size: 15px"><strong>{{ number_format($sum, 2, ',', '.') }} đ</strong></span>
        </div>
        <div style="width: 100%; overflow: hidden">
            <p>Số tiền viết bằng chữ: ...............................................................................................................................................................................................................................................................</p>
            <p>...............................................................................................................................................................................................................................................................</p>
        </div>
    </div>
    <div style="height: 100px;">
        <div style="float: left; margin-left: 50px">
            <strong>Người Mua Hàng</strong>
        </div>
        <div style="float: right; margin-right: 50px">
            <strong>Người Bán Hàng</strong>
        </div>
    </div>
</div>
</body>
</html>