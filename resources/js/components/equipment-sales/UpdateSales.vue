<template>
        <!-- Modal -->
    <div class="modal fade" id="UpdateSales" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Equipment Sales Info</h4>
                </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">

                                <div class="row">
                                 <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Month</span>
                                             <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="month" dateFormt="YYYY-MM" @input="setMonth"></vue-monthly-picker>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('month')" 
                                                class="text-danger">
                                                {{ validation_error.month[0] }}
                                               </span>

                                        </div>
                                    </div>
                                    
                                 <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Date</span>
                                            <input type="text" id="basicFlatpickr4" class="form-control"
                                             v-model="sales.date" placeholder="Date eg 2020-06-01">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('date')" 
                                                class="text-danger">
                                                {{ validation_error.date[0] }}
                                               </span>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="contact-email">
                                            <i class="flaticon-mail-26"></i>
                                             <span>Equipment Type</span>
                                            <select class="form-control" v-model="sales.equipment_type">
                                                <option value="">Chose a sales Type</option>
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
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                             <span>Customer Name</span>
                                            <input type="text" v-model="sales.customer_name"
                                             id="c-name" class="form-control" placeholder="sales Name: ">
                                            <span v-if="validation_error.hasOwnProperty('sales_name')" class="text-danger">
                                                {{ validation_error.sales_name[0] }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Profit Amount</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             v-model="sales.profit" placeholder="Enter Profit Amount">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('profit')" 
                                                class="text-danger">
                                                {{ validation_error.profit[0] }}
                                               </span>

                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <textarea class="form-control" placeholder="Note" v-model="sales.note"></textarea>
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
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   props : ['equipment_types'],
   components: {
      VueMonthlyPicker
    },
   data()
   {  
       return {
         sales : {
          id : '', 
          customer_name : '',
          date : '',
          month : '',
          profit : '',
          equipment_type : '',
          note : '',            
         },
         month : '',
         pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
         validation_error : {},
         button_name : 'Save'
       }
   },

   mounted() {
     var _this = this; 
     EventBus.$on('edit-sales',function(sales){
     _this.sales.id = sales.id;
     _this.sales.customer_name = sales.customer_name;
     _this.sales.date = sales.date;
     _this.month = sales.month;
     _this.sales.profit = sales.profit;
     _this.sales.note = sales.note;
     _this.sales.equipment_type = sales.equipment_type_id;

     $('#UpdateSales').modal('show');
        var f1 = flatpickr(document.getElementById('basicFlatpickr4'));
     });

   },

 methods : {
    setMonth(){
      this.sales.month = this.month._i
    },
    
     save()
     {

         this.button_name = 'Saving...';
         axios.put(base_url+'equipment-sales/'+this.sales.id,this.sales)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#UpdateSales').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('sales-created');
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
          this.sales = {
          id : '',
          customer_name : '',
          date : '',
          month : '',
          profit : '',
          equipment_type : '',
          note : ''
            
          };
         this.month = '';
         this.validation_error = {};
     }
 } 
   
}
</script>