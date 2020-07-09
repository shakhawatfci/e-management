@extends('master.master')
@section('title','EMS | Equipment Sales')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Sales </a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Equipment Sales</span></li>
@endsection
@section('create-button')
<button  data-toggle="modal"  data-target="#CreateSales"
                                         class="btn btn-primary"  data-placement="top" title="Create New Equipment">
                                        <i class="far fa-plus-square"></i> Create New
                                        </button>
@endsection
@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
>
                                    <create-sales  :equipment_types='@json($equipment_types)'></create-sales>

                            </div>

                         <view-sales  :equipment_types='@json($equipment_types)'></view-sales>

                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/equipment_sales.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
