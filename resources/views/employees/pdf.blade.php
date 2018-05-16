<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
<div>
    <h4>Công Ty Cổ Phần Book.com</h4>
    <strong>Mộ Lao, Hà Đông, Hà Nội</strong>
</div>
<div style="text-align: center">
    @php($date = \Carbon\Carbon::now())
    <h2>Bảng Thanh Toán Lương Nhân Viên</h2>
    <span><strong>Tháng {{ $date->month }}</strong></span>
    <span><strong>Năm {{ $date->year }}</strong></span>
</div>
<div>
    @php($i = 0)
    <table>
        <thead>
        <tr>
            <th>STT</th>
            <th>Mã Nhân Viên</th>
            <th>Họ và Tên</th>
            <th>Chức Vụ</th>
            <th>Lương Cơ Bản</th>
            <th>Phụ Cấp</th>
            <th>BHYT (1,5%)</th>
            <th>Tổng Nhận</th>
            <th style="width: 100px">Ký Nhận</th>
        </tr>
        </thead>
        <tbody>
        @forelse( $employees as $employee)
            <?php
            $baseSalary = $employee->salary_level * $base;
            $insurance = round($baseSalary * 0.015, 0);
            ?>
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee->employee_code }}</td>
                <td>{{ $employee->user->name }}</td>
                <td>{{ $employee->position->name }}</td>
                <td>{{ number_format($baseSalary, 0, ",", ".") }}</td>
                <td>{{ number_format($bonus, 0, ",", ".") }} </td>
                <td>{{ number_format($bonus, 0, ",", ".") }} </td>
                <td>{{ number_format($baseSalary + $bonus - $insurance, 0, ",", ".") }} </td>
                <td></td>
            </tr>
        @empty
            <tr>
                <td colspan="7">NO DATA</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top: 100px; width: 850px; overflow: auto">
    {{--<div style="width: 100%">--}}
        {{--<p style="float: right;">Hà Nội, Ngày ....., Tháng ....., Năm {{ $date->year }}</p>--}}
    {{--</div>--}}
    <div style="float: left; display: inline-block; width: 100px">
        <p style="font-weight: bold">Người Lập</p>
    </div>
    <div style="float: right; display: inline-block">
        <p>Hà Nội, Ngày ....., Tháng ....., Năm {{ $date->year }}</p>
        <p style="font-weight: bold; margin-right: 50px">Công Ty Cổ Phần Book.com</p>
    </div>
</div>
</body>
</html>
