<!DOCTYPE html>
<html>
<head>
	 <title>Equipment Category</title>
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
        <h3>Equipment Category List</h3>
    </div>
        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
                <thead>
        	   	  <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Created</th>
        	   	  </tr>  
                </thead>
        	   	<tbody>
                 @foreach($equipment_types as $value)
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>{!! $value->note !!}</td>
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