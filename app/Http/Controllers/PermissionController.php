<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){

        return view('admin.permissions.index',[
            'permissions'=>Permission::all(),
        ]);
    }

    public function store(){

        request()->validate([

            'name'=>['required']

        ]);

        Permission::create([

            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')


        ]);

        // session()->flash('update-permission','Permission is updated'.request('name'));



        return back();

    }

     public function edit(Permission $permission){
        
        return view('admin.permissions.edit',[

            'permissions'=>$permission

        ]);

    }

    public function delete(Permission $permission)
    {
        $permission->delete();
        session()->flash('permission-delete','Permission is deleted : '.$permission->name);
        return back();
    }

    public function update(Permission $permission)
    {
       request()->validate([

            'name'=>['required']

        ]);

        
        $permission->name = Str::ucfirst(request('name')) ;
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isDirty('name'))
        {
            session()->flash('permission-updated','Permission is Updated : '.request('name'));
            $permission->save();
        }
        else{
            session()->flash('permission-updated','Nothing to update');
        }
        
        return back();
      
    }
}
