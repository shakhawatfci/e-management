<template>
  <div>
    <div class="row">

      <div class="col-md-6" style="margin-bottom:10px;">
        <select class="form-control" v-model="employee_id" @change="getSalary()">
            <option value="">All Employee</option>
        <option v-for="value in employees" :key="value.id" :value="value.id">
            {{ value.name }}
        </option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12" v-if="!isLoading">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-4">
            <thead>
              <tr>
                <th>Month</th>
                <th>Employee Name</th>
                <th>Salary</th>
                <th>Bonus</th>
                <th>Deduction</th>
                <th>Total</th>
                <th class="text-center">action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="value in salaries.data" :key="value.id">
                <td>{{ value.month | monthToString }}</td>
                <td>{{ value.employee.name  }}</td>
                <td>{{ value.salary_amount  }}</td>
                <td>{{ value.bonus  }}</td>
                <td>{{ value.deduction  }}</td>
                <td>{{ value.total_salary_amount  }}</td>
                <td class="text-center">
                  <button @click="edit(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="deleteSalary(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
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
        <pagination :pageData="salaries"></pagination>
        <edit-salary ></edit-salary>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import Pagination from "../../pagination/Pagination";
import UpdateSalary from "./UpdateSalary";
export default {
  mixins: [Mixin],
  components: {
    'pagination': Pagination,
    'edit-salary': UpdateSalary
  },
  data() {
    return {
      employees: [],
      salaries: [],
      start_month: "",
      end_month: "",
      employee_id: '',
      isLoading: false,
      url : base_url
    };
  },

  mounted() {
    var _this = this;

    EventBus.$on("salary-created", function() {
      _this.getSalary();
    });

    this.getSalary();
    this.getEmployee();
  },

  methods: {
    getSalary(page = 1) {
      this.isLoading = true;
      axios
        .get(
          base_url +
            `employee-salary-list?page=${page}&employee_id=${this.employee_id}&start_month=${this.start_month}&end_month=${this.end_month}`
        )
        .then(response => {
          this.salaries = response.data;
          this.isLoading = false;
        });
    },

    getEmployee()
     {
       axios.get(base_url+'all-employee')
            .then(response => {
             this.employees = response.data;
            });
     },

    edit(salary) {
      EventBus.$emit("edit-salary", salary);
    },

     deleteSalary(id){
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
           axios.delete(`${base_url}employee-salary/${id}`)
           .then(response => {
              this.successMessage(response.data);
              this.getSalary();
           });
           }
        }) 
    },
    pageClicked(page) {
      this.getSalary(page);
    }
  }
};
</script>



