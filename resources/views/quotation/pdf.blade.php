<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMMEX-{{ date('y')  }}-{{ $qoutation->id }}</title>
    <!-- <link href="{{ asset('admin-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> -->
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
      <tbody>
          <tr>
           <td colspan="4">
               <span>Date : {{ date('j M Y') }}</span>
               <p><strong>Ref:LIMMEX/{{ date('y') }}/{{ $qoutation->id  }}</strong></p>
               <p style="margin-top: 25px;">{{ $qoutation->to }}</p>
               <p>{{ $qoutation->company }}</p>
               <p>{{ $qoutation->address }}</p>

               <p style="margin-top: 25px;"><strong>Subject: {{ $qoutation->subject }}</strong></p>

               <p style="margin-top: 25px;">{{  $qoutation->request_text  }}</p>

           </td>
          </tr>

          @foreach($qoutation->quotation_history as $value)
           <tr >
               <td colspan="4" style="border: 1px solid #ccc;">
               <div style="text-align: left;">
                   <div   style="width: 100%;border-bottom:1px solid #ccc;background-color: #ccc;">
                     <div class="head_1 w_60"><p>Description</p></div>
                     <div class="head_2 w_8"><p>Rate</p></div>
                     <div class="head_3 w_8"><p>Unit</p></div>
                     <div class="head_4 w_8"><p>Qty</p></div>
                     <div class="head_5 w_16"><p>Total Amount (BDT)</p></div>
                   </div>
                   <div class="mt_10_div"  style="width: 100%;border-bottom:1px solid #ccc;">
                     <div class="head_1 w_60"><p>{{ $value->equipment_description }}</p></div>
                     <div class="head_2 w_8"><p>{{ $value->equipment_rate }}</p></div>
                     <div class="head_3 w_8"><p>{{ $value->equipment_unit }}</p></div>
                     <div class="head_4 w_8"><p>{{ $value->equipment_qty }}</p></div>
                     <div class="head_5 w_16"><p><strong>{{ $value->total_equipment_amount }}</strong></p></div>
                   </div>
                   <div class="mt_10_div"  style="min-height: 30px;width: 100%;border-bottom:1px solid #ccc;">
                     <div class="head_1 w_60"><p>{{ $value->operator_description }}</p></div>
                     <div class="head_2 w_8"><p>{{ $value->operator_rate }}</p></div>
                     <div class="head_3 w_8"><p>{{ $value->operator_unit }}</p></div>
                     <div class="head_4 w_8"><p>{{ $value->operator_qty }}</p></div>
                     <div class="head_5 w_16"><p><strong>{{ $value->total_operator_amount }}</strong></p></div>
                   </div>
                   <div class="mt_10_div"  style="min-height: 30px;width: 100%;border-bottom:1px solid #ccc;">
                     <div class="head_1 w_60"><p>{{ $value->mobilization_description }}</p></div>
                     <div class="head_2 w_8"><p>-</p></div>
                     <div class="head_3 w_8"><p>-</p></div>
                     <div class="head_4 w_8"><p>-</p></div>
                     <div class="head_5 w_16"><p>{{ $value->mobilization_amount }}</p></div>
                   </div>
                   <div class="mt_10_div"  style="min-height: 30px;width: 100%;">
                     <div class="head_1 w_60"><p>{{ $value->demobilization_description }}</p></div>
                     <div class="head_2 w_8"><p>-</p></div>
                     <div class="head_3 w_8"><p>-</p></div>
                     <div class="head_4 w_8"><p>-</p></div>
                     <div class="head_5 w_16"><p>{{ $value->demobilization_amount }}</p></div>
                   </div>
               </div>
               </td>
           </tr>
           <!-- <tr>
               @if(!$loop->last)
               <td class="bt_none" colspan="4">
                 <br>
               </td>
               @endif
           </tr> -->
          @endforeach
          <tr>
              <td colspan="4">
                  <strong class="mt_10_div">Terms & Condition</strong>
                  <div style="font-size: 12px;">
                  {!! $qoutation->terms !!}
                  </div>
              </td>
          </tr>

          <tr>
              <td class="bt_none" colspan="4">
                  <p class="mt_10_div">We are always ready to serve you best !</p>
                  <p><strong>Best Regards</strong></p>
                  <p><img src="{{ url('images/sign.png') }}" style="height: 70px;"></p>
                  <p>{{ $qoutation->name }}</p>
                  <p>{{ $qoutation->designation }}</p>
                  <p><strong>LIMMEX CONSTRUCTION</strong></p>

              </td>
          </tr>
      </tbody>

    <tfoot>
        <tr>
          <td colspan="4" style="text-align: center;">
          <p class="mt_10_div">[ Qoutation  Auto Generated By EMS Software <a href="http://limmexautomation.com" target="_blank"  style="color: dodgerblue;">by Limmex Automation</a> ]</p>
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
