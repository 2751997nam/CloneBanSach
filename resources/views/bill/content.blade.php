
<div class="container">
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
            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=employee_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Employee Code</a>
                {{ request()->session()->get('field')=='employee_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('bills?field=total&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Total</a>
                {{ request()->session()->get('field')=='total'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
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
        @php($i = 1 + ($page - 1) * 5)

        @forelse($bills as $bill)
            <tr>
                <td style="overflow: hidden">{{ $i++ }}</td>
                <td style="overflow: hidden">{{ $bill->bill_code }}</td>
                <td style="overflow: hidden">{{ $bill->employee_code }}</td>
                <td style="overflow: hidden">{{ $bill->total }}</td>
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
                <td colspan="7"  style="background-color: gainsboro;">
                    <div style="max-height: 500px; overflow-y: auto;">
                        <table style="width: 100%">
                            <thead>
                            <tr>
                                <th  style="vertical-align: middle">STT</th>
                                <th  style="vertical-align: middle">Order Id</th>
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
                            <?php $order = $bill->order ?>
                            @foreach($order->order_items as $item)
                                <tr>
                                    <td> {{ $j++ }} </td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->book_code }}</td>
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
                        <div>
                            <div style="display: inline-block">
                                <span style="font-size: 18px"><strong>Total: </strong></span>
                                <span style="color: orangered; font-size: 15px"><strong>{{ number_format($sum, 2, ',', '.') }} đ</strong></span>
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
</div>