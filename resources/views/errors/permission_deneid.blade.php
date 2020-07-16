<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.common_header_asset')
    <link href="{{ asset('admin-assets/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/switches.css') }}">
</head>
<body class="error404 text-center">
    
<div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="index.html" class="ml-md-5">
                    <img alt="image-404" src="{{ url('admin-assets/assets/img/90x90.jpg') }}" class="theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">403</h1>
            <p class="mini-text">Ooops Access Deneid!</p>
            <p class="error-text mb-4 mt-1">You are poor guy and  don't  hvae the  Permission to Visit This Page!</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-5">Go Home</a>
        </div>
    </div>   

   @include('include.common_footer_asset')
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin-assets/assets/js/authentication/form-2.js') }}"></script>

</body>
</html>
