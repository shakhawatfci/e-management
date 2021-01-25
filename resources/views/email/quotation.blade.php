<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('admin-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <title>Email</title>
</head>
<body>
 <div class="contaniner">
     <div class="row">
         <div class="col-md-12 text-center">
             <div class="justify-content-md-around">
                 {!! $data['email_body']  !!}
             </div>
         </div>
     </div>
 </div>
</body>
</html>
