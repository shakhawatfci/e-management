<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="aissignEquipmentUpdate" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Assigned Equipment</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Project</span>
                                            <select class="form-control" v-model="equipment.project">
                                                <option value="">Chose Project</option>
                                                <option v-for="pr in projects" :key="pr.id" :value="pr.id">
                                                    {{ pr.project_name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('project')" 
                                                class="text-danger">
                                                {{ validation_error.project[0] }}
                                               </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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

                                    <div class="col-md-4">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Select Vendor</span>
                                            <select class="form-control" v-model="equipment.vendor" @change="getVendorEquipments()">
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


                                    <div class="col-md-4">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Select Equipment</span>
                                            <select class="form-control" v-model="equipment.equipment">
                                                <option value="">Chose a Equipment</option>
                                                <option v-for="equipment in equipments" :key="equipment.id" :value="equipment.id">
                                                    {{ equipment.eq_name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('equipment')" 
                                                class="text-danger">
                                                {{ validation_error.equipment[0] }}
                                               </span>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-4">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Operator</span>
                                            <select class="form-control" v-model="equipment.operator">
                                                <option value="">Chose a Operator</option>
                                                <option v-for="operator in operators" :key="operator.id" :value="operator.id">
                                                    {{ operator.name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('operator')" 
                                                class="text-danger">
                                                {{ validation_error.operator[0] }}
                                               </span>
                                        </div>
                                    </div>
                            
                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Hour</span>
                                            <input type="text" v-model="equipment.total_hour"
                                             id="c-name" class="form-control" placeholder="Total Hour">
                                            <span v-if="validation_error.hasOwnProperty('total_hour')" class="text-danger">
                                                {{ validation_error.total_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Contact Amount With Project</span>
                                            <input type="text" v-model="equipment.total_project_amount"
                                             id="c-name" class="form-control" placeholder="Total Contact Amount With Project">
                                            <span v-if="validation_error.hasOwnProperty('total_project_amount')" class="text-danger">
                                                {{ validation_error.total_project_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Total Contact Amount With Vendor</span>
                                            <input type="text" v-model="equipment.total_vendor_amount"
                                             id="c-name" class="form-control" placeholder="Total Contact Amount With Vendor">
                                            <span v-if="validation_error.hasOwnProperty('total_vendor_amount')" class="text-danger">
                                                {{ validation_error.total_vendor_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Project Rate Per Hour</span>
                                            <input type="text" 
                                            :value="equipment.project_rate_per_hour = (( equipment.total_project_amount / equipment.total_hour ) | formatPrice)"
                                             id="c-name" class="form-control" placeholder="Project Rate Per Hour" readonly>
                                            <span v-if="validation_error.hasOwnProperty('project_rate_per_hour')" class="text-danger">
                                                {{ validation_error.project_rate_per_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Vendor Rate Per Hour</span>
                                            <input type="text" 
                                            :value="equipment.vendor_rate_per_hour =((equipment.total_vendor_amount / equipment.total_hour) | formatPrice)"
                                             id="c-name" class="form-control" placeholder="Vendor Rate Per Hour" readonly>
                                            <span v-if="validation_error.hasOwnProperty('vendor_rate_per_hour')" class="text-danger">
                                                {{ validation_error.vendor_rate_per_hour[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-4">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Assign Date</span>
                                            <input type="text" 
                                            v-model="equipment.assign_date"
                                            id="basicFlatpickr4" class="form-control" placeholder="Assign Date">
                                            <span v-if="validation_error.hasOwnProperty('assign_date')" class="text-danger">
                                                {{ validation_error.assign_date[0] }}
                                            </span>
                                        </div>
                                </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <span>Documnet links if any</span>
                                            <textarea class="form-control" 
                                            placeholder="Paste Documents link here" v-model="equipment.document_links"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary ">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'">.</div>
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
   props : ['vendors','equipment_types','operators','projects'],
   data()
   {  
       return {
         equipment : {
          id : '',
          project : '',
          equipment_type : '',
          vendor : '',
          equipment : '',
          operator : '',
          total_hour : 240,
          total_project_amount : 0,
          total_vendor_amount : 0,
          project_rate_per_hour : 0,
          vendor_rate_per_hour : 0,
          assign_date : '',
          document_links : ''
            
         },
         validation_error : {},
         equipments : [],
         button_name : 'Update'
       }
   },

   mounted() {
        var f1 = flatpickr(document.getElementById('basicFlatpickr4'));

        var _this = this;
        EventBus.$on('edit-assigned-equipment',function(id) {
           _this.getAssignedEquipment(id);
           $('#aissignEquipmentUpdate').modal('show');
        });
   },

 methods : {

     getAssignedEquipment(id)
     {
         axios.get(base_url+'assign-equipment/'+id+'/edit')
              .then(response => {
                this.equipments = response.data.equipments;
                this.equipment.id = response.data.assigned_equipment.id;
                this.equipment.project = response.data.assigned_equipment.project_id;
                this.equipment.equipment_type = response.data.assigned_equipment.equipment_type_id;
                this.equipment.equipment = response.data.assigned_equipment.equipement_id;
                this.equipment.vendor = response.data.assigned_equipment.vendor_id;
                this.equipment.operator = response.data.assigned_equipment.operator_id;
                this.equipment.total_hour = response.data.assigned_equipment.total_hour;
                this.equipment.total_project_amount = response.data.assigned_equipment.total_project_amount;
                this.equipment.total_vendor_amount = response.data.assigned_equipment.total_vendor_amount;
                this.equipment.project_rate_per_hour = response.data.assigned_equipment.project_rate_per_hour;
                this.equipment.vendor_rate_per_hour = response.data.assigned_equipment.vendor_rate_per_hour;
                this.equipment.assign_date = response.data.assigned_equipment.assign_date;
                this.equipment.document_links = response.data.assigned_equipment.documents_link;
              })
     },

     save()
     {

         this.button_name = 'Updating...';
         axios.put(base_url+'assign-equipment/'+this.equipment.id,this.equipment)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#aissignEquipmentUpdate').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('equipment-assigned');
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

     getVendorEquipments()
     {
       if(this.equipment.equipment_type === '' || this.equipment.vendor === '')
       {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'please choose equipment type and vendor both field for equipment list',
            });
           return ;
       }
       axios.get(`${base_url}equipment-by-vendor/${this.equipment.equipment_type}/${this.equipment.vendor}`)
            .then(response => {
              this.equipments = response.data;
            });
     },

     resetForm()
     {
          this.equipment = {
          
          id : '',
          project : '',
          equipment_type : '',
          vendor : '',
          equipment : '',
          operator : '',
          total_hour : 240,
          total_project_amount : 0,
          total_vendor_amount : 0,
          project_rate_per_hour : 0,
          vendor_rate_per_hour : 0,
          assign_date : '',
          document_links : ''
            
          };
         this.validation_error = {};
         this.equipments = [];
     }
 } 
   
}
</script>