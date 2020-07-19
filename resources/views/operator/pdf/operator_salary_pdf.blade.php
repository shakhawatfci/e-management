<!DOCTYPE html>
<html>
<head>
	 <title>Operator Salaty</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
         *{
            font-size: 0.99em;
         }
     </style>
</head>
<body>
	<div class="container-fluid"> 
    <div class="text-center">
        <h3>Operator Salaty List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Operator</th>
                    <th class="text-center">Month</th>               
                    <th class="text-center">PaymentDate</th>
                    <th class="text-center">Mode</th>        
                    <th class="text-center">Bank Note</th>
                    <th class="text-center">Bkash Note</th>
                    <th class="text-center">Amount</th>
        	   	  </tr>  
                </thead>
        	   	<tbody>
                    @php
                        $total_amount = 0;                       
                    @endphp
                 @foreach($salaries as $value)
                  <tr>
                    <td>{{ $value->operator->name }}</td>
                    <td>{{ date('M,Y',strtotime($value->month)) }}</td>
                    <td>{{ date('d M,Y',strtotime($value->payment_date)) }}</td>
                    <td><span>@if($value->mode == 1)Cash @elseif($value->mode == 2)Bank @else Mobile Bank @endif</span></td>
                    <td>{{ $value->bank_note }}</td>
                    <td>{{ $value->bkash_note }}</td>
                    <td>{{ $value->payment_amount }}</td>
                  </tr>
                   @php
                        $total_amount += $value->payment_amount;                       
                    @endphp
            @endforeach
                <tr>
                    <td colspan="6"></td>
                    <td>Total Amount : {{ $total_amount }} </td>
                </tr>
            </tbody>
        	   </table>
        	</div>
        </div>
	</div>

</body>
</html>