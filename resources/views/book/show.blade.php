@extends('layouts/app')

@section('pagetitle')
    <div class="container">
    Show Book
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

@if ($user)
    <div class="panel panel-success">
        <div class="panel-heading"> Hold on by</div>
        <div class="panel-body"> {{ $user->id}} {{ $user->firstname}} {{ $user->lastname}} </div>
    </div>


    {!!  Form::open (['url'=>['books/'.$book->id.'/users/'.$user->id]])  !!}
    {!!  Form::hidden('_method', 'PUT')  !!}
    {!!  Form::hidden('book_id', $book->id) !!}
    {!!  Form::hidden('user_id', $user->id) !!}
    {!!  Form::submit('Return this book',['class'=>'btn btn-warning']) !!}
    {!!  Form::close() !!}

@endif

@if (!$book->is_charged)
<a class=" btn btn-small btn-primary" href="{{ URL::to('books/'.$book->id.'/users/create') }}">Charge this book </a>
@endif
</div>
@stop