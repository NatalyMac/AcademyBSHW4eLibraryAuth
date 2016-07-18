@extends('layouts/app')

@section('pagetitle')
    <div class="container">
    User List
    </div>
@stop

@section('content')

    <div class="container">

    <table class="table table-hover table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Books</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($users as $user)

    <tr>
        <td> {{ $user->id}}</td>
        <td> {{ $user->firstname}}</td>
        <td> {{ $user->lastname}}</td>
        <td> {{ $user->email}}</td>
       {{-- <td> {{ $user->lends()->whereNull('date_getin_fact')->count()}}</td>--}}
        <td> {{$user->book_count}}</td>
        <td width="380">

            <a class=" btn btn-small btn-primary" href="{{ URL::to('users/'.$user->id) }}">Show this user </a>
            <a class=" btn btn-small btn-success" href="{{ URL::to('users/'.$user->id.'/edit') }}">Edit this user </a>

            @if ($user->role == 'admin')
                {!!  Form::open (['url'=>['users/'.$user->id], 'class'=>'pull-right'])  !!}
                {!!  Form::hidden('_method', 'DELETE')  !!}
                {!!  Form::submit('Delete this user',['class'=>'btn btn-warning']) !!}
                {!!  Form::close() !!}
            @endif

        </td>
    </tr>

    @endforeach

    <div class="pagination">{{ $users->links() }}</div>
    </tbody>
    </table>
    </div>
@stop