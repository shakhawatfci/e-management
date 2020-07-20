@extends('master.master')
@section('title','EMS | Month to Month Report')

@section('page_header')

        <li class="breadcrumb-item"><a href="javascript:void(0);">Report</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Month to Month Report</span></li>
@endsection

@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                         <monthly-report></monthly-report>

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
