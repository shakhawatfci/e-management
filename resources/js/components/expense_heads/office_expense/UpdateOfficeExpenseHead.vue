<template>
<!-- Modal -->
    <div id="UpdateOfficeHead" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
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
                                        <label for="head-name">Office Expense Head Name</label>
                                        <input type="text"
                                          class="form-control" id="head-name" v-model="office.head_name" placeholder="Office Head Name">
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
	                                        <label for="head-status">Office Expense Head Status</label>
	                                        <select class="form-control" id="head-status" v-model="office.status">
	                                            <option value="">Office Head Status</option>
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
        office : {
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
      EventBus.$on('officeExpenseHead-update', function(value){
        $('#UpdateOfficeHead').modal('show')
          _this.office = value;
      })
   },

 methods : {

     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'office-expense-head/'+this.office.id,this.office)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOfficeHead').modal('hide');
                  EventBus.$emit('OfficeExpenseHead-created');
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
          this.office = {
              head_name : '',
              status : ''
          };
         this.validation_error = {};
     }
 } 
   
}
</script>