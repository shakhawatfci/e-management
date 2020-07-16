<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="EmployeeDetails"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addContactModalTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl custom-modal" role="document">

        <div class="modal-content">
          <div class="modal-header flex">
            <h4 class="modal-title">Employee Details</h4>
            <h4><i class="fa fa-close" data-dismiss="modal"></i></h4>
          </div>
          <div class="modal-body" v-if="employee">

            <div class="add-contact-box">
              <div class="add-contact-content">

                 <!-- basic info   -->
                <div class="row">
                  <div class="col-md-6">
                      <h4 class="">{{ employee.name }}</h4>
                       <p><strong class="text-danger">Designation</strong>: {{ employee.designation }}</p>
                       <p><strong class="text-danger">Email</strong>: {{ employee.email }}</p>
                       <p><strong class="text-danger">Phone</strong>: {{ employee.phone }}</p>
                       <p><strong class="text-danger">Role</strong>: {{ employee.user.role.role_name }}</p>
                  </div>

                  <div class="col-md-6 text-right">
                      <img v-if="employee.image" style="max-height:150px" :src="url+'images/employee/'+employee.image">
                  </div>
                </div>
                <!-- end basic info  -->

                <!-- education  -->
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                    <div class="card  component-card_1" style="border-dark">
                        <div class="card-title bg-dark">
                            <h5 class="card-title " style="padding:5px;margin-top:10px">
                             <i class="fa fa-graduation-cap" aria-hidden="true"></i>  Educational Qaulification
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Institute</th>
                                         <th>Board</th>
                                         <th>Degree</th>
                                         <th>Passing Year</th>
                                         <th>Result</th>
                                         <th>GPA</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     <tr v-for="edu in employee.employee_education" :key="edu.id+'education'">
                                       <td>{{ edu.institute }}</td>
                                       <td>{{ edu.board }}</td>
                                       <td>{{ edu.degree }}</td>
                                       <td>{{ edu.passing_year }}</td>
                                       <td>{{ edu.result }}</td>
                                       <td>{{ edu.gpa }}</td>
                                     </tr>
                                 </tbody>
                               </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- education  -->


                <!-- experience  -->
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                    <div class="card  component-card_1" style="border-dark">
                        <div class="card-title bg-dark">
                            <h5 class="card-title " style="padding:5px;margin-top:10px">
                             <i class="fa fa-cogs" aria-hidden="true"></i>  Propessional Experience
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Organization</th>
                                         <th>Designation</th>
                                         <th>From</th>
                                         <th>To</th>
                                         <th>Responsibility</th>
                                         <th>Skills</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     <tr v-for="exp in employee.employee_experience" :key="exp.id+'exp'">
                                       <td>{{ exp.organization }}</td>
                                       <td>{{ exp.designation }}</td>
                                       <td>{{ exp.from_date }}</td>
                                       <td>{{ exp.to_date }}</td>
                                       <td>{{ exp.responsibility }}</td>
                                       <td>{{ exp.skill }}</td>
                                     </tr>
                                 </tbody>
                               </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- experience  -->


                <!-- experience  -->
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                    <div class="card  component-card_1" style="border-dark">
                        <div class="card-title bg-dark">
                            <h5 class="card-title " style="padding:5px;margin-top:10px">
                             <i class="fa fa-user" aria-hidden="true"></i> Personal Information
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="col-md-6">
                            <div class="table-responsive">
                                <table style="width:100%;font-size:15px;color:white">
                                 <thead>
                                     <tr>
                                         <th class="text-danger">Name:</th>
                                         <th class="text-left">{{ employee.name }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Email:</th>
                                         <th class="text-left">{{ employee.email }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Phone:</th>
                                         <th class="text-left">{{ employee.phone }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Designation:</th>
                                         <th class="text-left">{{ employee.designation }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Date Of birth:</th>
                                         <th class="text-left">{{ employee.date_of_birth }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Date Of Join:</th>
                                         <th class="text-left">{{ employee.date_of_joining }}</th>
                                     </tr>
                                     <tr v-if="employee.status == 0">
                                         <th class="text-danger">Date Of Leaving:</th>
                                         <th class="text-left">{{ employee.date_of_leaving }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Adress:</th>
                                         <th class="text-left">{{ employee.address }}</th>
                                     </tr>
                                     <tr>
                                         <th class="text-danger">Emargenecy Contact:</th>
                                         <th class="text-left">{{ employee.emargency_contact }}</th>
                                     </tr>
                                 </thead>
                               </table>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- experience  -->
              </div>
            </div>
          </div>
          <div class="modal-footer">

            <button class="btn btn-default" data-dismiss="modal">
              <i class="flaticon-delete-1"></i> Close
            </button>
          </div>
        </div>
 
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../vue-assets";
import Mixin from "../../mixin";
import flatPickr from 'vue-flatpickr-component';
export default {
  components: {
   'flat-picker' : flatPickr
  },
  props: ['roles'],
  mixins: [Mixin],
  data() {
    return {
      employee : {
          name : '',
          email : '',
          role_id : '',
          phone: '',
          designation: '',
          date_of_birth: '',
          date_of_joining: '',
          date_of_leaving: '',
          image: '',
          salary: 0,
          address: '',
          emargency_contact: '',
          status: 1,
          employee_education: [],
          employee_experience: [],
      },
      validation_error: {},
      button_name: "Save",
      url : base_url
    };
  },

  mounted() {
     
     var _this = this;
     EventBus.$on('employee-details',function(employee) {
      _this.employee = employee;
      $('#EmployeeDetails').modal('show');
     })

  },

  methods: {


  }
};
</script>