<template>
<!-- Modal -->
    <div id="createEquipmentHead" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="save()" role="form">
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
                                        <label for="head-name">Equipment Expense Head Name</label>
                                        <input type="text"
                                          class="form-control" id="head-name" v-model="equipment.head_name" placeholder="Equipment Head Name">
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
	                                        <label for="head-status">Equipment Expense Head Status</label>
	                                        <select class="form-control" id="head-status" v-model="equipment.status">
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
                    	<div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'"></div>
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
        equipment : {
              head_name : '',
              status : ''
          },
         button_name : 'Save',
         validation_error : {}
       }
   },

   mounted() {
     
   },

 methods : {

     save()
     {
        this.button_name = "Saving...";
          axios.post(base_url+'equipment-expense-head',this.equipment)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createEquipmentHead').modal('hide');
                  EventBus.$emit('EquipmentExpenseHead-created');
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
          this.equipment = {
              head_name : '',
              status : ''
          };
         this.validation_error = {};
     }
 } 
   
}
</script>