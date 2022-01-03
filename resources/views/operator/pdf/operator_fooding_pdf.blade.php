<!DOCTYPE html>
<html>
<head>
     <title>Operator Fooding</title>
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
            <h4 style="font-weight: bold;">Operator Fooding List</h4>
            <p style="font-size:16px">Filltered By : @if($request_for->operator_id != '') {{ $foodings[0]->operator->name }} @endif
                @if($request_for->equipment_id != '') {{ $foodings[0]->equipement->eq_name }} @endif @if($request_for->project_id != '') {{ $foodings[0]->project->project_name }} @endif
            </p>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
               <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th class="text-center">Project</th>
                    <th class="text-center">Equipment</th>
                    <th class="text-center">Operator</th>
                    <th class="text-center">Fooding Bill</th>
                    <th class="text-center">Paid Amount</th>
                    <th class="text-center">Due</th>
                  </tr>  
                </thead>
                <tbody>
                    @php
                        $i = 0;              
                    @endphp
                 @foreach($foodings as $value)
                  <tr>
                    <td>{{ $value->project->project_name }}</td>
                    <td>{{ $value->equipement->eq_name }}</td>
                    <td>{{ $value->operator->name }}</td>
                    <td>{{ $value->total_fooding_amount }}</td>
                    <td>{{ ($value->operator_adjustment_payment + $value->operator_payment_amount)}}</td>
                    <td>{{
                        ($value->total_fooding_amount -
                        $value->operator_adjustment_payment +
                          $value->operator_payment_amount)
                      }}
                    </td>
                  </tr>
                   @php
                        $i++;               
                    @endphp
            @endforeach
                
            </tbody>
               </table>
            </div>
        </div>
    </div>
</body>
</html>