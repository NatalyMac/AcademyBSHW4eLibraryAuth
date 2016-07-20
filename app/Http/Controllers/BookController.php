<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Redirect, Session};

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Book;


class BookController extends Controller
{
    protected $books;

    /**
     * BookController constructor.
     * @param BookRepository $books
     */
    public function __construct(BookRepository $books)
    {
        $this->middleware('auth');
        $this->books = $books;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $books = $this->books->forUser($request->user())->paginate(10);
       
        return view('book/index',['books'=>$books]);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $book = new Book();
        $this->authorize('create', $book);

        return view('book/create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
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

        $this->authorize('store', $book);

        $book->save();

        Session::flash('message', 'Successfully created book ID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = null;
        $book = Book::findOrFail($id);

        $this->authorize('show', $book);

        if ($book->isCharged())
            $user = $book->getBookHolder();


        return view('book/show',['book'=>$book, 'user'=>$user ]);
    }

    /**
     * @param $id
     * @return mixed
     * @return mixed
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $this->authorize('edit', $book);

        return view('book/edit',['book'=>$book]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $this->authorize('update',$book);

        $rules = ['genre'  => 'required|alpha',
                  'author' => 'required|alpha',
                  'title'  => 'required',
                  'year'   => 'required|numeric',];

        $this->validate($request, $rules);

        $book->genre = $request->genre;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;

        $book->save();

        Session::flash('message', 'Successfully updated bookID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $this->authorize('destroy', $book);

        $book->delete();
        
        Session::flash('message', 'Successfully deleted book ID'.$book->id." ".$book->title);

        return (Redirect::to('books'));
    }

}
