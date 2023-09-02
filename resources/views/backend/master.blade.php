@include('backend.includes.styles')
<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        {{-- sider bar here --}}
 
         @include('backend.includes.sidebar')

        {{-- end side bar  --}}
        <div class="app-container">
            <div class="search">
                <form>
                    <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
            </div>
           
            {{-- header start --}}
               @include('backend.includes.header')
            {{-- end header part --}}



            {{-- main content here --}}


             @yield('main_content')


            {{-- main content end --}}

           
        </div>
    </div>
    
    <!-- Javascripts -->
    @include('backend.includes.scripts')
</body>
</html>

