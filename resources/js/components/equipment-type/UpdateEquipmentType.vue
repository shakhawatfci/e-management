<template>
        <!-- Modal -->
    <div class="modal fade" id="updateEquipmentType" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Equipment Type</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-name text-left">
                                            <i class="flaticon-user-11"></i>
                                            <span>Equipment Type Name</span>
                                            <input type="text" v-model="equipment.name"
                                             id="c-name" class="form-control" placeholder="Name: eg, excavetor,crane ...">
                                            <span v-if="validation_error.hasOwnProperty('name')" class="text-danger">
                                                {{ validation_error.name[0] }}
                                            </span>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-email text-left">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Status</span>
                                            <select class="form-control" v-model="equipment.status">
                                                <option value="">Category Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location text-left">
                                            <i class="flaticon-location-1"></i>
                                            <span>Note (optional)</span>
                                            <textarea class="form-control" placeholder="Note" v-model="equipment.note"></textarea>
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
         equipment : {
          id       : '',
          name     : '',
          note     : '',
          status   : '',
            
         },
         validation_error : {},
         button_name : 'Update'
       }
   },

   mounted() {
        var _this = this;
        EventBus.$on('edit-equipment-type',function(equipment){
         _this.equipment = equipment;
          $('#updateEquipmentType').modal('show');
        });
   },

 methods : {
     save()
     {

         this.button_name = 'Updating...';
         axios.put(base_url+'equipment-type/'+this.equipment.id,this.equipment)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#updateEquipmentType').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('equipment-type-created');
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
          this.equipment = {
          
          name     : '',
          note     : '',
          status   : '',
            
          };
         this.validation_error = {};
     }
 } 
   
}
</script>