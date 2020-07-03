<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="CreateVendorPayment" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal" role="document" >
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-if="bill">Giving Payment To {{ bill.vendor.vendor_name }} for {{ bill.equipement.eq_name }} in
                         in {{ bill.project.project_name  }} Bill No {{ bill.bill_no }}</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Paying for the bill of Month</span>
                                            <input type="text" 
                                            v-model="payment.month"
                                             class="form-control" placeholder="" readonly>
                                        </div>
                                </div>

                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Payment   Date</span>
                                            <input type="text" 
                                            v-model="payment.date"
                                            id="basicFlatpickrVendor" class="form-control" placeholder="Payment Date">
                                            <span v-if="validation_error.hasOwnProperty('date')" class="text-danger">
                                                {{ validation_error.date[0] }}
                                            </span>
                                        </div>
                                </div>


                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Bill Amount</span>
                                            <input type="text" 
                                            v-model="payment.total_vendor_amount"
                                             class="form-control" placeholder="Bill Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('total_vendor_amount')" class="text-danger">
                                                {{ validation_error.total_vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Paid Amount Till Now</span>
                                            <input type="text" 
                                            :value="payment.vendor_payment + payment.vendor_adjustment_payment"
                                             class="form-control" placeholder="Paid Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('total_vendor_amount')" class="text-danger">
                                                {{ validation_error.total_vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Outstanding</span>
                                            <input type="text" 
                                            :value="payment.outstanding_amount = payment.total_vendor_amount-payment.vendor_payment + payment.vendor_adjustment_payment"
                                             class="form-control" placeholder="Bill Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('total_vendor_amount')" class="text-danger">
                                                {{ validation_error.total_vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>

                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Enter Payment Amount</span>
                                            <input type="text" 
                                            v-model="payment.payment_amount"
                                            class="form-control" placeholder="Enter Payment Amount" >
                                            <span v-if="validation_error.hasOwnProperty('payment_amount')" class="text-danger">
                                                {{ validation_error.payment_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Enter Adjustment amount if u want to adust</span>
                                            <input type="text" 
                                            v-model="payment.adjustment"
                                             class="form-control" placeholder="Adjustment Amount" >
                                            <span v-if="validation_error.hasOwnProperty('adjustment')" class="text-danger">
                                                {{ validation_error.adjustment[0] }}
                                            </span>
                                        </div>
                                </div>


                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Current Outstanding (if it is 0 then payment is clear)</span>
                                            <input type="text" 
                                            :value="payment.current_outstanding = payment.outstanding_amount - (Number(payment.payment_amount)  + Number(payment.adjustment))"
                                             class="form-control" placeholder="Adjustment Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('current_outstanding')" class="text-danger">
                                                {{ validation_error.current_outstanding[0] }}
                                            </span>
                                        </div>
                                </div>

                                
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <span>Notes</span>
                                            <textarea class="form-control" 
                                            placeholder="Docs or payment method related note" 
                                            v-model="payment.notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary ">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-sm" 
                        v-if="button_name != 'Save'">.</div>
                         {{ button_name }} </button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
export default {
   mixins : [Mixin],
   data()
   {  
       return {
         bill : null,  
         payment : {
          id : '',
          vendor_adjustment_payment   : 0,
          total_vendor_amount : 0,
          vendor_payment : 0,
          outstanding_amount  : 0,
          payment_amount     : 0,
          adjustment : 0,
          current_outstanding : 0,
          date            : '',
          month           : '',
          notes  : ''
            
         },
         validation_error : {},
         button_name : 'Save'
       }
   },

   mounted() {

        var _this = this;
        EventBus.$on('make-vendor-payment',function(bill) {
                _this.bill = bill;
                _this.payment.id = bill.id
                _this.payment.total_vendor_amount = bill.total_vendor_amount;
                _this.payment.vendor_adjustment_payment = bill.vendor_adjustment_payment;
                _this.payment.vendor_payment = bill.vendor_payment;
                _this.payment.vendor_adjustment = bill.vendor_adjustment_payment;
                _this.payment.month = bill.month;
               
           $('#CreateVendorPayment').modal('show');
        });
    var f1 = flatpickr(document.getElementById('basicFlatpickrVendor'));
   },

 methods : {

     save()
     {

         this.button_name = 'Saving...';
         axios.post(base_url+'vendor-payment',this.payment)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#CreateVendorPayment').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('bill-changed');
              this.button_name = 'Save';
              this.resetForm();
             } 
             else
             {
               this.successMessage(response.data);
               this.button_name = 'Save';
             }
         })
         .catch(err => {
             if(err.response.status == 422)
             {
                 this.validation_error = err.response.data.errors;
                 this.validationError();
                 this.button_name = 'Save';
             }
             else
             {
                 this.successMessage(err);
                 this.button_name = 'Save';
             }
         })
     },

     resetForm()
     {
          this.payment = {
          id : '',
          vendor_adjustment_payment   : 0,
          total_vendor_amount : 0,
          vendor_payment : 0,
          outstanding_amount  : 0,
          payment_amount     : 0,
          adjustment : 0,
          current_outstanding : 0,
          date            : '',
          month           : '',
          notes  : ''

            
          };
         this.validation_error = {};
       
     }
 },
 
 computed : {


 }
   
}

</script>

<style  scoped>
.custom-modal {
 min-width: 95% !important;
}
</style>