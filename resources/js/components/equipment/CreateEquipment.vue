<template>
        <!-- Modal -->
    <div class="modal fade" id="createEquipment" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Equipment</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <select class="form-control" v-model="equipment.equipment_type">
                                                <option value="">Chose a Equipment Type</option>
                                                <option v-for="eq_type in equipment_types" :key="eq_type.id" :value="eq_type.id">
                                                    {{ eq_type.name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('equipment_type')" 
                                                class="text-danger">
                                                {{ validation_error.equipment_type[0] }}
                                               </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <select class="form-control" v-model="equipment.vendor">
                                                <option value="">Chose a vendor</option>
                                                <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">
                                                    {{ vendor.vendor_name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('vendor')" 
                                                class="text-danger">
                                                {{ validation_error.vendor[0] }}
                                               </span>
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <input type="text" v-model="equipment.equipment_name"
                                             id="c-name" class="form-control" placeholder="Equipment Name: ">
                                            <span v-if="validation_error.hasOwnProperty('equipment_name')" class="text-danger">
                                                {{ validation_error.equipment_name[0] }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <input type="text" id="c-email" v-model="equipment.equipment_model" class="form-control" placeholder="Equipment Model">
                                                <span
                                                 v-if="validation_error.hasOwnProperty('equipment_model')" 
                                                class="text-danger">
                                                {{ validation_error.equipment_model[0] }}
                                               </span>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                 <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <input type="text" id="c-phone" class="form-control" v-model="equipment.capacity" placeholder="Capacity">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <select class="form-control" v-model="equipment.status">
                                                <option value="">Equipment Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <textarea class="form-control" placeholder="Note" v-model="equipment.note"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary ">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'">.</div>
                         {{ button_name }} </button>

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
   props : ['vendors','equipment_types'],
   data()
   {  
       return {
         equipment : {
          equipment_name : '',
          equipment_model : '',
          vendor : '',
          capacity : '',
          note : '',
          status : '',
            
         },
         validation_error : {},
         button_name : 'Save'
       }
   },

   mounted() {
  
   },

 methods : {
     save()
     {

         this.button_name = 'Saving...';
         axios.post(base_url+'equipment',this.equipment)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#createEquipment').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('equipment-created');
              this.button_name = 'Save';
              this.resetForm();
             } 
             else
             {
               this.successMessage(response.data);
               this.button_name = 'Save';
             }
         })
         .catch(err => {
             if(err.response.status == 422)
             {
                 this.validation_error = err.response.data.errors;
                 this.validationError();
                 this.button_name = 'Save';
             }
             else
             {
                 this.successMessage(err);
                 this.button_name = 'Save';
             }
         })
     },

     resetForm()
     {
          this.equipment = {
          
          equipment_name : '',
          equipment_model : '',
          vendor : '',
          capacity : '',
          note : '',
          status : ''
            
          };
         this.validation_error = {};
     }
 } 
   
}
</script>