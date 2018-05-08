@extends('layouts.sidebar')

@section('container')
    @include('bill.content')
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

        $(".btn.btn-warning.btn-xs.edit").click(function () {
            var e = $(this);
            e.parents('td').siblings('.was_paid').css('display', 'none');
            e.parents('td').siblings('.was_paid_change').css('display', '');
        });

        $('.btn.btn-primary.updateBill').click(function (e) {
            e.preventDefault();
            var element = $(this);
            var change = element.parents('.was_paid_change');
            var was_paid = element.siblings('.form-control.was_paid_select').val();
            var id = element.siblings('.billId').val();
            $.ajax({
                url: "/bills/" + id,
                method: "POST",
                data: {was_paid: was_paid, _method: "Put", _token: "{{ csrf_token() }}"},
                success: function (result) {
                    change.css('display', 'none');
                    change.siblings('.was_paid').text(was_paid == 0 ? "No" : "Yes");
                    change.siblings('.was_paid').css('display', '');
                },
                error: function (result) {
                    alert(result);
                }
            });
        })
    </script>
@endsection