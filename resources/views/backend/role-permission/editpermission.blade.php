


@extends('backend.master')
@section('title')
    Edit-Permission
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit Permission</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('update.permission',$permission->id)}}" method="POST">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label for="name" class="form-label">Permission Name</label>
                                                    <input type="text"  class="form-control @error('name') is-invalid @enderror" value="{{$permission->name}}" name="name"  id="name"  placeholder="Enter Permission Name...">
                                                    @error('name')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                            
                                                <div class="col-md-12 mt-4">
                                                    <label for="group_name" class="form-label">Group Name</label>
                                                    <select class="form-select  @error('group_name') is-invalid @enderror" name="group_name" aria-label="Default select example">
                                                      @foreach ($permissions as $item)
                                                           <option value="{{$item->group_name}}" {{$item->group_name == $permission->group_name ? 'selected':''}}>{{$item->group_name}}</option>
                                                      @endforeach  
                                                        

                                                    </select>
                                                    @error('group_name')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-4">
                                                   <a href=""><button class="btn btn-primary"><i class="material-icons m-auto text-center">update</i> Update</button></a>
                                                </div>

                                        </form>


                                        </div>
                                    </div>
                                </div>
                            </div>  
                </div>
            </div>
           
        </div>
    </div>


</div>
<!------- jquery-------->
<script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
