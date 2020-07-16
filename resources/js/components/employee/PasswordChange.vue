<template>
        <!-- Modal -->
    <div class="modal fade" id="ChangePassword" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chaning Password for {{ employee.name }}</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">

                                <div class="row">
                                  <div class="col-md-12">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>New Password</span>
                                               <input type="password" class="form-control"
                                                v-model="employee.password"
                                                placeholder="Enter New Password">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('password')" 
                                                class="text-danger">
                                                {{ validation_error.password[0] }}
                                               </span>
                                        </div>
                                    </div>
                                  <div class="col-md-12">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Confirm Password</span>
                                               <input type="password" class="form-control"
                                                v-model="employee.password_confirmation"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary">
               <div class="spinner-grow text-white mr-2 align-self-center loader-sm" 
            v-if="button_name != 'Update'">.</div>
                        {{ button_name }}
                        </button>

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
         employee : {
          
          employee_id : '',
          name : '',
          password : '',
          password_confirmation : '',
            
         },
         validation_error : {},
         button_name : 'Update'
       }
   },

   mounted() {

    var _this = this;
    EventBus.$on('employee-password',function(value) {
    _this.employee.employee_id = value.employee_id;
    _this.employee.name = value.name;
     $('#ChangePassword').modal('show');
    });

   },

 methods : {
     save()
     {

         this.button_name = 'Updating...';
         axios.post(base_url+'employee-password',this.employee)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#ChangePassword').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('employee-created');
              this.button_name = 'Update';
              this.resetForm();
             } 
             else
             {
               this.successMessage(response.data);
               this.button_name = 'Update';
             }
         })
         .catch(err => {
             if(err.response.status == 422)
             {
                 this.validation_error = err.response.data.errors;
                 this.validationError();
                 this.button_name = 'Update';
             }
             else
             {
                 this.successMessage(err);
                 this.button_name = 'Update';
             }
         })
     },

     resetForm()
     {
         this.employee = {
          
          employee_id : '',
          name : '',
          password : '',
          password_confirmation : '',
            
         };
         this.validation_error = {}
     }
 } 
   
}
</script>