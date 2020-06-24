<template>
<!-- Modal -->
    <div class="modal animated fadeInUp custo-fadeInUp show" id="UpdateSupplier" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form @submit.prevent="update()">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Vendor</h5>
              </div>
                <div class="modal-body">
                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                    <div class="add-contact-box">
                        <div class="add-contact-content text-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-name">
                                        <i class="flaticon-user-11"></i>
                                        <label for="up-vendor-name">Vendor Name</label>
                                        <input type="text"
                                          class="form-control" id="up-vendor-name" v-model="supplier.vendor_name" placeholder="Vendor Name: ">
                                        <span v-if="validation_error.hasOwnProperty('vendor_name')" class="text-danger">
                                                {{ validation_error.vendor_name[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="up-vendor-email">Vendor Email</label>
                                        <input type="text" id="up-vendor-email" class="form-control" v-model="supplier.vendor_email" placeholder="Vendor Email">
                                        <span v-if="validation_error.hasOwnProperty('vendor_email')" class="text-danger">
                                                {{ validation_error.vendor_email[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="contact-phone">
                                        <i class="flaticon-telephone"></i>
                                        <label for="up-vendor-phone">Vendor Phone</label>
                                        <input type="text" id="up-vendor-phone" class="form-control" v-model="supplier.vendor_phone" placeholder="Vendor Phone">
                                        <span v-if="validation_error.hasOwnProperty('vendor_phone')" class="text-danger">
                                                {{ validation_error.vendor_phone[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-email">
                                        <i class="flaticon-mail-26"></i>
                                        <label for="up-vendor-status">Supplier Status</label>
                                        <select class="form-control" id="up-vendor-status" v-model="supplier.status">
                                            <option>Supplier Status</option>
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
                                        <label for="up-vendor-status">Vendor Address</label>
                                        <textarea class="form-control" id="up-vendor-address"  v-model="supplier.vendor_address" placeholder="Vendor Address: " rows="3"></textarea>
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
                    <button type="submit" class="btn btn-primary"><div class="spinner-grow text-white mr-2 align-self-center loader-sm" v-if="button_name != 'Update'"></div>{{ button_name }}</button>

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
          id : '',
          vendor_name : '',
          vendor_address : '',
          vendor_email : '',
          vendor_phone : '',
          status : 1 
         },
         button_name : 'Update',
         validation_error : {},
       }
   },

   mounted() {
      var _this = this;
      EventBus.$on('supplier-update', function(value){
        $('#UpdateSupplier').modal('show')
          _this.supplier = value;
      })
   },

 methods : {
     update()
     {
         this.button_name = 'Updating...'
         axios.put(base_url+'supplier/'+this.supplier.id,this.supplier)
         .then(response => {
             if(response.data.status === 'success')
             {
              $('#UpdateSupplier').modal('hide');
              this.successMessage(response.data);
              this.button_name = 'Update'
              this.resetForm()
              EventBus.$emit('supplier-created');
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
            status : 1  
          };
         this.validation_error = {};
     }
 } 
   
}
</script>