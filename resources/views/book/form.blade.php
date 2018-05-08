<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href=" {{asset('css/mycss.css')}} ">
</head>
<body>
<div class="container">


    <div class="col-md-8 offset-md-2">

        <h1>{{isset($id)?'Edit':'New'}} Book</h1>
        <hr/>
        @if(isset($id))
            @php
                $book = \App\Book::findOrFail($id);
                $bc = $book->Categories()->get()->pluck('id');
            @endphp
            <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#select2').val({{ $bc }});
                })
            </script>
            {!! Form::model($book,['url' => route('book.update', ['id' => $book->id]),'method'=>'put','id'=>'frm', 'files' => true]) !!}
        @else
            {!! Form::open(['url' => route('book.store'), 'id'=>'frm', 'files' => true]) !!}
        @endif
        @php($categories = \App\Category::orderBy('name')->get())

        <div class="form-group row required">
            {!! Form::label("name","Name",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("name", null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),"autofocus",'placeholder'=>'Name']) !!}
                <span id="error-name" class="invalid-feedback" style="color: red">{{ $errors->has('name')? $errors->first('name') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            <label for="states[]" class="col-form-label col-md-3 col-lg-2">Categories</label>
            <div class="col-md-8">
                <select class="form-control" id="select2" name="categories[]" multiple="multiple">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                    @endforeach
                </select>
                <span id="error-categories" class="invalid-feedback" style="color: red">{{ $errors->has('categories') ? $errors->first('categories') : "" }}</span>
            </div>

        </div>



        <div class="form-group row">
            {!! Form::label("img","Image",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::file('img', ['accept' => 'images']) !!}
                <span id="error-img" class="invalid-feedback" style="color: red">{{ $errors->has('img')? $errors->first('img') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("author","Author",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("author",null,["class"=>"form-control".($errors->has('author')?" is-invalid":""),"autofocus",'placeholder'=>'Author']) !!}
                <span id="error-author" class="invalid-feedback" style="color: red">{{ $errors->has('author')? $errors->first('author') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("description","Description",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::textarea("description",null,["class"=>"form-control".($errors->has('description')?" is-invalid":""),'placeholder'=>'Description']) !!}
                <span id="error-description" class="invalid-feedback" style="color: red">{{ $errors->has('description')? $errors->first('description') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("publisher","Publisher",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("publisher",null,["class"=>"form-control".($errors->has('publisher')?" is-invalid":""),"autofocus",'placeholder'=>'Publisher']) !!}
                <span id="error-publisher" class="invalid-feedback" style="color: red">{{ $errors->has('publisher')? $errors->first('publisher') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("price","Price",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("price",null,["class"=>"form-control".($errors->has('price')?" is-invalid":""),"autofocus",'placeholder'=>'Price']) !!}
                <span id="error-price" class="invalid-feedback" style="color: red">{{ $errors->has('price')? $errors->first('price') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("discount","Discount",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("discount",null,["class"=>"form-control".($errors->has('discount')?" is-invalid":""),"autofocus",'placeholder'=>'Discount']) !!}
                <span id="error-discount" class="invalid-feedback" style="color: red">{{ $errors->has('discount')? $errors->first('discount') : "" }}</span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("quantity","Quantity",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("quantity",null,["class"=>"form-control".($errors->has('quantity')?" is-invalid":""),"autofocus",'placeholder'=>'Quantity']) !!}
                <span id="error-quantity" class="invalid-feedback" style="color: red">{{ $errors->has('quantity')? $errors->first('quantity') : "" }}</span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="{{route('book.index')}}" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</div>
    @if(!isset($id))
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    @endif
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#select2').select2();
        });
    </script>
</body>
</html>