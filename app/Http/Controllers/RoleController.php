<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){
        return view('admin.roles.index',[

            'roles'=>Role::all(),

        ]);
    }

    public function store(){

        request()->validate([

            'name'=>['required']

        ]);

        Role::create([

            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')

        ]);
        // dd(request('name'));
        return back();
    }

    public function delete(Role $role)
    {
        $role->delete();
        session()->flash('deleted-role','Role was deleted',$role->name);
        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'roles'=>$role,
            'permissions'=>Permission::all()
        ]);
    }

    
    public function update(Role $role)
    {

        request()->validate([

            'name'=>['required']

        ]);

        $role->name = Str::ucfirst(request('name')) ;
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name'))
        {
            session()->flash('role-updated','Role is Updated : '.request('name'));
            $role->save();
        }
        else{
            session()->flash('role-updated','Nothing to update');
        }
        
        return back();

    }

    public function permission_attach(Role $roles)
    {
        // dd($roles);
         $roles->permissions()->attach(request('permission'));
         return back();
    }

    public function permission_detach(Role $roles)
    {
         $roles->permissions()->detach(request('permission'));
         return back();
    }
 
}
