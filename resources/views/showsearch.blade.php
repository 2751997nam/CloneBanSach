
<div class="show-product">
    <div class="product" >
        <div class="product-list">
            @foreach($books as $book)
                <div class="book">
                    <a href="{{ url('product/show/'.$book->id) }}">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($book->img) }}" alt="{{ $book->name }}" width="190" height="190">
                    @if($book->discount > 0)
                        <div class="discount-div" >
                            <img src="/images/discount.png" alt="discount" >
                            <strong class="discount" >Giảm <p>{{ $book->discount }}%</p></strong>
                        </div>
                    @endif
                    <div class="book-details" style="padding: 5%">
                        <div style="height: 45px; float: top">
                            {{ strlen($book->name) > 45?substr($book->name,0, 45)."...":$book->name }}
                        </div>
                        <div style="float: bottom">
                                <span>
                                    @php($price = $book->price)
                                    <span style="color: orangered">{{$book->price * (100- $book->discount) / 100}}đ</span>
                                    @if($book->discount > 0)<strike style="color: grey">{{ strlen((string) $price)>7?substr((string)$price, 0, 4)."...":$price }}đ</strike>
                                    @endif
                                    <i class="fas fa-truck" style="float: right; color: #2aabd2">free</i>
                                </span>
                        </div>
                        <?php
                            $count = 0;
                        ?>
                        @php($likes = 0)
                        @php($stars = 0)
                        @foreach($book->users as $u)
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
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @if(!isset($user))<i class="fas fa-heart"></i>
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
                                    <input type="hidden" value="{{ $count }}">
                                </span>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <div class="page-controller">
        {{ $books->links() }}
    </div>
</div>