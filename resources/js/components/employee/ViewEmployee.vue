<template>
  <div>
    <div class="row">

      <div class="col-md-6" style="margin-bottom:10px;">
        <input
          type="text"
          v-model="keyword"
          class="form-control"
          placeholder="Search by keyword"
          @keyup="getEmployee()"
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
                <th>Designation</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="text-center">Status</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in employees.data" :key="value.id">
                <td>{{ value.name }}</td>
                <td>{{ value.designation }}</td>
                <td>{{ value.email }}</td>
                <td>{{ value.phone }}</td>
                <td class="text-center">
                  <span class="text-success" v-if="value.status == 1">Active</span>
                  <span class="text-danger" v-else>Inactive</span>
                </td>
                <td class="text-center">
                  <button @click="viewMore(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-eye"></i>
                  </button>
                  <button @click="edit(value)" class="btn btn-primary mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="passwordChange(value.id,value.name)" title="Password Change" 
                  class="btn btn-secondary mb-2 mr-2 rounded-circle">
                    <i class="fa fa-lock"></i>
                  </button>
                  <button @click="deleteEquipmentType(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
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
        <pagination :pageData="employees"></pagination>
       
      </div>
       <edit-employee :roles="roles" ></edit-employee>
       <employee-details ></employee-details>
       <password-change ></password-change>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import Pagination from "../pagination/Pagination";
import UpdateEmployee from "./UpdateEmployee";
import EmployeeDetails from "./EmployeeDetails";
import PasswordChange from "./PasswordChange";
export default {
  mixins: [Mixin],
  props: ['roles'],
  components: {
    'pagination': Pagination,
    'edit-employee': UpdateEmployee,
    'employee-details': EmployeeDetails,
    'password-change': PasswordChange
  },
  data() {
    return {
      employees: [],
      keyword: "",
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("employee-created", function() {
      _this.getEmployee();
    });

    this.getEmployee();
  },

  methods: {
    getEmployee(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `employee-list?page=${page}&keyword=${this.keyword}`
        )
        .then(response => {
          this.employees = response.data;
          this.isLoading = false;
        });
    },

    edit(employee) {
      EventBus.$emit("edit-employee", employee);
    },

    viewMore(employee) {
      EventBus.$emit("employee-details", employee);
    },

    passwordChange(employee_id,name)
    { 

      EventBus.$emit('employee-password',{ employee_id : employee_id, name : name });

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
           axios.delete(`${base_url}employee/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getEmployee();
           });
           }
        }) 
    },
    pageClicked(page) {
      this.getEmployee(page);
    }
  }
};
</script>



