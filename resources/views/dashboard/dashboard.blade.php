@extends('master.master')
@push('style')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('admin-assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin-assets/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endpush
@section('page_header')
<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
<!-- <li class="breadcrumb-item active" aria-current="page"><span>Sales</span></li> -->
@endsection
@section('content')

<div class="row layout-top-spacing">

<div class="col-md-8 mx-auto layout-spacing">
    <div class="widget widget-table-two">

        <div class="widget-heading">
            <h5 class="">Last Month Bill Yet Not Done</h5>
        </div>

        <div class="widget-content">
            <div class="table-responsive">
                <table class="table">
                    <thead style="display:table;width:100%;table-layout:fixed;width: calc( 100% - 1em );">
                        <tr>
                            <th><div class="th-content">Project</div></th>
                            <th><div class="th-content">Equipment</div></th>
                            <th><div class="th-content">Type</div></th>
                            <!-- <th><div class="th-content th-heading">Amount</div></th> -->
                        </tr>
                    </thead>
                    <tbody style="display:block;height:400px;overflow-y:auto;width:100%;">
                    @if($last_month_due_bill->count() > 0)
                        @foreach($last_month_due_bill as $due_bill)
                            <tr style="display:table;width:100%;table-layout:fixed;">
                                <td><div class="td-content customer-name">{{ $due_bill->project->project_name }}</div></td>
                                <td><div class="td-content product-brand">{{ $due_bill->equipement->eq_name }}</div></td>
                                <td><div class="td-content">{{ $due_bill->equipment_type->name }}</div></td>
                                <!-- <td><div class="td-content pricing">{{ $due_bill->total_project_amount }}</div></td> -->
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
