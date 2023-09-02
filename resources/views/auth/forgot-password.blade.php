{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
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
    <title>Creative Soft --||-- Forgot-Password </title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/pace/pace.css')}}" rel="stylesheet">
     
    <!---- toaster css --->
    <link rel="stylesheet" href="{{asset('backend/assets/css/toastr.min.css')}}">
    
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
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="mb-4">
                <a href="{{route('login')}}">
                   <img src="{{asset('backend/assets/images/creative-soft-logo.png')}}" alt="" style="width:180px;height:auto">
                </a>
            </div>
            
            <form method="POST" action="{{ route('password.email') }}">
               @csrf
            <div class="auth-credentials m-b-xxl">
                <label for="password" class="form-label">Email</label>
                <input type="email" name="email" :value="old('email')" class="form-control @if ($errors->first('email'))
                is-invalid
                @endif" id="email" name="email" required  aria-describedby="email" placeholder="Enter Your Account Email">
                <!------- error message show ---->
                @if ($errors->has('email'))
                    <p class="text-danger mt-1">{{$errors->first('email')}}</p> 
                @endif 
            </div>

           

            <div class="auth-submit">
                <button type="submit" href="#" class="btn btn-primary">Email Password Reset Link</button>
            </div>

            </form> 
            <div class="divider"></div>            
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{asset('backend/assets/plugins/jquery/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/main.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom.js')}}"></script>




    <script>
       @if(Session::has('message'))
       toastr.options =
       {
           "closeButton" : true,
           "progressBar" : true
       }
               toastr.success("{{ session('message') }}");
       @endif
     
       @if(Session::has('error'))
       toastr.options =
       {
           "closeButton" : true,
           "progressBar" : true
       }
               toastr.error("{{ session('error') }}");
       @endif
     
       @if(Session::has('info'))
       toastr.options =
       {
           "closeButton" : true,
           "progressBar" : true
       }
               toastr.info("{{ session('info') }}");
       @endif
     
       @if(Session::has('warning'))
       toastr.options =
       {
           "closeButton" : true,
           "progressBar" : true
       }
               toastr.warning("{{ session('warning') }}");
       @endif
     </script>
</body>
</html>