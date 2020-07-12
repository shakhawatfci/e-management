<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Operator Salary" @keyup="getOperatorFooding()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Project</th>
                <th>Vendor</th>
                <th>Equipment Type</th>
                <th>Equipment</th>
                <th>Operator</th>
                <th>Fooding Amount</th>
                <th>status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in foodings.data" :key="value.id">
                <td>{{ value.project_id }}</td>
                <td>{{ value.vendor_id }}</td>
                <td>{{ value.equipment_type_id }}</td>
                <td>{{ value.equipement_id }}</td>
                <td>{{ value.operator_id }}</td>
                <td>{{ value.fooding_amount }}</td>
                <td>
                  <span class="text-success" v-if="value.status == 1">Active</span>
                  <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewOperatorFooding(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editOperatorFooding(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteOperatorFooding(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <update-fooding :operators="operators"> </update-fooding>
       <show-fooding> </show-fooding>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.foodings"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import ShowFooding from './SingleViewoperatorFooding';
import UpdateFooding from './UpdateOperatorFooding';
export default {
  mixins: [Mixin],
  props : ['operators'],
  components : {
   'pagination' : Pagination,
    ShowFooding,
    UpdateFooding
  },
  data() {
    return {
     foodings : [],
     project_id : '',
     vendor_id : '',
     equipment_type_id : '',
     equipement_id : '',
     operator_id : '',
     url : base_url,
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('operator-fooding-created',function(){
          _this.getOperatorFooding();
      })

      this.getOperatorFooding();

  },

  methods: {
     
     getOperatorFooding(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`operator-fooding-list?page=${page}&keyword=${this.keyword}&project=${this.project_id}&vendor=${this.vendor_id}&equipment_type=${this.equipment_type_id}&equipement=${this.equipement_id}&operator=${this.operator_id}`)
         .then(response =>
          {
            this.foodings = response.data;
            this.isLoading = false;
         });
     },

     editOperatorFooding(value)
     {
        EventBus.$emit('operator-fooding-update',value)
     },

     viewOperatorFooding(value)
     {
        EventBus.$emit('operator-fooding-show',value)
     },

     deleteOperatorFooding(id)
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
           axios.delete(`${base_url}operator-fooding/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getOperatorFooding();
           });
           }
        }) 
     },

     pageClicked(page)
     {
        this.getOperatorFooding(page);
     }

    }
    }
</script>