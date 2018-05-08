@if($was_paid === 1)
    @php($star = $cmt->star === null ? 0 : $cmt->star)
    <div style="margin: 15px">
        <div>
            @for($x = 0; $x < $star; $x++)
                <a href="javascript:void(0)" class="big-rate-star"  style="width: 30px;height: 30px; margin: 10px" >
                    <i class="fas fa-star rated" style="font-size: 30px"></i></a>
            @endfor
            @for($x = 0; $x < 5 - $star; $x++)
                <a href="javascript:void(0)" class="big-rate-star"  style="width: 30px;height: 30px; margin: 10px" >
                    <i class="fas fa-star" style="font-size: 30px"></i></a>
            @endfor
        </div>
        <div style="margin-top: 10px">
        @if($cmt->star !== null)
            {!! Form::model($cmt, ['url' => route('book_user.update'), 'method' => 'put']) !!}
        @else
            {!! Form::open(['url' => route("book_user.store")]) !!}
        @endif
        <div class="form-group col-md-9 row ">
                {!! Form::label("comment","Comment",["class"=>"col-form-label"]) !!}
                {!! Form::text("comment", null,["class"=>"form-control", 'id' => 'comment']) !!}
                <span id="error-comment" class="invalid-feedback">
                    {{ $errors->has('comment') ? $errors->get('comment') : "" }}</span>
        </div>
            {!! Form::hidden("star", null, ['id' => 'ratedStar']) !!}
            {!! Form::hidden("book_id", $book->id, ['id' => 'book_id']) !!}
            {!! Form::hidden("user_id", $user->id, ['id' => 'user_id']) !!}
            <div class="form-group row">
                <div class="col-md-3 col-lg-2"></div>
                <div class="col-md-4">
                    {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs", 'id' => 'submitComment'])!!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endif

@forelse($comments as $comment)
    <div style="padding: 15px; border-bottom: 1px solid silver">
        <div>
            <span style="color: orangered">{{ $comment->name }}</span>
        </div>
        <div class="rated-stars" style="display: inline;">
            <span>
                @for($x = 0; $x < $comment->pivot->star; $x++)
                    <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star rated" ></i></a>
                @endfor

                @for($x = 0; $x < 5 - $comment->pivot->star; $x++)
                    <a href="javascript:void(0)" class="rate-star"><i class="fas fa-star" ></i></a>
                @endfor
            </span>
        </div>
        <div style="margin-top: 10px">
            <span>
                {{ $comment->pivot->comment }}
            </span>
        </div>
        <div>
            <span>{{ $comment->pivot->created_at }}</span>
        </div>
    </div>
@empty
    <div style="margin-top: 10px">
        <span>Chưa Có Đánh Giá</span>
    </div>
@endforelse
<div style="float: right; margin-right: 30px">
{{ $comments->links() }}
</div>
<script>

    $('#submitComment').click(function (e) {
        e.preventDefault();
        var user_id = $("#user_id").val();
        var book_id = $("#book_id").val();
        var comment = $('#comment').val();
        var star = $("#ratedStar").val();
        var url = "{{ $cmt->star === null ? route('book_user.store') : route('book_user.update') }}";
        $.ajax({
            url: url,
            method: "POST",
            data: {_method: "put", _token: "{{ csrf_token() }}",
                user_id: user_id, book_id: book_id, comment: comment, star: star},
            success: function (result) {
                if(result === null) console.log(result);
                else alert('Thành Công!');
            }
        });
    })
    $('.big-rate-star').click(function () {
        var a = 0;
        $('.big-rate-star').children('i').removeClass('rated');
        $(this).children('i').addClass('rated');
        $(this).prevAll().children('i').addClass('rated');
        a = $(this).prevAll().length + 1;
        $("#ratedStar").val(a);
    });
    function bookDetailOption(element, page) {
        element.siblings('.book-detail-options').removeClass('chose');
        element.addClass('chose');
        $('#showBookDetailOption').load(page);
    }
</script>