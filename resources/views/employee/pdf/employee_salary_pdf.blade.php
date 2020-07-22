<!DOCTYPE html>
<html>
<head>
	 <title>Employee Salary</title>
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
        <h3>Employee Salary List</h3>
        <p>@if($month != ''){!! $month !!} @else All time @endif</p>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Employee</th>
                    <th class="text-center">Month</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Bonus</th>             
                    <th class="text-center">Deduction</th>             
                    <th class="text-center">Salary</th>             
                    <th class="text-center">Total Amount</th>             
        	   	  </tr>  
                </thead>
        	   	<tbody>
        	   		@php 
                  $total_bonus = 0; 
                  $total_deduction = 0; 
                  $total_salary = 0; 
                  $total_salary_amount = 0; 
                @endphp
                 @foreach($employees as $value)
                  <tr>
                    <td>{{ $value->employee->name }}</td>
                    <td>{{ date('M,Y',strtotime($value->month)) }}</td>
                    <td>{{ date('d M,Y',strtotime($value->date)) }}</td>
                    <td>@if($value->bonus < 1)- - @else{{ $value->bonus }}@endif</td>
                    <td>{{ $value->deduction }}</td>
                    <td>{{ $value->salary_amount  }}</td>
                    <td>{{ $value->total_salary_amount }}</td>
                  </tr>
                  @php 
                    $total_bonus += $value->bonus;
                    $total_deduction += $value->deduction;
                    $total_salary += $value->salary_amount;
                    $total_salary_amount += $value->total_salary_amount;
                  @endphp
            @endforeach
            	<tr>
            		<td colspan="3"></td>
            		<td>Total Bonus : <strong>{{ $total_bonus }}</strong></td>
                <td>Total Deduction : <strong>{{ $total_deduction }}</strong></td>
                <td>Total Salary : <strong>{{ $total_salary }}</strong></td>
                <td>Total Amount : <strong>{{ $total_salary_amount }}</strong></td>
            	</tr>
            </tbody>
        	   </table>
        	</div>
        </div>
	</div>

</body>
</html>