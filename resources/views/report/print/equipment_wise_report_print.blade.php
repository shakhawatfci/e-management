<!DOCTYPE html>
<html>
<head>
     <title>Equipment Wise Report</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
        body
        {
            margin: 0 auto;
            font-size: 11px;
        }
        .table_width
        {
            width: 100%;
        }
        p
        {
            /*font-size: 12px;*/
          line-height: 14px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row" style="text-align: center">
            <table class="table_width">
              <thead>
               <tr style="border-bottom: 1px solid #ccc;">
                   <th style="text-align: left;"><img src="{{ url('images/logo/logo.png') }}" style="height: 40px;margin-bottom: 8px;" alt=""></th>
                   <th></th>
                   <th></th>
                   <th style="text-align: right;">
                       <p style="font-size: 14px;text-transform: uppercase;line-height: 5px;">Limmex Construction</p>
                       <span style="font-size: 10px; line-height: 2px;">Import | Supply | Equipment Rent & Maintenance</span>
                    </th>
               </tr>
               <tr>
                   <td colspan="4" style="border-bottom: 1px solid #000;">
                   </td>
               </tr>
              </thead>
            </table>
        </div>
    <div>
        <div class="col-12 text-center">
            <h4 style="font-weight: bold;">Equipment : {{ $equipment->eq_name }}</h4>
            <p style="font-size:15px">Equipment Type : {{ $equipment->equipment_type->name }}
            <p style="font-size:15px">Vendor : {{ $equipment->vendor->vendor_name }}
            <p style="font-size:15px">Filltered By : {{ $request_to[0] }} To {{$request_to[1]}}
            </p>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
               <table class="table table-bordered table-hover  mb-4">
                  <thead>
                      <tr>
                          <th>Month</th>
                          <th>Project Bill</th>
                          <th>Vendor Bill</th>
                          <th>Fooding Bill</th>
                          <th>Bill Profit</th>
                          <th>P Payment</th>
                          <th>P Outstanding</th>
                          <th>V Payment</th>
                          <th>V Outstanding</th>
                          <th>FD Payment</th>
                          <th>FD Outstanding</th>
                          <th>Op Salary</th>
                          <th>Eq Expense</th>
                          <th>TT Expense</th>
                          <th>Net Profit</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($report_data['report_data'] as $value)
                      <tr>
                          <td>{{ $value['month'] }}</td>
                          <td>{{ $value['project_bill_amount'] }}</td>
                          <td>{{ $value['vendor_bill_amount'] }}</td>
                          <td>{{ $value['fooding_bill_amount'] }}</td>
                          <td>{{ $value['bill_profit'] }}</td>
                          <td>{{ $value['project_payment'] }}</td>
                          <td>{{ $value['project_outstanding'] }}</td>
                          <td>{{ $value['vendor_payment'] }}</td>
                          <td>{{ $value['vendor_outstanding'] }}</td>
                          <td>{{ $value['fooding_paid_amount'] }}</td>
                          <td>{{ $value['fooding_outstanding'] }}</td>
                          <td>{{ $value['operator_salary'] }}</td>
                          <td>{{ $value['equipment_expense'] }}</td>
                          <td>{{ $value['total_expense'] }}</td>
                          <td>{{ $value['net_profit'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>

                  <tfoot style="border-top:2px solid #ccc">
                      <tr>
                          <th>Total = </th>
                          <th>Project Bill</th>
                          <th>Vendor Bill</th>
                          <th>Fooding Bill</th>
                          <th>Bill Profit</th>
                          <th>P Payment</th>
                          <th>P Outstanding</th>
                          <th>V Payment</th>
                          <th>V Outstanding</th>
                          <th>FD Payment</th>
                          <th>FD Outstanding</th>
                          <th>Op Salary</th>
                          <th>Eq Expense</th>
                          <th>TT Expense</th>
                          <th>Net Profit</th>
                      </tr>
                      <tr>
                        <th>----</th>
                        <th>{{ $report_data['total_sum']['total_project_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_vendor_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_fooding_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_bill_profit'] }}</th>
                        <th>{{ $report_data['total_sum']['total_project_payment'] }}</th>
                        <th>{{ $report_data['total_sum']['total_project_outstanding'] }}</th>
                        <th>{{ $report_data['total_sum']['total_vendor_payment'] }}</th>
                        <th>{{ $report_data['total_sum']['total_vendor_outstanding'] }}</th>
                        <th>{{ $report_data['total_sum']['total_fooding_paid_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_fooding_outstanding'] }}</th>
                        <th>{{ $report_data['total_sum']['total_operator_salary'] }}</th>
                        <th>{{ $report_data['total_sum']['total_equipment_expense'] }}</th>
                        <th>{{ $report_data['total_sum']['total_expense'] }}</th>
                        <th>{{ $report_data['total_sum']['total_net_profit'] }}</th>
                      </tr>
                  </tfoot>
              </table>
            </div>
        </div>
    </div>

<script>
    window.print();
</script>
</body>
</html>