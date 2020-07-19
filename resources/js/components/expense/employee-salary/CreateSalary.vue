<template>
        <!-- Modal -->
    <div class="modal fade" id="CreateEmployeeSalary" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Employee Salary</h4>
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
                                            <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="salary.month" dateFormt="YYYY-MM"></vue-monthly-picker>
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
                                            <input type="text" id="basicFlatpickr3" class="form-control"
                                             v-model="salary.date" placeholder="Date eg 2020-06-01">
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
                                             <span>Select Employee</span>
                                            <select class="form-control" @change="getSalary()" v-model="salary.employee_id">
                                                <option value="">Select Employee</option>
                                                <option v-for="value in employees" :key="value.id" :value="value.id">
                                                    {{ value.name }}
                                                </option>
                                            </select>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('employee_id')" 
                                                class="text-danger">
                                                {{ validation_error.employee_id[0] }}
                                               </span>
                                        </div>
                                    </div>



                                 <div class="col-md-6">
                                        <div class="contact-name">
                                            <i class="flaticon-user-11"></i>
                                             <span>Employee Net Salary</span>
                                            <input type="text" v-model="salary.salary_amount"
                                             id="c-name" class="form-control" placeholder="Salary Amount: ">
                                            <span v-if="validation_error.hasOwnProperty('salary_amount')" class="text-danger">
                                                {{ validation_error.salary_amount[0] }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Bonus Amount</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             v-model="salary.bonus" placeholder="Bonus Amount">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('bonus')" 
                                                class="text-danger">
                                                {{ validation_error.bonus[0] }}
                                               </span>

                                        </div>
                                    </div>


                                    <div class="col-md-6" v-if="salary.bonus > 0">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Bonus Reason</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             v-model="salary.bonus_reason" placeholder="Bonus Reason">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('bonus_reason')" 
                                                class="text-danger">
                                                {{ validation_error.bonus_reason[0] }}
                                               </span>

                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Deduction</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             v-model="salary.deduction" placeholder="Deduction">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('deduction')" 
                                                class="text-danger">
                                                {{ validation_error.deduction[0] }}
                                               </span>

                                        </div>
                                    </div>

                                    <div class="col-md-6" v-if="salary.deduction > 0">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Deduction Reaason</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             v-model="salary.deduction_reason" placeholder="Deduction Reason">
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('deduction_reason')" 
                                                class="text-danger">
                                                {{ validation_error.deduction_reason[0] }}
                                               </span>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="contact-phone">
                                            <i class="flaticon-telephone"></i>
                                            <span>Total Amount</span>
                                            <input type="text" id="c-phone" class="form-control"
                                             :value="salary.total_salary_amount = Number(salary.salary_amount)+Number(salary.bonus) - salary.deduction"
                                              placeholder="Deduction" readonly>
                                                 <span
                                                 v-if="validation_error.hasOwnProperty('total_salary_amount')" 
                                                class="text-danger">
                                                {{ validation_error.total_salary_amount[0] }}
                                               </span>

                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-location">
                                            <i class="flaticon-location-1"></i>
                                            <textarea class="form-control" placeholder="Note" v-model="salary.salary_note"></textarea>
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
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
   mixins : [Mixin],
   components: {
      VueMonthlyPicker
    },
   data()
   {  
       return {
         salary : {  
           employee_id : '',
           month: '',
           date: '',
           salary_amount: 0,
           bonus: 0,
           deduction: 0,
           bonus_reason: '',
           deduction_reason: '',
           total_salary_amount : 0,  
           salary_note: ''      
         },
         pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
         validation_error : {},
         button_name : 'Save',
         employees : [],
       }
   },

   mounted() {
 
  this.getEmployee();
  var f1 = flatpickr(document.getElementById('basicFlatpickr3'));
   
   },

 methods : {

     getEmployee()
     {
       axios.get(base_url+'all-employee')
            .then(response => {
             this.employees = response.data;
            });
     },
     save()
     {

         this.button_name = 'Saving...';
         axios.post(base_url+'employee-salary',this.salary)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#CreateEmployeeSalary').modal('hide');
              this.successMessage(response.data);
              EventBus.$emit('salary-created');
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

     getSalary(){  
      var emp = this.employees.find((employee) => employee.id == this.salary.employee_id);

      if(emp)
      {
        this.salary.salary_amount = emp.salary;
      }
      else
      {
          this.salary.salary_amount = 0;
      }

     },

     resetForm()
     {
         this.salary = {  
           employee_id : '',
           month: '',
           date: '',
           salary_amount: 0,
           bonus: 0,
           deduction: 0,
           bonus_reason: '',
           deduction_reason: '',
           total_salary_amount : 0,  
           salary_note: ''      
         };
         this.validation_error = {};
     }
 } 
   
}
</script>