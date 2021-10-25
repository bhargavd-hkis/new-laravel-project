<x-admin-master>

    @section('content')


    <h1>
        
        Edit role : {{$permissions->name}}

     </h1>

     <div class="row">
         <div class="col-sm-6">

        @if(session()->has('permission-updated'))

            <div class="alert alert-success">{{session('permission-updated')}}</div>

        @endif


         <form action="{{ route('permissions.update',$permissions->id)}}" method="post" class="mt-5 ">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name :    </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{ $permissions->name }}" name="name" id="name">
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


    @endsection



</x-admin-master>