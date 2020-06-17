<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Supplier" @keyup="getSupplier()" />
      </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Vendor</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in suppliers" :key="value.id">
                <td>{{ value.vendor_name }}</td>
                <td>{{ value.vendor_address }}</td>
                <td>{{ value.vendor_email }}</td>
                <td>{{ value.vendor_phone }}</td>
                <td class="text-center">
                    <span class="text-success">Active</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="editSupplier(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    
        </div>
    </div>

       <supplier-update> </supplier-update>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <!-- <pagination :pageData="this.suppliers"> </pagination> -->

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from '../pagination/Pagination';
import SupplierUpdate from './UpdateSupplier';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
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

     editSupplier(value)
     {
        EventBus.$emit('supplier-update',value)
     },

     pageClicked(page)
     {
         this.getSupplier(page);
     }

    }
    }
</script>