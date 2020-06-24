<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Project Head" @keyup="getProjectExpenseHead()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>SL</th>
                <th>Head</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(value,key) in projects.data" :key="value.id">
                <td>{{ key + 1 }}</td>
                <td>{{ value.head_name }}</td>
                <td class="text-center">
                    <span class="text-success" v-if="value.status == 1">Active</span>
                    <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="editProjectHead(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" @click.prevent="deleteProjectHead(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <projecthead-update></projecthead-update>
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
import ProjectheadUpdate from './UpdateProjectExpenseHead';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   ProjectheadUpdate
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

      EventBus.$on('ProjectExpenseHead-created',function(){
          _this.getProjectExpenseHead();
      })

      this.getProjectExpenseHead();

  },

  methods: {
     
     getProjectExpenseHead(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`projecthead-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.projects = response.data;
            this.isLoading = false;
            console.log(this.projects)
         });
     },

     editProjectHead(value)
     {
        EventBus.$emit('projectExpenseHead-update',value)
     },

     deleteProjectHead(id)
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
           axios.delete(`${base_url}project-expense-head/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getProjectExpenseHead();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getProjectExpenseHead(page);
     }

    }
    }
</script>