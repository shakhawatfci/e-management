<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="ViewDetails" 
    tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal" role="document" >
            <div class="modal-content" v-if="bill">
                <div class="modal-header" style="display:flex">
                    <h4 class="modal-title" >
                       <span> Details Of bill no: {{ bill.bill_no }} ({{ bill.month | monthToString }}) </span>
                    
                    </h4>
                    <h4 class="modal-title" >
                       <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Close</button>
                    </h4>
                  
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                        <div class="widget widget-table-one">
                            <div class="widget-content">

                            <div class="row">

                                
                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle"><i class="fa fa-info"></i></span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h3>Bill Info</h3>
                                              <p class="meta-date"><strong>Bill No:</strong>{{ bill.bill_no }}</p>
                                               <p class="meta-date"><strong>Bill Month: </strong>{{ bill.month | monthToString }}</p>
                                              <p class="meta-date"><strong>Date: </strong>{{ bill.date | dateToString }}</p>
                                              <p class="meta-date"><strong>Prepared By: </strong>{{ bill.user.name  }}</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle"><i class="fa fa-tasks"></i></span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h3>Project </h3>
                                              <p class="meta-date">
                                                  <strong>Name: </strong>{{ bill.project.project_name }}</p>
                                              <p class="meta-date">
                                                  <strong>Locatoin: </strong>{{ bill.project.project_location }}</p>
                                              <p class="meta-date">
                                                  <strong>Agreement With: </strong>{{ bill.project.project_argument_with }}</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle"><i class="fa fa-truck"></i></span>
                                                </div>
                                          </div>
                                          <div class="t-name">
                                              <h3>Equipment</h3>
                                              <p class="meta-date"><strong>Equipment Type: </strong>{{ bill.equipment_type.name }}</p>
                                               <p class="meta-date"><strong>Vendor: </strong>{{ bill.vendor.vendor_name }}</p>
                                              <p class="meta-date"><strong>Equipment: </strong>{{ bill.equipement.eq_name }}
                                              {{ bill.equipement.eq_model }} </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-check" v-if="bill.payment_status==1"></i>
                                                        <i class="fa fa-close" v-else></i>
                                                        </span>
                                                </div>
                                          </div>
                                          <div >
                                              <h3>Project Bill</h3>
                                             <table style="width:100%;font-size:15px;color:white">
                                                 <tbody>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Hour</th>
                                                     <td >= {{ bill.total_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Rate Per Hour</th>
                                                     <td >= {{ bill.project_rate_per_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Amount (R*H)</th>
                                                     <td >= {{ bill.project_amount }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">VAT {{ bill.project_vat }}%</th>
                                                     <td >= {{ ((bill.project_amount*bill.project_vat)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">AIT {{ bill.project_ait }}%</th>
                                                     <td >= {{ ((bill.project_amount*bill.project_ait)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Others VAT {{ bill.project_sup }}%</th>
                                                     <td >= {{ ((bill.project_amount*bill.project_sup)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Total Bill Amount + VAT</th>
                                                     <td >= {{ bill.total_project_amount |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Paid Amount</th>
                                                     <td >= {{ bill.project_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Adjustment</th>
                                                     <td >= {{ bill.project_adjustment_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Total Paid</th>
                                                     <td >= {{ Number(bill.project_payment)+Number(bill.project_adjustment_payment) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">OutStanding</th>
                                                     <td >= {{ bill.total_project_amount - (Number(bill.project_payment)+Number(bill.project_adjustment_payment)) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Status</th>
                                                     <td >= 
                                                         <span class="badge badge-success" v-if="bill.payment_status == 1">Paid</span>
                                                         <span class="badge badge-danger" v-else>Unpaid</span>
                                                     </td>
                                                 </tr>
                                                 </tbody>

                                             </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <!-- vendor bill  -->

                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-check" v-if="bill.operator_payment_status==1"></i>
                                                        <i class="fa fa-close" v-else></i>
                                                        </span>
                                                </div>
                                          </div>
                                          <div >
                                              <h3>Vendor Bill</h3>
                                             <table style="width:100%;font-size:15px;color:white">
                                                 <tbody>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Hour</th>
                                                     <td >= {{ bill.total_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Rate Per Hour</th>
                                                     <td >= {{ bill.vendor_rate_per_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Amount (R*H)</th>
                                                     <td >= {{ bill.vendor_amount }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">VAT {{ bill.vendor_vat }}%</th>
                                                     <td >= {{ ((bill.vendor_amount*bill.vendor_vat)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">AIT {{ bill.vendor_ait }}%</th>
                                                     <td >= {{ ((bill.vendor_amount*bill.vendor_ait)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Others VAT {{ bill.vendor_sup }}%</th>
                                                     <td >= {{ ((bill.vendor_amount*bill.vendor_sup)/100) | formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Total Bill Amount + VAT</th>
                                                     <td >= {{ bill.total_vendor_amount |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Paid Amount</th>
                                                     <td >= {{ bill.vendor_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Adjustment</th>
                                                     <td >= {{ bill.vendor_adjustment_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Total Paid</th>
                                                     <td >= {{ Number(bill.vendor_payment)+Number(bill.vendor_adjustment_payment) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">OutStanding</th>
                                                     <td >= {{ bill.total_vendor_amount - (Number(bill.vendor_payment)+Number(bill.vendor_adjustment_payment)) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Status</th>
                                                     <td >= 
                                                         <span class="badge badge-success" v-if="bill.vendor_payment_status == 1">Paid</span>
                                                         <span class="badge badge-danger" v-else>Unpaid</span>
                                                     </td>
                                                 </tr>
                                                 </tbody>

                                             </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-4 transactions-list">
                                  <div class="t-item">
                                      <div class="t-company-name">
                                          <div class="t-icon">
                                              <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        <i class="fa fa-check" v-if="bill.vendor_payment_status==1"></i>
                                                        <i class="fa fa-close" v-else></i>
                                                        </span>
                                                </div>
                                          </div>
                                          <div >
                                              <h3>Operator Bill</h3>
                                             <table style="width:100%;font-size:15px;color:white">
                                                 <tbody>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Hour</th>
                                                     <td >= {{ bill.total_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Rate Per Hour</th>
                                                     <td >= {{ bill.operator_rate_per_hour }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Amount (R*H)</th>
                                                     <td >= {{ bill.operator_total_amount }}</td>
                                                 </tr>
                                                
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Paid Amount</th>
                                                     <td >= {{ bill.operator_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Adjustment</th>
                                                     <td >= {{ bill.operator_adjustment_payment |  formatPrice }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Total Paid</th>
                                                     <td >= {{ Number(bill.operator_payment)+Number(bill.operator_adjustment_payment) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">OutStanding</th>
                                                     <td >= {{ bill.operator_total_amount - (Number(bill.operator_payment)+Number(bill.operator_adjustment_payment)) }}</td>
                                                 </tr>
                                                 <tr>
                                                     <th class="amount" style="text-align:right">Status</th>
                                                     <td >= 
                                                         <span class="badge badge-success" v-if="bill.operator_payment_status == 1">Paid</span>
                                                         <span class="badge badge-danger" v-else>Unpaid</span>
                                                     </td>
                                                 </tr>
                                                 </tbody>

                                             </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                            </div>
      
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import { EventBus  } from '../../vue-assets';
import Mixin from '../../mixin';
export default {
   mixins : [Mixin],
   data()
   {  
       return {
         bill : null,
       }
   },

   mounted() {

        var _this = this;
        EventBus.$on('bill-details',function(bill) {
                _this.bill = bill;       
           $('#ViewDetails').modal('show');
        });
   },

 methods : {



 }
   
}

</script>

<style  scoped>
.custom-modal {
 min-width: 95% !important;
}

.meta-date{
    color: white !important;
}
.meta-date strong{
    color : aqua;
}
.amount
{
    color : #E7515A;
    font-weight: bold;
}
</style>