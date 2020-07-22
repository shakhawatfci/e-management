<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getEquipmentExpense()">
          <option value>All Projects</option>
          <option
            v-for="project in projects"
            :key="project.id"
            :value="project.id"
          >{{ project.project_name }}</option>
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getEquipmentExpense()">
          <option value>All Equipment Type</option>
          <option
            v-for="equip_type in equipment_types"
            :key="equip_type.id"
            :value="equip_type.id"
          >{{ equip_type.name }}</option>
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getEquipmentExpense()">
          <option value>All Vendor</option>
          <option
            v-for="vendor in vendors"
            :key="vendor.id"
            :value="vendor.id"
          >{{ vendor.vendor_name }}</option>
        </select>
      </div>
      
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipement_id" @change="getEquipmentExpense()">
          <option value>All Equipment</option>
          <option
            v-for="equipment in equipements"
            :key="equipment.id"
            :value="equipment.id"
          >{{ equipment.eq_name }}</option>
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_expense_head_id" @change="getEquipmentExpense()">
          <option value>All Equipment Head</option>
          <option
            v-for="equipment_head in equipment_heads"
            :key="equipment_head.id"
            :value="equipment_head.id"
          >{{ equipment_head.head_name }}</option>
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Equipment Expense" @keyup="getEquipmentExpense()" />
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
                <th>Name</th>
                <th>Expense</th>
                <th>Equipment</th>
                <th>Payment Date</th>
                <th>Amount</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in equipments.data" :key="value.id">
                <td>{{ value.project.project_name }}</td>
                <td>{{ value.vendor.vendor_name }}</td>
                <td>{{ value.equipement.eq_name }}</td>
                <td>{{ value.payment_date | dateToString }}</td>
                <td>{{ value.amount }}</td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewEquipmentExpense(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editEquipmentExpense(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteEquipmentExpense(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr v-if="equipments.data.length > 0">
                <td colspan="6">
                  <a :href="url+'equipment-expense-print-pdf?action=pdf'" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+'equipment-expense-print-pdf?action=print'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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

       <update-equipmentexpense> </update-equipmentexpense>
       <show-equipmentexpense> </show-equipmentexpense>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.equipments"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import ShowEquipmentexpense from './SingleViewEquipmentexpense';
import UpdateEquipmentexpense from './UpdateEquipmentexpense';
export default {
  mixins: [Mixin],
  props: ['projects','equipment_types','vendors','equipements','equipment_heads'],
  components : {
   'pagination' : Pagination,
   UpdateEquipmentexpense,ShowEquipmentexpense
  },
  data() {
    return {
     equipments : [],
     project_id   : '',
     vendor_id   : '',
     equipment_type_id   : '',
     equipement_id   : '',
     equipment_expense_head_id   : '',
     keyword   : '',
     url : base_url,
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('EquipmentExpense-created',function(){
          _this.getEquipmentExpense();
      })

      this.getEquipmentExpense();

  },

  methods: {
     
     getEquipmentExpense(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`equipment-expense-list?page=${page}&keyword=${this.keyword}&project=${this.project_id}&vendor=${this.vendor_id}&equipment_type=${this.equipment_type_id}&equipement=${this.equipement_id}&equipment_head=${this.equipment_expense_head_id}`)
         .then(response =>
          {
            this.equipments = response.data;
            this.isLoading = false;
         });
     },

     editEquipmentExpense(value)
     {
        EventBus.$emit('equipmentexpense-update',value)
     },

     viewEquipmentExpense(value)
     {
        EventBus.$emit('equipmentexpense-view',value)
     },

     deleteEquipmentExpense(id)
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
           axios.delete(`${base_url}equipment-expense/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getEquipmentExpense();
           });
           }
        }) 
     },

     filterClear(){
       this.project_id   = '';
       this.vendor_id   = '';
       this.equipment_type_id   = '';
       this.equipement_id   = '';
       this.equipment_expense_head_id   = '';
       this.keyword   = '';
       this.getEquipmentExpense();
     },

     pageClicked(page)
     {
         this.getEquipmentExpense(page);
     }

    }
    }
</script>