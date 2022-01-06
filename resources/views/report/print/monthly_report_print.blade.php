<!DOCTYPE html>
<html>
<head>
     <title>Monthly Report</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
        body
        {
            margin: 0 auto;
        }
        .table_width
        {
            width: 100%;
        }
        p
        {
            /*font-size: 12px;*/
          line-height: 15px;
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
            <h4 style="font-weight: bold;">Monthly Report</h4>
            <p style="font-size:16px">Filltered By : {{ $request_to[0] }} To {{$request_to[1]}}
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
                          <th>Vendor  Bill</th>
                          <th>Bill Profit</th>
                          <th>E Sales Profit</th>
                          <th>Mob Profit</th>
                          <th>TT Profit</th>
                          <th>Emp salary</th>
                          <th>Op Salary</th>
                          <th>FD Bill</th>
                          <th>FD Paid</th>
                          <th>Eq Expense</th>
                          <th>Pr Expense</th>
                          <th>Off Expense</th>
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
                          <td>{{ $value['bill_profit'] }}</td>
                          <td>{{ $value['equipment_sales_profit'] }}</td>
                          <td>{{ $value['mobilization_profit'] }}</td>
                          <td>{{ $value['total_profit'] }}</td>
                          <td>{{ $value['employee_salary'] }}</td>
                          <td>{{ $value['operator_salary'] }}</td>
                          <td>{{ $value['fooding_bill_amount'] }}</td>
                          <td>{{ $value['fooding_paid_amount'] }}</td>
                          <td>{{ $value['equipment_expense'] }}</td>
                          <td>{{ $value['project_expense'] }}</td>
                          <td>{{ $value['office_expense'] }}</td>
                          <td>{{ $value['total_expense'] }}</td>
                          <td>{{ $value['net_profit'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>

                  <tfoot style="border-top:2px solid #ccc">
                      <tr>
                          <th>Total =</th>
                          <th>Project Bill</th>
                          <th>Vendor  Bill</th>
                          <th>Bill Profit</th>
                          <th>E Sales Profit</th>
                          <th>Mob Profit</th>
                          <th>TT Profit</th>
                          <th>Emp salary</th>
                          <th>Op Salary</th>
                          <th>TT FD Bill</th>
                          <th>TT FD Paid</th>
                          <th>Eq Expense</th>
                          <th>Pr Expense</th>
                          <th>Off Expense</th>
                          <th>TT Expense</th>
                          <th>Net Profit</th>
                      </tr>
                      <tr>
                        <th>$</th>
                        <th>{{ $report_data['total_sum']['total_project_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_vendor_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_bill_profit'] }}</th>
                        <th>{{ $report_data['total_sum']['total_equipment_sales_profit'] }}</th>
                        <th>{{ $report_data['total_sum']['total_mobilization_profit'] }}</th>
                        <th>{{ $report_data['total_sum']['total_profit'] }}</th>
                        <th>{{ $report_data['total_sum']['total_employee_salary'] }}</th>
                        <th>{{ $report_data['total_sum']['total_operator_salary'] }}</th>
                        <th>{{ $report_data['total_sum']['total_fooding_bill_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_fooding_paid_amount'] }}</th>
                        <th>{{ $report_data['total_sum']['total_equipment_expense'] }}</th>
                        <th>{{ $report_data['total_sum']['total_project_expense'] }}</th>
                        <th>{{ $report_data['total_sum']['total_office_expense'] }}</th>
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