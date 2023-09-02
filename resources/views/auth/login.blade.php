{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

 --}}



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
     <title>Creative Soft --||-- Login </title>
 
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
             <div class="">
                 <a href="{{route('login')}}">
                    <img src="{{asset('backend/assets/images/creative-soft-logo.png')}}" alt="" style="width:180px;height:auto">
                 </a>
             </div>
             <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="{{route('register')}}">Sign Up</a></p>

             <!-------show alert error message--------------->
             @if ($errors->has("email") || $errors->has('password'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$errors->first('email')}}</strong>
              </div>
             @endif


             <form method="POST" action="{{ route('login') }}">
                @csrf
             <div class="auth-credentials m-b-xxl">
                 <label for="email" class="form-label">Email address</label>
                 <input type="email" class="form-control @if ($errors->first('email'))
                     is-invalid
                 @endif m-b-md" id="email" name="email" :value="old('email')" required aria-describedby="signInEmail" placeholder="Enter Your Email..">

                
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control @if ($errors->first('email'))
                 is-invalid
                 @endif" id="password" name="password" required  aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                <!-----remember me ---->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div> 


             </div>

            
 
             <div class="auth-submit">
                 <button type="submit" href="#" class="btn btn-primary">Login</button>
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