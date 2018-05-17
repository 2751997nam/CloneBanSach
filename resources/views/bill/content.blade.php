

    <div class="row">
        <div class="col-md-7">
            Quản Lý Hoá Đơn
        </div>
        @include('bill.search')
    </div>
    <table class="table" style="table-layout: fixed; ">
        <thead>
        <tr>
            <th  style="vertical-align: middle; width: 50px; ">STT</th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=bill_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Bill Code</a>
                {{ request()->session()->get('field')=='bill_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 120px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=employee_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Employee Code</a>
                {{ request()->session()->get('field')=='employee_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=total&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Total</a>
                {{ request()->session()->get('field')=='total'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 100px">Order Id</th>
            <th style="vertical-align: middle; width: 150px">Customer Name</th>
            <th style="vertical-align: middle; width: 256px">Email</th>
            <th style="vertical-align: middle; width: 150px">Address</th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=was_paid&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Was Paid</a>
                {{ request()->session()->get('field')=='was_paid'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=updated_at&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Updated At</a>
                {{ request()->session()->get('field')=='updated_at'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th width="160px" style="vertical-align: middle">

            </th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1 + ($page - 1) * $paginate)

        @forelse($bills as $bill)
            <tr>
                <?php $order = $bill->order ?>
                <td style="overflow: hidden">{{ $i++ }}</td>
                <td style="overflow: hidden">{{ $bill->bill_code }}</td>
                <td style="overflow: hidden">{{ $bill->employee_code }}</td>
                <td style="overflow: hidden">{{ $bill->total }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td style="overflow: hidden" class="was_paid"> {{ $bill->was_paid == 1 ? "Yes" : "No" }}
                </td>
                <td style="overflow: hidden; display: none" class="was_paid_change">
                    <div class="form-group row">
                        <select name="was_paid" class="form-control was_paid_select" style="display: inline; width: auto">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <input type="hidden" class="billId" value="{{ $bill->id }}">
                        <button class="btn btn-primary updateBill" >save</button>
                    </div>
                </td>
                <td style="overflow: hidden"> {{ $bill->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-xs detail" role="button" title="Details"
                       href="javascript:void(0)">
                        Details</a>
                    <a class="btn btn-success btn-xs detail" role="button" title="Details"
                       href="{{ route('pdf.bill', ['bill_code' => $bill->bill_code]) }}">
                        Export</a>
                    <button class="btn btn-warning btn-xs edit" title="Edit">
                        Edit</button>
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('bills.destroy', ['id' => $bill->id]))}}','{{csrf_token()}}')">
                        Delete
                    </a>

                </td>
            </tr>
            <tr class="orderDetails" style="display: none;">
                <td colspan="11"  style="background-color: gainsboro;">
                    <div style="max-height: 500px; overflow-y: auto;">
                        <table style="width: 100%; margin-bottom: 20px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="order-info">
                                        <label for="">Order Id: </label>
                                        <span> {{ $bill->order_id }} </span>
                                    </td>
                                    <td>
                                        <label for="">User Id: </label>
                                        <span> {{ $order->user_id }} </span>
                                    </td>
                                    <td class="order-info">
                                        <label for="">Name: </label>
                                        <span>{{ $order->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="order-info">
                                        <label for="">Email: </label>
                                        <span>{{ $order->email }}</span>
                                    </td>
                                    <td>
                                        <label for="">Phone: </label>
                                        <span>{{ $order->phone }}</span>
                                    </td>
                                    <td class="order-info">
                                        <label for="">Address: </label>
                                        <span>{{ $order->address }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%">
                            <thead>
                            <tr>
                                <th  style="vertical-align: middle">STT</th>
                                <th style="vertical-align: middle">Book Code</th>
                                <th style="vertical-align: middle">Name</th>
                                <th style="vertical-align: middle">Price</th>
                                <th style="vertical-align: middle">Discount</th>
                                <th style="vertical-align: middle">Quantity</th>
                                <th style="vertical-align: middle">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($j = 1)
                            @php($sum = 0)
                            @foreach($order->order_items as $item)
                                <tr>
                                    <td> {{ $j++ }} </td>
                                    <td>{{ $item->book_code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                    <td>{{ $item->discount }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    @php($money = round((float)$item->price * (100 - (int)$item->discount)/100 * ((int)$item->quantity), 0))
                                    <td>{{ number_format($money, 0, ',', '.') }} đ</td>
                                    @php($sum += $money)
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <div style="display: inline-block">
                                <span style="font-size: 18px"><strong>Total: </strong></span>
                                <span style="color: orangered; font-size: 15px"><strong>{{ number_format($sum, 0, ',', '.') }} đ</strong></span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="vertical-align: center; text-align: center">No Data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <ul class="paginate">
        {{ $bills->links() }}
    </ul>
