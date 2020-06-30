<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <input type="text" v-model="keyword" 
        class="form-control"
         placeholder="Search Office Expense" @keyup="getOfficeExpense()" />
      </div>
    </div>
    
  <div class="row">
        <div class="col-md-12" v-if="!isLoading">
            <div class="table-responsive">
    <table class="table table-bordered table-hover  mb-4">
        <thead>
            <tr>
                <th>Office Head</th>
                <th>Month</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Document Link</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="value in offices.data" :key="value.id">
                <td>{{ value.office_expense_head.head_name }}</td>
                <td>{{ value.month }}</td>
                <td>{{ value.date }}</td>
                <td>{{ value.amount }}</td>
                <td>{{ value.document_link }}</td>
                <td class="text-center">
                    <button class="btn btn-dark mb-2 mr-2 rounded-circle" title="Edit" @click.prevent="editOfficeExpense(value)"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger mb-2 mr-2 rounded-circle" title="Delete" @click.prevent="deleteOfficeExpense(value.id)"><i class="far fa-trash-alt"></i></button>
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

       <update-officeexpense> </update-officeexpense>
    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
       <!-- import pagination here  -->
       <pagination :pageData="this.offices"> </pagination>

      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from '../../pagination/Pagination';
import UpdateOfficeexpense from './UpdateOfficeExpense';
export default {
  mixins: [Mixin],
  components : {
   'pagination' : Pagination,
   UpdateOfficeexpense
  },
  data() {
    return {
     offices : [],
     keyword   : '',
     isLoading : false,
    }
  },

  mounted() {

      var _this = this;

      EventBus.$on('OfficeExpense-created',function(){
          _this.getOfficeExpense();
      })

      this.getOfficeExpense();

  },

  methods: {
     
     getOfficeExpense(page = 1) 
     {
         this.isLoading = true;
         axios.get(base_url+`office-expense-list?page=${page}&keyword=${this.keyword}`)
         .then(response =>
          {
            this.offices = response.data;
            this.isLoading = false;
         });
     },

     editOfficeExpense(value)
     {
        EventBus.$emit('officeexpense-update',value)
     },

     deleteOfficeExpense(id)
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
           axios.delete(`${base_url}office-expense/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getOfficeExpense();
           });
           }
        }) 
     },

     pageClicked(page)
     {
         this.getOfficeExpense(page);
     }

    }
    }
</script>