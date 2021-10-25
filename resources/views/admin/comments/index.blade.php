<x-admin-master>

        @section('content')

        <h1>comments</h1>

<div class="row">
        <div class="col-12">
                 <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">

                        @if(session('comment-delete'))
                            <div class="alert alert-danger">{{session('comment-delete')}}</div>
                        @endif

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>author</th>
                                <th>Post Title</th>
                                <th>Comment</th>
                                <th>Redirect</th>
                                <th>Approval</th>
                                <th>Delete Comment</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               <th>ID</th>
                                <th>author</th>
                                <th>Post Title</th>
                                <th>Comment</th>
                                <th>Redirect</th>
                                <th>Approval</th>
                                <th>Delete Comment</th>
                            </tr>
                        </tfoot>
                        <tbody>
                         @foreach($comments as $comment)
                         
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->author }}</td>
                                <td>{{ $comment->post->title }}</td>
                               
                                <td>{{ $comment->body }}</td>
                                <td><a href="{{ route('post',$comment->post->id) }}">Redirect to post</a></td>
                                <td>
                                     @if($comment->is_active == 1)
                                    <form name="comment_active" method="post">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="is_active" value='0'>    
                                            <label class="switch">
                                            <input type="checkbox" name="checkbox_status"  onChange="toggleClient(0,{{ $comment->id }});" checked>
                                            <span class="slider round"></span>
                                            </label>
                                    
                                    </form>
                                @else
                                    <form name="comment_active" method="post">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="is_active" value='1'>    
                                            <label class="switch">
                                            <input type="checkbox" onChange="toggleClient(1,{{ $comment->id }});" name="checkbox_status">
                                            <span class="slider round"></span>
                                            </label>
                                    
                                    </form>
                                @endif 
                                </td>
                                

                                <td>

                                  <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalConfirmDelete{{$comment->id}}">DELETE</button>                                    


                                </td>

                            </tr>



                         
           <div
  class="modal fade"
  id="modalConfirmDelete{{$comment->id}}"
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
         <button class="btn btn-danger" onclick="delete_fun({{$comment->id}})"  data-dismiss="modal">Yes</button>
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
            </div>

</div>


        @endsection

</x-admin-master>




<script>

function toggleClient(status,id)
{
    var toggle = $("#active_"+status).is(":checked");
    var url = "{{ route('comment.update',':id') }}";
    url = url.replace(':id', id);
    $.ajax({
        type: "PUT",
        url: url,
        data :{
            "_token": "{{ csrf_token() }}",
            "id": id,
            "is_active":status

        },
        success: function(data) {
                $('#dataTable').html(response);
    }
    });
}



function delete_fun(id){
    var url = "{{ route('comment.delete',':id') }}";
    url = url.replace(':id', id);
    $.ajax({
        type: "DELETE",
        url: url,
        data :{
            "_token": "{{ csrf_token() }}",
            "id": id
        },
       
    });
    $("#dataTable").load(window.location.href + " #dataTable" );
}
</script>