


@extends('backend.master')
@section('title')
     Edit-Role
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit Role</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('update.role',$role->id)}}" method="POST">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label for="name" class="form-label">Role Name</label>
                                                    <input type="text"  class="form-control @error('name') is-invalid @enderror" value="{{$role->name}}" name="name"  id="name"  placeholder="Enter Permission Name...">
                                                    @error('name')
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
