<template>
<!-- Modal -->
    <div id="UpdateOperator" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Update</h5>
              </div>
                <div class="modal-body"><i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-operator-name">Operator Name</label>
                                         <input type="text"  id="up-operator-name" class="form-control" v-model="operator.name" placeholder="Operator Name">
                                           <span
                                           v-if="validation_error.hasOwnProperty('name')" 
                                          class="text-danger">
                                          {{ validation_error.name[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-operator-mobile">Operator Mobile</label>
                                      <input type="text"  id="up-operator-mobile" class="form-control" v-model="operator.mobile" placeholder="Operator Mobile">
                                           <span
                                           v-if="validation_error.hasOwnProperty('mobile')" 
                                          class="text-danger">
                                          {{ validation_error.mobile[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-operator-email">Operator Email</label>
                                      <input type="email"  id="up-operator-email" class="form-control" v-model="operator.email" placeholder="Operator email">
                                           <span
                                           v-if="validation_error.hasOwnProperty('email')" 
                                          class="text-danger">
                                          {{ validation_error.email[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-operator-bkash">B-kash Number</label>
                                      <input type="text"  id="up-operator-bkash" class="form-control" v-model="operator.bkash_number" placeholder="Operator B-kash Number">
                                           <span
                                           v-if="validation_error.hasOwnProperty('bkash_number')" 
                                          class="text-danger">
                                          {{ validation_error.bkash_number[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="up-operator-nid">NID</label>
                                      <input type="text"  id="up-operator-nid" class="form-control" v-model="operator.nid" placeholder="Operator NID Number">
                                           <span
                                           v-if="validation_error.hasOwnProperty('nid')" 
                                          class="text-danger">
                                          {{ validation_error.nid[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="up-basicFlatpickr">Join Date</label>
                                      <input id="up-basicFlatpickr" v-model="operator.join_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Operator Join Date">
                                        <span
                                         v-if="validation_error.hasOwnProperty('join_date')" 
                                        class="text-danger">
                                        {{ validation_error.join_date[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="up-basicFlatpickr2">Date Of Birth</label>
                                      <input id="up-basicFlatpickr2" v-model="operator.date_of_birth" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Date Of Birth">
                                        <span
                                         v-if="validation_error.hasOwnProperty('date_of_birth')" 
                                        class="text-danger">
                                        {{ validation_error.date_of_birth[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="contact-name">
                                    <i class="flaticon-user-11"></i>
                                    <label for="up-file">Upload Picture</label>
                                    <input type="file" class="form-control" id="up-file" ref="file" @change="onImageChange($event)"/>
                                    <span
                                         v-if="validation_error.hasOwnProperty('file')" 
                                        class="text-danger">
                                        {{ validation_error.file[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <div class="contact-phone">
                                  <i class="flaticon-telephone"></i>
                                  <label for="up-salary">Salary</label>
                                  <input type="text" id="up-salary" class="form-control" v-model="operator.salary" placeholder="Salary">
                                  <span
                                     v-if="validation_error.hasOwnProperty('salary')" 
                                    class="text-danger">
                                    {{ validation_error.salary[0] }}
                                   </span>
                              </div>
                            </div>
                             
                           <div class="col-md-6">
                                <div class="contact-email">
                                    <i class="flaticon-mail-26"></i>
                                    <label for="up-operator-status">Operator Status</label>
                                    <select class="form-control" id="up-operator-status" v-model="operator.status">
                                        <option value="">Select Operator Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="up-document-link">Document Link</label>
                                    <input type="text" id="up-document-link" class="form-control" v-model="operator.documents_link" placeholder="Document Link">
                                    <span
                                       v-if="validation_error.hasOwnProperty('documents_link')" 
                                      class="text-danger">
                                      {{ validation_error.documents_link[0] }}
                                     </span>
                                </div>
                              </div>
                                <div class="col-md-12">
                                    <div class="contact-location">
                                        <i class="flaticon-location-1"></i>
                                        <label for="up-address">Address</label>
                                        <textarea class="form-control" id="up-address" placeholder="Operator Address" v-model="operator.address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary"
                    @click.prevent="update()">
                      <div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>
                    {{ button_name }}</button>

                    <button class="btn btn-default" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>
                </div>
              </div>
            </div>
            </form>
        </div>
    </div>

</template>

<script>
import { EventBus } from "../../../vue-assets";
import Mixin from "../../../mixin";
export default {
   mixins : [Mixin],
   data()
   {
        
       return {
        operator : {
          id : '',
          name : '',
          mobile : '',
          address : '',
          email : '',
          bkash_number : '',
          join_date : '',
          nid : '',
          date_of_birth : '',
          file : '',
          documents_link : '',
          salary : '',
          status : ''
        },
        dataform : new FormData(),
        button_name : 'Update',
        validation_error : {}
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('up-basicFlatpickr'));
      var f2 = flatpickr(document.getElementById('up-basicFlatpickr2'));
      var _this = this;
      EventBus.$on('operator-update',function(value){
        $("#UpdateOperator").modal('show')
        _this.operator = value;
      })
   },
   
 methods : {

    onImageChange(e) {
        
      if (e == "") return false;
      // this.operator.file = this.$refs.file.files[0];
      this.operator.file = document.getElementById('up-file').files[0];
    },

    prepareUpdateFields() {
      this.dataform.append('name', this.operator.name);
      this.dataform.append('mobile', this.operator.mobile);
      this.dataform.append('address', this.operator.address);
      this.dataform.append('email', this.operator.email);
      this.dataform.append('bkash_number', this.operator.bkash_number);
      this.dataform.append('join_date', this.operator.join_date);
      this.dataform.append('nid', this.operator.nid);
      this.dataform.append('date_of_birth', this.operator.date_of_birth);
      this.dataform.append('file', this.operator.file);
      this.dataform.append('documents_link', this.operator.documents_link);
      this.dataform.append('salary', this.operator.salary);
      this.dataform.append('status', this.operator.status);
    },

     update()
     {
        this.prepareUpdateFields();
        this.button_name = "Updating...";

        axios.post(base_url+'operator-update/'+this.operator.id,this.dataform,{
          header:{'Content-Type' : 'multipart/form-data'}
        })
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#UpdateOperator').modal('hide');
                  EventBus.$emit('operator-created');
                  this.button_name = "Update";
              }
             else
              {
                this.successMessage(response.data);   
                this.button_name = "Update";
              }                           
          })
          .catch(err => {
                  if (err.response.status == 422) 
                  {
                    this.validation_error = err.response.data.errors;
                    this.validationError();
                    this.button_name = "Update";
                  } 
                  else 
                  {
                    this.successMessage(err);
                    this.button_name = "Update";
                  }
              }
          );
     },

     resetForm()
     {
        this.operator = {
          name : '',
          mobile : '',
          address : '',
          email : '',
          bkash_number : '',
          join_date : '',
          nid : '',
          date_of_birth : '',
          file : '',
          documents_link : '',
          salary : '',
          status : ''
        };
        this.dataform = new FormData();
        this.button_name = "Update";
        this.validation_error = {};
     }
 } 
   
}
</script>