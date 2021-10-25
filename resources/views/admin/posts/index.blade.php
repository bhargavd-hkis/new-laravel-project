<x-admin-master>
    @section('content')

        <h1>All posts</h1>


            @if(session('message'))
                        <div class="alert alert-danger">{{ session('message')  }}</div>
            @elseif(session('post-created-message'))
                        <div class="alert alert-success">{{ session('post-created-message')  }}</div>
            @elseif(session('post-updated-message'))
                        <div class="alert alert-success">{{ session('post-updated-message')  }}</div>
            @endif
    
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Owner / Author</th>
                      <th>Title</th>
                      <th>Image</th>
                       <th>view post</th>
                       <th>View comment</th>
                      <th>Create Time/Date</th>
                      <th>Upadate Time/Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Owner / Author</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>view post</th>
                      <th>View comment</th>
                      <th>Create Time/Date</th>
                      <th>Upadate Time/Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td><a href="{{ route('post.edit',$post->id) }}">{{ $post->title }}</a></td>
                            <td><img src="{{ $post->post_image }} " height='45px' width='65px' ></td>
                            <td><a href="{{ route('post',$post->id) }}">View post</a></td>
                             <td><a href="{{ route('admin.comments.show',$post->id) }}">View comment</a></td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ $post->updated_at->diffForHumans() }}</td>
                            <td>
                    
                                <form method="post" action="{{ route('post.delete',$post->id) }}" enctype="multipart/file-data">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">DELETE</button>
                            </td>
                                </form>
                                
                        </tr>
                        @endforeach
                  </tbody>
                </table>

                    <div class="d-flex justify-content-center">
 
</div>

              </div>
            </div>
          </div>

      
      
    
    @endsection


    @section('scripts')

        
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            <!-- <script src="{{ asset('js/demo/datatables-demo.js')}}"></script> -->

    @endsection
</x-admin-master>