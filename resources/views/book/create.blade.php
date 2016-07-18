@extends('layouts/app')

@section('pagetitle')
    <div class="container">
    Create Book
    </div>
@stop

@section('content')

    <div class="container">

    {!! HTML::ul($errors->all()) !!}

    {!!  Form::open (['url'=>['books']])  !!}

    <div class ="form-group">
        {!!  Form::label('genre', 'Genre') !!}
        {!!  Form::text('genre', Form::old('genre'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('title', 'Title') !!}
        {!!  Form::text('title', Form::old('title'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('author', 'Author') !!}
        {!!  Form::text('author', Form::old('author'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('year', 'Year') !!}
        {!!  Form::text('year', '', ['class'=>'form-control']) !!}

    </div>


    {!!  Form::submit('Save',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}

    </div>

@stop