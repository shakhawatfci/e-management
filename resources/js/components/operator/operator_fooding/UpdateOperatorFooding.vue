<template>
<!-- Modal -->
    <div id="UpdateOperatorFooding" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
              </div>
                <div class="modal-body"><i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content text-left">
                       <div class="row">

                            <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label>Month</label>
                                            <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormat="YYYY-MM" @input="setMonth"></vue-monthly-picker>
                                           <span
                                           v-if="validation_error.hasOwnProperty('month')" 
                                          class="text-danger">
                                          {{ validation_error.month[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="upfoodingDatePicker">Date</label>
                                           <input type="text" class="form-control"
                                           v-model="fooding.date"
                                           id="upfoodingDatePicker"
                                            placeholder="Date">
                                           <span
                                           v-if="validation_error.hasOwnProperty('date')" 
                                          class="text-danger">
                                          {{ validation_error.date[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project-name">Project Name</label>
                                        <select class="form-control" id="project-name" v-model="fooding.project_id">
                                            <option value="">Select Operator</option>
                                            <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.project_name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('project_id')" 
                                          class="text-danger">
                                          {{ validation_error.project_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="equipment-type">Equipment Type</label>
                                        <select class="form-control" id="equipment-type" v-model="fooding.equipment_type_id">
                                            <option value="">Select Equipment Type</option>
                                            <option v-for="equipment in equipment_types" :key="equipment.id" :value="equipment.id">{{ equipment.name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('equipment_type_id')" 
                                          class="text-danger">
                                          {{ validation_error.equipment_type_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="vendor-name">Vendor Name</label>
                                        <select class="form-control" id="vendor-name" v-model="fooding.vendor_id" @change="getVendorEquipments()">
                                            <option value="">Select Vendor</option>
                                            <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.vendor_name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('vendor_id')" 
                                          class="text-danger">
                                          {{ validation_error.vendor_id[0] }}
                                         </span>
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="equipment-name">Equipment Name</label>
                                        <select class="form-control" id="equipment-name" v-model="fooding.equipement_id">
                                            <option value="">Select Equipment</option>
                                            <option v-for="equipement in equipments" :key="equipement.id" :value="equipement.id">{{ equipement.eq_name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('equipement_id')" 
                                          class="text-danger">
                                          {{ validation_error.equipement_id[0] }}
                                         </span>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-name">Operator Name</label>
                                        <select class="form-control" id="operator-name" v-model="fooding.operator_id">
                                            <option value="">Select Operator</option>
                                            <option v-for="operator in operators" :key="operator.id" :value="operator.id">{{ operator.name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('operator_id')" 
                                          class="text-danger">
                                          {{ validation_error.operator_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="fooding-amount">Fooding Amount</label>
                                      <input type="text"  id="fooding-amount" class="form-control" v-model="fooding.fooding_amount" placeholder="Fooding Amount">
                                           <span
                                           v-if="validation_error.hasOwnProperty('fooding_amount')" 
                                          class="text-danger">
                                          {{ validation_error.fooding_amount[0] }}
                                         </span>
                                  </div>
                              </div>

                            <div class="col-md-4">
                                <div class="contact-email">
                                    <i class="flaticon-mail-26"></i>
                                    <label for="fooding-status">Fooding Status</label>
                                    <select class="form-control" id="fooding-status" v-model="fooding.status">
                                        <option value="">Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="update()">
                      <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>
                    {{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
              </div>
            </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   components: {
      VueMonthlyPicker
    },
   props : ['projects','vendors','equipment_types','operators'],
   data()
   {
        
       return {
        fooding : {
          id : '',
          date : '',
          month : '',
          project : '',
          vendor : '',
          equipment_type : '',
          equipement : '',
          operator : '',
          fooding_amount : '',
          status : ''
        },
        month : '',
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        button_name : 'Update',
        validation_error : {},
        equipments : []
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('operator-fooding-update',function(value){
        $("#UpdateOperatorFooding").modal('show')
        _this.fooding = value;
        _this.month = value.month;
        _this.getVendorEquipments();
      });
       var f1 = flatpickr(document.getElementById('upfoodingDatePicker'));
   },
   
 methods : {
    setMonth(){
      this.fooding.month = this.month._i
    },
     update()
     {
        this.button_name = "Updating...";

        axios.put(base_url+'operator-fooding/'+this.fooding.id,this.fooding)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOperatorFooding').modal('hide');
                  EventBus.$emit('operator-fooding-created');
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

      getVendorEquipments()
     {
       axios.get(`${base_url}equipment-by-vendor/0/${this.fooding.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
     },

     resetForm()
     {
        this.fooding = {
          date : '',
          month : '',
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          operator_id : '',
          fooding_amount : '',
          status : ''
        };
        this.month = '';
        this.button_name = "Update";
        this.validation_error = {};
        this.equipments = [];
     }
 } 
   
}
</script>