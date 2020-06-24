<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="aissignEquipmentRelease" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Releasing Equipment</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                            <div class="row">
                            <div class="col-md-12">
                            <div class="card component-card_1">
                                <div class="card-body">
                                    <p class="card-text" v-if="equipment.release_status == 1">
                                        This Equipment is Currently Active, By Chosing Release option you can release it 
                                    </p>
                                    <p class="card-text" v-else>
                                        Equipment already Released From Project by chosing active form current status you can activate it
                                    </p>
                                </div>
                            </div>
                            </div>
                            </div>

                                <div class="row">
                 
                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project</span>
                                            <input type="text" 
                                            v-model="equipment.project.project_name"
                                             class="form-control" placeholder="Project" readonly>
                                        </div>
                                </div>
                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor</span>
                                            <input type="text" 
                                            v-model="equipment.vendor.vendor_name"
                                             class="form-control" placeholder="Vendor" readonly>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Equipment Type</span>
                                            <input type="text" 
                                            v-model="equipment.equipment_type.name"
                                             class="form-control" placeholder="Project" readonly>
                                        </div>
                                </div>


                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Equipment Name</span>
                                            <input type="text" 
                                            :value="equipment.equipement.eq_name+'-'+equipment.equipement.eq_model"
                                             class="form-control" placeholder="Project" readonly>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Current Status (you have to chose it's going to be active or relase )</span>
                                         <select class="form-control" v-model="release_info.release_status">
                                             <option value="0">Release</option>
                                             <option value="1">Active</option>
                                         </select>
                                         
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Release Date</span>
                                         <input type="text" id="basicFlatpickr5" v-model="release_info.release_date" 
                                         class="form-control" placeholder="Release Date">
                                            <span v-if="validation_error.hasOwnProperty('release_date')" class="text-danger">
                                                {{ validation_error.release_date[0] }}
                                            </span>
                                        </div>
                                </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <span>Release Note</span>
                                            <textarea class="form-control" 
                                            placeholder="Release Note: eg,reason for release"
                                             v-model="release_info.release_note"></textarea>
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
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
export default {
   mixins : [Mixin],
   data()
   {  
       return {
         equipment: {
             equipement:{

              eq_name: '',
              eq_model: '',
             },
             project:{
              project_name: '',
              project_location: ''
             },
             equipment_type:{
              name: '',
             },
             vendor : {
                 name : '',
             },
             release_status : 0,
         },
         release_info : {
          id : '',
          release_date   : '',
          release_note   : '',
          release_status : 0,
            
         },
         validation_error : {},
         equipments : [],
         button_name : 'Save'
       }
   },

   mounted() {
        var f1 = flatpickr(document.getElementById('basicFlatpickr5'));

        var _this = this;
        EventBus.$on('release-equipment',function(equipment)
        {
          _this.equipment      = equipment;
           _this.release_info.release_status = equipment.release_status;
           _this.release_info.release_date= equipment.release_date;
           _this.release_info.release_note = equipment.release_note;
           $('#aissignEquipmentRelease').modal('show');


        });
   },

 methods : {

 
     save()
     {

         this.button_name = 'Saving...';
         axios.put(base_url+'release-equipment/'+this.equipment.id,this.release_info)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#aissignEquipmentRelease').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('equipment-assigned');
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
          this.release_info = {  
          release_date : '',
          release_note : '',
          release_status : 0,
          };
         this.validation_error = {};
     }
 } 
   
}
</script>