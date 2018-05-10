<link rel="stylesheet" href="{{ asset('css/carouselProduct.css') }}">
<div class="popular" style="margin-top: 30px">
    <div class="popular-header">
        <span>{{ $carousel_name }}</span>
    </div>
    <div class="popular-body border-top">
        <div id="popular-slider" class="carousel slide" data-ride="carousel" data-type="multi">
            <div class="carousel-inner" >
                @php
                    $len = count($carouselBooks);
                    $i = 0;
                    $k = 0;
                @endphp
                @for($i = 0; $i < $len / 6; $i++)
                    @if($k >= $len) @break
                    @endif
                    <div class="item @if($i === 0) active @endif">
                        @for($j = 0; $j < 6; $j++, $k++)
                            @if($k >= $len) @break
                            @endif
                            <div class="book slider-items" style="float: left">
                                <a href="{{ url('product/show/'. $carouselBooks[$k]->id) }}">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($carouselBooks[$k]->img) }}" alt="{{$carouselBooks[$k]->name}}" width="190" height="190">
                                @if($carouselBooks[$k]->discount > 0)
                                    <div class="discount-div" >
                                        <img src="/images/discount.png" alt="discount" >
                                        <strong class="discount" >Giảm <p>{{ $carouselBooks[$k]->discount }}%</p></strong>
                                    </div>
                                @endif
                                <div class="book-details" style="padding: 5%">
                                    <div style="height: 45px; float: top">
                                        {{ strlen($carouselBooks[$k]->name) > 30?substr($carouselBooks[$k]->name,0, 30)."...":$carouselBooks[$k]->name }}
                                    </div>
                                    <div style="float: bottom">
                                            <span>
                                                @php($price = $carouselBooks[$k]->price)
                                                <span style="color: orangered">{{$carouselBooks[$k]->price * (100- $carouselBooks[$k]->discount) / 100}}đ</span>
                                                @if($carouselBooks[$k]->discount > 0)<strike style="color: grey">{{ strlen((string) $price)>7?substr((string)$price, 0, 4)."...":$price }}đ</strike>
                                                @endif
                                                <i class="fas fa-truck" style="float: right; color: #2aabd2">free</i>
                                            </span>
                                    </div>
                                    @php($count = 0)
                                    @php($likes = 0)
                                    @php($stars = 0)
                                    @foreach($carouselBooks[$k]->users as $u)
                                        @php($u->pivot->comment != null ? $count++ :"")
                                        @php($stars += $u->pivot->star)
                                        @if($u->pivot->isLike == 1) @php($likes++)
                                        @endif
                                    @endforeach
                                    @if((int)$count !== 0)
                                        @php($stars = $stars/ $count)
                                        @php($stars = (int)$stars)
                                    @endif
                                    <a href="javascript:void(0)" class="like">
                                        @if($user === null)
                                            <i class="fas fa-heart"></i>
                                        @else
                                            @php($rated = $user->books->find($carouselBooks[$k]->id))
                                            @if($rated !== null && $rated->pivot->isLike === 1)
                                                <i class="fas fa-heart liked"></i>
                                            @else
                                                <i class="fas fa-heart"></i>
                                            @endif
                                        @endif
                                        <span style="color: grey">{{ $likes }}</span>
                                        <input type="hidden" name="likes" value="{{ $likes  }}">
                                        <input type="hidden" name="book_id" value="{{ $carouselBooks[$k]->id }}">
                                    </a>

                                    <div class="rated-stars" style="display: inline; float: right">
                                            <span>
                                                @for($x = 0; $x < $stars; $x++)
                                                    <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star rated" ></i></a>
                                                @endfor

                                                @for($x = 0; $x < 5 - $stars; $x++)
                                                    <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star" ></i></a>
                                                @endfor
                                                <span style="color: grey" class="rated-number">{{ $count }}</span>
                                                <input type="hidden" name="stars" value="{{ $count }}">
                                            </span>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endfor

                    </div>
                @endfor
            </div>
            <a class="left carousel-control" href="#popular-slider" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a class="right carousel-control" href="#popular-slider" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
    </div>
</div>