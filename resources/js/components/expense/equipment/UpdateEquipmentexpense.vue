<template>
<!-- Modal -->
    <div id="updateEquipmentExpense" class="modal animated fadeInLeft custo-fadeInLeft show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-custom" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update Equipment Expense</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-project">Project</label>
                                      <select class="form-control" id="up-project" v-model="euqipment.project_id">
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
                                      <label for="up-euqipment-type">Equipment Type</label>
                                      <select class="form-control" id="up-euqipment-type" v-model="euqipment.equipment_type_id">
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
                                      <label for="up-vendor">Vendor</label>
                                      <select class="form-control" id="up-vendor" v-model="euqipment.vendor_id" @change="getVendorWiseEquipment()">
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
                                  <label for="up-equipement-name">Equipment Name</label>
                                  <select class="form-control" id="up-equipement-name" v-model="euqipment.equipement_id">
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
                                  <label for="up-equipement-name">Expense Category</label>
                                  <select class="form-control" id="up-equipement-name" v-model="euqipment.equipment_expense_head_id">
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
                                <label>Month</label>
                                <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormat="YYYY-MM" @input="setMonth"></vue-monthly-picker>
                                <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                    {{ validation_error.month[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-name">
                                <i class="flaticon-mail-11"></i>
                                 <label for="up-basicFlatpickr">Payment Date</label>
                                  <input id="up-basicFlatpickr" v-model="euqipment.payment_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Payment Date">
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
                                <label for="up-amount">Amount</label>
                                <input type="text" id="up-amount" class="form-control" v-model="euqipment.amount" placeholder="amount">
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
                            <label for="up-documents-link">Document Link</label>
                            <input type="text" id="up-documents-link" class="form-control" v-model="euqipment.documents_link">
                            <span
                               v-if="validation_error.hasOwnProperty('documents_link')" 
                              class="text-danger">
                              {{ validation_error.documents_link[0] }}
                             </span>
                        </div>
                      </div>
                </div>
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-location">
                            <i class="flaticon-location-1"></i>
                            <label for="up-note">Note</label>
                            <textarea class="form-control" id="up-note" placeholder="Note" v-model="euqipment.note"></textarea>
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
          </div>
        </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   components: {
      VueMonthlyPicker
    },

   data()
   {
        
       return {
        euqipment : {
          id : '',
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          equipment_expense_head_id : '',
          month : '',
          payment_date : '',
          amount : '',
          documents_link : '',
          note : ''
        },
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        month : '',
        projects: [],
        vendors : [],
        equipment_types : [],
        equipments : [],
        expense_categories : [],
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      this.getEquipmentData()
      var _this = this;
      EventBus.$on('equipmentexpense-update', function(value){
          _this.euqipment = value;
          _this.month = value.month;
        //   console.log(value)
        $('#updateEquipmentExpense').modal('show')
      })
   },

   
 methods : {
    setMonth(){
      this.euqipment.month = this.month._i
    },
    getVendorWiseEquipment()
    {
       axios.get(`${base_url}equipment-by-vendor/0/${this.euqipment.vendor_id}`)
        .then(response => {
          this.equipments = response.data;
        });
    },
  
     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'equipment-expense/'+this.euqipment.id,this.euqipment)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#updateEquipmentExpense').modal('hide');
                  EventBus.$emit('EquipmentExpenseInvoice-created');
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

     getEquipmentData()
     {
        axios.get(base_url+'equipment-data')
        .then(response => {
          this.projects = response.data.project
          this.vendors = response.data.vendor
          this.equipments = response.data.equipment
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
          documents_link : '',
          note : ''
        };
        this.month = '';
        this.projects = [];
        this.vendors  = [];
        this.equipment_types  = [];
        this.equipments  = [];
        this.expense_categories  = [];
        this.validation_error = {};
     }
 } 
   
}
</script>