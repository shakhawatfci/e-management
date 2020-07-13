<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Operator Salary" @keyup="getOperatorSalary()" />
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
import Pagination from '../../pagination/Pagination';
import ShowSalary from './SingleViewoperatorsalary';
import UpdateSalary from './UpdateOperatorsalary';
export default {
  mixins: [Mixin],
  props : ['operators'],
  components : {
   'pagination' : Pagination,
    ShowSalary,
    UpdateSalary
  },
  data() {
    return {
     salaries : [],
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
         axios.get(base_url+`operator-salary-list?page=${page}&keyword=${this.keyword}`)
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