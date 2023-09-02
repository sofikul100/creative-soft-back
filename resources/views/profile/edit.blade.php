{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}



@extends('backend.master')
@section('title')
     profile
@endsection
@section('main_content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Your Profile</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header m-auto -mt-4">
                                    @if (Auth::user()->avatar == NULL)
                                    <img src="{{asset('backend/assets/images/avatar.png')}}" alt="{{$current_user_data->name}}" style="border-radius:100%;width:120px;height:auto">
                                    @else
                                    <img src="{{asset('backend/profile_pictures')}}/{{Auth::user()->avatar}}" alt="" style="border-radius:100%;width:120px;height:auto">
                                    @endif   
                                </div>
                                <div class="card-body">

                                    <div class="example-container">
                                        <div class="example-content">
                                            <form class="row g-3" method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$current_user_data->name}}" placeholder="Enter Name...">
                                                    @error('name')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Email" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$current_user_data->email}}" placeholder="Enter Email...">
                                                    @error('email')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{$current_user_data->address}}" name="address" placeholder="Enter Current Address..">
                                                    @error('address')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" value="{{$current_user_data->phone}}" id="phone" name="phone" placeholder="Enter Phone...">
                                                    @error('phone')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="avatar" class="form-label">Avatar</label>
                                                    <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror">
                                                    @error('avatar')
                                                      <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12" id="avatar_preview_section">
                                                    <img src="" id="preview_avatar" alt="avatar" style="height:auto;width:150px">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
        //----------for avatar preview-----------//
         $("#avatar_preview_section").css("display", "none");
         $("#avatar").change(function (){
            let reader= new FileReader();
             
            reader.onload = (e) =>{
                $("#avatar_preview_section").css("display", "block");
                $('#preview_avatar').attr('src', e.target.result); 
            }

            reader.readAsDataURL(this.files[0]); 
         })

         //-----------next code will be here------------//
      })
</script>

@endsection
