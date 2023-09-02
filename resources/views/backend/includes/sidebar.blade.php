<div class="app-sidebar">
    <div class="logo">
        <a href="{{route('dashboard')}}" class="logo-icon"><span class="logo-text">Neptune</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="{{route('profile.edit')}}">
                @if (Auth::user()->avatar == NULL)
                <img src="{{asset('backend/assets/images/avatar.png')}}" alt="" style="width:40px;height:auto;border-radius:5%">
                @else
                <img src="{{asset('backend/profile_pictures')}}/{{Auth::user()->avatar}}" alt="">

                @endif
                <span class="user-info-text">{{ Auth::user()->name }}<br></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            
            <li class="active-page">
                <a href="{{route('dashboard')}}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">star</i>Settings<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('change.password')}}">Change Password</a>
                    </li>
                    <li>
                        <a href="invoice.html">Invoice</a>
                    </li>
                    <li>
                        <a href="settings.html">Settings</a>
                    </li>
                    <li>
                        <a href="#">Authentication<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="lock-screen.html">Lock Screen</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="error.html">Error</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-title">
                Site Management
            </li>
            <li>
                <a href="#"><i class="material-icons-two-tone">color_lens</i>Role And Permission<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    @if (Auth::user()->can('permission.menu'))
                    <li>
                        <a href="{{route('all.permission')}}">All Permission</a>
                    </li>
                    @endif
                    
                    @if (Auth::user()->can('role.menu'))
                    <li>
                        <a href="{{route('all.role')}}">All Role</a>
                    </li>
                    @endif
                    @if(Auth::user()->can('add.role_in_permission'))
                    <li>
                        <a href="{{route('role.permission')}}">Add Role In Permission</a>
                    </li>
                    @endif
                    @if (Auth::user()->can('all.role_in_permission'))
                    <li>
                        <a href="{{route('all.role.permission')}}">All Role In Permission</a>
                    </li>
                    @endif
                    
                </ul>
            </li>
            <li>
                <a href="#"><i class="material-icons-two-tone">grid_on</i>Manage Users<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    @if (Auth::user()->can('all.user_menu'))
                    <li>
                        <a href="{{route('all.users')}}">All Users</a>
                    </li>
                    @endif
                    
                    <li>
                        <a href=""></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">sentiment_satisfied_alt</i>Manage Section<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    @if (Auth::user()->can('logo.menu'))
                        <li>
                            <a href="{{route('logo.index')}}">Manage Logo</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('service.menu'))
                    <li>
                        <a href="{{route('service.index')}}">Manage Service</a>
                    </li>
                    @endif
                    @if (Auth::user()->can('team.menu'))
                    <li>
                        <a href="{{route('team.index')}}">Manage Team</a>
                    </li>
                    @endif
                    @if(Auth::user()->can('clientsay.menu'))
                    <li>
                        <a href="{{route('client_says.index')}}">Mange What Client Says</a>
                    </li>
                    @endif
                    @if (Auth::user()->can('slider.menu'))
                    <li>
                        <a href="{{route('slider.index')}}">Manage Slider</a>
                    </li>
                    @endif
                    
                </ul>
            </li>
            <li>
                <a href=""><i class="material-icons-two-tone">sentiment_satisfied_alt</i>Manage Our Projects<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    @if (Auth::user()->can('project.menu'))
                    <li>
                        <a href="{{route('project.index')}}">Manage Project</a>
                    </li>
                    @endif
                    @if (Auth::user()->can('project_d_section.menu'))
                    <li>
                        <a href="{{route('project_details.index')}}">Manage Project Details Section</a>
                    </li>
                    @endif
                    @if (Auth::user()->can('project_price.menu'))
                    <li>
                        <a href="{{route('project_pricing.index')}}">Manage Project Price</a>
                    </li>
                    @endif
                    
                </ul>
            </li>
        </ul>
    </div>
</div>