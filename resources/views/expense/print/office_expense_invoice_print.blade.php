<!DOCTYPE html>
<html>
<head>
	 <title>Office Expense Invoice</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
         /* *{
            font-size: 0.99em;
         } */
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
    <div class="row">
        <div class="col-md-12 mb-4 mx-2" style="display:flex;align-content: space-between;justify-content: space-between;">
            <div>
                <h5>Invoice : {{ $office_expense->invoice_no }}</h5>
                <p>Month : {{ $office_expense->month }}</p>
                <p>Date : {{ $office_expense->date }}</p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered table-hover mb-4">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Expense Category</th>
                    <th>Amount</th>
                </tr>
                </thead>
                @if($expense_category->count() > 0)
                <tbody>
                    @foreach($expense_category as $key => $category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->office_expense_head->head_name }}</td>
                        <td>{{ $category->amount }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-right">TOTAL</td>
                        <td><strong>{{ $office_expense->total_amount }}</strong></td>
                    </tr>
                </tbody>
                @endif
            </table>
            </div>
        </div>
    </div>
</div>
<script>
    window.print();
</script>
</body>
</html>