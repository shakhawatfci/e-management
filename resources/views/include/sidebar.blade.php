        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">

                   <li class="menu">
                        <a href="{{ url('/') }}" aria-expanded="false" 
                        data-active="@if(request()->is('/')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="menu_heading">
                               <i class="fa fa-home"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <!-- Vendor menu  -->
                    <li class="menu @if(Route::is('supplier.index')) active active_url @endif">
                        <a href="{{ route('supplier.index') }}" data-active="@if(Route::is('supplier.index')){{ 'true' }}@else{{ 'false' }}@endif" class="dropdown-toggle">
                            <div class="menu_heading">
                            <i class="fa fa-users"></i>
                              <span>Vendor</span>
                            </div>
                        </a>
                    </li>
                    
                <!-- equipment menu  -->

                    <li class="menu">
                        <a href="#equipment" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="menu_headling">
                                <i class="fa fa-truck"></i>
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
                            <i class="fa fa-empire" aria-hidden="true"></i>

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
                            <i class="fa fa-file-text" aria-hidden="true"></i>
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
                                <a href="{{ route('billing.payment') }}"> Manage & Payment </a>
                            </li>
                        </ul>
                    </li>

                    <!-- expense Head  -->

                    <li class="menu">
                        <a href="#expense-head" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <i class="fa fa-bars" aria-hidden="true"></i>
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
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
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

                    <!-- /expense  -->

                    <!-- Operator -->

                    <li class="menu">
                        <a href="#operator" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <i class="fa fa-male" aria-hidden="true"></i>
                                <span>Operator</span>
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
                         id="operator" data-parent="#accordionExample">
                            <li  class="@if(Route::is('operator.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('operator.index') }}">Operator </a>
                            </li>
                            <li class="">
                                <a href="#" >Operator Fooding </a>
                            </li>
                            <li class="">
                                <a href="#">Operator Salary </a>
                            </li>
                        </ul>
                    </li>

                    <!-- /Operator  -->
                    <!-- Operator -->

                    <li class="menu">
                        <a href="#Sales" data-toggle="collapse"
                         aria-expanded="false"  class="dropdown-toggle">
                            <div class="">
                            <i class="fa fa-money" aria-hidden="true"></i>
                                <span>Sales & Mob</span>
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
                         id="Sales" data-parent="#accordionExample">
                            <li  class="@if(Route::is('equipment-sales.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('equipment-sales.index') }}"> Equipment Sales</a>
                            </li> 
                        <ul class="collapse submenu list-unstyled"
                         id="Sales" data-parent="#accordionExample">
                            <li  class="@if(Route::is('mobilization.index')){{ 'active' }}@else{{ '' }}@endif">
                                <a href="{{ route('mobilization.index') }}"> Mobilization</a>
                            </li> 
                            <!-- <li class="">
                                <a href="#">Operator Salary </a>
                            </li> -->
                        </ul>
                    </li>

                    <!-- /Operator  -->
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
            </nav>

        </div>
        <!--  END SIDEBAR  -->