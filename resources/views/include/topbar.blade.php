
    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo/loading.gif') }}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{ url('/') }}" class="nav-link"> EMS </a>
                </li>
            </ul>



            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user"
                    id="userProfileDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                       @if(Auth::user()->employee->image)
                        <img title="{{ Auth::user()->name }}" src="{{ asset('images/employee/'.Auth::user()->employee->image) }}" alt="{{ Auth::user()->name }}" />
                       @else
                        <img title="{{ Auth::user()->name }}" src="{{ asset('images/default_avatar.png') }}" alt="{{ Auth::user()->name }}">
                       @endif
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            @if(Session::has('theme'))
                            <div class="dropdown-item">
                            <a href="{{ route('admin.theme',['theme' => 'dark']) }}"><i class="fa fa-lightbulb fa-2x"></i>  Dark Theme</a>
                            </div>
                            @else
                            <div class="dropdown-item">
                                <a href="{{ route('admin.theme',['theme' => 'light']) }}"><i class="fa fa-lightbulb fa-2x"></i>  Light theme</a>
                            </div>
                            @endif
                            <div class="dropdown-item">
                                <a href="{{ route('password.change') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-lock">
                                 <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                </rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                &nbsp; Change Password</a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{ url('logout') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24"
                                     viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"
                                       stroke-linejoin="round"
                                        class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                                        </path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->
