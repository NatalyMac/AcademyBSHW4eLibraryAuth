<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Book;
use App\User;
use App\Lend;

class LendController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($book_id)
    {
        $readers = User::where('role', '=', 'reader')->select('id', 'firstname', 'lastname')->get();
        $book = Book::find($book_id);

        return view('lend/create', ['book'=>$book, 'readers'=>$readers]);
    }

    public function store(Request $request)
    {
       $book = Book::find($request->book_id);

        if (!$book->is_charged) {

            $lend = new Lend();
            $lend->user_id = $request->reader;
            $lend->book_id = $request->book_id;
            $lend->date_getin_plan = date('Y:m:d H:m:s', (time() + 60000));

            $lend->save();

            $book->is_charged = true;
            $book->save();

            Session::flash('message', 'Successfully charged '. $book->title);

            return (Redirect::to('books'));

        } else {

            Session::flash('message', 'This books has been charged');

            return (Redirect::to('books'));
        }

    }

    
    public function update(Request $request)
    {
        $book_id = $request->book_id;
        $user_id = $request->user_id;

        $book = Book::find($book_id);

        $lend = Lend::whereNull('date_getin_fact')
            ->where('book_id', '=', $book_id)
            ->where('user_id', '=', $user_id)->first();

        $lend->date_getin_fact = date ('Y:m:d H:m:s', time());

        $book->is_charged = false;

        $lend->save();
        $book->save();

        Session::flash('message', "This books succesfully discharged");

        $path = $request->getPathInfo();

        if (strpos($path, 'books')<> 1)
            return Redirect::to('users/'.$user_id);
                else
                    return Redirect::to('books');

    }

}
