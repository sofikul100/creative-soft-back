


@extends('backend.master')
@section('title')
    Edit-User
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Edit User</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('user.update',$user->id)}}" method="POST">
                                                @csrf
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}"  id="name"  placeholder="Enter Name...">
                                                        @error('name')
                                                        <p class="text-danger mt-2">{{$message}}</p>
                                                      @enderror
                                                    </div>
    
                                                    <div class="col-md-6 mt-2">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email"  class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" name="email"  id="email"  placeholder="Enter Email...">
                                                        @error('email')
                                                        <p class="text-danger mt-2">{{$message}}</p>
                                                      @enderror
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="role" class="form-label">Assign Role</label>
                                                        <select class="form-select  @error('role') is-invalid @enderror" name="role" aria-label="Default select example">
                                                            <option selected disabled>Select Role Name</option>
                                                           @foreach ($roles as $role)
                                                           <option value="{{$role->id}}" {{$user->hasRole($role->name) ? 'selected':''}}>{{$role->name}}</option>
                                                           @endforeach
                                                            
                                                         
                                                            
                                                     </select>
                                                     @error('role')
                                                       <p class="text-danger mt-2">{{$message}}</p>
                                                     @enderror
                                                        
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                       <a href=""><button type="submit" class="btn btn-primary"><i class="material-icons m-auto text-center">add</i>Update Now</button></a>
                                                    </div>
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
