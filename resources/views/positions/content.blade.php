
<div class="container">
    <div class="row">
        <div class="col-md-7">
            Positions Manager
        </div>
        @include('positions.search')
    </div>
    <table class="table">
        <thead>
        <tr>
            <th width="60px" style="vertical-align: middle">STT</th>
            <th style="vertical-align: middle"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('positions?field=position_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Position Code</a>
                {{ request()->session()->get('field')=='position_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('positions?field=name&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                {{ request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('positions?field=base_salary_level&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Base Salary Level</a>
                {{ request()->session()->get('field')=='base_salary_level'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th width="160px" style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url(route('positions.create'))}}')"
                   class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New Positions</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1 + ($page - 1) * 5;
        @endphp
        @forelse($positions as $position)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $position->position_code }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->base_salary_level }}</td>
                <td>
                    <a class="btn btn-warning btn-xs" title="Edit"
                       href="javascript:ajaxLoad('{{url(route('positions.edit', ['id' => $position->id]))}}')">
                        Edit</a>
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('positions.destroy', ['id' => $position->id]))}}','{{csrf_token()}}')">
                        Delete
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="vertical-align: center; text-align: center">No Data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <ul class="paginate">
        {{ $positions->links() }}
    </ul>
</div>