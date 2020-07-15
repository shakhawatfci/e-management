@extends('master.master')
@section('title','EMS | employee')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Employee</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
@endsection
@section('create-button')
<button  data-toggle="modal"  data-target="#CreateEmployee"
                                         class="btn btn-primary"  data-placement="top" title="Create New employee">
                                        <i class="far fa-plus-square"></i> Create New
                                        </button>
@endsection
@section('content')
<div class="layout-px-spacing">                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                    <create-employee :roles="{{ $roles }}" ></create-employee>                           
                            </div>
                         <view-employee :roles="{{ $roles }}"></view-employee>
                        </div>
                    </div>
                </div>
</div>
@endsection

<!-- push the script which you need only this page  -->
@push('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('public/js/employee.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
