<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="'Month From'" v-model="month_from"
          dateFormat="YYYY-MM"></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="'Month To'" v-model="month_to"
          dateFormat="YYYY-MM"></vue-monthly-picker>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
         <button @click="getReport()" class="btn btn-primary">
           <div class="spinner-grow text-white mr-2 align-self-center loader-sm" 
                        v-if="isLoading">.</div>
                        Get Report</button>
      </div>


    </div>
    
  <div class="row" v-if="isFiltered">
        <div class="col-md-12" v-if="!isLoading">
    <div class="table-responsive" v-if="report_data.length > 0">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Month</th>
                <th>Project Bill</th>
                <th>Vendor  Bill</th>
                <th>Bill Profit</th>
                <th>E Sales Profit</th>
                <th>Mob Profit</th>
                <th>TT Profit</th>
                <th>Emp salary</th>
                <th>Op Salary</th>
                <th>FD Bill</th>
                <th>FD Paid</th>
                <th>Eq Expense</th>
                <th>Pr Expense</th>
                <th>Off Expense</th>
                <th>TT Expense</th>
                <th>Net Profit</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in report_data" :key="value.id">
                <td>{{ value.month }}</td>
                <td>{{ value.project_bill_amount }}</td>
                <td>{{ value.vendor_bill_amount }}</td>
                <td>{{ value.bill_profit  }}</td>
                <td>{{ value.equipment_sales_profit }}</td>
                <td>{{ value.mobilization_profit }}</td>
                <td>{{ value.total_profit }}</td>
                <td>{{ value.employee_salary }}</td>
                <td>{{ value.operator_salary }}</td>
                <td>{{ value.fooding_bill_amount }}</td>
                <td>{{ value.fooding_paid_amount }}</td>
                <td>{{ value.equipment_expense }}</td>
                <td>{{ value.project_expense }}</td>
                <td>{{ value.office_expense }}</td>
                <td>{{ value.total_expense }}</td>
                <td>{{ value.net_profit }}</td>
            </tr>
        </tbody>

        <tfoot style="border-top:2px solid #ccc">
            <tr>
                <th>Total =</th>
                <th>Project Bill</th>
                <th>Vendor  Bill</th>
                <th>Bill Profit</th>
                <th>E Sales Profit</th>
                <th>Mob Profit</th>
                <th>TT Profit</th>
                <th>Emp salary</th>
                <th>Op Salary</th>
                <th>TT FD Bill</th>
                <th>TT FD Paid</th>
                <th>Eq Expense</th>
                <th>Pr Expense</th>
                <th>Off Expense</th>
                <th>TT Expense</th>
                <th>Net Profit</th>
            </tr>
            <tr>
              <th>$</th>
              <th>{{ total_sum.total_project_bill_amount }}</th>
              <th>{{ total_sum.total_vendor_bill_amount }}</th>
              <th>{{ total_sum.total_bill_profit }}</th>
              <th>{{ total_sum.total_equipment_sales_profit }}</th>
              <th>{{ total_sum.total_mobilization_profit }}</th>
              <th>{{ total_sum.total_profit }}</th>
              <th>{{ total_sum.total_employee_salary }}</th>
              <th>{{ total_sum.total_operator_salary }}</th>
              <th>{{ total_sum.total_fooding_bill_amount }}</th>
              <th>{{ total_sum.total_fooding_paid_amount }}</th>
              <th>{{ total_sum.total_equipment_expense }}</th>
              <th>{{ total_sum.total_project_expense }}</th>
              <th>{{ total_sum.total_office_expense }}</th>
              <th>{{ total_sum.total_expense }}</th>
              <th>{{ total_sum.total_net_profit }}</th>
            </tr>
        </tfoot>
    </table>
  </div>

    <div class="text-center" v-else>
       <h3>Opps ! No Result Found in this month range</h3>
    </div>

</div>
        <div class="col-md-12 text-center" style="margin-top:30px;" v-else>
          <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
          <div class="loader multi-loader mx-auto loader-xl"> <h1>Proccessing...</h1></div>

        </div>

    <div class="col-md-12 text-center" v-if="!isLoading">
        <h4>Chart View</h4>
       <monthly-chart :chart_data="report_data"></monthly-chart>
    </div>    
   </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import MonthlyChart from './chart/MonthlyChart';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
  mixins: [Mixin],
  components : {
   'monthly-chart' : MonthlyChart,
    VueMonthlyPicker
  },
  data() {
    return {
     report_data : [],
     total_sum   : null,
     month_from  : '',
     month_to    : '',
     chart_month : [],
     isLoading : false,
     isFiltered : false,
      pickermonth : {
          lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
          text : "Month"
        },
    }
  },

  mounted() {


  },

  methods: {
     
     getReport() 
     {  
       
        if(this.month_from === '' || this.month_to === '')
        {
          this.successMessage({status:'error',message: 'Please Select Both Month'});
        }
        else{
         this.isFiltered  = true;
         this.isLoading = true;
         axios.get(base_url+`monthly-report-result?month_from=${this.month_from._i}&month_to=${this.month_to._i}`)
         .then(response =>
          {
            this.report_data = response.data.report_data;
            this.total_sum = response.data.total_sum;
            this.isLoading = false;
         });
        }

     },


    }
    }
</script>