<x-admin-master>

    @section('content')


    <h1>
        
        Edit role : {{$roles->name}}

     </h1>

     <div class="row">
         <div class="col-sm-6">

        @if(session()->has('role-updated'))

            <div class="alert alert-success">{{session('role-updated')}}</div>

        @endif


         <form action="{{ route('roles.update',$roles->id)}}" method="post" class="mt-5 ">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name :    </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{ $roles->name }}" name="name" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" >Update</button>
                    </div>    
                </form>
        </div>
     </div>


    <div class="row">
        <div class="col-12">
             <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">

                    @if(session()->has('deleted-role'))

                        <div class="alert alert-danger">{{session('deleted-role')}}</div>

                    @endif
           
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Option</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Option</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($permissions as $permission)

                                <tr>
                                    <td><input type="checkbox" name="" id=""
                                            @foreach($roles->permissions as $role_permission )
                                                @if($role_permission->slug == $permission->slug)
                                                    checked
                                                @endif
                                            @endforeach
                                        ></td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                     <td>
                                            <form method="post"  action="{{ route('role.permission.attach',$roles) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" class="hidden" name="permission" value="{{$permission->id}}" >
                                                <button class="btn btn-primary" 
                                                
                                                @if($roles->permissions->contains($permission))
                                                        disabled
                                                @endif

                                                >
                                                Attach
                                                </button>
                                            </form>    
                                    
                                        </td>

                                         <td>
                                            <form method="post"  action="{{ route('role.permission.detach',$roles) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" class="hidden" name="permission" value="{{$permission->id}}" >
                                                <button class="btn btn-danger" 
                                                
                                                @if(!$roles->permissions->contains($permission))
                                                        disabled
                                                @endif

                                                >
                                                Detach
                                                </button>
                                            </form>    
                                    
                                        </td>
     
                                </tr>

                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
        </div>
    </div>

    @endsection



</x-admin-master>