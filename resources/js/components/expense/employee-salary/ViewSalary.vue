<template>
  <div>
    <div class="row">

      <div class="col-md-3" style="margin-bottom:10px;">
        <select class="form-control" v-model="employee_id" @change="getSalary()">
            <option value="">All Employee</option>
        <option v-for="value in employees" :key="value.id" :value="value.id">
            {{ value.name }}
        </option>
        </select>
      </div>
      <div class="col-md-3" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" placeHolder="Start Month" v-model="start_month"></vue-monthly-picker>
      </div>

      <div class="col-md-3" style="margin-bottom:10px;">
         <vue-monthly-picker :monthLabels="pickermonth.lebel" placeHolder="End Month" v-model="end_month" @input="getSalary()"></vue-monthly-picker>
      </div>
      <div class="col-md-2" style="margin-bottom:10px;">
         <button class="btn btn-danger outline-border" @click="filterClear()">Filter Clear</button>
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
                  <button @click="viewSalary(value)" class="btn btn-warning mb-2 mr-2 rounded-circle">
                    <i class="far fa-eye"></i>
                  </button>
                  <button @click="edit(value)" class="btn btn-dark mb-2 mr-2 rounded-circle">
                    <i class="far fa-edit"></i>
                  </button>
                  <button @click="deleteSalary(value.id)" class="btn btn-danger mb-2 mr-2 rounded-circle">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              <tr v-if="salaries.data.length > 0">
                <td colspan="7">
                  <a :href="url+`employee-salary-print-pdf?action=pdf&employee_id=${employee_id}&start_month=${start_month._i}&end_month=${end_month._i}`" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> PDF</a>
                  <a :href="url+`employee-salary-print-pdf?action=print&employee_id=${employee_id}&start_month=${start_month._i}&end_month=${end_month._i}`" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> Print</a>
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
        <show-salary ></show-salary>
      </div>
    </div>
  </div>
</template>


<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
import VueMonthlyPicker from 'vue-monthly-picker'
import Pagination from "../../pagination/Pagination";
import UpdateSalary from "./UpdateSalary";
import ShowSalary from "./ViewSingleSalary";
export default {
  mixins: [Mixin],
  components: {
    VueMonthlyPicker,ShowSalary,
    'pagination': Pagination,
    'edit-salary': UpdateSalary
  },
  data() {
    return {
      employees: [],
      salaries: [],
      pickermonth : {
        lebel : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOM', 'DEC'],
        text : "Search By Month",
      },
      filtermonth : '',
      start_month: '',
      end_month: '',
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
      var st_mo = ''
      var lt_mo = ''
      if(this.end_month != ''){
        if(this.start_month === '') this.successMessage({status : 'error',message :'Select start Month'})
          st_mo = this.start_month._i
          lt_mo = this.end_month._i
      }
      axios
        .get(
          base_url +
            `employee-salary-list?page=${page}&employee_id=${this.employee_id}&start_month=${st_mo}&end_month=${lt_mo}`
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

    viewSalary(salary) {
      EventBus.$emit("view-salary", salary);
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

    filterClear(){
        this.employees = [];
        this.start_month = '';
        this.end_month = '';
        this.employee_id = '';
        this.getSalary();
     },

    pageClicked(page) {
      this.getSalary(page);
    }
  }
};
</script>



