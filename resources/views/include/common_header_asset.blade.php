    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Limmex | EMS')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/loading.gif') }}"/>
    <!-- <link href="{{ asset('admin-assets/assets/css/loader.css') }}" rel="stylesheet" type="text/css" /> -->
    <!-- <script src="{{ asset('admin-assets/assets/js/loader.js') }}"></script> -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('admin-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    @if(Session::has('theme'))
    <link href="{{ asset('admin-assets/light/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/light/assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('admin-assets/light/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin-assets/light/assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/light/assets/css/components/custom-modal.css') }}">
    <link href="{{ asset('admin-assets/light/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- notes  -->
    <link href="{{ asset('admin-assets/light/assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css">
        <!-- sweet alert  -->
        <link href="{{ asset('admin-assets/light/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/light/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/light/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- sweet alert  -->
    @else
    <link href="{{ asset('admin-assets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('admin-assets/assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin-assets/assets/css/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/components/custom-modal.css') }}">
    <link href="{{ asset('admin-assets/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- notes  -->
    <link href="{{ asset('admin-assets/assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css">
        <!-- sweet alert  -->
        <link href="{{ asset('admin-assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- sweet alert  -->
    @endif



    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/font-icons/fontawesome/css/fontawesome.css') }}">
    <!-- font awesome -->

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- contact page  -->
    <link href="{{ url('admin-assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin-assets/assets/css/apps/contacts.css') }}" rel="stylesheet" type="text/css" />

    <!-- contact page  -->



    <!-- loader / -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/plugins/loaders/custom-loader.css') }}">
    <!-- loader / -->

    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/plugins/animate/animate.css') }}">

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('admin-assets/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->
    <!-- <link href="{{ asset('admin-assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css"> -->

    <!-- notes  -->
    <!-- font awesome  -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- font awesome  -->
     <!-- swtich  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/assets/css/forms/switches.css') }}">
    <!-- switch  -->
