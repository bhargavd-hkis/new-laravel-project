<x-admin-master>
    @section('content')

        <h1>Edit</h1>

                <form method="post" action="{{route('post.update',$posts->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       value="{{ $posts->title }}"
                                       aria-describedby=""
                                       placeholder="Enter title">
                        </div>
                        <div class="form-group">
                                <label for="file">File</label>
                                <input type="file"
                                       name="post_image"
                                       value="{{ $posts->post_image }}"
                                       class="form-control-file"
                                       id="post_image">
                                      <div > <img src="{{ $posts->post_image }}" alt="" height="45px" width="75px" > </div>
                        </div>


                        <div class="form-group">
                         <textarea
                                 name="body"
                                 class="form-control"
                                 id="body"
                                 cols="30"
                                 rows="10">{{ $posts->body }}</textarea>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>



    @endsection
</x-admin-master>