<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search By Name , phone ,  salary" @keyup="getOperator()" />
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
          <select class="form-control" v-model="operator_type" @change="getOperator()">
            <option value="">All Types</option>
            <option value="0">Own Operator</option>
            <option value="1">Vendor Operator</option>
          </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
         <select class="form-control" id="equipment-type" @change="getOperator()" v-model="equipment_type_id">
              <option value="">All Equipment Type</option>
              <option v-for="equipment in equipment_types" 
              :key="equipment.id" :value="equipment.id">{{ equipment.name }}</option>
          </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
         <select class="form-control" id="equipment-type" @change="getVendorEquipments()" v-model="vendor_id">
              <option value="">All Vendor</option>
              <option v-for="vendor in vendors" 
              :key="vendor.id" :value="vendor.id">{{ vendor.vendor_name }}</option>
          </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <select class="form-control" id="equipment-type" @change="getOperator()" v-model="equipment_id">
              <option value="">All Equipment</option>
              <option v-for="eq in equipments" 
              :key="eq.id" :value="eq.id">{{ eq.eq_name  }} ({{ eq.eq_model }})</option>
          </select>
      </div>



    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Equipment Type</th>
                <th>Vendor/EQ</th>
                <th>Phone</th>
                <th>Bkash</th>
                <th>Status</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in operators.data" :key="value.id">
                <td>{{ value.name }} ({{ value.operator_type == 1 ?  'Vendor' : 'Own' }})</td>
                <td>{{ value.equipment_type.name }}</td>
                <td>{{ value.vendor.vendor_name }} / {{ value.equipement.eq_name }} ({{ value.equipement.eq_model }})</td>
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

       <update-operator :vendors="vendors" 
       :equipment_types="equipment_types"> </update-operator>
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
  props : ['vendors','equipment_types'],
  components : {
   'pagination' : Pagination,
   UpdateOperator,SingleViewoperator
  },
  data() {
    return {
     operators : [],
     url : base_url,
     keyword   : '',
     operator_type : '',
     equipment_type_id : '',
     equipment_id : '',
     vendor_id : '',
     isLoading : false,
     equipments : [],
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
         axios.get(base_url+`operator-list?page=${page}&keyword=${this.keyword}&operator_type=${this.operator_type}
         &equipment_type_id=${this.equipment_type_id}&vendor_id=${this.vendor_id}&equipment_id=${this.equipment_id}`)
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

    getVendorEquipments()
     {

       
       axios.get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
        this.getOperator();
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