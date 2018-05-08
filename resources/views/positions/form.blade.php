<div class="container">
    <div class="col-md-8 offset-md-2">
        <h1>{{isset($id)?'Edit':'New'}} Position</h1>
        <hr/>
        @if(isset($id))
            @php
                $position = \App\Position::findOrFail($id);
            @endphp
            {!! Form::model($position,['url' => route('positions.update', ['id' => $position->id]),'method'=>'put','id'=>'frm']) !!}
        @else
            {!! Form::open(['url' => route('positions.store'), 'id'=>'frm']) !!}
        @endif
        <div class="form-group row required">
            {!! Form::label("name","Position Name",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("name",null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),"autofocus",'placeholder'=>'Position Name']) !!}
                <span id="error-name" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("base_salary_level","Base Salary Level",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("base_salary_level",null,["class"=>"form-control".($errors->has('base_salary_level')?" is-invalid":""),"autofocus",'placeholder'=>'Base Salary Level']) !!}
                <span id="error-name" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url(route('positions.index'))}}')" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>