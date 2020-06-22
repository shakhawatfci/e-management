@extends('master.master')
@section('title','EMS | Equipment Type')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Equipment Type</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
@endsection
@section('create-button')
<button  data-toggle="modal"  data-target="#createEquipmentType"
    class="btn btn-outline-warning"  data-placement="top" title="Create New Equipment">
<i class="far fa-plus-square"></i> Create New
</button>
@endsection
@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">

                                    <create-equipment-type></create-equipment-type>

                            </div>

                         <view-equipment-type></view-equipment-type>

                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/equipment.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
