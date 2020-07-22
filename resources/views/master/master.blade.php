<!DOCTYPE html>
<html lang="en">
<head>

    @include('include.common_header_asset')

    @stack('style')
  <style>
   .bg-paid {
    background-color : green;
     }

     .menu-categories  i{
         
         font-size: 25px;
         margin-right: 10px;
         vertical-align: middle;
         
     }

     .custom-modal {
             min-width: 95% !important;
                }

      .btn-primary:hover{
        box-shadow: 0px 5px 70px #5dc8fd !important;
      }

    .btn.rounded-circle:hover {

    box-shadow: 0px 5px 15px aqua !important;
       }

    .vue-monthly-picker .input {
      background-color : #1b2e4b !important;
      height: calc(1.4em + 1.4rem + 2px) !important;
      padding-left: 10px;
      /*margin-left: 10px;*/
      color : #007c63 !important;
      border: none !important;
      width: 100%;
    }

    .vue-monthly-picker .date-popover {
      background: #0e1726 !important;
    }
  </style>
</head>
<body>
    <!-- BEGIN LOADER -->
    <!-- <div id="load_screen"> 
    <div class="loader"> 
    <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div>
    </div>
    </div> -->
    <!--  END LOADER -->
    
     <!-- topbar header  -->
     @include('include.topbar')
     <!-- topbar header  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            @yield('page_header')
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto ">
                <li class="nav-item more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                      @yield('create-button')
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

      <!-- sidebar  -->
      @include('include.sidebar')
      <!-- sidebar  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
             
             @yield('content')

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © {{ date('Y') }} <a target="_blank" href="http://automation.limmexbd.com">Limmex Automation</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <script>
        var base_url = "{{ url('/') }}"+'/';


    </script>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    @include('include.common_footer_asset')
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        $( document ).ready(function() {
            $(".active").parents(".menu").children("a").removeClass('collapsed');
            $(".active").parents(".menu").children("a").removeAttr('area-expanded');
            $(".active").parents(".menu").children("a").attr('area-expanded',true);
            $(".active").parents(".menu").children("a").attr('data-active',true);
            $(".active").parents().addClass('show');

        });
    </script>

  @stack('script')



</body>
</html>