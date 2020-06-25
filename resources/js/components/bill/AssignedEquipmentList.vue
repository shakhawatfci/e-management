<template>
  <div>
    <div class="row">
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="release_status" @change="getEquipment()">
          <option value="">All Assign Equipment</option>
          <option value="1">Active</option>
          <option value="0">Released</option>
   
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getEquipment()">
          <option value>All Projects</option>
          <option v-for="project in projects" :key="project.id"
           :value="project.id">{{ project.project_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getEquipment()">
          <option value>All Equipment Type</option>
          <option v-for="eq_type in equipment_types" :key="eq_type.id"
           :value="eq_type.id">{{ eq_type.name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getVendorEquipments()">
          <option value>All Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">{{ vd.vendor_name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_id" @change="getEquipment()">
          <option value>All Equipment</option>
          <option v-for="eq in equipments" :key="eq.id" :value="eq.id">{{ eq.eq_name }}</option>
        </select>
      </div>

    </div>

    <div class="row" style="margin-top:20px">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Project</th>
                <th>Equipment</th>
                <th>Total Hour</th>
                <th>Project Amount</th>
                <th title="Project Rate Per Hour">Project R/H</th>
                <th>Vendor Amount</th>
                <th title="Vendor Rate Per Hour">Vendor R/H</th>

                <th class="text-center">Status</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in assign_equipments.data" :key="value.id">
                <td>{{ value.project.project_name }}</td>
                <td>
                    <span>Equipment Type : {{ value.equipment_type.name }}.</span><br>
                    <span>Vendor : <strong>{{ value.vendor.vendor_name }}.</strong></span><br>
                    <span>Equipment Name : {{ value.equipement.eq_name }}.</span><br>
                    <span>Operator       : {{ value.operator.name }}.</span><br>
                </td>
                <td>{{ value.total_hour }}</td>
                <td>{{ value.total_project_amount }}</td>
                <td>{{ value.project_rate_per_hour }}</td>
                <td>{{ value.total_vendor_amount }}</td>
                <td>{{ value.vendor_rate_per_hour }}</td>

                <!-- <td>{{ value.note }}</td> -->
                <td class="text-center">
                  <span class="text-success" v-if="value.release_status == 1">Active</span>
                  <span class="text-danger" v-else>Released at {{ value.release_date | dateToString }}</span>
                </td>
                <td class="text-center">
                    <div class="dropdown custom-dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs fa-2x"></i>
                            
                        </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                            <a class="dropdown-item" href="" @click.prevent="viewMore(value.id)">View More</a>
                            <a class="dropdown-item" href="" @click.prevent="billCreate(value)">Create Bill</a>
                     </div>
                    </div>
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
        <pagination :pageData="assign_equipments"></pagination>
        <view-assign-details ></view-assign-details>
        <bill-create ></bill-create>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import ViewAssignDetails from "../project/assign-equipment/ViewAssignDetails";
import CreateBill from "./CreateBill";
export default {
  mixins: [Mixin],
  props: ["vendors",'equipment_types','projects'],
  components: {
    'pagination': Pagination,
    'bill-create': CreateBill,
    'view-assign-details': ViewAssignDetails,
  },
  data() {
    return {
      assign_equipments: [],
      equipments: [],
      vendor_id: "",
      equipment_type_id: "",
      project_id: "",
      equipment_id: "",
      release_status: "",
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("bill-created", function() {
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
            `assigned-equipment-list?page=${page}
            &vendor_id=${this.vendor_id}
            &equipment_type_id=${this.equipment_type_id}
            &project_id=${this.project_id}
            &equipment_id=${this.equipment_id}
            &release_status=${this.release_status}`
        )
        .then(response => {
          this.assign_equipments = response.data;
          this.isLoading = false;
        });
    },



    viewMore(id) 
    {
    EventBus.$emit('assign-details',id);
    },

    billCreate(equipment)
    {
         EventBus.$emit('create-bill',equipment);
    },

     getVendorEquipments()
     {
       
       axios.get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
       this.getEquipment();
     },
    pageClicked(page) {
      this.getEquipment(page);
    }
  }
};
</script>



