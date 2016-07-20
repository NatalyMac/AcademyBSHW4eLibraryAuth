<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Redirect, Session};

use App\Http\Requests;
use App\{Book, User, Lend};


class LendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $book_id
     * @return mixed
     */
    public function create($book_id)
    {
        $lend = new Lend();

        $this->authorize('create', $lend);

        $readers = User::getReaders();
        $book = Book::find($book_id);

        return view('lend/create', ['book'=>$book, 'readers'=>$readers]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $book = Book::find($request->book_id);

        if (!$book->is_charged) {

            $lend = new Lend();
            $lend->user_id = $request->reader;
            $lend->book_id = $request->book_id;
            $lend->date_getin_plan = date('Y:m:d H:m:s', (time() + 60000));

            $this->authorize('store', $lend);

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
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $lend = Lend::getLend($request->book_id, $request->user_id);

        $this->authorize('update', $lend);

        $book = Book::find($request->book_id);
        $lend->date_getin_fact = date ('Y:m:d H:m:s', time());
        $book->is_charged = false;

        $lend->save();
        $book->save();

        Session::flash('message', "This books succesfully discharged");

        $path = $request->getPathInfo();

        if (strpos($path, 'books')<> 1)
            return Redirect::to('users/'.$request->user_id);
                else
                    return Redirect::to('books');

    }
}
