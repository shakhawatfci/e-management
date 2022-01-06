<template>
<!-- Modal -->
    <div id="UpdateEquipmentExpenseInvoice" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-custom" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update Invoice : {{ invoice.invoice_no }}</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project">Invoice No:</label>
                                      <input type="text" class="form-control" id="invoice" v-model="invoice.invoice_no" placeholder="Invoice Number" />
                                           <span
                                           v-if="validation_error.hasOwnProperty('invoice_no')" 
                                          class="text-danger">
                                          {{ validation_error.project_id[0] }}
                                         </span>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="project">Project</label>
                                      <select class="form-control" id="project" v-model="invoice.project_id">
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
                                      <select class="form-control" id="euqipment-type" v-model="invoice.equipment_type_id">
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
                                      <select class="form-control" id="vendor" v-model="invoice.vendor_id" @change="getVendorWiseEquipment()">
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
                                  <select class="form-control" id="equipement-name" v-model="invoice.equipement_id">
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
                                  <label for="equipement-name">Operator</label>
                                  <select class="form-control" id="equipement-name" v-model="invoice.operator_id">
                                      <option value="">Chose a Operator</option>
                                      <option v-for="value in operators" :key="value.id" :value="value.id">
                                          {{ value.name }}
                                      </option>
                                  </select>
                                       <span
                                       v-if="validation_error.hasOwnProperty('operator_id')" 
                                      class="text-danger">
                                      {{ validation_error.operator_id[0] }}
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
                                 <label for="basicFlatpickr">Payment Date</label>
                                  <input id="basicFlatpickr" v-model="invoice.payment_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Payment Date">
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
                                <label for="payment_method">Payment Method</label>
                                <!-- <input type="text" id="payment_method" class="form-control" v-model="euqipment.payment_mathod" placeholder="Payment Method"> -->
                                <select id="payment_method" v-model="invoice.payment_method" class="form-control">
                                    <option value="">Chose Payment Method</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bkash">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span
                                   v-if="validation_error.hasOwnProperty('payment_method')" 
                                  class="text-danger">
                                  {{ validation_error.payment_method[0] }}
                                 </span>
                            </div>
                          </div>

                      <div class="col-md-12">
                        <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <label for="documents-link">Document Link</label>
                            <input type="text" placeholder="Documents Link" id="documents-link" class="form-control" v-model="invoice.documents_link">
                            <span
                               v-if="validation_error.hasOwnProperty('documents_link')" 
                              class="text-danger">
                              {{ validation_error.documents_link[0] }}
                             </span>
                        </div>
                      </div>
                </div>


                <div class="col-md-12">
                    <i class="flaticon-mail-26"></i>
                    <label for="equipement-name">Expense Category</label>

                    <div
                        class="table-responsive"
                        v-if="expense_categories && expense_categories.length > 0"
                    >
                        <table class="table">
                        <thead>
                            <tr class="text-center">
                            <th>Category</th>
                            <th>Amount</th>
                            <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                            v-for="(cat, index) in invoice.expense_category"
                            :key="'category' + index"
                            class="text-center"
                            >
                            <td>
                                <select class="form-control" id="equipement-name" v-model="cat.category_id">
                                    <option value="">Chose Expense Head</option>
                                    <option v-for="value in expense_categories" :key="value.id+'sub'" :value="value.id">
                                        {{ value.head_name }}
                                    </option>
                                </select>
                            </td>
                            <td>
                                <input
                                type="number"
                                name=""
                                placeholder="Amount"
                                :id="1+Math.random()"
                                class="form-control"
                                v-model="cat.amount"
                                />
                            </td>
                            <td class="">
                                <a
                                href="javascript:void(0)"
                                @click.prevent="removeCategory(index)"
                                class="btn btn-danger btn-sm mt-2"
                                ><i class="fa fa-trash"></i></a
                                >
                            </td>
                            </tr>
                            <tr class="text-center">
                                <!-- <td>Total</td> -->
                                <td colspan="3"><b>Total: {{ getTotalExpense }}</b></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <a
                        href="javascript:void(0)"
                        @click.prevent="addCategory()"
                        class="btn btn-success"
                    >
                        <i class="fa fa-plus"></i></a
                    >
                        <span
                        v-if="validation_error.hasOwnProperty('expense_category')" 
                        class="text-danger">
                        {{ validation_error.expense_category[0] }}
                        </span>
                
            </div>
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-location">
                            <i class="flaticon-location-1"></i>
                            <label for="note">Note</label>
                            <textarea class="form-control" id="note" placeholder="Note" v-model="invoice.note"></textarea>
                        </div>
                    </div>
                </div>
                       
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="Update()">
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
        invoice : {
            id: null,
          invoice_no : '',
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          operator_id : '',
          expense_category : [],
          month : '',
          payment_date : '',
          amount : '',
          payment_method : '',
          documents_link : '',
          note : ''
        },
        month : '',
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        projects: [],
        vendors : [],
        equipment_types : [],
        equipments : [],
        operators : [],
        expense_categories : [],
        isCategoryLoading: false,
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
      // var f2 = flatpickr(document.getElementById('basicFlatpickr2'));
      this.getEquipmentData()
      var _this = this;
      EventBus.$on('equipmentexpense-invoice-update', function(value){
          _this.resetForm()
          _this.invoice.id = value.id;
          _this.month = value.month;
          _this.getInvoiceData()
        $('#UpdateEquipmentExpenseInvoice').modal('show')
      })
   },

    computed: {
        getTotalExpense(){
            return this.invoice.expense_category.map(o => o.amount).reduce((a, c) => Number(a) + Number(c),0);
        }
    },
   
 methods : {
    setMonth(){
      this.invoice.month = this.month._i
    },
    getVendorWiseEquipment()
    {
       axios.get(`${base_url}equipment-by-vendor/0/${this.invoice.vendor_id}`)
        .then(response => {
          this.equipments = response.data;
        });
    },

    getInvoiceData(){
        axios.get(`${base_url}get-single-invoice/${this.invoice.id}`)
        .then(response => {
          this.invoice.id = response.data.id
          this.invoice.invoice_no = response.data.invoice_no
          this.invoice.project_id = response.data.project_id
          this.invoice.project = response.data.project
          this.invoice.operator_id = response.data.operator_id
          this.invoice.vendor_id = response.data.vendor_id
          this.invoice.vendor = response.data.vendor
          this.invoice.equipment_type_id = response.data.equipment_type_id
          this.invoice.equipment_type = response.data.equipment_type
          this.invoice.equipement_id = response.data.equipement_id
          this.invoice.month = response.data.month
          this.invoice.payment_date = response.data.payment_date
          this.invoice.amount = response.data.amount
          this.invoice.payment_method = response.data.payment_method
          this.invoice.documents_link = response.data.documents_link
          this.invoice.note = response.data.note

            this.getVendorWiseEquipment()

          var exp_cat = []
          response.data.equipment_expense.forEach(element => {
              exp_cat.push({'category_id':element.equipment_expense_head_id,'amount':element.amount})
          });
          this.invoice.expense_category.push(...exp_cat)
        });
    },

    addCategory() {
    //   if(this.checkDuplicate({category_id})) return ;
      this.invoice.expense_category.push({ category_id: "", amount: ""});
    },

    removeCategory(index) {
      this.invoice.expense_category.splice(index, 1);
    },

     Update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'equipment-expense/'+this.invoice.id,this.invoice)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateEquipmentExpenseInvoice').modal('hide');
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
          this.operators = response.data.operators
        })
     },



     resetForm()
     {
        this.invoice = {
          invoice_no : '',
          project_id : '',
          vendor_id : '',
          equipment_type_id : '',
          equipement_id : '',
          expense_category_id: '',
          expense_category : [],
          month : '',
          payment_date : '',
          amount : '',
          documents_link : '',
          note : ''
        };
        this.month = '';
        this.validation_error = {};
     }
 } 
   
}
</script>
<style scoped>
    .table {
        background-color: transparent !important;
    }
</style>