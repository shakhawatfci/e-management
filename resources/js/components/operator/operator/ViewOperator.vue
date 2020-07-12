<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Operator Expense" @keyup="getOperator()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Bkash</th>
                <th>Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in operators.data" :key="value.id">
                <td>{{ value.name }}</td>
                <td>{{ value.address }}</td>
                <td>{{ value.mobile }}</td>
                <td>{{ value.bkash_number }}</td>
                <td>
                  <span class="text-success" v-if="value.status == 1">Active</span>
                  <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewOperator(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editOperator(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteOperator(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <update-operator :vendors="vendors" :equipment_types="equipment_types" :equipements="equipements"> </update-operator>
       <single-viewoperator> </single-viewoperator>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.operators"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import SingleViewoperator from './SingleViewoperator';
import UpdateOperator from './UpdateOperator';
export default {
  mixins: [Mixin],
  props : ['vendors','equipment_types','equipements'],
  components : {
   'pagination' : Pagination,
   UpdateOperator,SingleViewoperator
  },
  data() {
    return {
     operators : [],
     url : base_url,
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('operator-created',function(){
          _this.getOperator();
      })

      this.getOperator();

  },

  methods: {
     
     getOperator(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`operator-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.operators = response.data;
            this.isLoading = false;
         });
     },

     editOperator(value)
     {
        EventBus.$emit('operator-update',value)
     },

     viewOperator(value)
     {
        EventBus.$emit('operator-show',value)
     },

     deleteOperator(id)
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
           axios.delete(`${base_url}operator/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getOperator();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getOperator(page);
     }

    }
    }
</script>