<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Operator Salary" @keyup="getOperatorFooding()" />
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
          <select class="form-control" v-model="operator_id" @change="getOperatorFooding()">
            <option value="">All Types</option>
            <option value="0">Own Operator</option>
            <option value="1">Vendor Operator</option>
          </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <select class="form-control" id="equipment-type" @change="getOperatorFooding()" v-model="equipment_type_id">
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
         <select class="form-control" id="equipment-type" @change="getOperatorFooding()" v-model="equipement_id">
              <option value="">All Equipment</option>
              <option v-for="eq in equipments" 
              :key="eq.id" :value="eq.id">{{ eq.eq_name  }} ({{ eq.eq_model }})</option>
          </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" :placeHolder="pickermonth.text" v-model="filtermonth" @input="getOperatorFooding()"></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <button class="btn btn-danger outline-border" @click="filterClear()">Filter Clear</button>
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
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in foodings.data" :key="value.id">
                <td>{{ value.project.project_name }}</td>
                <td>{{ value.vendor.vendor_name }}</td>
                <td>{{ value.equipment_type.name }}</td>
                <td>{{ value.equipement.eq_name }}</td>
                <td>{{ value.operator.name }}</td>
                <td>{{ value.fooding_amount }}</td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewOperatorFooding(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editOperatorFooding(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteOperatorFooding(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr v-if="foodings.data.length > 0">
                <td colspan="7">
                  <a :href="url+'operator-fooding-print-pdf?action=pdf'" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+'operator-fooding-print-pdf?action=print'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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

       <update-fooding :projects="projects" :vendors="vendors" :equipment_types="equipment_types" :equipements="equipements" :operators="operators"> </update-fooding>
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
import VueMonthlyPicker from 'vue-monthly-picker'
import Pagination from '../../pagination/Pagination';
import ShowFooding from './SingleViewoperatorFooding';
import UpdateFooding from './UpdateOperatorFooding';
export default {
  mixins: [Mixin],
  props : ['projects','vendors','equipment_types','equipements','operators'],
  components : {
   'pagination' : Pagination,
    ShowFooding,
    UpdateFooding, VueMonthlyPicker
  },
  data() {
    return {
     foodings : [],
     project_id : '',
     vendor_id : '',
     equipment_type_id : '',
     equipement_id : '',
     operator_id : '',
     equipments : [],
     filtermonth : '',
     pickermonth : {
        lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
        text : "Search By Month",
        // bgcolor : "#142159",
        // format : "YYYY-MM"
     },
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
         var mo = '';
         if(this.filtermonth.hasOwnProperty('_i') && this.filtermonth != null)
         {
          mo = this.filtermonth._i;
         }
         axios.get(base_url+`operator-fooding-list?page=${page}&keyword=${this.keyword}&project=${this.project_id}&vendor=${this.vendor_id}&equipment_type=${this.equipment_type_id}&equipement=${this.equipement_id}&operator=${this.operator_id}&month_filter=${mo}`)
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

     getVendorEquipments()
     {
       axios.get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
        this.getOperator();
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

     filterClear(){
        this.project_id = '';
        this.vendor_id = '';
        this.equipment_type_id = '';
        this.equipement_id = '';
        this.operator_id = '';
        this.equipments = [];
        this.filtermonth = '';
        this.getOperatorFooding();
     },

     pageClicked(page)
     {
        this.getOperatorFooding(page);
     }

    }
    }
</script>