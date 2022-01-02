<!DOCTYPE html>
<html>
<head>
	<title>Bill-{{ $bill->bill_no }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed&family=Poppins:wght@300&family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet">
	 <style>
		 body {
			font-family: 'Poppins', sans-serif
            /* font-family: 'Sansita Swashed', cursive; */
		 }
		 .custom_text {
			font-family: 'Sansita Swashed', cursive;
		 }
		 p{
			 line-height: 15px;
		 }
	 </style>
</head>
<body>

	<div class="container" style="margin-top:50px !important;">


        <div class="row">
			<div class="col-12 text-center">
				<h1 style="font-weight: bold;">Operator Paid Bill</h1>
				<p style="font-size:20px">({{ date('F Y', strtotime($bill->month)) }})</p>

			</div>
        	<div class="col-md-12 col-xs-12">
        	   <p>Date: {{ date('d F , Y', strtotime($bill->date)) }}</p>
        	   <p> <strong>Bill NO: {{ $bill->bill_no }}</strong></p>
        	   <p style="margin-top:15px;"><strong>Operator: </strong>{{ $bill->operator->name }}</p>
               <p><strong>Eqipment : </strong> {{ $bill->equipement->eq_name }}</p>
               <p><strong>Project : </strong> {{ $bill->project->project_name }}</p>
        	</div>
        </div>


        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
        	   	  <tr>
        	   	  	<th class="text-center">SL</th>
        	   	  	<th class="text-center">Date</th>
        	   	  	<th class="text-center">Amount</th>
        	   	  	<th class="text-center">Note</th>
        	   	  </tr>
                    @if($bill->operator_pay->count() > 0)
                    @php
                        $i = 0;
                        $total = 0;
                     @endphp
                        @foreach($bill->operator_pay as $pay)
                        <tr>
                          <td>{{ $i+1 }}</td>
                          <td>{{ $pay->date }}</td>
                          <td>{{ $pay->amount }}</td>
                          <td>{{ $pay->note }}</td>
                        </tr>
                        @php
                            $i++;
                            $total += $pay->amount;
                         @endphp
                        @endforeach()

                      <tr>
                        <th colspan="2" class="text-right">Total Paid Amount</th>
                        <th colspan="3">{{ $total }}</th>
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
