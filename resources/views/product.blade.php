@extends('layouts.master')

@section('title', 'Sản Phẩm')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
    <div class="sidebar" style="width: 150px">
        <div class="list">
            <div class="list-header">
                <span><i class="fa fa-list"></i><strong>Thể Loại</strong></span>
            </div>
            <div class="list-body">
                @php($size = count($categories))
                @for($i = 0; $i < 3; $i++)
                    <div>
                        <input type="checkbox" value="{{ $categories[$i]->id }}">
                        <span>{{ $categories[$i]->name }}</span>
                    </div>
                @endfor
                <div class="collapse" id="cate-collapse">
                    @for($i = 3; $i < $size; $i++)
                        <div>
                            <input type="checkbox" value="{{ $categories[$i]->id }}">
                            <span>{{ $categories[$i]->name }}</span>
                        </div>
                    @endfor
                </div>
                <div>
                    <a class="collapse-down" href="#cate-collapse" data-toggle="collapse" role="button" style="color: black">Thêm... <i class="fas fa-chevron-down"></i></a>
                    <a class="collapse-up" href="#cate-collapse" data-toggle="collapse" role="button" style="display: none; color: black">Bớt <i class="fas fa-chevron-up"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 85%; float: right">
        <div class="product-filter">
            <div class="filter-option selected" role="button">
                <a style="display: block" href="javascript:ajaxLoad('{{ url('product/show-search?field=books.name&sort=asc') }}')">Phổ Biến</a>
            </div>
            <div class="filter-option" role="button">
                <a style="display: block" href="javascript:ajaxLoad('{{ url('product/show-search?field=books.updated_at&sort=desc') }}')">Mới Nhất</a>
            </div>
            <div class="filter-option" role="button">
                <a style="display: block" href="javascript:ajaxLoad('{{ url('product/show-search?field=books.quantity&sort=desc')}}')">Bán Chạy</a>
            </div>
            <div class="filter-option" role="button">
                <div class="dropdown">
                    <a style="padding: 12px 9px" class="btn btn-secondary dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Giá ▾
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <p><a style="display: block" class="dropdown-item" href="javascript:ajaxLoad('{{ url('product/show-search?field=books.price&sort=asc')}}')">Tăng Dần</a></p>
                        <p><a style="display: block" class="dropdown-item" href="javascript:ajaxLoad('{{ url('product/show-search?field=books.price&sort=desc')}}')">Giảm Dần</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-search-items">

        </div>
    </div>

@endsection

@section('script')
    <script>
        $('.filter-option').click(function () {
            $('.filter-option').removeClass('selected');
            $(this).addClass('selected');
        });
        var state = "{{ $state }}";
        $(document).ready(function () {
            ajaxLoad('product/show-search', '.product-search-items', state);
        });
        $('.collapse-down').click(function () {
            $(this).css("display", 'none');
            $(this).siblings('a').css("display", 'inline');
        });
        $('.collapse-up').click(function () {
            $(this).css("display", 'none');
            $(this).siblings('a').css("display", 'inline');
        });
        
        $("input[type='checkbox']").click(function () {
            var categories = $("input[type='checkbox']:checked").map(function () {
                return $(this).val()
            }).get();
            if(categories.length !== 0) {
                state = false;
                $.ajax({
                    url: "product/show-search",
                    method: "GET",
                    data: {search:categories},
                    success: function (result) {
                        $(".product-search-items").html(result);
                    }
                });
            }else {
                state = true;
                ajaxLoad('product/show-search', '.product-search-items', state);
            }
        });

        $(document).on('click', 'a.page-link', function (event) {
            event.preventDefault();
            ajaxLoad($(this).attr('href'), '.product-search-items', state);
        });

        function ajaxLoad(filename, content, notSearch) {
            content = typeof content !== 'undefined' ? content : '.product-search-items';
            notSearch = typeof notSearch !== 'undefined' ? notSearch : false;
            $.ajax({
                type: "GET",
                url: filename,
                data: {notSearch: notSearch},
                contentType: false,
                success: function (data) {
                    $(content).html(data);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        // $('#btn-search').click(function () {
        //     $(this).preventDefault();
        //     var search = $('#search').val();
        //     if(search.length !== 0) {
        //         $.ajax({
        //             url: "product/show-search",
        //             method: "GET",
        //             data: {search:search},
        //             success: function (result) {
        //                 $(".product-search-items").html(result);
        //             }
        //         });
        //     }
        //     else {
        //         ajaxLoad('product/show-search', '.product-search-items', true);
        //     }
        // });
    </script>
@endsection