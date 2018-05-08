@extends('layouts.sidebar')

@section('container')
    @include('order.content')
@endsection

@section('js')
    <script>
        $(".btn.btn-primary.btn-xs.detail").click(function () {
            var e = $(this).parents('tr').next();
            if( e.css("display") === "none") {
                e.css("display", "");
            }
            else e.css("display", "none");

        });

        var order_id;
        var ele;
        $(".btn.btn-warning.btn-xs.create-bill").click(function () {
            order_id = $(this).siblings("input[type='hidden']").val();
            ele = $(this);
            console.log(order_id);
        });

        $("#createBill").click(function () {
            var employee_code = $('#selectEmployee').val();
            console.log(employee_code);
            $.ajax({
                url: "{{ route('bills.store') }}",
                method: "POST",
                data: {employee_code: employee_code, order_id: order_id, _token: "{{ csrf_token() }}"},
                success: function (result) {
                    alert("Create Bill Success!");
                    ele.remove();
                },
                errors: function (result) {
                    alert(result);
                }
            });
        });

        $(".btn.btn-danger.btn-xs.cancel-order").click(function () {
            if(confirm("Do you want to cancel this order?")) {
                order_id = $(this).siblings("input[type='hidden']").val();
                var element = $(this);
                console.log(order_id);
                $.ajax({
                    url: "{{ route('order.destroy') }}",
                    method: "Post",
                    data: {id: order_id, _method: "delete", _token: "{{ csrf_token() }}"},
                    success: function (result) {
                        element.parents('tr').remove();
                    },
                    errors: function (result) {
                        alert(result);
                    }
                });
            }
        })
    </script>
@endsection

