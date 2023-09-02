{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
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
    <title>Creative Soft --||-- Confirm-Password </title>

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
            <!-------show alert error message--------------->
            @if ($errors->has("email") || $errors->has('password'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>{{$errors->first('email')}}</strong>
             </div>
            @endif


            <form method="POST" action="{{ route('password.confirm') }}">
               @csrf
            <div class="auth-credentials m-b-xxl">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @if ($errors->first('email'))
                is-invalid
                @endif" id="password" name="password" required  aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>

           

            <div class="auth-submit">
                <button type="submit" href="#" class="btn btn-primary">Confirm</button>
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
</body>
</html>