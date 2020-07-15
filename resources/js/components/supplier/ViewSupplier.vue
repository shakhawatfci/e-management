<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Vendor" @keyup="getSupplier()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Vendor</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Concerned Person</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in suppliers.data" :key="value.id">
                <td>{{ value.vendor_name }}</td>
                <td>{{ value.vendor_address }}</td>
                <td>{{ value.vendor_email }}</td>
                <td>{{ value.vendor_phone }}</td>
                <td>{{ value.concerned_person }}</td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="viewDetails(value)">
                      <i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="editSupplier(value)">
                      <i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" @click.prevent="deleteSupplier(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <supplier-update></supplier-update>
       <view-more></view-more>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.suppliers"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from '../pagination/Pagination';
import SupplierUpdate from './UpdateSupplier';
import ViewMore from './ViewDetails';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   'view-more' : ViewMore,
   SupplierUpdate
  },
  data() {
    return {
     suppliers : [],
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('supplier-created',function(){
          _this.getSupplier();
      })

      this.getSupplier();

  },

  methods: {
     
     getSupplier(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`supplier-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.suppliers = response.data;
            this.isLoading = false;
         });
     },

     viewDetails(value)
     {
        EventBus.$emit('view-details',value)
     },

     editSupplier(value)
     {
        EventBus.$emit('supplier-update',value)
     },


     deleteSupplier(id)
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
           axios.delete(`${base_url}supplier/${id}`)
           .then(response => {
            // console.log(response.data)
              this.successMessage(response.data);
              this.getSupplier();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getSupplier(page);
     }

    }
    }
</script>