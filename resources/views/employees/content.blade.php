
<div class="container">
    <div class="row">
        <div class="col-md-7">
            Quản lý nhân viên
        </div>
        @include('employees.search')
    </div>
    <table class="table" style="table-layout: fixed; ">
        <thead>
        <tr>
            <th  style="vertical-align: middle; width: 50px; ">STT</th>
            <th style="vertical-align: middle; width: 100px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('employees?field=employee_code&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Employee Code</a>
                {{ request()->session()->get('field')=='employee_code'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('employees?field=fullname&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Name</a>
                {{ request()->session()->get('field')=='fullname'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>

            <th style="vertical-align: middle; width: 250px">Email</th>

            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('employees?field=dob&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Date of birth</a>
                {{ request()->session()->get('field')=='dob'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>

            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('employees?field=position&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Position</a>
                {{ request()->session()->get('field')=='position'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>

            <th style="vertical-align: middle; width: 150px"><a class="ajaxlink" href="javascript:ajaxLoad('{{ url('employees?field=salary_level&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc')) }}')">Salary Level</a>
                {{ request()->session()->get('field')=='salary_level'?(request()->session()->get('sort')=='asc'?'▴':'▾'):'' }}
            </th>
            <th width="160px" style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{ route('employees.create') }}')"
                   class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New employees</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i = 1 + ($page - 1) * 5;
        @endphp
        @forelse($employees as $employee)
            <tr>
                <td style="overflow: hidden">{{ $i++ }}</td>
                <td style="overflow: hidden">{{ $employee->employee_code }}</td>
                <td style="overflow: hidden">{{ $employee->fullname }}</td>
                <td style="overflow: hidden">{{ $employee->email }}</td>
                <td style="overflow: hidden">{{ date('d-m-Y', strtotime($employee->dob)) }}</td>
                <td style="overflow: hidden">{{ $employee->position}}</td>
                <td style="overflow: hidden">{{ $employee->salary_level }}</td>
                <td>
                    <a class="btn btn-warning btn-xs" title="Edit"
                       href="javascript:ajaxLoad('{{url(route('employees.edit', ['id' => $employee->id]))}}')">
                        Edit</a>
                    <input type="hidden" name="_method" value="delete"/>
                    <a class="btn btn-danger btn-xs" title="Delete"
                       href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url(route('employees.destroy', ['id' => $employee->id]))}}','{{csrf_token()}}')">
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
        {{ $employees->links() }}
    </ul>
</div>