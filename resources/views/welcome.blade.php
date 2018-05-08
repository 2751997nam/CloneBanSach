@extends('layouts.master')

@section('title', 'Welcome to Book.com')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
    @include('carousel')
    @include('popular')
    @include('recommend')
@endsection

@section('script')

    <script>
        $('a.like').click(function () {
            var a = $(this).children("input[name='likes']").val();
            a = parseInt(a);
            console.log(a);
            @if ($user !== null)
            var user_id = "{{ $user->id }}";
            var book_id = $(this).children("input[name='book_id']").val();
            var element = $(this);
            if($(this).children('i').hasClass('liked')) {
                console.log('update');
                $.ajax({
                    url: "{{ route('book_user.update') }}",
                    method: "POST",
                    data: {_method: "PUT", _token: "{{csrf_token()}}", user_id: user_id, book_id: book_id, isLike: 0},
                    success: function (result) {
                        // element.children('i').removeClass('liked');
                        $("input[name='book_id'][value='"+ book_id +"']").siblings('i').removeClass('liked');
                    }
                });
                a = a - 1;
            }else{
                console.log('store');
                $.ajax({
                    url: "{{ route('book_user.update') }}",
                    method: "POST",
                    data: {_method: "PUT", _token: "{{csrf_token()}}", user_id: user_id, book_id: book_id, isLike: 1},
                    success: function (result) {
                        // element.children('i').addClass('liked');
                        $("input[name='book_id'][value='"+ book_id +"']").siblings('i').addClass('liked');
                    }
                });
                a = a + 1;

            }
            console.log(a);
            // element.children('span').text(a);
            // element.children("input[name='likes']").val(a);
            $("input[name='book_id'][value='"+ book_id +"']").siblings('span').text(a);
            $("input[name='book_id'][value='"+ book_id +"']").siblings("input[name='likes']").val(a);
            @endif

        });

        $('#popular-slider').carousel({
            pause: true,
            interval: false
        });

        // $('.carousel[data-type="multi"] .item').each(function(){
        //     var next = $(this).next();
        //     if (!next.length) {
        //         next = $(this).siblings(':first');
        //     }
        //     next.children(':first-child').clone().appendTo($(this));
        //
        //     for (var i=0;i<4;i++) {
        //         next=next.next();
        //         if (!next.length) {
        //             next = $(this).siblings(':first');
        //         }
        //
        //         next.children(':first-child').clone().appendTo($(this));
        //     }
        // });
        // function addRated($element) {
        //     if($element.siblings('.rate-star').first().children('i').hasClass('rated') === false) {
        //         var a = $element.siblings('input').val();
        //         a = parseInt(a);
        //         a = a + 1;
        //         $element.siblings('.rated-number').text("(" + a + ")");
        //     }
        // }
        //

    </script>
@endsection