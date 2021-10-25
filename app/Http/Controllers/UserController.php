<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function show(User $user)
    {

        return view('admin/users/index',[
            'user'=>$user,
            'roles'=>Role::all()
        ]);
    }


    public function update(User $user)
    {


        $inputs = request()->validate([

            'username'=>['required','string','max:255','alpha_dash'],
            'name'=>['required','string','max:255'],
            'email'=>['required','email','max:255'],
            'avatar'=>['file'],


        ]);

        if($file = request('avatar')){
              $name = $file->getClientOriginalName();
            $file->move('uploads',$name);
            
            $inputs['avatar'] = $name;

        
           
        }


        $user->update($inputs);

        return back();
        
    }


    public function index()
    {

        $users = User::paginate(3);

        return view('admin.users.show',['users'=>$users]);
    }

    public function delete(User $user)
    {
        $user->delete();

        session()->flash('user-delete','User was deleted');

        return back();
    }

    public function attach(User $user)
    {

        $user->roles()->attach(request('role'));
        return back();

    }

     public function detach(User $user)
    {

        $user->roles()->detach(request('role'));
        return back();

    }



}
