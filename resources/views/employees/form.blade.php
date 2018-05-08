<div class="container">
    <div class="col-md-8 offset-md-2">
        <h1>{{isset($id)?'Edit':'New'}} Employee</h1>
        <hr/>
        @if(isset($id))
            @php
                $employees = DB::table('users')->where('users.id', '=', $id)->join('employees', 'users.id', '=', 'employees.id')
                    ->join('positions', 'employees.position_id', '=', 'positions.id')
                    ->select('users.name as fullname',
                            'users.email','employees.employee_code', 'employees.salary_level',
                            'dob', 'positions.name as position', 'users.updated_at', 'users.created_at')->get();
                $employee = $employees[0];
            @endphp
            {!! Form::model($employee,['url' => route('employees.update', ['id' => $id]),'method'=>'put','id'=>'frm']) !!}
        @else
            {!! Form::open(['url' => route('employees.store'), 'id'=>'frm']) !!}
        @endif
        <div class="form-group row required">
            {!! Form::label("fullname","Full Name",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("fullname",null,["class"=>"form-control".($errors->has('fullname')?" is-invalid":""),"autofocus",'placeholder'=>'Full Name']) !!}
                <span id="error-fullname" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("email","Email",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("email",null,["class"=>"form-control".($errors->has('email')?" is-invalid":""),"autofocus",'placeholder'=>'Email']) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("dob","Date of Birth",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::date("dob",null,["class"=>"form-control".($errors->has('dob')?" is-invalid":"")]) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>

        @php
            $positions = \App\Position::all()->pluck('name', 'id');
        @endphp

        <div class="form-group row required">
            {!! Form::label("position","Position",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::select("position",$positions, null,["class"=>"form-control"]) !!}
                <span id="error-" class="invalid-feedback"></span>
            </div>
        </div>

        @if(isset($id))
        <div class="form-group row required">
            {!! Form::label("salary_level","Salary Level",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("salary_level",null,["class"=>"form-control".($errors->has('salary_level')?" is-invalid":""),"autofocus",'placeholder'=>'Salary Level']) !!}
                <span id="error-salary_level" class="invalid-feedback"></span>
            </div>
        </div>
        @endif

        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url(route('employees.index'))}}')" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>