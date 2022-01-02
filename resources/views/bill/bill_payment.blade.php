@extends('master.master')
@section('title','EMS | Bill List and Payment')

@section('page_header')

        <li class="breadcrumb-item"><a href="javascript:void(0);">Bill and Payment</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Payment</span></li>
@endsection

@section('create-button')

@endsection
      


@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">

                            </div>

                         <bill-list :vendors='@json($vendors)'
                          :equipment_types='@json($equipment_types)'
                          :projects='@json($projects)'
                          :operator='@json($operators)'
                          ></bill-list>

                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/bill.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
