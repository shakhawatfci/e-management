<template>
  <div>
    <div class="row">

      <div class="col-md-3" style="margin-bottom:10px;">
         <input type="text" class="form-control" v-model="keyword"
          placeholder="Search By Destination" @keyup="getMobilization()">
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="project_id" @change="getMobilization()">
          <option value="">All Projects</option>
          <option v-for="project in projects" :key="project.id"
           :value="project.id">{{ project.project_name }}</option>
        </select>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_type_id" @change="getMobilization()">
          <option value="">All Equipment Type</option>
          <option v-for="eq_type in equipment_types" :key="eq_type.id"
           :value="eq_type.id">{{ eq_type.name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="vendor_id" @change="getVendorEquipments()">
          <option value="">All Vendor</option>
          <option v-for="vd in vendors" :key="vd.id" :value="vd.id">{{ vd.vendor_name }}</option>
        </select>
      </div>


      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="equipment_id" @change="getMobilization()">
          <option value="">All Equipment</option>
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
                <th>Month</th>
                <th>Date</th>
                <th>Project</th>
                <th>Equipment</th>
                <th>From-To</th>
                <th>Amount</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in mobilizations.data" :key="value.id">
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.date | dateToString }} <br> E By : {{ value.user.name }}</td>
                <td>{{ value.project.project_name }}</td>
                <td>
                    <span>Equipment Type : {{ value.equipment_type.name }}.</span><br>
                    <span>Vendor : <strong>{{ value.vendor.vendor_name }}.</strong></span><br>
                    <span>Equipment Name : {{ value.equipement.eq_name }}.</span><br>
                </td>
                <td>{{ value.destination_from }} - {{ value.destination_to }}</td>
                <td>
                  Given Amount :  {{ value.project_given_amount }} <br>
                  Cost :  {{ value.lobaid_cost }} <br>
                  Profit :  {{ value.profit }} <br>
                 </td>

                <td class="text-center">
                    <div class="dropdown custom-dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs fa-2x"></i>
                            
                        </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">

                            <a class="dropdown-item" href="" @click.prevent="edit(value)">Edit</a>
                            <a class="dropdown-item" href="" @click.prevent="deleteMobilization(value.id)">Delete</a>
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
        <pagination :pageData="mobilizations"></pagination>
        <update-mobilization :projects="projects" :vendors="vendors" :equipment_types="equipment_types"></update-mobilization>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateMobilization from './UpdateMobilzation'
export default {
  mixins: [Mixin],
  props: ["vendors",'equipment_types','projects'],
  components: {
    'pagination': Pagination,
    'update-mobilization': UpdateMobilization,
  },
  data() {
    return {
      mobilizations: [],
      equipments: [],
      vendor_id: "",
      equipment_type_id: "",
      project_id: "",
      equipment_id: "",
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("mobilization-created", function() {
      _this.getMobilization();
    });

    this.getMobilization();
  },

  methods: {
    getMobilization(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `mobilization-list?page=${page}
            &vendor_id=${this.vendor_id}
            &equipment_type_id=${this.equipment_type_id}
            &project_id=${this.project_id}
            &equipment_id=${this.equipment_id}
            &keyword=${this.keyword}`
        )
        .then(response => {
          this.mobilizations = response.data;
          this.isLoading = false;
        });
    },

    edit(id) {
      EventBus.$emit("edit-mobilization", id);
    },

    viewMore(id) 
    {
    EventBus.$emit('assign-details',id);
    },


     deleteMobilization(id){
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
           axios.delete(`${base_url}mobilization/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getMobilization();
           });
           }
        }) 
    },
     getVendorEquipments()
     {
       
       axios.get(`${base_url}equipment-by-vendor/0/${this.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
       this.getMobilization();
     },
    pageClicked(page) {
      this.getMobilization(page);
    }
  }
};
</script>



