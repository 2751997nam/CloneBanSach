
<div class="container">
    <div class="row">
        <div class="col-md-7">
            Categories Manager
        </div>
        @include('category.search')
    </div>
    <table class="table">
        <thead>
        <tr>
            <th width="60px" style="vertical-align: middle">STT</th>
            <th style="vertical-align: middle"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('categories?field=name&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                {{ request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th width="160px" style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url(route('categories.create'))}}')"
                   class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New categories</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1 + ($page - 1) * 5;
        @endphp
        @forelse($categories as $category)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a class="btn btn-warning btn-xs" title="Edit"
                       href="javascript:ajaxLoad('{{url(route('categories.edit', ['id' => $category->id]))}}')">
                        Edit</a>
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('categories.destroy', ['id' => $category->id]))}}','{{csrf_token()}}')">
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
        {{ $categories->links() }}
    </ul>
</div>