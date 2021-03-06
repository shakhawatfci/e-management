@extends('master.master')
@section('title','EMS | Operator')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Operator</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage Operator</span></li>
@endsection
@section('create-button')
<button  data-toggle="modal"  data-target="#createOperator"
                             class="btn btn-primary"  data-placement="top" title="Create New Operator">
                            <i class="far fa-plus-square"></i> Create New 
</button>
@endsection
@section('content')
<div class="layout-px-spacing">                
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="widget-content searchable-container list">

                <div class="row">
                        <create-operator :vendors="{{ $vendors }}" :equipment_types="{{ $equipment_types }}"></create-operator>
                    </div>
                </div>

             <view-operator :vendors="{{ $vendors }}" :equipment_types="{{ $equipment_types }}"></view-operator>

            </div>
        </div>
    </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/operator.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
