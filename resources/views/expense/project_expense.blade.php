@extends('master.master')
@section('title','EMS | Project Expense')

@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Project Expense</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>Manage</span></li>
@endsection
@section('content')
<div class="layout-px-spacing">                
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="widget-content searchable-container list">

                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                      <h6 style="margin-top : 20px">Manage Project Expense</h6>
                    </div>

                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                        <div class="d-flex justify-content-sm-end justify-content-center">
                            <button  data-toggle="modal"  data-target="#createProjectExpense"
                             class="btn btn-primary"  data-placement="top" title="Create Project Expense">
                            <i class="far fa-plus-square"></i> Create New
                            </button>
                        </div>
                        <create-projectexpense :project_expense_head="{{ $project_heads }}" :projects="{{ $project }}"></create-projectexpense>
                    </div>
                </div>

             <view-projectexpense :project_expense_head="{{ $project_heads }}" :projects_data="{{ $project }}"></view-projectexpense>

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
