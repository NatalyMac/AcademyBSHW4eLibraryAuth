<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Repositories\UserRepository;
use App\Http\Requests;
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest, EditUserRequest, ShowUserRequest};
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
    public function store(StoreUserRequest $request)
    {
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
    public function show(ShowUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
            return view('user/show',['user'=>$user]);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit(EditUserRequest $request,  $id)
    {
        $user = User::findOrFail($id);
            return view('user/edit',['user'=>$user]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if (\Auth::user()->role == 'admin')
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
        $this->authorize('destroy');

        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('message', "Successfully deleted user ID".$user->id." ".$user->firstname);

        return (Redirect::to('users'));
    }
}
