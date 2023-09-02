


@extends('backend.master')
@section('title')
     change-password
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Change Password</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                     
                                    <div class="example-container">
                                        <div class="example-content">
                                            <form class="row g-3" method="POST" action="{{route('change_password')}}">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" value="{{$current_user_data->name}}" id="name"  placeholder="Enter Name...">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Email" class="form-label">Email</label>
                                                    <input type="email" disabled class="form-control  @error('email') is-invalid @enderror" id="email" value="{{$current_user_data->email}}" name="email"  placeholder="Enter Email...">
                                                    {{-- @error('email')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror --}}
                                                </div>
                                                <div class="col-6">
                                                    <label for="current_password" class="form-label">Current Password</label>
                                                    <input type="text" class="form-control @error('current_password') is-invalid @enderror" id="current_password"  name="current_password" placeholder="Enter Current Password..">
                                                    {{-- @error('address')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror --}}
                                                    <small class="mt-1" id="show_message"></small>
                                                </div>

                                                <div class="col-6">
                                                    <label for="new_password" class="form-label">New Password</label>
                                                    <input type="text" class="form-control @error('new_password') is-invalid @enderror" id="new_password"  name="new_password" placeholder="Enter New Password..">
                                                    {{-- @error('address')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror --}}
                                                </div>

                                                <div class="col-6">
                                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"  name="password_confirmation" placeholder="Enter Confirm Password..">
                                                    {{-- @error('address')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror --}}
                                                </div>


                                                <div class="col-12">
                                                    <button type="submit" id="change_password" class="btn btn-primary">Change Password</button>
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
<script>
      $(document).ready(function(){
          $("#current_password").keyup(function (){
             let current_password = $("#current_password").val();


             $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{url('/check/current/password')}}",
                method:"POST",
                data:{
                    current_password:current_password
                },
                success:function(response){
                   if(response.success == true){
                     $("#show_message").html("<font class='text-success'>Password Is Currect..</font>");
                     $("#new_password").attr('disabled',false);
                     $("#password_confirmation").attr('disabled',false);
                     $("#change_password").attr('disabled',false)
                   }else{
                     $("#show_message").html("<font class='text-danger'>Password Is InCurrect.. </font>");
                     $("#new_password").attr('disabled','true');
                     $("#password_confirmation").attr('disabled',true);
                     $("#change_password").attr('disabled',true) 
  
                   }
                },
                error:function(error){
                   console.log(error)
                }



             });

          })
      })
</script>

@endsection
