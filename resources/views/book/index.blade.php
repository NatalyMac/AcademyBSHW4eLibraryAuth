@extends('layouts/app')

@section('pagetitle')
    @if (Auth::user()->role == 'reader')
        <div class="container">
        Hi, {{ Auth::user()->firstname}},    your book list
        </div>
    @endif

    @if (Auth::user()->role == 'admin')
        <div class="container">
            Hi, {{ Auth::user()->firstname}},  all book list
        </div>
    @endif

@stop

@section('content')

    <div class="container">

    <table class="table table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Genre</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>

            @if (Auth::user()->role == 'admin')
                <th>Hold on by</th>
                <th> Action</th>
            @endif

            @if (Auth::user()->role == 'reader')
                <th>Date getout</th>
                <th>Date getin</th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($books as $book)
            <tr>
                <td> {{ $book->id}}</td>
                <td> {{ $book->genre}}</td>
                <td> {{ $book->title}}</td>
                <td> {{ $book->author}}</td>
                <td> {{ $book->year}}</td>

                @if (Auth::user()->role == 'admin')
                <td> {{ $book->firstname}} {{ $book->lastname}}</td>
                @endif

                @if (Auth::user()->role == 'reader')
                    <td> {{ $book->created_at}}</td>
                    <td> {{ $book->date_getin_fact}}</td>
                @endif

                 <td width="390">
                    <a class=" btn btn-small btn-primary" href="{{ URL::to('books/'.$book->id) }}">Show this book </a>
                    <a class=" btn btn-small btn-success" href="{{ URL::to('books/'.$book->id.'/edit') }}">Edit this book </a>
                    {!!  Form::open (['url'=>['books/'.$book->id], 'class'=>'pull-right'])  !!}
                    {!!  Form::hidden('_method', 'DELETE')  !!}
                    {!!  Form::submit('Delete this book',['class'=>'btn btn-warning']) !!}
                    {!!  Form::close() !!}
                 </td>

{{--
                @foreach($book->lends as $lend)
                    @if ($lend->date_getin_fact == null)
                         <td> {{$lend->user->firstname}} </td>
                    @endif
                @endforeach
--}}

            </tr>
        @endforeach


     <div class="pagination">{{ $books->links() }}</div>
        </tbody>
    </table>
    </div>
@stop
