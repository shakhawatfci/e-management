<template>
<!-- Modal -->
    <div id="UpdateProjectExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
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
                                      <label for="up-project-head">Project Expense Head</label>
                                      <select class="form-control" id="up-project-head" v-model="project.project_expense_head_id">
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
                                      <label for="up-project-name">Project Name</label>
                                      <select class="form-control" id="up-project-name" v-model="project.project_id">
                                          <option value="">Chose a Project</option>
                                          <option v-for="value in project_data" :key="value.id" :value="value.id">
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
                                     <label for="up-basicFlatpickr">Date</label>
                                      <input id="up-basicFlatpickr" v-model="project.date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date">
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
                                    <month-picker @change="showDate" :input-pre-filled="false" :no-default="true" :show-year="true"></month-picker>
                                    <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                        {{ validation_error.month[0] }}
                                    </span>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="up-amount">Amount</label>
                                    <input type="text" id="up-amount" class="form-control" v-model="project.amount" placeholder="amount">
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
                                      <label for="up-document-link">Project Document Link</label>
                                      <input type="text" id="up-document-link" class="form-control" v-model="project.document_link" placeholder="Document Link">
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
                                        <label for="up-note">Expense Note</label>
                                        <textarea class="form-control" id="up-note" placeholder="Note" v-model="project.note"></textarea>
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
import { MonthPicker } from 'vue-month-picker'
export default {
   mixins : [Mixin],
   props : ['project_expense_head','project_data'],
   components: {
      MonthPicker
    },
   data()
   {
       return {
          project : {
            id : '',
            project_expense_head_id : '',
            project_id : '',
            month : '',
            date : '',
            amount : '',
            document_link : '',
            note : ''
          },
         button_name : 'Update',
         validation_error : {}
       }
   },

   mounted() {
    var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      var _this = this;
      EventBus.$on('projectexpense-update', function(value){
        $('#UpdateProjectExpense').modal('show')
          _this.project = value;
      console.log(_this.project_expense_head)
      })
      console.log(this.project_data)
   },

 methods : {
      showDate(date){
          this.project.month = date.year+'-'+date.monthIndex
       },

     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'project-expense/'+this.project.id,this.project)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateProjectExpense').modal('hide');
                  EventBus.$emit('ProjectExpense-created');
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
        this.project = {
            id : '',
            project_expense_head_id : '',
            project_id : '',
            month : '',
            date : '',
            amount : '',
            document_link : '',
            note : ''
          };
         this.validation_error = {};
     }
 } 
   
}
</script>