<!DOCTYPE html>
<html>
<head>
	 <title>Office Expense Category</title>
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
        <h3>Office Expense Category List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created At</th>
                            
        	   	  </tr>  
                </thead>
        	   	<tbody>
                 @foreach($office_heads as $value)
                  <tr>
                    <td>{{ $value->head_name  }}</td>
                    <td>@if($value->status == 1)<span class="text-success">Active</span>
                    @else<span class="text-danger">Inactive</span>@endif</td>
                    <td>{{ date('d M,Y',strtotime($value->created_at)) }}</td>
                  </tr>
            @endforeach
            </tbody>
        	   </table>
        	</div>
        </div>
	</div>
</body>
</html>