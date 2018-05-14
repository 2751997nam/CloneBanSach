

    <div class="row">
        <div class="col-md-7">
            Quản lý khách hàng
        </div>
        @include('user.search')
    </div>
    <table class="table" style="table-layout: fixed; ">
        <thead>
        <tr>
            <th  style="vertical-align: middle; width: 50px; ">STT</th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('users?field=name&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                {{ request()->session()->get('field')=='user_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>

            <th style="vertical-align: middle; width: 250px">Email</th>

            <th style="vertical-align: middle; width: 250px">Phone</th>

            <th style="vertical-align: middle; width: 100px">Gender</th>

            <th style="vertical-align: middle; width: 150px">Date of Birth</th>

            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('users?field=status&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Status</a>
                {{ request()->session()->get('field')=='status'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>

            <th width="160px" style="vertical-align: middle">
                {{--<a href="javascript:ajaxLoad('{{ route('users.create') }}')"--}}
                   {{--class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New users</a>--}}
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1 + ($page - 1) * $paginate;
        @endphp
        @forelse($users as $user)
            <tr>
                <td style="overflow: hidden">{{ $i++ }}</td>
                <td style="overflow: hidden">{{ $user->name }}</td>
                <td style="overflow: hidden">{{ $user->email }}</td>
                <td style="overflow: hidden">{{ $user->information ? $user->information->phone : "" }}</td>
                <td style="overflow: hidden">{{ $user->information ? $user->information->gender : ""}}</td>
                <td style="overflow: hidden">{{ $user->information ? date('d-m-Y', strtotime($user->information->dob)) : "" }}</td>
                <td style="overflow: hidden">{{ $user->status == 0 ? "unverified" : "verified" }}</td>
                <td>
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('users.destroy', ['id' => $user->id]))}}','{{csrf_token()}}')">
                        Delete
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="vertical-align: center; text-align: center">No Data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <ul class="paginate">
        {{ $users->links() }}
    </ul>
