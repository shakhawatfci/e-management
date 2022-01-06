@extends('master.master')
@section('title','EMS | Invoice')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Invoice</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
@endsection
@section('content')
<div class="layout-px-spacing">                
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="widget-content searchable-container list">

                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                      <h6 style="margin-top : 20px">Equipment Expense Invoice</h6>
                    </div>

                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                        <div class="d-flex justify-content-sm-end justify-content-center">
                            <button  data-toggle="modal"  data-target="#createEquipmentExpense"
                             class="btn btn-primary"  data-placement="top" title="Create Equipment Expense">
                            <i class="far fa-plus-square"></i> Create New
                            </button>
                        </div>
                        <create-equipmentexpense></create-equipmentexpense>
                    </div>
                </div>

                <view-equipmentexpenseinvoice :projects="{{ $projects }}" :vendors="{{ $vendors }}" :equipment_types="{{ $equipment_types }}" :equipements="{{ $equipements }}" :operators="{{ $operators }}" :equipment_heads="{{ $equipment_heads }}"></view-equipmentexpenseinvoice>

            </div>
        </div>
    </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/expense.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
