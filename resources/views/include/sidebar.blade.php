        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">

                   <li class="menu">
                        <a href="{{ url('/') }}" aria-expanded="false" 
                        data-active="@if(request()->is('/')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    
                <!-- equipment menu  -->

                    <li class="menu">
                        <a href="#equipment" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24"
                              viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" 
                               stroke-width="2" stroke-linecap="round" 
                               stroke-linejoin="round"
                                class="feather feather-truck">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8">
                                </polygon>
                                <circle cx="5.5" cy="18.5" r="2.5">
                                </circle><circle cx="18.5" cy="18.5" r="2.5">
                                </circle>
                                </svg>
                                <span>Equipment</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" 
                                 stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round" class="feather feather-chevron-right">
                                  <polyline points="9 18 15 12 9 6"></polyline>
                                  </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled"
                         id="equipment" data-parent="#accordionExample">
                            <li class="@if(Route::is('equipment-type.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('equipment-type.index') }}" > Equipment Type </a>
                            </li>
                            <li  class="@if(Route::is('equipment.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('equipment.index') }}"> Equipment </a>
                            </li>
                        </ul>
                    </li>

                    <!-- equipment menu  -->

                   <li class="menu">
                        <a href="{{ route('assign-equipment.index') }}" aria-expanded="false"
                         data-active="@if(Route::is('assign-equipment.index')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                            width="24" height="24" 
                            viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-home">
                              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                              <polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Assign Equipment</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu @if(Route::is('supplier.index')) active active_url @endif">
                        <a href="{{ route('supplier.index') }}" data-active="true" class="dropdown-toggle">
                            <div class="">
                              <span><i class="far fa-plus-square"></i>&nbsp; Vendor</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu @if(Route::is('project.index')) active active_url @endif">
                        <a href="{{ route('project.index') }}" data-active="true" class="dropdown-toggle">
                            <div class="">
                              <span><i class="far fa-plus-square"></i>&nbsp; Project</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
            </nav>

        </div>
        <!--  END SIDEBAR  -->