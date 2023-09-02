


@extends('backend.master')
@section('title')
    Add-New-User
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Add New User</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="example-container">
                                        <div class="example-content">

                                            <form action="{{route('add.user')}}" method="POST">
                                                @csrf
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name"  id="name"  placeholder="Enter Name...">
                                                        @error('name')
                                                        <p class="text-danger mt-2">{{$message}}</p>
                                                      @enderror
                                                    </div>
    
                                                    <div class="col-md-6 mt-2">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email"  id="email"  placeholder="Enter Email...">
                                                        @error('email')
                                                        <p class="text-danger mt-2">{{$message}}</p>
                                                      @enderror
                                                    </div>
    
                                                    <div class="col-md-6 mt-2">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password"  id="password"  placeholder="Enter Password...">
                                                        @error('password')
                                                        <p class="text-danger mt-2">{{$message}}</p>
                                                      @enderror
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="role" class="form-label">Assign Role</label>
                                                        <select class="form-select  @error('role') is-invalid @enderror" name="role" aria-label="Default select example">
                                                            <option selected disabled>Select Role Name</option>
                                                           @foreach ($roles as $role)
                                                           <option value="{{$role->id}}">{{$role->name}}</option>
                                                           @endforeach
                                                            
                                                         
                                                            
                                                     </select>
                                                     @error('role')
                                                       <p class="text-danger mt-2">{{$message}}</p>
                                                     @enderror
                                                        
                                                    </div>
                                                    <div class="col-md-12 mt-4">
                                                       <a href=""><button class="btn btn-primary"><i class="material-icons m-auto text-center">add</i>Add Now</button></a>
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
<script>
     $("#permission_all").click(function () { 
          if($(this).is(':checked')){
             $('input[type=checkbox]').prop('checked',true)
          }else{
             $('input[type=checkbox]').prop('checked',false)
          }
      });
</script>
@endsection
