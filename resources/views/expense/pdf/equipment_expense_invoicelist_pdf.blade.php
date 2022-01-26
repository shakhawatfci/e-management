<!DOCTYPE html>
<html>
<head>
	 <title>Equipment Expense Invoice</title>
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
        <div style="display: flex;margin-top: 20px; flex-direction: inline; justify-content: space-between;">
        <div>
          <img src="{{ url('images/logo/logo.png') }}" style="height: 40px;" alt="" />
        </div>
         
           <div style="text-align: center;">
               <p style="font-size: 14px;text-transform: uppercase;line-height: 5px;">Limmex Construction</p>
               <span style="font-size: 10px; line-height: 2px;">Import | Supply | Equipment Rent & Maintenance</span>
            </div>
     
           <div></div>
      
      </div>
           <div style="border-bottom: 1px solid #000;"></div>
    <div class="text-center">
        <h3>Equipment Expense Invoice List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Invoice</th>
                    <th class="text-center">Month</th>
                    <th class="text-center">Payment Date</th>
                    <th class="text-center">Project Name</th>
                    <th class="text-center">Vendor</th>
                    <th class="text-center">Equipment</th>
                    <th class="text-center">Opeator</th>
                    <th class="text-center">Pay Method</th>
                    <th class="text-center">Amount</th>               
        	   	  </tr>  
                </thead>
        	   	<tbody>
        	   		@php $total_amount = 0; @endphp
                 @foreach($equipments as $value)
                  <tr>
                    <td>{{ $value->invoice_no }}</td>
                    <td>{{ date('M,Y',strtotime($value->month)) }}</td>
                    <td>{{ date('d M,Y',strtotime($value->payment_date)) }}</td>
                    <td>{{ $value->project->project_name }}</td>
                    <td>{{ $value->vendor->vendor_name }}</td>
                    <td>{{ $value->equipement->eq_name }}</td>
                    <td>{{ $value->operator->name }}</td>
                    <td>{{ $value->payment_method }}</td>
                    <td>{{ $value->total_amount  }}</td>
                  </tr>
            @endforeach
            </tbody>
        	   </table>
        	</div>
        </div>
	</div>
</body>
</html>