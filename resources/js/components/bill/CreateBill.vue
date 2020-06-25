<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="CreateBill" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl custom-modal" role="document" >
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-if="equipment">Bill For {{ equipment.vendor.vendor_name }} {{ equipment.equipement.eq_name }} in
                         {{ equipment.project.project_name  }}</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Bill  Month </span>
                                            <input type="text" 
                                            v-model="bill.month"
                                            id="basicFlatpickr5" class="form-control" placeholder="Bill Month">
                                            <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                                {{ validation_error.month[0] }}
                                            </span>
                                        </div>
                                </div>
                                <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Bill  Date</span>
                                            <input type="text" 
                                            v-model="bill.date"
                                            id="basicFlatpickr4" class="form-control" placeholder="Bill Date">
                                            <span v-if="validation_error.hasOwnProperty('date')" class="text-danger">
                                                {{ validation_error.date[0] }}
                                            </span>
                                        </div>
                                </div>

                            
                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Hour</span>
                                            <input type="text" v-model="bill.total_hour"
                                             id="c-name" class="form-control" placeholder="Total Hour">
                                            <span v-if="validation_error.hasOwnProperty('total_hour')" class="text-danger">
                                                {{ validation_error.total_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project Rate Hourly</span>
                                            <input type="text" v-model="bill.project_rate_per_hour"
                                             id="c-name" class="form-control" placeholder="Project Rate Per Hour">
                                            <span v-if="validation_error.hasOwnProperty('project_rate_per_hour')"
                                             class="text-danger">
                                                {{ validation_error.project_rate_per_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project Amount Excluding Vat</span>
                                            <input type="text" :value="bill.project_amount = (bill.total_hour*bill.project_rate_per_hour)"
                                             id="c-name" class="form-control" placeholder="Project Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('project_amount')"
                                             class="text-danger">
                                                {{ validation_error.project_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project  Vat (%) 
                                                <span v-if="projectVatCalculate > 0">
                                                In Amount {{ projectVatCalculate }}
                                                </span>
                                                </span>
                                            <input type="text" v-model="bill.project_vat"
                                             id="c-name" class="form-control" placeholder="Project Vat">
                                            <span v-if="validation_error.hasOwnProperty('project_vat')"
                                             class="text-danger">
                                                {{ validation_error.project_vat[0] }}
                                            </span>
                                        </div>
                                </div>
                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project  AIT (%)
                                                <span v-if="projectAitCalculate > 0">
                                                In Amount {{ projectAitCalculate }}
                                                </span>
                                            </span>
                                            <input type="text" v-model="bill.project_ait"
                                             id="c-name" class="form-control" placeholder="Project AIT">
                                            <span v-if="validation_error.hasOwnProperty('project_ait')"
                                             class="text-danger">
                                                {{ validation_error.project_ait[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project  Others Vat (%)
                                               <span v-if="projectSupCalculate > 0">
                                                In Amount {{ projectSupCalculate }}
                                                </span>
                                            </span>
                                            <input type="text" v-model="bill.project_sup"
                                             id="c-name" class="form-control" placeholder="Project Others Vat">
                                            <span v-if="validation_error.hasOwnProperty('project_sup')"
                                             class="text-danger">
                                                {{ validation_error.project_sup[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Project Amount including vat </span>
                                            <input type="text" :value="bill.total_project_amount = (bill.project_amount+projectAitCalculate+projectSupCalculate+projectAitCalculate)"
                                             id="c-name" class="form-control" placeholder="Project Total Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('total_project_amount')"
                                             class="text-danger">
                                                {{ validation_error.total_project_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor Rate Hourly</span>
                                            <input type="text" v-model="bill.vendor_rate_per_hour"
                                             id="c-name" class="form-control" placeholder="Vendor Rate Per Hour">
                                            <span v-if="validation_error.hasOwnProperty('vendor_rate_per_hour')"
                                             class="text-danger">
                                                {{ validation_error.vendor_rate_per_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor Amount Excluding Vat</span>
                                            <input type="text" :value="bill.vendor_amount = (bill.total_hour*bill.vendor_rate_per_hour)"
                                             id="c-name" class="form-control" placeholder="Vendor Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('vendor_amount')"
                                             class="text-danger">
                                                {{ validation_error.vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor  Vat (%)
                                               <span v-if="vendorVatCalculate > 0">
                                                In Amount {{ vendorVatCalculate }}
                                                </span>

                                            </span>
                                            <input type="text" v-model="bill.vendor_vat"
                                             id="c-name" class="form-control" placeholder="Vendor Vat">
                                            <span v-if="validation_error.hasOwnProperty('vendor_vat')"
                                             class="text-danger">
                                                {{ validation_error.vendor_vat[0] }}
                                            </span>
                                        </div>
                                </div>
                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor  AIT (%)
                                               <span v-if="vendorAitCalculate > 0">
                                                In Amount {{ vendorAitCalculate }}
                                                </span>

                                            </span>
                                            <input type="text" v-model="bill.vendor_ait"
                                             id="c-name" class="form-control" placeholder="Vendor AIT">
                                            <span v-if="validation_error.hasOwnProperty('vendor_ait')"
                                             class="text-danger">
                                                {{ validation_error.vendor_ait[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor  Others Vat  (%)
                                               <span v-if="vendorSupCalculate > 0">
                                                In Amount {{ vendorSupCalculate }}
                                                </span>       
                                            </span>
                                            <input type="text" v-model="bill.vendor_sup"
                                             id="c-name" class="form-control" placeholder="Vendor Others Vat">
                                            <span v-if="validation_error.hasOwnProperty('vendor_sup')"
                                             class="text-danger">
                                                {{ validation_error.vendor_sup[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-3">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Vendor Amount including vat</span>
                                            <input type="text" 
                                            :value="bill.total_vendor_amount = (bill.vendor_amount+vendorVatCalculate+vendorAitCalculate+vendorSupCalculate)"
                                             id="c-name" class="form-control" placeholder="Vendor Total Amount" readonly>
                                            <span v-if="validation_error.hasOwnProperty('total_vendor_amount')"
                                             class="text-danger">
                                                {{ validation_error.total_vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <span>Documnet links if any</span>
                                            <textarea class="form-control" 
                                            placeholder="Paste Documents link here" v-model="bill.documents_links"></textarea>
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
import { EventBus  } from '../../vue-assets';
import Mixin from '../../mixin';
export default {
   mixins : [Mixin],
   data()
   {  
       return {
         equipment : null,  
         bill : {
          id : '',
          total_hour : 0,
          project_rate_per_hour : 0,
          vendor_rate_per_hour : 0,
          project_amount  : 0,
          vendor_amount   : 0,
          project_vat     : 0,
          project_ait     : 0,
          project_sup     : 0,
          vendor_vat      : 0,
          vendor_ait      : 0,
          vendor_sup      : 0,
          total_project_amount : 0,
          total_vendor_amount : 0,
          date            : '',
          month           : '',
          documents_link  : ''
            
         },
         validation_error : {},
         equipments : [],
         button_name : 'Save'
       }
   },

   mounted() {

        var _this = this;
        EventBus.$on('create-bill',function(equipment) {
                _this.equipment = equipment;
                _this.bill.id = equipment.id;
                _this.bill.total_hour = equipment.total_hour;
                _this.bill.project_rate_per_hour = equipment.project_rate_per_hour;
                _this.bill.vendor_rate_per_hour  = equipment.vendor_rate_per_hour;
           $('#CreateBill').modal('show');
        });
                var f1 = flatpickr(document.getElementById('basicFlatpickr4'));
   },

 methods : {

     save()
     {

         this.button_name = 'Saving...';
         axios.post(base_url+'bill',this.bill)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#CreateBill').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('bill-created');
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
          this.bill = {

          id : '',
          total_hour : 0,
          project_rate_per_hour : 0,
          vendor_rate_per_hour : 0,
          project_amount  : 0,
          vendor_amount   : 0,
          project_vat     : 0,
          project_ait     : 0,
          project_sup     : 0,
          vendor_vat      : 0,
          vendor_ait      : 0,
          vendor_sup      : 0,
          total_project_amount : 0,
          total_vendor_amount : 0,
          date            : '',
          month           : '',
          documents_link  : ''
            
          };
         this.validation_error = {};
         this.equipments = [];
     }
 },
 
 computed : {

     projectVatCalculate()
     {
         return  this.bill.project_amount*this.bill.project_vat/100;
     },

     projectAitCalculate()
     {
         return  this.bill.project_amount*this.bill.project_ait/100;
     },

     projectSupCalculate()
     {
         return  this.bill.project_amount*this.bill.project_sup/100;
     },

     vendorVatCalculate()
     {
         return  this.bill.vendor_amount*this.bill.vendor_vat/100;
     },

     vendorAitCalculate()
     {
         return  this.bill.vendor_amount*this.bill.vendor_ait/100;
     },

     vendorSupCalculate()
     {
         return  this.bill.vendor_amount*this.bill.vendor_sup/100;
     }
 }
   
}

</script>

<style  scoped>
.custom-modal {
 min-width: 95% !important;
}
</style>