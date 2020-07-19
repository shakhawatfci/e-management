<!DOCTYPE html>
<html>
<head>
	 <title>Bill</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
    <div class="text-center">
        <h3>Bill Summary</h3>
        <p>
            @if($month != '') date('M, Y',strtotime($month)) @else All time @endif
        </p>
    </div> 
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Bill</th>
                    <th class="text-center">Project</th>
                    <th class="text-center">Equipment</th>
                    <th class="text-center">Hour</th>
                    <th class="text-center">Project Amount</th>
                    <th class="text-center">Vendor Amount</th>
        	   	  </tr>  
                </thead>
        	   	<tbody>
                    @php
                        $project_amount_almost = 0;
                        $project_paid_almost = 0;
                        $vendor_amount_almost = 0;
                        $vendor_paid_almost = 0;
                    @endphp
                 @foreach($bill as $value)
                  <tr>
                    <td>
                      {{ $value->bill_no }}
                      <br />
                      Month : {{ $value->month }}
                    </td>
                    <td>{{ $value->project->project_name }}</td>
                    <td>
                      <span>Equipment Type : {{ $value->equipment_type->name }}</span>
                      <br />
                      <span>
                        Vendor :
                        <strong>{{ $value->vendor->vendor_name }}</strong>
                      </span>
                      <br />
                      <span>Equipment Name : {{ $value->equipement->eq_name }}</span>
                      <br />
                    </td>
                    <td>{{ $value->total_hour }}</td>
                    <td>
                      Rate per Hour : {{ $value->project_rate_per_hour }} <br/>
                      Total Amount : {{ $value->total_project_amount }}
                      <br />
                      Paid Amount : {{ $value->project_payment + $value->project_adjustment_payment }}
                      <br />
                      OutStanding : {{ $value->total_project_amount - ($value->project_payment + $value->project_adjustment_payment) }}
                    </td>
                    <td>
                      Rate per Hour : {{ $value->vendor_rate_per_hour }} <br/>
                      Total Amount : {{ $value->total_vendor_amount }}
                      <br />
                      Paid Amount : {{ $value->vendor_payment + $value->vendor_adjustment_payment }}
                      <br />
                      OutStanding : {{ $value->total_vendor_amount - ($value->vendor_payment + $value->vendor_adjustment_payment) }}
                      
                    </td>
                </tr>
                @php
                    $project_amount_almost += $value->total_project_amount;
                    $project_paid_almost += $value->project_payment + $value->project_adjustment_payment;
                    $vendor_amount_almost += $value->total_vendor_amount;
                    $vendor_paid_almost += $value->vendor_payment + $value->vendor_adjustment_payment;
                @endphp
            @endforeach
                <tr>
                    <td colspan="3">Total Project Amount : {{$project_amount_almost}}
                        <br/>
                        Project Paid : {{ $project_paid_almost }}
                        <br/>
                        OutStanding : {{ $project_amount_almost - $project_paid_almost }}
                    </td>
                    <td colspan="3">
                        Total Vendor Amount : {{ $vendor_amount_almost }}
                        <br/>
                        Vendor Paid : {{ $vendor_paid_almost }}
                        <br/>
                        OutStanding : {{ $vendor_amount_almost - $vendor_paid_almost }}
                    </td>
                </tr>
            </tbody>
        	   </table>
        	</div>
        </div>
	</div>
	<script>
 		window.print();
	</script>
</body>
</html>