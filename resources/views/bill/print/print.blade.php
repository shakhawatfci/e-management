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
				<h1 style="font-weight: bold;">Monthly Bill</h1>
				<p style="font-size:20px">({{ date('F Y', strtotime($bill->month)) }})</p>

			</div>
        	<div class="col-md-12 col-xs-12">
        	   <p>Date: {{ date('d F , Y', strtotime($bill->date)) }}</p>
        	   <p> <strong>Bill NO: {{ $form_data['bill_no'] }}</strong></p>
        	   <p style="margin-top:15px;">To,</p>
        	   <p>{{ $form_data['to'] }}</p>
        	   <p>{{ $form_data['company_bill_to'] }}</p>
               <p><strong>{{ $form_data['project_name'] }}</strong></p>
        	   <p>{{ $form_data['project_location'] }}</p>
        	   <p style="margin-top:15px;line-height:25px">
        	   	<strong style="word-spacing: 1px;">Subject:
                     {{ $form_data['subject'] }}
                 </strong>
        	   </p>

        	  <p style="margin-top: 5px;">Dear Sir,</p>
        	  <p>Please find the bill and kindly take necessary action for payment</p>
        	</div>
        </div>


        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <table class="table table-bordered text-center">
        	   	  <tr>
        	   	  	<th class="text-center">SL</th>
        	   	  	<th class="text-center">Description</th>
        	   	  	<th class="text-center">Unit</th>
        	   	  	<th class="text-center">Hour</th>
        	   	  	<th class="text-center">Per Hour Rate in BDT</th>
        	   	  	<th class="text-center">Amount in BDT</th>
        	   	  </tr>

        	   	  <tr>
        	   	    <td>1</td>
        	   	    <td>Equipment Bill</td>
        	   	    <td>Hour</td>
        	   	    <td>{{ $bill->total_hour }}</td>
        	   	    <td>{{ round($bill->project_rate_per_hour,2) }}</td>
        	   	    <td>{{ round($bill->project_amount,2) }}</td>
        	   	  </tr>
                  <tr>
                    <td>2</td>
                    <td>Operator Bill</td>
                    <td>Hour</td>
                    <td>{{ $bill->total_hour }}</td>
                    <td>{{ round($bill->operator_rate_per_hour,2) }}</td>
                    <td>{{ round(($bill->operator_total_amount - $bill->operator_payment),2) }}</td>
                  </tr>
        	   	  <tr>
        	   	    <td>3</td>
        	   	    <td>VAT</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>{{ round((($bill->project_amount*$bill->project_vat)/100),2) }}</td>
        	   	  </tr>

        	   	  <tr>
        	   	    <td>4</td>
        	   	    <td>Others Vat (sup)</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>{{ round((($bill->project_amount*$bill->project_sup)/100),2) }}</td>
        	   	  </tr>

                  @php

                    $vat = $bill->project_vat+$bill->project_ait+$bill->project_sup;
                   @endphp

        	   	   <tr>
        	   	    <td style="text-align: right;" colspan="5"><strong>Total Bill Amount
                        @if($vat>0) (Including VAT & Tax) @endif </strong></td>
        	   	    <td><strong>{{ round(($bill->total_project_amount + $bill->operator_total_amount - $bill->operator_payment),2) }}</strong></td>
        	   	  </tr>


        	   </table>
               @php

                $taka = new App\Helper\AmountConverter();

               @endphp
        	   <p><strong>Amount In Words</strong> {{ $taka->get_bd_amount_in_text(round(($bill->total_project_amount + $bill->operator_total_amount - $bill->operator_payment),2)) }}</p>
        	</div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xs-6">
                <p style="margin-top: 20px;"><strong>Thanks & Regards</strong></p>
                <p><img src="{{ url('images/sign.png') }}" style="height: 50px;"></p>
                <p style="margin-top: 5px;">{{ $form_data['bill_by'] }}</p>
                <p>{{ $form_data['designation'] }}</p>
                <p>{{ $form_data['company'] }}</p>
            </div>


            <div class="col-md-6 col-xs-6">
                <table class="table table-bordered">
                    <!-- <tr>
                        <td>Vat Registration No</td>
                        <td>{{ $form_data['reg_no'] }}</td>
                    </tr>

                     <tr>
                        <td>TIN No</td>
                        <td>{{ $form_data['tin_no'] }}</td>
                    </tr>    -->

                    <tr>
                        <td>Bank Name</td>
                        <td>{{ $form_data['bank_name'] }}</td>

                    </tr>

                     <tr>
                        <td>Bank Account Name</td>
                        <td>{{ $form_data['bank_ac_name'] }}</td>

                    </tr>

                    <tr>
                        <td>Bank Account No</td>
                        <td>{{ $form_data['bank_ac'] }}</td>

                    </tr>

                    <tr>
                        <td>Branch Name</td>
                        <td>{{ $form_data['bank_branch'] }}</td>

                    </tr>

                     <tr>
                        <td>Bank Routing Number</td>
                        <td>{{ $form_data['bank_routing'] }}</td>

                    </tr>

                </table>
            </div>
		</div>
		<div class="row col-12 text-center " style="margin-top: 5px;">
			<p>[ Electronic Bill - Auto Generated By EMS Software <strong style="color: dodgerblue;">by Limmex Automation</strong> ]</p>
		</div>


	</div>
    <script>


 window.print();



</script>
</body>
</html>
