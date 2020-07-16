<template>
        <!-- Modal -->
    <div class="modal animated rotateInDownLeft custo-rotateInDownLeft" id="UpdateMobilizatoin" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update  Mobilization</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Project</span>
                                            <select class="form-control" v-model="mobilization.project">
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
                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Equipment Type</span>
                                            <select class="form-control" v-model="mobilization.equipment_type">
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
                                            <span>Select Vendor</span>
                                            <select class="form-control" v-model="mobilization.vendor" @change="getVendorEquipments()">
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


                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                            <span>Select Equipment</span>
                                            <select class="form-control" v-model="mobilization.equipment">
                                                <option value="">Chose a Equipment</option>
                                                <option v-for="equipment in equipments" 
                                                :key="equipment.id" :value="equipment.id">
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
                            

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Month</span>
                                             <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="mobilization.month" dateFormt="YYYY-MM"></vue-monthly-picker>
                                            <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                                {{ validation_error.month[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Date</span>
                                            <input type="text" v-model="mobilization.date"
                                             id="basicFlatpickr4" class="form-control" placeholder="Enter Date">
                                            <span v-if="validation_error.hasOwnProperty('date')" class="text-danger">
                                                {{ validation_error.date[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Destination From</span>
                                            <input type="text" v-model="mobilization.destination_from"
                                             id="basicFlatpickr4" class="form-control" placeholder="Destination From">
                                            <span v-if="validation_error.hasOwnProperty('destination_from')" class="text-danger">
                                                {{ validation_error.destination_from[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Destination To</span>
                                            <input type="text" v-model="mobilization.destination_to"
                                             id="basicFlatpickr4" class="form-control" placeholder="Destination To">
                                            <span v-if="validation_error.hasOwnProperty('destination_to')" class="text-danger">
                                                {{ validation_error.destination_to[0] }}
                                            </span>
                                        </div>
                                </div>

                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Amount Taken From Project</span>
                                            <input type="text" v-model="mobilization.project_given_amount"
                                             id="c-name" class="form-control" placeholder="Project Given Amount">
                                            <span v-if="validation_error.hasOwnProperty('project_given_amount')" class="text-danger">
                                                {{ validation_error.project_given_amount[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Lobaid Cost (or any cost from taken amount)</span>
                                            <input type="text" v-model="mobilization.lobaid_cost"
                                             id="c-name" class="form-control" placeholder="Lobaid Cost">
                                            <span v-if="validation_error.hasOwnProperty('lobaid_cost')" class="text-danger">
                                                {{ validation_error.lobaid_cost[0] }}
                                            </span>
                                        </div>
                                </div>


                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                            <span>Profit (Taken - Given)</span>
                                            <input type="text" :value="mobilization.profit = mobilization.project_given_amount-mobilization.lobaid_cost"
                                             id="c-name" class="form-control" placeholder="Lobaid Cost" readonly>
                                            <span v-if="validation_error.hasOwnProperty('lobaid_cost')" class="text-danger">
                                                {{ validation_error.lobaid_cost[0] }}
                                            </span>
                                        </div>
                                </div>
                                    
                                </div>

                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <span>Note</span>
                                            <textarea class="form-control" 
                                            placeholder="Paste Documents link here" v-model="mobilization.note"></textarea>
                                        </div>
                                    </div>
                                </div> -->
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
import { EventBus  } from '../../vue-assets';
import Mixin from '../../mixin';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   props : ['vendors','equipment_types','operators','projects'],
   components: {
      VueMonthlyPicker
    },
   data()
   {  
       return {
         mobilization : {
          id : '',
          project : '',
          equipment_type : '',
          vendor : '',
          equipment : '',
          project_given_amount : 0,
          lobaid_cost : 0,
          profit : 0,
          date : '',
          month : '',
          note : '',          
          destination_from : '',
          destination_to : '',
            
         },

         pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
         validation_error : {},
         equipments : [],
         button_name : 'Update'
       }
   },

   mounted() {
       var _this = this;
       EventBus.$on('edit-mobilization',function(mobilization){
        _this.mobilization.id = mobilization.id;
        _this.mobilization.project = mobilization.project_id;
        _this.mobilization.equipment_type = mobilization.equipment_type_id;
        _this.mobilization.vendor = mobilization.vendor_id;
        _this.mobilization.equipment = mobilization.euquipment_id;
        _this.mobilization.project_given_amount = mobilization.project_given_amount;
        _this.mobilization.lobaid_cost = mobilization.lobaid_cost;
        _this.mobilization.profit = mobilization.profit;
        _this.mobilization.date = mobilization.date;
        _this.mobilization.month = mobilization.month;
        _this.mobilization.destination_from = mobilization.destination_from;
        _this.mobilization.destination_to = mobilization.destination_to;
        
        //  get equipments by vendor 
        _this.getVendorEquipments();

        $('#UpdateMobilizatoin').modal('show');
        var f1 = flatpickr(document.getElementById('basicFlatpickr4'));

        console.log(mobilization);
        
       })


   },

 methods : {
     save()
     {

         this.button_name = 'Updating...';
         axios.put(base_url+'mobilization/'+this.mobilization.id,this.mobilization)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#UpdateMobilizatoin').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('mobilization-created');
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

       axios.get(`${base_url}equipment-by-vendor/${this.mobilization.equipment_type}/${this.mobilization.vendor}`)
            .then(response => {
              this.equipments = response.data;
            });
     },

     resetForm()
     {
          this.equipment = {
          
          project : '',
          equipment_type : '',
          vendor : '',
          equipment : '',
          project_given_amount : 0,
          lobaid_cost : 0,
          profit : 0,
          date : '',
          month : '',
          note : '',
          destination_from : '',
          destination_to : '',
            
          };
         this.validation_error = {};
         this.equipments = [];
     }
 } 
   
}
</script>