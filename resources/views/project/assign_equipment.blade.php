@extends('master.master')
@section('title','EMS | Equipment Assign')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Project</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Equipment Aissign</span></li>
@endsection
@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                  <h6 style="margin-top : 20px">Manage Equipment</h6>
                                </div>

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <button  data-toggle="modal"  data-target="#aissignEquipment"
                                         class="btn btn-primary"  data-placement="top" title="Assign New Equipment">
                                        <i class="far fa-plus-square"></i> Assign New Equipment
                                        </button>
                                    </div>
                                    <create-equipment 
                                    :vendors='@json($vendors)' 
                                    :equipment_types='@json($equipment_types)'
                                    :projects='@json($projects)'
                                    ></create-equipment>
                                </div>
                            </div>

                         <view-equipment :vendors='@json($vendors)'
                          :equipment_types='@json($equipment_types)'
                          :projects='@json($projects)'
                          ></view-equipment>

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
