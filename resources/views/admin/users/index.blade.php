<x-admin-master>

    @section('content')

        <h1>User profile : {{ $user->name }}</h1>


        <form method="post" action="{{ route('user.profile.update',$user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <img height="100px" width="100px" class="img-profile rounded-circle" src="{{ $user->avatar }}">
                        </div>

                        <div class="form-group">
                            <input type="file" name="avatar" id="avatar" class="file">
                        </div>
                          
                        
                        <div class="form-group">
                            <label for="username">User Name</label>
                                <input type="text"
                                       name="username"
                                       class="form-control @error('username') is-invalid @enderror"
                                       id="username"
                                       value="{{ $user->username }}"
                                       aria-describedby=""
                                       placeholder="Enter User Name">
                                        @error('username')
                                                <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                                      
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control {{$errors->has('name') ? 'is-invalid' : '' }} "
                                       id="name"
                                       value="{{ $user->name }}"
                                       aria-describedby=""
                                       placeholder="Enter Name">
                                        @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                                    
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                                <input type="text"
                                       name="email"
                                       class="form-control {{$errors->has('email') ? 'is-invalid' : '' }} "
                                       id="email"
                                         value="{{ $user->email }}"
                                       aria-describedby=""
                                       placeholder="Enter Email">
                                        @error('email')
                                                <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                                     
                        </div>

                           <div class="form-group">
                            <label for="password">Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       id="password"
                                       aria-describedby=""
                                       placeholder="Enter password">
                                        @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
             
                        </div>
                       
                          <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       id="password_confirmation"
                                       aria-describedby=""
                                       placeholder="Enter password Confirmation">
                                        @error('password_confirmation')
                                                <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                        </div>
                       

                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>



           <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles : </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Options</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Options</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox" name="" id=""
                                @foreach($user->roles as $user_slug )
                                    @if($user_slug->slug == $role->slug)
                                        checked
                                    @endif
                                @endforeach
                            ></td>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->slug }}</td>
                            <td>
                                <form method="post"  action="{{ route('user.role.attach',$user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" class="hidden" name="role" value="{{$role->id}}" >
                                    <button class="btn btn-primary" 
                                     
                                    @if($user->roles->contains($role))
                                            disabled
                                    @endif

                                    >
                                     Attach
                                    </button>
                                </form>    
                        
                            </td>
                            <td> <form method="post"  action="{{ route('user.role.detach',$user) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" class="hidden" name="role" value="{{$role->id}}" >
                                    <button class="btn btn-danger"
                                    
                                    @if(!$user->roles->contains($role))
                                            disabled
                                    @endif

                                    >
                                    Detach
                                    </button>
                                </form> </td>

                        </tr>
                   

                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    @endsection


</x-admin-master>