<template>
<!-- Modal -->
    <div id="UpdateOfficeExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project-head">Office Expense Head</label>
                                      <select class="form-control" id="project-head" v-model="office.office_expense_head_id">
                                          <option value="">Chose Office Expense Head</option>
                                          <option v-for="office_exp in office_expense_head" :key="office_exp.id" :value="office_exp.id">
                                              {{ office_exp.head_name }}
                                          </option>
                                      </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('office_expense_head_id')" 
                                          class="text-danger">
                                          {{ validation_error.office_expense_head_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="up-basicFlatpickr">Date</label>
                                      <input id="up-basicFlatpickr" v-model="office.date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date">
                                        <span
                                         v-if="validation_error.hasOwnProperty('date')" 
                                        class="text-danger">
                                        {{ validation_error.date[0] }}
                                       </span>
                                </div>
                            </div>
             
                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-user-11"></i>
                                    <label>Month</label>
                                    <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="office.month" dateFormt="YYYY-MM"></vue-monthly-picker>
                                    <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                        {{ validation_error.month[0] }}
                                    </span>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="amount">Amount</label>
                                    <input type="text" id="amount" class="form-control" v-model="office.amount" placeholder="amount">
                                    <span
                                       v-if="validation_error.hasOwnProperty('amount')" 
                                      class="text-danger">
                                      {{ validation_error.amount[0] }}
                                     </span>
                                </div>
                              </div>
                               
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="document-link">Document Link</label>
                                    <input type="text" id="document-link" class="form-control" v-model="office.document_link" placeholder="Document Link">
                                    <span
                                       v-if="validation_error.hasOwnProperty('document_link')" 
                                      class="text-danger">
                                      {{ validation_error.document_link[0] }}
                                     </span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-location">
                                        <i class="flaticon-location-1"></i>
                                        <label for="note">Expense Note</label>
                                        <textarea class="form-control" id="note" placeholder="Note" v-model="office.note"></textarea>
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
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   components: {
      VueMonthlyPicker
    },
   data()
   {
        
       return {
        office : {
          id : '',
          office_expense_head_id : '',
          month : '',
          date : '',
          amount : '',
          document_link : '',
          note : ''
        },
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        office_expense_head : [],
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
    var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      this.getOfficeHead()
      var _this = this;
      EventBus.$on('officeexpense-update', function(value){
        $('#UpdateOfficeExpense').modal('show')
          _this.office = value;
      })
   },

 methods : {
 
     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'office-expense/'+this.office.id,this.office)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOfficeExpense').modal('hide');
                  EventBus.$emit('OfficeExpense-created');
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

     getOfficeHead()
     {
        axios.get(base_url+'office-head-data')
        .then(response => {
          this.office_expense_head = response.data
          console.log(response.data)
        })
     },

     resetForm()
     {
          this.office = {
          id : '',
          office_expense_head_id : '',
          month : '',
          date : '',
          amount : '',
          document : '',
          doucment_link : '',
          note : ''
        };
        this.office_expense_head = [];
        this.validation_error = {};
     }
 } 
   
}
</script>