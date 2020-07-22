<template>
  <div>
    <div class="row">

      <div class="col-md-6" style="margin-bottom:10px;">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search by keyword"
          @keyup="getEquipmentType()"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Name</th>
                <th>Note</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in equipment_types.data" :key="value.id">
                <td>{{ value.name }}</td>
                <td>{{ value.note }}</td>
                <td class="text-center">
                  <span class="text-success" v-if="value.status == 1">Active</span>
                  <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                  <button @click="edit(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="deleteEquipmentType(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <tr v-if="equipment_types.data.length > 0">
                <td colspan="6">
                  <a :href="url+'equipment-type-list-print-pdf?action=pdf'" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+'equipment-type-list-print-pdf?action=print'" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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
        <pagination :pageData="equipment_types"></pagination>
        <edit-equipment-type ></edit-equipment-type>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateEquipmentType from "./UpdateEquipmentType";
export default {
  mixins: [Mixin],
  components: {
    'pagination': Pagination,
    'edit-equipment-type': UpdateEquipmentType
  },
  data() {
    return {
      equipment_types: [],
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("equipment-type-created", function() {
      _this.getEquipmentType();
    });

    this.getEquipmentType();
  },

  methods: {
    getEquipmentType(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `equipment-category-list?page=${page}&keyword=${this.keyword}`
        )
        .then(response => {
          this.equipment_types = response.data;
          this.isLoading = false;
        });
    },

    edit(equipment) {
      EventBus.$emit("edit-equipment-type", equipment);
    },

     deleteEquipmentType(id){
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
           axios.delete(`${base_url}equipment-type/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getEquipmentType();
           });
           }
        }) 
    },
    pageClicked(page) {
      this.getEquipmentType(page);
    }
  }
};
</script>



