<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Project Expense" @keyup="getProjectExpense()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Project Expense</th>
                <th>Amount</th>
                <th>Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in projects.data" :key="value.id">
                <td>{{ value.project.project_name }}</td>
                <td>{{ value.project_expense_head.head_name }}</td>
                <td>{{ value.amount }}</td>
                <td>{{ value.date }}</td>
                <td class="text-center">
                    <span class="text-success" v-if="value.status == 1">Active</span>
                    <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewProjectExpense(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editProjectExpense(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteProjectExpense(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <update-projectexpense> </update-projectexpense>
       <show-projectexpense> </show-projectexpense>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.projects"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import ShowProjectexpense from './SingleViewProjectexpense';
import UpdateProjectexpense from './UpdateProjectexpense';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   UpdateProjectexpense,ShowProjectexpense
  },
  data() {
    return {
     projects : [],
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
         axios.get(base_url+`project-expense-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.projects = response.data;
            this.isLoading = false;
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

     pageClicked(page)
     {
         this.getProjectExpense(page);
     }

    }
    }
</script>