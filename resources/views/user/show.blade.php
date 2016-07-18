@extends('layouts/app')

{{--@section('pagetitle')
    Show User
@stop--}}

@section('content')
    <div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">  ID  <b>{{$user->id}}</b> </div>
        <div class="panel-body">     Firstname  <b>{{$user->firstname}}</b> </div>
        <div class="panel-body">     Lastname   <b>{{$user->lastname}}</b> </div>
        <div class="panel-body">     Email  <b>{{$user->email}}</b> </div>
        <div class="panel-footer">   {{$user->role }} from  {{$user->created_at }} </div>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Genre</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Date getin plan</th>
            <th>Date getin fact</th>
            <th> Action</th>
        </tr>
        </thead>

        <tbody>

        <h3> Book history</h3>

        @foreach ($user->lends as $lend)
            <tr>
                <td> {{ $lend->book->id}}</td>
                <td> {{ $lend->book->genre}}</td>
                <td> {{ $lend->book->title}}</td>
                <td> {{ $lend->book->author}}</td>
                <td> {{ $lend->book->year}} </td>
                <td> {{ $lend->date_getin_plan}}</td>
                <td> {{ $lend->date_getin_fact}}</td>

                <td>
                    @if ($lend->date_getin_fact == null)
                     {!!  Form::open (['url'=>['users/'.$user->id.'/books/'.$lend->book->id]])  !!}
                     {!!  Form::hidden('_method', 'PUT')  !!}
                     {!!  Form::hidden('book_id', $lend->book->id) !!}
                     {!!  Form::hidden('user_id', $user->id) !!}
                     {!!  Form::submit('Return this book',['class'=>'btn btn-warning']) !!}
                     {!!  Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@stop