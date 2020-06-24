<template>
<!-- Modal -->
    <div id="createProject" class="modal animated rotateInDownLeft custo-rotateInDownLeft" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form @submit.prevent="save()" role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="project-name">Project Name</label>
                                        <input type="text"
                                          class="form-control" id="project-name" v-model="projects.project_name" placeholder="Project Name">
                                        <span v-if="validation_error.hasOwnProperty('project_name')" class="text-danger">
                                                {{ validation_error.project_name[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="project-location">Project Location</label>
                                        <input type="text"
                                        class="form-control" id="project-location" v-model="projects.project_location" placeholder="Project Location">
                                        <span v-if="validation_error.hasOwnProperty('project_location')" class="text-danger">
                                                {{ validation_error.project_location[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="contact-person">Project Contact Person</label>
                                        <input type="text"
                                        class="form-control" id="contact-person" v-model="projects.project_contact_person" placeholder="Project Contact Person">
                                        <span v-if="validation_error.hasOwnProperty('project_contact_person')" class="text-danger">
                                                {{ validation_error.project_contact_person[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="argeement-with">Project Argeement with</label>
                                        <input type="text"
                                        class="form-control" id="argeement-with" v-model="projects.project_argument_with" placeholder="Project Argeement with">
                                        <span v-if="validation_error.hasOwnProperty('project_argument_with')" class="text-danger">
                                                {{ validation_error.project_argument_with[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="basicFlatpickr">Select Project Agreement Date</label>
                                        <input id="basicFlatpickr" v-model="projects.project_argument_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Project Agreement Date">
                                
                                        <span v-if="validation_error.hasOwnProperty('project_argument_date')" class="text-danger">
                                                {{ validation_error.project_argument_date[0] }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="basicFlatpickr1">Select Project Start Date</label>
                                        <input id="basicFlatpickr1" v-model="projects.project_start_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Project Start Date">
                                        <span v-if="validation_error.hasOwnProperty('project_start_date')" class="text-danger">
                                                {{ validation_error.project_start_date[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="project-country">Project Country</label>
                                        <input type="text"
                                        class="form-control" id="project-country" v-model="projects.project_country" placeholder="Project Country">
                                        <span v-if="validation_error.hasOwnProperty('project_country')" class="text-danger">
                                                {{ validation_error.project_country[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="file">Upload Project File</label>
                                        <input type="file" class="form-control" id="file" ref="file" @change="onImageChange($event)"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="project-email">Project Email</label>
                                        <input type="email" id="project-email" class="form-control" v-model="projects.project_email" placeholder="Project Email">
                                        <span v-if="validation_error.hasOwnProperty('project_email')" class="text-danger">
                                                {{ validation_error.project_email[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="project-phone">Project Phone</label>
                                        <input type="text" id="project-phone" class="form-control" v-model="projects.project_phone" placeholder="Project Phone">
                                        <span v-if="validation_error.hasOwnProperty('project_phone')" class="text-danger">
                                                {{ validation_error.project_phone[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="project-status">Project Status</label>
                                        <select class="form-control" id="project-status" v-model="projects.project_status">
                                            <option value="">Select Project Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-location">
                                        <i class="flaticon-location-1"></i>
                                        <label for="project-details">Project Details</label>
                                        <textarea class="form-control" id="project-details" v-model="projects.project_details" placeholder="About Project"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"><div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'"></div>{{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus  } from '../../vue-assets';
import Mixin from '../../mixin';
export default {
   mixins : [Mixin],
   data()
   {
        
       return {
        projects : {
          project_name : '',
          project_location : '',
          project_contact_person : '',
          project_email : '',
          project_phone : '',
          project_argument_with : '',
          project_argument_date : '',
          project_start_date : '',
          project_country : '',
          old_file : '',
          project_file : '',
          project_details : '',
          project_status : ''
         },

         data : new FormData(),
         button_name : 'Save',
         validation_error : {},
         percentCompleted: 0,
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
      var f2 = flatpickr(document.getElementById('basicFlatpickr1'));
   },

 methods : {

      onImageChange(e) {
        
  if (e == "") return false;

  // this.projects.project_file = this.$refs.file.files[0];
  this.projects.project_file = document.getElementById('file').files[0];

      },
      createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          vm.projects.project_file = e.target.result;
        };
        reader.readAsDataURL(file);
      },

    prepareFields() {
      this.data.append('project_name',this.projects.project_name);
      this.data.append('project_location',this.projects.project_location);
      this.data.append('project_contact_person',this.projects.project_contact_person);
      this.data.append('project_email',this.projects.project_email);
      this.data.append('project_phone',this.projects.project_phone);
      this.data.append('project_argument_with',this.projects.project_argument_with);
      this.data.append('project_argument_date',this.projects.project_argument_date);
      this.data.append('project_start_date',this.projects.project_start_date);
      this.data.append('project_country',this.projects.project_country);
      this.data.append('project_file',this.projects.project_file);
      this.data.append('project_details',this.projects.project_details);
      this.data.append('project_status',this.projects.project_status);
    },

     save()
     {
        this.button_name = "Saving...";
        this.prepareFields();
          axios.post(base_url+'project',this.data,{
                headers: { 'Content-Type': 'multipart/form-data' }
              })
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createProject').modal('hide');
                  EventBus.$emit('project-created');
                  this.button_name = "Save";
              }
             else
              {
                this.successMessage(response.data);   
                this.button_name = "Save";
              }                           
          })
          .catch(err => {
                  if (err.response.status == 422) 
                  {
                    this.validation_error = err.response.data.errors;
                    this.validationError();
                    this.data = new FormData()
                    this.button_name = "Save";
                  } 
                  else 
                  {
                    this.successMessage(err);
                    this.button_name = "Save";
                    this.data = new FormData();
                  }
              }
          );
     },

     resetForm()
     {
          this.projects = {
              project_name : '',
              project_location : '',
              project_contact_person : '',
              project_email : '',
              project_phone : '',
              project_argument_with : '',
              project_argument_date : '',
              project_start_date : '',
              project_country : '',
              project_file : '',
              project_details : '',
              project_status : ''
          };
          this.data = new FormData();
         this.validation_error = {};
     }
 } 
   
}
</script>