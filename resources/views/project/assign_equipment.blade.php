@extends('master.master')
@section('title','EMS | Equipment Assign')

@section('page_header')

        <li class="breadcrumb-item"><a href="javascript:void(0);">Project</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Equipment Aissign</span></li>
@endsection

@section('create-button')
<button  data-toggle="modal"  data-target="#aissignEquipment"
                class="btn   btn-primary"  data-placement="top" title="Assign New Equipment">
            <i class="far fa-plus-square"></i> Assign  Equipment
</button>
@endsection
      


@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                    <assign-equipment 
                                    :vendors='@json($vendors)' 
                                    :equipment_types='@json($equipment_types)'
                                    :projects='@json($projects)'
                                    :operators='@json($operators)'
                                    ></assign-equipment>
                            </div>

                         <view-assigned-equipment :vendors='@json($vendors)'
                          :equipment_types='@json($equipment_types)'
                          :projects='@json($projects)'
                          :operators='@json($operators)'
                          ></view-assigned-equipment>

                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/project.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
