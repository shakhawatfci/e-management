<template>
<!-- Modal -->
    <div id="createOperatorSalary" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Create New</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-name">Operator Name</label>
                                        <select class="form-control" id="operator-name" v-model="salary.operator_id" @change="setSalary()">
                                            <option value="">Select Operator</option>
                                            <option v-for="operator in operators" :key="operator.id" 
                                            :value="operator.id">{{ operator.name }} ({{ operator.operator_type == 1 ? 'vendor' : 'own' }})</option>
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
                                      <label for="salary-month">Salary</label>
                                      <input type="text" id="operator-salary" class="form-control" v-model="salary.payment_amount">
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label>Month</label>
                                      <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormat="YYYY-MM" @input="setMonth"></vue-monthly-picker>
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
                                      <label for="basicFlatpickr">Payment Date</label>
                                      <input id="basicFlatpickr" v-model="salary.payment_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Payment Date">
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
                                      <label for="salary-mode">Mode</label>
                                      <select class="form-control" id="salary-mode" v-model="salary.mode" @change="setNote()">
                                        <option value="">Select Salary Mode</option>
                                        <option value="1">Cash</option>
                                        <option value="2">Bank</option>
                                        <option value="3">Mobile Bank</option>
                                      </select>
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
                                      <label for="bank-note">Bank/bkash Note</label>
                                      <input type="text"  id="bank-note" class="form-control" v-model="salary.bank_bkash_note" :placeholder="bank_bkash_note">
                                           <span
                                           v-if="validation_error.hasOwnProperty('bank_bkash_note')" 
                                          class="text-danger">
                                          {{ validation_error.bank_bkash_note[0] }}
                                         </span>
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
                    <button type="submit"  class="btn btn-primary" @click.prevent="save()">
                    	<div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'"></div>
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
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   props : ['operators'],
   components: {
      VueMonthlyPicker
    },
   data()
   {
        
    return {
        salary : {
          operator_id : '',
          month : '',
          payment_date : '',
          payment_amount : 0,
          mode : '',
          bank_bkash_note : '',
          salary_type : '',
          status : ''
        },
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        month : '',
        bank_bkash_note : '',
        button_name : 'Save',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'))
   },
   
 methods : {
    setSalary(){
      var amount  = this.operators.find(operator => operator.id === this.salary.operator_id)
      if(amount){
        this.salary.payment_amount = amount.salary
      }else{
        this.salary.payment_amount = 0
      }
    },

    setNote(){
      var field = this.salary.mode == 2 ? 'Enter Bank Note' : this.salary.mode == 1 ? 'N/A' : 'Enter Bkash Note'
      this.bank_bkash_note = field
    },

    setMonth(){
      this.salary.month = this.month._i
    },

     save()
     {
        this.button_name = "Saving...";
          axios.post(base_url+'operator-salary',this.salary)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createOperatorSalary').modal('hide');
                  EventBus.$emit('operator-salary-created');
                  this.button_name = "Save";
              }
             else
              {
                this.successMessage(response.data);   
                this.button_name = "Save";
              }                           
          })
          .catch(err => {
                  if (err.response.status == 422) 
                  {
                    this.validation_error = err.response.data.errors;
                    this.validationError();
                    this.button_name = "Save";
                  } 
                  else 
                  {
                    this.successMessage(err);
                    this.button_name = "Save";
                  }
              }
          );
     },

     resetForm()
     {
        this.salary = {
          operator_id : '',
          month : '',
          payment_date : '',
          payment_amount : '',
          mode : '',
          bank_note : '',
          bkash_note : '',
          salary_type : '',
          status : ''
        };
        this.button_name = "Save";
        this.month = '';
        this.validation_error = {};
     }
 } 
   
}
</script>