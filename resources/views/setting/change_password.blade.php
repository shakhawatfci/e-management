@extends('master.master')
@push('style')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('admin-assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin-assets/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endpush
@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
<!-- <li class="breadcrumb-item active" aria-current="page"><span>Sales</span></li> -->
@endsection
@section('content')

<div class="row layout-top-spacing">

<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing m-auto">
  <div class="widget widget-five">
      <div class="widget-content">

          <div class="header text-center" style="margin-bottom: 1em;">
              <div class="header-body">
                  <h5>Change Password</h5>
              </div>
              
          </div>
      
        <form action="{{ route('password.post') }}" method="post" method="post">
        {{ csrf_field() }}

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        <div class="form-group">
          <input type="password" name="old_password" class="form-control" required="" placeholder="Enter Old Password">
        </div> 

        <div class="form-group">

          <input type="password" id="pass" name="password" class="form-control" required="" placeholder="Enter New Password">

        </div>   

        <div class="form-group">
          <input type="password" id="new_pass" name="password_confirmation" class="form-control" required="" placeholder="Confirm Password">

        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-block btn-primary" id="btn">Change Password</button>
        </div>
        </form>
  </div>

    </div>

  </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('admin-assets/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
