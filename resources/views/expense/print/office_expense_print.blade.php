<!DOCTYPE html>
<html>
<head>
	 <title>Office Expense</title>
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
        <h3>Office Expense List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Category</th>
                    <th class="text-center">Month</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Amount</th>               
        	   	  </tr>  
                </thead>
        	   	<tbody>
        	   		@php $total_amount = 0; @endphp
                 @foreach($offices as $value)
                  <tr>
                    <td>{{ $value->office_expense_head->head_name }}</td>
                    <td>{{ date('M,Y',strtotime($value->month)) }}</td>
                    <td>{{ date('d M,Y',strtotime($value->date)) }}</td>
                    <td>{{ $value->amount  }}</td>
                  </tr>
                  @php $total_amount += $value->amount; @endphp
            @endforeach
            	<tr>
            		<td colspan="3"></td>
            		<td>Total Amount : {{ $total_amount }}</td>
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