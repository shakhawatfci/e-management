<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search By Salary" @keyup="getOperatorSalary()" />
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
          <select class="form-control" v-model="operator_id" @change="getOperatorSalary()">
            <option value="">All Operator</option>
            <option v-for="operator in operators" :key="operator.id" :value="operator.id">{{ operator.name }}</option>
          </select>
      </div>

      <div class="col-md-2" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="filtermonth" @input="getOperatorSalary()"></vue-monthly-picker>
      </div>

      <div class="col-md-2" style="margin-bottom:10px;">
          <select class="form-control" v-model="by_mode" @change="getOperatorSalary()">
            <option value="">All Mode</option>
            <option value="1">Cash</option>
            <option value="2">Bank</option>
            <option value="3">Mobile Bank</option>
          </select>
      </div>

      <div class="col-md-2" style="margin-bottom:10px;">
         <button class="btn btn-danger" @click="filterClear()">Filter Clear</button>
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Operator</th>
                <th>Month</th>
                <th>Payment Date</th>
                <th>Payment Amount</th>
                <th>Mode</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in salaries.data" :key="value.id">
                <td>{{ value.operator.name }}</td>
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.payment_date | dateToString }}</td>
                <td>{{ value.payment_amount }}</td>
                <td>
                  <span v-if="value.mode == 1">Cash</span>
                  <span v-else-if="value.mode == 2">Bank</span>
                  <span v-else>Mobile Bank</span></p>
                </td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewOperatorSalary(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editOperatorSalary(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteOperatorSalary(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    
      </div>
        <div class="col-md-12 text-center" style="margin-top:30px;" v-else>
          <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
          <div class="loader multi-loader mx-auto loader-xl"></div>
        </div>
  </div>

       <update-salary :operators="operators"> </update-salary>
       <show-salary> </show-salary>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.salaries"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from 'vue-monthly-picker'
import Pagination from '../../pagination/Pagination';
import ShowSalary from './SingleViewoperatorsalary';
import UpdateSalary from './UpdateOperatorsalary';
export default {
  mixins: [Mixin],
  props : ['operators'],
  components : {
   'pagination' : Pagination,
    ShowSalary,
    UpdateSalary, VueMonthlyPicker
  },
  data() {
    return {
     salaries : [],
     operator_id : '',
     filtermonth : '',
     pickermonth : {
        lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
        text : "Search By Month",
     },
     by_mode : '',
     url : base_url,
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('operator-salary-created',function(){
          _this.getOperatorSalary();
      })

      this.getOperatorSalary();

  },

  methods: {
     
     getOperatorSalary(page = 1) 
     {
         this.isLoading = true;
         var mo = '';
         if(this.filtermonth.hasOwnProperty('_i') && this.filtermonth != null)
         {
          mo = this.filtermonth._i;
         }
         axios.get(base_url+`operator-salary-list?page=${page}&keyword=${this.keyword}&operator=${this.operator_id}&month_filter=${mo}&mode=${this.by_mode}`)
         .then(response =>
          {
            this.salaries = response.data;
            this.isLoading = false;
         });
     },

     editOperatorSalary(value)
     {
        EventBus.$emit('operator-salary-update',value)
     },

     viewOperatorSalary(value)
     {
        EventBus.$emit('operator-salary-show',value)
     },

     filterClear(){
        this.operator_id = '';
        this.filtermonth = '';
        this.by_mode = '';
        this.getOperatorSalary();
     },

     deleteOperatorSalary(id)
     {
       Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        },() => {

        }).then((result) => {
           if(result.value){
           axios.delete(`${base_url}operator-salary/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getOperatorSalary();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getOperatorSalary(page);
     }

    }
    }
</script>