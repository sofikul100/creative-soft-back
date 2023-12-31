<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>
        Creative Soft -||- @yield('title') 
    </title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/perfectscroll/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/pace/pace.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/plugins/summernote/summernote-lite.min.css')}}" rel="stylesheet">
    <!-- toaster message -->
    <link rel="stylesheet" href="{{asset('backend/assets/css/toastr.min.css')}}">
    
    <!-- Theme Styles -->
    <link href="{{asset('backend/assets/css/main.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend/assets/images/neptune.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/assets/images/neptune.png')}}" />
</head>