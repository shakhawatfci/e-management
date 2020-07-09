@extends('master.master')
@section('title','EMS | Equipment Assign')

@section('page_header')

        <li class="breadcrumb-item"><a href="javascript:void(0);">Sales & Mobilization</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Mobilization</span></li>
@endsection

@section('create-button')
<button  data-toggle="modal"  data-target="#CreateMobilization"
                class="btn   btn-outline-warning"  data-placement="top" title="Create Mobilization Entry">
            <i class="far fa-plus-square"></i> Create  New
</button>
@endsection
      


@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                    <create-mobilization 
                                    :vendors='@json($vendors)' 
                                    :equipment_types='@json($equipment_types)'
                                    :projects='@json($projects)'
 
                                    ></create-mobilization>
                            </div>

                         <view-mobilization :vendors='@json($vendors)'
                          :equipment_types='@json($equipment_types)'
                          :projects='@json($projects)'
                          ></view-mobilization>

                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/mobilization.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
