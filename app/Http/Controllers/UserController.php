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
    
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;

    }

    public function index(Request $request)
    {
        $users = $this->users->forUser($request->user())->paginate(10);
        return view('user/index',['users'=>$users]);
    }

    public function create()
    {
        $this->authorize('create');

        return view('user/create');
    }

    public function store(Request $request)
    {
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

        $this->authorize('store');

        $user->save();
        
        Session::flash('message', "Successfully created user ID".$user->id." ".$user->firstname);
        
            return (Redirect::to('users'));
    }

    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->user()->id == $user->id or $request->user()->role == 'admin')
            return view('user/show',['user'=>$user]);
        else  return Redirect::to('users')->with('message','You do not have permission');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('edit');

        return view('user/edit',['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $rules = ['firstname' => 'required|alpha',
                  'lastname'  => 'required|alpha',
                  //'email'     => 'required|email|unique:users',
                  'role'      => 'required'];

        $this->validate($request, $rules);

        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role = $request->role;

        $this->authorize('update');

        $user->save();

        Session::flash('message', "Successfully updated user ID".$user->id." ".$user->firstname);

        return (Redirect::to('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('destroy');

        $user->delete();

        Session::flash('message', "Successfully deleted user ID".$user->id." ".$user->firstname);

        return (Redirect::to('users'));
    }
}
