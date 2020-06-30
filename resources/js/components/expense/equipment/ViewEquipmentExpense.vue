<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Equipment Expense" @keyup="getEquipmentExpense()" />
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
                <th>Expense Cate</th>
                <th>Payment Date</th>
                <th>Amount</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in equipments.data" :key="value.id">
                <td>{{ value.project_id }}</td>
                <td>{{ value.vendor_id }}</td>
                <td>{{ value.equipement_id }}</td>
                <td>{{ value.expense_category_id }}</td>
                <td>{{ value.payment_date }}</td>
                <td>{{ value.amount }}</td>
                <td class="text-center">
                    <button class="btn btn-warning mb-2 mr-2 rounded-circle" title="View" @click="viewEquipmentExpense(value)"><i class="far fa-eye"></i></button>
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editPEquipmentExpense(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteEquipmentExpense(value.id)"><i class="far fa-trash-alt"></i></button>
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
  components : {
   'pagination' : Pagination,
   UpdateEquipmentexpense,ShowEquipmentexpense
  },
  data() {
    return {
     equipments : [],
     keyword   : '',
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
         axios.get(base_url+`equipment-expense-list?page=${page}&keyword=${this.keyword}`)
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

     pageClicked(page)
     {
         this.getEquipmentExpense(page);
     }

    }
    }
</script>