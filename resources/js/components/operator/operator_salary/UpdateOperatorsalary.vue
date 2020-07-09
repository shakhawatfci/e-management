<template>
<!-- Modal -->
    <div id="UpdateOperatorSalary" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
              </div>
                <div class="modal-body"><i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content text-left">
                       <div class="row">
                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="operator-name">Operator Name</label>
                                    <select class="form-control" id="operator-name" v-model="salary.operator_id">
                                        <option value="">Select Operator</option>
                                        <option v-for="operator in operators" :key="operator.id" :value="operator.id">{{ operator.name }}</option>
                                    </select>
                                       <span
                                       v-if="validation_error.hasOwnProperty('operator_id')" 
                                      class="text-danger">
                                      {{ validation_error.operator_id[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="salary-month">Salary Month</label>
                                  <input type="text"  id="salary-month" class="form-control" v-model="salary.month" placeholder="Salary Month">
                                       <span
                                       v-if="validation_error.hasOwnProperty('month')" 
                                      class="text-danger">
                                      {{ validation_error.month[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="up-basicFlatpickr">Payment Date</label>
                                  <input id="up-basicFlatpickr" v-model="salary.payment_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Payment Date">
                                       <span
                                       v-if="validation_error.hasOwnProperty('payment_date')" 
                                      class="text-danger">
                                      {{ validation_error.payment_date[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="payment-amount">Payment Amount</label>
                                  <input type="text"  id="payment-amount" class="form-control" v-model="salary.payment_amount" placeholder="Payment Amount">
                                       <span
                                       v-if="validation_error.hasOwnProperty('payment_amount')" 
                                      class="text-danger">
                                      {{ validation_error.payment_amount[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="salary-mode">Mode</label>
                                  <input type="text"  id="salary-mode" class="form-control" v-model="salary.mode" placeholder="Salary Mode">
                                       <span
                                       v-if="validation_error.hasOwnProperty('mode')" 
                                      class="text-danger">
                                      {{ validation_error.mode[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="bank-note">Bank Note</label>
                                  <input type="text"  id="bank-note" class="form-control" v-model="salary.bank_note" placeholder="Salary Mode">
                                       <span
                                       v-if="validation_error.hasOwnProperty('bank_note')" 
                                      class="text-danger">
                                      {{ validation_error.bank_note[0] }}
                                     </span>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="contact-email">
                                  <i class="flaticon-mail-26"></i>
                                  <label for="bkash-note">bkash Note</label>
                                  <input type="text"  id="bkash-note" class="form-control" v-model="salary.bkash_note" placeholder="bkash Note">
                                       <span
                                       v-if="validation_error.hasOwnProperty('bkash_note')" 
                                      class="text-danger">
                                      {{ validation_error.bkash_note[0] }}
                                     </span>
                              </div>
                          </div>

                       <div class="col-md-4">
                            <div class="contact-email">
                                <i class="flaticon-mail-26"></i>
                                <label for="salary-type">Salary Type</label>
                                <select class="form-control" id="salary-type" v-model="salary.salary_type">
                                    <option value="">Select Salary Type</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Bank</option>
                                    <option value="3">Mobile Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-email">
                                <i class="flaticon-mail-26"></i>
                                <label for="Salary-status">Salary Status</label>
                                <select class="form-control" id="Salary-status" v-model="salary.status">
                                    <option value="">Salary Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="update()">
                      <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>
                    {{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
              </div>
            </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
export default {
   mixins : [Mixin],
   props: ['operators'],
   data()
   {
        
       return {
        salary : {
          id : '',
          operator_id : '',
          month : '',
          payment_date : '',
          payment_amount : '',
          mode : '',
          bank_note : '',
          bkash_note : '',
          salary_type : '',
          status : ''
        },
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      var _this = this;
      EventBus.$on('operator-salary-update',function(value){
        $("#UpdateOperatorSalary").modal('show')
        _this.salary = value;
      })
   },
   
 methods : {

     update()
     {
        this.button_name = "Updating...";

        axios.put(base_url+'operator-salary/'+this.salary.id,this.salary,)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOperatorSalary').modal('hide');
                  EventBus.$emit('operator-salary-created');
                  this.button_name = "Update";
              }
             else
              {
                this.successMessage(response.data);   
                this.button_name = "Update";
              }                           
          })
          .catch(err => {
                  if (err.response.status == 422) 
                  {
                    this.validation_error = err.response.data.errors;
                    this.validationError();
                    this.button_name = "Update";
                  } 
                  else 
                  {
                    this.successMessage(err);
                    this.button_name = "Update";
                  }
              }
          );
     },

     resetForm()
     {
        this.operator = {
          name : '',
          mobile : '',
          address : '',
          email : '',
          bkash_number : '',
          join_date : '',
          nid : '',
          date_of_birth : '',
          file : '',
          documents_link : '',
          salary : '',
          status : ''
        };
        this.dataform = new FormData();
        this.button_name = "Update";
        this.validation_error = {};
     }
 } 
   
}
</script>