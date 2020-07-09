<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getSales()">
          <option value>Filter By Equipment Type</option>
          <option v-for="eq_type in equipment_types" :key="eq_type.id"
           :value="eq_type.id">{{ eq_type.name }}</option>
        </select>
      </div>



      <div class="col-md-3" style="margin-bottom:10px;">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search with customer name"
          @keyup="getSales()"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Month</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Equipment Type</th>
                <th>Note</th>
                <th>Profit Amount</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in sales.data" :key="value.id">
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.date  | dateToString }}</td>
                <td>{{ value.customer_name }}</td>
                <td>{{ value.equipment_type.name }}</td>
                <td>{{ value.note }}</td>
                <td>{{ value.profit }}</td>
                <td class="text-center">
                  <button @click="edit(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="deleteSales(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
                    <i class="far fa-trash-alt"></i>
                  </button>
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

    <div class="row">
      <div class="col-md-12 text-center mb-10 mt-10">
        <!-- import pagination here  -->
        <pagination :pageData="sales"></pagination>
        <edit-sales  :equipment_types="equipment_types"></edit-sales>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateSales from "./UpdateSales";
export default {
  mixins: [Mixin],
  props: ['equipment_types'],
  components: {
    'pagination': Pagination,
    'edit-sales': UpdateSales
  },
  data() {
    return {
      sales: [],
      equipment_type_id: "",
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("sales-created", function() {
      _this.getSales();
    });

    this.getSales();
  },

  methods: {
    getSales(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `equipment-sales-list?page=${page}&equipment_type=${this.equipment_type_id}&keyword=${this.keyword}`
        )
        .then(response => {
          this.sales = response.data;
          this.isLoading = false;
        });
    },

    edit(sales) {
      EventBus.$emit("edit-sales", sales);
    },

     deleteSales(id){
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
           axios.delete(`${base_url}equipment-sales/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getSales();
           });
           }
        }) 
    },
    pageClicked(page) {
      this.getSales(page);
    }
  }
};
</script>



