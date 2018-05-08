
<div class="container">
    <div class="row">
        <div class="col-md-7">
            Quản Lý Đơn Hàng
        </div>
        @include('order.search')
    </div>
    <table class="table" style="table-layout: fixed; ">
        <thead>
        <tr>
            <th  style="vertical-align: middle; width: 50px; ">STT</th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('order?field=user_id&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">User Id</a>
                {{ request()->session()->get('field')=='user_id'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('order?field=name&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                {{ request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 150px">
                Phone
            </th>
            <th style="vertical-align: middle; width: 150px">Email

            </th>
            <th style="vertical-align: middle; width: 150px">Address

            </th>
            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('order?field=created_at&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Created At</a>
                {{ request()->session()->get('field')=='created_at'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1 + ($page - 1) * 5;
        @endphp
        @forelse($orders as $order)
            <tr>
                <td style="overflow: hidden">{{ $i++ }}</td>
                <td style="overflow: hidden">{{ $order->user_id }}</td>
                <td style="overflow: hidden">{{ $order->name }}</td>
                <td style="overflow: hidden">{{ $order->phone }}</td>
                <td style="overflow: hidden">{{ $order->email }}</td>
                <td style="overflow: hidden">{{ $order->address }}</td>
                <td style="overflow: hidden">{{ $order->created_at }}</td>
                <td>
                    {{--<a class="btn btn-warning btn-xs" title="Edit"--}}
                    {{--href="javascript:ajaxLoad('{{url(route('order.edit', ['id' => $order->id]))}}')">--}}
                    {{--Edit</a>--}}
                    <a class="btn btn-primary btn-xs detail" role="button" title="Details"
                       href="javascript:void(0)">
                        Details</a>
                    @if( $order->bill === null )
                    <button class="btn btn-warning btn-xs create-bill" role="button" title="Create Bill"
                       data-toggle="modal" data-target="#createBillModal" >
                        Create Bill
                    </button>
                    @endif
                    <button class="btn btn-danger btn-xs cancel-order" title="Cancel Order">Cancel</button>
                    <input type="hidden" value="{{ $order->id }}" class="orderIdInput">
                </td>
            </tr>
            <tr class="orderDetails" style="display: none;">
                <td colspan="8"  style="background-color: gainsboro;">
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
                <td colspan="8" style="vertical-align: center; text-align: center">No Data</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createBillModal" tabindex="-1" role="dialog" aria-labelledby="createBillModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBillModalLabel">Choose Transpot Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row required">
                        {{ Form::label("employee_code", "Employee", ['class' => 'col-md-3']) }}
                        <div class="col-md-5">
                            <select name="employee_code" class="form-control" id="selectEmployee">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->employee_code }}">
                                        {{ $employee->employee_code . "   " . $employee->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createBill" data-dismiss="modal">Create</button>
                </div>
            </div>
        </div>
    </div>
    <ul class="paginate">
        {{ $orders->links() }}
    </ul>
</div>