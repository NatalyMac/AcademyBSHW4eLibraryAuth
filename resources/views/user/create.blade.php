@extends('layouts/app')

@section('pagetitle')
    <div class="container">
    Create User
    </div>
@stop

@section('content')
    <div class="container">

    {!! HTML::ul($errors->all()) !!}


    {!!  Form::open (['url'=>['users']])  !!}

    <div class ="form-group">
        {!!  Form::label('firstname', 'FirstName') !!}
        {!!  Form::text('firstname', Form::old('firstname'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('lastname', 'LastName') !!}
        {!!  Form::text('lastname', Form::old('lastname'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('email', 'Email') !!}
        {!!  Form::text('email', Form::old('email'), ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('password', 'Password') !!}
        {!!  Form::text('password', '', ['class'=>'form-control']) !!}

    </div>

    <div class ="form-group">

        {!!  Form::label('role', 'Role') !!}
        {!!  Form::select('role', ['reader'=>'reader', 'worker'=>'worker', 'admin'=>'admin'], 'reader')!!}

    </div>

    {!!  Form::submit('Save',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
    </div>

@stop