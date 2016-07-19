<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Repositories\UserRepository;
use App\Http\Requests;
use App\User;


class UserController extends Controller
{
    protected $users;

    /**
     * UserController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $users = $this->users->forUser($request->user())->paginate(10);
        return view('user/index',['users'=>$users]);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->authorize('create');

        return view('user/create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->authorize('store');

        $rules = ['firstname' => 'required|alpha',
                  'lastname'  => 'required|alpha',
                  'email'     => 'required|email|unique:users',
                  'password'  => 'required',
                  'role'      => 'required'];

        $this->validate($request, $rules);
        
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->role = $request->role;

        $user->save();
        
        Session::flash('message', "Successfully created user ID".$user->id." ".$user->firstname);
        
            return (Redirect::to('users'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->user()->id == $user->id or $request->user()->role == 'admin')
            
            return view('user/show',['user'=>$user]);
        else
            abort(403);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id, Request $request)
    {
      //  $this->authorize('edit');

        $user = User::findOrFail($id);

        if ($request->user()->id == $user->id or $request->user()->role == 'admin')

            return view('user/edit',['user'=>$user]);
        else
            abort(403);

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $rules = ['firstname'  => 'required|alpha',
                  'lastname'  => 'required|alpha',
                   'role'     => 'required'];


        $user = User::findOrFail($id);

        if ($request->user()->id == $user->id or $request->user()->role == 'admin') {

            $this->validate($request, $rules);

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->role = $request->role;

            $user->save();

            Session::flash('message', "Successfully updated user ID" . $user->id . " "
                                                                   . $user->firstname);

            return (Redirect::to('users'));
        } else  abort(403);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->authorize('destroy');

        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('message', "Successfully deleted user ID".$user->id." ".$user->firstname);

        return (Redirect::to('users'));
    }
}
