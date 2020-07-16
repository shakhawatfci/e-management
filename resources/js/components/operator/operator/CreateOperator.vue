<template>
<!-- Modal -->
    <div id="createOperator" class="modal animated fadeInRight custo-fadeInRight show" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Create New</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                           <div class="row">
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-name">Operator Name</label>
                                         <input type="text"  id="operator-name" class="form-control" v-model="operator.operator_name" placeholder="Operator Name">
                                           <span
                                           v-if="validation_error.hasOwnProperty('operator_name')" 
                                          class="text-danger">
                                          {{ validation_error.operator_name[0] }}
                                         </span>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="equipment-type">Operator Type</label>
                                        <select class="form-control" id="equipment-type" v-model="operator.operator_type">
                                            <option value="0">Own Operator</option>
                                            <option value="1">Vendor Operator</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('operator_type')" 
                                          class="text-danger">
                                          {{ validation_error.operator_type[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="equipment-type">Equipment Type</label>
                                        <select class="form-control" id="equipment-type" v-model="operator.equipment_type_id">
                                            <option value="">Select Equipment Type</option>
                                            <option v-for="equipment in equipment_types" :key="equipment.id" :value="equipment.id">{{ equipment.name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('equipment_type_id')" 
                                          class="text-danger">
                                          {{ validation_error.equipment_type_id[0] }}
                                         </span>
                                  </div>
                              </div>
                              
                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="vendor-name">Vendor Name</label>
                                        <select class="form-control" id="vendor-name" @change="getVendorEquipments" v-model="operator.vendor_id">
                                            <option value="">Select Vendor</option>
                                            <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.vendor_name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('vendor_id')" 
                                          class="text-danger">
                                          {{ validation_error.vendor_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="equipment-name">Equipment Name</label>
                                        <select class="form-control" id="equipment-name" v-model="operator.equipement_id">
                                            <option value="">Select Equipment</option>
                                            <option v-for="equipement in equipments" :key="equipement.id" :value="equipement.id">{{ equipement.eq_name }}</option>
                                        </select>
                                           <span
                                           v-if="validation_error.hasOwnProperty('equipement_id')" 
                                          class="text-danger">
                                          {{ validation_error.equipement_id[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-mobile">Operator Mobile</label>
                                      <input type="text"  id="operator-mobile" class="form-control" v-model="operator.mobile" placeholder="Operator Mobile">
                                           <span
                                           v-if="validation_error.hasOwnProperty('mobile')" 
                                          class="text-danger">
                                          {{ validation_error.mobile[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-email">Operator Email</label>
                                      <input type="email"  id="operator-email" class="form-control" v-model="operator.email" placeholder="Operator email">
                                           <span
                                           v-if="validation_error.hasOwnProperty('email')" 
                                          class="text-danger">
                                          {{ validation_error.email[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-bkash">B-kash Number</label>
                                      <input type="text"  id="operator-bkash" class="form-control" v-model="operator.bkash" placeholder="Operator B-kash Number">
                                           <span
                                           v-if="validation_error.hasOwnProperty('bkash')" 
                                          class="text-danger">
                                          {{ validation_error.bkash[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="contact-email">
                                      <i class="flaticon-mail-26"></i>
                                      <label for="operator-nid">NID</label>
                                      <input type="text"  id="operator-nid" class="form-control" v-model="operator.nid" placeholder="Operator NID Number">
                                           <span
                                           v-if="validation_error.hasOwnProperty('nid')" 
                                          class="text-danger">
                                          {{ validation_error.nid[0] }}
                                         </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="basicFlatpickr">Join Date</label>
                                      <input id="basicFlatpickr" v-model="operator.join_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Operator Join Date">
                                        <span
                                         v-if="validation_error.hasOwnProperty('join_date')" 
                                        class="text-danger">
                                        {{ validation_error.join_date[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="contact-name">
                                    <i class="flaticon-mail-11"></i>
                                     <label for="basicFlatpickr2">Date Of Birth</label>
                                      <input id="basicFlatpickr2" v-model="operator.date_of_birth" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Date Of Birth">
                                        <span
                                         v-if="validation_error.hasOwnProperty('date_of_birth')" 
                                        class="text-danger">
                                        {{ validation_error.date_of_birth[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="contact-name">
                                    <i class="flaticon-user-11"></i>
                                    <label for="file">Upload Picture</label>
                                    <input type="file" class="form-control" id="file" ref="file" @change="onImageChange($event)"/>
                                    <span
                                         v-if="validation_error.hasOwnProperty('file')" 
                                        class="text-danger">
                                        {{ validation_error.file[0] }}
                                       </span>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <div class="contact-phone">
                                  <i class="flaticon-telephone"></i>
                                  <label for="salary">Salary</label>
                                  <input type="text" id="salary" class="form-control" v-model="operator.salary" placeholder="Salary">
                                  <span
                                     v-if="validation_error.hasOwnProperty('salary')" 
                                    class="text-danger">
                                    {{ validation_error.salary[0] }}
                                   </span>
                              </div>
                            </div>
                             
                             <div class="col-md-4">
                                <div class="contact-phone">
                                    <i class="flaticon-telephone"></i>
                                    <label for="document-link">Document Link</label>
                                    <input type="text" id="document-link" class="form-control" v-model="operator.documents_link" placeholder="Document Link">
                                    <span
                                       v-if="validation_error.hasOwnProperty('documents_link')" 
                                      class="text-danger">
                                      {{ validation_error.documents_link[0] }}
                                     </span>
                                </div>
                              </div>

                           <div class="col-md-4">
                                <div class="contact-email">
                                    <i class="flaticon-mail-26"></i>
                                    <label for="operator-status">Operator Status</label>
                                    <select class="form-control" id="operator-status" v-model="operator.status">
                                        <option value="">Select Operator Status</option>
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
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" placeholder="Operator Address" v-model="operator.address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary" @click.prevent="save()">
                    	<div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Save'"></div>
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
import { EventBus  } from '../../../vue-assets';
import Mixin from '../../../mixin';

export default {
   mixins : [Mixin],
   props : ['vendors','equipment_types'],
   data()
   {
        
    return {
        operator : {
          operator_name : '',
          operator_type : 0,
          equipment_type_id : '',
          vendor_id : '',
          equipement_id : '',
          mobile : '',
          address : '',
          email : '',
          bkash : '',
          join_date : '',
          nid : '',
          date_of_birth : '',
          picture : '',
          documents_link : '',
          salary : '',
          status : ''
        },
        data : new FormData(),
        button_name : 'Save',
        validation_error : {},
        equipments : [],
       }
   },

   mounted() {
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
      var f2 = flatpickr(document.getElementById('basicFlatpickr2'));
   },
   
 methods : {

    onImageChange(e) {
        
      if (e == "") return false;
      // this.operator.picture = this.$refs.file.files[0];
      this.operator.picture = document.getElementById('file').files[0];
    },

    prepareFields() {
      this.data.append('operator_name',this.operator.operator_name);
      this.data.append('mobile',this.operator.mobile);
      this.data.append('address',this.operator.address);
      this.data.append('email',this.operator.email);
      this.data.append('bkash',this.operator.bkash);
      this.data.append('join_date',this.operator.join_date);
      this.data.append('nid',this.operator.nid);
      this.data.append('date_of_birth',this.operator.date_of_birth);
      this.data.append('picture',this.operator.picture);
      this.data.append('documents_link',this.operator.documents_link);
      this.data.append('operator_type', this.operator.operator_type);
      this.data.append('equipment_type_id', this.operator.equipment_type_id);
      this.data.append('equipement_id', this.operator.equipement_id);
      this.data.append('vendor_id', this.operator.vendor_id);
      this.data.append('salary',this.operator.salary);
      this.data.append('status',this.operator.status);
    },

     save()
     {
        this.button_name = "Saving...";
        this.prepareFields();
          axios.post(base_url+'operator',this.data,{
                headers: { 'Content-Type': 'multipart/form-data' }
              })
          .then(response => {
              if(response.data.status === 'success'){
                  this.successMessage(response.data);
                  this.resetForm();
                  $('#createOperator').modal('hide');
                  EventBus.$emit('operator-created');
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
                    this.button_name = "Save";
                  } 
                  else 
                  {
                    this.successMessage(err);
                    this.button_name = "Save";
                  }
              }
          );
     },

   getVendorEquipments()
     {
       if(this.operator.equipment_type === '' || this.operator.vendor === '')
       {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'please choose equipment type and vendor both field for equipment list',
            });
           return ;
       }
       axios.get(`${base_url}equipment-by-vendor/${this.operator.equipment_type_id}/${this.operator.vendor_id}`)
            .then(response => {
              this.equipments = response.data;
            });
     },

     resetForm()
     {
        this.operator = {
          operator_name : '',
          operator_type : 0,
          equipment_type_id : '',
          vendor_id : '',
          equipement_id : '',
          mobile : '',
          address : '',
          email : '',
          bkash : '',
          join_date : '',
          nid : '',
          date_of_birth : '',
          picture : '',
          documents_link : '',
          salary : '',
          status : ''
        };
        this.data = new FormData();
        this.button_name = "Save";
        this.validation_error = {};
        this.equipments = [];
     }
 } 
   
}
</script>