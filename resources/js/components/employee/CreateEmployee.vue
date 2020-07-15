<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="CreateEmployee"
    tabindex="-1"
    role="dialog"
    aria-labelledby="addContactModalTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl custom-modal" role="document">
      <form @submit.prevent="save()">
        <div class="modal-content">
          <div class="modal-header flex">
            <h4 class="modal-title">Create Employee</h4>
            <h4><i class="fa fa-close" data-dismiss="modal"></i></h4>
          </div>
          <div class="modal-body">

            <div class="add-contact-box">
              <div class="add-contact-content">
                <div class="row">

                  <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-edit"></i>
                      <span> Name</span>
                      <input type="text" class="form-control" v-model="employee.name" placeholder="Employee Name" />
                      <span
                        v-if="validation_error.hasOwnProperty('name')" 
                        class="text-danger">
                        {{ validation_error.name[0] }}
                      </span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-key"></i>
                      <span> Role</span>
                     <select class="form-control" v-model="employee.role_id">
                         <option value="">Chose A Role</option>
                         <option v-for="role in roles" :key="role.id" :value="role.id">
                             {{ role.role_name }}
                        </option>   
                     </select>
                      <span
                        v-if="validation_error.hasOwnProperty('name')" 
                        class="text-danger">
                        {{ validation_error.name[0] }}
                      </span>
                    </div>
                  </div>

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-envelope"></i>
                      <span> Email</span>
                      <input type="email" class="form-control" v-model="employee.email" placeholder="Employee Email" />
                      <span
                        v-if="validation_error.hasOwnProperty('email')" 
                        class="text-danger">
                        {{ validation_error.email[0] }}
                      </span>
                    </div>
                  </div>




                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-lock"></i>
                      <span>Password</span>
                      <input type="password" class="form-control" v-model="employee.password" placeholder="Employee Password" />
                      <span
                        v-if="validation_error.hasOwnProperty('password')" 
                        class="text-danger">
                        {{ validation_error.password[0] }}
                      </span>
                    </div>
                  </div>

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-lock"></i>
                      <span>Password Confirmation</span>
                      <input type="password" class="form-control" 
                      v-model="employee.password_confirmation"
                       placeholder="Password Confirmation" />
                      <span
                        v-if="validation_error.hasOwnProperty('password_confirmation')" 
                        class="text-danger">
                        {{ validation_error.password_confirmation[0] }}
                      </span>
                    </div>
                  </div>

                    <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-phone"></i>
                      <span> Phone</span>
                      <input type="text" class="form-control" v-model="employee.phone" placeholder="Employee Phone" />
                      <span
                        v-if="validation_error.hasOwnProperty('phone')" 
                        class="text-danger">
                        {{ validation_error.phone[0] }}
                      </span>
                    </div>
                  </div>

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-sitemap"></i>
                      <span> Employee Designation</span>
                      <input type="text" class="form-control" v-model="employee.designation" placeholder="Employee Designation" />
                      <span
                        v-if="validation_error.hasOwnProperty('designation')" 
                        class="text-danger">
                        {{ validation_error.designation[0] }}
                      </span>
                    </div>
                  </div>


                 <div class="col-md-3">
                    <div class="contact-email text-left">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                      <span>Date of Birth</span>
              <flat-picker class="form-control" v-model="employee.date_of_birth" placeholder="Date Of Birth" ></flat-picker>                     
                      <span
                        v-if="validation_error.hasOwnProperty('date_of_birth')" 
                        class="text-danger">
                        {{ validation_error.date_of_birth[0] }}
                      </span>
                    </div>
                  </div>

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                     <i class="fa fa-calendar-o" aria-hidden="true"></i>
                      <span>Date of Joining</span>
              <flat-picker class="form-control" v-model="employee.date_of_joining" placeholder="Date Of Birth" ></flat-picker>                      
                      <span
                        v-if="validation_error.hasOwnProperty('date_of_joining')" 
                        class="text-danger">
                        {{ validation_error.date_of_joining[0] }}
                      </span>
                    </div>
                  </div>


                 <div class="col-md-3">
                    <div class="contact-email text-left">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>

                      <span>Date of Leaving</span>
               <flat-picker class="form-control" v-model="employee.date_of_leaving" placeholder="Date Of Birth" ></flat-picker>                      
                      <span
                        v-if="validation_error.hasOwnProperty('date_of_leaving')" 
                        class="text-danger">
                        {{ validation_error.date_of_leaving[0] }}
                      </span>
                    </div>
                  </div>


                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-money"></i>
                      <span>Salary</span>
                      <input type="text" class="form-control" v-model="employee.salary" 
                      placeholder="Employee Salary" />
                      
                      <span
                        v-if="validation_error.hasOwnProperty('salary')" 
                        class="text-danger">
                        {{ validation_error.salary[0] }}
                        
                      </span>
                    </div>
                  </div>
 

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-window-restore" aria-hidden="true"></i>

                      <span> Status</span>
                      <select class="form-control" v-model="employee.status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                      </select>
                      <span
                        v-if="validation_error.hasOwnProperty('salary')" 
                        class="text-danger">
                        {{ validation_error.salary[0] }}
                      </span>
                    </div>
                  </div>


                 <div class="col-md-3">
                    <div class="contact-email text-left">
                      <i class="fa fa-camera"></i>
                      <span> Image</span>
                      <img v-if="employee.image" :src="employee.image" style="height:70px">
                      <input type="file" class="form-control" @change="onImageChange($event)">
                      <span
                        v-if="validation_error.hasOwnProperty('image')" 
                        class="text-danger">
                        {{ validation_error.image[0] }}
                      </span>
                    </div>
                  </div>

                 <div class="col-md-3">
                    <div class="contact-email text-left">
                     <i class="fa fa-address-card" aria-hidden="true"></i>
                      <span> Address</span>
                      <textarea class="form-control" placeholder="Enter Employee Address" v-model="employee.address"></textarea>
                      <span
                        v-if="validation_error.hasOwnProperty('address')" 
                        class="text-danger">
                        {{ validation_error.address[0] }}
                      </span>
                    </div>
                  </div>


                 <div class="col-md-3">
                    <div class="contact-email text-left">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>

                      <span> Emargency Contact</span>
                      <textarea class="form-control" placeholder="Emargency Contact Info" v-model="employee.emargency_contact"></textarea>
                      <span
                        v-if="validation_error.hasOwnProperty('emargency_contact')" 
                        class="text-danger">
                        {{ validation_error.emargency_contact[0] }}
                      </span>
                    </div>
                  </div>



                </div>
               

               <!-- employee education  -->
                <div class="row" v-if="employee.employee_education.length > 0 ">
                    <div class="col-md-12">
                        <h5 style="margin-top:15px;" >Employee Education</h5>
                    </div>
                </div>
                
                <div class="row" v-for="(education,index) in employee.employee_education" :key="index+'edu'">
                   
                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-university"></i>
                      <span>Institute</span>
                      <input type="text" class="form-control" v-model="education.institute" 
                      placeholder="Institute" />
                      <span
                        v-if="validation_error['employee_education.'+index+'.institute']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.institute'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-university"></i>
                      <span>Board</span>
                      <input type="text" class="form-control" v-model="education.board" 
                      placeholder="Board" />
                    <span
                        v-if="validation_error['employee_education.'+index+'.board']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.board'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                      <span> Degree/Exam</span>
                      <input type="text" class="form-control" v-model="education.degree" 
                      placeholder="EX : BSC in CSE , SSC " />
                    <span
                        v-if="validation_error['employee_education.'+index+'.degree']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.degree'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-external-link-square" aria-hidden="true"></i>
                      <span> Passing Year</span>
                      <input type="text" class="form-control" v-model="education.passing_year" 
                      placeholder="Passing Year" />
                    <span
                        v-if="validation_error['employee_education.'+index+'.passing_year']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.passing_year'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                       <i class="fa fa-smile-o" aria-hidden="true"></i>
                      <span> Result</span>
                      <input type="text" class="form-control" v-model="education.result" 
                      placeholder="Result Eg, Passed , Appeared" />
                    <span
                        v-if="validation_error['employee_education.'+index+'.result']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.result'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                     <i class="fa fa-balance-scale" aria-hidden="true"></i>
                      <span> GPA/CGPA</span>
                      <input type="text" class="form-control" v-model="education.gpa" 
                      placeholder="GPA/CGPA: eg 5 out of 5" />
                    <span
                        v-if="validation_error['employee_education.'+index+'.gpa']" 
                        class="text-danger">
                        {{ validation_error['employee_education.'+index+'.gpa'][0] }}
                      </span>
                    </div>
                    
                  </div>

                  <div class="col-md-3">
                      <div class="contact-email text-left">
                      <a href="" 
                      class="btn btn-outline-danger" style="margin-top:25px;" 
                      @click.prevent="removeEducation(index)">Delete Education</a>
                  </div>
                  </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="margin-top:15px;" >
                            <a href="" class="btn btn-outline-success"
                             @click.prevent="addEducation()">
                              {{ employee.employee_education.length > 0  ? 'Add More Education'  : 'Add Employee Education' }} 
                             </a>
                        </h5>
                        <hr>
                    </div>
                </div>

                <!-- end employee experience  -->

               <!-- employee experience  -->
                <div class="row" v-if="employee.employee_experience.length > 0 ">
                    <div class="col-md-12">
                        <h5 style="margin-top:15px;" >Employee Experience</h5>
                    </div>
                </div>

                <div class="row" v-for="(experience,index) in employee.employee_experience" :key="index+'exp'">
                   
                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-sitemap"></i>
                      <span>Organization</span>
                      <input type="text" class="form-control" v-model="experience.organization" 
                      placeholder="Organization" />
                      <span
                        v-if="validation_error['employee_experience.'+index+'.organization']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.organization'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                      <i class="fa fa-university"></i>
                      <span>Desingation</span>
                      <input type="text" class="form-control" v-model="experience.designation" 
                      placeholder="Designation" />
                    <span
                        v-if="validation_error['employee_experience.'+index+'.designation']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.designation'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                      <span>From Date</span>
                      <flat-picker class="form-control" v-model="experience.from_date" placeholder="Chose From Date" ></flat-picker>
                    <span
                        v-if="validation_error['employee_experience.'+index+'.from_date']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.from_date'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                      <span>To Date</span>
                <flat-picker class="form-control" v-model="experience.to_date" placeholder="Chose To Date" ></flat-picker>
                    <span
                        v-if="validation_error['employee_experience.'+index+'.to_date']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.to_date'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                     <i class="fa fa-briefcase" aria-hidden="true"></i>

                      <span>Responsibility</span>
                      <input type="text" class="form-control" v-model="experience.responsibility" 
                      placeholder="Responsibility" />
                    <span
                        v-if="validation_error['employee_experience.'+index+'.responsibility']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.responsibility'][0] }}
                      </span>
                    </div>
                    
                  </div>


                 <div class="col-md-3">

                    <div class="contact-email text-left">
                    <i class="fa fa-cogs" aria-hidden="true"></i>

                      <span>Skills</span>
                      <input type="text" class="form-control" v-model="experience.skill" 
                      placeholder="Skills" />
                    <span
                        v-if="validation_error['employee_experience.'+index+'.skill']" 
                        class="text-danger">
                        {{ validation_error['employee_experience.'+index+'.skill'][0] }}
                      </span>
                    </div>
                    
                  </div>

                  <div class="col-md-3">
                      <div class="contact-email text-left">
                      <a href="" 
                      class="btn btn-outline-danger" style="margin-top:25px;" 
                      @click.prevent="removeExperience(index)">Delete Experience</a>
                  </div>
                  </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="margin-top:15px;" >
                            <a href="" class="btn btn-outline-success"
                             @click.prevent="addExperience()">
                              {{ employee.employee_experience.length > 0  ? 'Add More Experience'  : 'Add Employee Experience' }} 
                             </a>
                        </h5>
                    </div>
                </div>

                <!-- end employee experience  -->

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
              <div
                class="spinner-grow text-white mr-2 align-self-center loader-sm"
                v-if="button_name != 'Save'"
              >.</div>
              {{ button_name }}
            </button>

            <button class="btn btn-default" data-dismiss="modal">
              <i class="flaticon-delete-1"></i> Discard
            </button>
          </div>
        </div>
      </form>
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
          password: '',
          password_confirmation: '',
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
      button_name: "Save"
    };
  },

  mounted() {


  },

  methods: {

     onImageChange(e) {
				let files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createImage(files[0]);
      },
      
			createImage(file) {
				let reader = new FileReader();
				let vm = this;
				reader.onload = (e) => {
					vm.employee.image = e.target.result;
				};
				reader.readAsDataURL(file);
      },
      
    save() {
      this.button_name = "Saving...";
      axios
        .post(base_url + "employee", this.employee)
        .then(response => {
          if (response.data.status === "success") {
            $("#CreateEmployee").modal("hide");
            this.successMessage(response.data);
            EventBus.$emit("employee-created");
            this.button_name = "Save";
            this.resetForm();
          } else {
            this.successMessage(response.data);
            this.button_name = "Save";
          }
        })
        .catch(err => {
          if (err.response.status == 422) {
            this.validation_error = err.response.data.errors;
            this.validationError();
            this.button_name = "Save";
          } else {
            this.successMessage(err);
            this.button_name = "Save";
          }
        });
    },

    addEducation()
    {
        this.employee.employee_education.push({
                  institute : '',
                  board: '',
                  degree: '',
                  passing_year: '',
                  result: '',
                  gpa: '',
              });
    },

    removeEducation(index)
    {
      this.employee.employee_education.splice(index,1);
    },

    addExperience()
    {
        this.employee.employee_experience.push({
                  organization : '',
                  designation: '',
                  from_date: '',
                  to_date: '',
                  responsibility: '',
                  skill: '',
              });
    },

    removeExperience(index)
    {
      this.employee.employee_experience.splice(index,1);
    },

    resetForm() {
          
          this.employee = {
          name : '',
          email : '',
          role_id : '',
          password: '',
          password_confirmation: '',
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
          employee_experience: []
      }
      this.validation_error = {};
    }
  }
};
</script>