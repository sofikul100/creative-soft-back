{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>Creative Soft --||-- Register </title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/pace/pace.css')}}" rel="stylesheet">
    

    
    <!-- Theme Styles -->
    <link href="{{asset('backend/assets/css/main.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend/assets/images/neptune.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/assets/images/neptune.png')}}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="app app-auth-sign-up align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="">
                <a href="{{route('login')}}">
                   <img src="{{asset('backend/assets/images/creative-soft-logo.png')}}" alt="" style="width:180px;height:auto">
                </a>
            </div>
            <p class="auth-description">Please enter your credentials to create an account.<br>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
            <div class="auth-credentials m-b-xxl">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control m-b-md @if ($errors->first('name'))
                is-invalid
            @endif" name="name" :value="old('name')" required id="name" aria-describedby="name" placeholder="Enter Name">
                <!------- error message show ---->
                @if ($errors->has('name'))
                    <p class="text-danger mt-1">{{$errors->first('name')}}</p> 
                @endif 
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control m-b-md @if ($errors->first('email'))
                is-invalid
                @endif" id="email" name="email" :value="old('email')" aria-describedby="email" required placeholder="Enter Your Email">
                 <!------- error message show ---->
                 @if ($errors->has('password'))
                 <p class="text-danger mt-1">{{$errors->first('email')}}</p> 
                @endif

                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @if ($errors->first('password'))
                is-invalid
                 @endif" id="password" aria-describedby="password" name="password" :value="old('password')" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                <div id="emailHelp" class="form-text m-b-md">Password must be minimum 8 characters length*</div>
                 <!------- error message show ---->
                 @if ($errors->has('password'))
                 <p class="text-danger mt-1">{{$errors->first('password')}}</p> 
                 @endif 
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @if ($errors->first('password_confirmation'))
                is-invalid
            @endif"  name="password_confirmation" required id="password_confirmation" aria-describedby="password_confirmation" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                
                
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
            <div class="divider"></div>            
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/main.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom.js')}}"></script>


</body>
</html>