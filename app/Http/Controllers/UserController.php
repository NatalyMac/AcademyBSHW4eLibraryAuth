<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Redirect, Session};

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
        $this->authorize('create', \Auth::user());

        return view('user/create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->authorize('store', \Auth::user());
        
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
   
    public function show($id)
    {
        $user = User::findOrFail($id);
    
        $this->authorize('show', $user, $id);
    
           return view('user/show',['user'=>$user]);
    }
    
    /**
     * @param $id
     * @return mixed
     */

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('edit', $user, $id);

            return view('user/edit',['user'=>$user]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user, $id);

        $rules = ['firstname' => 'required|alpha',
                  'lastname'  => 'required|alpha',
                  'email'     => 'required|email'];

        $this->validate($request, $rules);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if (\Auth::user()->isAdmin())
            $user->role = $request->role;

        $user->save();

        Session::flash('message', "Successfully updated user ID" . $user->id . " "
                                                                   . $user->firstname);
            return (Redirect::to('users'));
    }

    /**
     * @param $id
     * @return mixed
     */
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('destroy', \Auth::user());

        $user->delete();

        Session::flash('message', "Successfully deleted user ID".$user->id." ".$user->firstname);

        return (Redirect::to('users'));
    }
}
