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

        <div class="col-md-3">
            <select class="form-control" v-model="equipment_type_id" @change="eTypeChanged()">
                <option value="">Chose a Equipment Type</option>
                <option v-for="eq_type in equipment_types" :key="eq_type.id" :value="eq_type.id">
                    {{ eq_type.name }}
                </option>
            </select>
    </div>

    <div class="col-md-3">
            <select class="form-control" v-model="vendor_id" @change="getVendorEquipments()">
                <option value="">Chose a vendor</option>
                <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">
                    {{ vendor.vendor_name }}
                </option>
            </select>
    </div>


    <div class="col-md-3">
            <select class="form-control" v-model="equipment_id">
                <option value="">Chose a Equipment</option>
                <option v-for="eq in equipments" :key="eq.id" :value="eq.id">
                    {{ eq.eq_name }}
                </option>
            </select>
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
                <th>Vendor Bill</th>
                <th>Fooding Bill</th>
                <th>Bill Profit</th>
                <th>P Payment</th>
                <th>P Outstanding</th>
                <th>V Payment</th>
                <th>V Outstanding</th>
                <th>FD Payment</th>
                <th>FD Outstanding</th>
                <th>Op Salary</th>
                <th>Eq Expense</th>
                <th>TT Expense</th>
                <th>Net Profit</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in report_data" :key="value.id">
                <td>{{ value.month   }}</td>
                <td>{{ value.project_bill_amount }}</td>
                <td>{{ value.vendor_bill_amount }}</td>
                <td>{{ value.fooding_bill_amount }}</td>
                <td>{{ value.bill_profit  }}</td>
                <td>{{ value.project_payment }}</td>
                <td>{{ value.project_outstanding }}</td>
                <td>{{ value.vendor_payment }}</td>
                <td>{{ value.vendor_outstanding }}</td>
                <td>{{ value.fooding_paid_amount }}</td>
                <td>{{ value.fooding_outstanding }}</td>
                <td>{{ value.operator_salary }}</td>
                <td>{{ value.equipment_expense }}</td>
                <td>{{ value.total_expense }}</td>
                <td>{{ value.net_profit }}</td>
            </tr>
        </tbody>

        <tfoot style="border-top:2px solid #ccc">
            <tr>
                <th>Total = </th>
                <th>Project Bill</th>
                <th>Vendor Bill</th>
                <th>Fooding Bill</th>
                <th>Bill Profit</th>
                <th>P Payment</th>
                <th>P Outstanding</th>
                <th>V Payment</th>
                <th>V Outstanding</th>
                <th>FD Payment</th>
                <th>FD Outstanding</th>
                <th>Op Salary</th>
                <th>Eq Expense</th>
                <th>TT Expense</th>
                <th>Net Profit</th>
            </tr>
            <tr>
              <th>----</th>
              <th>{{ total_sum.total_project_bill_amount }}</th>
              <th>{{ total_sum.total_vendor_bill_amount }}</th>
              <th>{{ total_sum.total_fooding_bill_amount }}</th>
              <th>{{ total_sum.total_bill_profit }}</th>
              <th>{{ total_sum.total_project_payment }}</th>
              <th>{{ total_sum.total_project_outstanding }}</th>
              <th>{{ total_sum.total_vendor_payment }}</th>
              <th>{{ total_sum.total_vendor_outstanding }}</th>
              <th>{{ total_sum.total_fooding_paid_amount }}</th>
              <th>{{ total_sum.total_fooding_outstanding }}</th>
              <th>{{ total_sum.total_operator_salary }}</th>
              <th>{{ total_sum.total_equipment_expense }}</th>
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
       <equipment-chart :chart_data="report_data"></equipment-chart>
    </div>    
   </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import EquipmentChart from './chart/EquipmentChart';
import VueMonthlyPicker from 'vue-monthly-picker'
export default {
  mixins: [Mixin],
  props: ['vendors','equipment_types'],
  components : {
   'equipment-chart' : EquipmentChart,
    VueMonthlyPicker
  },
  data() {
    return {
     report_data : [],
     total_sum   : null,
     month_from  : '',
     month_to    : '',
     equipment_type_id : '',
     vendor_id : '',
     equipment_id : '',
     equipments   : [],
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
       
        if(this.month_from === '' || this.month_to === '' || this.equipment_type_id === '' || this.vendor_id === '' || this.equipment_id === '')
        {
          this.successMessage({status:'error',message: 'All Field are Required!'});
        }
        else{
         this.isFiltered  = true;
         this.isLoading = true;
         axios.get(base_url+`equpmently-report-result?month_from=${this.month_from._i}&month_to=${this.month_to._i}&equipment_type_id=${this.equipment_type_id}&vendor_id=${this.vendor_id}&equipment_id=${this.equipment_id}`)
         .then(response =>
          {
            this.report_data = response.data.report_data;
            this.total_sum = response.data.total_sum;
            this.isLoading = false;
         });
        }

     },

    eTypeChanged()
    {
      this.equipments = [];
      this.equipment_id = '';

    }, 

    getVendorEquipments()
     {

       axios.get(`${base_url}equipment-by-vendor/${this.equipment_type_id}/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
     },


    }
    }
</script>