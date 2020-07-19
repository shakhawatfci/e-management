<!DOCTYPE html>
<html>
<head>
	 <title>Vendor</title>
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
        <h3>Vendor List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Concern Person</th>
                    <th class="text-center">Bank Details</th>
                    <th class="text-center">Bkash</th>
                  
        	   	  </tr>  
                </thead>
        	   	<tbody>
                 @foreach($vendors as $value)
                  <tr>
                    <td>{{ $value->vendor_name }}</td>
                    <td>{!! $value->vendor_address !!}</td>
                    <td>{{ $value->vendor_email }}</td>
                    <td>{{ $value->vendor_phone }} {{ $value->phone_number_2 }}</td>
                    <td>{{ $value->concerned_person }}</td>
                    <td>{{ $value->bank_details }}</td>
                    <td>{{ $value->bkash_number }}</td>
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