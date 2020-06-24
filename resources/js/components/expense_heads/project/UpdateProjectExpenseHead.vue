<template>
<!-- Modal -->
    <div id="UpdateProjectHead" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="update()" role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Create New</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="head-name">Project Expense Head Name</label>
                                        <input type="text"
                                          class="form-control" id="head-name" v-model="project.head_name" placeholder="Equipment Head Name">
                                        <span v-if="validation_error.hasOwnProperty('head_name')" class="text-danger">
                                                {{ validation_error.head_name[0] }}
                                        </span>
                                    </div>
                                </div>
                             </div>
	                            <div class="row">
	                                <div class="col-md-12">
	                                    <div class="contact-email">
	                                        <i class="flaticon-mail-26"></i>
	                                        <label for="head-status">Project Expense Head Status</label>
	                                        <select class="form-control" id="head-status" v-model="project.status">
	                                            <option value="">Equipment Head Status</option>
	                                            <option value="1">Active</option>
	                                            <option value="0">Inactive</option>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary">
                    	<div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>
                    {{ button_name }}</button>

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
        project : {
        	  id : '',
            head_name : '',
            status : ''
          },
         button_name : 'Update',
         validation_error : {}
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('projectExpenseHead-update', function(value){
        $('#UpdateProjectHead').modal('show')
          _this.project = value;
      })
   },

 methods : {

     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'project-expense-head/'+this.project.id,this.project)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateProjectHead').modal('hide');
                  EventBus.$emit('ProjectExpenseHead-created');
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
          this.equipment = {
              head_name : '',
              status : ''
          };
         this.validation_error = {};
     }
 } 
   
}
</script>