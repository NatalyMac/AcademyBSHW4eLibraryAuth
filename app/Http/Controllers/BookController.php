<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gate;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Book;



class BookController extends Controller
{
    protected $books;

    public function __construct(BookRepository $books)
    {
        $this->middleware('auth');
        $this->books = $books;
    }

    public function index(Request $request)
    {
        $books = $this->books->forUser($request->user())->paginate(10);
       
        return view('book/index',['books'=>$books]);
    }

    public function create()
    {
        $this->authorize('create');
        return view('book/create');
    }

    public function store(Request $request)
    {
        $this->authorize('store');

        $rules = ['genre'  => 'required|alpha',
                  'author' => 'required|alpha',
                  'title'  => 'required',
                  'year'   => 'required|numeric',];

        $this->validate($request, $rules);

        $book = new Book();
        $book->genre = $request->genre;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;

        $book->save();

        Session::flash('message', 'Successfully created book ID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

    public function show($id)
    {
        $user = null;
        $book = Book::findOrFail($id);

        $this->authorize('show', $book);

        if ($book->lends()->whereNull('date_getin_fact')->first()) {
            $user = $book->lends()->whereNull('date_getin_fact')->first()->user()->first();
        }

        return view('book/show',['book'=>$book, 'user'=>$user ]);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('edit');
        
        return view('book/edit',['book'=>$book]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update');

        $rules = ['genre'  => 'required|alpha',
                  'author' => 'required|alpha',
                  'title'  => 'required',
                  'year'   => 'required|numeric',];

        $this->validate($request, $rules);

        $book = Book::findOrFail($id);
        $book->genre = $request->genre;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;

        $book->save();

        Session::flash('message', 'Successfully updated bookID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

    public function destroy($id)
    {
        $this->authorize('destroy');
        
        $book = Book::findOrFail($id);

        $book->delete();
        
        Session::flash('message', 'Successfully deleted book ID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

}
