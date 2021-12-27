<template>
<!-- Modal -->
    <div id="UpdateOfficeExpense" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="invoice">Invoice No</label>
                                      <input id="invoice" v-model="office.invoice_no" class="form-control" type="text" placeholder="Invoice No">
                                        <span
                                         v-if="validation_error.hasOwnProperty('invoice_no')" 
                                        class="text-danger">
                                        {{ validation_error.invoice_no[0] }}
                                       </span>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="up-basicFlatpickr">Date</label>
                                      <input id="up-basicFlatpickr" v-model="office.date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date">
                                        <span
                                         v-if="validation_error.hasOwnProperty('date')" 
                                        class="text-danger">
                                        {{ validation_error.date[0] }}
                                       </span>
                                </div>
                            </div>

                            </div>
                             <div class="col-md-12 mt-2">
                                <i class="flaticon-mail-26"></i>
                                <label for="equipement-name">Expense Category</label>

                                <div
                                    class="table-responsive"
                                    v-if="office.expense_category && office.expense_category.length > 0"
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
                                        v-for="(cat, index) in office.expense_category"
                                        :key="'category' + index"
                                        class="text-center"
                                        >
                                        <td>
                                            <select class="form-control" id="equipement-name" v-model="cat.category_id">
                                                <option value="">Chose Expense Head</option>
                                                <option v-for="value in office_expense_head" :key="value.id+'sub'" :value="value.id">
                                                    {{ value.head_name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input
                                            type="number"
                                            name=""
                                            placeholder="Amount"
                                            id=""
                                            class="form-control"
                                            v-model="cat.amount"
                                            />
                                        </td>
                                        <td class="">
                                            <a
                                            href=""
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
                                    href=""
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
                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-user-11"></i>
                                    <label>Month</label>
                                    <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormat="YYYY-MM" @input="setMonth"></vue-monthly-picker>
                                    <span v-if="validation_error.hasOwnProperty('month')" class="text-danger">
                                        {{ validation_error.month[0] }}
                                    </span>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="document-link">Document Link</label>
                                    <input type="text" id="document-link" class="form-control" v-model="office.document_link" placeholder="Document Link">
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
                                        <label for="note">Expense Note</label>
                                        <textarea class="form-control" id="note" placeholder="Note" v-model="office.note"></textarea>
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
        office : {
          id: null,
          invoice_no : '',
          month : '',
          date : '',
          expense_category : [],
          document_link : '',
          note : ''
        },
        pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
        month : '',
        office_expense_head : [],
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
    var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      var _this = this;
      EventBus.$on('officeexpense-update', function(value){
          _this.office.id = value.id;
          _this.month = value.month
         _this.getOfficeInvoice()
        $('#UpdateOfficeExpense').modal('show')
      })
   },

   computed: {
        getTotalExpense(){
            return this.office.expense_category.map(o => o.amount).reduce((a, c) => Number(a) + Number(c),0);
        }
    },

 methods : {
    setMonth(){
      this.office.month = this.month._i
    },
     update()
     {
        this.button_name = "Updating...";
          axios.put(base_url+'office-expense/'+this.office.id,this.office)
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOfficeExpense').modal('hide');
                  EventBus.$emit('OfficeExpense-created');
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
     addCategory() {
    //   if(this.checkDuplicate({category_id})) return ;
      this.office.expense_category.push({ category_id: "", amount: ""});
    },

    removeCategory(index) {
      this.office.expense_category.splice(index, 1);
    },

     getOfficeHead()
     {
        axios.get(base_url+'office-head-data')
        .then(response => {
          this.office_expense_head = response.data
        })
     },

     getOfficeInvoice()
     {
        axios.get(base_url+'office-expense/'+this.office.id+'/edit')
        .then(response => {
          // this.office = response.data
          this.office.invoice_no = response.data.invoice_no
          this.office.month = response.data.month
          this.office.date = response.data.date
          this.office.document_link = response.data.document_link
          this.office.note = response.data.note
          this.office.invoice_no = response.data.invoice_no
          this.getOfficeHead()
          var exp_cat = []
          response.data.office_expense.forEach(element => {
              exp_cat.push({'category_id':element.office_expense_head_id,'amount':element.amount})
          });
          this.office.expense_category.push(...exp_cat)
          
        })
     },

     resetForm()
     {
        this.office = {
          invoice_no : '',
          month : '',
          date : '',
          expense_category : [],
          document_link : '',
          note : ''
        },
        this.month = '';
        this.office_expense_head = [];
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