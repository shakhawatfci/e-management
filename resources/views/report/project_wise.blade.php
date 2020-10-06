@extends('master.master')
@section('title','EMS |Report Project Wise')

@section('page_header')

        <li class="breadcrumb-item"><a href="javascript:void(0);">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Project Wise Report</span></li>
@endsection

@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                         <project-wise-report :projects='@json($projects)'></project-wise-report>
                         
                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/report.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
