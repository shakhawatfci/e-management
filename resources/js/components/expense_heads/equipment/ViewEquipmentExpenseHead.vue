<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Equipment Head" @keyup="getEquipmentExpenseHead()" />
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
            <tr v-for="(value,index) in equipments.data" :key="value.id">
                <td>{{ index+1 }}</td>
                <td>{{ value.head_name }}</td>
                <td class="text-center">
                    <span class="text-success" v-if="value.status == 1">Active</span>
                    <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" @click="editEquipmentHead(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" @click.prevent="deleteEquipmentHead(value.id)"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
            <!-- <tr v-if="equipments.data.length > 0">
                <td colspan="6">
                  <a :href="url+'equipment-category-list-print-pdf?action=pdf'" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+'equipment-category-list-print-pdf?action=print'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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

       <equipmenthead-update> </equipmenthead-update>
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
import EquipmentheadUpdate from './UpdateEquipmentExpenseHead';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   EquipmentheadUpdate
  },
  data() {
    return {
     equipments : [],
     keyword   : '',
     url : base_url,
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('EquipmentExpenseHead-created',function(){
          _this.getEquipmentExpenseHead();
      })

      this.getEquipmentExpenseHead();

  },

  methods: {
     
     getEquipmentExpenseHead(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`equipmenthead-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.equipments = response.data;
            this.isLoading = false;
            console.log(this.equipments)
         });
     },

     editEquipmentHead(value)
     {
        EventBus.$emit('equipmentExpenseHead-update',value)
     },

     deleteEquipmentHead(id)
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
           axios.delete(`${base_url}equipment-expense-head/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getEquipmentExpenseHead();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getEquipmentExpenseHead(page);
     }

    }
    }
</script>