<template>
<!-- Modal -->
    <div class="modal fade" id="createSupplier" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form @submit.prevent="save()">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Vendor</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <input type="text"
                                          class="form-control" v-model="supplier.vendor_name" placeholder="Vendor Name:">
                                        <span v-if="validation_error.hasOwnProperty('vendor_name')" class="text-danger">
                                                {{ validation_error.vendor_name[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <input type="text" class="form-control" v-model="supplier.vendor_email" placeholder="Vendor Email">
                                        <span v-if="validation_error.hasOwnProperty('vendor_email')" class="text-danger">
                                                {{ validation_error.vendor_email[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <input type="text" class="form-control" v-model="supplier.vendor_phone" placeholder="Vendor Phone">
                                        <span v-if="validation_error.hasOwnProperty('vendor_phone')" class="text-danger">
                                                {{ validation_error.vendor_phone[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <select class="form-control" v-model="supplier.status">
                                            <option value="">Supplier Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <textarea class="form-control" v-model="supplier.vendor_address"  placeholder="Vendor Address: " rows="3"></textarea>
                                        <span v-if="validation_error.hasOwnProperty('vendor_address')" class="text-danger">
                                                {{ validation_error.vendor_address[0] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary">{{ button_name }}</button>

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
         supplier : {
          vendor_name : '',
          vendor_address : '',
          vendor_email : '',
          vendor_phone : '',
          status : '' 
         },
         button_name : 'Save',
         validation_error : {},
       }
   },

   mounted() {
  
   },

 methods : {
     save()
     {
         this.button_name = 'Saving...'
         axios.post(base_url+'supplier',this.supplier)
         .then(response => {
             if(response.data.status === 'success')
             {
              this.resetForm()
              $('#createSupplier').modal('hide');
              this.successMessage(response.data);
              this.button_name = 'Save'
              EventBus.$emit('supplier-created');
             } 
             else
             {
               this.successMessage(response.data);
               this.button_name = 'Save'
             }
         })
         .catch(err => {
             if(err.response.status == 422)
             {
                this.validation_error = err.response.data.errors;
                this.validationError();
                this.button_name = 'Save'
             }
             else
             {
              this.validationError();
             }
         })
     },

     resetForm()
     {
          this.supplier = {
            vendor_name : '',
            vendor_adress : '',
            vendor_email : '',
            vendor_phone : '',
            status : 1  
          };
         this.validation_error = {};
     }
 } 
   
}
</script>