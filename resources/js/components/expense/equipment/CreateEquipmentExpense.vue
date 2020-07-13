<template>
<!-- Modal -->
    <div id="createEquipmentExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-custom" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Create New</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project">Project</label>
                                      <select class="form-control" id="project" v-model="euqipment.project_id">
                                          <option value="">Chose Project</option>
                                          <option v-for="project in projects" :key="project.id" :value="project.id">
                                              {{ project.project_name }}
                                          </option>
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
                                      <label for="euqipment-type">Equipment Type</label>
                                      <select class="form-control" id="euqipment-type" v-model="euqipment.equipment_type_id">
                                          <option value="">Chose Equipment Type</option>
                                          <option v-for="type in equipment_types" :key="type.id" :value="type.id">
                                              {{ type.name }}
                                          </option>
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
                                      <label for="vendor">Vendor</label>
                                      <select class="form-control" id="vendor" v-model="euqipment.vendor_id" @change="getVendorWiseEquipment()">
                                          <option value="">Chose vendor</option>
                                          <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">
                                              {{ vendor.vendor_name }}
                                          </option>
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
                                  <label for="equipement-name">Equipment Name</label>
                                  <select class="form-control" id="equipement-name" v-model="euqipment.equipement_id">
                                      <option value="">Chose a Equipment</option>
                                      <option v-for="value in equipments" :key="value.id" :value="value.id">
                                          {{ value.eq_name }}
                                      </option>
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
                                  <label for="equipement-name">Expense Category</label>
                                  <select class="form-control" id="equipement-name" v-model="euqipment.expense_category_id">
                                      <option value="">Chose Expense Category</option>
                                      <option v-for="value in expense_categories" :key="value.id" :value="value.id">
                                          {{ value.head_name }}
                                      </option>
                                  </select>
                                       <span
                                       v-if="validation_error.hasOwnProperty('expense_category_id')" 
                                      class="text-danger">
                                      {{ validation_error.expense_category_id[0] }}
                                     </span>
                              </div>
                          </div>

                        <div class="col-md-4">
                            <div class="contact-name">
                                <i class="flaticon-user-11"></i>
                                <label for="month">Month</label>
                                <input v-model="euqipment.month" id="month" class="form-control" type="text" placeholder="YYYY-MM">
                                <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                    {{ validation_error.month[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-name">
                                <i class="flaticon-mail-11"></i>
                                 <label for="basicFlatpickr">Payment Date</label>
                                  <input id="basicFlatpickr" v-model="euqipment.payment_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Payment Date">
                                    <span
                                     v-if="validation_error.hasOwnProperty('payment_date')" 
                                    class="text-danger">
                                    {{ validation_error.payment_date[0] }}
                                   </span>
                            </div>
                        </div>

                         <div class="col-md-4">
                            <div class="contact-phone">
                                <i class="flaticon-telephone"></i>
                                <label for="amount">Amount</label>
                                <input type="text" id="amount" class="form-control" v-model="euqipment.amount" placeholder="amount">
                                <span
                                   v-if="validation_error.hasOwnProperty('amount')" 
                                  class="text-danger">
                                  {{ validation_error.amount[0] }}
                                 </span>
                            </div>
                          </div>

                      <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <label for="document_link">Document Link</label>
                            <input type="text" id="document_link" class="form-control" v-model="euqipment.document_link">
                            <span
                               v-if="validation_error.hasOwnProperty('document_link')" 
                              class="text-danger">
                              {{ validation_error.document_link[0] }}
                             </span>
                        </div>
                      </div>
                </div>
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-location">
                            <i class="flaticon-location-1"></i>
                            <label for="note">Note</label>
                            <textarea class="form-control" id="note" placeholder="Note" v-model="euqipment.note"></textarea>
                        </div>
                    </div>
                </div>
                       
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="save()">
                    	<div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'"></div>
                    {{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
              </div>
            </div>
          </div>
        </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
import { MonthPicker } from 'vue-month-picker'
export default {
   mixins : [Mixin],
   components: {
      MonthPicker
    },

   data()
   {
        
       return {
        euqipment : {
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          expense_category_id : '',
          month : '',
          payment_date : '',
          amount : '',
          document_link : '',
          note : ''
        },
        projects: [],
        vendors : [],
        equipment_types : [],
        equipments : [],
        expense_categories : [],
        button_name : 'Save',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
      // var f2 = flatpickr(document.getElementById('basicFlatpickr2'));
      this.getEquipmentData()
   },

   
 methods : {

    getVendorWiseEquipment()
    {
       axios.get(`${base_url}equipment-by-vendor/0/${this.euqipment.vendor_id}`)
        .then(response => {
          this.equipments = response.data;
        });
    },
  
     save()
     {
        this.button_name = "Saving...";
          axios.post(base_url+'equipment-expense',this.euqipment)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createEquipmentExpense').modal('hide');
                  EventBus.$emit('EquipmentExpense-created');
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

     getEquipmentData()
     {
        axios.get(base_url+'equipment-data')
        .then(response => {
          this.projects = response.data.project
          this.vendors = response.data.vendor
          this.expense_categories = response.data.expense_category
          this.equipment_types = response.data.eq_type
        })
     },



     resetForm()
     {
        this.euqipment = {
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          expense_category_id : '',
          month : '',
          payment_date : '',
          amount : '',
          document_link : '',
          note : ''
        };
        this.validation_error = {};
     }
 } 
   
}
</script>