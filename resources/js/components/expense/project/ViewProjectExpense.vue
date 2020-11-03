<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getProjectExpense()">
          <option value>All Projects</option>
          <option
            v-for="project in projects_data"
            :key="project.id"
            :value="project.id"
          >{{ project.project_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_head_id" @change="getProjectExpense()">
          <option value>All Project Head</option>
          <option
            v-for="project_expense in project_expense_head"
            :key="project_expense.id"
            :value="project_expense.id"
          >{{ project_expense.head_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" placeHolder="Start Month" v-model="start_month"></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" placeHolder="End Month" v-model="end_month" @input="getProjectExpense()"></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Project Expense" @keyup="getProjectExpense()" />
      </div>
      <div class="col-md-2" style="margin-bottom:15px;">
        <button type="button" class="btn btn-danger" @click="filterClear()">Clear</button>
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Date</th>
                <th>Month</th>
                <th>Project Name</th>
                <th>Project Expense</th>
                <th>Amount</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in projects.data" :key="value.id">
                <td>{{ value.date | dateToString }}</td>
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.project.project_name }}</td>
                <td>{{ value.project_expense_head.head_name }}</td>
                <td>{{ value.amount }}</td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewProjectExpense(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editProjectExpense(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteProjectExpense(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr v-if="projects.data.length > 0">
                <td colspan="6">
                  <a :href="url+`project-expense-print-pdf?action=pdf&keyword=${keyword}&project=${project_id}&project_head=${project_head_id}&start_month=${start_month._i}&end_month=${end_month._i}`" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+`project-expense-print-pdf?action=print&keyword=${keyword}&project=${project_id}&project_head=${project_head_id}&start_month=${start_month._i}&end_month=${end_month._i}`" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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

       <update-projectexpense :project_data="projects_data" :project_expense_head="project_expense_head"> </update-projectexpense>
       <show-projectexpense></show-projectexpense>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="projects"></pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from 'vue-monthly-picker'
import Pagination from '../../pagination/Pagination';
import ShowProjectexpense from './SingleViewProjectexpense';
import UpdateProjectexpense from './UpdateProjectexpense';
export default {
  mixins: [Mixin],
  props : ['project_expense_head','projects_data'],
  components : {
   'pagination' : Pagination,
   UpdateProjectexpense,ShowProjectexpense,VueMonthlyPicker
  },
  data() {
    return {
     projects : [],
     project_id : '',
     project_head_id : '',
     pickermonth : {
        lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
        text : "Search By Month",
      },
      start_month : '',
      end_month : '',
     url : base_url,
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('ProjectExpense-created',function(){
          _this.getProjectExpense();
      })

      this.getProjectExpense();

  },

  methods: {
     
     getProjectExpense(page = 1) 
     {
         this.isLoading = true;
         var st_mo = ''
          var lt_mo = ''
          if(this.end_month != ''){
            if(this.start_month === '') this.successMessage({status : 'error',message :'Select start Month'})
              st_mo = this.start_month._i
              lt_mo = this.end_month._i
          }
         axios.get(base_url+`project-expense-list?page=${page}&keyword=${this.keyword}&project=${this.project_id}&project_head=${this.project_head_id}&start_month=${st_mo}&end_month=${lt_mo}`)
         .then(response =>
          {
            this.projects = response.data;
            this.isLoading = false;
            // console.log(this.projects.data.length)
         });
     },

     editProjectExpense(value)
     {
        EventBus.$emit('projectexpense-update',value)
     },

     viewProjectExpense(value)
     {
        EventBus.$emit('projectexpense-view',value)
     },

     deleteProjectExpense(id)
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
           axios.delete(`${base_url}project-expense/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getProjectExpense();
           });
           }
        }) 
     },

     filterClear()
     {
        this.project_id = '';
        this.project_head_id = '';
        this.start_month = '';
        this.end_month = '';
        this.keyword  = '';
        this.getProjectExpense();
     },

     pageClicked(page)
     {
         this.getProjectExpense(page);
     }

    }
    }
</script>