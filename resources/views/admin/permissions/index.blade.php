<x-admin-master>

    @section('content')

        <h1>Permission</h1>

        <div class="row">

            <div class="col-sm-3">
                <form action="{{ route('permissions.store')}}" method="post" >

                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name">Name :    </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" >Create</button>
                    </div>    
                </form>
            </div>


            <div class="col-sm 9">
                 <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">

                    @if(session()->has('permission-delete'))

                        <div class="alert alert-danger">{{session('permission-delete')}}</div>

                    @endif
           
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td><a href="{{ route('permissions.edit',$permission->id) }}">{{ $permission->name }}</a></td>
                                    <td>{{ $permission->slug }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                    <td>
                                            <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalConfirmDelete" >DELETE</button>                                    
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

        <div
  class="modal fade"
  id="modalConfirmDelete"
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
          <form method="post" action="{{route('permissions.delete',$permission->id)}}">
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


    @endsection

</x-admin-master>