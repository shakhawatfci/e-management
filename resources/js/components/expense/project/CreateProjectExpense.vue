<template>
<!-- Modal -->
    <div id="createProjectExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project-head">Project Expense Head</label>
                                      <select class="form-control" id="project-head" v-model="project.project_expense_head_id">
                                          <option value="">Chose Project Expense Head</option>
                                          <option v-for="project in project_expense_head" :key="project.id" :value="project.id">
                                              {{ project.head_name }}
                                          </option>
                                      </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('project_expense_head_id')" 
                                          class="text-danger">
                                          {{ validation_error.project_expense_head_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project-name">Project Name</label>
                                      <select class="form-control" id="project-name" v-model="project.project_id">
                                          <option value="">Chose a Project</option>
                                          <option v-for="value in projects" :key="value.id" :value="value.id">
                                              {{ value.project_name }}
                                          </option>
                                      </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('project_id')" 
                                          class="text-danger">
                                          {{ validation_error.project_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="basicFlatpickr">Date</label>
                                      <input id="basicFlatpickr" v-model="project.date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date">
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
                                    <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormat="YYYY-MM" @input="setMonth"></vue-monthly-picker>
                                    <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                        {{ validation_error.month[0] }}
                                    </span>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="amount">Amount</label>
                                    <input type="text" id="amount" class="form-control" v-model="project.amount" placeholder="amount">
                                    <span
                                       v-if="validation_error.hasOwnProperty('amount')" 
                                      class="text-danger">
                                      {{ validation_error.amount[0] }}
                                     </span>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="document-link">Project Document Link</label>
                                    <input type="text" id="document-link" class="form-control" v-model="project.document_link" placeholder="Document Link">
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
                                        <textarea class="form-control" id="note" placeholder="Note" v-model="project.note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="save()">
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
   props : ['project_expense_head','projects'],
   components: {
      VueMonthlyPicker
    },

   data()
   {
        
       return {
        project : {
          project_expense_head_id : '',
          project_id : '',
          month : '',
          date : '',
          amount : '',
          document_link : '',
          note : ''
        },
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month",
        },
        month : '',
        button_name : 'Save',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
   },
   
 methods : {
    setMonth(){
      this.project.month = this.month._i
    },

     save()
     {
        this.button_name = "Saving...";
          axios.post(base_url+'project-expense',this.project)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createProjectExpense').modal('hide');
                  EventBus.$emit('ProjectExpense-created');
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
          this.project = {
          project_expense_head_id : '',
          project_id : '',
          user_id : '',
          month : '',
          date : '',
          amount : '',
          document : '',
          doucment_link : '',
          note : ''
        };
        this.month = '';
        this.validation_error = {};
     }
 } 
   
}
</script>