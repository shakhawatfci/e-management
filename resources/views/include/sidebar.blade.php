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


                <!-- Project Menu  -->

                    <li class="menu">
                        <a href="#project" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                <span>Project</span>
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
                         id="project" data-parent="#accordionExample">
                            <li class="@if(Route::is('project.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('project.index') }}" > Manage Project </a>
                            </li>
                            <li  class="@if(Route::is('assign-equipment.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('assign-equipment.index') }}"> Assign Equipment </a>
                            </li>
                        </ul>
                    </li>

                <!-- bill and payment menu  -->

                    <li class="menu">
                        <a href="#claim" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                <line x1="12" y1="1" x2="12" y2="23">
                                </line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                </path></svg>
                                <span>Bill & Payments</span>
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
                         id="claim" data-parent="#accordionExample">
                            <li class="@if(Route::is('bill.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('bill.index') }}" > Bill </a>
                            </li>
                            <li  class="@if(Route::is('billing.payment')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('billing.payment') }}"> Manage and Payment </a>
                            </li>
                        </ul>
                    </li>

                    <!-- expense Head  -->

                    <li class="menu">
                        <a href="#expense-head" data-toggle="collapse"
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
                         id="expense-head" data-parent="#accordionExample">
                            <li class="@if(Route::is('equipment-expense-head.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('equipment-expense-head.index') }}" >Equipment Expense </a>
                            </li>
                            <li  class="@if(Route::is('project-expense-head.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('project-expense-head.index') }}">Project Expense </a>
                            </li>
                            <li class="@if(Route::is('office-expense-head.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('office-expense-head.index') }}">Office Expense </a>
                            </li>
                        </ul>
                    </li>

                    <!-- /expense Head  -->

                    <!-- expense -->

                    <li class="menu">
                        <a href="#expense" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span>Expense</span>
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
                            <li  class="@if(Route::is('project-expense.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('project-expense.index') }}">Project Expense </a>
                            </li>
                            <li class="@if(Route::is('equipment-expense.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('equipment-expense.index') }}" >Equipment Expense </a>
                            </li>
                            <li class="@if(Route::is('office-expense.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('office-expense.index') }}">Office Expense </a>
                            </li>
                        </ul>
                    </li>

                    <!-- /expense Head  -->
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
            </nav>

        </div>
        <!--  END SIDEBAR  -->