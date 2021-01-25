<!DOCTYPE html>
<html>
<head>
	 <title>Bill-{{ $bill->bill_no }}</title>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
        body
        {
            margin: 0 auto;
        }
        .table_width
        {
            width: 100%;
        }
        p
        {
            /*font-size: 12px;*/
          line-height: 15px;
        }
    </style>
</head>
<body>

	<div class="container">


        <div class="row" style="text-align: center">
            <table class="table_width">
              <thead>
               <tr style="border-bottom: 1px solid #ccc;">
                   <th style="text-align: left;"><img src="{{ url('images/logo/logo.png') }}" style="height: 40px;margin-bottom: 8px;" alt=""></th>
                   <th></th>
                   <th></th>
                   <th style="text-align: right;">
                       <p style="font-size: 14px;text-transform: uppercase;line-height: 5px;">Limmex Construction</p>
                       <span style="font-size: 10px; line-height: 2px;">Import | Supply | Equipment Rent & Maintenance</span>
                    </th>
               </tr>
               <tr>
                   <td colspan="4" style="border-bottom: 1px solid #000;">

                   </td>
               </tr>
              </thead>
            </table>
        </div>
        <div>
                        <div class="col-12 text-center">
                <h3 style="font-weight: bold;">Monthly Bill</h3>
                <p style="font-size:16px">({{ date('F Y', strtotime($bill->month)) }})</p>

            </div>
        </div>

        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <p>Date: {{ date('d F , Y', strtotime($bill->date)) }}</p>
        	   <p> <strong>Bill NO: {{ $form_data['bill_no'] }}</strong></p>
        	   <p style="margin-top:15px;">To,</p>
        	   <p style="">{{ $form_data['to'] }}</p>
        	   <p style="">{{ $form_data['company'] }}</p>
        	   <p style="">{{ $form_data['project_name'] }}</p>
        	   <p style="">{{ $form_data['project_location'] }}</p>
        	   <p style="margin-top: 12px;">
        	   	<strong style="word-spacing: 1px;">Subject:
                     {{ $form_data['subject'] }}
                 </strong>
        	   </p>

        	  <p style="margin-top: 15px;">Dear Sir,</p>
        	  <p style="">We do here & submit the bill for kind consideration & necessary action please</p>
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
        	   	    <td>Equipement Bill</td>
        	   	    <td>Hour</td>
        	   	    <td>{{ $bill->total_hour }}</td>
        	   	    <td>{{ round($bill->project_rate_per_hour,2) }}</td>
        	   	    <td>{{ round($bill->project_amount,2) }}</td>
        	   	  </tr>

        	   	  <tr>
        	   	    <td>2</td>
        	   	    <td>VAT</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>{{ round((($bill->project_amount*$bill->project_vat)/100),2) }}</td>
        	   	  </tr>

        	   	  <tr>
        	   	    <td>3</td>
        	   	    <td>AIT</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>-</td>
        	   	    <td>{{ round((($bill->project_amount*$bill->project_ait)/100),2) }}</td>
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
        	   	    <td style="text-align: right;" colspan="5"><strong>Total Outstanding Amount
                        @if($vat>0) (Including VAT & Tax) @endif </strong></td>
        	   	    <td><strong>{{ round($bill->total_project_amount,2) }}</strong></td>
        	   	  </tr>


        	   </table>
               @php
                $taka = new App\Helper\AmountConverter();
               @endphp
        	   <p><strong>Amount In Words</strong> {{ $taka->get_bd_amount_in_text(round($bill->total_project_amount,2)) }}</p>
        	</div>
        </div>

        <div class="row" style="margin-top:25px">

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

            <div class="col-md-6 col-xs-6 text-center">
                <p style="margin-top: 5px;">Thanks & Regards</p>
                 <p><img src="{{ url('images/sign.png') }}" style="height: 70px;"></p>
                <p style="margin-top: 5px;">{{ $form_data['bill_by'] }}</p>
                <p>{{ $form_data['designation'] }}</p>
                <p>{{ $form_data['company'] }}</p>
            </div>
        </div>


        <div class="row text-center">

                      <p style="margin-top: 30px;">[ Bill  Auto Generated By EMS Software by <a href="http://limmexautomation.com" target="_blank"  style="color: dodgerblue;"> Limmex Automation</a> ] </p>
        </div>

<!--                 <div class="row flex" style="display: flex;">
            <div class="">
                <p class="text-uppercase">suit#219, mukto bangla shopping</p>
                <p class="text-uppercase">complex Mirpur-1, Dhaka-1216</p>
            </div>
            <div class="">
                <p>+88 01312447767</p>
                <p>+88 01319312141</p>
            </div>
            <div class="">
                <p><a href="https://limmexbd.com/">www.limmexbd.com</a></p>
                <p><a href="mailto:limmexbd@gmail.com">limmexbd@gmail.com</a></p>
            </div>
        </div> -->


	</div>



</body>
</html>