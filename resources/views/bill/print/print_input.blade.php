<!DOCTYPE html>
<html>
<head>
	<title>Bill Crateation(preview)</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- font awesome  -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- font awesome  -->
</head>
<body>

	<div class="container">

        <form action="{{ route('bill.print') }}" method="GET"> 
<!-- 
            {{ csrf_field() }} -->

        <div class="row" style="text-align: center;margin-top: 30px;">
        	<div class="col-md-12 col-xs-12">
                <div  class="btn btn-default" style="font-size: 20px;">INVOICE PREVIEW</div>    
            </div>
@if(Session::has('warning'))

<div class="col-md-12 col-xs-12">
                <div  class="btn btn-danger" style="font-size: 20px;">{{ Session::get('warning') }}</div>    
            </div>

  @endif


        </div>     

        <div class="row">
        	<div class="col-md-12 col-xs-12">
        	   <p>Date: {{ date('d F , Y', strtotime(date('d-m-Y'))) }}</p>
        	   <p> <strong>Bill NO: <input type="text"  value="{{ $bill->bill_no }}" name="bill_no" readonly></strong></p>
        	   <p style="margin-top:20px;">To,</p>
        	   <p style=""><input type="text" value="Managing Director" name="to" class="form-control" required=""></p>
        	   <p style=""><input type="text" value="{{ $bill->project->project_argument_with }}" name="company" class="form-control" required=""></p>
        	   <p style=""><input type="text" value="{{ $bill->project->project_name }}" name="project_name" class="form-control"></p>
        	   <p style=""><input type="text" value="{{ $bill->project->project_location }}" name="project_location" class="form-control"></p>
        	   <p style="margin-top: 20px;">
        	   	<strong style="word-spacing: 1px;">Subject:
                    <input type="text" value="Bill For {{ $bill->equipement->eq_name }} ( {{ $bill->equipement->eq_model }} )  on Rental Basis For The Month Of {{ date('F Y', strtotime($bill->month)) }}" class="form-control" name="subject" required="">
                 </strong>
        	   </p>

        	  <p style="margin-top: 25px;">Dear Sir,</p> 
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
        	   <p>Amount In Words {{ $taka->get_bd_amount_in_text(round($bill->total_project_amount,2)) }}</p> 
        	</div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xs-6">
                <p style="margin-top: 20px;">Thanks & Regards</p>
                <p style="margin-top: 60px;"><input type="text" name="bill_by" value="Mizanur Rahman" class="form-control"></p>
                <p><input type="text" name="designation" value="Project Cordinator" class="form-control" required=""></p>
                <p><input type="text" name="company" value="Limmex Construction" class="form-control" required=""></p>
            </div>  


            <div class="col-md-6 col-xs-6">
                <table class="table table-bordered">
                    <tr>
                        <td>Vat Registration No</td>
                        <td><input class="form-control" type="text" name="reg_no" value="000082012" required=""></td>
                    </tr> 

                     <tr>
                        <td>TIN No</td>
                        <td><input class="form-control" type="text" name="tin_no" value="174916187470" required=""></td>
                    </tr>   

                    <tr>
                        <td>Bank Name</td>
                        <td><input class="form-control" type="text" name="bank_name" value="Banks Asia Ltd." required=""></td>
                       
                    </tr> 

                     <tr>
                        <td>Bank Account Name</td>
                        <td><input class="form-control" type="text" name="bank_ac_name" value="Limmex Construction" required=""></td>
                       
                    </tr> 

                    <tr>
                        <td>Bank Account No</td>
                        <td><input class="form-control" type="text" name="bank_ac" value="50201000543" required=""></td>
                       
                    </tr>  

                    <tr>
                        <td>Branch Name</td>
                        <td><input class="form-control" type="text" name="bank_branch" value="Shantinagar, Dhaka." required=""></td>
                       
                    </tr> 

                     <tr>
                        <td>Bank Routing Number</td>
                        <td><input class="form-control" type="text" name="bank_routing" value="175263619" required=""></td>
                       
                    </tr>

                </table>
                
                <button style="margin-bottom: 30px;width: 45%;"  type="submit" name="action" value="print"
				 class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                <button style="margin-bottom: 30px;width: 45%;"  type="submit"
				 name="action" value="pdf" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i> Dowload PDF</button>

            </div>
        </div>

    </form>

	</div>

</body>
</html>