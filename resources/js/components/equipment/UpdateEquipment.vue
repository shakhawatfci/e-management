<template>
        <!-- Modal -->
    <div class="modal fade" id="updateEquipment" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Equipment</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">

                                <div class="row">
                                  <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Equipment Type</span>
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
                                        <div class="contact-email text-left">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Vendor</span>
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
                                        <div class="contact-name text-left">
                                            <i class="flaticon-user-11"></i>
                                            <span>Equipment Name</span>
                                            <input type="text" v-model="equipment.equipment_name"
                                             id="c-name" class="form-control" placeholder="Equipment Name: ">
                                            <span v-if="validation_error.hasOwnProperty('equipment_name')" class="text-danger">
                                                {{ validation_error.equipment_name[0] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-email text-left">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Model</span>
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
                                        <div class="contact-phone text-left">
                                            <i class="flaticon-telephone"></i>
                                            <span>Capacity</span>
                                            <input type="text" id="c-phone" class="form-control" v-model="equipment.capacity" placeholder="Capacity">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-email text-left">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Status</span>
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
                                        <div class="contact-location text-left">
                                            <i class="flaticon-location-1"></i>
                                            <span>Note</span>
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
   props : ['vendors','equipment_types'],
   data()
   {  
       return {
         equipment : {
          id : '',
          equipment_name : '',
          equipment_model : '',
          vendor : '',
          equipment_type : '',
          capacity : '',
          note : '',
          status : '',
            
         },
         validation_error : {},
         button_name : 'Update'
       }
   },

   mounted() {

    var _this = this;
    EventBus.$on('edit-equipment',function(value) {
     _this.equipment.id = value.id;
     _this.equipment.equipment_name = value.eq_name;
     _this.equipment.equipment_model = value.eq_model;
     _this.equipment.capacity = value.eq_capacity;
     _this.equipment.vendor = value.vendor_id;
     _this.equipment.equipment_type = value.equipment_type_id;
     _this.equipment.note = value.note;
     _this.equipment.status = value.eq_status;

     $('#updateEquipment').modal('show');
    });

   },

 methods : {
     save()
     {

         this.button_name = 'Updating...';
         axios.put(base_url+'equipment/'+this.equipment.id,this.equipment)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#updateEquipment').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('equipment-created');
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
          
          id : '',
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