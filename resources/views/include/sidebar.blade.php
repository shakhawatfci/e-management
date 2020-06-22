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
                    <!-- Vendor menu  -->
                    <li class="menu @if(Route::is('supplier.index')) active active_url @endif">
                        <a href="{{ route('supplier.index') }}" data-active="@if(Route::is('supplier.index')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                              <span>Vendor</span>
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

                    <li class="menu @if(Route::is('project.index')) active active_url @endif">
                        <a href="{{ route('project.index') }}" data-active="@if(Route::is('project.index')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                              <span>Project</span>
                            </div>
                        </a>
                    </li>

                    <!-- expense Head  -->

                    <li class="menu">
                        <a href="#expense" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span>Expense Heads</span>
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
                         id="expense" data-parent="#accordionExample">
                            <li class="@if(Route::is('expense-equipment.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('expense-equipment.index') }}" >Equipment Expense </a>
                            </li>
                            <li  class="">
                                <a href="#">Project Expense </a>
                            </li>
                            <li  class="">
                                <a href="#">Office Expense </a>
                            </li>
                        </ul>
                    </li>

                    <!-- /expense Head  -->
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
            </nav>

        </div>
        <!--  END SIDEBAR  -->