<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getEquipment()">
          <option value>Filter By Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">{{ vd.vendor_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search with name model capacity"
          @keyup="getEquipment()"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Equipment Name</th>
                <th>Vendor</th>
                <th>Model</th>
                <th>Capacity</th>
                <th>Note</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in equipments.data" :key="value.id">
                <td>{{ value.eq_name }}</td>
                <td>{{ value.vendor.vendor_name }}</td>
                <td>{{ value.eq_model }}</td>
                <td>{{ value.eq_capacity }}</td>
                <td>{{ value.note }}</td>
                <td class="text-center">
                  <span class="text-success" v-if="value.eq_status == 1">Active</span>
                  <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                  <button @click="edit(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="deleteEquipment(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
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
        <pagination :pageData="this.equipments"></pagination>
        <edit-equipment :vendors="vendors"></edit-equipment>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateEquipment from "./UpdateEquipment";
export default {
  mixins: [Mixin],
  props: ["vendors"],
  components: {
    'pagination': Pagination,
    'edit-equipment': UpdateEquipment
  },
  data() {
    return {
      equipments: [],
      vendor_id: "",
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("equipment-created", function() {
      _this.getEquipment();
    });

    this.getEquipment();
  },

  methods: {
    getEquipment(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `equipment-list?page=${page}&vendor_id=${this.vendor_id}&keyword=${this.keyword}`
        )
        .then(response => {
          this.equipments = response.data;
          this.isLoading = false;
        });
    },

    edit(equipment) {
      EventBus.$emit("edit-equipment", equipment);
    },

     deleteEquipment(id){
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
           axios.delete(`${base_url}equipment/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getEquipment();
           });
           }
        }) 
    },
    pageClicked(page) {
      this.getEquipment(page);
    }
  }
};
</script>



