@extends('layouts.master')

@section('title', $book->name)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection
@section('content')
    <div>
        <div class="top-links">

        </div>
        <div class="content" style="background-color: white">
            <div class="book-img" style=" display: inline-block;  position: relative">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($book->img) }}" alt="{{ $book->name }}" style="width: 250px; height: 300px;">
                @if($book->quantity == 0)
                    <img src="{{ url('images/soldout.png') }}" alt="soldout" style="position: absolute;
                     opacity: 0.85; left: 30px; top: 60px">
                    <strong style="color: white; position: absolute; top: 141px; right: 74px; font-size: 25px"> Hết Hàng</strong>
                @endif
            </div>
            <div class="book-info" style="width: 78%; display: inline-block; float: right; background-color: white; padding: 0px 15px">
                <div class="book-info-header" style="padding: 10px 0;border-bottom: 1px solid grey; position: relative">
                    <div style="width: 80%">
                        <div class="book-title">
                            <h4>{{ $book->name }}</h4>
                        </div>
                        <div class="book-price">
                            <h4>
                                @php($price = $book->price)
                                @if($book->discount > 0)<strike style="color: grey">{{ strlen((string) $price)>7?substr((string)$price, 0, 4)."...":$price }}đ</strike>
                                @endif
                                <span style="color: orangered">{{$book->price * (100- $book->discount) / 100}}đ</span>
                            </h4>
                        </div>
                        @if($book->discount > 0)
                            <div class="discount-div" >
                                <img src="/images/discount.png" alt="discount" >
                                <strong class="discount" >Giảm <p>{{ $book->discount }}%</p></strong>
                            </div>
                        @endif
                    </div>

                    <div class="star" style="width: 35%">
                        @php($count = 0)
                        @php($likes = 0)
                        @php($stars = 0)
                        @php($rawStars = 0)

                        @foreach($book->users as $u)
                            @php($u->pivot->comment != null ? $count++ :"")
                            @php($stars += $u->pivot->star)
                            @if($u->pivot->isLike == 1) @php($likes++)
                            @endif

                        @endforeach
                        @if((int)$count !== 0)
                            @php($stars = $stars/ $count)
                            @php($rawStars = $stars)
                            @php($stars = round($stars))
                        @endif
                        <a href="javascript:void(0)" class="like">

                            @if($user === null )<i class="fas fa-heart"></i>
                            @else
                                @php($rated = $user->books->find($book->id))
                                @if($rated !== null && $rated->pivot->isLike === 1)
                                    <i class="fas fa-heart liked"></i>
                                @else
                                    <i class="fas fa-heart"></i>
                                @endif
                            @endif
                            <span style="color: grey">{{ $likes }}</span>
                            <input type="hidden" name="likes" value="{{ $likes  }}">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                        </a>

                        <div class="rated-stars" style="display: inline; margin-left: 10px">
                        <span>
                            @for($x = 0; $x < $stars; $x++)
                                <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star rated" ></i></a>
                            @endfor

                            @for($x = 0; $x < 5 - $stars; $x++)
                                <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star" ></i></a>
                            @endfor
                            <span style="color: red">{{ round($rawStars, 2) }} trên 5</span>
                            <span style="color: grey" class="rated-number">({{ $count }}) Đánh Giá</span>
                            <input type="hidden" value="{{ $count }}">
                        </span>
                        </div>
                    </div>
                </div>


                <div class="book-info-body" style="padding: 10px 0px; margin-top: 5px; border-bottom: 1px solid grey;">
                    <div >
                        <i class="fas fa-truck" style="float: left; color: #2aabd2">free</i>
                        <span style="margin-left: 10px">Miễn Phí Vận Chuyển cho đơn hàng có giá trị từ ₫150.000 (giảm tối đa 40.000 VNĐ)</span>
                    </div>
                </div>
                <div class="book-info-footer" style="padding: 2% 0%">
                    <div class="quantity">
                        <span >Số Lượng:</span>
                        <button  style="width: 30px" onclick="sub()">-</button>
                        <input type="text"  id="quantity" style="width: 50px; text-align: center" value="1">
                        <button  style="width: 30px" onclick="add('{{ $book->quantity }}')">+</button>
                        <span>{{$book->quantity}} sản phẩm có sẵn</span>
                    </div>
                    <div class="add-to-cart" style="margin-top: 20px">
                        <button class="btn btn-primary" id="addToCart">
                            <i class="fas fa-cart-plus"></i>
                            <span>Thêm Vào Giỏ Hàng</span>
                        </button>
                        <button class="btn btn-danger" id="buyNow">
                            Mua Ngay
                        </button>
                    </div>
                </div>
            </div>
            <div class="book-detail">
                <div class="book-detail-header">
                    <div class="book-detail-options chose" id="bookDetail" role="button">
                        <span>
                            Chi Tiết Sản Phẩm
                        </span>
                    </div>
                    <div class="book-detail-options" id="bookComment" role="button">
                        <span>
                            Đánh Giá
                        </span>
                    </div>
                </div>
                <div id="showBookDetailOption" style="overflow: hidden">

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="cartSize" value="">
    @include('carouselProduct')
@endsection

@section('script')
    <script src="{{ asset('js/ajaxload.js') }}"></script>
    <script src="{{ asset('js/show.js') }}"></script>
    <script src="{{ asset('js/likebook.js') }}"></script>
    <script>
        @if ($user !== null)
        $('a.like').click(function () {
            likeBook('{{ route('book_user.update') }}', '{{ $user->id }}', $(this), '{{ csrf_token() }}');
        });
        $('#buyNow').click(function () {
            window.location.href="/cart/";
        });
        @else
        $('a.like').click(function () {
            window.location.href="{{ route('login') }}";
        });

        $('#buyNow').click(function () {
            window.location.href="{{ route('login') }}";
        });
        @endif


        $(document).ready(function () {
            {{--$('#showBookDetailOption').load('/product/description/'+ '{{ $book->id }}');--}}
            bookDetailOption($('#showBookDetailOption'), '/product/description/' + '{{ $book->id }}');
            inputQuantity('{{ $book->quantity }}');
        });


        $('#bookDetail').click(function () {
            bookDetailOption($(this), '/product/description/' + '{{ $book->id }}');
        });

        $('#bookComment').click(function () {
            bookDetailOption($(this), '/product/comment/' + '{{ $book->id }}');
        });

        $(document).ready(function () {

            var quantity = parseInt("{{ $book->quantity }}");

            outOfStock(quantity);

            @if($user != null)

                    @php($cart = \App\Cart::where('book_id', '=', $book->id)
                                ->where('user_id', '=', $user->id)->where('was_paid', '=', '0')->first())
                c = parseInt("{{ $cart != null ? $cart->quantity : 0 }}");
            $('#cartSize').val(c);
            $("#addToCart").click(function () {
                addToCart("{{ $user->id }}", '{{ $book->id }}',
                    '{{ route('cart.update') }}','{{ $book->quantity }}', '{{ csrf_token() }}');
            });
            @else
            $("#addToCart").click(function () {
                window.location.href='{{ route('login') }}';
            });
            @endif


        });


    </script>
@endsection