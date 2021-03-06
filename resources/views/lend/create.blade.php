@extends('layouts/app')

@section('pagetitle')
    <div class="container">
    Charge Book
    </div>
@stop

@section('content')

    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">  ID  <b>{{$book->id}}</b> </div>
        <div class="panel-body">     Genre  <b>{{$book->genre}}</b> </div>
        <div class="panel-body">     Title   <b>{{$book->title}}</b> </div>
        <div class="panel-body">     Author  <b>{{$book->author}}</b> </div>
        <div class="panel-footer">   Is exist  <b>{{$book->is_exist}}</b> </div>
    </div>

    {!!  Form::open ( ['url'=>['books', $book->id, 'users',]])  !!}

    <div class ="form-group">
        {!!  Form::label('reader', 'Readers List') !!}
        <select class="form-control" name="reader"> Readers list
           @foreach($readers as $reader)
              <option value={{ $reader->id }}> {{$reader->firstname}}{{$reader->lastname}} </option>
           @endforeach
        </select>                       
    </div>

    <div class ="form-group">
    {!!  Form::hidden('book_id', $book->id, ['class'=>'form-control']) !!}
    </div>

    {!!  Form::submit('Charge',['class'=>'btn btn-primary']) !!}

    {!!  Form::close() !!}
    </div>

@stop