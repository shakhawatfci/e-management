<!DOCTYPE html>
<html>
<head>
	 <title>Operator Fooding Paid List</title>
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
            <h4 style="font-weight: bold;">Operator Fooding Paid List</h4>
            <p style="font-size:16px">Operator : {{ $bill[0]->project_claim->operator->name }}</p>
            <p style="font-size:16px">Equipment : {{ $bill[0]->project_claim->equipement->eq_name }}</p>
            <p style="font-size:16px"> Project : {{ $bill[0]->project_claim->project->project_name }}
            </p>
        </div>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <tr>
                  <th class="text-center">SL</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Enter By</th>
                  <th class="text-center">Amount</th>
                  <th class="text-center">Note</th>
                </tr>
                    @if($bill->count() > 0)
                    @php
                        $i = 0;
                        $total = 0;
                     @endphp
                        @foreach($bill as $pay)
                        <tr>
                          <td>{{ $i+1 }}</td>
                          <td>{{ $pay->date }}</td>
                          <td>{{ $pay->user->name }}</td>
                          <td>{{ $pay->amount }}</td>
                          <td>{{ $pay->note }}</td>
                        </tr>
                        @php
                            $i++;
                            $total += $pay->amount;
                         @endphp
                        @endforeach()

                      <tr>
                        <th colspan="3" class="text-right">Total Paid Amount</th>
                        <th colspan="2">{{ $total }}</th>
                      </tr>
                    @endif
             </table>
        	</div>
        </div>
	</div>
<script>
    window.print();
</script>
</body>
</html>