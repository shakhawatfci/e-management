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