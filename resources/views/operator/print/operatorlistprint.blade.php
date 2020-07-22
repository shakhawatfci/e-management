<!DOCTYPE html>
<html>
<head>
	 <title>Operator</title>
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
        <h3>Operator List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Category</th>
                    <th class="text-center">Vendor</th>
                    <th class="text-center">Equipment</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Mobile</th>        
                    <th class="text-center">Bkash</th>        
                    <th class="text-center">Salary</th>        
                    <th class="text-center">Join Date</th>        
        	   	  </tr>  
                </thead>
        	   	<tbody>
                 @foreach($operators as $value)
                  <tr>
                    <td>{{ $value->equipment_type->name }}</td>
                    <td>{{ $value->vendor->vendor_name }}</td>
                    <td>{{ $value->equipement->eq_name  }}</td>
                    <td>{{ $value->name  }}</td>
                    <td>{!! $value->address !!}</td>
                    <td>{{ $value->mobile  }}</td>
                    <td>{{ $value->bkash_number  }}</td>
                    <td>{{ $value->salary  }}</td>
                    <td>{{ date('d M,Y',strtotime($value->join_date)) }}</td>
                  </tr>
            @endforeach
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