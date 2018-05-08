<div class="container">
    <div class="col-md-8 offset-md-2">
        <h1>{{isset($id)?'Edit':'New'}} Category</h1>
        <hr/>
        @if(isset($id))
            @php
                $category = \App\category::findOrFail($id);
            @endphp
            {!! Form::model($category,['url' => route('categories.update', ['id' => $category->id]),'method'=>'put','id'=>'frm']) !!}
        @else
            {!! Form::open(['url' => route('categories.store'), 'id'=>'frm']) !!}
        @endif
        <div class="form-group row required">
            {!! Form::label("name","Category Name",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("name",null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),"autofocus",'placeholder'=>'Category Name']) !!}
                <span id="error-name" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url(route('categories.index'))}}')" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>