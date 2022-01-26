<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search By Name,Phone" @keyup="getProjectConcern()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Project Name</th>
                <th>Requirement</th>
                <th>Rating</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in project_concern.data" :key="value.id">
                <td>{{ value.name }}</td>
                <td>{{ value.phone }}</td>
                <td>{{ value.company_name }}</td>
                <td>{{ value.project_name }}</td>
                <td>{{ value.reqired_equipment }}</td>
                <td>{{ value.rating.replace('_',' ') }}</td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="viewDetails(value)">
                      <i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="editProjectConcern(value)">
                      <i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" @click.prevent="deleteConcern(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            <!-- <tr v-if="project_concern.data.length > 0">
                <td colspan="7">
                  <a :href="url+'project-concern-list-print-pdf?action=pdf'" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+'project-concern-list-print-pdf?action=print'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
                </td>
            </tr> -->
        </tbody>
    </table>
</div>
    
      </div>
        <div class="col-md-12 text-center" style="margin-top:30px;" v-else>
          <!-- <img :src="url+'images/logo/loading.gif'" class="img-fluid"> -->
          <div class="loader multi-loader mx-auto loader-xl"></div>
        </div>
  </div>

       <concern-update></concern-update>
       <concern-details></concern-details>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="project_concern"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import ConcernUpdate from './UpdateProjectConcern';
import ConcernDetails from './ViewProjectConcernDetails';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   'concern-details' : ConcernDetails,
   ConcernUpdate
  },
  data() {
    return {
     project_concern : [],
     keyword   : '',
     url : base_url,
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('project-concern-created',function(){
          _this.getProjectConcern();
      })

      this.getProjectConcern();

  },

  methods: {
     
     getProjectConcern(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`project-concern-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.project_concern = response.data;
            this.isLoading = false;
         });
     },

     viewDetails(value)
     {
        EventBus.$emit('view-details',value)
     },

     editProjectConcern(value)
     {
        EventBus.$emit('project-concern-update',value)
     },


     deleteConcern(id)
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
           axios.delete(`${base_url}project-concern/${id}`)
           .then(response => {
            // console.log(response.data)
              this.successMessage(response.data);
              this.getProjectConcern();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getProjectConcern(page);
     }

    }
    }
</script>