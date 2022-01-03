<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <title>Bill-{{ $bill->bill_no }}</title>
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
          line-height: 5px;
          font-size: 12px;
        }
        .mt_10_div
        {
            margin-top: 10px;
        }
        .w_60
        {

            display: inline-block;
            width: 55%;
            padding-left: 5px;
            /* text-align: center; */
        }
        .w_8
        {

            display: inline-block;
            width: 8%;
        }
        .w_16
        {
            width: 16%;
            display: inline-block;

        }
        .bt_none
        {
            border-top: none !important;
        }
    </style>
</head>
<body>
  <div class="container-fluid">
   <div class="row">
   <table class="table_width">
      <thead>
       <tr style="border-bottom: 1px solid #ccc;">
           <th style="text-align: left;"><img src="{{ url('images/logo/logo.png') }}" style="height: 40px;" alt=""></th>
           <th></th>
           <th></th>
           <th></th>
           <th></th>
           <th style="text-align: right;">
               <p style="font-size: 14px;text-transform: uppercase;line-height: 5px;">Limmex Construction</p>
               <span style="font-size: 10px; line-height: 2px;">Import | Supply | Equipment Rent & Maintenance</span>
            </th>
       </tr>
       <tr>
           <td colspan="6" style="border-bottom: 1px solid #000;">

           </td>
       </tr>
      </thead>
      <tbody>
          <tr>
           <td colspan="4">
               <p>Date: {{ date('d F , Y', strtotime($bill->date)) }}</p>
               <p> <strong>Bill NO: {{ $form_data['bill_no'] }}</strong></p>
               <p style="margin-top:20px;">To,</p>
               <p style="">{{ $form_data['to'] }}</p>
               <p style="">{{ $form_data['company'] }}</p>
               <p style="">{{ $form_data['project_name'] }}</p>
               <p style="">{{ $form_data['project_location'] }}</p>
               <p style="margin-top: 20px;">
                <strong style="word-spacing: 1px;">Subject:
                     {{ $form_data['subject'] }}
                 </strong>
               </p>

              <p style="margin-top: 25px;">Dear Sir,</p>
              <p style="">We do here & submit the bill for kind consideration & necessary action please</p>

           </td>
          </tr>

           <tr>
                <td>SL</td>
                <td>Description</td>
                <td>Unit</td>
                <td>Hour</td>
                <td>Per Hour Rate in BDT</td>
                <td>Amount in BDT</td>
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
    

        

          <tr>
              <td class="bt_none" colspan="4">
                  <p class="mt_10_div">We are always ready to serve you best !</p>
                  <p><strong>Best Regards</strong></p>
                  <p><img src="{{ url('images/sign.png') }}" style="height: 70px;"></p>
                  <p> $qoutation->name </p>
                  <p> $qoutation->designation</p>
                  <p><strong>LIMMEX CONSTRUCTION</strong></p>

              </td>
          </tr>
      </tbody>
      @php

        $taka = new App\Helper\AmountConverter();

       @endphp
       <p><strong>Amount In Words</strong> {{ $taka->get_bd_amount_in_text(round(($bill->total_project_amount + $bill->operator_total_amount - $bill->operator_payment),2)) }}</p>

    <tfoot>
        <tr>
          <td colspan="4" style="text-align: center;">
          <p style="margin-top: 5px;">[ Quotation  Auto Generated By EMS Software by <a href="http://limmexautomation.com" target="_blank"  style="color: dodgerblue;"> Limmex Automation</a> ]</p>
        </td>
        </tr>
    </tfoot>
   </table>
   </div>
  </div>
  <!-- <script>
      window.print()
  </script> -->
</body>
</html>
