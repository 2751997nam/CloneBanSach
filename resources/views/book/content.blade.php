
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                Quản Lý Sách
            </div>
            @include('book.search')
        </div>
        <table class="table" style="table-layout: fixed; ">
            <thead>
                <tr>
                    <th  style="vertical-align: middle; width: 50px; ">STT</th>
                    <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=book_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Book Code</a>
                        {{ request()->session()->get('field')=='book_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>
                    <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=name&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                        {{ request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>

                    <th style="vertical-align: middle; width: 120px">Img</th>
                    <th style="width: 100px">Categories</th>

                    <th style="vertical-align: middle;width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=author&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Author</a>
                        {{ request()->session()->get('field')=='author'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>

                    <th style="width: 200px; ">Description</th>

                    <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=publisher&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Publisher</a>
                        {{ request()->session()->get('field')=='publisher'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>
                    <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=price&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Price</a>
                        {{ request()->session()->get('field')=='price'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>
                    <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=discount&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Discount</a>
                        {{ request()->session()->get('field')=='discount'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>
                    <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('book?field=quantity&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Quantity</a>
                        {{ request()->session()->get('field')=='quantity'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
                    </th>
                    {{--<th width="160px" style="vertical-align: middle">--}}
                        {{--<a href="javascript:ajaxLoad('{{url('book/create')}}')"--}}
                           {{--class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New Book</a>--}}
                    {{--</th>--}}
                    <th width="160px" style="vertical-align: middle">
                        <a href="{{ route('book.create') }}"
                           class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New Book</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            @php
                $i = 1 + ($page - 1) * 5;
            @endphp
            @forelse($books as $book)
                @php($cates = $book->Categories()->get()->pluck('name'))
                <tr>
                    <td style="overflow: hidden">{{ $i++ }}</td>
                    <td style="overflow: hidden">{{ $book->book_code }}</td>
                    <td style="overflow: hidden">{{ $book->name }}</td>
                    <td style="overflow: hidden"><img src="{{ Storage::url($book->img) }}" alt="{{ $book->img_name }}" width="100px" height="150px"></td>
                    <td style="overflow: hidden">@foreach($cates as $cate)
                        <span>{{ $cate }}</span>
                        @endforeach
                    </td>

                    <td style="overflow: hidden">{{ $book->author }}</td>
                    <td  style="overflow: hidden">{{ strlen($book->description) > 150 ? substr($book->description, 0, 150)."..." : $book->description }}</td>
                    <td style="overflow: hidden">{{ $book->publisher }}</td>
                    <td style="overflow: hidden">{{ $book->price }}</td>
                    <td style="overflow: hidden">{{ $book->discount }}</td>
                    <td style="overflow: hidden">{{ $book->quantity }}</td>
                    <td>
                        {{--<a class="btn btn-warning btn-xs" title="Edit"--}}
                           {{--href="javascript:ajaxLoad('{{url(route('book.edit', ['id' => $book->id]))}}')">--}}
                            {{--Edit</a>--}}
                        <a class="btn btn-warning btn-xs" title="Edit"
                           href="{{url(route('book.edit', ['id' => $book->id]))}}">
                            Edit</a>
                        <input type="hidden" name="_method" value="delete"/>
                        <a class="btn btn-danger btn-xs" title="Delete"
                           href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('book.destroy', ['id' => $book->id]))}}','{{csrf_token()}}')">
                            Delete
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="vertical-align: center; text-align: center">No Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <ul class="paginate">
            {{ $books->links() }}
        </ul>
</div>