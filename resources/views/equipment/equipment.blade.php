@extends('master.master')
@section('title','EMS | Equipment')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Equipment</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
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

<<<<<<< HEAD
                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <button  data-toggle="modal"  data-target="#createEquipment"
                                         class="btn btn-primary"  data-placement="top" title="Create New Equipment">
                                        <i class="far fa-plus-square"></i> Create New
                                        </button>
                                    </div>
                                    <create-equipment :vendors='@json($vendor)'></create-equipment>
                                </div>
                            </div>

                         <view-equipment :vendors='@json($vendor)'></view-equipment>

=======
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                        <div class="d-flex justify-content-sm-end justify-content-center">
                            <button data-toggle="modal" data-target="#createEquipment" class="btn btn-primary">
                            <i class="far fa-plus-square"></i>
                            </button>
                            <div class="switch align-self-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            </div>
>>>>>>> ad5a188a1ade1fab8ed1c59ddf555164b2b3c908
                        </div>
                        <create-equipment></create-equipment>
                    </div>
                </div>

             <view-equipment></view-equipment>

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
