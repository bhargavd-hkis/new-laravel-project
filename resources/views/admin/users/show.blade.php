<x-admin-master>

    @section('content')


            <h1>Users</h1>

              <!-- Begin Page Content -->
       

          <!-- Page Heading -->
        

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

    @if(session('user-delete'))

        <div class="alert alert-danger">{{session('user-delete')}}</div>

    @endif

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>avatar</th>
                      <th>Name</th>
                      <th>Register Date</th>
                      <th>Updated Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>avatar</th>
                      <th>Name</th>
                      <th>Register Date</th>
                      <th>Updated Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   @foreach($users as $user)

                    <tr>
                        <td>{{$user->id}}</td>
                        <td><a href="{{route('user.profile.show',$user->id)}}">{{$user->username}}</a></td>
                        <td><img src="{{$user->avatar}}" alt="" height="45px" width="75px" ></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td>

                        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalConfirmDelete{{$user->id}}">DELETE</button>                                    
                         
                        </td>
                    </tr>
 <div
  class="modal fade"
  id="modalConfirmDelete{{$user->id}}"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
    >
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Are you sure?</p>
      </div>

      <!--Body-->
      <div class="modal-body">
        <i class="fas fa-times fa-4x animated rotateIn"></i>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
          <form method="post" action="{{ route('user.delete',$user->id) }}">

                @csrf
                 @method('DELETE')
                <button class="btn btn-danger">Yes</button>
        </form>

        <button
          type="button"
          class="btn btn-success "
          data-dismiss="modal"
          >No</button>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


{!! $users->links() !!}


          
    @endsection

       
       
     

    @section('scripts')

        
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            

    @endsection
</x-admin-master>