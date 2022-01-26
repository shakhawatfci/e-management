<template>
<!-- Modal -->
    <div class="modal animated fadeInRight custo-fadeInRight show" id="UpdateProjectConcern" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form @submit.prevent="update()">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Project Concern</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="vendor-name">Concern Name</label>
                                        <input type="text"
                                          class="form-control" id="concern-name" v-model="project_concern.name" placeholder="concern Name:">
                                        <span v-if="validation_error.hasOwnProperty('name')" class="text-danger">
                                                {{ validation_error.name[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="concern-email">Email</label>
                                        <input type="text" id="concern-email" class="form-control" v-model="project_concern.email" placeholder="Concern Email">
                                        <span v-if="validation_error.hasOwnProperty('email')" class="text-danger">
                                                {{ validation_error.email[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone">Phone</label>
                                        <input type="text" id="concern-phone" class="form-control" v-model="project_concern.phone" placeholder="Concern Phone">
                                        <span v-if="validation_error.hasOwnProperty('phone')" class="text-danger">
                                                {{ validation_error.phone[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone_2">Refferer Name</label>
                                        <input type="text" id="concern-phone_2" class="form-control" v-model="project_concern.reference_by" placeholder="Refferer Name">
                                        <span v-if="validation_error.hasOwnProperty('reference_by')" class="text-danger">
                                                {{ validation_error.reference_by[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="Address">Address</label>
                                        <textarea type="text" id="Address" class="form-control" v-model="project_concern.address" placeholder="Concern Address"></textarea>
                                        <span v-if="validation_error.hasOwnProperty('address')" class="text-danger">
                                                {{ validation_error.address[0] }}
                                        </span>
                                    </div>
                                </div>
                         <!-- newly added  -->

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-Company">Company Name</label>
                                        <input type="text" id="concern-Company" class="form-control" v-model="project_concern.company_name" 
                                        placeholder="Company Name">
                                        <span v-if="validation_error.hasOwnProperty('company_name')" class="text-danger">
                                                {{ validation_error.company_name[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone">Company Address</label>
                                        <input type="text" id="company_address" class="form-control" v-model="project_concern.company_address" 
                                        placeholder="Company Address">
                                        <span v-if="validation_error.hasOwnProperty('company_address')" class="text-danger">
                                                {{ validation_error.company_address[0] }}
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone">Project Name</label>
                                        <input type="text" id="project_name" class="form-control" v-model="project_concern.project_name" 
                                        placeholder="Project Name">
                                        <span v-if="validation_error.hasOwnProperty('project_name')" class="text-danger">
                                                {{ validation_error.project_name[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone">Project Location</label>
                                        <input class="form-control" 
                                        v-model="project_concern.project_location" 
                                        placeholder="Project Location" />
                                        <span v-if="validation_error.hasOwnProperty('project_location')" class="text-danger">
                                                {{ validation_error.project_location[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="concern-phone">Reqired Equipment</label>
                                        <textarea class="form-control" rows="2" 
                                        v-model="project_concern.reqired_equipment" 
                                        placeholder="Reqired Equipment"></textarea>
                                        <span v-if="validation_error.hasOwnProperty('reqired_equipment')" class="text-danger">
                                                {{ validation_error.reqired_equipment[0] }}
                                        </span>
                                    </div>
                                </div>
                         
                                
                         <!-- newly added  -->


                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="concern-status">Concern Status</label>
                                        <select class="form-control" id="rating" v-model="project_concern.rating">
                                            <option value="">Select concern rating</option>
                                            <option value="no_comment">No Work Yet</option>
                                            <option value="excellent">Excellent</option>
                                            <option value="very_good">Very Good</option>
                                            <option value="good">Good</option>
                                            <option value="not_good">Not Good</option>
                                            <option value="bad">Bad</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="concern-status">Concern Status</label>
                                        <select class="form-control" id="concern-status" v-model="project_concern.status">
                                            <option value="">Select Concern Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-phone">
                                        <i class="flaticon-user-11"></i>
                                        <label for="concern-status">Note</label>
                                        <textarea class="form-control" id="concern-address" v-model="project_concern.note"  placeholder="Write About Concern..." rows="3"></textarea>
                                        <span v-if="validation_error.hasOwnProperty('note')" class="text-danger">
                                                {{ validation_error.note[0] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>{{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';
export default {
   mixins : [Mixin],
   data()
   {
        
       return {
        project_concern : {
            id: '',
          name : '',
          email : '',
          phone : '',
          phone_2 : '',
          address : '',
          company_name : '',
          company_address : '',
          project_name : '',
          project_location : '',
          reqired_equipment : '',
          reference_by : '',
          rating : '',
          note : '',
          status : ''
         },
         button_name : 'Update',
         validation_error : {},
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('project-concern-update', function(value){
        $('#UpdateProjectConcern').modal('show')
          _this.project_concern = value;
      })
   },

 methods : {
     update()
     {
         this.button_name = 'Updating...'
         axios.put(base_url+'project-concern/'+this.project_concern.id,this.project_concern)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#UpdateProjectConcern').modal('hide');
              this.successMessage(response.data);
              this.button_name = 'Update'
              this.resetForm()
              EventBus.$emit('project-concern-created');
             } 
             else
             {
              this.button_name = 'Update'
               this.successMessage(response.data);
             }
         })
         .catch(err => {
             if(err.response.status == 422)
             {
                 this.validation_error = err.response.data.errors;
                 this.validationError();
                 this.button_name = 'Update'
             }
             else
             {
                 this.validationError();
                 this.button_name = 'Update'
             }
         })
     },

     resetForm()
     {
          this.supplier = {
            id : '',
            vendor_name : '',
            vendor_adress : '',
            vendor_email : '',
            vendor_phone : '',
           concerned_person : '',
           phone_number_2 : '',
           bkash_number : '',
           bank_details : '',
            status : 1  
          };
         this.validation_error = {};
     }
 } 
   
}
</script>