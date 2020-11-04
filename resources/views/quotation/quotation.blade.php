
@extends('master.master')
@section('title','EMS | Quotation')

<!-- Route Written in equipment.php  -->

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Quotation</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
@endsection
@section('content')
<div class="layout-px-spacing">
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                  <h6 style="margin-top : 20px">Manage Quotation</h6>
                                </div>

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <button  data-toggle="modal"  data-target="#CreateQoutation"
                                         class="btn btn-primary"  data-placement="top" title="Create New Quotation">
                                        <i class="far fa-plus-square"></i> New Quotation
                                        </button>
                                    </div>
                                    <create-quotation ></create-quotation>
                                </div>
                            </div>

                         <view-quotation ></view-quotation>

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